<?php 


    final class whmcShortcode extends WhmcfileGenerator
{
    /**
     * summary
     */
    public function __construct()
    {
      
      add_action( 'init', array( $this, 'whmc_register_shortcodes')); 
      parent::__construct();
    }



        public function whmc_register_shortcodes()
        {

            add_shortcode('whmc_mini_cart', array(
                $this,
                'whmc_mini_cart_func'
            ));

        }
       
        public function whmc_mini_cart_func($menu)
        {
            $this->options;
        $opuiosngshgd = $this->options_value;

        if($opuiosngshgd == $this->vausropiokss){
            $whmc_option = get_option('whmc_option');

            $header_horizontal_range = isset($whmc_option['wmhc_horizontal_position']) ? $whmc_option['wmhc_horizontal_position'] : '5';

       $fcp_icon_option = isset($whmc_option['fcp_icon_option']) ? $whmc_option['fcp_icon_option'] : 'fcp_icon_19';


            $header_vertical_range = isset($whmc_option['wmhc_vertical_position']) ? $whmc_option['wmhc_vertical_position'] : '4';

            $wmhc_header_bubble_color = isset($whmc_option['wmhc_header_bubble_color']) ? $whmc_option['wmhc_header_bubble_color'] : '#0bb100';

            $wmhc_header_text_color = isset($whmc_option['wmhc_header_text_color']) ? $whmc_option['wmhc_header_text_color'] : '#000';

              $wmhch_bubbles_color = isset($whmc_option['wmhch_bubbles_color']) ? $whmc_option['wmhch_bubbles_color'] : '#f97417';      

              $wmhch_bubbles_txt = isset($whmc_option['wmhch_bubbles_txt']) ? $whmc_option['wmhch_bubbles_txt'] : '#fff';      

           $wmhc_hide_text_color =  (isset($whmc_option['wmhc_hide_text_color']) && $whmc_option['wmhc_hide_text_color'] === 'wmhc_hide_text_color') ? 'checked' : '';

            $fcp_menu_style = isset($whmc_option['fcp_menu_cart_style']) ? $whmc_option['fcp_menu_cart_style'] : 'fcp_menu_0';


            if ($wmhc_hide_text_color)
            {
                $wmhc_hide_text_color = '';
            }
            elseif($wmhc_hide_text_color != 'checked' && ($fcp_menu_style == 'fcp_menu_2')){

             $wmhc_hide_text_color = '<span class="icon_minus"></span><span class="cart_count_total"></span>';   
            }
            else{
                $wmhc_hide_text_color = '<span class="cart_count_total"></span>';
            } 


            if ($fcp_menu_style == 'fcp_menu_3')
            {

                $fcp_menu_style_wrap = '<div class="cart_menu_li li_three" style="position:relative;top:' . $header_vertical_range . 'px;margin: 0px ' . $header_horizontal_range . 'px"><div id="menuiconwrap">
                <span class="'.$fcp_icon_option.'" id="menuiconid"></span></div>'. $wmhc_hide_text_color . '</div>';
            }

            elseif ($fcp_menu_style == 'fcp_menu_2')
            {

                $fcp_menu_style_wrap = '                        <div class="cart_menu_li li_two" style="position:relative;top:' . $header_vertical_range . 'px;margin: 0px ' . $header_horizontal_range . 'px"><div id="menuiconwrap">
                    <span class="'.$fcp_icon_option.'" id="menuiconid"></span><span class="mini-cart-count">
                    </span><span class="mini-cart-item-number"></span></div> ' . $wmhc_hide_text_color . '</div>';
            }
            elseif ($fcp_menu_style == 'fcp_menu_1')
            {

                $fcp_menu_style_wrap = '<div class="cart_menu_li" style="position:relative;top:' . $header_vertical_range . 'px;margin: 0px ' . $header_horizontal_range . 'px"><div id="menuiconwrap">
                    <span class="'.$fcp_icon_option.'" id="menuiconid"></span><span class="mini-cart-count">
                    </span></div>' . $wmhc_hide_text_color . '</div>';
            }
            else{

                $fcp_menu_style_wrap = '<div class="cart_menu_li menu-link" style="position:relative;top:' . $header_vertical_range . 'px;margin: auto ' . $header_horizontal_range . 'px"><div id="menuiconwrap" class="icons02">
                    <span class="'.$fcp_icon_option.'" id="menuiconid"></span><span class="mini-cart-count">
                    </span></div></div>';
            }

            $menu .= '
                <style>
                .cart_menu_li.li_two span.cart_count_header,span.mini-cart-item-number,.cart_menu_li span.cart_count_total,.cart_menu_li span.icon_minus{
                    color: ' . $wmhc_header_text_color . ';
                }
                span.cart_count_header{
                    background: ' . $wmhch_bubbles_color . ';
                    color:  ' . $wmhch_bubbles_txt . ';
                }
                .cart_menu_li.li_two #menuiconid,.cart_menu_li.li_three #menuiconid,.cart_menu_li #menuiconid{
                    color: ' . $wmhc_header_bubble_color . ';
                }

                </style>


                ' . $fcp_menu_style_wrap;
        }
            return $menu;

        }
}
if (class_exists('whmcShortcode'))
{
    new whmcShortcode;
};

