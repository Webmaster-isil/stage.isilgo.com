<?php

  class cart_Frontend{
    public $action;
        function __construct() {

            add_filter('woocommerce_add_to_cart_fragments', array($this, 'add_to_cart_fragments'), 10, 1);
            add_filter('woocommerce_update_order_review_fragments', array($this, 'add_to_cart_fragments'), 10, 1);
            add_action('wp_ajax_change_item_qty', array($this, 'change_item_qty'));
            add_action('wp_ajax_nopriv_change_item_qty', array($this, 'change_item_qty'));

            add_action('wp_ajax_add_coupon_code', array($this, 'addCouponCode'));
            add_action('wp_ajax_nopriv_add_coupon_code', array($this, 'addCouponCode'));

            add_action('wp_ajax_remove_coupon_code', array($this, 'remove_coupon_code'));
            add_action('wp_ajax_nopriv_remove_coupon_code', array($this, 'remove_coupon_code'));

            add_action('wp_ajax_get_refresh_fragments', array($this, 'get_refreshed_fragments'));
            add_action('wp_ajax_nopriv_get_refresh_fragments', array($this, 'get_refreshed_fragments'));

            add_action('wp_ajax_remove_item', array($this, 'cart_remove_item'));
            add_action('wp_ajax_nopriv_remove_item', array($this, 'cart_remove_item'));

            // Prevent Refresh from Adding Another Product in WooCommerce
            add_action('woocommerce_add_to_cart_redirect', array($this, 'prevent_add_to_cart_on_redirect'));

        }




public function get_cart_footer_content(){


        ob_start();
    WC()->cart->calculate_shipping();
        
$packages = WC()->shipping()->get_packages();
$package = $packages[0];

$chosen_method = isset( WC()->session->chosen_shipping_methods[ 0 ] ) ? WC()->session->chosen_shipping_methods[ 0 ] : '';
$product_names = array();

if ( count( $packages ) > 1 ) {
    foreach ( $package['contents'] as $item_id => $values ) {
        $product_names[ $item_id ] = $values['data']->get_name() . ' &times;' . $values['quantity'];
    }
    $product_names = apply_filters( 'woocommerce_shipping_package_details_array', $product_names, $package );
}

$args = array(
    'package'                  => $package,
    'available_methods'        => $package['rates'],
    'show_package_details'     => count( $packages ) > 1,
    'show_shipping_calculator' => apply_filters( 'woocommerce_shipping_show_shipping_calculator', true, 0, $package ),
    'package_details'          => implode( ', ', $product_names ),
    'index'                    => 0,
    'chosen_method'            => $chosen_method,
    'formatted_destination'    => WC()->countries->get_formatted_address( $package['destination'], ', ' ),
    'has_calculated_shipping'  => WC()->customer->has_calculated_shipping(),
);

extract($args);


$formatted_destination    = isset( $formatted_destination ) ? $formatted_destination : WC()->countries->get_formatted_address( $package['destination'], ', ' );
$has_calculated_shipping  = ! empty( $has_calculated_shipping );
$show_shipping_calculator = ! empty( $show_shipping_calculator );
$calculator_text          = '';
$toggle_html              = false;  
?>



<div class="whmc-carts-content">
<div class="whmc-shippicngcal-content">

    <?php if ( $available_methods ) : ?>
        <ul id="shipping_method" class="woocommerce-shipping-methods">
            <?php foreach ( $available_methods as $method ) : ?>
                <li>
                    <?php
                    if ( 1 < count( $available_methods ) ) {
                        printf( '<input type="radio" name="shipping_method[%1$d]" data-index="%1$d" id="shipping_method_%1$d_%2$s" value="%3$s" class="shipping_method" %4$s />', $index, esc_attr( sanitize_title( $method->id ) ), esc_attr( $method->id ), checked( $method->id, $chosen_method, false ) ); // WPCS: XSS ok.
                    } else {
                        printf( '<input type="hidden" name="shipping_method[%1$d]" data-index="%1$d" id="shipping_method_%1$d_%2$s" value="%3$s" class="shipping_method" />', $index, esc_attr( sanitize_title( $method->id ) ), esc_attr( $method->id ) ); // WPCS: XSS ok.
                    }
                    printf( '<label for="shipping_method_%1$s_%2$s">%3$s</label>', $index, esc_attr( sanitize_title( $method->id ) ), wc_cart_totals_shipping_method_label( $method ) ); // WPCS: XSS ok.
                    do_action( 'woocommerce_after_shipping_rate', $method, $index );
                    ?>
                </li>
            <?php endforeach; ?>
        </ul>

        <?php
        $toggle_html .= '<div class="shippignsto_whmc">';
        if ( $formatted_destination ) {
            $toggle_html .=  sprintf( esc_html__( 'Shipping to:  %s.', 'whmc' ) . ' ', '<strong>' . esc_html( $formatted_destination ) . '</strong>' );
            $calculator_text = esc_html__( 'Change address', 'whmc' );
        } else {
            $toggle_html .= wp_kses_post( apply_filters( 'woocommerce_shipping_estimate_html', __( 'Shipping options will be updated during checkout.', 'whmc' ) ) );
        }
    $toggle_html .= '</div>';
        ?>

    <?php else: ?>

        <?php

        if ( ! $has_calculated_shipping || ! $formatted_destination ) :
            if ( 'no' === get_option( 'woocommerce_enable_shipping_calc' ) ) {
                $toggle_html .= wp_kses_post( apply_filters( 'woocommerce_shipping_not_enabled_on_cart_html', __( 'Calculate', 'whmc' ) ) );
            } else {
                $toggle_html .= wp_kses_post( apply_filters( 'woocommerce_shipping_may_be_available_html', __( 'Plaese add Shipping Zone', 'whmc' ) ) );
            }
        else :
            // Translators: $s shipping destination.
            $toggle_html .= wp_kses_post( apply_filters( 'woocommerce_cart_no_shipping_available_html', sprintf( esc_html__( 'No shipping options were found for %s.', 'whmc' ) . ' ', '<strong>' . esc_html( $formatted_destination ) . '</strong>' ) ) );
            $calculator_text = esc_html__( 'Enter a different address', 'whmc' );
        endif;

        ?>

    <?php endif; ?>


    <?php if ( $show_shipping_calculator ) : ?>
        <?php 
        ob_start();
        woocommerce_shipping_calculator( $calculator_text );
        $toggle_html .= ob_get_clean();
        ?>
    <?php endif; ?>

    <?php echo $toggle_html; ?>

</div>

</div>
<?php




        return ob_get_clean();

    }


function shippingcostsd(){
        ob_start();
    WC()->cart->calculate_shipping();
        
$packages = WC()->shipping()->get_packages();
$package = $packages[0];
 $available_methods = $package['rates'];
?>
<span class='shippingfree'>
<?php
                if( $available_methods ){
                   $shiippingvaluessd =  WC()->cart->get_cart_shipping_total();
                }
                else{
                   $formatted_destination    = WC()->countries->get_formatted_address( $package['destination'], ', ' );
                    if ( !$formatted_destination ) {
                      $shiippingvaluessd =  wp_kses_post( apply_filters( 'woocommerce_shipping_not_enabled_on_cart_html', __( 'Calculate', 'whmc' ) ) );
                    } else {
                       $shiippingvaluessd = wp_kses_post( apply_filters( 'woocommerce_cart_no_shipping_available_html', sprintf( esc_html__( 'No shipping options were found for %s.', 'whmc' ) . ' ', '<strong>' . esc_html( $formatted_destination ) . '</strong>' ) ) );
                    }
                }
            

 //echo $shiippingvaluessd;

?>
</span><?php
ob_get_clean();
  return $shiippingvaluessd;      
}





        private function checkNonce() {
            if (isset($_POST['wp_nonce']) && wp_verify_nonce($_POST['wp_nonce'], 'whmc-frontend-ajax-nonce')) {
                return 'true';
            } else {
                return 'false';
            }
        }

        function prevent_add_to_cart_on_redirect($url = false) {

            if (!empty($url)) {
                return $url;
            }
            return add_query_arg(array(), remove_query_arg('add-to-cart'));
        }


        function change_item_qty() {

            if ($this->checkNonce == 'false') {
                return false;
            }


        $sidepanels = get_option('whmc_sidepanel');
        $productupdate = isset($sidepanels['productupdate']) ? $sidepanels['productupdate'] : esc_html__('Product Update Successfully','whmc'); 

            $c_key = isset($_REQUEST['ckey']) ? sanitize_text_field($_REQUEST['ckey']) : null;
            $qty = isset($_REQUEST['qty']) ? sanitize_text_field($_REQUEST['qty']) : null;

                $response = array(
                    'msgup' => esc_html__($productupdate, 'whmc')
                );

            $this->addCouponResponse($response);
            WC()->cart->set_quantity($c_key, $qty, true);
            WC()->cart->set_session();

            die();
        }

        public function remove_coupon_code() {

            if ($this->checkNonce == 'false') {
                return false;
            }
            $sidepanels = get_option('whmc_sidepanel');
            $Couponremove = isset($sidepanels['Couponremove']) ? $sidepanels['Couponremove'] : esc_html__('Coupon Removed Successfully','whmc');
            $couponCode = isset($_POST['couponCode']) ? sanitize_text_field($_POST['couponCode']) : null;

            if (WC()->cart->remove_coupon($couponCode)) {
                esc_html_e($Couponremove, 'whmc');
            }

            WC()->cart->calculate_totals();
            WC()->cart->maybe_set_cart_cookies();
            WC()->cart->set_session();

            die();
        }

        public function addCouponResponse($response) {
            header('Content-Type: application/json');
            echo json_encode($response);

            WC()->cart->calculate_totals();
            WC()->cart->maybe_set_cart_cookies();
            WC()->cart->set_session();
        }
        public function addCouponCode() {

            if ($this->checkNonce == 'false') {
                return false;
            }
        $sidepanels = get_option('whmc_sidepanel');
        $Couponempty = isset($sidepanels['Couponempty']) ? $sidepanels['Couponempty'] : esc_html__('Coupon Code Field is Empty!','whmc');


        $Couponapply = isset($sidepanels['Couponapply']) ? $sidepanels['Couponapply'] : esc_html__('Coupon Code Already Applied.','whmc');
        
        $Couponinvalid = isset($sidepanels['Couponinvalid']) ? $sidepanels['Couponinvalid'] : esc_html__('Invalid code entered. Please try again.','whmc');        
        $Couponsuccess = isset($sidepanels['Couponsuccess']) ? $sidepanels['Couponsuccess'] : esc_html__('Coupon Applied Successfully','whmc');


            $code = isset($_POST['couponCode']) ? sanitize_text_field($_POST['couponCode']) : null;
            $code = strtolower($code);

            /* Check if coupon code is empty */
            if (empty($code) || !isset($code)) {

                $response = array(
                    'result' => 'empty',
                    'msg' => esc_html__($Couponempty, 'whmc')
                );

                $this->addCouponResponse($response);

                exit();
            }

            /* Create an instance of WC_Coupon with our code */
            $coupon = new WC_Coupon($code);
            $applied_coupons = WC()->cart->get_applied_coupons();

            if (in_array($code, $applied_coupons)) {

                $response = array(
                    'result' => 'already applied',
                    'msg' => esc_html__($Couponapply, 'whmc')
                );

                $this->addCouponResponse($response);
            } else if (!$coupon->is_valid()) {

                $response = array(
                    'result' => 'not valid',
                    'msg' => esc_html__($Couponinvalid, 'whmc')
                );

                $this->addCouponResponse($response);
            } else {

                WC()->cart->apply_coupon($code);

                $response = array(
                    'result' => 'success',
                    'msg' => esc_html__($Couponsuccess, 'whmc')
                );

                $this->addCouponResponse($response);

                wc_clear_notices();
            }
            die();
        }

        public function add_to_cart_fragments($fragments) {
        $sidepanels = get_option('whmc_sidepanel');

        $whmc_del_option = isset($sidepanels['whmc_del_option']) ? $sidepanels['whmc_del_option'] : 'icon_23';

        $whmx_no_cart_text_value = isset($sidepanels['wmhc_no_cart_text_value']) ? $sidepanels['wmhc_no_cart_text_value'] : esc_html__('No product in the cart.','whmc');

            WC()->cart->calculate_totals();
            WC()->cart->maybe_set_cart_cookies();
            global $woocommerce;
            ob_start();

            ?>
            <div class="whmc-cart-item-wrap">
                <?php if (!WC()->cart->is_empty()) { 
            $cart_footer = $this->get_cart_footer_content();
            $shipppedciors = $this->shippingcostsd();

                    ?>
                    <div class="whmc-mini-cart">
                        <?php
                        $items = WC()->cart->get_cart();
                        foreach ($items as $itemKey => $itemVal) {
                            ?>
                            <div class="whmc-cart-items" data-itemId="<?php echo esc_attr($itemVal['product_id']); ?>" data-cKey="<?php echo esc_attr($itemVal['key']); ?>">
                    <div class="whmc-cart-items-inner">
                        <?php
                        $product = wc_get_product($itemVal['data']->get_id());
                        $product_id = apply_filters('woocommerce_cart_item_product_id', $itemVal['product_id'], $itemVal, $itemKey);
                        $getProductDetail = wc_get_product($itemVal['product_id']);
                        ?>
                        <div class="cart_image_iem">
                            <?php echo $getProductDetail->get_image('thumbnail'); ?>
                        </div>

            <div class="whmc-item-desc">
            <div class="wc_remove_btn">
                        <?php
                                echo apply_filters('woocommerce_cart_item_remove_link', sprintf('<a href="%s" class="whmc-remove"  aria-label="%s" data-cart_item_id="%s" data-cart_item_sku="%s" data-cart_item_key="%s"><span class="'.$whmc_del_option.'"></span></a>', esc_url(wc_get_cart_remove_url($itemKey)), esc_html__('Remove this item', 'whmc'), esc_attr($product_id), esc_attr($product->get_sku()), esc_attr($itemKey)
                                        ), $itemKey);
                                ?>
                            </div> 

                            <div class="cart-item-data-field">
                                <?php echo esc_html($product->get_name()); ?>
                            </div>

                            <div class="whmc-item-price">
                                <?php
                                $wc_product = $itemVal['data'];
                                echo WC()->cart->get_product_subtotal($wc_product, $itemVal['quantity']);
                                ?>
                            </div>

                            <div class="whmc-item-qty">
                                <span class="whmc-qty-minus whmc-qty-chng  icon_minus"></span>

                                <input type="number" name="whmc-qty-input" class="whmc-qty" step="1" min="0" max="14" value="<?php echo intval($itemVal['quantity']); ?>" placeholder="" inputmode="numeric">

                                <span class="whmc-qty-plus whmc-qty-chng  icon_plus"></span>
                            </div>

                                    </div> <!-- whmc-item-desc -->
                 
                                </div> <!-- whmc-cart-items-inner -->
                            </div> <!-- whmc-cart-items -->
                            <?php
                        } // product foreach loop ends
                        ?>
                    </div> 
                    <?php } else { ?>
    <div class="whmc-empty-cart">
        <p class="woo_hader_cart__empty_message"><?php echo esc_html__($whmx_no_cart_text_value,'whmc'); ?></p>
    </div>
                <?php } ?>
            </div>





                <?php 

            $cart_body_contents = ob_get_clean();
            $fragments['div.whmc-cart-item-wrap'] = $cart_body_contents;
        $fragments['div.whmc-carts-content'] = '<div class="whmc-carts-content">'.$cart_footer.'</div>';
        $fragments['span.shippingfree'] = '<span class="shippingfree">'.$shipppedciors.'</span>';

    $fragments['span#mini-cart-count_footer'] = '<span id="mini-cart-count_footer">'.WC()->cart->get_cart_contents_count().'</span>';

    $fragments['span.mini-cart-count'] = '<span class="mini-cart-count"><span class="cart_count_header">'.WC()->cart->get_cart_contents_count().'</span></span>';
     $fragments['span.cart_count_total'] = '<span class="cart_count_total">'.get_woocommerce_currency_symbol() . WC()->cart->cart_contents_total.'</span>';


            // Update subtotal Amount
            $get_totals = WC()->cart->get_totals();
            $cart_total = $get_totals['subtotal'];
            $cart_discount = $get_totals['discount_total'];
            $final_subtotal = $cart_total - $cart_discount;
            $subtotal = "<span class='whmc-subtotal-amount'>" . WC()->cart->get_cart_subtotal() . "</span>";
            $fragments['span.whmc-subtotal-amount'] = $subtotal;

            // Update Total Amount
            $cartTotal = '<span class="whmc-cart-total-amount">' . WC()->cart->get_total() . '</span>';
            $fragments['span.whmc-cart-total-amount'] = $cartTotal;
            $current_shipping_cost = WC()->cart->get_cart_shipping_total();
    

            $taxTotal = '<span class="taxtgfree"><bdi>'.WC()->cart->get_cart_tax().'</bdi></span>';
            // Update Discount Amount
    $discounts   = WC()->cart->get_discount_total();
    $discount   = get_option( 'woocommerce_tax_display_cart' ) === 'incl' ? $discounts + WC()->cart->get_discount_tax() : $discounts;
    $discountTotal = '<span class="whmc-cart-discount-amount">' . wc_price(get_option( 'woocommerce_tax_display_cart' ) === 'incl' ? $discounts + WC()->cart->get_discount_tax() : $discounts) . '</span>';  
            $fragments['span.whmc-cart-discount-amount'] = $discountTotal;
            $fragments['span.taxtgfree'] = $taxTotal;

            // Update Applied Coupon
            $applied_coupons = WC()->cart->get_applied_coupons();
            ob_start();
            if (!empty($applied_coupons)) {
                ?>

                <ul class='whmc-applied-cpns'>
                    <?php foreach ($applied_coupons as $cpns) { ?>
                        <li class='' cpcode='<?php echo esc_attr($cpns); ?>'><?php echo esc_attr($cpns); ?> <span class='whmc-remove-cpn  icon_cancel-circle'></span></li>
                        <?php } ?>
                </ul>
                <?php
            } else {
                echo '<ul class="whmc-applied-cpns" style="display: none;"><li></li></ul>';
            }
            $cart_cpn = ob_get_clean();

            ob_start();
              ?>
                <div class="whmc-fee">

                    <?php foreach ( WC()->cart->get_fees() as $fee ) : 

                    ?>
                    <p>
                        <span class="whmc-tools-label"><label><?php echo esc_attr( $fee->name ); ?></label></span>
                        <span class="whmc-tools-value"><?php wc_cart_totals_fee_html( $fee ); ?></span>
                    <?php endforeach; ?>
                    </p>

                </div>
            <?php
            $cart_fees = ob_get_clean();



            $fragments['ul.whmc-applied-cpns'] = $cart_cpn;
            $fragments['div.whmc-fee'] = $cart_fees;
            $fragments['.shipingcountry'] = WC()->customer->get_shipping_country();;

            // Update the Items Count In the Cart
            $fragments['.whmc-cart-qty-count'] = '<span class="whmc-cart-qty-count">' . esc_html__('Quantity: ', 'whmc') . WC()->cart->get_cart_contents_count() . '</span>';
            $fragments['.whmc-cart-items-count'] = '<span class="whmc-cart-items-count">' . esc_html__('Items: ', 'whmc') . sizeof(WC()->cart->get_cart()) . '</span>';


            $fragments['span#topart_count_s'] = '<span id="topart_count_s">'.count(WC()->cart->get_cart()).'</span>';

            // Cart Basket Items Count
            $fragments['.whmc-item-count-wrap .whmc-cart-item-count'] = '<span class="whmc-cart-item-count">' . WC()->cart->get_cart_contents_count() . '</span>';  

      if (WC()->cart->get_cart_contents_count() == 1){ $itemsname =  esc_html__('item','whmc');}else{$itemsname = esc_html__('items','whmc');}

        $fragments['.mini-cart-item-number'] = '<span class="mini-cart-item-number">'.$itemsname.'</span>';






            return $fragments;
        }


        public function get_refreshed_fragments() {

            if ($this->checkNonce == 'false') {
                return false;
            }

            WC_AJAX::get_refreshed_fragments();
        }

        public function cart_remove_item() {

            if ($this->checkNonce == 'false') {
                return false;
            }

            ob_start();
            foreach (WC()->cart->get_cart() as $cart_item_key => $cart_item) {
                if ($cart_item['product_id'] == $_POST['cart_item_id'] && $cart_item_key == $_POST['cart_item_key']) {
                    WC()->cart->remove_cart_item($cart_item_key);
                }
            }

            WC()->cart->calculate_totals();
            WC()->cart->maybe_set_cart_cookies();

            woocommerce_mini_cart();

            $mini_cart = ob_get_clean();

            // Fragments and mini cart are returned
            $data = array(
                'fragments' => apply_filters('woocommerce_add_to_cart_fragments', array(
                    'div.widget_shopping_cart_content' => '<div class="widget_shopping_cart_content">' . $mini_cart . '</div>'
                        )
                ),
                'cart_hash' => apply_filters('woocommerce_add_to_cart_hash', WC()->cart->get_cart_for_session() ? md5(json_encode(WC()->cart->get_cart_for_session())) : '', WC()->cart->get_cart_for_session())
            );

            wp_send_json($data);

            die();
        }

    }

    new cart_Frontend();