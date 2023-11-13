<?php
/**
 * The admin-specific functionality of the plugin.
 *
 * @since      4.0.1
 *
 * @package    WHMC
 * @subpackage WHMC/admin
 */

class Whmc_Admin_Settings
{

    public function __construct()
    {
        add_action('admin_init', array($this,'whmc__menu_setting'
        ));
    }

    /**
     * This function is Register settings,add_settings_section and add_settings_field
     */

    public function whmc__menu_setting()
    {

        register_setting("whmc_option", "whmc_option", array(
            $this,
            'whmc_option_page_sanitize'
        ));

        add_settings_section("section_setting", " ", array(
            $this,
            'settting_sec_func'
        ) , 'whmc_admin_sec');

        add_settings_field("wmhc_bag_icon_cart", esc_html__("Menu Shopping Cart", "whmc") , array(
            $this,
            "settting_sec_func_header"
        ) , 'whmc_admin_sec', "section_setting", array(
            'class' => 'whmc_footer_cart_top'
        ));

        add_settings_field("wmhc_bag_icon", esc_html__("Choose Menu Cart Icon", "whmc") , array(
            $this,"wmhc_bag_icon") , 'whmc_admin_sec', "section_setting");

        add_settings_field("wmhc_menu_cart_style", esc_html__("Choose a Design.", "whmc") , array(
            $this,
            "wmhc_menu_cart_style"
        ) , 'whmc_admin_sec', "section_setting");

        add_settings_field("wmhc_horizontal_position", esc_html__("Menu Cart icon Position", "whmc") , array(
            $this,
            "wmhc_horizontal_position"
        ) , 'whmc_admin_sec', "section_setting");

        add_settings_field("wmhc_header_bubble_color", esc_html__("Color Settings", "whmc") , array(
            $this,
            "wmhc_header_bubble_color"
        ) , 'whmc_admin_sec', "section_setting");

        add_settings_field("wmhc_hide_text_color", esc_html__("Remove Amount from the Menu Cart Icon", "whmc") , array(
            $this,
            "wmhc_hide_text_color"
        ) , 'whmc_admin_sec', "section_setting");

        add_settings_field("fcp_cart_shortcode", esc_html__("Shortcode", "whmc") , array(
            $this,
            "fcp_cart_shortcode"
        ) , 'whmc_admin_sec', "section_setting");

        add_settings_field("wmhc_footer_vart_s", esc_html__("Footer Shopping Cart", "whmc") , array(
            $this,
            "settting_sec_func_header"
        ) , 'whmc_admin_sec', "section_setting", array(
            'class' => 'whmc_footer_cart'
        ));

        add_settings_field("wmhc_footer_bag_icon", esc_html__("Choose Icon", "whmc") , array(
            $this,
            "wmhc_footer_bag_icon"
        ) , 'whmc_admin_sec', "section_setting");

        add_settings_field("wmhc_hide_footer_cart", esc_html__("Remove Icon", "whmc") , array(
            $this,
            "wmhc_hide_footer_cart"
        ) , 'whmc_admin_sec', "section_setting");

        add_settings_field("fcp_fotter_cart_size", esc_html__("Icon Size", "whmc") , array(
            $this,
            "fcp_fotter_cart_size"
        ) , 'whmc_admin_sec', "section_setting");

        add_settings_field("fcp_option", esc_html__("Icon Loaction", "whmc") , array(
            $this,
            "fcp_option_func"
        ) , 'whmc_admin_sec', "section_setting");

        add_settings_field("fcp_option_range", esc_html__("Footer Cart Icon Position", "whmc") , array(
            $this,
            "fcp_option_range"
        ) , 'whmc_admin_sec', "section_setting");

        add_settings_field("fcp_cart_color", esc_html__("Color Seting", "whmc") , array(
            $this,
            "fcp_cart_color"
        ) , 'whmc_admin_sec', "section_setting");


        add_settings_field("fcp_cart_loactionds", esc_html__("Hide Footer Cart icon", "whmc") , array(
            $this,
            "fcp_cart_loactionds"
        ) , 'whmc_admin_sec', "section_setting");

    }

