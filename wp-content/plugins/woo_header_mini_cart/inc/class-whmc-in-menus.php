<?php
/**
 * Main class of the plugin interacting with WordPress.
 *
 * @since      4.0.1
 * @package    WHMC
 * @subpackage WHMC/inc
 */

// If this file is called directly, abort.
if (!defined('ABSPATH'))
{
    exit;
}

if (!class_exists('WHMC_In_Menus'))
{

    class WHMC_In_Menus
    {
        protected static $instance = null;

        public static function get_instance()
        {

            if (null === self::$instance)
            {
                self::$instance = new self();
            }

            return self::$instance;
        }

        public function __construct()
        {

            add_filter('walker_nav_menu_start_el', array(
                $this,
                'whmc_walker'
            ) , 20, 2);

            add_filter('megamenu_walker_nav_menu_start_el', array(
                $this,
                'whmc_walker'
            ) , 20, 2);

            add_filter('wp_setup_nav_menu_item', array(
                $this,
                'whmc_setup'
            ) , 10, 1);

            add_action('admin_init', array(
                $this,
                'whmc_setup_meta_box'
            ));

            add_action('admin_enqueue_scripts', array(
                $this,
                'whmc_menu_enqueue'
            ));

            add_action('wp_ajax_whmc_object_description_hack', array(
                $this,
                'whmc_description_hack'
            ));

            add_action('wp_ajax_add-menu-item', array(
                $this,
                'whmc_ajax_add_menu_item'
            ) , 0);

        }

        public function whmc_ajax_add_menu_item()
        {

            check_ajax_referer('add-menu_item', 'menu-settings-column-nonce');

            if (!current_user_can('edit_theme_options'))
            {
                wp_die(-1);
            }

            require_once ABSPATH . 'wp-admin/includes/nav-menu.php';

            $menu_items_data = array();
            $menu_item = filter_input(INPUT_POST, 'menu-item', FILTER_DEFAULT, FILTER_REQUIRE_ARRAY);
            foreach ($menu_item as $menu_item_data)
            {
                if (!empty($menu_item_data['menu-item-type']) && 'custom' !== $menu_item_data['menu-item-type'] && 'whmc_object' !== $menu_item_data['menu-item-type'] && !empty($menu_item_data['menu-item-object-id']))
                {
                    switch ($menu_item_data['menu-item-type'])
                    {
                        case 'post_type':
                            $_object = get_post($menu_item_data['menu-item-object-id']);
                        break;

                        case 'taxonomy':
                            $_object = get_term($menu_item_data['menu-item-object-id'], $menu_item_data['menu-item-object']);
                        break;
                    }

                    $_menu_items = array_map('wp_setup_nav_menu_item', array(
                        $_object
                    ));
                    $_menu_item = reset($_menu_items);

                    $menu_item_data['menu-item-description'] = $_menu_item->description;
                }

                $menu_items_data[] = $menu_item_data;
            }

            $item_ids = wp_save_nav_menu_items(0, $menu_items_data);
            if (is_wp_error($item_ids))
            {
                wp_die(0);
            }

            $menu_items = array();

            foreach ((array)$item_ids as $menu_item_id)
            {
                $menu_obj = get_post($menu_item_id);
                if (!empty($menu_obj->ID))
                {
                    $menu_obj = wp_setup_nav_menu_item($menu_obj);
                    $menu_obj->label = $menu_obj->title;
                    $menu_items[] = $menu_obj;
                }
            }

            $menu = filter_input(INPUT_POST, 'menu');

            $walker_class_name = apply_filters('wp_edit_nav_menu_walker', 'Walker_Nav_Menu_Edit', $menu);

            if (!class_exists($walker_class_name))
            {
                wp_die(0);
            }

            if (!empty($menu_items))
            {
                $args = array(
                    'after' => '',
                    'before' => '',
                    'link_after' => '',
                    'link_before' => '',
                    'walker' => new $walker_class_name() ,
                );
                echo walk_nav_menu_tree($menu_items, 0, (object)$args);
            }
            wp_die();
        }

        public function whmc_walker($item_output, $item)
        {

            if (!is_object($item) || !isset($item->object))
            {
                return $item_output;
            }

            if ('whmc_object' !== $item->object)
            {

                if (isset($item->post_title) && 'FULL HTML OUTPUT' === $item->post_title)
                {
                    $item_output = do_shortcode($item->url);
                }
                else
                {
                    $item_output = do_shortcode($item_output);
                }

            }
            elseif (isset($item->description))
            {

                $item_output = do_shortcode($item->description);
            }

            return $item_output;
        }

        public function whmc_setup($item)
        {
            if (!is_object($item))
            {
                return $item;
            }

            if ('whmc_object' === $item->object)
            {

                $item->type_label = __('WHMC', 'whmc');

                if (!empty($item->post_content))
                {
                    $item->description = $item->post_content;
                }
                else
                {

                    $item->description = get_transient('whmc_object_description_hack_' . $item->object_id);

                    delete_transient('whmc_object_description_hack_' . $item->object_id);
                }
            }
            return $item;
        }

        public function whmc_setup_meta_box()
        {
            add_meta_box('whmc-menu-section', __('Woo Header Mini cart', 'whmc') , array(
                $this,
                'meta_box'
            ) , 'nav-menus', 'side', 'default');
        }

        public function whmc_menu_enqueue($hook)
        {

            if ('nav-menus.php' !== $hook)
            {
                return;
            }

            wp_enqueue_script('whmc-in-menus', WHMC_URL . 'assets/admin/js/whmc-in-menus.js', array(
                'nav-menu'
            ) , '4.0.1', true);
        }

        public function whmc_description_hack()
        {
            $nonce = filter_input(INPUT_POST, 'description-nonce');
            if (!wp_verify_nonce($nonce, 'whmc-menu-nonce'))
            {
                wp_die();
            }

            $item = filter_input(INPUT_POST, 'menu-item', FILTER_DEFAULT, FILTER_REQUIRE_ARRAY);

            set_transient('whmc_object_description_hack_' . $item['menu-item-object-id'], $item['menu-item-description']);

            $object_id = $this->new_object_id($item['menu-item-object-id']);

            echo esc_js($object_id);

            wp_die();
        }

        public function new_object_id($last_object_id)
        {
            $object_id = (int)$last_object_id;

            $object_id++;
            $object_id = ($object_id < 1) ? 1 : $object_id;

            update_option('whmc_object_last_object_id', $object_id);

            return $object_id;
        }

        public function meta_box()
        {
            global $_nav_menu_placeholder, $nav_menu_selected_id;

            $nav_menu_placeholder = 0 > $_nav_menu_placeholder ? $_nav_menu_placeholder - 1 : -1;

            $last_object_id = get_option('whmc_object_last_object_id', 0);
            $object_id = $this->new_object_id($last_object_id);
	?>
			<div class="whmc-menu-div" id="whmc-menu-div">
				<input type="hidden" class="menu-item-db-id" name="menu-item[<?php echo esc_attr($nav_menu_placeholder); ?>][menu-item-db-id]" value="0" />
				<input type="hidden" class="menu-item-object-id" name="menu-item[<?php echo esc_attr($nav_menu_placeholder); ?>][menu-item-object-id]" value="<?php echo esc_attr($object_id); ?>" />
				<input type="hidden" class="menu-item-object" name="menu-item[<?php echo esc_attr($nav_menu_placeholder); ?>][menu-item-object]" value="whmc_object" />
				<input type="hidden" class="menu-item-type" name="menu-item[<?php echo esc_attr($nav_menu_placeholder); ?>][menu-item-type]" value="whmc_object" />
				<input type="hidden" id="whmc-menu-nonce" value="<?php echo esc_attr(wp_create_nonce('whmc-menu-nonce')); ?>" />
				<p id="menu-item-title-wrap">

					<input id="whmc-menu-title" name="menu-item[<?php echo esc_attr($nav_menu_placeholder); ?>][menu-item-title]" type="hidden" class="regular-text menu-item-textbox" title="<?php esc_attr_e('Title', 'whmc'); ?>"  value="Woo Header Mini Cart"/>
				</p>

				<p id="menu-item-html-wrap">
					<input  type="hidden" id="whmc-menu-html" name="menu-item[<?php echo esc_attr($nav_menu_placeholder); ?>][menu-item-description]" class="code menu-item-textbox" value="[whmc_mini_cart]">
					<label class="whmini-label"> <?php echo esc_html__('Woo Header Mini Cart', 'whmc') ?> </label><br>
				</p>

				<p class="button-controls">
					<span class="add-to-menu">
						<input type="submit" <?php wp_nav_menu_disabled_check($nav_menu_selected_id); ?> class="button-secondary submit-add-to-menu right" value="<?php esc_attr_e('Add to Menu', 'whmc'); ?>" name="add-whmc_menu-item" id="whmc_submit_menu" />
						<span class="spinner"></span>
					</span>
				</p>

			</div>
					<?php
        }

    }

}

