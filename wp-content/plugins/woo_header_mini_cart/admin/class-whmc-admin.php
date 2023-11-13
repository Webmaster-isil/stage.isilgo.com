<?php
/**
 * The admin-specific functionality of the plugin.
 *
 * @since      4.0.1
 *
 * @package    WHMC
 * @subpackage WHMC/admin
 */

class WHMC_Admin
{

    /**
     * The ID of this plugin.
     *
     * @since    4.0.1
     * @access   private
     * @var      string    $plugin_name    The ID of this plugin.
     */
    private $plugin_name;

    /**
     * The version of this plugin.
     *
     * @since    4.0.1
     * @access   private
     * @var      string    $version    The current version of this plugin.
     */
    private $version;

    /**
     * Initialize the class and set its properties.
     *
     * @since    4.0.1
     * @param      string    $plugin_name       The name of this plugin.
     * @param      string    $version    The version of this plugin.
     */
    public function __construct($plugin_name, $version)
    {

        $this->plugin_name = $plugin_name;
        $this->version = $version;

        define('WHMC_PAGE_ID', 'whmc_menu');

        add_action('admin_enqueue_scripts', array(
            $this,
            'whmc_admin_theme_style'
        ));

        add_action('login_enqueue_scripts', array(
            $this,
            'whmc_admin_theme_style'
        ));


    }


    public function whmc_admin_theme_style()
    {


    if ( sanitize_title(isset($_GET['page'])) && strpos((sanitize_title($_GET['page'])), WHMC_PAGE_ID) !== false) {

            echo '<style>.update-nag,.updated,.notice.notice-info{ display: none !important; }.notice.notice-success.settings-error {display: block}</style>';
        }
    }

    /**
     * Register the stylesheets for the admin area.
     *
     * @since    4.0.1
     */
    public function enqueue_styles()
    {

        wp_enqueue_style("fonticonpicker", WHMC_URL . 'assets/admin/css/jquery.fonticonpicker.min.css', array() , $this->version, 'all');
        wp_enqueue_style($this->plugin_name, WHMC_URL . 'assets/admin/css/admin.css', array() , $this->version, 'all');
        wp_enqueue_style('wp-color-picker');
    }

    /**
     * Register the JavaScript for the admin area.
     *
     * @since    4.0.1
     */
    public function enqueue_scripts()
    {

    wp_enqueue_script("jquery-fonticonpicker", WHMC_URL . 'assets/admin/js/jquery.fonticonpicker.min.js', array('jquery',) ,  $this->version, true);

    wp_enqueue_script("jquery-bbq", WHMC_URL . 'assets/admin/js/jquery.bbq.min.js', array('jquery',) ,  $this->version, true);
        wp_enqueue_script('wp-color-picker');
        wp_enqueue_media();
        wp_enqueue_script('whmc-media-js', WHMC_URL . 'assets/admin/js/media.js', array('jquery') , $this->version, true);
        wp_enqueue_script($this->plugin_name, WHMC_URL . 'assets/admin/js/whmc-admin.js', array('jquery') , $this->version, true);

    }

    /**
     * Setting link.
     *
     * @since    4.0.1
     */

    public function plugin_settings_link($links)
    {
        if (class_exists("WooCommerce"))
        {
            return array_merge(array(
                '<a href="' . admin_url('admin.php?page=whmc_menu') . '">' . esc_html__('Settings', 'whmc') . '</a>',
            ) , $links);
        }
        else
        {
            return $links;
        }
    }

    /**
     * Admin Notice
     *
     * @since    4.0.1
     */

    function woo_admin_notices()
    {

        if (!class_exists('WooCommerce'))
        {

            echo '<div class="error">
        <p>' . esc_html__('Woo Header Minicart Plugin is activated but not effective. It requires WooCommerce in order to work', 'whmc') . '</p>
        </div>';
        }

    }

    public function whmc_admin_menu()
    {

        add_submenu_page('woocommerce', esc_html__('Woo Header Mini Cart ','whmc'), esc_html__('Woo Header Mini Cart ','whmc'), 'manage_options', 'whmc_menu', array(
            $this,
            'whmc_menu_func'
        ));

    }

    /**
     * Whmc Optin page admin form
     */