    function fcp_cart_loactionds(){
        $pblog = get_option('page_for_posts');
        $pfront = get_option('page_on_front');
        $pshop = get_option('woocommerce_shop_page_id');
    $yoo_type_pages = get_posts(array(
            'post_type' => 'page',
            'posts_per_page' => - 1,
            'post__not_in' => array(
                $pblog,
                $pshop,
                $pfront
            )
        ));
        if ($yoo_type_pages)
        {
            echo '<strong>
        <label for="yoo_type_pages"> '.esc_html__(' Pages:','whmc').'</label></strong><div id="pagesnumbers" class="pagesnumberssd">';
            foreach ($yoo_type_pages as $yoo_type_page){

        $options = get_option('whmc_option');

            $checked = isset($options[$yoo_type_page->ID]) ? 'checked' : '';

            printf('<div><input type="checkbox" id="%s"  value="%s" name="whmc_option[%s]" %s><label for ="%s" ><strong>' . $yoo_type_page->post_title . '</strong></label></div>', $yoo_type_page->ID, $yoo_type_page->ID, $yoo_type_page->ID, $checked,$yoo_type_page->ID);


        }
        printf('</div><div class="spciappage"><div><input type="checkbox" name="whmc_option[wmhc_hide_footer_cart_home]"   value="wmhc_hide_footer_cart_home" %s><strong>'.esc_html__('Front Page','whmc').'</strong></label></div>', (isset($options['wmhc_hide_footer_cart_home']) && $options['wmhc_hide_footer_cart_home'] === 'wmhc_hide_footer_cart_home') ? 'checked' : '');

        printf('<div><input type="checkbox" name="whmc_option[wmhc_hide_footer_cart_shop]"   value="wmhc_hide_footer_cart_shop" %s><strong>'.esc_html__('Shop / Store Page (WooCommerce)','whmc').'</strong></label></div>', (isset($options['wmhc_hide_footer_cart_shop']) && $options['wmhc_hide_footer_cart_shop'] === 'wmhc_hide_footer_cart_shop') ? 'checked' : '');

        printf('<div><input type="checkbox" name="whmc_option[wmhc_hide_footer_cart_blog]"   value="wmhc_hide_footer_cart_blog" %s><strong>'.esc_html__('Blog Page','whmc').'</strong></label></div>', (isset($options['wmhc_hide_footer_cart_blog']) && $options['wmhc_hide_footer_cart_blog'] === 'wmhc_hide_footer_cart_blog') ? 'checked' : '');


        echo '</div>';
        }




    $excluded_posttypes = array('attachment','revision','nav_menu_item','custom_css','customize_changeset','oembed_cache','user_request','wp_block','scheduled-action','product_variation','shop_order','shop_order_refund','shop_coupon','elementor_library','e-landing-page','page','wp_navigation','wp_template_part','wp_global_styles','wp_template','shop_order_placehold');

        $types = get_post_types();
        $post_types = array_diff($types, $excluded_posttypes);

        if($post_types ){
            echo '<div id="postyupe"><strong><label for="yoo_type_pages">'.esc_html__(' Post Type:','whmc').'</label></strong></div><div id="pagesnumbers">';

        foreach ($post_types as $post_type)
        {
            $post_type_title = get_post_type_object($post_type);
            $options = get_option('whmc_option');

            $checkedposttype = isset($options[$post_type]) ? 'checked' : '';

            printf('<div><input type="checkbox" id="%s"  value="%s" name="whmc_option[%s]" %s><label for ="%s" ><strong>' . $post_type_title->labels->name . '</strong></label></div>', $post_type, $post_type, $post_type, $checkedposttype, $post_type);



        }


       echo '</div>';

    }

    }

    /**
     * This function is a callback function of  add seeting section
     */

    public function settting_sec_func()
    {

        return true;
    }

    public function settting_sec_func_header()
    {

        return true;
    }

    /**
     * This function is a callback function of  add seeting field
     */

