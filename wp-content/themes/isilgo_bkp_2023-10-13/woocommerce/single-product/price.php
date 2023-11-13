<?php

/**
 * Single Product Price
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product/price.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 3.0.0
 */

if (!defined('ABSPATH')) {
	exit; // Exit if accessed directly
}

global $product;
global $estadoMembresia;
global $cursoComprado;
verificaCursoComprado();

?>
<div class="sidebar_fixed lateral shadow">
	<ul class="membresia_pdp">
		<?php //if ($estadoMembresia) { ?>
			<!-- <li class="small">
				<img src="<?php echo get_bloginfo('template_directory'); ?>/assets/img/tiempo.png" alt=""> <strong>Duración:</strong> <span><?php echo get_field('duracion'); ?></span>
				<?php if($product->get_average_rating()){ ?>
					<span class="estrella_lateral"></span>
					<strong>Valoración:</strong> <?php echo $product->get_average_rating(); ?>
				<?php } ?>
			</li> -->
		<?php //} else 
			if ($cursoComprado) { ?>
			<?php if(!$product->is_type( 'variable' )){ ?>
			<li class="claseActiva">
				<input type="radio" name="membresia" id="select_membresia" checked>
				<div class="w-100">
					<p>Acceso a <strong>todos los cursos mediante membresia</strong></p>
					<?php

					$membresia = wc_get_product(get_field('id_membresia', 'options'));


					$price_html = $membresia->get_price_html(); ?>

					<div class="listado_precio">
						<?php


						$precio_normal_membresia = $membresia->get_regular_price();
						$precio_oferta_membresia = $membresia->get_sale_price();
						if ($precio_oferta_membresia) {

							$descuento_membresia_subtotal = $precio_oferta_membresia * 100 / $precio_normal_membresia;
							$descuento_membresia = 100 - $descuento_membresia_subtotal;
						}
						echo $price_html;
						if ($precio_oferta_membresia) {
							echo  '<span class="dcto_single">' . round($descuento_membresia, 0) . '% OFF</span>';
						}
						?>
					</div>
					<p>Con tu membresía puedes obtener descuentos y mejores opciones a nuestro catálogo. <a href="/membresias">Conoce nuestras membresías</a></p>
				</div>
			</li>
			
			<?php } ?>
		<?php } else { ?>
			<?php if(!$product->is_type( 'variable' )){ ?>
			<li class="claseActiva">
				<input type="radio" name="membresia" id="select_normal" checked>
				<div class="w-100">
					<p>Precio <strong>sólo</strong> para este curso</p>

					<div class="listado_precio">

						<?

						echo $product->get_price_html();

						$discount_percentage = apply_filters('advanced_woo_discount_rules_get_product_discount_percentage', 0, $product);
						if ($discount_percentage > 0) {
							echo '<span class="dcto_single">' . $discount_percentage . '% OFF</span>'; // here you can get discount percentage
						}
						?>
					</div>
				</div>
			</li>
			<li>
				<input type="radio" name="membresia" id="select_membresia">
				<div class="w-100">
					<p>Acceso a <strong>todos los cursos mediante membresia</strong></p>
					<?php

					$membresia = wc_get_product(get_field('id_membresia', 'options'));


					$price_html = $membresia->get_price_html(); ?>

					<div class="listado_precio">
						<?php


						$precio_normal_membresia = $membresia->get_regular_price();
						$precio_oferta_membresia = $membresia->get_sale_price();
						if ($precio_oferta_membresia) {

							$descuento_membresia_subtotal = $precio_oferta_membresia * 100 / $precio_normal_membresia;
							$descuento_membresia = 100 - $descuento_membresia_subtotal;
						}
						echo $price_html;
						if ($precio_oferta_membresia) {
							echo  '<span class="dcto_single">' . round($descuento_membresia, 0) . '% OFF</span>';
						}
						?>
					</div>
					<p>Con tu membresía puedes obtener descuentos y mejores opciones a nuestro catálogo. <a href="/membresias">Conoce nuestras membresías</a></p>
				</div>
			</li>
			<?php } ?>			
		<?php } ?>
		<?php //if(get_field('duracion') || $product->get_average_rating()){ ?> 
			<li class="small">
				<?php if(get_field('duracion')){ ?> 
					<div>
						<img src="<?php echo get_bloginfo('template_directory'); ?>/assets/img/tiempo.png" alt="Duración">				
						<strong>Duración:</strong> <span><?php echo get_field('duracion'); ?></span>
					</div>				
				<?php } ?>
				<?php if($product->get_average_rating()){ ?>
					<div>
						<span class="estrella_lateral"></span>
						<strong>Valoración:</strong> <?php echo $product->get_average_rating(); ?>
					</div>				
				<?php } ?>
			</li>	
		<?php //} ?>	
	</ul>