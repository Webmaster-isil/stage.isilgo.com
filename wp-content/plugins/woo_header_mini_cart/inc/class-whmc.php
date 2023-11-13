<?php

/**
 * The file that defines the core plugin class
 *
 * A class definition that inc attributes and functions used across both the
 * public-facing side of the site and the admin area.
 *
 * @since      4.0.1
 *
 * @package    WHMC
 * @subpackage WHMC/inc
 */

/**
 * The core plugin class.
 *
 * This is used to define internationalization, admin-specific hooks, and
 * public-facing site hooks.
 *
 * Also maintains the unique identifier of this plugin as well as the current
 * version of the plugin.
 *
 * @since      4.0.1
 * @package    WHMC
 * @subpackage WHMC/inc
 */
class WHMC {

	/**
	 * The loader that's responsible for maintaining and registering all hooks that power
	 * the plugin.
	 *
	 * @since    4.0.1
	 * @access   protected
	 * @var      WHMC_Loader    $loader    Maintains and registers all hooks for the plugin.
	 */
	protected $loader;

	/**
	 * The unique identifier of this plugin.
	 *
	 * @since    4.0.1
	 * @access   protected
	 * @var      string    $plugin_name    The string used to uniquely identify this plugin.
	 */
	protected $plugin_name;

	/**
	 * The current version of the plugin.
	 *
	 * @since    4.0.1
	 * @access   protected
	 * @var      string    $version    The current version of the plugin.
	 */
	protected $version;

	/**
	 * Define the core functionality of the plugin.
	 *
	 * Set the plugin name and the plugin version that can be used throughout the plugin.
	 * Load the dependencies, define the locale, and set the hooks for the admin area and
	 * the public-facing side of the site.
	 *
	 * @since    4.0.1
	 */
	public function __construct() {
		if ( defined( 'WHMC_VERSION' ) ) {
			$this->version = WHMC_VERSION;
		} else {
			$this->version = '4.0.1';
		}
		$this->plugin_name = 'WHMC';

		$this->load_dependencies();
		$this->set_locale();
		$this->define_admin_hooks();
		$this->define_public_hooks();		
		$this->plugin_name = new WHMC_Cart();
	}

	/**
	 * Load the required dependencies for this plugin.
	 *
	 * Include the following files that make up the plugin:
	 *
	 * - WHMC_Loader. Orchestrates the hooks of the plugin.
	 * - WHMC_i18n. Defines internationalization functionality.
	 * - WHMC_Admin. Defines all hooks for the admin area.
	 * - WHMC_Public. Defines all hooks for the public side of the site.
	 *
	 * Create an instance of the loader which will be used to register the hooks
	 * with WordPress.
	 *
	 * @since    4.0.1
	 * @access   private
	 */
	private function load_dependencies() {

		
		require_once WHMC_PATH . 'inc/class-whmc-updatecheaker.php';
				require_once WHMC_PATH . 'admin/class-whmc-filesgenerator.php';
		require_once WHMC_PATH . 'admin/class-whmc-licencefile.php';

		require_once WHMC_PATH . 'inc/class-whmc_cart.php';

		require_once WHMC_PATH . 'public/class-whmc-ajax-cart.php';
		require_once WHMC_PATH . 'public/frontend/class-whmc-fragments.php';

		require_once WHMC_PATH . 'public/class-whmc-shortcode.php';
		require_once WHMC_PATH . 'public/frontend/class-whmc-frontend.php';
		/**
		 * The class responsible for orchestrating the actions and filters of the
		 * core plugin.
		 */
		require_once WHMC_PATH . 'inc/class-whmc-loader.php';
		
		require_once WHMC_PATH . 'inc/class-whmc-couponmedia.php';

		/**
		 * The class responsible for defining internationalization functionality
		 * of the plugin.
		 */
		require_once WHMC_PATH . 'inc/class-whmc-i18n.php';

		/**
		 * The class responsible for defining all actions that occur in the admin area.
		 */
		require_once WHMC_PATH . 'admin/class-whmc-admin.php';

		/**
		 * The class responsible for defining all actions that occur in the public-facing
		 * side of the site.
		 */
		require_once WHMC_PATH . 'public/class-whmc-public.php';

		/**
		 * The class responsible for defining all actions that occur in the menu in plugin
		 * side of the site.
		 */

		require_once WHMC_PATH . 'inc/class-whmc-in-menus.php';

        require_once WHMC_PATH . 'admin/class-whmc-admin-sidepanel.php';

        require_once WHMC_PATH . 'admin/class-whmc-notofication.php';

        require_once WHMC_PATH . 'admin/class-whmc-settings.php';
		/**
		 * call WHMC_In_Menus
		 *
		 */

		WHMC_In_Menus::get_instance();
		/**
		 * The class responsible for defining all actions that occur WHMC_Loader
		
		 */

		$this->loader = new WHMC_Loader();
	
		

	}

