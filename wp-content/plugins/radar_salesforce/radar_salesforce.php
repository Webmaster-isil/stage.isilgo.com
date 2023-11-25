<?php
/**
 * Plugin Name: Salesforce
 * Plugin URI: https://radar.cl/
 * Description: Crea y edita usuarios woocommerce en Salesforce
 * Version: 1.0.0
 * Author: Radar
 * Author URI: https://radar.cl
 * Text Domain: Radar Salesforce
 */

defined( 'ABSPATH' ) || exit;

add_action( 'mo_oauth_get_user_attrs', 'create_salesforce_customer', 999, 2 );
add_action( 'woocommerce_update_customer', 'update_salesforce_customer', 999, 2 );
add_action( 'wpcf7_submit', 'send_company_form', 99, 2 );
add_action('wp_login', 'so_26675676_your_function', 10, 2);

function so_26675676_your_function($user_login, $user) {
    asignarComunidadIsil($user);
}


function create_salesforce_customer( $user, $resource_owner ) {

	$new_user = get_userdata($user->ID);

	$nombre = get_user_meta($user->ID, 'first_name', true);
	$apellido = get_user_meta($user->ID, 'last_name', true);
	$telefono = get_user_meta($user->ID, 'telefono', true);
	asignarComunidadIsil($user);
	$lead_data = array(
		'first_name'      => $nombre,
		'last_name'       => $apellido,
		'company'         => $nombre . ' ' . $apellido,
		'email'           => $new_user->user_email,
		'00Nf400000TUbiN' => $telefono, //celular
		'00N2S000007Bt0I' => 1, //terminos y condiciones
		'00Nf400000TUZxy' => 'f077', //Formulario Web / Cod ISIL
		'00Nf400000TUZy9' => '82', //Origen de Contacto / Cod ISIL
		'00Nf400000TUZyL' => 's751', //Sub-Origen de Contacto / Cod ISIL
		'recordType'      => '0122S000000DLhf', //Lead Record Type (ISIL GO)
		'00N2S000007S7ro' => date( 'd/m/Y' ), //Fecha Registro ISIL Go
		'lead_source'     => 'Web to Lead',
		'oid'             => '00Df4000003B0C9'
	);
// 	$url = 'https://test.salesforce.com/servlet/servlet.WebToLead?encoding=UTF-8&orgId=00D3I0000008lXO';
	$url = 'https://webto.salesforce.com/servlet/servlet.WebToLead?encoding=UTF-8';	
	genera_lead( $lead_data, $url, 'nuevo usuario' );
}

function update_salesforce_customer( $customer_id, $customer ) {

	$data = $customer->get_data();
	$tipos_documento   = array( 'dni'       => '1', 'carnet'    => '4', 'pasaporte' => '7' );
	$tipo_seleccionado = get_user_meta( $customer_id, 'billing_documento', true );
	$tipo_doc          = $tipos_documento[ $tipo_seleccionado ];
	$numero_field      = $tipo_seleccionado == 'carnet' ? 'extranjeria' : $tipo_seleccionado;
	$numero_documento  = get_user_meta( $customer_id, 'billing_' . $numero_field, true );
	$lead_data         = array(
		"first_name"      => $data['billing']['first_name'], //First Name
		"last_name"       => $data['billing']['last_name'], //Last Name
		"email"           => $data['billing']['email'], //Email
		"company"           => $data['billing']['company'], //Email
		"00Nf400000TUbiN" => get_user_meta( $customer_id, 'telefono', true ), //Teléfono Celular
		"00Nf400000TUZxw" => '', //Fecha de Nacimiento
		"00N2S000006lwOz" => $tipo_doc, //Tipo Documento
		"00Nf400000TUZxq" => $numero_documento, //DNI
		"00N2S000006lxYR" => '', //Grado de Instrucción
		"00N2S000006lxYW" => '', //Situación Laboral
		"country"         => $data['billing']['country'], //Country
		"city"            => get_user_meta( $customer_id, 'billing_ciudad', true ), //City
		"state"           => $data['billing']['state'], //State - Province
		"00Nf400000TUZxy" => 'f078', //Formulario Web
		"00Nf400000TUZy9" => '82', //Origen de Contacto
		"00Nf400000TUZyL" => 's751', //Sub-Origen de Contacto
		"recordType"      => '0122S000000DLhf', //Lead Record Type
		"lead_source"     => 'Web to Lead', //Lead Source
		"00N2S000007RuM4" => '', //Interés 1
		"00N2S000007RuME" => '', //Interés 2
		"00N2S000007RuMT" => '', //Interés 3
		"00N2S000007RuMP" => '', //Interés 4
		"oid"             => '00Df4000003B0C9'
	);

//     $url = 'https://test.salesforce.com/servlet/servlet.WebToLead?encoding=UTF-8&orgId=00D3I0000008lXO';
	$url = 'https://webto.salesforce.com/servlet/servlet.WebToLead?encoding=UTF-8';
	genera_lead( $lead_data, $url, 'actualiza usuario');
}

