<?php
//Template name: Docentes



get_header();
$cabezal = get_field('cabezales');
$cabezales_mobile = get_field('cabezales_mobile');
if ($cabezal) { ?>
    <div class="cabezal_desktop">
        <img class="w-100" src="<?php echo $cabezal ?>" alt="">
    </div>
<?php }
if ($cabezales_mobile) { ?>
    <div class="cabezales_mobile">
        <img class="w-100" src="<?php echo $cabezales_mobile ?>" alt="">
    </div>
<?php }

$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
$number = 12;
$offset   = ($paged - 1) * $number;

if (isset($_GET['order']) && $_GET['order'] != '') {

    $arg = array(
        'order' => $_GET['order'],
        'orderby' => 'author',
        'who' => 'authors',
        'has_published_posts' => false,
        // 'exclude' => array(1)
    );
} else {
    $arg = array(
        'who' => 'authors',
        'has_published_posts' => false,
        // 'exclude' => array(1)
    );
}


if (isset($_GET['categoria']) && $_GET['categoria'] != '') {
    $arg['meta_query'] = array(
        'relation' => 'AND',
        array(
            'key'     => 'categoria',
            'value'   => $_GET['categoria'],
            'compare' => 'LIKE'
        )
    );
}

if (isset($_GET['nombre']) && $_GET['nombre'] != '') {
    $arg['search'] = esc_attr('*' . $_GET['nombre']) . '*';
    $arg['search_columns'] = array('display_name', 'user_nicename');
}


$users  = get_users($arg);
$arg['offset'] = $offset;
$arg['number'] = $number;

// filter by role authors
$roles_exclude = array('administrator','employee');
$user_to_exclude = get_users(array('role__in'=> $roles_exclude));
$ids_user_to_exclude = wp_list_pluck($user_to_exclude, 'ID');

$arg['exclude'] = $ids_user_to_exclude;

$query    = get_users($arg);

$total_users = count($users);
$total_query = count($query);
//$total_pages = intval($total_users / $number);
$total_pages = intval($total_users / $number)+1;

?>


<h1 class="titulo_pagina"><?php the_title(); ?></h1>



