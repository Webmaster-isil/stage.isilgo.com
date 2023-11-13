<?php
/**
 * Plugin Name: Whitelist jwt
 * Plugin URI: https://radar.cl/
 * Description: Lista blanca endpoints api
 * Version: 1.0.0
 * Author: Radar
 * Author URI: https://radar.cl
 * Text Domain: Radar Whitelist
 */

add_filter('jwt_auth_whitelist', 'whitelist_jwt', 999);

function whitelist_jwt($endpoints){
	$your_endpoints = array(
		'/wp-json/contact-form-7/v1/contact-forms/*'
	);

	return array_unique( array_merge( $endpoints, $your_endpoints ) );
}