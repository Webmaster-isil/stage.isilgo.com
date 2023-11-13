<?php
/**
 * The public-facing functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the public-facing stylesheet and JavaScript.
 *
 * @package    WHMC
 * @subpackage WHMC/public
 * @author     Sharabindu <info@sharabindu.com>
 */
class whmc_frontendclass extends WhmcfileGenerator
{

    public function __construct()
    {
        add_action('wp_body_open', array(
            $this,
            'whmc_sidebarfunc'
        ));
        parent::__construct();


    }

    function whmc_sidebarfunc()
    {
        $this->options;
        $opuiosngshgd = $this->options_value;

        if($opuiosngshgd == $this->vausropiokss){
      global $woocommerce , $product;

        $product_id = get_the_ID($product);
        do_action('woocommerce_before_mini_cart');
        $tax_enabled  = wc_tax_enabled() && WC()->cart->get_cart_tax() !== '';
        $has_shipping = WC()->cart->needs_shipping() && WC()->cart->show_shipping();

        $sidepanels = get_option('whmc_sidepanel');

        $options_cart_text_value = isset($sidepanels['wmhc_cart_text_value']) ? $sidepanels['wmhc_cart_text_value'] : esc_html__('Cart','whmc');
        
        $options_chekout_text_value =  isset($sidepanels['wmhc_chekout_text_value']) ? $sidepanels['wmhc_chekout_text_value'] : esc_html__('Checkout','whmc');

        $whmx_no_cart_text_value = isset($sidepanels['wmhc_no_cart_text_value']) ? $sidepanels['wmhc_no_cart_text_value'] : esc_html__('No product in the cart.','whmc');


        $wmhc_cart_shipping_font = isset($sidepanels['wmhc_cart_shipping_font']) ? $sidepanels['wmhc_cart_shipping_font'] : '14';

        $wmhc_shipping_Color = isset($sidepanels['wmhc_shipping_Color']) ? $sidepanels['wmhc_shipping_Color'] : '#000';


       $wmhc_cart_side_button_color = isset($sidepanels['wmhc_cart_side_button_color']) ? $sidepanels['wmhc_cart_side_button_color'] : '#2519a8';

        $wmhc_cart_side_text_color = isset($sidepanels['wmhc_cart_side_text_color']) ? $sidepanels['wmhc_cart_side_text_color'] : '#3a3a3a';

        $wmhc_cart_side_button_text_color = isset($sidepanels['wmhc_cart_side_button_text_color']) ? $sidepanels['wmhc_cart_side_button_text_color'] : '#fff';


        $wmhc_cart_side_text_size = isset($sidepanels['wmhc_cart_side_text_size']) ? $sidepanels['wmhc_cart_side_text_size'] : '14'; 

        $wmhc_cart_side_price_size = isset($sidepanels['wmhc_cart_side_price_size']) ? $sidepanels['wmhc_cart_side_price_size'] : '12';

        $wmhc_cart_side_price_color = isset($sidepanels['wmhc_cart_side_price_color']) ? $sidepanels['wmhc_cart_side_price_color'] : '#4fe200';

        $wmhc_cart_side_top_background = isset($sidepanels['wmhc_cart_side_top_background']) ? $sidepanels['wmhc_cart_side_top_background'] : '#fff';

        $wmhc_cart_side_subtotal = isset($sidepanels['wmhc_cart_side_subtotal']) ? $sidepanels['wmhc_cart_side_subtotal'] : '#000';
        
        $wmhc_cart_side_subtoral_font = isset($sidepanels['wmhc_cart_side_subtoral_font']) ? $sidepanels['wmhc_cart_side_subtoral_font'] : '14';
        
        $sidepanels_subtototal_value = isset($sidepanels['wmhc_subtototal_value']) ? $sidepanels['wmhc_subtototal_value'] : esc_html__('Sub total','whmc');

        $wmhc_cart_subtotal_remove = isset($sidepanels['wmhc_cart_subtotal_remove']) && $sidepanels['wmhc_cart_subtotal_remove'] == 'wmhc_cart_subtotal_remove' ? 'checked' : '';

        $wmhc_cart_side_border_btm = isset($sidepanels['wmhc_cart_side_border_btm']) ? $sidepanels['wmhc_cart_side_border_btm'] : '#e2e2e2';

        $whmc_side_img_brious = isset($sidepanels['whmc_side_img_brious']) ? $sidepanels['whmc_side_img_brious'] : '';

        $wmhc_cart_side_hide = isset($sidepanels['wmhc_cart_side_hide']) && $sidepanels['wmhc_cart_side_hide'] == 'wmhc_cart_side_hide' ? 'checked' : '';

        $wmhc_cart_side_inline = isset($sidepanels['wmhc_cart_side_inline']) ? $sidepanels['wmhc_cart_side_inline'] : '';


        $wmhcside_toppart_bg = isset($sidepanels['wmhcside_toppart_bg']) ? $sidepanels['wmhcside_toppart_bg'] : '#efefef';

        $wmhcside_toppart_icon = isset($sidepanels['wmhcside_toppart_icon']) ? $sidepanels['wmhcside_toppart_icon'] : '#77c92a';

        $wmhcside_toppart_txt = isset($sidepanels['wmhcside_toppart_txt']) ? $sidepanels['wmhcside_toppart_txt'] : '#505050';
        $wmhcside_toppart_txtcu = isset($sidepanels['wmhcside_toppart_txtcu']) ? $sidepanels['wmhcside_toppart_txtcu'] : esc_html__('Cart items','whmc');


        $wmhc_cart_side_hide_kshop = isset($sidepanels['wmhc_cart_side_hide_kshop']) && $sidepanels['wmhc_cart_side_hide_kshop'] == 'wmhc_cart_side_hide_kshop' ? 'checked' : '';


        $whmc_keepshop_text_value = isset($sidepanels['whmc_keepshop_text_value']) ? $sidepanels['whmc_keepshop_text_value'] : esc_html__('Keep Shopping','whmc');
        
        $whmc_del_color = isset($sidepanels['whmc_del_color']) ? $sidepanels['whmc_del_color'] : '#dd4f4f';


        $whmc_del_option = isset($sidepanels['whmc_del_option']) ? $sidepanels['whmc_del_option'] : 'icon_23';

        $whmc_coupon_icon = isset($sidepanels['whmc_coupon_icon']) ? $sidepanels['whmc_coupon_icon'] : 'icon_d-1';
        $whmc_coupon_iconcolor = isset($sidepanels['whmc_coupon_iconcolor']) ? $sidepanels['whmc_coupon_iconcolor'] : '#929292';
        $wmhc_applycoupon_value = isset($sidepanels['wmhc_applycoupon_value']) ? $sidepanels['wmhc_applycoupon_value'] : esc_html__('Apply Code?','whmc');

        $wmhc_cart_coupon_remove = isset($sidepanels['wmhc_cart_coupon_remove']) && $sidepanels['wmhc_cart_coupon_remove'] == 'wmhc_cart_coupon_remove' ? 'checked' : '';

        $wmhc_hideall_my_coupon = isset($sidepanels['wmhc_hideall_my_coupon']) && $sidepanels['wmhc_hideall_my_coupon'] == 'wmhc_hideall_my_coupon' ? 'checked' : '';


        $wmhc_cart_shipping = isset($sidepanels['wmhc_cart_shipping']) ? $sidepanels['wmhc_cart_shipping'] : '#000';

        $wmhc_cart_side_shipping_font = isset($sidepanels['wmhc_cart_side_shipping_font']) ? $sidepanels['wmhc_cart_side_shipping_font'] : '14';

        $wmhc_shipping_value = isset($sidepanels['wmhc_shipping_value']) ? $sidepanels['wmhc_shipping_value'] :esc_html__('Shipping','whmc');

        $wmhc_cart_shipping_remove = isset($sidepanels['wmhc_cart_shipping_remove']) && $sidepanels['wmhc_cart_shipping_remove'] == 'wmhc_cart_shipping_remove' ? 'checked' : '';


        $wmhcside_btm_shipping = isset($sidepanels['wmhcside_btm_shipping']) ? $sidepanels['wmhcside_btm_shipping'] : esc_html__('Tax','whmc');

        $wmhc_cart_shipping_font = isset($sidepanels['wmhc_cart_shipping_font']) ? $sidepanels['wmhc_cart_shipping_font'] : '14';

        $wmhc_shipping_Color = isset($sidepanels['wmhc_shipping_Color']) ? $sidepanels['wmhc_shipping_Color'] : '#000';

        $wmhc_cart_tax_remove = isset($sidepanels['wmhc_cart_tax_remove']) && $sidepanels['wmhc_cart_tax_remove'] == 'wmhc_cart_tax_remove' ? 'checked' : '';

        $wmhcside_btm_discount = isset($sidepanels['wmhcside_btm_discount']) ? $sidepanels['wmhcside_btm_discount'] : esc_html__('Discount','whmc');

        $wmhc_cart_discount_font = isset($sidepanels['wmhc_cart_discount_font']) ? $sidepanels['wmhc_cart_discount_font'] : '14';

        $wmhc_discount_color = isset($sidepanels['wmhc_discount_color']) ? $sidepanels['wmhc_discount_color'] : '#000';

        $wmhcside_btm_total = isset($sidepanels['wmhcside_btm_total']) ? $sidepanels['wmhcside_btm_total'] : esc_html__('Total','whmc');

        $wmhc_cart_total_font = isset($sidepanels['wmhc_cart_total_font']) ? $sidepanels['wmhc_cart_total_font'] : '14';

        $wmhc_total_color = isset($sidepanels['wmhc_total_color']) ? $sidepanels['wmhc_total_color'] : '#000';
        $fcp_top_icon = isset($sidepanels['fcp_top_icon']) ? $sidepanels['fcp_top_icon'] : 'fcp_icon_3';

        $whmc_coupon_modalicon = isset($sidepanels['whmc_coupon_modalicon']) ? $sidepanels['whmc_coupon_modalicon'] : 'icon_d-1';
        $whmc_coupon_position = isset($sidepanels['whmc_coupon_position']) ? $sidepanels['whmc_coupon_position'] : 'bottom';

        $whmc_cmoiconclr = isset($sidepanels['whmc_cmoiconclr']) ? $sidepanels['whmc_cmoiconclr'] : '#dd1313';      
        $wmhc_hide_copnds = isset($sidepanels['wmhc_hide_copnds']) && $sidepanels['wmhc_hide_copnds'] == 'wmhc_hide_copnds' ? 'checked' : '';

        $whmccoupon_modalibg = isset($sidepanels['whmccoupon_modalibg']) ? $sidepanels['whmccoupon_modalibg'] : '#fff';
        ob_start();
            WC()->cart->calculate_totals();
        ?>
<style>
    .whmc-cart-items{
border-bottom: 1px solid <?php echo $wmhc_cart_side_border_btm; ?>

    }
    .cart-item-data-field{
  color: <?php echo $wmhc_cart_side_text_color?>;
  font-size:   <?php echo $wmhc_cart_side_text_size;?>px;      
    }
.whmc-item-price{
   color: <?php echo $wmhc_cart_side_price_color?>;
     font-size:   <?php echo $wmhc_cart_side_price_size;?>px;     
}
.wc_remove_btn span {
    color: <?php echo $whmc_del_color?>;
}
.whmc-subtotal-amount{
  color: <?php echo $wmhc_cart_side_subtotal; ?>;
  font-size: <?php echo $wmhc_cart_side_subtoral_font;?>px; 
}
.taxrates{
   color: <?php echo $wmhc_shipping_Color; ?>;
  font-size: <?php echo $wmhc_cart_shipping_font;?>px;   
}
.whmc-cart-discount-wrap{
      color: <?php echo $wmhc_discount_color; ?>;
  font-size: <?php echo $wmhc_cart_discount_font;?>px; 
}
#totalcla{

    color: <?php echo $wmhc_total_color; ?>;
  font-size: <?php echo $wmhc_cart_total_font;?>px;  
}
.cartxtvalues,.chekouttxtvalues,.whmckeepshooping,.whmc_ft-buttons-con a, a.whmckeepshooping{
    background: <?php echo $wmhc_cart_side_button_color; ?>;
  color: <?php echo $wmhc_cart_side_button_text_color;?>;
}
 span#topart_count_s { 
  color:<?php echo $wmhcside_toppart_txt ?>;
  border:1px solid <?php echo $wmhcside_toppart_txt ?>
}

</style>
<div id="pm_menu" class="whmc-body">
<div class="whmc_top_part">
    <div class="cloasebtnwrap">
        <span class="cloasebtn">&times;
        </span>
    </div><div class="carttxtbtnwrap"><span class="carttxtbtn"><i class="<?php echo $fcp_top_icon; ?>" style="color:<?php echo($wmhcside_toppart_icon);?>"></i></span></div>
        <div class="carttxtbtnwraptct" style="color:<?php echo $wmhcside_toppart_txt ?>"><span id="topart_count_s"></span><?php echo esc_html__($wmhcside_toppart_txtcu,'whmc');?></div></div>

<div class="whmc-cart-item-wrap">
<?php if (!WC()->cart->is_empty()) { ?>
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

                        <div class="cart-item-data-field" >
                            <?php echo esc_html__($product->get_name()); ?>
                        </div>

                        <div class="whmc-item-price">
                            <?php
                            $wc_product = $itemVal['data'];
                            echo WC()->cart->get_product_subtotal($wc_product, $itemVal['quantity']);
                            ?>
                        </div>

                        <div class="whmc-item-qty">
                            <span class="whmc-qty-minus whmc-qty-chng icon_minus"></span>

                            <input type="number" class="whmc-qty" step="1" min="0" max="14" value="<?php echo intval($itemVal['quantity']); ?>" placeholder="" inputmode="numeric">

                            <span class="whmc-qty-plus whmc-qty-chng icon_plus"></span>
                        </div>

                    </div> <!-- whmc-item-desc -->
    
                </div> <!-- whmc-cart-items-inner -->
            </div> <!-- whmc-car-items -->
            <?php
        } // product foreach loop ends
        ?>
    </div> <!-- whmc-mini-cart -->
 <?php } else { ?>
    <div class="whmc-empty-cart">
        <p class="woo_hader_cart__empty_message"><?php echo esc_html__($whmx_no_cart_text_value,'whmc'); ?></p>
    </div>
<?php } ?>

