<?php
/**
 * The admin-specific functionality of the plugin.
 *
 * @since      4.0.1
 *
 * @package    WHMC
 * @subpackage WHMC/admin
 */

class WHMC_Admin_Sidebar_Pro
{

    /**
     * The ID of this plugin.
     *
     * @since    4.0.1
     * @access   private
     * @var      string    $plugin_name    The ID of this plugin.
     */

    public function __construct()
    {
        add_action('admin_init', array(
            $this,
            'whmc_sidepanel_settings_page'
        ));

    }

    public function whmc_sidepanel_settings_page()
    {

        register_setting("whmc_sidepanel", "whmc_sidepanel", array(
            $this,
            'whmc_sidepanel_page_sanitized'
        ));

        add_settings_section("sidepanel_section_setting", " ", array(
            $this,
            'settting_sec_func'
        ) , 'whmc_admin_sec_sidepanel');

        add_settings_field("wmhc_cart_side_position", esc_html__("Change sidebar position?", "whmc") , array(
            $this,
            "wmhc_cart_side_position"
        ) , 'whmc_admin_sec_sidepanel', "sidepanel_section_setting");

        add_settings_field("wmhc_cart_side_autup", esc_html__("Stop Auto Open?", "whmc") , array(
            $this,
            "wmhc_cart_side_autup"
        ) , 'whmc_admin_sec_sidepanel', "sidepanel_section_setting");

        add_settings_field("wmhc_wrapper_bg", esc_html__("Background", "whmc") , array(
            $this,
            "wmhc_wrapper_bg"
        ) , 'whmc_admin_sec_sidepanel', "sidepanel_section_setting");

        add_settings_field("wmhc_sidebar_toppart", esc_html__("Top Part", "whmc") , array(
            $this,
            "wmhc_sidebar_top"
        ) , 'whmc_admin_sec_sidepanel', "sidepanel_section_setting", array(
            'class' => 'whmc_sidebar_top'
        ));
        add_settings_field("wmhc_sidebartop_icon", esc_html__("Top Icon", "whmc") , array(
            $this,
            "wmhc_top_icon"
        ) , 'whmc_admin_sec_sidepanel', "sidepanel_section_setting");

        add_settings_field("wmhc_cart_side_toppart_background", esc_html__("Color Setting", "whmc") , array(
            $this,
            "wmhc_cart_side_toppart_background"
        ) , 'whmc_admin_sec_sidepanel', "sidepanel_section_setting");
        add_settings_field("wmhc_cart_side_toppart_nofi", esc_html__("Change the notification text", "whmc") , array(
            $this,
            "wmhc_cart_side_toppart_nofi"
        ) , 'whmc_admin_sec_sidepanel', "sidepanel_section_setting");

        add_settings_field("wmhc_sidebar_top", esc_html__(" Middle Part", "whmc") , array(
            $this,
            "wmhc_sidebar_top"
        ) , 'whmc_admin_sec_sidepanel', "sidepanel_section_setting", array(
            'class' => 'whmc_sidebar_top'
        ));

        add_settings_field("wmhc_cart_side_top_background", esc_html__("Separator Color", "whmc") , array(
            $this,
            "wmhc_cart_side_top_background"
        ) , 'whmc_admin_sec_sidepanel', "sidepanel_section_setting");

        add_settings_field("whmc_side_img_brious", esc_html__("Product Round Image?", "whmc") , array(
            $this,
            "whmc_side_img_brious"
        ) , 'whmc_admin_sec_sidepanel', "sidepanel_section_setting");

        add_settings_field("wmhc_cart_side_text_color", esc_html__("Product Title", "whmc") , array(
            $this,
            "wmhc_cart_side_text_color"
        ) , 'whmc_admin_sec_sidepanel', "sidepanel_section_setting");

        add_settings_field("wmhc_cart_side_price_color", esc_html__("Product Price", "whmc") , array(
            $this,
            "wmhc_cart_side_price_color"
        ) , 'whmc_admin_sec_sidepanel', "sidepanel_section_setting");

        add_settings_field("wmhc_menu_cart_style", esc_html__("Item Remove icon", "whmc") , array(
            $this,
            "wmhc_menu_cart_style"
        ) , 'whmc_admin_sec_sidepanel', "sidepanel_section_setting");


        add_settings_field("wmhc_sidebar_bottom", esc_html__(" Bottom Part", "whmc") , array(
            $this,
            "wmhc_sidebar_bottom"
        ) , 'whmc_admin_sec_sidepanel', "sidepanel_section_setting", array(
            'class' => 'whmc_sidebar_top'
        ));


        add_settings_field("wmhc_coupon_icons", esc_html__("Coupon icon", "whmc") , array(
            $this,
            "wmhc_coupon_icons"
        ) , 'whmc_admin_sec_sidepanel', "sidepanel_section_setting");


        add_settings_field("wmhc_coupon_imodla", esc_html__("Coupon Modal", "whmc") , array(
            $this,
            "wmhc_coupon_imodla"
        ) , 'whmc_admin_sec_sidepanel', "sidepanel_section_setting");


        add_settings_field("wmhc_cart_side_subtotal", esc_html__("Sub Total", "whmc") , array(
            $this,
            "wmhc_cart_side_subtotal"
        ) , 'whmc_admin_sec_sidepanel', "sidepanel_section_setting");

        add_settings_field("wmhc_cart_shipping", esc_html__("Shipping", "whmc") , array(
            $this,
            "wmhc_cart_shipping"
        ) , 'whmc_admin_sec_sidepanel', "sidepanel_section_setting");

        add_settings_field("wmhcside_btm_shipping", esc_html__("Tax ", "whmc") , array(
            $this,
            "wmhcside_btm_shipping"
        ) , 'whmc_admin_sec_sidepanel', "sidepanel_section_setting");

        add_settings_field("wmhcside_btm_discount", esc_html__("Discount ", "whmc") , array(
            $this,
            "wmhcside_btm_discount"
        ) , 'whmc_admin_sec_sidepanel', "sidepanel_section_setting"); 

        add_settings_field("wmhcside_btm_total", esc_html__("Total ", "whmc") , array(
            $this,
            "wmhcside_btm_total"
        ) , 'whmc_admin_sec_sidepanel', "sidepanel_section_setting");

        add_settings_field("wmhc_cart_side_button_text_color", esc_html__("Button", "whmc") , array(
            $this,
            "wmhc_cart_side_button_text_color"
        ) , 'whmc_admin_sec_sidepanel', "sidepanel_section_setting");

        add_settings_field("wmhc_cart_side_text_change", esc_html__("Footer Button", "whmc") , array(
            $this,
            "wmhc_cart_side_text_change"
        ) , 'whmc_admin_sec_sidepanel', "sidepanel_section_setting");

    }

    /**
     * This function is a callback function of  add seeting section
     */

