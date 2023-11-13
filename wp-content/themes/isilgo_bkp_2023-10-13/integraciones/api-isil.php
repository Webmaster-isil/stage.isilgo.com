<?php
// este action se ejecuta en la compra de un curso, y es para enviar la data del curso a la api isil
// add_action('woocommerce_order_status_completed', 'api_isil_complete', 99, 1);

add_action('wp_ajax_ejemplo', 'api_isil_complete');
add_action('wp_ajax_nopriv_ejemplo', 'api_isil_complete');
function api_isil_complete($order_id, $membresia = false, $persona = false)
{    
    
    $url_API = get_field('url_api_isil', 'options');
    $token_API = get_field('token_api_isil', 'options');
    $permisos_API = get_field('permisos_api_isil', 'options');

    if ($url_API == '' || $token_API == '' || $permisos_API == '') {
        return false;
    }
    
    // if (!$order_id) { $order_id = 1612; }
    if (!$order_id) { return false; }
    $order = wc_get_order($order_id);
    $curl = curl_init();

    curl_setopt_array($curl, array(
        CURLOPT_URL => $url_API,
        CURLOPT_RETURNTRANSFER => true, CURLOPT_ENCODING => '', CURLOPT_MAXREDIRS => 10, CURLOPT_TIMEOUT => 0, CURLOPT_FOLLOWLOCATION => true, CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => 'POST',
        CURLOPT_POSTFIELDS => $permisos_API,
        CURLOPT_HTTPHEADER => array('Content-Type: application/x-www-form-urlencoded', 'Authorization: Basic ' . $token_API),
    ));

    $response = json_decode(curl_exec($curl));
    curl_close($curl);
    if (is_object($response) && isset($response->access_token) && $response->access_token != '') {
        $items = $order->get_items();
        $i = 1;
        $list = false;
        foreach ($items as $item) {
            $add = '';
            $terms = get_the_terms($item->get_product_id(), 'product_cat');
            if ($terms) {
                foreach ($terms as $term) {
                    switch ($term->slug) {
                        case 'suscripciones':
                            $add = 'Membresía';
                            break;
                        case 'master-class':
                            $add = 'Master Class';
                            if ($membresia) {
                                $add = 'Master Class - Membresía';
                            }
                            break;
                        default:
                            $add = 'Curso';
                            if ($membresia) {
                                $add = 'Curso - Membresía';
                            }
                            break;
                    }
                }
            }

            if (!$persona) {
                $persona =  $order->get_user_id();
            }
        
            $list[] =
                array(
                    "item_amount" => $item->get_total(),
                    "item_desc" => $item->get_name(),
                    "item_id" => $item->get_product_id(),
                    "item_seq" => $i,
                    "purchase_id" => $order->get_id(),
                    "purchase_item_id" =>  $order->get_id() . '-' . $item->get_product_id() . '-' . $persona,
                    "quantity" => $item->get_quantity(),
                    "add" => $add,
                    "status_date" => $order->get_date_created()->format('c') // 'c' ISO 8601 date
                );
            $i++;
        }

        $factura_boleta = get_post_meta($order_id, 'factura_boleta', true);
        $billing_documento = get_post_meta($order_id, 'billing_documento');
        $billing_razon_social = '';
        $billing_direccion = '';
        $billing_ruc = '';
        if ($factura_boleta == 'factura') {
            $billing_ruc = get_post_meta($order_id, 'billing_ruc', true);
            $billing_razon_social = get_post_meta($order_id, 'billing_razon_social', true);
            $billing_direccion = get_post_meta($order_id, 'billing_direccion', true);
        }

        if ($billing_documento[0] == 'dni') {
            $documento[] = '1';
            $documento[] = get_post_meta($order_id, 'billing_dni')[0];
        } else if ($billing_documento[0] == 'pasaporte') {
            $documento[] = '7';
            $documento[] = get_post_meta($order_id, 'billing_pasaporte')[0];
        } else if ($billing_documento[0] == 'carnet') {
            $documento[] = '4';
            $documento[] = get_post_meta($order_id, 'billing_extranjeria')[0];
        }

        global $wpdb;
        $resultado = false; $brand = $order->get_payment_method();
        $resultado = $wpdb->get_results("SELECT brand, transactionId FROM  wp_niubiz_payment WHERE purchaseNumber = $order_id ");
        
        if(!$resultado){
            $resultado = $wpdb->get_results("SELECT brand, transactionId FROM wp_niubiz_recurrent_payment WHERE purchaseNumber = $order_id ");
        }


        if($resultado && is_array($resultado) && is_object($resultado[0]) && isset($resultado[0]->brand)){
 
            switch ($resultado[0]->brand) {
                case 'visa':
                    $brand = 'VISA';
                    break;
                case 'dinersclub':
                    $brand = 'DINER';
                    break;
                case 'amex':
                    $brand = 'AMEX';
                    break;            
                case 'mastercard':
                    $brand = 'MAST';
                    break;            
                default:
                break;
            }        
        }

        $operationId = ''; 
        if($resultado && is_array($resultado) && is_object($resultado[0]) && isset($resultado[0]->transactionId)){
            $operationId = $resultado[0]->transactionId;
        }

       $ciudad = ''; 
       if(get_post_meta($order_id, 'billing_ciudad')[0]){
        $ciudad = get_post_meta($order_id, 'billing_ciudad')[0]; 
       }
        $cuerpo = array(
            "brand" => $brand,
            "business_address" => $billing_direccion, // MOSTRARÁ DIRECCIÓN SÓLO SI EN LA ORDEN VIENE $FACTURA_BOLETA == FACTURA ,
            "business_identifier" => $billing_ruc,
            "business_name" => $billing_razon_social, // MOSTRARÁ NOMBRE EMPRESA SÓLO SI EN LA ORDEN VIENE $FACTURA_BOLETA == FACTURA ,
            "doc_number" => $documento[1], // PREGUNTAR SI ESTO ES CORRECTO: ¿DOC_NUMBER == DNI/PASAPORTE/EXTRANJERIA?
            "doc_type" => $documento[0],
            "email" => $order->get_billing_email(),
            "family_name" => $order->get_billing_last_name(),
            "given_name" => $order->get_billing_first_name(),
            "operation_number" => $operationId,
            "paid" => true,
            "purchase_date" => $order->get_date_created()->format('c'), // ppasar esta fecha a formato utc
            "phone_number" => $order->get_billing_phone(),
            "country" => $order->get_billing_country(),
            "state" => $order->get_billing_state(),
            "city" => $ciudad,
            "purchase_amount" => $order->get_total(),
            "purchase_id" => $order->get_id(),
            "tc" => true,
            "app" => "ISILGO",
            "purchaseDetails" => $list,
            // 'lead_source' => 'Web to Lead',
            // "recordType" => '0122S000000DLhf',  // Cambiar este id luego en productivo record type
            // "00Nf400000TUZxy" => 'f077', // Cambiar este id luego en productivo  FORMULARIO WEB
            // '00Nf400000TUZy9' => 82, // Cambiar este id luego en productivo ORIGEN DE CONTACTO
            // '00Nf400000TUZyL' => 's751' // Cambiar este id luego en productivo SUBORIGEN DE CONTACTO
        );    
        
        $descuentos = $order->get_used_coupons();
        $discount_description = array();
        if ($descuentos) {
            foreach ($descuentos as $coupon_code) {
                $coupon = new WC_Coupon($coupon_code);
                $discount_type = $coupon->get_discount_type();
                $des = array(
                    "purchase_date" => $order->get_date_created()->date('c'), // ppasar esta fecha a formato utc
                    "paid_date" =>  $order->get_date_paid()->date('c'), // ppasar esta fecha a formato utc
                    "coupon_description" => $coupon->get_code(),
                    "status_date" => date("c") // ppasar esta fecha a formato utc
                );
                array_push($discount_description, $des);
            }
        }

        if (count($discount_description) > 0) {
            $cuerpo['discount_description'] = $discount_description;
        }

        $url_API_PURCHASE = get_field('url_api_purchase_isil', 'options');

        if ($url_API_PURCHASE == '') {
            echo 'faltan datos de funcionamiento, revisar pestaña options -> API ISIL';
            die();
        }
        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => $url_API_PURCHASE,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => json_encode($cuerpo),
            CURLOPT_HTTPHEADER => array(
                'Content-Type: application/json',
                'Authorization: Bearer ' . $response->access_token,
            ),
        ));

        $response2 = curl_exec($curl);
        curl_close($curl);

        $order->add_order_note('texto enviado a API ISIL' . json_encode($cuerpo));
        $order->add_order_note($response2);
    }
}

