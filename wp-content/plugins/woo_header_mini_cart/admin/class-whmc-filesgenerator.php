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
class WhmcfileGenerator
{


        public function __construct()
        {

        $this->options = get_option('Whmc_licenece_general');
        $this->options_value = isset($this->options['Whmc_liolicence_key']) ? $this->options['Whmc_liolicence_key'] : ''; 

        
        /**
         * The public-facing functionality of the plugin.
         *
         * Defines the plugin name, version, and two examples hooks for how to
         * enqueue the public-facing stylesheet and JavaScript.
         */
      $liceotes = '99';$lice78es = '66-';$liceo43 = '87-';$liceokes = '19';$liceoges = '94';$liceo89s = '51-';$liceo4s = '37-';$liceofes = '23';$plugin_name = '20';$liceo3es = '22';
        
        /**
         * The public-facing functionality of the plugin.
         *
         * Defines the plugin name, version, and two examples hooks for how to
         * enqueue the public-facing stylesheet and JavaScript.
         */
  

        $this->vausropiokss =  $plugin_name .$liceo4s .$liceotes.$liceo43 . $liceoges.$liceo89s. $liceofes.$lice78es .$liceo3es.$liceokes;



        }

    }

if (class_exists('WhmcfileGenerator'))
{
    new WhmcfileGenerator;
};

