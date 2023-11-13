<?php

/**
 * Checkout Form
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/checkout/form-checkout.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 3.5.0
 */

if (!defined('ABSPATH')) {
	exit;
}

if (is_user_logged_in()) {
	do_action('woocommerce_before_checkout_form', $checkout);

	// If checkout registration is disabled and not logged in, the user cannot checkout.
	if (!$checkout->is_registration_enabled() && $checkout->is_registration_required() && !is_user_logged_in()) {
		echo esc_html(apply_filters('woocommerce_checkout_must_be_logged_in_message', __('You must be logged in to checkout.', 'woocommerce')));
		return;
	}

?>

	<div class="col-12">
		<?php echo get_field('info_checkout', 'options');
		// global $current_user;

		// $tipos_documento   = array('dni'       => '1', 'carnet'    => '4', 'pasaporte' => '7');
		// $tipo_seleccionado = get_user_meta($current_user->ID, 'billing_documento', true);
		// $tipo_doc          = $tipos_documento[$tipo_seleccionado];
		// $numero_field      = $tipo_seleccionado == 'carnet' ? 'extranjeria' : $tipo_seleccionado;
		// $numero_documento  = get_user_meta($current_user->ID, 'billing_' . $numero_field, true);

		// var_dump($tipo_seleccionado);
		// var_dump($tipo_doc);
		// var_dump($numero_field);
		// var_dump($numero_documento);
		?>
	</div>
	<div class="col-12">
		<form name="checkout" method="post" class="row checkout woocommerce-checkout" action="<?php echo esc_url(wc_get_checkout_url()); ?>" enctype="multipart/form-data">

			<?php if ($checkout->get_checkout_fields()) : ?>
				<div class="col-md-7">
					<div class="row">
						<?php do_action('woocommerce_checkout_before_customer_details'); ?>

						<div class="col2-set" id="customer_details">
							<div class="bg-checkout">
								<div class="col-12">
									<?php do_action('woocommerce_checkout_billing'); ?>
								</div>

								<div class="col-12">
									<?php do_action('woocommerce_checkout_shipping'); ?>
								</div>
							</div>
						</div>

						<?php do_action('woocommerce_checkout_after_customer_details'); ?>
					</div>
				</div>
			<?php endif; ?>
			<div class="col-md-5">
				<div class="bg-checkout">
					<?php do_action('woocommerce_checkout_before_order_review_heading'); ?>

					<h3 id="order_review_heading"><?php esc_html_e('Your order', 'woocommerce'); ?></h3>

					<?php do_action('woocommerce_checkout_before_order_review'); ?>

					<div id="order_review" class="woocommerce-checkout-review-order">
						<?php do_action('woocommerce_checkout_order_review'); ?>
					</div>

					<?php do_action('woocommerce_checkout_after_order_review'); ?>
				</div>
			</div>

		</form>
	</div>

<?php do_action('woocommerce_after_checkout_form', $checkout);
} ?>