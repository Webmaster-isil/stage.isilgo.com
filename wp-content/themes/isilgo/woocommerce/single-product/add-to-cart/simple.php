<?php

/**
 * Simple product add to cart
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product/add-to-cart/simple.php.
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

global $product;
global $estadoMembresia;
global $cursoComprado;


if (!$product->is_purchasable()) {
	return;
}


?>


<input type="hidden" name="" data-idWC="<?php echo get_the_ID(); ?>" data-username="<?php echo wp_get_current_user()->data->user_login; ?>" data-email="<?php echo wp_get_current_user()->data->user_email; ?>" data-course_id="<?php echo get_field('codigo_app'); ?>" class="info_basica">
<?php

if ($estadoMembresia) { ?>

	<a href="#" class="ir_curso_pdp membresiaAjax">IR AL CURSO
		<div class="loaderCustom"></div>

	</a>
	<div class="texto"></div>

	<form action="/regalo" method="post">
		<input type="hidden" name="idRegalo" value="<?php echo get_the_ID(); ?>">
		<div class="regalar_curso">
			<button type="submit">Regalar Curso</button>
		</div>
	</form>

	<?php
	$imagen_promocional = get_field('imagen_promocional', 'options');
	$enlace_promocional = get_field('enlace_promocional', 'options');
	if ($imagen_promocional && $enlace_promocional) { ?>
		<a class="enlace_promocional" href="<?php echo $enlace_promocional; ?>"><img class="w-100" src="<?php echo $imagen_promocional ?>" alt=""></a>
	<?php }
	?>
	</div>

<?php } else if ($cursoComprado) { ?>
	<a href="#" class="ir_curso_pdp membresiaAjax">IR AL CURSO
		<div class="loaderCustom"></div>

	</a>
	<div class="texto"></div>
	<div class="compraRapidaMembresia">
		<a href="/membresias">VUÉLVETE PREMIUM</a>
	</div>

	<form action="/regalo" method="post">
		<input type="hidden" name="idRegalo" value="<?php echo get_the_ID(); ?>">
		<div class="regalar_curso">
			<button type="submit">Regalar Curso</button>
		</div>
	</form>

	<?php
	$imagen_promocional = get_field('imagen_promocional', 'options');
	$enlace_promocional = get_field('enlace_promocional', 'options');
	if ($imagen_promocional && $enlace_promocional) { ?>
		<a class="enlace_promocional" href="<?php echo $enlace_promocional; ?>"><img class="w-100" src="<?php echo $imagen_promocional ?>" alt=""></a>
	<?php }
	?>
	</div>
	<?php

} else {
	echo wc_get_stock_html($product); // WPCS: XSS ok.

	if ($product->is_in_stock()) : ?>

		<?php do_action('woocommerce_before_add_to_cart_form'); ?>

		<form class="cart precio_normal" action="<?php echo esc_url(apply_filters('woocommerce_add_to_cart_form_action', $product->get_permalink())); ?>" method="post" enctype='multipart/form-data'>
			<?php do_action('woocommerce_before_add_to_cart_button'); ?>

			<button type="submit" name="add-to-cart" value="<?php echo esc_attr($product->get_id()); ?>" class="single_add_to_cart_button button alt<?php echo esc_attr(wc_wp_theme_get_element_class_name('button') ? ' ' . wc_wp_theme_get_element_class_name('button') : ''); ?>">Agregar al carrito</button>
			<button name="buy-now" class="compraRapida" data-id=<?php echo $product->get_id(); ?>>COMPRAR <span class="loaderCustom"></span></button>
			<?php do_action('woocommerce_after_add_to_cart_button'); ?>
		</form>
		<div class="compraRapidaMembresia" style="display:none">
			<a href="/membresias">VUÉLVETE PREMIUM</a>
		</div>


		<?php do_action('woocommerce_after_add_to_cart_form'); ?>

	<?php endif; ?>
	<form action="/regalo" method="post">
		<input type="hidden" name="idRegalo" value="<?php echo get_the_ID(); ?>">
		<div class="regalar_curso">
			<button type="submit">Regalar Curso</button>
		</div>
	</form>

	<?php
	$imagen_promocional = get_field('imagen_promocional', 'options');
	$enlace_promocional = get_field('enlace_promocional', 'options');
	if ($imagen_promocional && $enlace_promocional) { ?>
		<a class="enlace_promocional" href="<?php echo $enlace_promocional; ?>"><img class="w-100" src="<?php echo $imagen_promocional ?>" alt=""></a>
	<?php }
	?>

	</div>
<?php
}
