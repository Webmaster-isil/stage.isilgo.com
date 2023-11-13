<?php

// ini_set('display_errors', 1);
// ini_set('display_startup_errors', 1);
// error_reporting(E_ALL);

?>
<!DOCTYPE html>
<html class="no-js" lang="es-PE" xml:lang="es-PE">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="Content-Type" content="<?php bloginfo('html_type'); ?>" />
    <meta http-equiv="Content-Language" content="es" />
    <title>
        <?php if (is_home() || is_front_page()) { ?>
            <?php bloginfo('name'); ?> | <?php bloginfo('description'); ?>
        <?php } else { ?>
            <?php wp_title($sep = ''); ?> | <?php bloginfo('description'); ?>
        <?php } ?>
    </title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Rubik:ital,wght@0,400;0,500;0,700;1,400;1,500;1,700&display=swap" rel="stylesheet">

    <!-- Favicon -->
    <link rel="apple-touch-icon" sizes="57x57" href="<?= get_template_directory_uri() ?>/assets/favicon/apple-icon-57x57.png">
    <link rel="apple-touch-icon" sizes="60x60" href="<?= get_template_directory_uri() ?>/assets/favicon/apple-icon-60x60.png">
    <link rel="apple-touch-icon" sizes="72x72" href="<?= get_template_directory_uri() ?>/assets/favicon/apple-icon-72x72.png">
    <link rel="apple-touch-icon" sizes="76x76" href="<?= get_template_directory_uri() ?>/assets/favicon/apple-icon-76x76.png">
    <link rel="apple-touch-icon" sizes="114x114" href="<?= get_template_directory_uri() ?>/assets/favicon/apple-icon-114x114.png">
    <link rel="apple-touch-icon" sizes="120x120" href="<?= get_template_directory_uri() ?>/assets/favicon/apple-icon-120x120.png">
    <link rel="apple-touch-icon" sizes="144x144" href="<?= get_template_directory_uri() ?>/assets/favicon/apple-icon-144x144.png">
    <link rel="apple-touch-icon" sizes="152x152" href="<?= get_template_directory_uri() ?>/assets/favicon/apple-icon-152x152.png">
    <link rel="apple-touch-icon" sizes="180x180" href="<?= get_template_directory_uri() ?>/assets/favicon/apple-icon-180x180.png">
    <link rel="icon" type="image/png" sizes="192x192" href="<?= get_template_directory_uri() ?>/assets/favicon/android-icon-192x192.png">
    <link rel="icon" type="image/png" sizes="32x32" href="<?= get_template_directory_uri() ?>/assets/favicon/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="96x96" href="<?= get_template_directory_uri() ?>/assets/favicon/favicon-96x96.png">
    <link rel="icon" type="image/png" sizes="16x16" href="<?= get_template_directory_uri() ?>/assets/favicon/favicon-16x16.png">
    <link rel="manifest" href="<?= get_template_directory_uri() ?>/assets/favicon/manifest.json">
    <meta name="msapplication-TileColor" content="#ffffff">
    <meta name="msapplication-TileImage" content="<?= get_template_directory_uri() ?>/assets/favicon/ms-icon-144x144.png">
    <meta name="theme-color" content="#ffffff">

    <?php

    /* script */
    wp_enqueue_script('bootstrap', get_bloginfo('template_directory') . '/assets/js/bootstrap5/js/bootstrap.min.js', false, '1.1', true);

    wp_enqueue_script('owlcarouselJS', get_bloginfo('template_directory') . '/assets/js/owl.carousel.js', false, '1.1', true);
    wp_enqueue_script('script', get_bloginfo('template_directory') . '/assets/js/script.js', false, '1.1', true);
    /* estilos */
    wp_enqueue_style('bootstrap', get_bloginfo('template_directory') . '/assets/css/bootstrap5/css/bootstrap.min.css');
    wp_enqueue_style('bootstrap', get_bloginfo('template_directory') . '/assets/css/bootstrap5/css/bootstrap-reboot.min.css');
    wp_enqueue_style('owlcarouselThemeCSS', get_bloginfo('template_directory') . '/assets/css/owl.theme.default.css');
    wp_enqueue_style('owlcarouselCSS', get_bloginfo('template_directory') . '/assets/css/owl.carousel.css');

    wp_enqueue_style('style', get_bloginfo('template_directory') . '/style.css');
    // wp_enqueue_style('responsive', get_bloginfo('template_directory') . '/responsive.css');
    // wp_enqueue_style('responsive-320', get_bloginfo('template_directory') . '/responsive-css/responsive-320.css');
    wp_enqueue_style('responsive-768', get_bloginfo('template_directory') . '/responsive-css/responsive-768.css');
    wp_enqueue_style('responsive-1000', get_bloginfo('template_directory') . '/responsive-css/responsive-1000.css');
    wp_enqueue_style('responsive-1200', get_bloginfo('template_directory') . '/responsive-css/responsive-1200.css');
    wp_enqueue_style('responsive-1368', get_bloginfo('template_directory') . '/responsive-css/responsive-1368.css');
    tieneMembresia();

    registraMail();

    wp_head() ?>


</head>
<div class="cortina">
        <div>
            <img src="<?php echo get_field('logo', 'options'); ?>" alt="Logo">

            <div class="loaderCustom"></div>
        </div>

    </div>

