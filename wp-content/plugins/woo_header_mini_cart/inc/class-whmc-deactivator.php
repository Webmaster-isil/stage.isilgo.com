<?php

/**
 * Fired during plugin deactivation
 * @since      4.0.1
 *
 * @package    WHMC
 * @subpackage WHMC/includes
 */

/**
 * Fired during plugin deactivation.
 *
 * This class defines all code necessary to run during the plugin's deactivation.
 *
 * @since      4.0.1
 * @package    WHMC
 * @subpackage WHMC/includes
 */
class WHMC_Deactivator {

	/**
	 * Short Description. (use period)
	 *
	 * Long Description.
	 *
	 * @since    4.0.1
	 */
	public static function deactivate() {

		flush_rewrite_rules();

	}

}
