</main>
<footer>
    <div class="pop_up_alerta_bg">
        <div class="centra">
            <div class="contenido_pop_alerta shadow">
                <div class="col-md-8 mx-auto">
                    <div class="row align-items-center justify-content-center">
                        <div class="col-12">

                            <h3>¡TIENES AGREGADA <span>UNA MEMBRESÍA!</span></h3>
                        </div>
                        <div class="col-md-2">
                            <img class="w-100" src="<?php echo get_bloginfo('template_directory'); ?>/assets/img/warning.svg" alt="">
                        </div>
                        <div class="col-md-10 mx-auto txt">

                            <p>Tienes una membresía y cursos en tu carrito, debes seleccionar si deseas los cursos o la membresía, ya que al comprar membresía tienes acceso a todos nuestros cursos</p>

                        </div>
                        <div class="col-12">
                            <a class="back_cart" href="<?php echo wc_get_cart_url(); ?>">Volver al carrito</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <?php

    if (!is_cart()) {
        revisaMembresia();
    }

    if (get_field('texto_membresia', 'options')) {
        if (is_shop() || is_front_page() || is_product_category()) { ?>
            <div class="pop_membresia shadow">
                <?php echo get_field('texto_membresia', 'options'); ?>
            </div>
    <?php }
    }
    ?>

    <div class="footer container-fluid bg-azul">
        <div class="container">
            <div class="row">
                <div class="col-md-2 logo-footer"><a href="<?php echo get_bloginfo('url'); ?>" title="Ir al inicio"><img class=" w-100" src="<?php echo get_field('logo', 'options'); ?>" alt="ISIL GO"></a></div>
                <div class="col-md-3 menus_footer d-none d-md-block">
                    <p><strong>Categorías</strong></p>
                    <?php wp_nav_menu(array('menu' => 'categorias')); ?>
                </div>
                <div class="col-md-2 menus_footer d-none d-md-block">
                    <p><strong>Ayuda</strong></p>
                    <?php wp_nav_menu(array('menu' => 'ayuda')); ?>
                </div>
                <div class="col-md-2 menus_footer d-none d-md-block">
                    <p><strong>La compañía</strong></p>
                    <?php wp_nav_menu(array('menu' => 'la compañia')); ?>
                </div>
                <!-- Mobile -->
                <div class="accordion-footer d-block d-md-none">
                    <div class="col-md-3 menus_footer content_acordeon">
                        <div class="accordion-header">
                            <p><strong>Categorías</strong></p>
                            <div class="accordion-icon">+</div>
                        </div>
                        <div class="accordion-content">
                            <?php wp_nav_menu(array('menu' => 'categorias')); ?>
                        </div>
                    </div>
                    <div class="col-md-3 menus_footer content_acordeon">
                        <div class="accordion-header">
                            <p><strong>Ayuda</strong></p>
                            <div class="accordion-icon">+</div>
                        </div>
                        <div class="accordion-content">
                            <?php wp_nav_menu(array('menu' => 'ayuda')); ?>
                        </div>
                    </div>
                    <div class="col-md-3 menus_footer content_acordeon">
                        <div class="accordion-header">
                            <p><strong>La compañía</strong></p>
                            <div class="accordion-icon">+</div>
                        </div>
                        <div class="accordion-content">
                            <?php wp_nav_menu(array('menu' => 'la compañia')); ?>
                        </div>
                    </div>
                </div>
                <!-- Mobile -->
                <div class="col-md-3 redes-footer">
                    <?php echo get_field('texto_newsletter', 'options') ?>
                    <?php echo do_shortcode('[contact-form-7 id="73" title="newsletter"]'); ?>
                    <p class="titulo-footer-rrss"><strong>Síguenos en</strong></p>
                    <ul class="rrss_footer">
                        <?php
                        $rrss = get_field('rrss', 'options');

                        if ($rrss) {
                            foreach ($rrss as $r) {
                                echo '<li><a href="' . $r['link'] . '" target="_blank" title="Siguenos en redes sociales"><img src="' . $r['icono'] . '" alt="Siguenos en redes sociales"></a></li>';
                            }
                        };
                        ?>


                    </ul>
                </div>
            </div>
        </div>
    </div>
    <div class="final_footer bg-celeste final_footer">
        © <?php echo date('Y'); ?> ISIL Go Todos los derechos reservados
    </div>
    <?php wp_footer(); ?>
</footer>
<?php

$opciones_de_menu = get_field('opciones_de_menu', 'options');


if ($opciones_de_menu == 1) { ?>
    <style>
        header.header {
            position: sticky;
            width: 100%;
            top: 0;
            z-index: 5;
            height: 160px;
        }

        .especial_profesor {
            top: 160px !important;
        }

        .sidebar_fixed {
            top: 260px !important;
        }
    </style>
<?php }

if ($opciones_de_menu == 2) { ?>

    <style>
        header.header {
            position: sticky;
            width: 100%;
            top: 0;
            z-index: 5;
        }

        .especial_profesor {
            top: 114px !important;
        }

        .sidebar_fixed {
            top: 230px !important;
        }
    </style>
<?php } ?>
<style></style>
<script>
    var url = "<?php echo wp_logout_url(get_bloginfo('url')); ?>";
    jQuery("#menu-mi-cuenta").append('<li><a class="cerrar_sesion" href="' + url + '" title="Cerrar sesión">Cerrar sesión</a></li>');
</script>
</body>


</html>