    public function wmhc_bag_icon()
    {

        $options = get_option('whmc_option');;
        $fcp_icon_option = isset($options['fcp_icon_option']) ? $options['fcp_icon_option'] : 'fcp_icon_19';

    ?>

    <select id="default"  class="default" name="whmc_option[fcp_icon_option]">
    
    <option value="fcp_icon_1" <?php
        echo esc_attr($fcp_icon_option) == "fcp_icon_1" ? 'selected' : '';?>>fcp_icon_1</option>    
    <option value="fcp_icon_2" <?php
        echo esc_attr($fcp_icon_option) == "fcp_icon_2" ? 'selected' : '';?>>fcp_icon_2</option>    
    <option value="fcp_icon_3" <?php
        echo esc_attr($fcp_icon_option) == "fcp_icon_3" ? 'selected' : '';?>>fcp_icon_3</option>    
    <option value="fcp_icon_4" <?php
        echo esc_attr($fcp_icon_option) == "fcp_icon_4" ? 'selected' : '';?>>fcp_icon_4</option>    
    <option value="fcp_icon_5" <?php
        echo esc_attr($fcp_icon_option) == "fcp_icon_5" ? 'selected' : '';?>>fcp_icon_5</option>    
    <option value="fcp_icon_6" <?php
        echo esc_attr($fcp_icon_option) == "fcp_icon_6" ? 'selected' : '';?>>fcp_icon_6</option>    
    <option value="fcp_icon_7" <?php
        echo esc_attr($fcp_icon_option) == "fcp_icon_7" ? 'selected' : '';?>>fcp_icon_7</option>    
    <option value="fcp_icon_8" <?php
        echo esc_attr($fcp_icon_option) == "fcp_icon_8" ? 'selected' : '';?>>fcp_icon_8</option>

    <option value="fcp_icon_11" <?php
        echo esc_attr($fcp_icon_option) == "fcp_icon_11" ? 'selected' : '';?>>fcp_icon_11</option>   

    <option value="icon_45" <?php
        echo esc_attr($fcp_icon_option) == "icon_45" ? 'selected' : '';?>>icon_45</option>  

    <option value="icon_38" <?php
        echo esc_attr($fcp_icon_option) == "icon_38" ? 'selected' : '';?>>icon_38</option>
   
    <option value="icon_39" <?php
        echo esc_attr($fcp_icon_option) == "icon_39" ? 'selected' : '';?>>icon_39</option>
   
    <option value="icon_40" <?php
        echo esc_attr($fcp_icon_option) == "icon_40" ? 'selected' : '';?>>icon_40</option>

    <option value="icon_41" <?php
        echo esc_attr($fcp_icon_option) == "icon_41" ? 'selected' : '';?>>icon_41</option>

    <option value="fcp_icon_9" <?php echo esc_attr($fcp_icon_option) == "fcp_icon_9" ? 'selected' : '';?>>fcp_icon_9</option> 

    <option value="fcp_icon_10" <?php
        echo esc_attr($fcp_icon_option) == "fcp_icon_10" ? 'selected' : '';?>>fcp_icon_10</option>  
    <option value="fcp_icon_12" <?php
        echo esc_attr($fcp_icon_option) == "fcp_icon_12" ? 'selected' : '';?>>fcp_icon_12</option>    
    <option value="fcp_icon_13" <?php
        echo esc_attr($fcp_icon_option) == "fcp_icon_13" ? 'selected' : '';?>>fcp_icon_13</option>    
    <option value="fcp_icon_14" <?php
        echo esc_attr($fcp_icon_option) == "fcp_icon_14" ? 'selected' : '';?>>fcp_icon_14</option>    
    <option value="fcp_icon_15" <?php
        echo esc_attr($fcp_icon_option) == "fcp_icon_15" ? 'selected' : '';?>>fcp_icon_15</option>    
    <option value="fcp_icon_16" <?php
        echo esc_attr($fcp_icon_option) == "fcp_icon_16" ? 'selected' : '';?>>fcp_icon_16</option>    
    <option value="fcp_icon_17" <?php
        echo esc_attr($fcp_icon_option) == "fcp_icon_17" ? 'selected' : '';?>>fcp_icon_17</option>    
    <option value="fcp_icon_18" <?php
        echo esc_attr($fcp_icon_option) == "fcp_icon_18" ? 'selected' : '';?>>fcp_icon_18</option>    
    <option value="fcp_icon_19" <?php
        echo esc_attr($fcp_icon_option) == "fcp_icon_19" ? 'selected' : '';?>>fcp_icon_19</option>          
    <option value="fcp_icon_20" <?php
        echo esc_attr($fcp_icon_option) == "fcp_icon_20" ? 'selected' : '';?>>fcp_icon_20</option>
         
    <option value="icon_19" <?php
        echo esc_attr($fcp_icon_option) == "icon_19" ? 'selected' : '';?>>icon_19</option>

    <option value="icon_20" <?php
        echo esc_attr($fcp_icon_option) == "icon_20" ? 'selected' : '';?>>icon_20</option>        
    <option value="icon_21" <?php
        echo esc_attr($fcp_icon_option) == "icon_21" ? 'selected' : '';?>>icon_21</option>               
    <option value="icon_254" <?php
        echo esc_attr($fcp_icon_option) == "icon_254" ? 'selected' : '';?>>icon_254</option>        
      
    <option value="icon_25" <?php
        echo esc_attr($fcp_icon_option) == "icon_25" ? 'selected' : '';?>>icon_25</option>  
              
    <option value="icon_26" <?php
        echo esc_attr($fcp_icon_option) == "icon_26" ? 'selected' : '';?>>icon_26</option>        
    <option value="icon_27" <?php
        echo esc_attr($fcp_icon_option) == "icon_27" ? 'selected' : '';?>>icon_27</option>        
    <option value="icon_28" <?php
        echo esc_attr($fcp_icon_option) == "icon_28" ? 'selected' : '';?>>icon_28</option>        
    <option value="icon_29" <?php
        echo esc_attr($fcp_icon_option) == "icon_29" ? 'selected' : '';?>>icon_29</option>    

    <option value="icon_30" <?php
        echo esc_attr($fcp_icon_option) == "icon_30" ? 'selected' : '';?>>icon_30</option>
    
    <option value="icon_31" <?php
        echo esc_attr($fcp_icon_option) == "icon_31" ? 'selected' : '';?>>icon_31</option>  
  
    <option value="icon_34" <?php
        echo esc_attr($fcp_icon_option) == "icon_34" ? 'selected' : '';?>>icon_34</option>
    
    <option value="icon_35" <?php
        echo esc_attr($fcp_icon_option) == "icon_35" ? 'selected' : '';?>>icon_35</option>

    <option value="icon_37" <?php
        echo esc_attr($fcp_icon_option) == "icon_37" ? 'selected' : '';?>>icon_37</option>
    
    <option value="icon_43" <?php
        echo esc_attr($fcp_icon_option) == "icon_43" ? 'selected' : '';?>>icon_43</option>
 
    <option value="icon_46" <?php
        echo esc_attr($fcp_icon_option) == "icon_46" ? 'selected' : '';?>>icon_46</option> 
    <option value="icon_44" <?php
        echo esc_attr($fcp_icon_option) == "icon_44" ? 'selected' : '';?>>icon_44</option> 
  </select>
        <p class="whmc_description"><a href=" <?php echo admin_url('/nav-menus.php'); ?> " target="_blank"><?php echo esc_html__('Go to the menu section ', 'whmc') ?> </a><?php echo esc_html__(', and Click the \'Screen Options\' at the top and tick "Woo Header Mini Cart", then add it to the menu structure, details in ', 'whmc') ?><a href="https://woominicart.sharabindu.com/docs/set-the-cart-to-the-menu-item/"> <?php echo esc_html__(' docs', 'whmc') ?></a></p>
            <?php
    }
    public function fcp_cart_shortcode()
    {
        printf('
           <input type="text"  value="[whmc_mini_cart]" readonly="readonly">');

    }
    /**
     * This function is a callback function of  add seeting field
     */

    public function wmhc_footer_bag_icon()
    {

        $options = get_option('whmc_option');

        $wmhc_footer_bag_ficon = isset($options['wmhc_footer_bag_ficon']) ? $options['wmhc_footer_bag_ficon'] : 'fcp_icon_20';

    
  ?>
  <select id="default"  class="default" name="whmc_option[wmhc_footer_bag_ficon]">
    
    <option value="fcp_icon_1" <?php
        echo esc_attr($wmhc_footer_bag_ficon) == "fcp_icon_1" ? 'selected' : '';?>>fcp_icon_1</option>    
    <option value="fcp_icon_2" <?php
        echo esc_attr($wmhc_footer_bag_ficon) == "fcp_icon_2" ? 'selected' : '';?>>fcp_icon_2</option>    
    <option value="fcp_icon_3" <?php
        echo esc_attr($wmhc_footer_bag_ficon) == "fcp_icon_3" ? 'selected' : '';?>>fcp_icon_3</option>    
    <option value="fcp_icon_4" <?php
        echo esc_attr($wmhc_footer_bag_ficon) == "fcp_icon_4" ? 'selected' : '';?>>fcp_icon_4</option>    
    <option value="fcp_icon_5" <?php
        echo esc_attr($wmhc_footer_bag_ficon) == "fcp_icon_5" ? 'selected' : '';?>>fcp_icon_5</option>    
    <option value="fcp_icon_6" <?php
        echo esc_attr($wmhc_footer_bag_ficon) == "fcp_icon_6" ? 'selected' : '';?>>fcp_icon_6</option>    
    <option value="fcp_icon_7" <?php
        echo esc_attr($wmhc_footer_bag_ficon) == "fcp_icon_7" ? 'selected' : '';?>>fcp_icon_7</option>    
    <option value="fcp_icon_8" <?php
        echo esc_attr($wmhc_footer_bag_ficon) == "fcp_icon_8" ? 'selected' : '';?>>fcp_icon_8</option>

    <option value="fcp_icon_11" <?php
        echo esc_attr($wmhc_footer_bag_ficon) == "fcp_icon_11" ? 'selected' : '';?>>fcp_icon_11</option>   

    <option value="icon_45" <?php
        echo esc_attr($wmhc_footer_bag_ficon) == "icon_45" ? 'selected' : '';?>>icon_45</option>  

    <option value="icon_38" <?php
        echo esc_attr($wmhc_footer_bag_ficon) == "icon_38" ? 'selected' : '';?>>icon_38</option>
   
    <option value="icon_39" <?php
        echo esc_attr($wmhc_footer_bag_ficon) == "icon_39" ? 'selected' : '';?>>icon_39</option>
   
    <option value="icon_40" <?php
        echo esc_attr($wmhc_footer_bag_ficon) == "icon_40" ? 'selected' : '';?>>icon_40</option>

    <option value="icon_41" <?php
        echo esc_attr($wmhc_footer_bag_ficon) == "icon_41" ? 'selected' : '';?>>icon_41</option>

    <option value="fcp_icon_9" <?php echo esc_attr($wmhc_footer_bag_ficon) == "fcp_icon_9" ? 'selected' : '';?>>fcp_icon_9</option> 
       
    <option value="fcp_icon_10" <?php
        echo esc_attr($wmhc_footer_bag_ficon) == "fcp_icon_10" ? 'selected' : '';?>>fcp_icon_10</option>  
    <option value="fcp_icon_12" <?php
        echo esc_attr($wmhc_footer_bag_ficon) == "fcp_icon_12" ? 'selected' : '';?>>fcp_icon_12</option>    
    <option value="fcp_icon_13" <?php
        echo esc_attr($wmhc_footer_bag_ficon) == "fcp_icon_13" ? 'selected' : '';?>>fcp_icon_13</option>    
    <option value="fcp_icon_14" <?php
        echo esc_attr($wmhc_footer_bag_ficon) == "fcp_icon_14" ? 'selected' : '';?>>fcp_icon_14</option>    
    <option value="fcp_icon_15" <?php
        echo esc_attr($wmhc_footer_bag_ficon) == "fcp_icon_15" ? 'selected' : '';?>>fcp_icon_15</option>    
    <option value="fcp_icon_16" <?php
        echo esc_attr($wmhc_footer_bag_ficon) == "fcp_icon_16" ? 'selected' : '';?>>fcp_icon_16</option>    
    <option value="fcp_icon_17" <?php
        echo esc_attr($wmhc_footer_bag_ficon) == "fcp_icon_17" ? 'selected' : '';?>>fcp_icon_17</option>    
    <option value="fcp_icon_18" <?php
        echo esc_attr($wmhc_footer_bag_ficon) == "fcp_icon_18" ? 'selected' : '';?>>fcp_icon_18</option>    
    <option value="fcp_icon_19" <?php
        echo esc_attr($wmhc_footer_bag_ficon) == "fcp_icon_19" ? 'selected' : '';?>>fcp_icon_19</option>          
    <option value="fcp_icon_20" <?php
        echo esc_attr($wmhc_footer_bag_ficon) == "fcp_icon_20" ? 'selected' : '';?>>fcp_icon_20</option>
         
    <option value="icon_19" <?php
        echo esc_attr($wmhc_footer_bag_ficon) == "icon_19" ? 'selected' : '';?>>icon_19</option>

    <option value="icon_20" <?php
        echo esc_attr($wmhc_footer_bag_ficon) == "icon_20" ? 'selected' : '';?>>icon_20</option>        
    <option value="icon_21" <?php
        echo esc_attr($wmhc_footer_bag_ficon) == "icon_21" ? 'selected' : '';?>>icon_21</option>               
    <option value="icon_254" <?php
        echo esc_attr($wmhc_footer_bag_ficon) == "icon_254" ? 'selected' : '';?>>icon_254</option>        
      
    <option value="icon_25" <?php
        echo esc_attr($wmhc_footer_bag_ficon) == "icon_25" ? 'selected' : '';?>>icon_25</option>        
    <option value="icon_26" <?php
        echo esc_attr($wmhc_footer_bag_ficon) == "icon_26" ? 'selected' : '';?>>icon_26</option>        
    <option value="icon_27" <?php
        echo esc_attr($wmhc_footer_bag_ficon) == "icon_27" ? 'selected' : '';?>>icon_27</option>        
    <option value="icon_28" <?php
        echo esc_attr($wmhc_footer_bag_ficon) == "icon_28" ? 'selected' : '';?>>icon_28</option>        
    <option value="icon_29" <?php
        echo esc_attr($wmhc_footer_bag_ficon) == "icon_29" ? 'selected' : '';?>>icon_29</option>    

    <option value="icon_30" <?php
        echo esc_attr($wmhc_footer_bag_ficon) == "icon_30" ? 'selected' : '';?>>icon_30</option>
    
    <option value="icon_31" <?php
        echo esc_attr($wmhc_footer_bag_ficon) == "icon_31" ? 'selected' : '';?>>icon_31</option>  
  
    <option value="icon_34" <?php
        echo esc_attr($wmhc_footer_bag_ficon) == "icon_34" ? 'selected' : '';?>>icon_34</option>
    
    <option value="icon_35" <?php
        echo esc_attr($wmhc_footer_bag_ficon) == "icon_35" ? 'selected' : '';?>>icon_35</option>

    <option value="icon_37" <?php
        echo esc_attr($wmhc_footer_bag_ficon) == "icon_37" ? 'selected' : '';?>>icon_37</option>
    
    <option value="icon_43" <?php
        echo esc_attr($wmhc_footer_bag_ficon) == "icon_43" ? 'selected' : '';?>>icon_43</option>
 
    <option value="icon_46" <?php
        echo esc_attr($wmhc_footer_bag_ficon) == "icon_46" ? 'selected' : '';?>>icon_46</option> 
    <option value="icon_44" <?php
        echo esc_attr($wmhc_footer_bag_ficon) == "icon_44" ? 'selected' : '';?>>icon_44</option> 
  </select>

            <?php
    }

    /**
     * This function is a callback function of  add seeting field
     */

    public function wmhc_menu_cart_style()
    {

        $options = get_option('whmc_option');

        $fcp_menu_style = isset($options['fcp_menu_cart_style']) ? $options['fcp_menu_cart_style'] : 'fcp_menu_0';

        $icon_1 = WHMC_URL . 'assets/admin/img/style-one.jpg';
        $icon_2 = WHMC_URL . 'assets/admin/img/style-two.jpg';
        $icon_3 = WHMC_URL . 'assets/admin/img/style-three.jpg';
        $icon_0 = WHMC_URL . 'assets/admin/img/image.PNG';

?>
        <table class="">
          <tr class="whmc-icon_table_row">
          <td>
            <input type="radio" id="menu-0" name="whmc_option[fcp_menu_cart_style]" value="fcp_menu_0" <?php
        echo esc_attr($fcp_menu_style) == 'fcp_menu_0' ? 'checked' : ''; ?>> 
          </td>
          <td>
            <input type="radio" id="menu-1" name="whmc_option[fcp_menu_cart_style]" value="fcp_menu_1" <?php
        echo esc_attr($fcp_menu_style) == 'fcp_menu_1' ? 'checked' : ''; ?>> 
          </td>

          <td>
            <input type="radio" id="menu-2" name="whmc_option[fcp_menu_cart_style]" value="fcp_menu_2" <?php
        echo esc_attr($fcp_menu_style) == 'fcp_menu_2' ? 'checked' : ''; ?>>
          </td>                    
          <td>
            <input type="radio" id="menu-3" name="whmc_option[fcp_menu_cart_style]" value="fcp_menu_3"<?php
        echo esc_attr($fcp_menu_style) == 'fcp_menu_3' ? 'checked' : ''; ?>>
          </td>                    
          
          </tr>
          <tr   class="whmc-icon_table_row2 whmc-rowe">
          <td>
            <label for="menu-0" class="icon_label"><img src="<?php echo esc_url($icon_0); ?>" alt="icon"></label>
          </td>
          <td>
            <label for="menu-1" class="icon_label"><img src="<?php echo esc_url($icon_1); ?>" alt="icon"></label>
          </td>

          <td>
            <label for="menu-2" class="icon_label"><img src="<?php echo esc_url($icon_2); ?>" alt="icon"></label>
          </td>
          <td>
            <label for="menu-3" class="icon_label"><img src="<?php echo esc_url($icon_3); ?>" alt="icon"></label>
          </td>
          
          </tr>
        </table>

            <?php
    }

    /**
     * This function is a callback function of  add seeting field
     */

    public function fcp_option_func()
    {

        $options = get_option('whmc_option');
        $fcp_option = isset($options['fcp_option']) ? $options['fcp_option'] : '1';?>
    
      <select name="whmc_option[fcp_option]" class="whmc_slect_class">
          
      <option value="0" <?php
        echo esc_attr($fcp_option) == 0 ? 'selected' : '';?>><?php
        esc_html_e('Left', 'whmc');?></option>
      <option value="1" <?php
        echo esc_attr($fcp_option) == 1 ? 'selected' : '';?>><?php
        esc_html_e('Right', 'whmc');?></option>
      </select>
      <p class="whmc_description" ><?php echo esc_html__('Footer Cart Icon Position Left/right ,Default:right', 'whmc') ?></p>

    <?php

    }

    public function fcp_fotter_cart_size()
    {

        $options = get_option('whmc_option');
        $options_rang_value = isset($options['fcp_fotter_cart_size']) ? $options['fcp_fotter_cart_size'] : '60';

        printf('<span id="demothree">'.$options_rang_value.'</span>
              <input type="range" name="whmc_option[fcp_fotter_cart_size]" value="%s" min="40" max="80" id="fcp_fotter_cart_size" class="slider">', $options_rang_value);
        printf('<p class="whmc_description" >Footer Cart icon size %s to %s  default:"60"</p>', '40%', '80%');

    }
    public function fcp_option_range()
    {

        $options = get_option('whmc_option');
        $options_value = isset($options['fcp_option_range']) ? $options['fcp_option_range'] : '4';

        $options_rang_value = isset($options['fcp_option_range_bottom']) ? $options['fcp_option_range_bottom'] : '6';

        printf('<ul class="whmc_ptc_wrape_tb hnypost" style="width:%s"><li><strong class="whmc_ptc_tb"><label>Horizantal Position</label></strong></br><span id="demo">'.$options_value.'</span><input type="range" name="whmc_option[fcp_option_range]" value="%s" min="1" max="50"  id="fcp_option_range" class="slider"></li>', '100%', $options_value);
        printf('<li><strong class="whmc_ptc_tb"><label>Vertical Position</label></strong></br><span id="demotwo">'.$options_rang_value.'</span><input type="range" name="whmc_option[fcp_option_range_bottom]" value="%s" min="1" max="50" id="fcp_option_range_bottom" class="slider"></li></ul><p class="whmc_description" >Range %s to %s </p>', $options_rang_value, '1%', '50%');

    }

    public function fcp_cart_color()
    {

        $options = get_option('whmc_option');
        $options_color_value = isset($options['fcp_cart_color']) ? $options['fcp_cart_color'] : '#3300d0';
        $options_color_bg_value = isset($options['fcp_cart_bubble_bg_color']) ? $options['fcp_cart_bubble_bg_color'] : '#fd0000';
        $fcp_cart_bubble_color = isset($options['fcp_cart_bubble_color']) ? $options['fcp_cart_bubble_color'] : '#fff';

        printf(' <ul class="whmc_ptc_wrape_tb  hnypost"><li><strong class="whmc_ptc_tb"><label>Cart Icon Color:</label></strong></br>
          <input type="text" name="whmc_option[fcp_cart_color]" value="%s" class="cart_color" ></li>', $options_color_value);

        printf('<li><strong class="whmc_ptc_tb"><label>Bubble Background: </label></strong></br>
      <input type="text" name="whmc_option[fcp_cart_bubble_bg_color]" value="%s" class="fcp_cart_bubble_bg_color" ></li>', $options_color_bg_value);

        printf('<li><strong class="whmc_ptc_tb"><label>Bubble Text Color: </label></strong></br>
        <input type="text" name="whmc_option[fcp_cart_bubble_color]" value="%s" class="fcp_cart_bubble_color" ></li></ul>', $fcp_cart_bubble_color);
    }

    public function wmhc_horizontal_position()
    {
      $options = get_option('whmc_option');
        $options_rang_value = isset($options['wmhc_horizontal_position']) ? $options['wmhc_horizontal_position'] : '5';
        $options_rang_vet_value = isset($options['wmhc_vertical_position']) ? $options['wmhc_vertical_position'] : '4';

        printf('<label  class="whmc_label">Horizantal </label><input type="number" name="whmc_option[wmhc_horizontal_position]" value="%s" min="-100" max="100" id="horizantal" style="width:80px">', $options_rang_value);

        printf('<span id="demofive"></span>
          <label class="whmc_label">Vertical </label><input type="number" name="whmc_option[wmhc_vertical_position]" value="%s" min="-100" max="100" class="slider" id="Vertical" style="width:80px">', $options_rang_vet_value);
        printf('<p class="whmc_description" >Range:   %s to %s default:"10"</p>', '-100px', '100px');

    }

    public function wmhc_header_bubble_color()
    {

        $options = get_option('whmc_option');
        $options_rang_value = isset($options['wmhc_header_bubble_color']) ? $options['wmhc_header_bubble_color'] : '#0bb100';

        $options_rang_t_value = isset($options['wmhc_header_text_color']) ? $options['wmhc_header_text_color'] : '#000';

        $wmhch_bubbles_color = isset($options['wmhch_bubbles_color']) ? $options['wmhch_bubbles_color'] : '#f97417';
        $wmhch_bubbles_txt = isset($options['wmhch_bubbles_txt']) ? $options['wmhch_bubbles_txt'] : '#fff';

        printf('<ul class="whmc_ptc_wrape_tb"> <li><strong class="whmc_ptc_tb"><label>Icon Color</label></strong><input type="text" name="whmc_option[wmhc_header_bubble_color]" value="%s"  class="header_bubble" ></li>', $options_rang_value);

        printf('<li><strong class="whmc_ptc_tb"><label>Text Color</label></strong><input type="text" name="whmc_option[wmhc_header_text_color]" value="%s"  class="header_text_bubble" ></li>', $options_rang_t_value);

        printf('<li><strong class="whmc_ptc_tb"><label>Bubble Color</label></strong><input type="text" name="whmc_option[wmhch_bubbles_color]" value="%s"  class="header_bubble" ></li>', $wmhch_bubbles_color);

        printf('<li><strong class="whmc_ptc_tb"><label>Bubble Text Color</strong></label><input type="text" name="whmc_option[wmhch_bubbles_txt]" value="%s"  class="header_bubble" ></li></ul>', $wmhch_bubbles_txt);
    }

    public function wmhc_hide_text_color()
    {

        $options = get_option('whmc_option');

        printf('<input type="checkbox" name="whmc_option[wmhc_hide_text_color]" class="whmc_apple-switch"  value="wmhc_hide_text_color" %s><p class="whmc_description" style="display:inline-block;top: 0px;">'.__('Click on for hide menu cart amount option ','whmc').'</p>', (isset($options['wmhc_hide_text_color']) && $options['wmhc_hide_text_color'] === 'wmhc_hide_text_color') ? 'checked' : '');

    }

    public function wmhc_hide_footer_cart()
    {

        $options = get_option('whmc_option');

        printf('<input type="checkbox" name="whmc_option[wmhc_hide_footer_cart]" class="whmc_apple-switch"  value="wmhc_hide_footer_cart" %s><p class="whmc_description" style="display:inline-block;top: 0px;">'.__('Click on for remove Footer cart icon','whmc').'</p>', (isset($options['wmhc_hide_footer_cart']) && $options['wmhc_hide_footer_cart'] === 'wmhc_hide_footer_cart') ? 'checked' : '');

    }

    public function whmc_option_page_sanitize($input)
    {
        $sanitary_values = array();
        if (isset($input['fcp_option_range']))
        {
            $sanitary_values['fcp_option_range'] = ($input['fcp_option_range']);
        }
        if (isset($input['fcp_icon_option']))
        {
            $sanitary_values['fcp_icon_option'] = ($input['fcp_icon_option']);
        }

        if (isset($input['wmhc_footer_bag_ficon']))
        {
            $sanitary_values['wmhc_footer_bag_ficon'] = ($input['wmhc_footer_bag_ficon']);
        }

        if (isset($input['fcp_menu_cart_style']))
        {
            $sanitary_values['fcp_menu_cart_style'] = ($input['fcp_menu_cart_style']);
        }
        if (isset($input['fcp_fotter_cart_size']))
        {
            $sanitary_values['fcp_fotter_cart_size'] = sanitize_text_field($input['fcp_fotter_cart_size']);
        }

        if (isset($input['fcp_option_range_bottom']))
        {
            $sanitary_values['fcp_option_range_bottom'] = $input['fcp_option_range_bottom'];
        }

        if (isset($input['fcp_cart_color']))
        {
            $sanitary_values['fcp_cart_color'] = sanitize_text_field($input['fcp_cart_color']);
        }

        if (isset($input['fcp_cart_bubble_color']))
        {
            $sanitary_values['fcp_cart_bubble_color'] = sanitize_text_field($input['fcp_cart_bubble_color']);
        }

        if (isset($input['fcp_cart_bubble_bg_color']))
        {
            $sanitary_values['fcp_cart_bubble_bg_color'] = sanitize_text_field($input['fcp_cart_bubble_bg_color']);
        }

        if (isset($input['fcp_option']))
        {
            $sanitary_values['fcp_option'] = $input['fcp_option'];
        }
        if (isset($input['wmhc_horizontal_position']))
        {
            $sanitary_values['wmhc_horizontal_position'] = $input['wmhc_horizontal_position'];
        }
        if (isset($input['wmhc_vertical_position']))
        {
            $sanitary_values['wmhc_vertical_position'] = $input['wmhc_vertical_position'];
        }
        if (isset($input['wmhc_header_bubble_color']))
        {
            $sanitary_values['wmhc_header_bubble_color'] = $input['wmhc_header_bubble_color'];
        }

        if (isset($input['wmhc_header_text_color']))
        {
            $sanitary_values['wmhc_header_text_color'] = $input['wmhc_header_text_color'];
        }
        if (isset($input['wmhc_hide_text_color']))
        {
            $sanitary_values['wmhc_hide_text_color'] = $input['wmhc_hide_text_color'];
        }
        if (isset($input['wmhc_hide_footer_cart']))
        {
            $sanitary_values['wmhc_hide_footer_cart'] = $input['wmhc_hide_footer_cart'];
        }
        if (isset($input['wmhch_bubbles_color']))
        {
            $sanitary_values['wmhch_bubbles_color'] = $input['wmhch_bubbles_color'];
        }
        if (isset($input['wmhch_bubbles_txt']))
        {
            $sanitary_values['wmhch_bubbles_txt'] = $input['wmhch_bubbles_txt'];
        }
        if (isset($input['wmhc_hide_footer_cart_home']))
        {
            $sanitary_values['wmhc_hide_footer_cart_home'] = $input['wmhc_hide_footer_cart_home'];
        }
        if (isset($input['wmhc_hide_footer_cart_blog']))
        {
            $sanitary_values['wmhc_hide_footer_cart_blog'] = $input['wmhc_hide_footer_cart_blog'];
        }
        if (isset($input['wmhc_hide_footer_cart_shop']))
        {
            $sanitary_values['wmhc_hide_footer_cart_shop'] = $input['wmhc_hide_footer_cart_shop'];
        }


        $post_types = get_post_types();

        foreach ($post_types as $post_type)
        {

            if (isset($input[$post_type]))
            {
                $sanitary_values[$post_type] = $input[$post_type];
            }
        }



        $yoo_type_pages = get_posts(array(
            'post_type' => 'page',
            'posts_per_page' => - 1,
        ));


            foreach ($yoo_type_pages as $yoo_type_page){

            if (isset($input[$yoo_type_page->ID]))
            {
                $sanitary_values[$yoo_type_page->ID] = $input[$yoo_type_page->ID];
            }
        }
        $post_types = get_post_types();

        foreach ($post_types as $post_type)
        {

            if (isset($input[$post_type]))
            {
                $sanitary_values[$post_type] = $input[$post_type];
            }
        }

        return $sanitary_values;
    }

}

if(class_exists('Whmc_Admin_Settings')){

    new Whmc_Admin_Settings;
}