<div class="container mb-3">
    <div class="row">
        <div class="col-12 mt-3">
            <?php echo get_template_part('./woocommerce/global/breadcrumb'); ?>
        </div>

        <div class="col-md-3 mb-3">


            <div class="filtros_plp_docentes">
                <ul class="shadow">
                    <li>
                        <div id="mostrarFiltros2"><img src="<?php echo get_bloginfo('template_directory'); ?>/assets/img/filtro2.svg" alt="Filtros"> Filtrar</div>
                    </li>
                    <li class="muestraOrdenamientoDocente">
                        <img src="<?php echo get_bloginfo('template_directory'); ?>/assets/img/ordenar.svg" alt="Ordenar por"> Ordenar
                        <form action="<?php echo get_permalink() ?>" method="GET" class="ordenaDocentes ordena_docentes_mobile">
                            <?php if ($_GET['categoria']) { ?>
                                <input type="hidden" name="categoria" value="<?php echo $_GET['categoria']; ?>">
                            <?php } ?>

                            <select name="order" id="archive-sort-mobile">
                                <option hidden disabled selected value="default">...</option>
                                <option value="ASC">Ordenar por nombre: Ascendente</option>
                                <option value="DESC">Ordenar por nombre: Descendente</option>

                            </select>
                            <input class="d-none" type="submit" name="" value="Filtrar">
                        </form>
                    </li>

                </ul>
            </div>

            <div class="muestra_filtro_profe_mobile">
                <h3><img src="<?php echo get_bloginfo('template_directory'); ?>/assets/img/FILTRO.svg" alt=""> FILTRAR ESPECIALISTAS</h3>
                <span class="cerrar_filtro_profe"><img src="<?php echo get_bloginfo('template_directory'); ?>/assets/img/cerrar.svg" alt=""></span>
                <form action="<?php echo get_permalink(); ?>" method="GET">
                    <div class="cerrar_filtro_especialista">X</div>
                    <div class="relative lupa_docente">

                        <input type="text" class="form-control" name="nombre" placeholder="Buscar docente..." value="<?php if ($_GET['nombre']) {
                                                                                                                            echo $_GET['nombre'];
                                                                                                                        } ?>">
                        <img src="<?php echo get_bloginfo('template_directory'); ?>/assets/img/lupa_docente.svg" alt="Buscar docente">
                    </div>
                    <div class="listado_docentes">
                        <h3>Categorías</h3>
                        <?php
                        $args = array(
                            'taxonomy' => 'product_cat',
                            'orderby' => 'name',
                            'show_count' => 0,
                            'pad_counts' => 0,
                            'hierarchical' => 1,
                            'title_li' => '',
                            'hide_empty' => 1,
                            'exclude' => array(24)
                        );
                        $all_categories = get_categories($args);
                        foreach ($all_categories as $cat) { ?>
                            <span class="d-block mb-2"><input type="radio" name="categoria" <?php if (isset($_GET['categoria']) && $_GET['categoria'] == $cat->term_id) {
                                                                                                echo 'checked="checked"';
                                                                                            } ?> value="<?php echo $cat->term_id; ?>"> <?php echo $cat->name; ?></span>
                        <?php } ?>
                        <span class="d-block mb-2"><input type="radio" name="categoria" <?php if (isset($_GET['categoria']) && $_GET['categoria'] == '') {
                                                                                            echo 'checked="checked"';
                                                                                        } ?> value="">Todos</span>
                    </div>
                    <div class="btns_mobile_filtro_docente">
                        <a href="<?php echo get_the_permalink(); ?>" class="btn_limpiar_docentes">Limpiar filtros</a>
                        <input class="btn_filtrar_docentes" type="submit" name="" value="Aplicar filtros">
                    </div>

                </form>
            </div>
            <div class="filtro_especialistas">

                <h3 class="h3_filtros click_filtro_especialista"><img src="<?php echo get_bloginfo('template_directory'); ?>/assets/img/filtros.svg" alt="Filtros">Filtrar especialistas</h3>
                <div class="muestra_filtro">
                    <form action="<?php echo get_permalink(); ?>" method="GET">

                        <div class="relative lupa_docente">
                            <input type="text" class="form-control" name="nombre" placeholder="Buscar docente..."  value="<?php if ($_GET['nombre']) {
                                                                                                                                                        echo $_GET['nombre'];
                                                                                                                                                    } ?>">

                            <img src="<?php echo get_bloginfo('template_directory'); ?>/assets/img/lupa_docente.svg" alt="Buscar docente">
                        </div>
                        <div class="listado_docentes">
                            <h3>Categorías</h3>
                            <?php
                            $args = array(
                                'taxonomy' => 'product_cat',
                                'orderby' => 'name',
                                'show_count' => 0,
                                'pad_counts' => 0,
                                'hierarchical' => 1,
                                'title_li' => '',
                                'hide_empty' => 1,
                                'exclude' => array(24)
                            );
                            $all_categories = get_categories($args);
                            foreach ($all_categories as $cat) { ?>
                                <span class="d-block mb-2"><input type="radio" name="categoria" <?php if (isset($_GET['categoria']) && $_GET['categoria'] == $cat->term_id) {
                                                                                                    echo 'checked="checked"';
                                                                                                } ?> value="<?php echo $cat->term_id; ?>"> <?php echo $cat->name; ?></span>
                            <?php } ?>
                            <span class="d-block mb-2"><input type="radio" name="categoria" <?php if (isset($_GET['categoria']) && $_GET['categoria'] == '') {
                                                                                                echo 'checked="checked"';
                                                                                            } ?> value="">Todos</span>
                            <input class="btn_filtrar_docentes" type="submit" name="" value="Filtrar">
                        </div>
                    </form>
                </div>
            </div>

        </div>
        <div class="col-md-9">
            <h3 class="mi_membresia">Especialistas <span>ISIL Go</span></h3>
            <div class="conteo_mobile_docentes">
                <?php echo $total_users; ?> Resultados
            </div>
            <div class="resultados_listado_docentes">
                <p><?php echo $total_users; ?> resultados</p>

                <form action="<?php echo get_permalink() ?>" method="GET" class="ordenaDocentes">
                    <p>Ordenar por:</p>
                    <?php if ($_GET['categoria']) { ?>
                        <input type="hidden" name="categoria" value="<?php echo $_GET['categoria']; ?>">
                    <?php } ?>

                    <select name="order" id="archive-sort">
                        <option hidden disabled selected value="default">...</option>
                        <option value="ASC">Ordenar por nombre: Ascendente</option>
                        <option value="DESC">Ordenar por nombre: Descendente</option>

                    </select>
                    <input class="d-none" type="submit" name="" value="Filtrar">
                </form>



            </div>
            <div>
                <div class="carga_resultado"></div>
            </div>
            <ul class="listado_profe" id="listado_profe">

                <?php
                foreach ($query as $profe) {
				// if(!in_array('administrator', $profe->roles) //||!in_array('nuevo_rol_a_excluir', $profe->roles)
				  // ){
				?>
					
				
				
                    <li>
                        <?php if (get_field('foto_autor', 'user_' . $profe->ID)) : ?>
                            <div class="imagen_profe" style="background:url('<?php echo get_field('foto_autor', 'user_' . $profe->ID); ?>')">
                            <?php else : ?>
                                <div class="imagen_profe" style="background:url('<?= get_template_directory_uri() ?>/assets/img/backhold.png')">
                                <?php endif;
                            $cat_profe = get_field('categoria', 'user_' . $profe->ID);
                            if ($cat_profe) { ?><div class="categoria_profe"><?php echo $cat_profe[0]->name; ?></div><?php } ?>
                                </div>
                                <div class="cont_profe">
                                    <div class="cont_profe_box">
                                        <h3><?php echo $profe->display_name; ?></h3>
										
                                        <h4 class="cargo"><?php echo get_field('cargo', 'user_' . $profe->ID); ?></h4>
                                        <?php
                                        $args = array(
                                            'post_type'        => 'product',
                                            'author'        =>  $profe->ID,
                                            'orderby' => 'date',
                                            'order' => 'ASC',
                                            'posts_per_page' => 999,
                                        );
                                        $posteos = get_posts($args);


                                        $count = count($posteos);
                                        if ($count < 1) {
                                            $count = 0;
                                        } else {
                                            $ids = false;
                                            $avg = 0;
                                            $ratings = array();
	                                        $top_ratings = 0;
                                            foreach ($posteos as $p) {
                                                $ids .= $p->ID . ',';
                                                $product = wc_get_product($p->ID);
                                                //$avg =  $avg  + $product->get_average_rating();
                                                array_push($ratings,$product->get_average_rating());
                                            }
                                            //$promedio = number_format(($avg / count($posteos)), 2, '.', ',');
                                            $top_ratings  = max($ratings);
                                        };


                                        ?>
                                        <p>Cantidad de cursos: <strong><?php echo $count ?></strong>

                                            <?php

                                            if ($top_ratings != 0) { ?><span class="estrella"><?php echo $top_ratings; ?></span>
                                        </p>
                                    <?php } ?>
                                    </div>
                                    <a href="<?php echo get_author_posts_url($profe->ID); ?>">Ver especialista</a>
                                </div>
                    </li>
                <?php } ?>
            </ul>
            <div class="col-12 text-right pag_docentes">

                <?php


                if ($total_users > $total_query) { ?>
                    <!-- MODIFICADO POR ISIL C.A. -->
                    <div id="pagination" class="paginacion_listado_docentes d-flex justify-content-between justify-content-md-end mt-3">
                        <a class="back_top text-center" href="#listado_profe">Volver arriba</a>
                    <!-- MODIFICADO POR ISIL C.A. -->
                        <?php
                        $current_page = max(1, get_query_var('paged'));

                        echo paginate_links(array(
                            // 'base' => get_pagenum_link(1) . '%_%',
                            'format' => 'page/%#%/',
                            'current' => $current_page,
                            'total' => $total_pages,
                            'prev_next'    => true,
                            'type'         => 'list',
                        ));

                        // echo paginate_links(array(
                        //     'base' => get_pagenum_link(1) . '%_%',
                        //     'format' => 'page/%#%/',
                        //     'current' => $current_page,
                        //     'total' => $total_pages,
                        //     'prev_next'    => true,
                        //     'type'         => 'list',
                        // )); 
                        ?>
                    </div>
                <?php }
                ?>
            </div>


        </div>


    </div>
</div>
<div class="container-fluid fondo_especial_abajo_docentes">
    <div class="container">
        <div class="row">
            <div class="col-12 text-center">
                <h3 class="mi_membresia">Cursos más <span>vendidos</span></h3>
            </div>
            <div class="col-12">
                <div id="cursos_home">
                    <?php echo do_shortcode('[masVendidosHome]'); ?>
                </div>
            </div>
        </div>
    </div>
</div>


<?php get_footer(); ?>