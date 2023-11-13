<?php
/**
 * The public-facing functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the public-facing stylesheet and JavaScript.
 *
 * @package    WHMC_PRO
 * @subpackage WHMC_PRO/class
 * @author     Sharabindu <sharabindu86@gmail.com>
 */
class WhmcLicenceFile extends WhmcfileGenerator
{

    public function __construct()
    {

        add_action('admin_init', array(
            $this,
            'my_custom_admin_head'
        ));

        parent::__construct();
        add_action('admin_notices', array(
                $this,'general_admin_notice'));
    }

    function general_admin_notice(){
            $this->options;
        $opuiosngshgd = $this->options_value;

        if($opuiosngshgd != $this->vausropiokss){
         echo '<div class="notice notice-warning is-dismissible">
             <p>Please activate the license key of the <b>"Woo Header Mini Cart"</b> plugin <a href="'.admin_url('/').'admin.php?page=whmc_menu&tab=licence#!tabset_0=4">Activate Now</a></p>
         </div>';
    
      }
    }
    function my_custom_admin_head()
    {
        register_setting("Whmc_licenece_general", "Whmc_licenece_general", array(
            $this,
            'qr_log_option_page_sanitize'
        ));

        add_settings_section("Whmc_liolicence_options_section", " ", array() , 'Whmc_licenece_optionadmin_sec');

        add_settings_field("Whmc_liolicence_key", esc_html__("Licence Key", "whmc") , array(
            $this,
            "Whmc_liolicence_key"
        ) , 'Whmc_licenece_optionadmin_sec', "Whmc_liolicence_options_section");

    }

    /**
     * This function is a callback function of  add seeting field
     */

    public function Whmc_liolicence_key()
    {

        $this->options = get_option('Whmc_licenece_general');
        $options_value = isset($this->options['Whmc_liolicence_key']) ? $this->options['Whmc_liolicence_key'] : '';
        $vausropiokss = $this->vausropiokss;
        if ($options_value != $vausropiokss)
        {

            $options_value = '';
            $erroes = '<p style="color:#f50606">This license key is invalid,</p>';
            $erroes_value = '<span style="color:#f50606;" class="dashicons dashicons-dismiss" id="spanicons45"></span>';
        }
        else
        {
            $erroes = '<p style="color:#00ab00">License activated</p>';
            $options_value = bin2hex($vausropiokss);
            $erroes_value = '<span style="color:#2ecb2e;" class="dashicons dashicons-yes-alt" id="spanicons45"></span>';
        }
        printf('<input type="text" id="qwe_sizw" name="Whmc_licenece_general[Whmc_liolicence_key]"   value="%s" placeholder="xxxx-xxxx-xxxx-xxxx-xxxx" class="widefat">' . $erroes_value . $erroes . '', $options_value);

    }


    public function qr_log_option_page_sanitize($input)
    {
        $sanitary_values = array();
        if (isset($input['Whmc_liolicence_key']))
        {
            $sanitary_values['Whmc_liolicence_key'] = sanitize_text_field($input['Whmc_liolicence_key']);
        }
        return $sanitary_values;
    }

}

if (class_exists('WhmcLicenceFile'))
{
    new WhmcLicenceFile;
};

