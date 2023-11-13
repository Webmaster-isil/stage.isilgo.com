<?php
function recienComprado($idwc, $order)
{
    $datos = array(
        'curso' => $idwc,
        'porcentaje_del_curso' => 0,
        'estado' => 'comprado',
        'fecha_compra' => date('d/m/Y'),
        'orden_de_compra' => $order
    );
    $existe = false;
    $mis_cursos = get_field('mis_cursos', 'user_' . wp_get_current_user()->ID);
    foreach ($mis_cursos as $curso) {
        if ($curso['curso'] == $idwc) {
            $existe = true;
            break;
        }
    }
    if (!$existe) {
        add_row('mis_cursos', $datos, 'user_' . wp_get_current_user()->ID);
    }
}


/* 
    AUTOMÁTICAMENTE ASIGNA LOS CURSOS COMPRADOS AL CF DEL USUARIO 
*/
function actualizaCursosPerfil($idwc)
{
    $existe = false;
    $mis_cursos = get_field('mis_cursos', 'user_' . wp_get_current_user()->ID);
    foreach ($mis_cursos as $key => $curso) {
        if ($curso['curso'] == $idwc && $curso['estado'] == 'comprado') {
            $existe = true;
            $mis_cursos[$key]['estado'] = 'iniciado';
            break;
        }
    }

    $membresia_activa = tieneMembresia();
    if ($existe) {
        update_field('mis_cursos', $mis_cursos, 'user_' . wp_get_current_user()->ID);
    } else {
        $orden_de_compra = trae_oc_enrolamiento($idwc, wp_get_current_user()->user_email, $membresia_activa, wp_get_current_user()->ID);
        $datos = array(
            'curso' => $idwc,
            'porcentaje_del_curso' => 0,
            'estado' => 'iniciado',
            'orden_de_compra' => $orden_de_compra
        );
        add_row('mis_cursos', $datos, 'user_' . wp_get_current_user()->ID);
    }
}

add_action('rest_api_init', 'endpointIsilgo');
add_action('rest_api_init', 'endpointIsilgo2');

function endpointIsilgo2()
{
    register_rest_route(
        'revisarAuth/v1',
        '/data',
        array(
            'methods' => 'GET',
            'callback' => 'revisarAuth',
        )
    );
}
function endpointIsilgo()
{
    register_rest_route(
        'updateCourse/v1',
        '/data',
        array(
            'methods' => 'POST',
            'callback' => 'updateCourse',
        )
    );
}

