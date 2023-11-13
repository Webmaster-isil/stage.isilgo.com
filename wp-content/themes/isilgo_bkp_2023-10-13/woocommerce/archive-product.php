<?php

/**
 * The Template for displaying product archives, including the main shop page which is a post type archive
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/archive-product.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 3.4.0
 */

defined('ABSPATH') || exit;

get_header('shop');

/**
 * Hook: woocommerce_before_main_content.
 *
 * @hooked woocommerce_output_content_wrapper - 10 (outputs opening divs for the content)
 * @hooked woocommerce_breadcrumb - 20
 * @hooked WC_Structured_Data::generate_website_data() - 30
 */
do_action('woocommerce_before_main_content');

?>

<div class="col-md-3 mb-3 contenedor-filtros">

	<div class="filtros">
		<div class="cerrar_filtros">X</div>
		<h3 class="h3_filtros"><img src="<?php echo get_bloginfo('template_directory'); ?>/assets/img/filtros.svg" alt="Filtros">FILTRAR CURSOS</h3>
		<div class="contenedor_filtros">
			<?php

			$filter_duracion = @$_GET['filter_duracion'];
			$filter_nivel = @$_GET['filter_nivel'];

			if ($filter_duracion || $filter_nivel) { ?>
				<a href="<?php echo get_permalink(wc_get_page_id('shop')); ?>" class="limpiar_filtros">X Limpiar Filtros</a>
			<?php } ?>

			<?php
			/**
			 * Hook: woocommerce_sidebar.
			 *
			 * @hooked woocommerce_get_sidebar - 10
			 */
			dynamic_sidebar('Woocommerce');

			?>
		</div>
	</div>

</div>
<div class="col-md-9 mb-3">
	<div class="row">
		<div class="col-12">
			<header class="woocommerce-products-header">
				<h1 class="woocommerce-products-header__title page-title">

					<?php

					if (is_search()) {
						/* translators: %s: search query */
						$page_title = sprintf(__('Search results: &ldquo;%s&rdquo;', 'woocommerce'), get_search_query());
						echo $page_title;
						if (get_query_var('paged')) {
							/* translators: %s: page number */
							$page_title .= sprintf(__('&nbsp;&ndash; Page %s', 'woocommerce'), get_query_var('paged'));
							echo $page_title;
						}
					} elseif (is_tax()) {

						$page_title = single_term_title('', false);
						echo 'Cursos de <span>' . $page_title . '</span>';
					} else {

						$shop_page_id = wc_get_page_id('shop');
						$page_title   = get_the_title($shop_page_id);
						echo 'Todos los <span>' . $page_title . '</span>';
					}
					?></h1>

				<div class="filtros_plp shadow">
					<ul>
						<li>
							<div id="mostrarFiltros"><img src="<?php echo get_bloginfo('template_directory'); ?>/assets/img/filtros.svg" alt="Filtros"> Mostrar Filtros</div>
						</li>
						<li>
							<?php do_action('woocommerce_before_shop_loop'); ?>
						</li>

					</ul>
				</div>

			</header>
		</div>
		<div class="col-12">
			<?php
			if (woocommerce_product_loop()) {
			?>
				<div class="ordenamiento_desk">
					<?php

					/**
					 * Hook: woocommerce_before_shop_loop.
					 *
					 * @hooked woocommerce_output_all_notices - 10
					 * @hooked woocommerce_result_count - 20
					 * @hooked woocommerce_catalog_ordering - 30
					 */
					do_action('woocommerce_before_shop_loop'); ?>

				</div>
			<?php



				woocommerce_product_loop_start();

				if (wc_get_loop_prop('total')) {
					while (have_posts()) {
						the_post();


						/**
						 * Hook: woocommerce_shop_loop.
						 */
						do_action('woocommerce_shop_loop');

						wc_get_template_part('content', 'product');
					}
				}

				woocommerce_product_loop_end();

				/**
				 * Hook: woocommerce_after_shop_loop.
				 *
				 * @hooked woocommerce_pagination - 10
				 */
				do_action('woocommerce_after_shop_loop');
			} else {
				/**
				 * Hook: woocommerce_no_products_found.
				 *
				 * @hooked wc_no_products_found - 10
				 */
				do_action('woocommerce_no_products_found');
			}

			/**
			 * Hook: woocommerce_after_main_content.
			 *
			 * @hooked woocommerce_output_content_wrapper_end - 10 (outputs closing divs for the content)
			 */
			do_action('woocommerce_after_main_content'); ?>
		</div>
	</div>


</div>
<?php

get_footer('shop');