    public function wmhc_sidebar_bottom()
    {
        return true;
    }
    public function wmhc_sidebar_top()
    {
        return true;
    }
    public function settting_sec_func()
    {
        return true;
    }

    /**
     * This function is a callback function of  add seeting field
     */

    public function wmhc_menu_cart_style()
    {

        $sidepanels = get_option('whmc_sidepanel');

        $fcp_menu_style = isset($sidepanels['whmc_del_option']) ? $sidepanels['whmc_del_option'] : 'icon_23';

        $whmc_del_color = isset($sidepanels['whmc_del_color']) ? $sidepanels['whmc_del_color'] : '#dd4f4f';


    ?> 
    <ul class="whmc_ptc_wrape_tb"><li><strong class="whmc_ptc_tb"><label><?php echo esc_html('Choose a Icon ','whmc') ?></label></strong>

    <select id="default"  class="default" name="whmc_sidepanel[whmc_del_option]">
 
        
    <option value="icon_23" <?php
        echo esc_attr($fcp_menu_style) == "icon_23" ? 'selected' : '';?>>icon_23</option>  

    <option value="icon_t-11" <?php
        echo esc_attr($fcp_menu_style) == "icon_t-11" ? 'selected' : '';?>>icon_t-11</option> 
    <option value="icon_t-12" <?php
        echo esc_attr($fcp_menu_style) == "icon_t-12" ? 'selected' : '';?>>icon_t-12</option> 
    <option value="icon_t-10" <?php
        echo esc_attr($fcp_menu_style) == "icon_t-10" ? 'selected' : '';?>>icon_t-10</option> 
    <option value="icon_t-9" <?php
        echo esc_attr($fcp_menu_style) == "icon_t-9" ? 'selected' : '';?>>icon_t-9</option> 
    <option value="icon_t-8" <?php
        echo esc_attr($fcp_menu_style) == "icon_t-8" ? 'selected' : '';?>>icon_t-8</option> 

    <option value="icon_t-7" <?php
        echo esc_attr($fcp_menu_style) == "icon_t-7" ? 'selected' : '';?>>icon_t-7</option>  
        
    <option value="icon_t-6" <?php
        echo esc_attr($fcp_menu_style) == "icon_t-6" ? 'selected' : '';?>>icon_t-6</option>  

        
    <option value="icon_t-5" <?php
        echo esc_attr($fcp_menu_style) == "icon_t-5" ? 'selected' : '';?>>icon_t-5</option>  

        
    <option value="icon_t-4" <?php
        echo esc_attr($fcp_menu_style) == "icon_t-4" ? 'selected' : '';?>>icon_t-4</option>  

        
    <option value="icon_t-3" <?php
        echo esc_attr($fcp_menu_style) == "icon_t-3" ? 'selected' : '';?>>icon_t-3</option>  

        
    <option value="icon_t-2" <?php
        echo esc_attr($fcp_menu_style) == "icon_t-2" ? 'selected' : '';?>>icon_t-2</option>  

        
    <option value="icon_t-1" <?php
        echo esc_attr($fcp_menu_style) == "icon-t-1" ? 'selected' : '';?>>icon-t-1</option> 
        
    <option value="icon_cancel-circle" <?php
        echo esc_attr($fcp_menu_style) == "icon_cancel-circle" ? 'selected' : '';?>>icon_cancel-circle</option>         
        <option value="icon_cross-1" <?php
        echo esc_attr($fcp_menu_style) == "icon_cross-1" ? 'selected' : '';?>>icon_cross-1</option> 


    </select></li>
    
          <?php

        printf('<li><strong class="whmc_ptc_tb"><label>'.esc_html__("Icon Color", "whmc").'</label></strong><input type="text" name="whmc_sidepanel[whmc_del_color]" value="%s"  class="side_bottom_color" ></li></ul>', $whmc_del_color);

    }