</div>
<!-- Coupons -->

<div class="whmc-bottom-part">
      <div class="whmc-cpn-resp" style="display:none;"></div>
<?php if($wmhc_cart_coupon_remove != 'checked'){ ?>
<div class="couplonfield">
      <div class="allpliedcoupon">
     <span class="<?php echo esc_attr($whmc_coupon_icon); ?> " id="cpnicon" style="color: <?php echo $whmc_coupon_iconcolor ?>"></span>
   <?php 
          $applied_coupons = WC()->cart->get_applied_coupons();

    if (!empty($applied_coupons)) {
        ?>
   
        <ul class='whmc-applied-cpns'>
            <?php foreach ($applied_coupons as $cpns) { ?>    
                <li class='' cpcode='<?php echo esc_attr($cpns); ?>'>
                    <?php echo esc_html__($cpns); ?><span class='whmc-remove-cpn  icon_cancel-circle'></span>
                </li>
            <?php } ?>    
        </ul>
        <?php
    } else {
        echo '<ul class="whmc-applied-cpns" style="display: none;"><li></li></ul>';
    }  ?> 


    </div> 
    <div class="whmc_applypromocode">
    <span class="xoo-wsc-toggle-slider"><?php echo esc_html__($wmhc_applycoupon_value,'whmc') ?></span> 
  </div> 
    </div>
<div class='whmc-coupon'>
<div class='whmc-couponwrapper'>
<div class="whmc_applypromocode"><span class="icon_arrow-left2"></span></div>


    <div class="whmc-coupon-field">
        <input type="text" id="whmc-coupon-code" placeholder="<?php echo esc_html__("Input coupon code", 'whmc'); ?>">
        <button class="whmc-coupon-submit whmc-button"><?php echo esc_html__("Apply Coupon", 'whmc'); ?></button>
    </div>

    <?php



    $applied_coupons = WC()->cart->get_applied_coupons();

    if (!empty($applied_coupons)) {
        ?>
        <ul class='whmc-applied-cpns'>
            <?php foreach ($applied_coupons as $cpns) { ?>    
                <li class='' cpcode='<?php echo esc_attr($cpns); ?>'>
                    <?php echo esc_html__($cpns); ?><span class='whmc-remove-cpn  icon_cancel-circle'></span>
                </li>
            <?php } ?>    
        </ul>
        <?php
    } else {
        echo '<ul class="whmc-applied-cpns" style="display: none;"><li></li></ul>';
    }
 if($wmhc_hideall_my_coupon != 'checked'){
$coupon_posts = get_posts( array(
        'posts_per_page'   => -1,
        'orderby'          => 'name',
        'order'            => 'asc',
        'post_type'        => 'shop_coupon',
        'post_status'      => 'publish',
    ) );
        foreach ( $coupon_posts as $coupon_post ) {

            $coupon = new WC_Coupon( $coupon_post->ID );
            $code       = $coupon->get_code();

            $off_amount = $coupon->get_amount();

            $off_value  = 'percent' === $coupon->get_discount_type() ? $off_amount.'%' : wc_price( $off_amount ); 


            ?>
            <div class="whmc-coupon-row" style="background:<?php echo $whmccoupon_modalibg; ?>">
<?php if($whmc_coupon_position == 'top'){ ?>
               <p class="wmcocodes"><span >
                <i class="<?php echo $whmc_coupon_modalicon; ?>" style="color:<?php echo $whmc_cmoiconclr; ?>"></i></span>
                <input class="whmc-cr-code" type="text" value="<?php echo $code; ?>" readonly></p>
<?php 
}
$couponimage =  get_post_meta($coupon_post->ID, "whmcouponimage", true );
if($couponimage){
 ?>
 <span>
<img class="whmccouponimages" src="<?php echo $couponimage ?>" alt="<?php echo $code  ?>"></span>
<?php }  if($whmc_coupon_position == 'bottom'){ ?>
               <p class="wmcocodes"><span>
                <i class="<?php echo $whmc_coupon_modalicon; ?>" style="color:<?php echo $whmc_cmoiconclr?>"></i></span>
                <input class="whmc-cr-code" type="text" value="<?php echo $code; ?>" readonly></p>
            <?php } if($wmhc_hide_copnds != 'checked'){?>
                <p class="whmc-cr-desc"><?php echo $coupon->get_description() ?></p>
            <?php } ?>
            </div>

<?php } 

}?>




</div>

<?php } ?>


