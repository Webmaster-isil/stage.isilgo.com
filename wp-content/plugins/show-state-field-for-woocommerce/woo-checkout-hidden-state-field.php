<?php

/**
 * Plugin Name:		  Show State Field for WooCommerce
 * Plugin URI:		  https://woo.hirewebxperts.com/
 * Description:		  Show State Field for WooCommerce provides you to flexibility to show hidden state field for some countries which are hidden by WooCommerce.
 * Version: 		  1.1
 * Author: 			  Coder426
 * Text Domain: 	  woo-show-state-field
 * Author URI:		  https://www.hirewebxperts.com
 * License:           GPLv2 or later
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 */

/*
**define plugin paths
*/
define('WCHSF_VAR', '1.1');
define('WCHSF_NAME', 'woo-show-state-field');
define('WCHSF_PLUGIN_URL', plugin_dir_url(__FILE__));
define('WCHSF_PLUGIN_DIR', dirname(__FILE__));
define('WCHSF_ASSETS', WCHSF_PLUGIN_URL . 'assets/');
define('WCHSF_IMG', WCHSF_PLUGIN_URL . 'assets/img/');
define('WCHSF_INC', WCHSF_PLUGIN_DIR . '/include/');
define('WCHSF_INC_URL', WCHSF_PLUGIN_URL . '/include/');

if (!defined('ABSPATH')) {
	exit; // exit if accessed directly    
}

//Setting link to pluign
add_filter('plugin_action_links_' . plugin_basename(__FILE__), 'wchsf_add_plugin_page_settings_link');
function wchsf_add_plugin_page_settings_link($links)
{
	$links[] = '<a href="' . admin_url('admin.php?page=woo-show-state-field') . '">' . __('Settings') . '</a>';
	return $links;
}

/**
 **Include css js files
 */

if (isset($_REQUEST['page'])) {
	if (!function_exists('wchsf_add_admin_scripts')  && ($_REQUEST['page'] == 'woo-show-state-field')) {
		function wchsf_add_admin_scripts()
		{
			/** 
			 ** Admin Dashboard Style
			 **/
			wp_enqueue_style(WCHSF_NAME . '_fontawesome_min', WCHSF_ASSETS . 'libs/fontawesome/all.css', array(), WCHSF_VAR);
			wp_enqueue_style(WCHSF_NAME . '_bootstrap_min', WCHSF_ASSETS . 'libs/bootstrap/css/bootstrap.min.css', array(), WCHSF_VAR);
			wp_enqueue_style(WCHSF_NAME . '_admin', WCHSF_ASSETS . 'css/wchsf-admin.css', array(), WCHSF_VAR);

			/** 
			 ** Admin Dashboard Script
			 **/
			wp_enqueue_script('jquery');
			wp_enqueue_script('jquery-ui-tabs');
			wp_enqueue_script(WCHSF_NAME . '_popper', WCHSF_ASSETS . 'libs/popper/popper.min.js', array('jquery'), WCHSF_VAR, true);
			wp_enqueue_script(WCHSF_NAME . '_bootstrap_min', WCHSF_ASSETS . 'libs/bootstrap/js/bootstrap.min.js', array('jquery'), WCHSF_VAR, true);
			wp_enqueue_script(WCHSF_NAME . '_admin', WCHSF_ASSETS . 'js/wchsf-admin.js', array('jquery'), WCHSF_VAR, true);
			$admin_url = strtok(admin_url('admin-ajax.php', (is_ssl() ? 'https' : 'http')), '?');
			wp_localize_script(WCHSF_NAME . '_admin', 'MyAjax', array(
				'ajaxurl' => $admin_url,
				'no_export_data' => 'There are no exporting data in your selection fields',
				'ajax_public_nonce' => wp_create_nonce('ajax_public_nonce'),
			));
		}
		add_action('admin_enqueue_scripts', 'wchsf_add_admin_scripts');
	}
}

/**
 **Create wchsf menu
 */
add_action('admin_menu', 'wchsf_admin_menu');
if (!function_exists('wchsf_admin_menu')) {
	function wchsf_admin_menu()
	{
		$menu_slug = 'woo-show-state-field';
		add_submenu_page(
			'woocommerce',
			__('Show State Field for WooCommerce', 'woo-show-state-field'),
			__('WCHSF', 'woo-show-state-field'),
			'manage_woocommerce',
			'woo-show-state-field',
			'wchsf_admin_menu_output_html'
		);
	}
}

/**
 **Create wchsf sub-menu
 */