    public function wmhc_coupon_icons(){

        $sidepanels = get_option('whmc_sidepanel');

        $whmc_coupon_icon = isset($sidepanels['whmc_coupon_icon']) ? $sidepanels['whmc_coupon_icon'] : 'icon_d-1';
        $whmc_coupon_iconcolor = isset($sidepanels['whmc_coupon_iconcolor']) ? $sidepanels['whmc_coupon_iconcolor'] : '#929292';
        $wmhc_applycoupon_value = isset($sidepanels['wmhc_applycoupon_value']) ? $sidepanels['wmhc_applycoupon_value'] : esc_html__('Apply Code?','whmc');



    ?> 
    <ul class="whmc_ptc_wrape_tb"><li><strong class="whmc_ptc_tb"><label><?php echo esc_html('Choose a Icon ','whmc') ?></label></strong>

    <select id="default"  class="default" name="whmc_sidepanel[whmc_coupon_icon]">
    
     <option value="icon_d-1" <?php
        echo esc_attr($whmc_coupon_icon) == "icon_d-1" ? 'selected' : '';?>>icon_d-1</option>    
     <option value="icon_d-2" <?php
        echo esc_attr($whmc_coupon_icon) == "icon_d-2" ? 'selected' : '';?>>icon_d-2</option>    
    <option value="icon_d-4" <?php
        echo esc_attr($whmc_coupon_icon) == "icon_d-4" ? 'selected' : '';?>>icon_d-4</option>         
    <option value="icon_d-3" <?php
        echo esc_attr($whmc_coupon_icon) == "icon_d-3" ? 'selected' : '';?>>icon_d-3</option>         
    <option value="icon_d-5" <?php
        echo esc_attr($whmc_coupon_icon) == "icon_d-5" ? 'selected' : '';?>>icon_d-5</option>                
    <option value="icon_d-7" <?php
        echo esc_attr($whmc_coupon_icon) == "icon_d-7" ? 'selected' : '';?>>icon_d-7</option>         
    <option value="icon_d-8" <?php
        echo esc_attr($whmc_coupon_icon) == "icon_d-8" ? 'selected' : '';?>>icon_d-8</option>         
    <option value="icon_d-9" <?php
        echo esc_attr($whmc_coupon_icon) == "icon_d-9" ? 'selected' : '';?>>icon_d-9</option>         
    <option value="icon_d-10" <?php
        echo esc_attr($whmc_coupon_icon) == "icon_d-10" ? 'selected' : '';?>>icon_d-10</option>         
    <option value="icon_d-11" <?php
        echo esc_attr($whmc_coupon_icon) == "icon_d-11" ? 'selected' : '';?>>icon_d-11</option>     


    </select></li>
    <?php

    printf('<li><strong class="whmc_ptc_tb"><label>'.esc_html__("Icon Color", "whmc").'</label></strong><input type="text" name="whmc_sidepanel[whmc_coupon_iconcolor]" value="%s"  class="side_bottom_color" ></li>', $whmc_coupon_iconcolor);

    printf('<li><strong class="whmc_ptc_tb"><label>'.esc_html__("Text", "whmc").': </label></strong><input type="text" name="whmc_sidepanel[wmhc_applycoupon_value]" value="%s"  placeholder="'.esc_html__('Apply Coupon?','whmc').'"></li>', $wmhc_applycoupon_value);

    printf('<li><strong class="whmc_ptc_tb"><label>'.esc_html__("Disable this field", "whmc").':</label></strong><input type="checkbox" name="whmc_sidepanel[wmhc_cart_coupon_remove]" class="whmc_apple-switch"  value="wmhc_cart_coupon_remove" %s></li>', (isset($sidepanels['wmhc_cart_coupon_remove']) && $sidepanels['wmhc_cart_coupon_remove'] == 'wmhc_cart_coupon_remove') ? 'checked' : '');


    printf('<li><strong class="whmc_ptc_tb"><label>'.esc_html__("Hide all my coupons", "whmc").':</label></strong><input type="checkbox" name="whmc_sidepanel[wmhc_hideall_my_coupon]" class="whmc_apple-switch"  value="wmhc_hideall_my_coupon" %s></li></ul>', (isset($sidepanels['wmhc_hideall_my_coupon']) && $sidepanels['wmhc_hideall_my_coupon'] == 'wmhc_hideall_my_coupon') ? 'checked' : '');

    }

public function wmhc_coupon_imodla(){

        $sidepanels = get_option('whmc_sidepanel');

        $whmc_coupon_icon = isset($sidepanels['whmc_coupon_modalicon']) ? $sidepanels['whmc_coupon_modalicon'] : 'icon_d-1';
        $whmc_coupon_position = isset($sidepanels['whmc_coupon_position']) ? $sidepanels['whmc_coupon_position'] : 'bottom';

        $whmc_cmoiconclr = isset($sidepanels['whmc_cmoiconclr']) ? $sidepanels['whmc_cmoiconclr'] : '#dd1313';        
        $whmccoupon_modalibg = isset($sidepanels['whmccoupon_modalibg']) ? $sidepanels['whmccoupon_modalibg'] : '#fff';



    ?> 
    <ul class="whmc_ptc_wrape_tb"><li><strong class="whmc_ptc_tb"><label><?php echo esc_html('Icon before coupon Code?','whmc') ?></label></strong>

    <select id="default"  class="default" name="whmc_sidepanel[whmc_coupon_modalicon]">
    
     <option value="none" <?php
        echo esc_attr($whmc_coupon_icon) == "icon_d-1" ? 'selected' : '';?>>None</option>     
     <option value="icon_d-1" <?php
        echo esc_attr($whmc_coupon_icon) == "icon_d-1" ? 'selected' : '';?>>icon_d-1</option>       
     <option value="icon_d-2" <?php
        echo esc_attr($whmc_coupon_icon) == "icon_d-2" ? 'selected' : '';?>>icon_d-2</option>    

    <option value="icon_d-4" <?php
        echo esc_attr($whmc_coupon_icon) == "icon_d-4" ? 'selected' : '';?>>icon_d-4</option>         
    <option value="icon_d-3" <?php
        echo esc_attr($whmc_coupon_icon) == "icon_d-3" ? 'selected' : '';?>>icon_d-3</option>         
    <option value="icon_d-5" <?php
        echo esc_attr($whmc_coupon_icon) == "icon_d-5" ? 'selected' : '';?>>icon_d-5</option>              
    <option value="icon_d-7" <?php
        echo esc_attr($whmc_coupon_icon) == "icon_d-7" ? 'selected' : '';?>>icon_d-7</option>         
    <option value="icon_d-8" <?php
        echo esc_attr($whmc_coupon_icon) == "icon_d-8" ? 'selected' : '';?>>icon_d-8</option>         
    <option value="icon_d-9" <?php
        echo esc_attr($whmc_coupon_icon) == "icon_d-9" ? 'selected' : '';?>>icon_d-9</option>         
    <option value="icon_d-10" <?php
        echo esc_attr($whmc_coupon_icon) == "icon_d-10" ? 'selected' : '';?>>icon_d-10</option>         
    <option value="icon_d-11" <?php
        echo esc_attr($whmc_coupon_icon) == "icon_d-11" ? 'selected' : '';?>>icon_d-11</option>     


    </select></li>

    <li>
      <strong class="whmc_ptc_tb"><label><?php echo esc_html('Coupon Code Position','whmc') ?></label></strong>
  
<select name="whmc_sidepanel[whmc_coupon_position]">
    
     <option value="top" <?php
        echo esc_attr($whmc_coupon_position) == "top" ? 'selected' : '';?>>Top</option>
     <option value="bottom" <?php
        echo esc_attr($whmc_coupon_position) == "bottom" ? 'selected' : '';?>>Bottom</option>
    </select>

    </li>
    <?php

    printf('<li><strong class="whmc_ptc_tb"><label>'.esc_html__("Icon Color", "whmc").'</label></strong><input type="text" name="whmc_sidepanel[whmc_cmoiconclr]" value="%s"  class="side_bottom_color" ></li>', $whmc_cmoiconclr);

    printf('<li><strong class="whmc_ptc_tb"><label>'.esc_html__("Box Background", "whmc").'</label></strong><input type="text" name="whmc_sidepanel[whmccoupon_modalibg]" value="%s"  class="side_bottom_color" ></li>', $whmccoupon_modalibg);

    printf('<li><strong class="whmc_ptc_tb"><label>'.esc_html__("Hide coupon description", "whmc").':</label></strong><input type="checkbox" name="whmc_sidepanel[wmhc_hide_copnds]" class="whmc_apple-switch"  value="wmhc_hide_copnds" %s></li></ul>', (isset($sidepanels['wmhc_hide_copnds']) && $sidepanels['wmhc_hide_copnds'] == 'wmhc_hide_copnds') ? 'checked' : '');

    }



    public function wmhc_top_icon()
    {

        $options = get_option('whmc_sidepanel');;
        $fcp_icon_option = isset($options['fcp_top_icon']) ? $options['fcp_top_icon'] : 'fcp_icon_3';

    ?>

    <select id="default"  class="default" name="whmc_sidepanel[fcp_top_icon]">
    
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
        
            <?php
    }

