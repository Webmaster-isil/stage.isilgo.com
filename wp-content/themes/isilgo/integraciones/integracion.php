<?php
class integracion
{
    private $_client_id;
    private $_client_secret;
    private $_direccion;
    private $_grant_type;
    private $_scope;
    private $_token;

    public function __construct()
    {
        $this->_client_id = 'Mi9IELpTcebiRdX8r1WOYUdzjq8u7WyNlzWlsMuV';
        $this->_client_secret = 'SVlIYX12BpldTmtrdzzTJybFCn0OjIHwdmVjkRmeE6uyRvQpfxrSX0yVkl0Otf4G2qqVWh6DERp06ljezfKrODfRF64iKeen34RDymfQFW9ddkzsIFlymss05Fz71kjg';
        $this->_grant_type = 'client_credentials';
        $this->_direccion = 'https://isilgo-sandbox.edunext.io';

        if (!$this->_client_id || !$this->_client_secret || !$this->_direccion || !$this->_grant_type) {
            die('falta usuario o contraseña');
        } else {
            $respuesta = $this->login();
            if ($respuesta) {
                $respuesta = json_decode($respuesta);
                if ($respuesta) {
                    $this->_token = $respuesta->access_token;
                } else {
                    echo 'TOKEN INVÁLIDO';
                }
            }
        }
    }

    public function login()
    {
        $body = '{ 
            "client_id": "' . $this->_client_id . '", 
            "client_secret": "' . $this->_client_secret . '", 
            "grant_type": "' . $this->_grant_type . '" }';
        $response = $this->call('/oauth2/access_token/', json_decode($body));
        if ($response) {
            return $response['response'];
        } else {
            echo 'no se pudo conectar';
        }
    }





    private function call($endpoint, $body, $method = false, $bearer = false, $query_build = false)
    {
        $curl = curl_init();
        $definiciones = array(
            CURLOPT_URL => $this->_direccion . $endpoint,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
        );

        if ($bearer) {
            $definiciones[CURLOPT_HTTPHEADER] = array('Content-Type: application/json', 'Authorization: Bearer ' . $this->_token);
        }

        if ($method) {
            $definiciones[CURLOPT_CUSTOMREQUEST] = 'GET';
        } else {
            if ($query_build) {
                $definiciones[CURLOPT_POSTFIELDS] = $body;
            } else {
                $definiciones[CURLOPT_POSTFIELDS] = http_build_query($body);
            }
        }

        curl_setopt_array($curl, $definiciones);

        try {
            $response = curl_exec($curl);
        } catch (\Throwable $th) {
            $response = false;
        }

        curl_close($curl);
        $codigo = curl_getinfo($curl, CURLINFO_HTTP_CODE);


        return array(
            'response' => $response,
            'codigo' => $codigo
        );
    }

    public function getGrade($username, $email, $course_id)
    {
        $course_id = str_replace('+', '%2B', $course_id);
        $params = '?username=' . $username . '&email=' . $email . '&course_id=' . $course_id;
        $response = $this->call('/eox-core/api/v1/grade/' . $params, '', true, true);
        $datos = $response['response'];
        $codigo = $response['codigo'];
        if ($codigo === 200) {
            $datos = json_decode($datos);
            return $datos->earned_grade;
        } else {
            return $response;
        }
    }
    public function verificaEnrolamiento($email, $course_id)
    {
        $course_id = str_replace('+', '%2B', $course_id);
        $params = '?email=' . $email . '&course_id=' . $course_id;
        $response = $this->call('/eox-core/api/v1/enrollment/' . $params, '', true, true);
        $datos = $response['response'];
        $codigo = $response['codigo'];
        if ($codigo === 200) {
            return true;
        } else {
            return false;
        }
    }

    public function enrolarCurso($username, $course_id, $force = false)
    {

        $params = array(
            "username" => $username,
            "course_id" => $course_id,
            "mode" => "audit",
            "force" => $force
        );

        $response = $this->call('/eox-core/api/v1/enrollment/', json_encode($params), false, true, true);
        $datos = $response['response'];
        $codigo = $response['codigo'];

        if ($codigo === 200) {
            return true;
        } else {

            return 'Error ' . $codigo . ' al intentar enrolar: ' . json_decode($datos)->error->detail;
        }
    }

    public function getUserInfo($email)
    {

        $response = $this->call('/eox-core/api/v1/user/?email=' . $email, '', true, true);

        $datos = $response['response'];
        $codigo = $response['codigo'];
        if ($codigo === 200) {
            return true;
        } else {
            return false;
        }
    }




    public function crearUsuario($email, $username, $password, $fullname, $activate_user = false, $skip_password = false)
    {
        $args = array(
            "email" => $email,
            "username" => $username,
            "password" => $password,
            "fullname" => $fullname,
            'activate_user' => $activate_user,
            'skip_password' => $skip_password
        );

        $response = $this->call('/eox-core/api/v1/user/', json_encode($args), false, true, true);

        if ($response['codigo'] === 200) {
            return true;
        } else {
            return $response['codigo'] . ' ' . $response['response'];
        }
    }
}