</div>

<!-- Summary -->
<div class="whmc-buy-summary">


    <?php if($wmhc_cart_subtotal_remove != 'checked' ){ ?>


    <div class='whmc-cart-subtotal-wrap'>
        <?php
        $get_totals = WC()->cart->get_totals();
        $cart_total = $get_totals['subtotal'];
        $cart_discount = $get_totals['discount_total'];
        $final_subtotal = $cart_total - $cart_discount;
        ?><span style="color: <?php echo esc_attr($wmhc_cart_side_subtotal); ?>;font-size: <?php echo esc_attr($wmhc_cart_side_subtoral_font); ?>px">
        <label class='whmc-total-label'><?php echo esc_html__($sidepanels_subtototal_value,'whmc'); ?></label></span>

        <span class='whmc-subtotal-amount'>
            <?php echo WC()->cart->get_cart_subtotal(); ?>
        </span>
    </div>
    <?php } ?>
    <?php
    if($wmhc_cart_shipping_remove != 'checked' && $has_shipping){
    WC()->cart->calculate_shipping();
$packages = WC()->shipping()->get_packages();
$package = isset($packages[0]) ? $packages[0]: null ;
$package = isset($packages[0]) ? $packages[0]: null ;
$destination = isset($package['destination']) ? $package['destination']: null;
$rates = isset($package['rates']) ? $package['rates']: null;


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
    'available_methods'        => $rates,
    'show_package_details'     => count( $packages ) > 1,
    'show_shipping_calculator' => apply_filters( 'woocommerce_shipping_show_shipping_calculator', true, 0, $package ),
    'package_details'          => implode( ', ', $product_names ),
    'index'                    => 0,
    'chosen_method'            => $chosen_method,
    'formatted_destination'    => WC()->countries->get_formatted_address( $destination, ', ' ),
    'has_calculated_shipping'  => WC()->customer->has_calculated_shipping(),
);

