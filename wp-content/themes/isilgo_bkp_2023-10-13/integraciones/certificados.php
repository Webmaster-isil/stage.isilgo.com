<?php

class certificados
{

    private $_url;
    private $_token;

    public function __construct()
    {
        $this->_url = 'https://docs.davicloud.com/API/DocsAPI/public';
        if (!$this->_url) {
            die('falta url');
        } else {
            $respuesta = $this->login();
            if ($respuesta) {
                $respuesta = json_decode($respuesta);
                if ($respuesta) {
                    $this->_token = $respuesta->key;
                } else {
                    echo 'TOKEN INVÁLIDO';
                }
            }
        }
    }

    public function login()
    {
        $response = $this->call('/auth/ISIL', 'GET');
        if ($response) {
            return $response;
        } else {
            echo 'no se pudo conectar';
        }
    }

    public function token()
    {
        echo $this->_token;
    }
    private function call($endpoint, $method, $body = false,  $bearer = false)
    {
        $curl = curl_init();
        $definiciones = array(
            CURLOPT_URL => $this->_url . $endpoint,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => $method,
        );


        if ($bearer) {
            $definiciones[CURLOPT_HTTPHEADER] = array('Content-Type: application/json', 'Authorization: ' . $this->_token);
        }
        if ($body) {
            $definiciones[CURLOPT_POSTFIELDS] = $body;
        }
        curl_setopt_array($curl, $definiciones);
        try {
            $response = curl_exec($curl);
        } catch (\Throwable $th) {
            $response = false;
        }

        curl_close($curl);
        return $response;
    }

    public function crearCertificado($idClient, $documentos, $usuariofirmante, $firma)
    {
        $body = array(
            "IdentificadorCliente" => $idClient,
            "Documentos" => $documentos,
            "UsuarioFirmante" => $usuariofirmante,
            "ConfiguracionFirma" => $firma
        );


        $response = $this->call('/sign/', 'POST', json_encode($body), true);
        $logFile = fopen("log.txt", 'a') or die("Error creando archivo");
        fwrite($logFile, "\n" . date("d/m/Y H:i:s") . json_encode($response)) or die("Error escribiendo en el archivo");
        fclose($logFile);

        if ($response) {
            return $response;
        } else {
            return false;
        }
    }

    public function consultaCertificado($cod)
    {
        $body = '
        {
            "codigoOperacionGrupo": ' . $cod . '
        }
        ';
        $response = $this->call('/document/', 'PUT', $body, true);

        if ($response) {
            return $response;
        } else {
            return false;
        }
    }

    public function urlCertificado($cod)
    {
        $body = '
        {
            "codigoOperacionGrupo": ' . $cod . '
        }
        ';
        $response = json_decode($this->call('/url/', 'PUT', $body, true));

        if ($response) {
            return $response->url;
        } else {
            return false;
        }
    }
}

function descargarPDF()
{
    $codigooperaciongrupo = $_POST['codigooperaciongrupo'];
    $certificados = new certificados();
    $url = json_decode($certificados->consultaCertificado($codigooperaciongrupo))->lArchivoFirmado[0]->rutaArchivo;
    if ($url) {
        echo $url;
    } else {
        echo '2';
    }

    die();
}

add_action('wp_ajax_descargarPDF', 'descargarPDF');
add_action('wp_ajax_nopriv_descargarPDF', 'descargarPDF');
