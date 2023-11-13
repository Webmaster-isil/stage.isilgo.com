<?php global $product; ?>
<div class="destacados_single">
	<?php get_template_part('./woocommerce/loop/sale', 'flash'); ?>

</div>
<div class="title_summary">
	<h1>
		Curso de <?php the_title(); ?>
	</h1>
</div>

<div class="short_description">
	<p><?php echo get_the_excerpt(); ?></p>
</div>
<div class="by">
	<?php
	$author_id = get_the_author_meta('ID');
	if (count(get_coauthors(get_the_ID())) > 1) {
		$autores = false;
		foreach (get_coauthors(get_the_ID()) as $key => $coauthor) {
			$autores[$key]['ID'] = $coauthor->ID;
			$autores[$key]['FOTO'] = get_field('foto_autor', 'user_' . $coauthor->ID);
			$autores[$key]['CARGO'] = get_field('cargo', 'user_' . $coauthor->ID);
		}
	}



	if ($autores) { ?>
		<?php
		foreach ($autores as $a) {
			$foto_autor = $a['FOTO'];
			$cargo = $a['CARGO'];
		?>
			<ul>

				<?php if ($foto_autor) : ?>
					<li class="img_single_profe" style="background:url('<?php echo $foto_autor; ?>')"></li>
				<?php else : ?>
					<li class="img_single_profe" style="background:url('<?= get_template_directory_uri() ?>/assets/img/docentehold.png')"></li>
				<?php endif; ?>


				<li>
					<div>
						<p>Curso dictado por <a href="<?php echo esc_url(get_author_posts_url($a['ID'])); ?>"><?php echo get_the_author_meta('display_name', $a['ID']); ?></a></p>
						<p><span><?php echo $cargo; ?></span></p>
					</div>
				</li>
			</ul>

		<?php } ?>

	<?php } else { ?>
		<?php $foto_autor = get_field('foto_autor', 'user_' . $author_id);
		$cargo = get_field('cargo', 'user_' . $author_id);
		?>
		<ul>
			<?php if ($foto_autor) : ?>
				<li class="img_single_profe" style="background:url('<?php echo $foto_autor; ?>')"></li>
			<?php else : ?>
				<li class="img_single_profe" style="background:url('<?= get_template_directory_uri() ?>/assets/img/docentehold.png')"></li>
			<?php endif; ?>

			<li>
				<div>
					<p>Curso dictado por <a href="<?php echo esc_url(get_author_posts_url($author_id)); ?>"><?php echo get_the_author_meta('display_name', $author_id); ?></a></p>
					<p><span><?php echo $cargo; ?></span></p>
				</div>
			</li>
		</ul>
	<?php } ?>


</div>
<?php
$docu = get_field('documentos_descargables');
$prese = get_field('presentacion_interactiva');
$eva = get_field('evaluaciones');
$video = get_field('video_clase_con_especialista');
$certi = get_field('certificado_por_isil');
if ($docu || $prese || $eva || $video || $certi) { ?>
	<div class="caracteristicas_curso">
		<ul>
			<?php if ($docu) { ?><li><span><img src="<?php echo get_bloginfo('template_url') . '/assets/img/descargables.svg'; ?>" alt="icono Documentos"> Documentos Descargables</span></li><?php } ?>
			<?php if ($prese) { ?><li><span><img src="<?php echo get_bloginfo('template_url') . '/assets/img/presentacion.svg'; ?>" alt="icono presentación"> Presentación interactiva</span></li><?php } ?>
			<?php if ($eva) { ?><li><span><img src="<?php echo get_bloginfo('template_url') . '/assets/img/evaluacion.svg'; ?>" alt="icono Evaluaciones"> Evaluaciones</span></li><?php } ?>
			<?php if ($video) { ?><li><span><img src="<?php echo get_bloginfo('template_url') . '/assets/img/video.svg'; ?>" alt="icono Videos"> Video clase con especialista</span></li><?php } ?>
			<?php if ($certi) { ?><li><span><img src="<?php echo get_bloginfo('template_url') . '/assets/img/certificado.svg'; ?>" alt="icono certificado"> Certificado por ISIL</span></li><?php } ?>
		</ul>
	</div>
<?php } ?>

