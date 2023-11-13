<html>
    <head>
        <style>
            body { overflow-x: scroll; }
        </style>
    </head>
    <body>
        <?php 
        ini_set('display_errors', 1);
        ini_set('display_startup_errors', 1);
        error_reporting(E_ALL);
        
        $mysqli = new mysqli("localhost", "isilgodevradar_usr", "Dy~4G{m(S3wx", "isilgodevradar_bckp");
        
        /* verificar la conexión */
        if ($mysqli->connect_errno) {
            printf("Conexión fallida: %s\n", $mysqli->connect_error);
            exit();
        }
        
        $consulta = "SELECT id_curso FROM course";
        
        if ($resultado = $mysqli->query($consulta)) { ?>
            <table>
                
            <?php //tener un array asociativo */
            while ($fila = $resultado->fetch_assoc()) { ?>
                <tr>
                    
        
                <?php $cursos_plan = 'SELECT * FROM course_study_plan WHERE id_curso = "'.$fila["id_curso"].'"';    
                if ($planes = $mysqli->query($cursos_plan)) { ?>
                    <?php while ($filaPlanes = $planes->fetch_assoc()) { ?>
                        <?php
                            echo $fila['id_curso'].',';
                            echo '"'.$filaPlanes["COL 4"].'",';
                            echo '"'.$filaPlanes["titulo"].'",';
                            echo '"'.$filaPlanes["COL 6"].'"';
                            echo '<br>';
                        ?>
                    <?php } ?>
                <?php } ?>
                </tr>
            <?php die(); } ?>
            </table>
            <?php $resultado->free();
        }
        
        /* cerrar la conexión */
        $mysqli->close();
        ?>
    </body>
</head>
