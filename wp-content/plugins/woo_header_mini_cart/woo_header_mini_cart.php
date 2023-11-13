<?php

/**
 * Plugin Name:       Woo Header Mini Cart
 * Plugin URI:        https://sharabindu.com/plugins/woo-header-mini-cart/
 * Description:        A plugin that user can add mini cart options in Menu Section and Footer section
 * Version:           4.0.1
 * Author:            Sharabindu Bakshi
 * Author URI:        https://sharabindu.com/contact-us
 * Text Domain:       whmc
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
   die;
}


/**
 * Currently plugin version.
 * 
 */
define( 'WHMC_VERSION', '4.0.1' );

/**
 * Currently plugin path.
 * 
 */
define( 'WHMC_PATH', plugin_dir_path( __FILE__ ) );

define( 'WHMC_URL', plugin_dir_url( __FILE__ ) );

define('WHMC_BASENAME', plugin_basename( __FILE__ ));

define('WHMC_BASENAME_DIR', plugin_basename( __DIR__ ));

define('WHMC_BASENAMEFOLDER', basename( dirname( __FILE__ )));

define('WHMC_BASENAMEFILES', basename( __FILE__ ));
/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require WHMC_PATH . 'inc/class-whmc.php';

/**
 * This is used to define regiter activation/deactivation hooks, 
 * version of the plugin.
 */
require WHMC_PATH . 'inc/regiter_hook.php';


include_once(ABSPATH.'wp-admin/includes/plugin.php');
if( is_plugin_active('mini-cart-for-woocommerce/mini_cart_fwc.php') ){
     add_action('update_option_active_plugins', 'deactivate_mcfwclight_version');
}
function deactivate_mcfwclight_version(){
   deactivate_plugins('mini-cart-for-woocommerce/mini_cart_fwc.php');
}


/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    4.0.1
 */
function run_WHMC() {

   $plugin = new WHMC();
   $plugin->run();

}
run_WHMC();


     
      