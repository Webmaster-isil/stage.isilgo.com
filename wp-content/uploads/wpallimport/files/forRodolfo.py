import csv
import requests

def descargar_imagen(url, nombre_archivo):
    try:
        response = requests.get(url)
        response.raise_for_status()  # Verificar si hay errores en la respuesta
        with open(nombre_archivo, 'wb') as archivo:
            archivo.write(response.content)
    except requests.exceptions.RequestException as e:
        print(f"Error al descargar la imagen desde la URL: {url}")
        print(f"Excepción: {e}")
    except IOError as e:
        print(f"Error al guardar la imagen: {nombre_archivo}")
        print(f"Excepción: {e}")

# Ruta al archivo CSV
ruta_archivo_csv = 'course_.csv'

# Abrir el archivo CSV y leer los datos
with open(ruta_archivo_csv, 'r') as archivo_csv:
    lector_csv = csv.DictReader(archivo_csv, delimiter=';')  # Cambiar el delimitador a punto y coma
    
    # Recorrer cada fila del CSV
    for fila in lector_csv:
        id = fila.get('id')
        url = fila.get('foto')
        
        # Validar que 'id' y 'foto' existan en la fila y que 'foto' sea una URL válida
        if id and url and url.startswith('http'):
            nombre_archivo = id + '.jpg'  # Agregar la extensión adecuada
            
            # Descargar la imagen desde la URL y guardarla con el nombre del ID
            descargar_imagen(url, nombre_archivo)
        else:
            print(f"Campo 'id' o 'foto' faltante o no válido en la fila: {fila}")