// CREAR USUARIO EN EL ENDPOINT
function checkUser()
{

    $username = $_POST['username'];
    $email = $_POST['email'];
    $course_id = $_POST['course_id'];
    $idwc = $_POST['idwc'];
    $membresia_activa = tieneMembresia();
    $orden_de_compra = trae_oc_enrolamiento($idwc, $email, $membresia_activa, wp_get_current_user()->ID);

    $integracion = new integracion();
    // PREGUNTA SI EL USUARIO EXISTE
    // getUserInfo($email) == true || false
    $getUserInfo = $integracion->getUserInfo($email);
    if ($getUserInfo) {
        $cursos = get_field('mis_cursos', 'user_' . wp_get_current_user()->ID);
        $existeCurso = false;
        foreach ($cursos as $c) {
            if ($c['curso'] == $idwc && $c['estado'] == 'iniciado') {
                $existeCurso = true;
                break;
            }
        }

        if ($existeCurso) {
            echo '1';
        } else {
            // SI EXISTE, CONFIRMA SU ENROLAMIENTO
            // verificaEnrolamiento($username, $email, $course_id) == true || false
            $verificaEnrolamiento = $integracion->verificaEnrolamiento($email, $course_id);
            if ($verificaEnrolamiento === true) {
                // SI ESTÁ ENROLADO, REDIRIGE AL LINK DE EDUNEX
                actualizaCursosPerfil($idwc);

                echo '1';
            } else {
                // SI NO ESTÁ ENROLADO, ENROLARLO
                // FUNCIÓN PARA ENROLAR

                $enrolarCurso = $integracion->enrolarCurso($username, $course_id, true);


                if ($enrolarCurso === true) {
                    // ENVIA INICIADO //
                    actualizaCursosPerfil($idwc);
                    if ($orden_de_compra && $membresia_activa) {
                        api_isil_complete($orden_de_compra, $membresia_activa, wp_get_current_user()->ID);
                        //                        cursoStatus($idwc, $orden_de_compra, wp_get_current_user()->ID, 1);
                    } //else {
                    // hacer un query que traiga la compra, con el id del curso, y el id de l
                    //                        $idOC = $oc_regalo ? $oc_regalo : verificaItemOC($idwc, wp_get_current_user()->ID);
                    //                        cursoStatus($idwc, $orden_de_compra, wp_get_current_user()->ID, 1);
                    //                    }

                    cursoStatus($idwc, $orden_de_compra, wp_get_current_user()->ID, 1);
                    echo '1';
                } else {
                    echo $enrolarCurso;
                }
            }
        }
    } else {
        $userdata = array(
            'ID' => get_current_user_id(),
            'user_email' => $email,
        );
        wp_update_user($userdata);
        // CREAR USUARIO, ENROLAR Y REDIRIGIR AL LINK DE EDUNEX
        // crearUsuario($email, $username, '', $username, false, true); == true || respuesta_error
        $crearUsuario = $integracion->crearUsuario($email, $username, $username, $username, false, true);
        if ($crearUsuario === true) {

            $enrolarCurso = $integracion->enrolarCurso($username, $course_id, true);
            if ($enrolarCurso === true) {
                // ENVIA INICIADO //
                actualizaCursosPerfil($idwc);
                if ($orden_de_compra && $membresia_activa) {
                    api_isil_complete($orden_de_compra, $membresia_activa, wp_get_current_user()->ID);
                } //else {
                // hacer un query que traiga la compra, con el id del curso, y el id de l
                //                    $idOC = verificaItemOC($idwc, wp_get_current_user()->ID);
                //                    cursoStatus($idwc, $idOC, wp_get_current_user()->ID, 1);
                //                }              
                cursoStatus($idwc, $orden_de_compra, wp_get_current_user()->ID, 1);
                echo '1';
            } else {
                echo $enrolarCurso;
            }
        } else {
            echo $crearUsuario;
        }
    }
    die();
}

