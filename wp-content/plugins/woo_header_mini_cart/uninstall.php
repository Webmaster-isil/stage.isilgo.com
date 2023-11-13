<?php

/**
 * Fired when the plugin is uninstalled.
  *
 * @link       https://sharabindu.com
 * @since      4.0.1
 *
 * @package    WHMC
 */

// If uninstall not called from WordPress, then exit.
if ( ! defined( 'WP_UNINSTALL_PLUGIN' ) ) {
	exit;
}


delete_option('whmc_option' );