function updateCourse($data)
{

    $email = $data->get_params()['gradeData']['email'];
    $codigoApp = $data->get_params()['gradeData']['course'];
    $porcentaje = $data->get_params()['gradeData']['percent_grade'];

    $passed_timestamp = $data->get_params()['gradeData']['passed_timestamp'];
    $data_user = get_user_by('email', $email);

    $logFile = fopen("log.txt", 'a') or die("Error creando archivo");
    fwrite($logFile, "\n" . date("d/m/Y H:i:s") . ' ' . json_encode($data->get_params())) or die("Error escribiendo en el archivo");
    fclose($logFile);



    if (!$data_user->user_email) {


        $logFile = fopen("log.txt", 'a') or die("Error creando archivo");
        fwrite($logFile, "\n" . date("d/m/Y H:i:s") . ' Usuario no existe en WP. Verificar correo.') or die("Error escribiendo en el archivo");
        fclose($logFile);
        echo returnError(1, 'Usuario no existe en WP. Verificar correo.');
        die();
    };

    if ($porcentaje > 1 || $porcentaje < 0) {
        $logFile = fopen("log.txt", 'a') or die("Error creando archivo");
        fwrite($logFile, "\n" . date("d/m/Y H:i:s") . ' El porcentaje debe ser de 0.0 a 1.') or die("Error escribiendo en el archivo");
        fclose($logFile);

        echo returnError(2, 'El porcentaje debe ser de 0.0 a 1.');
        die();
    }


    $mis_cursos = get_field('mis_cursos', 'user_' . $data_user->ID);

    $existe = false;
    foreach ($mis_cursos as $key => $c) {
        $codigo_repeater = get_field('codigo_app', $c['curso']);
        if ($codigo_repeater == $codigoApp) {
            $existe = true;
            if ($porcentaje == 1) {
                $author_id = get_post_field('post_author', $c['curso']);
                $idClient = "ISIL";
                $documentos = array(
                    array(
                        "IdArchivo" => "2",
                        "DataValidacion" => array(
                            array(
                                "key" => "V1",
                                "value" =>  $data_user->last_name,
                            ),
                            array(
                                "key" => "V2",
                                "value" => $data_user->first_name,
                            ),
                            array(
                                "key" => "V3",
                                "value" => get_the_title($c['curso']),
                            ),
                            array(
                                "key" => "V6",
                                "value" => 'Lima ' . date('d-m-Y'),
                            )
                        )
                    )
                );

                $usuariofirmante = array(
                    "NombreUsuarioFirmante" => $data_user->first_name . ' ' . $data_user->last_name,
                    "DocUsuarioFirmante" => get_field('numero_documento', 'user_' . $data_user->ID),
                    "correo" => $email,
                );

                global $estadoMembresia;
                if ($estadoMembresia) {
                    $idGrupo = 'IVMC';
                } else {
                    $idGrupo = 'IVC';
                }
                $firma = array(
                    "IdGrupo" => $idGrupo /* CURSO: IVC || MASTERCLASS: IVMC  */
                );

                $certificados = new certificados();
                if ($certificados->crearCertificado($idClient, $documentos, $usuariofirmante, $firma)) { {
                        $cod = json_decode($certificados->crearCertificado($idClient, $documentos, $usuariofirmante, $firma));
                        $id_certificado = $cod->codigoOperacionGrupo;
                        $mis_cursos[$key]['porcentaje_del_curso'] = $porcentaje;
                        $mis_cursos[$key]['certificado'] = $id_certificado;
                        $mis_cursos[$key]['estado'] = 'finalizado';
                    }
                }

                $orden_de_compra = trae_oc_enrolamiento($c['curso'], $email, $estadoMembresia, $data_user->ID);
                if ($orden_de_compra) {
                    cursoStatus($c['curso'], $orden_de_compra, $data_user->ID, 2);
                }
            } else {
                // $mis_cursos[$key]['curso'] = $c['curso'];
                $mis_cursos[$key]['porcentaje_del_curso'] = $porcentaje;
                // $mis_cursos[$key]['certificado'] = '';
            }
            break;
        }
    };
    if ($existe) {
        // print_r($mis_cursos);
        $valida =  update_field('mis_cursos', $mis_cursos, 'user_' . $data_user->ID);

        if ($valida) {
            $logFile = fopen("log.txt", 'a') or die("Error creando archivo");
            fwrite($logFile, "\n" . date("d/m/Y H:i:s") . returnError(3, ' Error critico. Contactar con administrador.')) or die("Error escribiendo en el archivo");
            fclose($logFile);

            echo returnError(3, 'Error critico. Contactar con administrador.');
            die();
        } else {
            $success = array(
                'success' => 'ok',
                'mensaje' => 'Actualización exitosa'
            );

            $logFile = fopen("log.txt", 'a') or die("Error creando archivo");
            fwrite($logFile, "\n" . date("d/m/Y H:i:s") . ' ' . json_encode($success)) or die("Error escribiendo en el archivo");
            fclose($logFile);

            echo json_encode($success);
            die();
        }
    } else {
        $logFile = fopen("log.txt", 'a') or die("Error creando archivo");
        fwrite($logFile, "\n" . date("d/m/Y H:i:s") . returnError(4, ' El codigoApp es inválido')) or die("Error escribiendo en el archivo");
        fclose($logFile);
        echo returnError(4, 'El codigoApp es inválido');
        die();
    }
}

function returnError($codError, $mensaje)
{
    $error = array(
        'codError' => $codError,
        'mensaje' => $mensaje
    );

    return json_encode($error);
}