extract($args);


$formatted_destination    = isset( $formatted_destination ) ? $formatted_destination : WC()->countries->get_formatted_address( $package['destination'], ', ' );
$has_calculated_shipping  = ! empty( $has_calculated_shipping );
$show_shipping_calculator = ! empty( $show_shipping_calculator );
$calculator_text          = '';
$toggle_html              = false;  


 $available_methods = $rates;
 if(is_checkout() or is_cart()){ 
echo '<div class="shippinfresclagfgfg"><span style="color: '.esc_attr($wmhc_cart_shipping).';font-size:  '.esc_attr($wmhc_cart_side_shipping_font).'px;">
<label>'.esc_html__($wmhc_shipping_value,'whmc').'</label></span>
<span class="shippingfree"></span></div>';
}else{

?>
<div class="shippinfrescla"><span style="color: <?php echo esc_attr($wmhc_cart_shipping); ?>;font-size: <?php echo esc_attr($wmhc_cart_side_shipping_font) ?>px;">
<label><?php echo esc_html__($wmhc_shipping_value,'whmc'); ?><span class="icon_pen" id="shipcion"></span></label> </span>
<span class='shippingfree'></span>
</div>


<div class="whmc-modal">
<div class="shippinfrescla"><span class="icon_arrow-left2"></span></div>

    
    <div class="whmc-opac"></div>
    <div class="whmc-container">


<div class="whmc-header">

         <?php //if($show_notification == 1): ?>
         <div class="whmc-notification-bar"></div>
         <?php //endif; ?>

</div>
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
            $toggle_html .=  sprintf( esc_html__( 'Shipping to:  %s.', 'whmc' ) . ' ', '<strong>' . esc_html__( $formatted_destination ) . '</strong>' );
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
            $toggle_html .= wp_kses_post( apply_filters( 'woocommerce_cart_no_shipping_available_html', sprintf( esc_html__( 'No shipping options were found for %s.', 'whmc' ) . ' ', '<strong>' . esc_html__( $formatted_destination ) . '</strong>' ) ) );
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
</div>
</div>

<?php } 
}