function send_company_form( $cf7form, $result ) {
	$nombre      = $cf7form->name();
	$submission  = WPCF7_Submission::get_instance();
	$posted_data = null;
	if ( $nombre === 'formulario-empresas' ) {
		if ( $submission ) {
			$posted_data = $submission->get_posted_data();
			$lead_data   = array(
				'00N2S000006xxlb' => $posted_data['ruc'], //RUC
				'company'         => $posted_data['company'],
				'first_name'      => $posted_data['nombre'],
				'last_name'       => $posted_data['last_name'],
				'email'           => $posted_data['email'],
				'00Nf400000TUbiN' => $posted_data['telefono'], //CElular
				'00N2S000007Bt0I' => 1, //Terminos y condiciones}
				'00Nf400000TUZxy' => 'f076', //Formulario web
				'00Nf400000TUZy9' => '82', //Origen contacto
				'00Nf400000TUZyL' => 's737', //Sub-origen contacto
				'recordType'      => '0122S0000006HXV', //Lead record type
				'lead_source'     => 'Web to Lead',
				'oid'             => '00Df4000003B0C9'
			);
// 			$url = 'https://test.salesforce.com/servlet/servlet.WebToLead?encoding=UTF-8&orgId=00D3I0000008lXO';
			$url = 'https://webto.salesforce.com/servlet/servlet.WebToLead?encoding=UTF-8';
			
			genera_lead( $lead_data, $url, 'empresa');
		}
	}
}


function genera_lead( $lead_data, $url, $method = '' ) {
	$endpoint = curl_init( $url );
	curl_setopt( $endpoint, CURLOPT_POST, 1 );
	curl_setopt( $endpoint, CURLOPT_RETURNTRANSFER, 1 );
	curl_setopt( $endpoint, CURLOPT_POSTFIELDS, http_build_query( $lead_data ) );
	curl_setopt( $endpoint, CURLOPT_HTTPHEADER, array(
		'Content-Type: application/x-www-form-urlencoded'
	) );
	$logger = wc_get_logger();
	$context = array( 'source' => 'radar_salesforce' );
	$logger->info( $method . ":\n" . json_encode($lead_data, JSON_PRETTY_PRINT), $context);
	$response = curl_exec( $endpoint );
	//var_dump($response);
	$info = curl_getinfo( $endpoint );
//	die();
	curl_close( $endpoint );
}

add_action('wp_ajax_nopriv_get_order', 'getGmt');

function getGmt(){
	$order = wc_get_order($_GET['oc']);
	var_dump($order->get_date_created()->format('c'));
	die();
}


function asignarComunidadIsil($user){
// 	$user->set_role('customer');  
	$rol = get_user_meta($user->ID, 'nickname_isil', true);
	if($rol && $rol != ''){
		$url_API = get_field('url_api_isil', 'options');    
        $token_API = get_field('token_api_isil', 'options');
        $permisos_API = get_field('permisos_api_isil', 'options');

        if ($url_API == '' || $token_API == '' || $permisos_API == '') { return false; }
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
			
			$curl = curl_init();        
            $url_API = get_field('url_api_purchase_roles', 'options');
            curl_setopt_array($curl, array(
                CURLOPT_URL => $url_API.$rol.'/roles',
                CURLOPT_RETURNTRANSFER => true, CURLOPT_ENCODING => '', CURLOPT_MAXREDIRS => 10, CURLOPT_TIMEOUT => 0, CURLOPT_FOLLOWLOCATION => true, 
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => 'GET',
                CURLOPT_HTTPHEADER => array('Content-Type: application/json', 'Authorization: Bearer ' . $token_API->access_token),
            ));        
            $response2 = json_decode(curl_exec($curl), true);
            $user->remove_role('student_ee' ); $user->remove_role('student_ct' ); $user->remove_role('alumni' ); $user->remove_role('employee' ); $user->remove_role('faculty' );
            if(is_array($response2)){
                foreach($response2 as $key => $rol){
                    if($rol['name'] == 'STUDENT EE') { $user->add_role('student_ee' ); }
                    if($rol['name'] == 'STUDENT CT') { $user->add_role('student_ct' ); } 
                    if($rol['name'] == 'ALUMNI') { $user->add_role('alumni' ); } 
                    if($rol['name'] == 'EMPLOYEE') { $user->add_role('employee' ); }
                    if($rol['name'] == 'FACULTY') { $user->add_role('faculty' ); }
                }
            }
            curl_close($curl);
		}
	}
}

