<?php
// Template name: Centro de Ayuda
get_header('shop');
$cabezal = get_field('cabezales');
$cabezales_mobile = get_field('cabezales_mobile');
if ($cabezal) { ?>
    <div class="cabezal_desktop">

        <div class="fondo_centro_ayuda" style="background:url(<?php echo $cabezal ?>)">
            <div class="container">
                <div class="row">
                    <div class="col-12 my-3">
                        <h1><?php the_title(); ?></h1>
                        <p><?php the_excerpt(); ?></p>
                        <div class="item_buscar relative">
                            <img src="<?php echo get_bloginfo('template_directory'); ?>/assets/img/lupa_buscar.svg" alt=""><input type="text" name="" id="palabras_buscar" placeholder="Ingresar búsqueda...">
                        </div>
                        <div class="centra_busqueda">
                            <div class="resultado_busqueda"></div>
                        </div>
                    </div>
                </div>

            </div>
        </div>

    </div>
<?php }
if ($cabezales_mobile) { ?>
    <div class="cabezales_mobile">
        <div class="fondo_centro_ayuda" style="background:url(<?php echo $cabezal ?>)">
            <div class="container">
            <div class="row">
                    <div class="col-12 my-3">
                        <h1><?php the_title(); ?></h1>
                        <p><?php the_excerpt(); ?></p>
                        <div class="item_buscar relative">
                            <img src="<?php echo get_bloginfo('template_directory'); ?>/assets/img/lupa_buscar.svg" alt=""><input type="text" name="" id="palabras_buscar_mobile" placeholder="Ingresar búsqueda...">
                        </div>
                        <div class="centra_busqueda">
                            <div class="resultado_busqueda_mobile"></div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
<?php }
?>

<div class="container">
    <div class="row">
        <div class="col-12">
            <?php echo get_template_part('./woocommerce/global/breadcrumb'); ?>
        </div>
    </div>
    <?php the_content(); ?>
</div>
<?php get_footer('shop'); ?>