?>




<?php
$tax_enabled  = wc_tax_enabled() && WC()->cart->get_cart_tax() !== '';
if($tax_enabled  && $wmhc_cart_tax_remove != 'checked'){
    echo '<div class="taxrates"><span><label>'.esc_html__($wmhcside_btm_shipping,'whmc').'</label></span>';


echo '<span class="taxtgfree"></span></div>';

}
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

    $discounts   = WC()->cart->get_discount_total();
    $discount   = get_option( 'woocommerce_tax_display_cart' ) === 'incl' ? $discounts + WC()->cart->get_discount_tax() : $discounts;
    if($wmhc_cart_coupon_remove != 'checked'){

 ?>
    <div class="whmc-cart-discount-wrap"><span>
        <label><?php echo esc_html__($wmhcside_btm_discount,'whmc'); ?></label></span>
        <span class="whmc-cart-discount-amount"><?php echo  $discount ?></span>

    </div>
<?php 


}

?>


                
    <div class="whmc-cart-total-wrap" id="totalcla"><span>
        <label><?php echo esc_html__($wmhcside_btm_total,'whmc'); ?></label></span>
        <span class="whmc-cart-total-amount"><?php echo WC()->cart->get_total(); ?></span>
    </div>


<div class="whmc_ft-buttons-con">
<?php if ($wmhc_cart_side_hide != 'checked') { ?>
    <a href="<?php echo wc_get_cart_url(); ?>" class="cartxtvalues"><?php echo esc_html__($options_cart_text_value,'whmc');?></a>
    <?php } ?>

    <a href="<?php echo wc_get_checkout_url(); ?>"  class="chekouttxtvalues"><?php echo esc_html__($options_chekout_text_value,'whmc'); ?></a>
    <?php if($wmhc_cart_side_hide_kshop != 'checked'){ ?>
    <a href="#" class="whmckeepshooping"><?php echo esc_html__($whmc_keepshop_text_value,'whmc'); ?></a>
    <?php } ?>
</div>

                </div>

</div>
</div>

<?php

    }
    }

}

if (class_exists('whmc_frontendclass'))
{
    new whmc_frontendclass;
};