function custom_user_profile_fields( $customer_id ) {
    ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
    if($_REQUEST['account_grado'] &&  $_REQUEST['account_grado'] != ''){ update_field('grado_isil', $_REQUEST['account_grado'], 'user_'.$customer_id); }
    if($_REQUEST['account_situacion'] &&  $_REQUEST['account_situacion'] != ''){ update_field('situacion_isil', $_REQUEST['account_situacion'], 'user_'.$customer_id); }
    if($_REQUEST['account_bithday'] &&  $_REQUEST['account_bithday'] != ''){ update_field('fecha_de_nacimiento_isil', $_REQUEST['account_bithday'], 'user_'.$customer_id); }
    if($_REQUEST['account_phone'] &&  $_REQUEST['account_phone'] != ''){ update_field('telefono', $_REQUEST['account_phone'], 'user_'.$customer_id); }
    if($_REQUEST['account_linkedIn'] &&  $_REQUEST['account_linkedIn'] != ''){ update_field('linkedin', $_REQUEST['account_linkedIn'], 'user_'.$customer_id); }
    
    
    if($_REQUEST['account_interes_1'] &&  $_REQUEST['account_interes_1'] != ''){ update_field('interes_1_isil', $_REQUEST['account_interes_1'], 'user_'.$customer_id); }
    if($_REQUEST['account_interes_2'] &&  $_REQUEST['account_interes_2'] != ''){ update_field('interes_2_isil', $_REQUEST['account_interes_2'], 'user_'.$customer_id); }
    if($_REQUEST['account_interes_3'] &&  $_REQUEST['account_interes_3'] != ''){ update_field('interes_3_isil', $_REQUEST['account_interes_3'], 'user_'.$customer_id); }
    if($_REQUEST['account_interes_4'] &&  $_REQUEST['account_interes_4'] != ''){ update_field('interes_4_isil', $_REQUEST['account_interes_4'], 'user_'.$customer_id); }
    
     
	$tipos_documento   = array( 'dni'       => '1', 'carnet'    => '4', 'pasaporte' => '7' );
	$tipo_seleccionado = get_user_meta( $customer_id, 'billing_documento', true );
	$tipo_doc          = $tipos_documento[ $tipo_seleccionado ];
	$numero_field      = $tipo_seleccionado == 'carnet' ? 'extranjeria' : $tipo_seleccionado;
	$numero_documento  = get_user_meta( $customer_id, 'billing_' . $numero_field, true );
	$data = new WC_Customer( $customer_id );
	$lead_data         = array(
		"first_name"      => $_REQUEST['account_first_name'], //First Name
		"last_name"       => $_REQUEST['account_last_name'], //Last Name
		"email"           => $data->get_email(), //Email
		"company"           => $data->get_billing_company(), //Compañia
		"00Nf400000TUbiN" => get_user_meta( $customer_id, 'telefono', true ), //Teléfono Celular
		"00Nf400000TUZxw" => date('d/m/Y', strtotime($_REQUEST['account_bithday'])), //Fecha de Nacimiento
		"00N2S000006lwOz" => $tipo_doc, //Tipo Documento
		"00Nf400000TUZxq" => $numero_documento, //DNI
		"00N2S000006lxYR" => $_REQUEST['account_grado'], //Grado de Instrucción
		"00N2S000006lxYW" => $_REQUEST['account_situacion'], //Situación Laboral
		"country"         => $data->get_billing_country(), //Country
		"city"            => get_user_meta( $customer_id, 'billing_ciudad', true ), //City
		"state"           => $data->get_billing_state(), //State - Province
		"00Nf400000TUZxy" => 'f078', //Formulario Web
		"00Nf400000TUZy9" => '82', //Origen de Contacto
		"00Nf400000TUZyL" => 's751', //Sub-Origen de Contacto
		"recordType"      => '0122S000000DLhf', //Lead Record Type
		"lead_source"     => 'Web to Lead', //Lead Source
		"00N2S000007RuM4" => $_REQUEST['account_interes_1'], //Interés 1
		"00N2S000007RuME" => $_REQUEST['account_interes_2'], //Interés 2
		"00N2S000007RuMT" => $_REQUEST['account_interes_3'], //Interés 3
		"00N2S000007RuMP" => $_REQUEST['account_interes_4'], //Interés 4
		"oid"             => '00Df4000003B0C9'
	);
	
	if($_REQUEST['account_company'] && $_REQUEST['account_company'] != ''){ $data->set_billing_company($_REQUEST['account_company']); }
	if($_REQUEST['account_phone'] && $_REQUEST['account_phone'] != ''){ $data->set_billing_phone($_REQUEST['account_phone']); }
	if($_REQUEST['account_first_name'] && $_REQUEST['account_first_name'] != ''){ $data->set_billing_first_name($_REQUEST['account_first_name']); }
	if($_REQUEST['account_last_name'] && $_REQUEST['account_last_name'] != ''){ $data->set_billing_last_name($_REQUEST['account_last_name']); }

	
	$data->save();

// 	$url = 'https://test.salesforce.com/servlet/servlet.WebToLead?encoding=UTF-8&orgId=00D3I0000008lXO';
	$url = 'https://webto.salesforce.com/servlet/servlet.WebToLead?encoding=UTF-8';
	genera_lead( $lead_data, $url, 'actualiza usuario');
    
}
add_action( 'woocommerce_save_account_details', 'custom_user_profile_fields' );