    public function whmc_menu_func()
    { ?>

        <div>
            <div class="whmc_tirmoof_admin_wrapper">
                <ul class="whmc__nav_bar">

                    <li><a href="https://sharabindu.com/plugins/woo-header-mini-cart/" target="_blank"><?php echo esc_html__('Plugin Page', 'whmc') ?></a></li>
                    <li><a href="https://woominicart.sharabindu.com/docs/introduction/" target="_blank"><?php echo esc_html__('Docs', 'whmc') ?></a></li>

                    <li><a href="https://woominicart.sharabindu.com/" target="_blank"><?php echo esc_html__('Demo', 'whmc') ?></a></li>

                    <li><a href="https://sharabindu.com/contact-us/" target="_blank"><?php echo esc_html__('Support', 'whmc') ?></a></li>

                    <li><a href="https://sharabindu.com/plugins/" target="_blank"><?php echo esc_html__('Our More Plugin', 'whmc') ?></a></li>

                    <li><a href=" <?php echo admin_url('/');?>admin.php?page=whmc_menu&tab=licence"><?php echo esc_html__('Licence', 'whmc') ?></a></li>
                </ul>
                <ul  class="whmc_hdaer_cnt">
                    <li> <img src=" <?php echo WHMC_URL . 'assets/admin/img/mnin.png' ?>" alt="Logo"></li>

                    <li  class="whmc_fd_cnt"> 
                        <h3><?php echo esc_html__('Woo Header Mini Cart ', 'whmc')?><small>- <?php echo  WHMC_VERSION;?></small></h3>
                <small><?php echo esc_html__('Increase sales of products and services', 'whmc') ?></small></li>
                </ul>
            </div>

            <div class="WHMCProsoComosebox">
                              
            <ul class="whmc_tab_dwn at-tabs-when-possible bbq clearfix at-accordion-or-tabs at-tabs ">

              <li>
           
                 <a class="whmcadminlink"><?php echo esc_html__('Menu Cart & Footer Cart ', 'whmc') ?></a>  
              <section>        
            <form method="post" action="options.php" class="whmc_menucart"> 
        <?php
            settings_fields("whmc_option");

            do_settings_sections('whmc_admin_sec');

            ?>
             <button type ="submit" id="osiudi" class="button button-primary"><?php echo esc_html__('Save Changes','whmc') ?> <span class="whmc_sdhicrt"></span></button>
                <span class="whmcr_djkfhjhj"></span>
                </form>
            </section>
        </li>
         <li>
            <a class="whmcadminlink"><?php echo esc_html__("Sidebar Settings", "whmc") ?></a>
                 <section>  
               <form method="post" action="options.php" class="whmc_sidebarsfrm" >
                <?php 
            settings_fields('whmc_sidepanel');
            do_settings_sections('whmc_admin_sec_sidepanel');
            ?>
                  <button type ="submit" id="osiudi" class="button button-primary"><?php echo esc_html__('Save Changes','whmc') ?> <span class="whmcsidebars_sdhi"></span></button><span class="whmcsidebars_djkfhjhj"></span>
                </form>
            </section>
        </li>

       <li>
            <a class="whmcadminlink"><?php echo esc_html__("Notification box", "whmc") ?></a>
                 <section>  
               <form method="post" action="options.php" class="whmc-notificabox" >
            <?php
            settings_fields('whmc_notification');
            do_settings_sections('whmc_admin_sec_notification');
            ?>
                  <button type ="submit" id="osiudi" class="button button-primary"><?php echo esc_html__('Save Changes','whmc') ?> <span class="whmcnotific_sdhi"></span></button>
         <span class="whmcnotific_djkfhjhj"></span>
         </form>
        </section>
     </li>
      <li>
    <a  class="whmcadminlink"><?php echo esc_html__('Licence', 'whmc') ?></a>
                 <section>
            <form method="post" action="options.php" class="whmc_licsbocs" >     <?php
        echo '<div class="sharlicenkey-feature"><ul><p style="text-align:center">'.esc_html__("Please go to", "whmc").'<a href="https://sharabindu.com/my-account/licence/">'.esc_html__(' My account page', 'whmc').'</a>' .esc_html__(' and collect the license key', 'whmc').'</p>';

        settings_fields("Whmc_licenece_general");

        do_settings_sections('Whmc_licenece_optionadmin_sec');
        ?>
        <button type ="submit" id="osiudi" class="button button-primary"><?php echo esc_html__('Save Changes','whmc') ?> </button>

         </form>



            </section>
        </li>

        </ul> 
        </div>
    </div>
        <?php
    } // end sandbox_theme_display
    

    
}

