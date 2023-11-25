<?php

/**
 * Loop Add to Cart
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/loop/add-to-cart.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see         https://docs.woocommerce.com/document/template-structure/
 * @package     WooCommerce\Templates
 * @version     3.3.0
 */

if (!defined('ABSPATH')) {
	exit;
}
verificaCursoComprado();
global $product;
global $estadoMembresia;
global $cursoComprado;
$esMembresia = false;
$cats = get_the_terms(get_the_ID(), 'product_cat');
foreach ($cats as $cat) {
	if ($cat->term_taxonomy_id == 24) {
		$esMembresia = true;
		break;
	}
}
?>
<?php if ($estadoMembresia || $cursoComprado) {

	if (!$esMembresia) { ?>
		<div class="avance_curso">
			<?php
			$avance = false;
			$mis_cursos = get_field('mis_cursos', 'user_' . wp_get_current_user()->ID);
			foreach ($mis_cursos as $key => $curso) {
				if ($curso['curso'] === get_the_id()) {
					$avance =  $curso['porcentaje_del_curso'];

					if (!$avance) {
						$avance = 0;
					}
			?>
					<div><b><?php echo $avance * 100  ?>% </b> completado</div>
					<style>
						.muestra_porcentaje-<?php echo $key; ?>:after {
							width: <?php echo $avance * 100 . '%'; ?>;
						}
					</style>



					<div class="avance muestra_porcentaje-<?php echo $key; ?>"></div>

			<?php
					break;
				}
			}
			?>
		</div>
	<?php }
	?>


<?php } ?>
<?php if (!is_single()) { ?>
	<input type="hidden" name="" data-idwc="<?php echo @get_the_ID(); ?>" data-username="<?php echo @wp_get_current_user()->data->user_login; ?>" data-email="<?php echo @wp_get_current_user()->data->user_email; ?>" data-course_id="<?php echo get_field('codigo_app'); ?>" class="info_basica">
<?php } ?>

<?php
if (!$estadoMembresia && !$cursoComprado) {
	echo apply_filters(
		'woocommerce_loop_add_to_cart_link', // WPCS: XSS ok.
		sprintf(
			'<a href="%s" data-quantity="%s" class="%s" %s>%s</a>',
			esc_url($product->add_to_cart_url()),
			esc_attr(isset($args['quantity']) ? $args['quantity'] : 1),
			esc_attr(isset($args['class']) ? $args['class'] : 'button'),
			isset($args['attributes']) ? wc_implode_html_attributes($args['attributes']) : '',
			esc_html($product->add_to_cart_text())
		),
		$product,
		$args
	); ?>

	<form class="solo-membresias" action="/regalo" method="post">
		<input type="hidden" name="idRegalo" value="<?php echo get_the_ID(); ?>">
		<div class="regalar_curso">
			<button type="submit">Regalar <?php echo ($esMembresia ? 'Membresía' : 'Curso') ?></button>
		</div>
	</form>

<?php
	/*if($product->is_type( 'variable' )){
        wp_enqueue_script( 'wc-add-to-cart-variation' );

        // Get Available variations?
        $get_variations = count( $product->get_children() ) <= apply_filters( 'woocommerce_ajax_variation_threshold', 30, $product );

        // Load the template.
        wc_get_template(
            'loop/variable.php',
            array(
                'available_variations' => $get_variations ? $product->get_available_variations() : false,
                'attributes'           => $product->get_variation_attributes(),
                'selected_attributes'  => $product->get_default_attributes(),
            )
        );
    }*/
} else if (($estadoMembresia && !$esMembresia) || ($cursoComprado && !$esMembresia)) {
	// si tu cuenta tiene menbresia,el curso unamenbresia,|| 
	//es un curso y lo tienes comprado, no es menbresia
	?>
	<a href="#" class="ir_curso_pdp membresiaAjax">Ir al curso
		<div class="loaderCustom"></div>
	</a>
	<div class="texto"></div>
<?php
} else if ($esMembresia) { ?>

	<form class="solo-membresias" action="/regalo" method="post">
		<input type="hidden" name="idRegalo" value="<?php echo get_the_ID(); ?>">
		<div class="regalar_curso">
			<button type="submit">Regalar <?php echo ($esMembresia ? 'Membresía' : 'Curso') ?></button>
		</div>
	</form>
<?php
}