add_action('wp_ajax_checkUser', 'checkUser');
add_action('wp_ajax_nopriv_checkUser', 'checkUser');

function trae_oc_enrolamiento($curso_id, $email, $membresia_activa, $idUser = false)
{
    $oc_membresia = get_field('orden_de_compra', 'user_' . $idUser);
    if ($oc_membresia && $membresia_activa) {
        return $oc_membresia;
    } elseif ($regalo = trae_curso_regalado($curso_id, $email)) {
        return $regalo[0]['id_orden'];
    } else {
        return verificaItemOC($curso_id, $idUser);
    }
}


function verificaCursoComprado()
{
    global $cursoComprado;
    $current_user = wp_get_current_user();
    $id_actual = get_the_ID();

    if ($current_user->ID != 0 && $id_actual) {
        if (trae_curso_regalado($id_actual, $current_user->user_email)) {
            $cursoComprado = true;
        } else {
            // $membresias_id = array(105, 112, 113);
            $cursos = get_field('mis_cursos', 'user_' . wp_get_current_user()->ID);

            if ($cursos) {
                $product_ids     = false;
                foreach ($cursos as $c) {
                    $product_ids[] = $c['curso'];
                }

                $id_actual = get_the_ID();
                if ($product_ids && in_array($id_actual, $product_ids)) {
                    $cursoComprado = true;
                } else {
                    $cursoComprado = false;
                }
            } else {
                $cursoComprado = false;
            }
        }
    } else {
        return;
    }
}

function tieneMembresia()
{
    $check_membresia = get_field('membresia', 'user_' . wp_get_current_user()->ID);
    $fecha_renovacion = date('Y-m-d', strtotime(get_field('fecha_expiracion', 'user_' . wp_get_current_user()->ID)));
    //$fecha_expiracion = date('Y-m-d', strtotime($fecha_renovacion . ' +7 days'));
    $fecha_actual = date('Y-m-d');
    global $estadoMembresia;
    if ($check_membresia || $fecha_actual <= $fecha_renovacion) {
        $estadoMembresia = true;
        return true;
    } else {
        $estadoMembresia = false;
        return false;
    }
}


function verificaItemOC($idwc, $iduser)
{
    $idOC = false;
    $customer_orders = get_posts(array(
        'numberposts' => -1,
        'meta_key'    => '_customer_user',
        'meta_value'  => $iduser,
        'post_type'   => wc_get_order_types(),
        'post_status' => array_keys(wc_get_is_paid_statuses()),
    ));
    if ($customer_orders) {
        foreach ($customer_orders as $customer_order) {
            $order = wc_get_order($customer_order->ID);
            $items = $order->get_items();
            foreach ($items as  $item) {
                if ($item->get_product_id() == $idwc) {
                    $idOC = $customer_order->ID;
                    break;
                }
            }
        }
    }
    return $idOC;
}
