<?php
/**
 * The admin-specific functionality of the plugin.
 *
 * @since      4.0.1
 *
 * @package    WHMC
 * @subpackage WHMC/admin
 */

class WHMC_Notifation
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
            'whmc_notification_settings_page'
        ));

    }

    public function whmc_notification_settings_page()
    {

        register_setting("whmc_notification", "whmc_notification", array(
            $this,
            'whmc_notification_page_sanitize'
        )); // sanitize_callback);
        

        add_settings_section("notification_section_setting", " ", array(
            $this,
            'settting_sec_func'
        ) , 'whmc_admin_sec_notification');

        add_settings_field("notification_enabes_whmc", esc_html__("Disable Notification Box?", "whmc") , array(
            $this,
            "notification_enabes_whmc"
        ) , 'whmc_admin_sec_notification', "notification_section_setting");

        add_settings_field("notification_position", esc_html__("Box Position", "whmc") , array(
            $this,
            "notification_position"
        ) , 'whmc_admin_sec_notification', "notification_section_setting");

        add_settings_field("wmhc_notification_added_text", esc_html__("Added Text Modify", "whmc") , array(
            $this,
            "wmhc_notification_added_text"
        ) , 'whmc_admin_sec_notification', "notification_section_setting");

        add_settings_field("notification_title_color", esc_html__("Title Color", "whmc") , array(
            $this,
            "notification_title_color"
        ) , 'whmc_admin_sec_notification', "notification_section_setting");

        add_settings_field("notification_background_color", esc_html__("Box Background", "whmc") , array(
            $this,
            "notification_background_color"
        ) , 'whmc_admin_sec_notification', "notification_section_setting");

        add_settings_field("notification_boxshadow", esc_html__("Box Shadow Color", "whmc") , array(
            $this,
            "notification_boxshadow"
        ) , 'whmc_admin_sec_notification', "notification_section_setting");

        add_settings_field("notification_timing", esc_html__("Display Time", "whmc") , array(
            $this,
            "notification_timing"
        ) , 'whmc_admin_sec_notification', "notification_section_setting");

        add_settings_field("suceess_icon_color", esc_html__("Icon Color", "whmc") , array(
            $this,
            "suceess_icon_color"
        ) , 'whmc_admin_sec_notification', "notification_section_setting");

        add_settings_field("notification_progress_bar_color", esc_html__("Progress Bar Color", "whmc") , array(
            $this,
            "notification_progress_bar_color"
        ) , 'whmc_admin_sec_notification', "notification_section_setting");

        add_settings_field("notification_round_bar", esc_html__("Round Box Design", "whmc") , array(
            $this,
            "notification_round_bar"
        ) , 'whmc_admin_sec_notification', "notification_section_setting");

        add_settings_field("wmhc_notimydemo", '', array(
            $this,
            "wmhc_notimydemo"
        ) , 'whmc_admin_sec_notification', "notification_section_setting", array(
            'class' => 'whmc_notimydemo_D'
        ));
    }

    /**
     * This function is a callback function of  add seeting section
     */

    public function wmhc_notimydemo()
    {

        echo '<img src="' . WHMC_URL . 'assets/admin/img/notification-box.jpg" alt="notifiation box">';
    }

    public function settting_sec_func()
    {

        return true;
    }

    public function settting_sec_func_header()
    {

        return true;
    }

    public function wmhc_notification_added_text()
    {

        $notifications = get_option('whmc_notification');;
        $notifications_rang_value = isset($notifications['wmhc_notification_added_text']) ? $notifications['wmhc_notification_added_text'] : 'added successfully';

        printf('<input type="text" name="whmc_notification[wmhc_notification_added_text]" value="%s"><p class="whmc_description" >'.esc_html__("Change the 'Added' Text after the Product Title", "whmc").'</p>', $notifications_rang_value);

    }

    public function notification_title_color()
    {

        $notifications = get_option('whmc_notification');
        $notifications_rang_value = isset($notifications['notification_title_color']) ? $notifications['notification_title_color'] : '#4c4c4c';

        printf('<input type="text" name="whmc_notification[notification_title_color]" value="%s"  class="notification_title_color" ><p class="whmc_description" >'.__("Change Text Color Default","whmc").':#ddd</p>', $notifications_rang_value);

    }

    public function notification_background_color()
    {

        $notifications = get_option('whmc_notification');;
        $notifications_rang_value = isset($notifications['notification_background_color']) ? $notifications['notification_background_color'] : '#68d619';

        printf('<input type="text" name="whmc_notification[notification_background_color]" value="%s"  class="notification_bg_color" ><p class="whmc_description" >'.__('Background Color of the Notification Box','whmc').'</p>', $notifications_rang_value);

    }
    public function notification_boxshadow()
    {

        $notifications = get_option('whmc_notification');;
        $notifications_rang_value = isset($notifications['notification_boxshadow']) ? $notifications['notification_boxshadow'] : '#fff';

        printf('<input type="text" name="whmc_notification[notification_boxshadow]" value="%s"  class="notification_bg_color" ><p class="whmc_description" >'.esc_html__("Box Shadow Color of the Notification Box", "whmc").'</p>', $notifications_rang_value);

    }

    public function notification_progress_bar_color()
    {

        $notifications = get_option('whmc_notification');;
        $notifications_rang_value = isset($notifications['notification_progress_bar_color']) ? $notifications['notification_progress_bar_color'] : '#dd0f0f';

        printf('<input type="text" name="whmc_notification[notification_progress_bar_color]" value="%s"  class="progressbar_color" ><p class="whmc_description" >'.esc_html__("ProgressBar Color Color,Default:", "whmc").'#dd0f0f</p>', $notifications_rang_value);

    }
    public function suceess_icon_color()
    {

        $notifications = get_option('whmc_notification');;
        $suceess_icon_color = isset($notifications['suceess_icon_color']) ? $notifications['suceess_icon_color'] : '#fff';

        printf('<input type="text" name="whmc_notification[suceess_icon_color]" value="%s"  class="progressbar_color" ><p class="whmc_description" >'.esc_html__("Sign Icon Color,Default:#fff, click to close it", "whmc").'#fff</p>', $suceess_icon_color);

    }

    /**
     * This function is a callback function of  add seeting field
     */

    public function notification_position()
    {

        $notifications = get_option('whmc_notification');
        $notification_position = isset($notifications['notification_position']) ? $notifications['notification_position'] : 'top-end';
    ?>
        
            <select name="whmc_notification[notification_position]" class="whmc_slect_class">
                
            <option value="top" <?php
        echo esc_attr($notification_position) == 'top' ? 'selected' : '';?>><?php
        esc_html_e('Top', 'whmc');?></option>
            <option value="top-start" <?php
        echo esc_attr($notification_position) == 'top-start' ? 'selected' : '';?>><?php
        esc_html_e('Top Start', 'whmc');?></option>
            <option value="top-end" <?php
        echo esc_attr($notification_position) == 'top-end' ? 'selected' : '';?>><?php
        esc_html_e('top-end', 'whmc');?></option>
            <option value="center" <?php
        echo esc_attr($notification_position) == 'center' ? 'selected' : '';?>><?php
        esc_html_e('center', 'whmc');?></option>
            <option value="center-start" <?php
        echo esc_attr($notification_position) == 'center-start' ? 'selected' : '';?>><?php
        esc_html_e('center start', 'whmc');?></option>
            <option value="center-end" <?php
        echo esc_attr($notification_position) == 'center-end' ? 'selected' : '';?>><?php
        esc_html_e('center end', 'whmc');?></option>
            <option value="bottom" <?php
        echo esc_attr($notification_position) == 'bottom' ? 'selected' : '';?>><?php
        esc_html_e('Bottom', 'whmc');?></option>
            <option value="bottom-start" <?php
        echo esc_attr($notification_position) == 'bottom-start' ? 'selected' : '';?>><?php
        esc_html_e('bottom start', 'whmc');?></option>
            <option value="bottom-end" <?php
        echo esc_attr($notification_position) == 'bottom-end' ? 'selected' : '';?>><?php
        esc_html_e('bottom end', 'whmc');?></option>
            </select>
        <p class="whmc_description" ><?php echo esc_html__('Notofication position,Default:Bottom End', 'whmc') ?></p>

        <?php

    }
    /**
     * This function is a callback function of  add seeting field
     */

    public function notification_timing()
    {

        $notifications = get_option('whmc_notification');
        $notification_timing = isset($notifications['notification_timing']) ? $notifications['notification_timing'] : '3000';?>
        
            <select name="whmc_notification[notification_timing]" class="whmc_slect_class">
                
            <option value="1500" <?php
        echo esc_attr($notification_timing) == '1500' ? 'selected' : '';?>><?php
        esc_html_e('1.5s', 'whmc');?></option>
            <option value="2000" <?php
        echo esc_attr($notification_timing) == '2000' ? 'selected' : '';?>><?php
        esc_html_e('2s', 'whmc');?></option>
            <option value="3000" <?php
        echo esc_attr($notification_timing) == '3000' ? 'selected' : '';?>><?php
        esc_html_e('3s', 'whmc');?></option>
    
            <option value="4000" <?php
        echo esc_attr($notification_timing) == '4000' ? 'selected' : '';?>><?php
        esc_html_e('4s', 'whmc');?></option>
            <option value="5000" <?php
        echo esc_attr($notification_timing) == '5000' ? 'selected' : '';?>><?php
        esc_html_e('5s', 'whmc');?></option>
            <option value="6000" <?php
        echo esc_attr($notification_timing) == '6000' ? 'selected' : '';?>><?php
        esc_html_e('6s', 'whmc');?></option>
            <option value="6000" <?php
        echo esc_attr($notification_timing) == '6000' ? 'selected' : '';?>><?php
        esc_html_e('6s', 'whmc');?></option>
            <option value="7000" <?php
        echo esc_attr($notification_timing) == '7000' ? 'selected' : '';?>><?php
        esc_html_e('7s', 'whmc');?></option>
            <option value="8000" <?php
        echo esc_attr($notification_timing) == '8000' ? 'selected' : '';?>><?php
        esc_html_e('8s', 'whmc');?></option>
            <option value="9000" <?php
        echo esc_attr($notification_timing) == '9000' ? 'selected' : '';?>><?php
        esc_html_e('9s', 'whmc');?></option>
            <option value="10000" <?php
        echo esc_attr($notification_timing) == '10000' ? 'selected' : '';?>><?php
        esc_html_e('10s', 'whmc');?></option>
            </select>
            <p class="whmc_description" ><?php echo esc_html__('Notification Timining in Second,Default:3s', 'whmc') ?></p>

        <?php

    }

    public function notification_enabes_whmc()
    {

        $notifications = get_option('whmc_notification');
        $notification_enabes_whmc = isset($notifications['notification_enabes_whmc']) ? $notifications['notification_enabes_whmc'] : 'no';?>
    
        <select name="whmc_notification[notification_enabes_whmc]" class="whmc_slect_class">
            
        <option value="no" <?php
        echo esc_attr($notification_enabes_whmc) == 'no' ? 'selected' : '';?>><?php
        esc_html_e('No', 'whmc');?></option>
        <option value="yes" <?php
        echo esc_attr($notification_enabes_whmc) == 'yes' ? 'selected' : '';?>><?php
        esc_html_e('Yes', 'whmc');?></option>
    
        </select>
        <p class="whmc_description" ><?php echo esc_html__('Turn off Notification function, Default: On', 'whmc') ?></p>

    <?php

    }

    public function notification_round_bar()
    {

        $notifications = get_option('whmc_notification');

        printf('<input type="checkbox" name="whmc_notification[notification_round_bar]" class="whmc_apple-switch"  value="notification_round_bar" %s><p class="whmc_description">'.esc_html__("Notification Round Design,Default:on", "whmc").'</p>', (isset($notifications['notification_round_bar']) && $notifications['notification_round_bar'] === 'notification_round_bar') ? 'checked' : '');

    }

    /**
     * admin form field validation
     */

    public function whmc_notification_page_sanitize($input)
    {
        $sanitary_values = array();

        if (isset($input['notification_progress_bar_color']))
        {
            $sanitary_values['notification_progress_bar_color'] = $input['notification_progress_bar_color'];
        }

        if (isset($input['notification_background_color']))
        {
            $sanitary_values['notification_background_color'] = $input['notification_background_color'];
        }

        if (isset($input['notification_boxshadow']))
        {
            $sanitary_values['notification_boxshadow'] = $input['notification_boxshadow'];
        }
        if (isset($input['notification_title_color']))
        {
            $sanitary_values['notification_title_color'] = $input['notification_title_color'];
        }

        if (isset($input['wmhc_notification_added_text']))
        {
            $sanitary_values['wmhc_notification_added_text'] = $input['wmhc_notification_added_text'];
        }
        if (isset($input['notification_round_bar']))
        {
            $sanitary_values['notification_round_bar'] = $input['notification_round_bar'];
        }
        if (isset($input['notification_enabes_whmc']))
        {
            $sanitary_values['notification_enabes_whmc'] = $input['notification_enabes_whmc'];
        }
        if (isset($input['suceess_icon_color']))
        {
            $sanitary_values['suceess_icon_color'] = $input['suceess_icon_color'];
        }
        if (isset($input['notification_position']))
        {
            $sanitary_values['notification_position'] = $input['notification_position'];
        }

        if (isset($input['notification_timing']))
        {
            $sanitary_values['notification_timing'] = $input['notification_timing'];
        }

        return $sanitary_values;
    }

}

if(class_exists('WHMC_Notifation')){

    new WHMC_Notifation;
}