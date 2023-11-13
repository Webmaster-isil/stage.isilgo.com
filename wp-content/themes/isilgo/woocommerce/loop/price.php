<?php

/**
 * Loop Price
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/loop/price.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see         https://docs.woocommerce.com/document/template-structure/
 * @package     WooCommerce\Templates
 * @version     1.6.4
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

global $product;


if ( get_the_terms( $product->ID, 'product_cat' )[0]->term_id == 24 ) { ?>
	<?php if ( $product->is_type( 'variable' ) ) { ?>
        <div class="variable-price-box">
        <span class="price">
			<?php
			$variations = $product->get_available_variations();

			$variation = $variations[0];
			echo $variation['price_html'];
			//			echo '<pre>';
			//			print_r( $variations );
			$regular = (int) $variation['display_regular_price'];
			$sale    = (int) $variation['display_price'];
			$diff    = $regular - $sale;
			if ( $diff > 0 ) {
				$oferta_sub = $sale * 100 / $regular;
				$oferta     = 100 - $oferta_sub;
				?>
                <div class="dcto_membresia"><?php echo round( $oferta, 0 ); ?>% OFF</div>
				<?php

			} ?>
    </span>
        </div>
        <p><span>Selecciona número</span> de estudiantes</p>
		<?php
		foreach ( $variations as $variation ) {
			?>
            <a href="" class="variation-buttons" data-variation-id="<?php echo $variation['variation_id'] ?>"
               data-variation-qty="<?php echo $variation['attributes']['attribute_pa_personas'] ?>">
				<?php echo $variation['attributes']['attribute_pa_personas'] ?> estudiante
            </a>
			<?php
		}
		?>
	<?php } else { ?>
        <span class="price"><?php echo $product->get_price_html(); ?>
			<?php
			$regular = (int) $product->get_regular_price();

			$sale = (int) $product->get_sale_price();

			//print_r($sale);
			if ( $sale ) {
				$oferta_sub = $sale * 100 / $regular;
				$oferta     = 100 - $oferta_sub;
				?>
                <div class="dcto_membresia"><?php echo round( $oferta, 0 ); ?>% OFF</div>
				<?php

			} ?>


    </span>
	<?php } ?>

	<?php


	$discount_percentage = apply_filters( 'advanced_woo_discount_rules_get_product_discount_percentage', 0, $product );
	if ( $discount_percentage > 0 ) {
		?>
        <div class="dcto_membresia"><?php echo $discount_percentage ?>% OFF</div>
		<?php
	}
	?>
    <div class="variations">
		<?php
		/* if ( $product->is_type( 'variable' ) ) {
			$variations = $product->get_available_variations();

			// Mostrar las variaciones y permitir que los usuarios las seleccionen
			foreach ( $variations as $variation ) {
			// Puedes personalizar cómo se muestran las variaciones aquí
			echo '<div class="variation">';
				echo '<p>' . $variation['attributes']['attribute_pa_color']  . '</p>';
				echo '<p>' . wc_price( $variation['display_price'] ) . '</p>';
				echo '<button data-variation-id="' . $variation['variation_id'] . '">Seleccionar</button>';
				echo '</div>';
			}
			?>
			<script type="text/template" id="tmpl-variation-template">
				<div class="woocommerce-variation-description">{{{ data.variation.variation_description }}}</div>
				<div class="woocommerce-variation-price">{{{ data.variation.price_html }}}</div>
				<div class="woocommerce-variation-availability">{{{ data.variation.availability_html }}}</div>
			</script>
			<script type="text/template" id="tmpl-unavailable-variation-template">
				<p><?php esc_html_e( 'Sorry, this product is unavailable. Please choose a different combination.', 'woocommerce' ); ?></p>
			</script>
		<?php } */
		?>
    </div>
    <div class="listado_caracteristicas">
		<?php $detalles = get_field( 'detalles' );
		if ( $detalles ) {
			echo '<p><strong>Este plan te da acceso a:</strong></p>';
			echo '<ul>';
			foreach ( $detalles as $detalle ) {
				if ( $detalle['valida'] == 1 ) {
					echo '<li><img src="' . get_bloginfo( 'template_directory' ) . '/assets/img/ok.svg">' . $detalle['detalle'] . '</li>';
				}
			}
			echo '</ul>';
		} ?>
    </div>
	<?php
	timer();
} else {

	if ( $price_html = $product->get_price_html() ) : ?>
        <span class="price">Precio: <?php echo $price_html; ?></span>

	<?php endif;

	timer();
}