    public function wmhc_cart_side_toppart_background()
    {

        $sidepanels = get_option('whmc_sidepanel');

        $wmhcside_toppart_bg = isset($sidepanels['wmhcside_toppart_bg']) ? $sidepanels['wmhcside_toppart_bg'] : '#bfd6b1';

        $wmhcside_toppart_icon = isset($sidepanels['wmhcside_toppart_icon']) ? $sidepanels['wmhcside_toppart_icon'] : '#77c92a';
        $wmhcside_toppart_txt = isset($sidepanels['wmhcside_toppart_txt']) ? $sidepanels['wmhcside_toppart_txt'] : '#505050';
        $wmhcside_toppart_txtcu = isset($sidepanels['wmhcside_toppart_txtcu']) ? $sidepanels['wmhcside_toppart_txtcu'] : esc_html__('Cart items','whmc');

        printf('<ul class="whmc_ptc_wrape_tb"><li><strong class="whmc_ptc_tb"><label> '.esc_html__("Top Background", "whmc").'</label></strong>
                <input type="text" name="whmc_sidepanel[wmhcside_toppart_bg]" value="%s"  class="side_bottom_color" ></li>', $wmhcside_toppart_bg);

        printf('<li><strong class="whmc_ptc_tb"><label>'.esc_html__("Icon Color", "whmc").'</label></strong>
                  <input type="text" name="whmc_sidepanel[wmhcside_toppart_icon]" value="%s"  class="side_bottom_color" ></li>', $wmhcside_toppart_icon);

        printf('<li><strong class="whmc_ptc_tb"><label >'.esc_html__("Text Color", "whmc").'</label></strong>
                  <input type="text" name="whmc_sidepanel[wmhcside_toppart_txt]" value="%s"  class="side_bottom_color" ></li>', $wmhcside_toppart_txt);

        printf('<li><strong class="whmc_ptc_tb"><label > '.esc_html__("Change Text?", "whmc").'</label></strong><input type="text" name="whmc_sidepanel[wmhcside_toppart_txtcu]" value="%s" placeholder="'.esc_html('Cart Items', 'whmc').'"></li></ul>', $wmhcside_toppart_txtcu);

    }

    public function wmhc_cart_side_top_background()
    {

        $sidepanels = get_option('whmc_sidepanel');


        $wmhc_cart_side_border_btm = isset($sidepanels['wmhc_cart_side_border_btm']) ? $sidepanels['wmhc_cart_side_border_btm'] : '#e2e2e2';

        printf('<input type="text" name="whmc_sidepanel[wmhc_cart_side_border_btm]" value="%s"  class="side_bottom_color" >', $wmhc_cart_side_border_btm);

    }

    public function wmhc_cart_side_toppart_nofi()
    {

        $sidepanels = get_option('whmc_sidepanel');
        $productupdate = isset($sidepanels['productupdate']) ? $sidepanels['productupdate'] : esc_html__('Product Update Successfully','whmc');

        $Couponremove = isset($sidepanels['Couponremove']) ? $sidepanels['Couponremove'] : esc_html__('Coupon Removed Successfully','whmc');
        $Couponempty = isset($sidepanels['Couponempty']) ? $sidepanels['Couponempty'] : esc_html__('Coupon Code Field is Empty!','whmc');
        $Couponapply = isset($sidepanels['Couponapply']) ? $sidepanels['Couponapply'] : esc_html__('Coupon Code Already Applied.','whmc');
        $Couponinvalid = isset($sidepanels['Couponinvalid']) ? $sidepanels['Couponinvalid'] : esc_html__('Invalid code entered. Please try again.','whmc');

        $Couponsuccess = isset($sidepanels['Couponsuccess']) ? $sidepanels['Couponsuccess'] : esc_html__('Coupon Applied Successfully','whmc');

        $adressupdate = isset($sidepanels['adressupdate']) ? $sidepanels['adressupdate'] : esc_html__('Address update','whmc');

        printf('<ul class="topnofici"><li><strong class="whmc_ptc_tb"></strong><input type="text" name="whmc_sidepanel[productupdate]" value="%s" placeholder="'.esc_html('Product Update Successfully', 'whmc').'"class="sidebarinputifeld"></li>', $productupdate);


        printf('<li><strong class="whmc_ptc_tb"></strong><input type="text" name="whmc_sidepanel[Couponsuccess]" value="%s" placeholder="'.esc_html('Coupon Applied Successfully', 'whmc').'"class="sidebarinputifeld"></li>', $Couponsuccess);
        
        printf('<li><strong class="whmc_ptc_tb"></strong><input type="text" name="whmc_sidepanel[Couponremove]" value="%s" placeholder="'.esc_html('Coupon Removed Successfully', 'whmc').'"class="sidebarinputifeld"></li>', $Couponremove);

        printf('<li><strong class="whmc_ptc_tb"></strong><input type="text" name="whmc_sidepanel[Couponapply]" value="%s" placeholder="'.esc_html('Coupon Code Already Applied.', 'whmc').'"class="sidebarinputifeld"></li>', $Couponapply);

        printf('<li><strong class="whmc_ptc_tb"></strong><input type="text" name="whmc_sidepanel[Couponempty]" value="%s" placeholder="'.esc_html('Coupon Code Field is Empty!', 'whmc').'"class="sidebarinputifeld"></li>', $Couponempty);  

        printf('<li><strong class="whmc_ptc_tb"></strong><input type="text" name="whmc_sidepanel[Couponinvalid]" value="%s" placeholder="'.esc_html('Invalid code entered. Please try again.', 'whmc').'"class="sidebarinputifeld"></li>', $Couponinvalid);

        printf('<li><strong class="whmc_ptc_tb"></strong><input type="text" name="whmc_sidepanel[adressupdate]" value="%s" placeholder="'.esc_html('Address Update!', 'whmc').'"class="sidebarinputifeld"></li></ul>', $adressupdate);


    }
    
    public function wmhc_cart_side_subtotal()
    {

        $sidepanels = get_option('whmc_sidepanel');

        $wmhc_cart_side_subtotal = isset($sidepanels['wmhc_cart_side_subtotal']) ? $sidepanels['wmhc_cart_side_subtotal'] : '';

        $wmhc_cart_side_subtoral_font = isset($sidepanels['wmhc_cart_side_subtoral_font']) ? $sidepanels['wmhc_cart_side_subtoral_font'] : '14';

        $sidepanels_subtototal_value = isset($sidepanels['wmhc_subtototal_value']) ? $sidepanels['wmhc_subtototal_value'] : esc_html__('Sub total','whmc');

        printf('<ul class="whmc_ptc_wrape_tb"><li><strong class="whmc_ptc_tb"><label>'.esc_html__("Title", "whmc").': </label></strong>
        <input type="text" name="whmc_sidepanel[wmhc_subtototal_value]" value="%s"  placeholder="Sub total"></li>', $sidepanels_subtototal_value);

        printf('<li><strong class="whmc_ptc_tb"><label >'.esc_html__("Color", "whmc").'</label></strong><input type="text" name="whmc_sidepanel[wmhc_cart_side_subtotal]" value="%s"  class="side_bottom_color" ></<li>', $wmhc_cart_side_subtotal);

        printf('<li><strong class="whmc_ptc_tb"><label>'.esc_html__("Font Size (Px)", "whmc").'</label></strong><input type="number" min="12" max="20" name="whmc_sidepanel[wmhc_cart_side_subtoral_font]" value="%s"></li>', $wmhc_cart_side_subtoral_font);

        printf('<li><strong class="whmc_ptc_tb"><label>'.esc_html__("Disable this field", "whmc").':</label></strong><input type="checkbox" name="whmc_sidepanel[wmhc_cart_subtotal_remove]" class="whmc_apple-switch" value="wmhc_cart_subtotal_remove" %s></li></ul>', (isset($sidepanels['wmhc_cart_subtotal_remove']) && $sidepanels['wmhc_cart_subtotal_remove'] == 'wmhc_cart_subtotal_remove') ? 'checked' : '');

    }  
    public function wmhc_cart_shipping()
    {

        $sidepanels = get_option('whmc_sidepanel');

        $wmhc_cart_shipping = isset($sidepanels['wmhc_cart_shipping']) ? $sidepanels['wmhc_cart_shipping'] : '';

        $wmhc_cart_side_shipping_font = isset($sidepanels['wmhc_cart_side_shipping_font']) ? $sidepanels['wmhc_cart_side_shipping_font'] : '14';

        $wmhc_shipping_value = isset($sidepanels['wmhc_shipping_value']) ? $sidepanels['wmhc_shipping_value'] : esc_html__('Shipping','whmc');

        printf('<ul class="whmc_ptc_wrape_tb"><li><strong class="whmc_ptc_tb"><label>'.esc_html__("Title", "whmc").': </label></strong><input type="text" name="whmc_sidepanel[wmhc_shipping_value]" value="%s"  placeholder="Shipping"></li>', $wmhc_shipping_value);

        printf('<li><strong class="whmc_ptc_tb"><label>'.esc_html__("Color", "whmc").'</label></strong><input type="text" name="whmc_sidepanel[wmhc_cart_shipping]" value="%s"  class="side_bottom_color" ></<li>', $wmhc_cart_shipping);

        printf('<li><strong class="whmc_ptc_tb"><label>'.esc_html__("Font Size", "whmc").'</label></strong><input type="number" min="12" max="20" name="whmc_sidepanel[wmhc_cart_side_shipping_font]" value="%s"></li>', $wmhc_cart_side_shipping_font);

        printf('<li><strong class="whmc_ptc_tb"><label>'.esc_html__("Disable this field", "whmc").':</label></strong><input type="checkbox" name="whmc_sidepanel[wmhc_cart_shipping_remove]" class="whmc_apple-switch" value="wmhc_cart_shipping_remove" %s></li></ul>', (isset($sidepanels['wmhc_cart_shipping_remove']) && $sidepanels['wmhc_cart_shipping_remove'] == 'wmhc_cart_shipping_remove') ? 'checked' : '');


    }

    public function wmhcside_btm_shipping()
    {

        $sidepanels = get_option('whmc_sidepanel');

        $wmhcside_btm_shipping = isset($sidepanels['wmhcside_btm_shipping']) ? $sidepanels['wmhcside_btm_shipping'] : esc_html__('Tax','whmc');


        $wmhc_cart_shipping_font = isset($sidepanels['wmhc_cart_shipping_font']) ? $sidepanels['wmhc_cart_shipping_font'] : '14';

        $wmhc_shipping_Color = isset($sidepanels['wmhc_shipping_Color']) ? $sidepanels['wmhc_shipping_Color'] : '0';

        printf('<ul class="whmc_ptc_wrape_tb"><li><strong class="whmc_ptc_tb"><label>'.esc_html__("Title", "whmc").': </label></strong>
        <input type="text" name="whmc_sidepanel[wmhcside_btm_shipping]" value="%s"  placeholder="Tax"></li>', $wmhcside_btm_shipping);

        printf('<li><strong class="whmc_ptc_tb"><label>'.esc_html__("Text Color", "whmc").'</label></strong><input type="text" name="whmc_sidepanel[wmhc_shipping_Color]" value="%s"  class="side_bottom_color" ></<li>', $wmhc_shipping_Color);

        printf('<li><strong class="whmc_ptc_tb"><label>'.esc_html__("Font size", "whmc").'</label></strong><input type="number" min="10" max="20" name="whmc_sidepanel[wmhc_cart_shipping_font]" value="%s"></li>', $wmhc_cart_shipping_font);


        printf('<li><strong class="whmc_ptc_tb"><label>'.esc_html__("Disable this field", "whmc").':</label></strong><input type="checkbox" name="whmc_sidepanel[wmhc_cart_tax_remove]" class="whmc_apple-switch" value="wmhc_cart_tax_remove" %s></li></ul>', (isset($sidepanels['wmhc_cart_tax_remove']) && $sidepanels['wmhc_cart_tax_remove'] == 'wmhc_cart_tax_remove') ? 'checked' : '');
    }

    public function wmhcside_btm_discount()
    {

        $sidepanels = get_option('whmc_sidepanel');

        $wmhcside_btm_discount = isset($sidepanels['wmhcside_btm_discount']) ? $sidepanels['wmhcside_btm_discount'] :  esc_html__('Discount','whmc');

        $wmhc_cart_discount_font = isset($sidepanels['wmhc_cart_discount_font']) ? $sidepanels['wmhc_cart_discount_font'] : '14';

        $wmhc_discount_color = isset($sidepanels['wmhc_discount_color']) ? $sidepanels['wmhc_discount_color'] : '0';

        printf('<ul class="whmc_ptc_wrape_tb"><li><strong class="whmc_ptc_tb"><label>'.esc_html__("Title", "whmc").'</label></strong>
        <input type="text" name="whmc_sidepanel[wmhcside_btm_discount]" value="%s"  placeholder="Discount"></li>', $wmhcside_btm_discount);

        printf('<li><strong class="whmc_ptc_tb"><label>'.esc_html__("Text Color", "whmc").'</label></strong><input type="text" name="whmc_sidepanel[wmhc_discount_color]" value="%s"  class="side_bottom_color" ></<li>', $wmhc_discount_color);

        printf('<li><strong class="whmc_ptc_tb"><label>'.esc_html__("Font Size", "whmc").'</label></strong><input type="number" min="10" max="20" name="whmc_sidepanel[wmhc_cart_discount_font]" value="%s"></li>', $wmhc_cart_discount_font);


    }

    public function wmhcside_btm_total()
    {

        $sidepanels = get_option('whmc_sidepanel');

        $wmhcside_btm_total = isset($sidepanels['wmhcside_btm_total']) ? $sidepanels['wmhcside_btm_total'] : esc_html__('Total','whmc');

        $wmhc_cart_total_font = isset($sidepanels['wmhc_cart_total_font']) ? $sidepanels['wmhc_cart_total_font'] : '14';

        $wmhc_total_color = isset($sidepanels['wmhc_total_color']) ? $sidepanels['wmhc_total_color'] : '0';

        printf('<ul class="whmc_ptc_wrape_tb"><li><strong class="whmc_ptc_tb"><label>'.esc_html__("Title", "whmc").' </label></strong><input type="text" name="whmc_sidepanel[wmhcside_btm_total]" value="%s"  placeholder="'.esc_html__("Total ", "whmc").'"></li>', $wmhcside_btm_total);

        printf('<li><strong class="whmc_ptc_tb"><label >'.esc_html__("Text Color", "whmc").'</label></strong><input type="text" name="whmc_sidepanel[wmhc_total_color]" value="%s"  class="side_bottom_color" ></<li>', $wmhc_total_color);

        printf('<li><strong class="whmc_ptc_tb"><label>'.esc_html__("Font Size", "whmc").'</label></strong><input type="number" min="10" max="20" name="whmc_sidepanel[wmhc_cart_total_font]" value="%s"></li></ul>', $wmhc_cart_total_font);

    }

    public function wmhc_cart_side_button_text_color()
    {

        $sidepanels = get_option('whmc_sidepanel');
        $sidepanels_rang_value = isset($sidepanels['wmhc_cart_side_button_text_color']) ? $sidepanels['wmhc_cart_side_button_text_color'] : '#fff';

        $wmhc_cart_side_button_color = isset($sidepanels['wmhc_cart_side_button_color']) ? $sidepanels['wmhc_cart_side_button_color'] :'#2519a8';

        $sidepanels_chekout_text_value = isset($sidepanels['wmhc_chekout_text_value']) ? $sidepanels['wmhc_chekout_text_value'] : esc_html__('Checkout','whmc');
        $sidepanels_cart_text_value = isset($sidepanels['wmhc_cart_text_value']) ? $sidepanels['wmhc_cart_text_value'] : esc_html__('Cart','whmc');
        $whmc_keepshop_text_value = isset($sidepanels['whmc_keepshop_text_value']) ? $sidepanels['whmc_keepshop_text_value'] : 'Keep Shopping';

        printf('<ul class="whmc_ptc_wrape_tb"> <li><strong class="whmc_ptc_tb"><label >'.esc_html__("Change the title of the Cart  button", "whmc").': </label></strong>
        <input type="text" name="whmc_sidepanel[wmhc_cart_text_value]" value="%s" placeholder="Cart" ></li>', $sidepanels_cart_text_value);

        printf('<li><strong class="whmc_ptc_tb"><label >'.esc_html__("Change the title of the checkout button ", "whmc").'</label></strong>
        <input type="text" name="whmc_sidepanel[wmhc_chekout_text_value]" value="%s"  placeholder="Checkout"></li>', $sidepanels_chekout_text_value);

        printf('<li><strong class="whmc_ptc_tb"><label >'.esc_html__("Keep Shopping Text", "whmc").'</label></strong><input type="text" name="whmc_sidepanel[whmc_keepshop_text_value]" value="%s"  placeholder="Keep Shopping"></li>', $whmc_keepshop_text_value);

        printf('<li><strong class="whmc_ptc_tb"><label for="wmhc__text_size">'.esc_html__("Background", "whmc").'</label></strong><input type="text" name="whmc_sidepanel[wmhc_cart_side_button_color]" value="%s"  class="side_button_color" ></li>', $wmhc_cart_side_button_color);

        printf('<li><strong class="whmc_ptc_tb"><label for="wmhc__text_size">'.esc_html__("Color", "whmc").'</label></strong><input type="text" name="whmc_sidepanel[wmhc_cart_side_button_text_color]" value="%s"  class="side_bottom_text_color" ></li></ul>', $sidepanels_rang_value);

    }

    public function wmhc_cart_side_text_color()
    {

        $sidepanels = get_option('whmc_sidepanel');
        $sidepanels_rang_value = isset($sidepanels['wmhc_cart_side_text_color']) ? $sidepanels['wmhc_cart_side_text_color'] : '#3a3a3a';
        $wmhc_cart_side_text_size = isset($sidepanels['wmhc_cart_side_text_size']) ? $sidepanels['wmhc_cart_side_text_size'] : '12';

        printf('<strong class="whmc_ptcs"><label for="wmhc__text_size">'.esc_html__("Text Color", "whmc").'</label></strong><input type="text" name="whmc_sidepanel[wmhc_cart_side_text_color]" value="%s"  class="side_text_color" >', $sidepanels_rang_value);

        printf('<strong class="whmc_ptc"><label for="wmhc__text_size">'.esc_html__("Font Size", "whmc").'</label></strong><input type="number" min="12" max="20" name="whmc_sidepanel[wmhc_cart_side_text_size]" value="%s" id="wmhc__text_size">', $wmhc_cart_side_text_size);

    }
    public function wmhc_cart_side_price_color()
    {

        $sidepanels = get_option('whmc_sidepanel');
        $wmhc_cart_side_price_color = isset($sidepanels['wmhc_cart_side_price_color']) ? $sidepanels['wmhc_cart_side_price_color'] : '#4fe200';
        $wmhc_cart_side_price_size = isset($sidepanels['wmhc_cart_side_price_size']) ? $sidepanels['wmhc_cart_side_price_size'] : '10';

        printf('<strong class="whmc_ptcs"><label for="wmhc__text_size">'.esc_html__("Text Color", "whmc").'</label></strong><input type="text" name="whmc_sidepanel[wmhc_cart_side_price_color]" value="%s"  class="side_text_color" >', $wmhc_cart_side_price_color);

        printf('<strong class="whmc_ptc"><label for="wmhc__text_size">'.esc_html__("Font size", "whmc").'</label></strong><input type="number" min="10" max="20" name="whmc_sidepanel[wmhc_cart_side_price_size]" value="%s" id="wmhc__text_size">', $wmhc_cart_side_price_size);

    }

    public function wmhc_cart_side_text_change()
    {

        $sidepanels = get_option('whmc_sidepanel');

        $sidepanels_no_cart_text_value = isset($sidepanels['wmhc_no_cart_text_value']) ? $sidepanels['wmhc_no_cart_text_value'] : esc_html__('No product in the cart.','whmc');

        printf('<ul class="whmc_ptc_wrape_tb" ><li><strong class="whmc_ptc_tb">'.esc_html__("Change the text of the 'Empty Cart Message'", "whmc").':</label></strong><textarea rows="3" cols="40" name="whmc_sidepanel[wmhc_no_cart_text_value]" placeholder="No product in the cart...">%s</textarea></li>', $sidepanels_no_cart_text_value);

        printf('<li><strong class="whmc_ptc_tb"><label> '.esc_html__("Remove Cart Buton", "whmc").':</label></strong><input type="checkbox" name="whmc_sidepanel[wmhc_cart_side_hide]" class="whmc_apple-switch"  value="wmhc_cart_side_hide" %s></li>', (isset($sidepanels['wmhc_cart_side_hide']) && $sidepanels['wmhc_cart_side_hide'] == 'wmhc_cart_side_hide') ? 'checked' : '');

        printf('<li><strong class="whmc_ptc_tb"><label>'.esc_html__("Remove Keep Shopping Button", "whmc").'</label></strong><input type="checkbox" name="whmc_sidepanel[wmhc_cart_side_hide_kshop]" class="whmc_apple-switch"  value="wmhc_cart_side_hide_kshop" %s></li>', (isset($sidepanels['wmhc_cart_side_hide_kshop']) && $sidepanels['wmhc_cart_side_hide_kshop'] == 'wmhc_cart_side_hide_kshop') ? 'checked' : '');


    }
    public function wmhc_cart_side_autup()
    {

        $sidepanels = get_option('whmc_sidepanel');

        printf('<input type="checkbox" name="whmc_sidepanel[wmhc_cart_side_autup]" class="whmc_apple-switch"  value="wmhc_cart_side_autup" %s><p class="whmc_description">'.esc_html__("The sidebar opens automatically after carting a product, click to close it", "whmc").'</p>', (isset($sidepanels['wmhc_cart_side_autup']) && $sidepanels['wmhc_cart_side_autup'] === 'wmhc_cart_side_autup') ? 'checked' : '');

    }    

    public function wmhc_wrapper_bg()
    {

        $sidepanels = get_option('whmc_sidepanel');


        $wmhc_cart_side_top_background = isset($sidepanels['wmhc_cart_side_top_background']) ? $sidepanels['wmhc_cart_side_top_background'] : '#fff7f7';
        
        
        printf('<input type="text" name="whmc_sidepanel[wmhc_cart_side_top_background]" value="%s"  class="side_bottom_color" >', $wmhc_cart_side_top_background);

    }
    public function wmhc_cart_side_position()
    {

        $sidepanels = get_option('whmc_sidepanel');

        printf('<input type="checkbox" name="whmc_sidepanel[wmhc_cart_side_position]" class="whmc_apple-switch"  value="wmhc_cart_side_position" %s><p class="whmc_description">'.esc_html__("Click to change sidebar from left to right,Default:Left", "whmc").'</p>', (isset($sidepanels['wmhc_cart_side_position']) && $sidepanels['wmhc_cart_side_position'] === 'wmhc_cart_side_position') ? 'checked' : '');

    }

    public function whmc_side_img_brious()
    {

        $sidepanels = get_option('whmc_sidepanel');

        printf('<input type="checkbox" name="whmc_sidepanel[whmc_side_img_brious]" class="whmc_apple-switch"  value="whmc_side_img_brious" %s>', (isset($sidepanels['whmc_side_img_brious']) && $sidepanels['whmc_side_img_brious'] === 'whmc_side_img_brious') ? 'checked' : '');

    }

    /**
     * admin form field validation
     */

    public function whmc_sidepanel_page_sanitized($input)
    {
        $sanitary_values = array();

        if (isset($input['wmhc_cart_side_position']))
        {
            $sanitary_values['wmhc_cart_side_position'] = $input['wmhc_cart_side_position'];
        }
        if (isset($input['wmhc_cart_side_autup']))
        {
            $sanitary_values['wmhc_cart_side_autup'] = $input['wmhc_cart_side_autup'];
        }

        if (isset($input['wmhc_cart_side_text_color']))
        {
            $sanitary_values['wmhc_cart_side_text_color'] = $input['wmhc_cart_side_text_color'];
        }

        if (isset($input['wmhc_cart_side_button_text_color']))
        {
            $sanitary_values['wmhc_cart_side_button_text_color'] = $input['wmhc_cart_side_button_text_color'];
        }

        if (isset($input['wmhc_no_cart_text_value']))
        {
            $sanitary_values['wmhc_no_cart_text_value'] = sanitize_text_field($input['wmhc_no_cart_text_value']);
        }
        if (isset($input['wmhc_cart_side_hide']))
        {
            $sanitary_values['wmhc_cart_side_hide'] = sanitize_text_field($input['wmhc_cart_side_hide']);
        }

        if (isset($input['wmhc_chekout_text_value']))
        {
            $sanitary_values['wmhc_chekout_text_value'] = sanitize_text_field($input['wmhc_chekout_text_value']);
        }

        if (isset($input['wmhc_cart_text_value']))
        {
            $sanitary_values['wmhc_cart_text_value'] = sanitize_text_field($input['wmhc_cart_text_value']);
        }

        if (isset($input['wmhc_subtototal_value']))
        {
            $sanitary_values['wmhc_subtototal_value'] = sanitize_text_field($input['wmhc_subtototal_value']);
        }

        if (isset($input['wmhc_cart_side_button_color']))
        {
            $sanitary_values['wmhc_cart_side_button_color'] = $input['wmhc_cart_side_button_color'];
        }


        if (isset($input['wmhc_cart_side_top_background']))
        {
            $sanitary_values['wmhc_cart_side_top_background'] = $input['wmhc_cart_side_top_background'];
        }

        if (isset($input['whmc_side_img_brious']))
        {
            $sanitary_values['whmc_side_img_brious'] = $input['whmc_side_img_brious'];
        }
        if (isset($input['wmhc_cart_side_text_size']))
        {
            $sanitary_values['wmhc_cart_side_text_size'] = $input['wmhc_cart_side_text_size'];
        }
        if (isset($input['wmhc_cart_side_price_size']))
        {
            $sanitary_values['wmhc_cart_side_price_size'] = $input['wmhc_cart_side_price_size'];
        }
        if (isset($input['wmhc_cart_side_price_color']))
        {
            $sanitary_values['wmhc_cart_side_price_color'] = $input['wmhc_cart_side_price_color'];
        }
        if (isset($input['wmhc_cart_side_border_btm']))
        {
            $sanitary_values['wmhc_cart_side_border_btm'] = $input['wmhc_cart_side_border_btm'];
        }
        if (isset($input['wmhc_cart_side_subtoral_font']))
        {
            $sanitary_values['wmhc_cart_side_subtoral_font'] = $input['wmhc_cart_side_subtoral_font'];
        }
        if (isset($input['wmhc_cart_side_subtotal']))
        {
            $sanitary_values['wmhc_cart_side_subtotal'] = $input['wmhc_cart_side_subtotal'];
        }
        if (isset($input['wmhc_cart_side_hide_kshop']))
        {
            $sanitary_values['wmhc_cart_side_hide_kshop'] = $input['wmhc_cart_side_hide_kshop'];
        }
        if (isset($input['whmc_del_option']))
        {
            $sanitary_values['whmc_del_option'] = $input['whmc_del_option'];
        }

        if (isset($input['whmc_keepshop_text_value']))
        {
            $sanitary_values['whmc_keepshop_text_value'] = $input['whmc_keepshop_text_value'];
        }

        if (isset($input['wmhcside_toppart_txtcu']))
        {
            $sanitary_values['wmhcside_toppart_txtcu'] = $input['wmhcside_toppart_txtcu'];
        }

        if (isset($input['wmhcside_toppart_txt']))
        {
            $sanitary_values['wmhcside_toppart_txt'] = $input['wmhcside_toppart_txt'];
        }

        if (isset($input['wmhcside_toppart_icon']))
        {
            $sanitary_values['wmhcside_toppart_icon'] = $input['wmhcside_toppart_icon'];
        }

        if (isset($input['wmhcside_toppart_bg']))
        {
            $sanitary_values['wmhcside_toppart_bg'] = $input['wmhcside_toppart_bg'];
        }

        if (isset($input['wmhcside_btm_shipping']))
        {
            $sanitary_values['wmhcside_btm_shipping'] = $input['wmhcside_btm_shipping'];
        }
        if (isset($input['wmhc_cart_shipping_font']))
        {
            $sanitary_values['wmhc_cart_shipping_font'] = $input['wmhc_cart_shipping_font'];
        }
        if (isset($input['wmhc_shipping_Color']))
        {
            $sanitary_values['wmhc_shipping_Color'] = $input['wmhc_shipping_Color'];
        }

        if (isset($input['whmc_del_color']))
        {
            $sanitary_values['whmc_del_color'] = $input['whmc_del_color'];
        }
        if (isset($input['whmc_coupon_icon']))
        {
            $sanitary_values['whmc_coupon_icon'] = $input['whmc_coupon_icon'];
        }
        if (isset($input['whmc_cmoiconclr']))
        {
            $sanitary_values['whmc_cmoiconclr'] = $input['whmc_cmoiconclr'];
        }
        if (isset($input['wmhc_cart_shipping']))
        {
            $sanitary_values['wmhc_cart_shipping'] = $input['wmhc_cart_shipping'];
        }
        if (isset($input['wmhc_cart_side_shipping_font']))
        {
            $sanitary_values['wmhc_cart_side_shipping_font'] = $input['wmhc_cart_side_shipping_font'];
        }
        if (isset($input['wmhc_shipping_value']))
        {
            $sanitary_values['wmhc_shipping_value'] = $input['wmhc_shipping_value'];
        }

        if (isset($input['wmhcside_btm_discount']))
        {
            $sanitary_values['wmhcside_btm_discount'] = $input['wmhcside_btm_discount'];
        }

        if (isset($input['wmhc_cart_discount_font']))
        {
            $sanitary_values['wmhc_cart_discount_font'] = $input['wmhc_cart_discount_font'];
        }

        if (isset($input['wmhc_discount_color']))
        {
            $sanitary_values['wmhc_discount_color'] = $input['wmhc_discount_color'];
        }

        if (isset($input['wmhc_total_color']))
        {
            $sanitary_values['wmhc_total_color'] = $input['wmhc_total_color'];
        }

        if (isset($input['wmhc_cart_total_font']))
        {
            $sanitary_values['wmhc_cart_total_font'] = $input['wmhc_cart_total_font'];
        }

        if (isset($input['wmhcside_btm_total']))
        {
            $sanitary_values['wmhcside_btm_total'] = $input['wmhcside_btm_total'];
        }
        if (isset($input['wmhc_cart_subtotal_remove']))
        {
            $sanitary_values['wmhc_cart_subtotal_remove'] = $input['wmhc_cart_subtotal_remove'];
        }
        if (isset($input['wmhc_cart_shipping_remove']))
        {
            $sanitary_values['wmhc_cart_shipping_remove'] = $input['wmhc_cart_shipping_remove'];
        }
        if (isset($input['wmhc_cart_tax_remove']))
        {
            $sanitary_values['wmhc_cart_tax_remove'] = $input['wmhc_cart_tax_remove'];
        }
        if (isset($input['wmhc_applycoupon_value']))
        {
            $sanitary_values['wmhc_applycoupon_value'] = $input['wmhc_applycoupon_value'];
        }
        if (isset($input['wmhc_cart_coupon_remove']))
        {
            $sanitary_values['wmhc_cart_coupon_remove'] = $input['wmhc_cart_coupon_remove'];
        }
        if (isset($input['wmhc_hideall_my_coupon']))
        {
            $sanitary_values['wmhc_hideall_my_coupon'] = $input['wmhc_hideall_my_coupon'];
        }
        if (isset($input['fcp_top_icon']))
        {
            $sanitary_values['fcp_top_icon'] = $input['fcp_top_icon'];
        }
        if (isset($input['productupdate']))
        {
            $sanitary_values['productupdate'] = $input['productupdate'];
        }
        if (isset($input['Couponremove']))
        {
            $sanitary_values['Couponremove'] = $input['Couponremove'];
        }
        if (isset($input['Couponempty']))
        {
            $sanitary_values['Couponempty'] = $input['Couponempty'];
        }
        if (isset($input['Couponapply']))
        {
            $sanitary_values['Couponapply'] = $input['Couponapply'];
        }
        if (isset($input['Couponinvalid']))
        {
            $sanitary_values['Couponinvalid'] = $input['Couponinvalid'];
        }
        if (isset($input['Couponsuccess']))
        {
            $sanitary_values['Couponsuccess'] = $input['Couponsuccess'];
        }
        if (isset($input['adressupdate']))
        {
            $sanitary_values['adressupdate'] = $input['adressupdate'];
        }
        if (isset($input['whmccoupon_modaliconcolor']))
        {
            $sanitary_values['whmccoupon_modaliconcolor'] = $input['whmccoupon_modaliconcolor'];
        }
        if (isset($input['whmc_coupon_position']))
        {
            $sanitary_values['whmc_coupon_position'] = $input['whmc_coupon_position'];
        }
        if (isset($input['whmc_coupon_modalicon']))
        {
            $sanitary_values['whmc_coupon_modalicon'] = $input['whmc_coupon_modalicon'];
        }
        if (isset($input['wmhc_hide_copnds']))
        {
            $sanitary_values['wmhc_hide_copnds'] = $input['wmhc_hide_copnds'];
        }

        if (isset($input['whmccoupon_modalibg']))
        {
            $sanitary_values['whmccoupon_modalibg'] = $input['whmccoupon_modalibg'];
        }
        if (isset($input['whmc_coupon_iconcolor']))
        {
            $sanitary_values['whmc_coupon_iconcolor'] = $input['whmc_coupon_iconcolor'];
        }




        return $sanitary_values;
    }

}

if(class_exists('WHMC_Admin_Sidebar_Pro')){

    new WHMC_Admin_Sidebar_Pro();
}

