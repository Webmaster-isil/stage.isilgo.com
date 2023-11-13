<?php

/**
 * Cart Page
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/cart/cart.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 7.4.0
 */

defined('ABSPATH') || exit;




do_action('woocommerce_before_cart'); ?>
<div class="row">
	<form class="woocommerce-cart-form col-12" action="<?php echo esc_url(wc_get_cart_url()); ?>" method="post">
		<?php do_action('woocommerce_before_cart_table'); ?>
		<ul class="contenido_carrito row">
			<?php do_action('woocommerce_before_cart_contents');
			foreach (WC()->cart->get_cart() as $cart_item_key => $cart_item) { ?>
				<li class="col-12">
					<div class="row">
						<div class="col-md-1">
							<?php
							$_product   = apply_filters('woocommerce_cart_item_product', $cart_item['data'], $cart_item, $cart_item_key);
							$product_id = apply_filters('woocommerce_cart_item_product_id', $cart_item['product_id'], $cart_item, $cart_item_key);

							if ($_product && $_product->exists() && $cart_item['quantity'] > 0 && apply_filters('woocommerce_cart_item_visible', true, $cart_item, $cart_item_key)) {
								$product_permalink = apply_filters('woocommerce_cart_item_permalink', $_product->is_visible() ? $_product->get_permalink($cart_item) : '', $cart_item, $cart_item_key);
								$thumbnail = apply_filters('woocommerce_cart_item_thumbnail', $_product->get_image(), $cart_item, $cart_item_key);
								$link_foto  = get_the_post_thumbnail_url($_product->get_id());
								if (!$product_permalink) {
									echo $thumbnail; // PHPCS: XSS ok.
								} else {
									printf('<a style="background-image:url(' . $link_foto . ')" class="custom_image_cart" href="%s"></a>', esc_url($product_permalink), $thumbnail); // PHPCS: XSS ok.
								}
							}


							?>

						</div>
						<div class="col-md-11">
							<div class="alinea_carrito">
								<div>
									<?php
									if (!$product_permalink) {
										echo wp_kses_post(apply_filters('woocommerce_cart_item_name', $_product->get_name(), $cart_item, $cart_item_key) . '&nbsp;');
									} else {
										echo wp_kses_post(apply_filters('woocommerce_cart_item_name', sprintf('<a class="title_product_cart" href="%s">%s</a>', esc_url($product_permalink), $_product->get_name()), $cart_item, $cart_item_key));
									}
									do_action('woocommerce_after_cart_item_name', $cart_item, $cart_item_key);

									// Meta data.
									echo wc_get_formatted_cart_item_data($cart_item); // PHPCS: XSS ok.

									// Backorder notification.
									if ($_product->backorders_require_notification() && $_product->is_on_backorder($cart_item['quantity'])) {
										echo wp_kses_post(apply_filters('woocommerce_cart_item_backorder_notification', '<p class="backorder_notification">' . esc_html__('Available on backorder', 'woocommerce') . '</p>', $product_id));
									}


									if (!in_array(24, $_product->get_category_ids())) { ?>
										<div class="dictado_por">Dictado por <span><?php echo get_the_author() ?></span></div>
									<?php }
									?>







									<?php
									$discount_details = apply_filters('advanced_woo_discount_rules_get_cart_item_discount_details', false, $cart_item);
									if ($discount_details !== false) {
										$original = $discount_details['initial_price'];
										$dcto =  $discount_details['discounted_price'];
										$porcentaje = round($dcto * 100 / $original); ?>
										<span class="dcto_cart"><?php echo $porcentaje . '% Dscto'; ?></span>
										<span class="price">Precio: <del> <ins><span class="woocommerce-Price-amount amount"><span class="woocommerce-Price-currencySymbol">S/</span><?php echo $original; ?>.00</span></ins></del>&nbsp;<ins><span class="woocommerce-Price-amount amount"><span class="woocommerce-Price-currencySymbol">S/</span><?php echo  number_format($dcto, 2, '.', ''); ?></span></ins></span>
									<?php
									} else {
										$price_html = $_product->get_price_html(); ?>
										<span class="price">Precio: <?php echo $price_html; ?></span>
									<?php }
									?>

									<?php
									echo apply_filters( // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
										'woocommerce_cart_item_remove_link',
										sprintf(
											'<a href="%s" class="remove" aria-label="%s" data-product_id="%s" data-product_sku="%s">&times;</a>',
											esc_url(wc_get_cart_remove_url($cart_item_key)),
											esc_html__('Remove this item', 'woocommerce'),
											esc_attr($product_id),
											esc_attr($_product->get_sku())
										),
										$cart_item_key
									);
									?>
								</div>
							</div>
						</div>
					</div>
				</li>





			<?php
			}
			?>

			<?php ?>
			<li>
				<?php do_action('woocommerce_cart_contents'); ?> <?php if (wc_coupons_enabled()) { ?> <div class="coupon">
						<label for="coupon_code" class="screen-reader-text"><?php esc_html_e('Coupon:', 'woocommerce'); ?></label> <input type="text" name="coupon_code" class="input-text" id="coupon_code" value="" placeholder="<?php esc_attr_e('Coupon code', 'woocommerce'); ?>" /> <button type="submit" class="button<?php echo esc_attr(wc_wp_theme_get_element_class_name('button') ? ' ' . wc_wp_theme_get_element_class_name('button') : ''); ?>" name="apply_coupon" value="<?php esc_attr_e('Apply coupon', 'woocommerce'); ?>"><?php esc_attr_e('Apply coupon', 'woocommerce'); ?></button>
						<?php do_action('woocommerce_cart_coupon'); ?>
					</div>
				<?php } ?>

			</li>
		</ul>

		<?php do_action('woocommerce_cart_actions'); ?>

		<?php wp_nonce_field('woocommerce-cart', 'woocommerce-cart-nonce'); ?>


		<?php do_action('woocommerce_after_cart_contents'); ?>

		<?php do_action('woocommerce_after_cart_table'); ?>
	</form>

	<?php do_action('woocommerce_before_cart_collaterals'); ?>

	<div class="col-12">
		<div class="cart-collaterals">
			<?php
			/**
			 * Cart collaterals hook.
			 *
			 * @hooked woocommerce_cross_sell_display
			 * @hooked woocommerce_cart_totals - 10
			 */
			do_action('woocommerce_cart_collaterals');
			?>
		</div>
	</div>
</div>

<?php do_action('woocommerce_after_cart'); ?>