<?php


/**
 *
 * This is used to define regiter activation/deactivation hooks, 
 * version of the plugin.
 *
 * @since      4.0.1
 * @package    WHMC
 * @subpackage WHMC/inc
 */

/**
 * The code that runs during plugin activation.
 * This action is documented in inc/class-WHMC-activator.php
 */
function whmc_activate() {
	require_once WHMC_PATH . 'inc/class-whmc-activator.php';
	WHMC_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in inc/class-WHMC-deactivator.php
 */
function whmc_deactivate() {
	require_once WHMC_PATH . 'inc/class-whmc-deactivator.php';
	WHMC_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'whmc_activate' );

register_deactivation_hook( __FILE__, 'whmc_deactivate' );