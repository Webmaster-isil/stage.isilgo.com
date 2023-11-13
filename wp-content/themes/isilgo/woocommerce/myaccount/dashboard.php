<?php
$cursos = get_field('mis_cursos', 'user_' . wp_get_current_user()->ID);
$cursos_incompletos = false;
$cursos_recien_comprados = false;
$cursos_completos = false;
$cursos_regalados = false;
$total_cursos_repeater = array();
$totalOC = array();

// print_r($cursos);

if ($cursos) {

	$customer_orders = get_posts(array(
		'numberposts' => -1,
		'posts_per_page' => -1,
		'meta_key'    => '_customer_user',
		'meta_value'  =>  wp_get_current_user()->ID,
		'post_type'   => wc_get_order_types(),
		'post_status' => array_keys(wc_get_is_paid_statuses()),
	));

	foreach ($cursos as $c) {
		$id_product = $c['curso'];
		$cats = get_the_terms($id_product, 'product_cat');
		foreach ($cats as $cat) {
			if ($cat->term_taxonomy_id != 24) {
				$total_cursos_repeater[] = $c['curso'];
				if ($c['estado'] == 'iniciado') {
					$cursos_incompletos[] = $c['curso'];
				} else if ($c['estado'] == 'comprado') {
					$cursos_recien_comprados[] = $c['curso'];
				} else if ($c['estado'] == 'finalizado') {
					$cursos_completos[] = $c['curso'];
				} else if ($c['estado'] == 'regalado') {
					$cursos_regalados[] = $c['curso'];
				}
			}
		}
	}

	// foreach ($customer_orders as $oc) {
	// 	$order = wc_get_order($oc->ID);
	// 	$items = $order->get_items();
	// 	foreach ($items as $item) {
	// 		$id_product = $item->get_product_id();
	// 		$totalOC[] = $id_product;
	// 	}
	// }

	// foreach ($totalOC as $i) {
	// 	if (!in_array($i, $total_cursos_repeater)) {
	// 		$cursosNoIniciados = true;
	// 		$idNoIniciados[] = $i;
	// 	}
	// }

	// $total_cursos_repeater = array_unique($total_cursos_repeater);
	// $totalOC = array_unique($totalOC);

	if ($cursos_incompletos) {
		echo '<h4 class="incomplete">Cursos <span>activos</span></h4>';
		$args = array(
			'post_type'        => 'product',
			'orderby' => 'date',
			'order' => 'ASC',
			'post__in' => $cursos_incompletos,
			'numberposts' => -1,
			'posts_per_page' => -1,

		);

		$the_query = new WP_Query($args);

		woocommerce_product_loop_start();
		if ($the_query->have_posts()) {

			while ($the_query->have_posts()) {
				$the_query->the_post();



				do_action('woocommerce_shop_loop');

				wc_get_template_part('content', 'product');
			}
		}
		woocommerce_product_loop_end();

		/* Restore original Post Data */
		wp_reset_postdata();
	}

	if ($cursos_recien_comprados) {
		echo '<h4 class="noiniciados">Cursos <span>no iniciados</span></h4>';
		$args = array(
			'post_type'        => 'product',
			'orderby' => 'date',
			'order' => 'ASC',
			'post__in' => $cursos_recien_comprados,
			'numberposts' => -1,
			'posts_per_page' => -1,

		);

		$the_query = new WP_Query($args);

		woocommerce_product_loop_start();
		if ($the_query->have_posts()) {

			while ($the_query->have_posts()) {
				$the_query->the_post();



				do_action('woocommerce_shop_loop');

				wc_get_template_part('content', 'product');
			}
		}
		woocommerce_product_loop_end();

		/* Restore original Post Data */
		wp_reset_postdata();
	}

	if ($cursos_regalados) {
		echo '<h4 class="noiniciados">Cursos <span>Regalados</span></h4>';
		$args = array(
			'post_type'        => 'product',
			'orderby' => 'date',
			'order' => 'ASC',
			'post__in' => $cursos_regalados,
			'numberposts' => -1,
			'posts_per_page' => -1,

		);

		$the_query = new WP_Query($args);

		woocommerce_product_loop_start();
		if ($the_query->have_posts()) {

			while ($the_query->have_posts()) {
				$the_query->the_post();



				do_action('woocommerce_shop_loop');

				wc_get_template_part('content', 'product');
			}
		}
		woocommerce_product_loop_end();

		/* Restore original Post Data */
		wp_reset_postdata();
	}

	if ($cursos_completos) {
		echo '<h4 class="complete">Cursos <span>finalizados</span></h4>';
		$args = array(
			'post_type'        => 'product',
			'orderby' => 'date',
			'order' => 'ASC',
			'post__in' => $cursos_completos,
			'numberposts' => -1,
			'posts_per_page' => -1,

		);

		$the_query = new WP_Query($args);

		woocommerce_product_loop_start();
		if ($the_query->have_posts()) {

			while ($the_query->have_posts()) {
				$the_query->the_post();



				do_action('woocommerce_shop_loop');

				wc_get_template_part('content', 'product');
			}
		}
		woocommerce_product_loop_end();

		/* Restore original Post Data */
		wp_reset_postdata();
	}
} else {
	echo '<h3 class="mi_membresia">Mis <span>cursos</span></h3>';
	echo '<p>Actualmente no posees cursos</p>';
	echo '<a class="bnt_naranjo" href="' . get_permalink(wc_get_page_id('shop')) . '">IR A CURSOS</a>';
}