if (!function_exists('wchsf_admin_menu_output_html')) {
	function wchsf_admin_menu_output_html()
	{

		// Setting Save
		if (isset($_POST["wchsf-nonce"]) && wp_verify_nonce($_POST["wchsf-nonce"], basename(__FILE__))) {
			$s_save = false;
			if (isset($_GET) && !empty($_GET['page']) && $_GET['page'] == 'woo-show-state-field') {
				$nonce = $_POST['wchsf-nonce'];
				$final_settings = array();
				if (isset($_POST['wchsf_setting']) && !empty($_POST['wchsf_setting']) && is_array($_POST['wchsf_setting']['wchsf_countries'])) {

					// sanitize text field
					if (!empty($_POST['wchsf_setting']['wchsf_countries'])) {
						$final_settings['wchsf_countries'] = array_map("sanitize_text_field", $_POST['wchsf_setting']['wchsf_countries']);
					}

					$finaldata['wchsf_setting'] = $final_settings;
					update_option('_wchsf_settings', $finaldata);
				} else {
					update_option('_wchsf_settings', '');
				}

				$s_save = true;
			} // end if isset($_GET)       
		}

		$settings = get_option('_wchsf_settings');
		if (isset($settings['wchsf_setting']) && !empty($settings['wchsf_setting']) && is_array($settings['wchsf_setting'])) {
			$settings = $settings['wchsf_setting'];
		}

		$countries = array('AF', 'AX', 'AT', 'BH', 'BE', 'BJ', 'BG', 'BI', 'CY', 'CZ', 'DE', 'DK', 'EE', 'ES', 'FI', 'FR', 'GR', 'GF', 'GP', 'HU', 'HR', 'IS', 'IM', 'IL', 'IE', 'IT', 'KW', 'KR', 'LB', 'LT', 'LK', 'LU', 'LV', 'MT', 'MQ', 'YT', 'NL', 'NO', 'PL', 'PT', 'RO', 'RE', 'SG', 'SE', 'SI', 'SK', 'VN');
		sort($countries);
		$WC_Countries = new WC_Countries();
		// 
?>
		<form class="" method="POST" id="" action="<?php echo admin_url() . 'admin.php?page=woo-show-state-field'; ?>">
			<div class="container-fluid">
				<?php
				if (isset($s_save) && !empty($s_save) && $s_save == 'true') {
				?>
					<div class="row">
						<div class="col-12 p-0">
							<div id="setting-error-settings_updated" class="notice notice-success settings-error is-dismissible mx-0 my-2">
								<p><strong><?php echo __('Settings saved', 'horizontal-slider-with-scroll'); ?>.</strong></p>
							</div>
						</div>
					</div> <?php
						}
							?>
				<div class="row">
					<div class="col-xl-3 col-md-4 col-sm-4">
						<div class="card text-dark bg-light p-0 mw-100">
							<h5 class="card-header">Show State Field For Specific Countries</h5>
							<div class="card-body">
								<div class="row">
									<div class="col-auto">
										<div class="country_drop">
											<!-- <button type="button" class="btn dropdown-toggle" data-bs-toggle="dropdown"><i class="fas fa-globe-europe"></i></button> -->
											<ul class="p-0">
												<?php
												foreach ($countries as $countrie) {
													$WC_Countries->country_exists($countrie);
													if (isset($settings['wchsf_countries'][$countrie]) && !empty($settings['wchsf_countries'][$countrie]) && is_array($settings['wchsf_countries']) && $settings['wchsf_countries'][$countrie] == 'on') {
														$checked = 'checked="checked"';
													} else {
														$checked = '';
													}
													echo '<li class="px-3"><a href="#" class="" data-bs-value="' . esc_html($countrie) . '" tabIndex="-1"><input ' . esc_html($checked) . ' id="' . esc_html($countrie) . '" type="checkbox" name="wchsf_setting[wchsf_countries][' . esc_html($countrie) . ']" />&nbsp;' . esc_html($WC_Countries->countries[$countrie]) . '</a></li>';
												}
												?>
											</ul>
										</div>
									</div>
									<div class="col-12 mt-3">
										<?php wp_nonce_field(basename(__FILE__), "wchsf-nonce"); ?>
										<button type="submit" class="btn btn-primary">Save</button>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="col-xl-8 col-md-8">
						<div class="row">
							<div class="col-xl-6">
								<div class="card text-dark bg-light p-0 mw-100">
									<h5 class="card-header">Try our other plugins</h5>
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-xl-6">
								<div class="card text-dark bg-light p-0 mw-100">
									<div class="card-body">
										<div class="row">
											<div class="col-12 mb-3">
												<a href="https://wordpress.org/plugins/woo-custom-cart-button/" target="_blank" rel="noopener noreferrer">
													<img src="<?php echo WCHSF_IMG ?>woo-custom-cart-button.jpg" alt="" class="w-100 border">
												</a>
												<div class="key_features mt-3">
													<h6><strong>KEY FEATURES...</strong></h6>
													<ul style="list-style: inherit;padding-left: 20px;">
														<li>Ability to change default add to cart button text and action on single product page.</li>
														<li>Ability to change default add to cart button text and action on the Shop page.</li>
														<li>Customize Add to Cart Button’s text, background, hover and border colors.</li>
														<li>Choose Different Button Shapes like with or without border radius.</li>
														<li>Add icon to before or after Add to Cart Button.</li>
														<li>Now, you can add different CSS3 transitions to button on hover.</li>
														<li>Also, can add CSS3 background transitions to add to cart button.</li>
														<li>Option to restrict changes only on shop page.</li>
														<li>Option to restrict changes only on single product page.</li>
														<li>You can create Multiple buttons now for each product with different links</li>
														<li>Ability to control link in new tabs.</li>
													</ul>
												</div>
												<a class="btn btn-primary" href="https://wordpress.org/plugins/woo-custom-cart-button/" role="button" target="_blank">Read More</a>
											</div>
											
										</div>
									</div>
								</div>
							</div>
							<div class="col-xl-6">
								<div class="card text-dark bg-light p-0 mw-100">
									<div class="card-body">
										<div class="row">
											<div class="col-12">
												<a href="https://wordpress.org/plugins/awesome-checkout-templates/" target="_blank" rel="noopener noreferrer">
													<img src="<?php echo WCHSF_IMG ?>awesome-checkout-templates.jpg" alt="" class="w-100 border">
												</a>
												<div class="key_features mt-3">
													<h6><strong>KEY FEATURES...</strong></h6>
													<ul style="list-style: inherit;padding-left: 20px;">
														<li>Ability to control layout of checkout pages.</li>
														<li>Ability to add custom sections in checkout page.</li>
														<li>Customize checkout template field’s labels, colors, spacing and other sytling attributes.</li>
														<li>Ability to redirect default checkout page with new checkout template.</li>
														<li>Create standalone checkout pages for specific products using shortcodes.</li>
														<li>Add product to the default tempalte.</li>
														<li>Related products section to show more products at checkout page.</li>
														<li>Add custom sections in checkout templates.</li>
														<li>Make certain checkout fields required.</li>
														<li>Separate styling for each checkout template.</li>
														<li>Dynamically add products from URL for your affiliates using URL?acout=184,176,177.</li>
														<li>Add / remove products directly from checkout page.</li>
													</ul>
												</div>
												<a class="btn btn-primary" href="https://wordpress.org/plugins/awesome-checkout-templates/" role="button" target="_blank">Read More</a>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>




					</div>

				</div>
			</div>
		</form>
<?php
	}
}