function cursoStatus($prodId, $ordenID, $userId, $status){
    $url_API = get_field('url_api_isil', 'options');    
    $token_API = get_field('token_api_isil', 'options');
    $permisos_API = get_field('permisos_api_isil', 'options');

    if ($url_API == '' || $token_API == '' || $permisos_API == '') {
        return false;
    }
    $curl = curl_init();
    curl_setopt_array($curl, array(
        CURLOPT_URL => $url_API,
        CURLOPT_RETURNTRANSFER => true, CURLOPT_ENCODING => '', CURLOPT_MAXREDIRS => 10, CURLOPT_TIMEOUT => 0, CURLOPT_FOLLOWLOCATION => true, CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => 'POST',
        CURLOPT_POSTFIELDS => $permisos_API,
        CURLOPT_HTTPHEADER => array('Content-Type: application/x-www-form-urlencoded', 'Authorization: Basic ' . $token_API),
    ));
    
    $token_API = json_decode(curl_exec($curl));    
    curl_close($curl);    
    if (is_object($token_API) && isset($token_API->access_token) && $token_API->access_token != '') {        
        $data = array();
        $mensaje = '';
        $mensaje2 = '';
        if ($status == 1) {
            $data = array("status" => "Curso Iniciado", "status_date" => date('c')); 
            $mensaje = 'PurchaseDetail Enviado Iniciado: ';
            $mensaje2 = 'PurchaseDetail Recibido Iniciado: ';
        } else if ($status == 2) { 
            $data = array("status" => "Curso Finalizado", "status_date" => date('c')); 
            $mensaje = 'PurchaseDetail Enviado Finalizado: ';
            $mensaje2 = 'PurchaseDetail Recibido Finalizado: ';
        }       
        // Agregar el array en el metodo
        $curl = curl_init();        
        $url_API = get_field('url_api_purchase_detail', 'options');
        $url_API .= $ordenID . '-' . $prodId . '-' . $userId;
        curl_setopt_array($curl, array(
            CURLOPT_URL => $url_API,
            CURLOPT_RETURNTRANSFER => true, CURLOPT_ENCODING => '', CURLOPT_MAXREDIRS => 10, CURLOPT_TIMEOUT => 0, CURLOPT_FOLLOWLOCATION => true, 
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'PATCH',
            CURLOPT_POSTFIELDS => json_encode($data),
            CURLOPT_HTTPHEADER => array('Content-Type: application/json', 'Authorization: Bearer ' . $token_API->access_token),
        ));        
        
        $response2 = json_encode(curl_exec($curl));                
        curl_close($curl);

        $order = wc_get_order($ordenID);
        if($mensaje != ''){
            $order->add_order_note($mensaje . json_encode($data));
        }
        if($mensaje2 != ''){            
            $order->add_order_note($mensaje2 . $response2);
        }
    }
}