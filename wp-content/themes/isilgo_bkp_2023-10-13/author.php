<?php get_header();
$author_id = get_the_author_meta('ID');

$imagen = get_bloginfo('template_directory') . '/assets/img/bg_profe.jpg';
$linkedin = get_field('linkedin', 'user_' . $author_id);
$biografia = get_field('biografia', 'user_' . $author_id);
$experiencia = get_field('experiencia', 'user_' . $author_id);
$logros = get_field('logros', 'user_' . $author_id);
$args = array(
    'post_type'        => 'product',
    'author'        =>  $author_id,
    'orderby' => 'date',
    'order' => 'ASC',


);
$posteos = get_posts($args);

$count = count($posteos);
if ($count < 1) {
    $count = 0;
} else {
    $ids = false;
    $avg = 0;
    foreach ($posteos as $p) {
        $ids .= $p->ID . ',';
        $product = wc_get_product($p->ID);
        $avg =  $avg  + $product->get_average_rating();
    }
    $promedio = number_format(($avg / count($posteos)), 2, '.', ',');
};


?>

<div class="img_author_sup py-5" style="background:url(<?php echo $imagen; ?>)">
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <div class="centra_info">
                    <div class="imagen_profe" style="background:url(<?php echo get_field('foto_autor', 'user_' . $author_id); ?>);"></div>
                    <div>
                        <h1><?php echo get_the_author_meta('display_name', $author_id); ?></h1>
                        <h4 class="cargo"><?php echo get_field('cargo', 'user_' . $author_id); ?></h4>
                        <?php if (get_field('categoria', 'user_' . $author_id)) { ?>
                            <div class="categoria_profe_pdp"><?php echo get_field('categoria', 'user_' . $author_id)[0]->name; ?></div>
                        <?php } ?>

                        <p>Cantidad de cursos: <strong><?php echo $count; ?> <span class="estrella"><?php echo $promedio ?></span></strong></p>
                    </div>

                </div>

            </div>
            <?php if ($linkedin) { ?>
                <div class="col-12 linkedin">
                    <p>Conoce su perfil de Linkedin <a href="<?php echo $linkedin; ?>" target="_blank" title="Ver a <?php echo get_the_author_meta('display_name', $author_id); ?> en LinkedIn">Ver LinkedIn</a></p>
                </div>
            <?php }
            ?>
        </div>
    </div>
</div>

<div class="container">
    <div class="row">
        <div class="col-12 mt-3 mb-5">
            <div id="breadcrumbs" class="small">
                <span>
                    <span>
                        <a href="<?php echo get_bloginfo('url'); ?>" class="primer_bread"></a>
                    </span>&gt;
                    <span>
                        <a href="<?php echo get_permalink(264); ?>">Especialistas</a>
                    </span>&gt;
                    <span class="breadcrumb_last" aria-current="page"><strong><?php echo get_the_author_meta('display_name', $author_id); ?></strong></span>
                </span>

            </div>
        </div>
        <div class="col-md-8 mx-auto">

            <ul class="desc_author">
                <?php if ($biografia) { ?>
                    <li>
                        <div>
                            <img src="<?php echo get_bloginfo('template_directory'); ?>/assets/img/biografia.svg" alt="">
                        </div>
                        <div>
                            <h3>Biografía</h3>
                            <?php echo $biografia; ?>
                        </div>
                    </li>
                <?php } ?>
                <?php if ($experiencia) { ?>
                    <li>
                        <div>
                            <img src="<?php echo get_bloginfo('template_directory'); ?>/assets/img/experiencia.svg" alt="">
                        </div>
                        <div>
                            <h3>Experiencia</h3>
                            <?php echo $experiencia; ?>
                        </div>
                    </li>
                <?php } ?>
                <?php if ($logros) { ?>
                    <li>
                        <div>
                            <img src="<?php echo get_bloginfo('template_directory'); ?>/assets/img/logros.svg" alt="">
                        </div>
                        <div>
                            <h3>Logros</h3>
                            <?php echo $logros; ?>
                        </div>
                    </li>
                <?php } ?>
            </ul>
        </div>
        <?php if ($ids) { ?>
            <div class="col-12 bd">
                <h3 class="mi_membresia">Cursos <span>impartidos por el especialista</span></h3>

                <div class="woocommerce">
                    <ul class="products">

                        <?php
                        echo do_shortcode('[products ids="' . trim($ids, ',') . '" columns="4" orderby="id" order="DESC" visibility="visible"]');


                        ?>
                    </ul>
                </div>
            </div>
        <?php } ?>

    </div>
</div>


<?php get_footer(); ?>