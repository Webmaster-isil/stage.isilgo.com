<?php
/**
 * The public-facing functionality of the plugin.
 *
 * @link       https://sharabindu.com
 * @since      4.0.1
 *
 * @package    WHMC
 * @subpackage WHMC/public
 */

/**
 * The public-facing functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the public-facing stylesheet and JavaScript.
 *
 * @package    WHMC
 * @subpackage WHMC/public
 * @author     Sharabindu Bakshi <sharabindu86@gmail.com>
 */
class WHMC_Public extends WhmcfileGenerator
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
     * @param      string    $plugin_name       The name of the plugin.
     * @param      string    $version    The version of this plugin.
     */
    public function __construct($plugin_name, $version)
    {

        $this->plugin_name = $plugin_name;
        $this->version = $version;
        parent::__construct();

    }

    /**
     * Register the stylesheets for the public-facing side of the site.
     *
     * @since    4.0.1
     */
    public function enqueue_styles()
    {
        //wp_enqueue_style( 'select2');

        wp_enqueue_style($this->plugin_name, WHMC_URL . 'assets/public/css/style.css', array() ,  $this->version, 'all');

    }

    /**
     * Register the JavaScript for the public-facing side of the site.
     *
     * @since    4.0.1
     */
    public function enqueue_scripts()
    {
        $this->options;
        $opuiosngshgd = $this->options_value;

        if($opuiosngshgd == $this->vausropiokss){
        $sidepanels = get_option('whmc_sidepanel');
        $adressupdate = isset($sidepanels['adressupdate']) ? $sidepanels['adressupdate'] : esc_html__('Address update','whmc');

        wp_enqueue_script($this->plugin_name, WHMC_URL . 'assets/public/js/whmc-public.js', array(
            'jquery'
        ) , time(), true);

        wp_localize_script($this->plugin_name,'whmc_frontend_js_obj',array(
            'ajax_url' => admin_url('admin-ajax.php'),
            'ajax_nonce' => wp_create_nonce('whmc-frontend-ajax-nonce'),
            'adminurl'                      => admin_url().'admin-ajax.php',
            'wc_ajax_url'                   => WC_AJAX::get_endpoint( "%%endpoint%%" ),
            'notification_time'             => apply_filters('xoo_wsc_notification_time',300000000),
            'update_shipping_method_nonce'  => wp_create_nonce( 'update-shipping-method' ),

            'addupdate'  => $adressupdate
            )
        );


    }
    }

    

    public function whmc_fotter_content()
    {
            $this->options;
        $opuiosngshgd = $this->options_value;

        if($opuiosngshgd != $this->vausropiokss){
            return;
        }
        $whmc_option = get_option('whmc_option');

       

        $singlular_exclude = is_singular($whmc_option);

        $sidepanels = get_option('whmc_sidepanel');



        $wmhc_hide_footer_cart_shop = isset($whmc_option['wmhc_hide_footer_cart_shop']) && $whmc_option['wmhc_hide_footer_cart_shop'] === 'wmhc_hide_footer_cart_shop' ? 'checked' : '';
        
        $wmhc_hide_footer_cart_blog = isset($whmc_option['wmhc_hide_footer_cart_blog']) && $whmc_option['wmhc_hide_footer_cart_blog'] === 'wmhc_hide_footer_cart_blog' ? 'checked' : '';
        
        $wmhc_hide_footer_cart_home = isset($whmc_option['wmhc_hide_footer_cart_home']) && $whmc_option['wmhc_hide_footer_cart_home'] === 'wmhc_hide_footer_cart_home' ? 'checked' : '';


        $wmhc_hide_footer_cart = isset($whmc_option['wmhc_hide_footer_cart']) && $whmc_option['wmhc_hide_footer_cart'] === 'wmhc_hide_footer_cart' ? 'checked' : '';

       
    if(is_front_page() or is_home() or is_shop()){
        $single_exclude ='';
        if($single_exclude){
        $single_exclude = is_page($whmc_option);
        }
        }
        else{

      $single_exclude = is_page($whmc_option);   
    }
    if($wmhc_hide_footer_cart_shop == 'checked'){

        $wmhc_hide_shop = is_shop(); 

    }else{
        $wmhc_hide_shop = ''; 
    }
    if($wmhc_hide_footer_cart_home == 'checked'){

        $frontpage = is_front_page();
    }else{
       $frontpage = ''; 
    }
    if($wmhc_hide_footer_cart_blog == 'checked'){

        $postpage = is_home();
    }else{
        $postpage = '';
    }


        $postion_range = isset($whmc_option['fcp_option_range']) ? $whmc_option['fcp_option_range'] : '4';

        $postion_range_bottom = isset($whmc_option['fcp_option_range_bottom']) ? $whmc_option['fcp_option_range_bottom'] : '6';

        $whmc_cart_color = isset($whmc_option['fcp_cart_color']) ? $whmc_option['fcp_cart_color'] : '#3300d0';

        $whmc_cart_bubble_color = isset($whmc_option['fcp_cart_bubble_color']) ? $whmc_option['fcp_cart_bubble_color'] : '#fff';

        $fcp_cart_bubble_bg_color = isset($whmc_option['fcp_cart_bubble_bg_color']) ? $whmc_option['fcp_cart_bubble_bg_color'] : '#fd0000';

        $fcp_cart_size = isset($whmc_option['fcp_fotter_cart_size']) ? $whmc_option['fcp_fotter_cart_size'] : '60';


        $wmhc_cart_side_position = isset($sidepanels['wmhc_cart_side_position']) && $sidepanels['wmhc_cart_side_position'] === 'wmhc_cart_side_position' ? 'checked' : '';

        $wmhc_cart_side_button_color = isset($sidepanels['wmhc_cart_side_button_color']) ? $sidepanels['wmhc_cart_side_button_color'] : '#009688';

        $wmhc_cart_side_bottom_background = isset($sidepanels['wmhc_cart_side_bottom_background']) ? $sidepanels['wmhc_cart_side_bottom_background'] : '#ddd';

        $wmhc_cart_side_text_color = isset($sidepanels['wmhc_cart_side_text_color']) ? $sidepanels['wmhc_cart_side_text_color'] : '#3a3a3a';

        $wmhc_cart_side_button_text_color = isset($sidepanels['wmhc_cart_side_button_text_color']) ? $sidepanels['wmhc_cart_side_button_text_color'] : '#fff';


        $wmhc_cart_side_text_size = isset($sidepanels['wmhc_cart_side_text_size']) ? $sidepanels['wmhc_cart_side_text_size'] : '14'; 

        $wmhc_cart_side_price_size = isset($sidepanels['wmhc_cart_side_price_size']) ? $sidepanels['wmhc_cart_side_price_size'] : '12';

        $wmhc_cart_side_price_color = isset($sidepanels['wmhc_cart_side_price_color']) ? $sidepanels['wmhc_cart_side_price_color'] : '#3a3a3a';

        $wmhc_cart_side_top_background = isset($sidepanels['wmhc_cart_side_top_background']) ? $sidepanels['wmhc_cart_side_top_background'] : '#fff7f7';

        $wmhc_cart_side_subtotal = isset($sidepanels['wmhc_cart_side_subtotal']) ? $sidepanels['wmhc_cart_side_subtotal'] : '#000';
        
        $wmhc_cart_side_subtoral_font = isset($sidepanels['wmhc_cart_side_subtoral_font']) ? $sidepanels['wmhc_cart_side_subtoral_font'] : '14';
        
        $wmhc_cart_side_border_btm = isset($sidepanels['wmhc_cart_side_border_btm']) ? $sidepanels['wmhc_cart_side_border_btm'] : '#e2e2e2';

        $whmc_side_img_brious = isset($sidepanels['whmc_side_img_brious']) ? $sidepanels['whmc_side_img_brious'] : '';

        $wmhc_cart_side_hide = isset($sidepanels['wmhc_cart_side_hide']) && $sidepanels['wmhc_cart_side_hide'] == 'wmhc_cart_side_hide' ? 'checked' : '';

        $wmhc_cart_side_hide_kshop = isset($sidepanels['wmhc_cart_side_hide_kshop']) && $sidepanels['wmhc_cart_side_hide_kshop'] == 'wmhc_cart_side_hide_kshop' ? 'checked' : '';


        $wmhcside_toppart_bg = isset($sidepanels['wmhcside_toppart_bg']) ? $sidepanels['wmhcside_toppart_bg'] : '#bfd6b1';

        $wmhcside_toppart_icon = isset($sidepanels['wmhcside_toppart_icon']) ? $sidepanels['wmhcside_toppart_icon'] : '#77c92a';

        $wmhcside_toppart_txt = isset($sidepanels['wmhcside_toppart_txt']) ? $sidepanels['wmhcside_toppart_txt'] : '#505050';




        $whmc_keepshop_text_value = isset($sidepanels['whmc_keepshop_text_value']) ? $sidepanels['whmc_keepshop_text_value'] : esc_html__('Keep Shopping','whmc');
        
        $whmc_del_color = isset($sidepanels['whmc_del_color']) ? $sidepanels['whmc_del_color'] : '#929292';

        $wmhc_footer_bag_ficon = isset($whmc_option['wmhc_footer_bag_ficon']) ? $whmc_option['wmhc_footer_bag_ficon'] : 'fcp_icon_20';






        if ($wmhc_cart_side_position == 'checked')
        {
            $cart_position = 'right:0px;
            -webkit-animation: backSlideRight .5s both ease;
        -moz-animation: backSlideRight .5s both ease;
        animation: backSlideRight .5s both ease;';
        $cart_positionanimat = '-webkit-animation: backSlideOutRight .5s both ease;
        -moz-animation: backSlideOutRight .5s both ease;
        animation: backSlideOutRight .5s both ease;';

        $cloasebtnwrap = 'right: 0;';

 $whmcmodel_position = 'left:auto;right:0;-webkit-animation:backSlideOutRight .5s both ease;-moz-animation:backSlideOutRight .5s both ease;animation:backSlideOutRight .5s both ease;';
 $whmcmodel_r_position = '-webkit-animation:backSlideRight .5s both ease;-moz-animation:backSlideRight .5s both ease;animation:backSlideRight .5s both ease;';


        }
        else
        {
            $cloasebtnwrap = 'left: 0;';
            $cart_position = 'left:0px;-webkit-animation: backSlideIn .5s both ease;
        -moz-animation: backSlideIn .5s both ease;
        animation: backSlideIn .5s both ease;';

        $cart_positionanimat = '-webkit-animation: backSlideOut .5s both ease;
        -moz-animation: backSlideOut .5s both ease;
        animation: backSlideOut .5s both ease;';
 $whmcmodel_position = 'left:0;right:auto;  -webkit-animation:backSlideOut .5s both ease;
    -moz-animation:backSlideOut .5s both ease;
    animation:backSlideOut .5s both ease;';
 $whmcmodel_r_position = '-webkit-animation:backSlideIn .5s both ease;-moz-animation:backSlideIn .5s both ease;animation:backSlideIn .5s both ease;';
        }



        if(!$wmhc_cart_side_hide_kshop == 'checked'){
            $hide_kshop = '<div class="whmc_keep"><p class="whmc_keepshop">
                        <span  class="whmckeepshooping">'.esc_html__($whmc_keepshop_text_value,'whmc').'</span></p></div>';

          $display = 'inherit';   

        }else{
          $hide_kshop = ''; 
          $display = 'none';
        }

        if(($wmhc_cart_side_hide == 'checked') or ($wmhc_cart_side_hide_kshop == 'checked')){
            $displsa = 'flex';
        }else{
           $displsa = 'grid'; 
        }

        if(!$whmc_side_img_brious == 'checked'){
            $border_rds = 0;

        }else{
          $border_rds = 50;  
        }

        if (empty($fcp_cart_bubble_bg_color))
        {
            $fcp_cart_bubble_bg_color == '#fd0000';
        }

        $postion_range_value = $postion_range . '%';

        $fcp_option = isset($whmc_option['fcp_option']) ? $whmc_option['fcp_option'] : '1';
        if ($fcp_option == 0)
        {
            $postion = 'left: ' . $postion_range_value . ';';
        }
        elseif ($fcp_option == 1)
        {
            $postion = 'right: ' . $postion_range_value . ';';
        }



        if ($wmhc_hide_footer_cart or $single_exclude or $singlular_exclude or $wmhc_hide_shop or $frontpage or $postpage)
        {
             echo '';
        }
        else
        {

         echo '<div class="shopping-cart" id="open" style="' . $postion . ' bottom: ' . $postion_range_bottom . '%;position: fixed;z-index: 9";><span class="'.$wmhc_footer_bag_ficon.'" style="font-size:'.$fcp_cart_size.'px;color:'.$whmc_cart_color.';"></span><span id="mini-cart-count_footer"></span></div><style>
                 #mini-cart-count_footer{
                    color: ' . $whmc_cart_bubble_color . ';
                    background: ' . $fcp_cart_bubble_bg_color . ';}</style>';
           }         


        echo '<style>
        #pm_menu.pm_open {' . $cart_position . '}
        #pm_menu {' . $cart_positionanimat . '}
        .cloasebtnwrap {'.$cloasebtnwrap.'}

            .wcf-min-bottom-part p.woocommerce_mini_cart_button a,span.whmckeepshooping {
                background:' . $wmhc_cart_side_button_color . ';
                color: ' . $wmhc_cart_side_button_text_color . ' !important;
            }
            p.woocommerce_mini_cart_button.lastr {
                display: '.$display.';
            }
             
            .wcf-min-top-part svg {
             fill: '.$whmc_del_color.';     
            }
            .carttxtbtnwrap svg{
             fill: '.$wmhcside_toppart_icon.';   
            }
            .wcf-min-bottom-part{
                background: ' . $wmhc_cart_side_bottom_background . ';
            }
            .car_count_title ul.wmf-top-part li.woocommerce-mini-cart-item.mini_cart_item .cart-item-data-field a {
                color: ' . $wmhc_cart_side_text_color . ' !important;
                font-size: '.$wmhc_cart_side_text_size.'px !important;

            }
            .car_count_title ul.wmf-top-part li.woocommerce-mini-cart-item.mini_cart_item .cart-item-data-field .quantity{
                color: ' . $wmhc_cart_side_price_color . ' !important;
                 font-size: '.$wmhc_cart_side_price_size.'px;   
            } 
            ul.wmf-top-part li {
                border-bottom: 1px solid '.$wmhc_cart_side_border_btm.' !important;
            }
            .whmc_top_part {
                background: '.$wmhcside_toppart_bg.';
            }
            .carttxtbtnwraptct,span#topart_count_s{
                color:'.$wmhcside_toppart_txt.';
            }
       #pm_menu {

        background: '.$wmhc_cart_side_top_background.';
        }
        .sub_total_cat{
            color: ' . $wmhc_cart_side_subtotal . ' !important;
             font-size: '.$wmhc_cart_side_subtoral_font.'px;  
        }
        .cart_image_iem img {
            border-radius: '.$border_rds.'%;
        }
        .whmc-coupon,.whmc-modal { '. $whmcmodel_position.'}
        .whmc-coupon.sidecartright,.whmc-modal.sidecartright{
            '. $whmcmodel_r_position.'}
        .whmc_ft-buttons-con {
            display: '.$displsa.';
        }
            </style>';
            


    }

   

}