	/**
	 * Define the locale for this plugin for internationalization.
	 *
	 * Uses the WHMC_i18n class in order to set the domain and to register the hook
	 * with WordPress.
	 *
	 * @since    4.0.1
	 * @access   private
	 */
	private function set_locale() {

		$plugin_i18n = new WHMC_i18n();

		$this->loader->add_action( 'plugins_loaded', $plugin_i18n, 'load_plugin_textdomain' );

	}

	/**
	 * Register all of the hooks related to the admin area functionality
	 * of the plugin.
	 *
	 * @since    4.0.1
	 * @access   private
	 */
	private function define_admin_hooks() {

		$plugin_admin = new WHMC_Admin( $this->get_plugin_name(), $this->get_version() );

		$this->loader->add_action( 'admin_enqueue_scripts', $plugin_admin, 'enqueue_styles' );

		$this->loader->add_action( 'admin_enqueue_scripts', $plugin_admin, 'enqueue_scripts' );

		$this->loader->add_action( 'admin_menu', $plugin_admin, 'whmc_admin_menu' );

		$this->loader->add_action( 'admin_notices', $plugin_admin, 'woo_admin_notices' );
		
		$this->loader->add_filter( 'plugin_action_links_' .plugin_basename( dirname( __DIR__ ).'/woo_header_mini_cart.php' ), $plugin_admin, 'plugin_settings_link');
		
	}

	/**
	 * Register all of the hooks related to the public-facing functionality
	 * of the plugin.
	 *
	 * @since    4.0.1
	 * @access   private
	 */
	private function define_public_hooks() {

		$plugin_public = new WHMC_Public( $this->get_plugin_name(), $this->get_version() );

		$this->loader->add_action( 'wp_enqueue_scripts', $plugin_public, 'enqueue_styles' );

		$this->loader->add_action( 'wp_enqueue_scripts', $plugin_public, 'enqueue_scripts' );

		$this->loader->add_action( 'wp_footer', $plugin_public, 'whmc_fotter_content' ,10 );


	}

	/**
	 * Run the loader to execute all of the hooks with WordPress.
	 *
	 * @since    4.0.1
	 */
	public function run() {
		$this->loader->run();
	}

	/**
	 * The name of the plugin used to uniquely identify it within the context of
	 * WordPress and to define internationalization functionality.
	 *
	 * @since     4.0.1
	 * @return    string    The name of the plugin.
	 */
	public function get_plugin_name() {
		return $this->plugin_name;
	}

	/**
	 * The reference to the class that orchestrates the hooks with the plugin.
	 *
	 * @since     4.0.1
	 * @return    WHMC_Loader    Orchestrates the hooks of the plugin.
	 */
	public function get_loader() {
		return $this->loader;
	}

	/**
	 * Retrieve the version number of the plugin.
	 *
	 * @since     4.0.1
	 * @return    string    The version number of the plugin.
	 */
	public function get_version() {
		return $this->version;
	}

}
