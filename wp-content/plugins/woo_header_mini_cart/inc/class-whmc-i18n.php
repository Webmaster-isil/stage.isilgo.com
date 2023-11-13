<?php

/**
 * Define the internationalization functionality
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @since      4.0.1
 *
 * @package    WHMC
 * @subpackage WHMC/includes
 */

/**
 * Define the internationalization functionality.
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @since      4.0.1
 * @package    WHMC
 * @subpackage WHMC/includes
 */
class WHMC_i18n {


	/**
	 * Load the plugin text domain for translation.
	 *
	 * @since    4.0.1
	 */
	public function load_plugin_textdomain() {

		load_plugin_textdomain(
			'whmc',
			false,
			dirname( dirname( plugin_basename( __FILE__ ) ) ) . '/languages/'
		);

	}



}