function wchsf_filter_woocommerce_states($states)
{
	$settings = get_option('_wchsf_settings');
	if (isset($settings['wchsf_setting']) && !empty($settings['wchsf_setting']) && is_array($settings['wchsf_setting'])) {
		$settings = $settings['wchsf_setting'];
	}

	if (isset($settings['wchsf_countries']) && !empty($settings['wchsf_countries']) && is_array($settings['wchsf_countries'])) {
		foreach ($settings['wchsf_countries'] as $code => $codeval) {
			unset($states[esc_html($code)]);
		}
	}
	return $states;
};
add_filter('woocommerce_states', 'wchsf_filter_woocommerce_states', 10, 1);

function wchsf_filter_woocommerce_get_country_locale($locale)
{

	$settings = get_option('_wchsf_settings');
	if (isset($settings['wchsf_setting']) && !empty($settings['wchsf_setting']) && is_array($settings['wchsf_setting'])) {
		$settings = $settings['wchsf_setting'];
	}

	if (isset($settings['wchsf_countries']) && !empty($settings['wchsf_countries']) && is_array($settings['wchsf_countries'])) {
		foreach ($settings['wchsf_countries'] as $code => $codeval) {

			$locale[esc_html($code)]['state']['required'] = true;
		}
	}
	return $locale;
};
add_filter('woocommerce_get_country_locale', 'wchsf_filter_woocommerce_get_country_locale', 10, 1);


?>