<body <?php body_class(); ?>>
    <?php wp_body_open(); ?>
    <?php

    $items_count = WC()->cart->get_cart_contents_count();
    if ($items_count == 0) {
        $items_count = '0';
    }
    ?>
    <header class="header">
        <?php

        $timer_header = new DateTime(get_field('timer_header', 'options'));
        $fecha_de_inicio = new DateTime(get_field('fecha_de_inicio', 'options'));
        $now = new DateTime();


        $diff2 = $fecha_de_inicio->diff($now);


        $diff = $timer_header->diff($now);

        if ($diff2->invert == 0) {
            if ($diff->invert == 1) { ?>
                <?php if (get_field('texto_preheader', 'options')) {
                    if ($_SESSION['cierraPreheader'] == true) { ?>
                        <div class="container-fluid ancla_preheader">
                            <div class="container">
                                <div class="row preheader">
                                    <div class="col-md-8 preheader_01">
                                        <?php echo get_field('texto_preheader', 'options'); ?>
                                    </div>
                                    <div class="col-md-4 preheader_02">
                                        <p><?php timerHeader(); ?></p>
                                        <div class="cerrar_preheader">X</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                <?php }
                } ?>
        <?php }
        }

        ?>
        <div class="container-fluid header_global">
            <div class="container relative">
                <div class="row">
                    <div class="col-md-2 col-4 logo"><a href="<?php echo get_bloginfo('url'); ?>" title="Ir al inicio"><img class="w-100" src="<?php echo get_field('logo', 'options'); ?>" alt="ISIL GO"></a></div>
                    <div class="col-md-6 col-1 d-flex align-items-center menu">
                        <ul class="menu_header">
                            <li class="relative"><a href="#" class="menu-hamburguesa" title="Menú"></a>
                                <?php wp_nav_menu(array('menu' => 'Hamburguesa')); ?>
                            </li>
                            <li><a href="<?php echo get_permalink(wc_get_page_id('shop')); ?>" class="icono_menu" title="Cursos">Cursos</a></li>
                            <li><a href="/membresias" title="Membresías">Membresias</a></li>
                            <li style="margin-right:20px"><a href="/masterclass" title="Master Class">Master Class</a></li>
                            <li class="b2_mobile_head"><?php echo do_shortcode('[fibosearch]'); ?></li>
                        </ul>
                    </div>

                    <div class="col-md-4 col-7 carrito">
                        <ul class="login_header">
                            <li class="smobile">
                            <div class="busqueda_mobile_header">
                                <?php echo do_shortcode('[fibosearch]'); ?>
                            </div>
                            </li>
                            <li class="banderas">

                                <?php echo do_shortcode(' [woo_multi_currency_layout4]'); ?>

                            </li>
                            <?php if (is_user_logged_in()) { ?>

                                <li class="usuario_logueado">
                                    <div>Bienvenido,<br><span><?php echo wp_get_current_user()->display_name; ?></span></div>
                                    <a href="/mi-cuenta" title="Mi cuenta">
                                        <img src="<?php echo get_bloginfo('template_directory'); ?>/assets/img/login.svg" alt="Mi cuenta">
                                    </a>
                                </li>
                                <li class="mi_cuenta_home">
                                    <a href="#" title="Mi cuenta">Mi cuenta</a>
                                    <?php wp_nav_menu(array('container' => 'ul', 'menu' => 'Mi Cuenta', 'menu_class' => "menu-mi-cuenta")); ?>

                                </li>
                                <li class="carrito_li">
                                    <?php echo do_shortcode('[whmc_mini_cart]'); ?>
                                </li>

                            <?php } else { ?>
                                <script type="text/javascript">
                                    function HandlePopupResult(result) {
                                        window.location.href = result;
                                    }

                                    function moOAuthLoginNew(app_name) {
                                        window.location.href = '<?php echo get_bloginfo('url'); ?>' + '/?option=oauthredirect&app_name=' + app_name;
                                    }
                                </script>
                                <li class="login_header">
                                    <a class="login" href="javascript:void(0) " onclick="moOAuthLoginNew('openidconnect');" title="Iniciar sesión">Iniciar sesión</a>
                                    <a class="register" href="https://login.isilgo.com/accountrecoveryendpoint/redirectregister.do" title="Registrarse">REGISTRARSE</a>
                                </li>


                                <?php global $estadoMembresia;
                                if (!$estadoMembresia) {
                                ?>
                                    <li class="carrito_li">
                                        <?php echo do_shortcode('[whmc_mini_cart]'); ?>
                                    </li>
                                <?php
                                } ?>
                            <?php } ?>


                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <div class="container">
            <div class="row">
                <div class="col-12 relative">
                    <?php wp_nav_menu(array('menu' => 'Cursos')); ?>
                </div>
            </div>
        </div>

    </header>
    <main>
        <?php
        if (is_single()) { ?>
            <div class="container-fluid especial_profesor">
                <div class="container">
                    <div class="by">
                        <?php
                        $author_id = get_the_author_meta('ID');
                        $foto_autor = get_field('foto_autor', 'user_' . $author_id);
                        $cargo = get_field('cargo', 'user_' . $author_id);
                        ?>
                        <ul>
                            <li>
                                <div class="imagen_profe_plp" style="background:url('<?php echo $foto_autor; ?>')"></div>

                            </li>
                            <li>
                                <div>
                                    <p class="tit"><?php the_title(); ?></p>
                                    <p class="small">Dictado por <a href="<?php echo esc_url(get_author_posts_url($author_id)); ?>" title="<?php echo get_the_author_meta('display_name', $author_id); ?>"><?php echo get_the_author_meta('display_name', $author_id); ?></a></p>

                                </div>
                            </li>
                        </ul>


                    </div>
                </div>
            </div>
        <?php }
        ?>