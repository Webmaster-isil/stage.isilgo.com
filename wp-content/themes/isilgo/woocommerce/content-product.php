<?php

/**
 * The template for displaying product content within loops
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/content-product.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 3.6.0
 */

defined('ABSPATH') || exit;

global $product;
global $estadoMembresia;
global $cursoComprado;

// Ensure visibility.
if (empty($product) || !$product->is_visible()) {
	return;
}

$clase = in_array(24, $product->get_category_ids());
if ($clase) {
	$clase = 'circulo-' . $product->get_id();
};

if ($wp_query->current_post == 9) { ?>
	<li class="membresia_plp_mobile">
		<a href="/membresias">
			<img src="<?php echo get_bloginfo('template_directory'); ?>/assets/img/membresia_mobile.svg" alt="Membresía">
			<div class="txt">
				<p><strong>¿Necesitas una membresía?</strong></p>
				<p>Hazte premium</p>
			</div>

			<img src="<?php echo get_bloginfo('template_directory'); ?>/assets/img/flecha_membresia.svg" alt="Membresía">
		</a>
	</li>
<?php };
?>
<li <?php wc_product_class('', $product); ?>>
	<?php



	if ($clase) { ?>
		<div class="cabezal_mas_popular"></div>
	<?php }?>

	<?php


	/**
	 * Hook: woocommerce_before_shop_loop_item.
	 *
	 * @hooked woocommerce_template_loop_product_link_open - 10
	 */
	do_action('woocommerce_before_shop_loop_item'); ?>
	<div class="cont_loop">

		<?php

		/**
		 * Hook: woocommerce_before_shop_loop_item_title.
		 *
		 * @hooked woocommerce_show_product_loop_sale_flash - 10
		 * @hooked woocommerce_template_loop_product_thumbnail - 10
		 */
		do_action('woocommerce_before_shop_loop_item_title');
		?>
	</div>
	<div class="detalles_loop">
		<?php
		if ($clase) {
			echo '<div class="' . $clase . '"></div>';
		}
		/**
		 * Hook: woocommerce_shop_loop_item_title.
		 *
		 * @hooked woocommerce_template_loop_product_title - 10
		 */
		do_action('woocommerce_shop_loop_item_title'); ?>


		<div class="dictado_por">Dictado por <span><?php if (count(get_coauthors(get_the_ID())) > 1) {
														echo count(get_coauthors(get_the_ID())) . ' especialistas';
													} else {
														echo get_the_author();
													} ?></span></div>
		<div class="duracion d-flex align-items-center">

			<?php if (get_field('duracion')) : ?>
				<div class="mr-2">
					<img src="<?php echo get_bloginfo('template_directory'); ?>/assets/img/tiempo.png" alt="Duración"> Duración: <span><?php echo get_field('duracion'); ?></span>
				</div>
			<?php endif; ?>
			<?php

			/**
			 * Hook: woocommerce_after_shop_loop_item_title.
			 *
			 * @hooked woocommerce_template_loop_rating - 5
			 * @hooked woocommerce_template_loop_price - 10
			 */
			do_action('woocommerce_after_shop_loop_item_title'); ?>


			<?php

			/**
			 * Hook: woocommerce_after_shop_loop_item.
			 *
			 * @hooked woocommerce_template_loop_product_link_close - 5
			 * @hooked woocommerce_template_loop_add_to_cart - 10
			 */
			do_action('woocommerce_after_shop_loop_item');
			?>
		</div>
</li>