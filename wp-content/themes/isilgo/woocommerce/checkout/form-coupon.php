<?php

/**
 * Checkout coupon form
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/checkout/form-coupon.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 7.0.1
 */

defined('ABSPATH') || exit;

if (!wc_coupons_enabled()) { // @codingStandardsIgnoreLine.
	return;
}

if (is_user_logged_in()) { ?>

	<div class="bg-checkout mb-3 cupon_checkout">
		<?php
		/**
		 * Checkout coupon form
		 *
		 * This template can be overridden by copying it to yourtheme/woocommerce/checkout/form-coupon.php.
		 *
		 * HOWEVER, on occasion WooCommerce will need to update template files and you
		 * (the theme developer) will need to copy the new files to your theme to
		 * maintain compatibility. We try to do this as little as possible, but it does
		 * happen. When this occurs the version of the template file will be bumped and
		 * the readme will list any important changes.
		 *
		 * @see https://docs.woocommerce.com/document/template-structure/
		 * @package WooCommerce\Templates
		 * @version 7.0.1
		 */

		defined('ABSPATH') || exit;

		if (!wc_coupons_enabled()) { // @codingStandardsIgnoreLine.
			return;
		}

		?>

		<form class="checkout_coupon woocommerce-form-coupon cupon" method="post" style="display:block!important;">

			<p><strong>Ingresar cupón</strong></p>

			<p class="form-row form-row-first">
				<label for="coupon_code" class="screen-reader-text"><?php esc_html_e('Coupon:', 'woocommerce'); ?></label>
				<input type="text" name="coupon_code" class="input-text" placeholder="Nombre cupón" id="coupon_code" value="" />
			</p>

			<p class="form-row form-row-last">
				<button type="submit" class="button<?php echo esc_attr(wc_wp_theme_get_element_class_name('button') ? ' ' . wc_wp_theme_get_element_class_name('button') : ''); ?>" name="apply_coupon" value="<?php esc_attr_e('Apply coupon', 'woocommerce'); ?>"><?php esc_html_e('Apply coupon', 'woocommerce'); ?></button>
			</p>

			<div class="clear"></div>
		</form>

	</div>

<?php } ?>