<div class="main_content">
	<?php the_content(); ?>

	<?php 

	$sobre_el_curso = get_field('sobre_el_curso');
	if ($sobre_el_curso) {
		echo '<h3 class="mt-3">Sobre el curso: </h3>';
		echo $sobre_el_curso;		
	};

	$que_necesito = get_field('que_necesito');
	if ($que_necesito) {
		echo '<h3 class="mt-3">Lo que necesitas: </h3>';
		echo $que_necesito;		
	};

	$aprenderas = get_field('aprenderas');
	if ($aprenderas) {
		echo '<h3 class="mt-3">Aprenderás a:</h3>';
		echo $aprenderas;		
	};

	$plan_de_estudio = get_field('plan_de_estudio');
	if ($plan_de_estudio) {
		echo '<h3 class="mt-3">Plan de estudio</h3>';
		echo '<ul class="plan_de_estudio">';
		foreach ($plan_de_estudio as $key => $p) {
			$key++;
			if (has_term(43, 'product_cat')) {
				echo '<li><div class="title_sesion"><p><strong>Subtema ' . $key . '</p></strong><p>' . $p['titulo'] . '</p><a class="ver_mas_sesion" href="#">Ver más</a></div><div class="sesion_detalle">' . $p['detalle'] . '</div></li>';
			} else {
				echo '<li><div class="title_sesion"><p><strong>Sesión ' . $key . '</p></strong><p>' . $p['titulo'] . '</p><a class="ver_mas_sesion" href="#">Ver más</a></div><div class="sesion_detalle">' . $p['detalle'] . '</div></li>';
			}
		}
		echo '</ul>';
	}

	$evaluacion = get_field('evaluacion');
	if ($evaluacion) {
		echo '<h3>Evaluación</h3>';
		echo $evaluacion;
	};
	
	?>

</div>

<?php
$rating_count = $product->get_rating_count();
$review_count = $product->get_review_count();
$average      = $product->get_average_rating();
$sales = $product->get_total_sales();

if ($rating_count) {


?>
	<div class="rating_single">
		<ul>
			<li><?php echo $sales; ?> Estudiantes</li>
			<li><?php echo wc_get_rating_html($average, $rating_count) . $average . ' (<span class="count">' . $review_count . ')</span>' ?></li>
			<li>Compartir en: <?php echo do_shortcode('[Sassy_Social_Share]'); ?></li>
		</ul>
	</div>
<?php } ?>

<?php


$contador = array();
$args = array('post_type' => 'product', 'post_id' => get_the_ID());
$reviews = get_comments($args);


// wp_list_comments(array('callback' => 'woocommerce_comments'), $comments);


if ($average) {


	foreach ($reviews as $review) {
		$rating = get_comment_meta($review->comment_ID, 'rating', true);
		$contador[$rating] = $contador[$rating] + 1;
	};

	for ($i = 1; $i < 6; $i++) {
		if (!$contador[$i]) {
			$contador[$i] = 0;
		}
	}
	krsort($contador);
?>
	<div class="row">
		<div class="col-12 valoracion_curso"><h2>Valoración del curso</h2></div>
		<div class="col-md-3 rating_grande">
			<h3><?php echo $average ?></h3>
			<?php echo wc_get_rating_html($average, $rating_count); ?>
			<p>Rating del curso</p>
		</div>
		<div class="col-md-9">
			<ul class="listado_custom">
				<?php
				foreach ($contador as $key => $c) {
					$porcentaje = $c * 100 / $review_count ?>

					<li>
						<style>
							.lineas_porcentaje_<?php echo $key; ?>::after {
								width: <?php echo $porcentaje . '%'; ?>;
							}
						</style>
						<span class="lineas_porcentaje lineas_porcentaje_<?php echo $key; ?>"></span>


						<span class="estrellita estrellita_<?php echo $key; ?>"></span>

						<?php echo round($porcentaje); ?>%
					</li>
				<?php }

				?>
			</ul>
		</div>
	</div>
<?php } ?>

<div class="row d-none">
	<div class="col-12 ">
		<?php

		comments_template();

		?>
	</div>
</div>