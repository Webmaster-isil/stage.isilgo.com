<?php
//Template name: Docentes
get_header();
$cabezal = get_field('cabezales');

if ($cabezal) { ?>
    <div>
        <img class="w-100" src="<?php echo $cabezal ?>" alt="">
    </div>
<?php }
?>


<h1 class="titulo_pagina"><?php the_title(); ?></h1>



<div class="container mb-3">
    <div class="row">
        <div class="col-12 mt-3">
            <?php echo get_template_part('./woocommerce/global/breadcrumb'); ?>
        </div>

        <div class="col-12">
            <h3 class="mi_membresia">Especialistas <span>ISIL Go</span></h3>
            <ul class="listado_profe">

                <?php

                $profesor = get_users(['role__in' => 'AUTHOR']);
                $i = 0;
                foreach ($profesor as $profe) {
                    $id = $profe->ID;
                    $args = array(
                        'author'        =>  $id,
                        'post_type'  => 'product',
                        'order' => 'ASC',
                        'numberposts' => 6,
                        'orderby' => 'RAND'


                    );
                    $p = get_posts($args);
                    $count = count($p);
                    $i++;
                ?>

                    <li id="<?php echo $i; ?>" <?php if ($i >= 13) {
                                                    echo 'class="profe_oculto"';
                                                } else {
                                                    echo 'class="profe_visible"';
                                                } ?>>
                        <?php if (get_field('foto_autor', 'user_' . $id)) : ?>
                            <div class="imagen_profe" style="background:url('<?php echo get_field('foto_autor', 'user_' . $id); ?>')">
                            <?php else : ?>
                                <div class="imagen_profe" style="background:url('<?= get_template_directory_uri() ?>/assets/img/backhold.png')">
                                <?php endif;
                            $cat_profe = get_field('categoria', 'user_' . $id);


                            if ($cat_profe) { ?>
                                    <div class="categoria_profe"><?php echo $cat_profe[0]->name; ?></div>
                                <?php } ?>
                                </div>
                                <div class="cont_profe">
                                    <div class="cont_profe_box">
                                        <h3><?php echo $profe->display_name; ?></h3>
                                        <h4 class="cargo"><?php echo get_field('cargo', 'user_' . $id); ?></h4>
                                        <p>Cantidad de cursos: <strong><?php echo $count; ?></strong>
                                            <?php
                                            $nota_profe = get_field('nota', 'user_' . $id);
                                            if ($nota_profe) { ?>
                                                <span class="estrella"><?php echo $nota_profe; ?></span>
                                        </p>
                                    <?php } ?>
                                    </div>
                                    <a href="<?php echo get_author_posts_url($profe->ID); ?>">Ver especialista</a>
                                </div>
                    </li>
                    <?php ?>
                <?php } ?>
            </ul>
        </div>
        <div class="col-md-12 text-center"><a data-contadorbtn="13" id="ver_mas_profes" class="btn btn-primary btn-xl" href="#"> VER MÁS</a></div>
    </div>
</div>



<?php get_footer(); ?>