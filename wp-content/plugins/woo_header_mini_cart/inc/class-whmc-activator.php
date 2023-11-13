<?php

/**
 * Fired during plugin activation
 * @since      4.0.1
 *
 * @package    WHMC
 * @subpackage WHMC/includes
 */

/**
 * Fired during plugin activation.
 *
 * This class defines all code necessary to run during the plugin's activation.
 *
 * @since      4.0.1
 * @package    WHMC
 * @subpackage WHMC/includes

 */
class WHMC_Activator {


	/**
	 * Short Description. (use period)
	 *
	 * Long Description.
	 *
	 * @since    4.0.1
	 */
	public static function activate() {

		flush_rewrite_rules();
		
		add_option('whmc_option' , '');


		update_option('whmc_option' , sanitize_text_field($_POST['whmc_option']));

	}

}
