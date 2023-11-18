<?php
include('integraciones/integracion.php');
include('integraciones/certificados.php');
include('integraciones/api-isil.php');
include('integraciones/grados.php');
include('integraciones/restauracion.php');
session_start();

add_action('wp_logout', 'auto_redirect_after_logout');

function auto_redirect_after_logout()
{
    wp_safe_redirect(home_url());
    exit;
}

function revisaMembresia()
{
    $carrito = WC()->cart->get_cart();
    $count = count($carrito);
    $existeMembresia = array();
    $cursoNormal = array();

    if ($count > 1) {
        foreach ($carrito as $items) {
            $id = $items['product_id'];
            $product = wc_get_product($id);
            if (in_array(24, $product->get_category_ids())) {
                $existeMembresia[] = $id;
            } else {
                $cursoNormal[] = $id;
            }
        }
        if ($existeMembresia && $cursoNormal) { ?>
            <style>
                .pop_up_alerta_bg {
                    display: block !important;
                }
            </style>
    <?php }
    }
}

function revisaCarritoMembresia()
{

    $existeMembresia = array();
    $cursoNormal = array();
    $carrito = WC()->cart->get_cart();
    $count = count($carrito);

    if ($count > 1) {
        foreach ($carrito as $items) {
            $id = $items['product_id'];
            $product = wc_get_product($id);
            if (in_array(24, $product->get_category_ids())) {
                $existeMembresia[] = $id;
            } else {
                $cursoNormal[] = $id;
            }
        }
        if ($existeMembresia && $cursoNormal) {
            echo '1';
        }
    }

    die();
}
add_action("wp_ajax_revisaCarritoMembresia", "revisaCarritoMembresia");
add_action("wp_ajax_nopriv_revisaCarritoMembresia", "revisaCarritoMembresia");

add_filter('woocommerce_cart_redirect_after_error', '__return_false');

// add_action( 'wp_enqueue_scripts', 'WHMC-js');

/* SOPORTES */
add_theme_support('post-thumbnails');
add_theme_support('wc-product-gallery-zoom');
add_theme_support('wc-product-gallery-lightbox');
add_theme_support('wc-product-gallery-slider');
add_theme_support('automatic-feed-links');
add_post_type_support('page', 'excerpt');
add_theme_support('woocommerce');
add_post_type_support('product', 'author');

register_nav_menus(array('menu' => 'Menu'));

/* SOPORTES WOOCOMMERCE */

function my_theme_wrapper_start()
{
    /* MODIFICADO POR ISIL */
    $post_id = get_the_ID();
    //echo $post_id;
    if (in_array($post_id, array(9480,398, 501)))
    {
        echo '<div class="container-xl pt-3"><div class="row">';
    }    
    else
    {
        echo '<div class="container pt-3"><div class="row">';
    }
    /* MODIFICADO POR ISIL */
}
function my_theme_wrapper_end()
{
    echo '</div></div>';
}

add_action('woocommerce_before_main_content', 'my_theme_wrapper_start', 10);
add_action('woocommerce_after_main_content', 'my_theme_wrapper_end', 10);
/* FIN SOPORTES */


add_filter('upload_mimes', 'custom_upload_mimes');
function custom_upload_mimes($existing_mimes = array())
{
    // Add the file extension to the array
    $existing_mimes['svg'] = 'image/svg+xml';
    $existing_mimes['xla|xls|xlt|xlw'] = 'application/vnd.ms-excel';
    return $existing_mimes;
}


function sidebar_custom()
{
    register_sidebar(
        array('name' => 'Woocommerce', 'id' => 'woo_widget', 'before_widget' => '<div class="widget %2$s">', 'after_widget' => '</div>', 'before_title' => '<p class="widget_title">', 'after_title' => '</p>',)
    );
    register_sidebar(
        array('name' => 'SSO', 'id' => 'sso_widget', 'before_widget' => '<div class="widget %2$s">', 'after_widget' => '</div>', 'before_title' => '<p class="widget_title">', 'after_title' => '</p>',)
    );
}
add_action('widgets_init', 'sidebar_custom');

function timerHeader()
{
    $tiempo = get_field('timer_header', 'options');

    echo '<span id="timerHeader"></span></p>
    <script>                
    var countDownDate = new Date("' . $tiempo . '");
    var x = setInterval(function() {
        var now = new Date();            
        var distance = countDownDate - now;        
        var days = Math.floor(distance / (1000 * 60 * 60 * 24));
        var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
        var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
        var seconds = Math.floor((distance % (1000 * 60)) / 1000);                  
        if(days > 0) {
            jQuery("#timerHeader").text(days + "d " + hours + "h " + minutes + "m " + seconds + "s");
        }else {
            jQuery("#timerHeader").text(hours + "h " + minutes + "m " + seconds + "s");
        }
       
    }, 1000);
</script>';
}

// timer() retorna días, horas, minutos y segundos el tiempo restante de los productos en oferta
function timer()
{
    global $product;
    global $wpdb;
    $discount_details = apply_filters('advanced_woo_discount_rules_get_product_discount_details', false, $product);
    if ($discount_details !== false) {

        $id = $discount_details['applied_rules']['0']['id'];
        $query = "SELECT conditions from wp_wdr_rules where ID = '$id'";
        $to = json_decode($wpdb->get_results($query)[0]->conditions)->{2}->options->to;
        $sales_price_to = date('M j, Y', strtotime($to));
        echo '<p class="precio_oferta_tiempo">TERMINA:
            <span id="timer-' . $product->id . '"></span></p>
            <script>                
                var countDownDate' . $product->id . ' = new Date("' . $sales_price_to . '");
                var x' . $product->id . ' = setInterval(function() {
                    var now = new Date();                    
                    var distance = countDownDate' . $product->id . ' - now;
                    var days' . $product->id . ' = Math.floor(distance / (1000 * 60 * 60 * 24));
                    var hours' . $product->id . ' = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
                    var minutes' . $product->id . ' = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
                    var seconds' . $product->id . ' = Math.floor((distance % (1000 * 60)) / 1000);                  
                    if(days' . $product->id . ' > 0) {
                        jQuery("#timer-' . $product->id . '").text(days' . $product->id . ' + " Días,  " + hours' . $product->id . ' + ":" + minutes' . $product->id . ' + ":" + seconds' . $product->id . ');
                    }else {
                        jQuery("#timer-' . $product->id . '").text(hours' . $product->id . ' + ":" + minutes' . $product->id . ' + ":" + seconds' . $product->id . ');
                    }
                    if (distance < 0) {
                        clearInterval(x' . $product->id . ');
                        jQuery("#timer-' . $product->id . '").text("¡HOY!");
                    }
                }, 1000);
            </script>';
    }
}



/**
 * CAMBIAR NÚMERO DE RELACIONADOS
 */
function woo_related_products_limit()
{
    global $product;

    $args['posts_per_page'] = 9;
    return $args;
}

add_filter('woocommerce_output_related_products_args', 'jk_related_products_args', 20);
function jk_related_products_args($args)
{
    $args['posts_per_page'] = 9;
    $args['columns'] = 1;
    return $args;
}





// ELIMINAR LOS PRODUCTOS DE CIERTAS CATEGORIAS EN EL QUERY PRINCIPAL

add_action('woocommerce_product_query', 'eliminaCategoriaPLP');
function eliminaCategoriaPLP($q)
{
    $tax_query = (array) $q->get('tax_query');
    $tax_query[] = array(
        'taxonomy' => 'product_cat',
        'field' => 'slug',
        'terms' => array('suscripciones'),
        'operator' => 'NOT IN'
    );
    $q->set('tax_query', $tax_query);
}







// LIMITAR CANTIDAD DE PRODUCTOS AL CARRO //


function verificaCarrito($product_id, $cart_item_key = '')
{
    global $woocommerce;
    $cantidad = 0;
    foreach ($woocommerce->cart->get_cart() as $other_cart_item_keys => $values) {
        if ($product_id == $values['product_id']) {
            if ($cart_item_key == $other_cart_item_keys) {
                continue;
            }
            $cantidad += (int) $values['quantity'];
        }
    }
    return $cantidad;
}



function compraRapida()
{
    $id     = $_POST['id'];
    WC()->cart->empty_cart();
    WC()->cart->add_to_cart($id, 1);

    die();
}


add_action("wp_ajax_compraRapida", "compraRapida");
add_action("wp_ajax_nopriv_compraRapida", "compraRapida");


if (!isset($_SESSION["cierraPreheader"])) {
    $_SESSION["cierraPreheader"] = true;
}


add_action('wp_ajax_cierraPreheader', 'cierraPreheader');
add_action('wp_ajax_nopriv_cierraPreheader', 'cierraPreheader');

function cierraPreheader()
{
    $_SESSION["cierraPreheader"] = false;
    die();
}


// function revisaMembresia()
// {

// }




function especialistas()
{ ?>
    <div class="carrusel_docentes">
        <ul class="owl-carousel docentes">
            <?php
            $profesor = get_users([
                'role__in' => 'author',
                'number' => 9,
                'order' => 'ASC',
                'orderby' => 'rand',
            ]); 
            
            shuffle($profesor);
            foreach ($profesor as $profe) {
                $categoria = get_field('categoria', 'user_' . $profe->ID);
                $foto = get_field('foto_autor', 'user_' . $profe->ID);
                $cargo = get_field('cargo', 'user_' . $profe->ID);
                $link = get_author_posts_url($profe->ID);
            ?>
                <li>
                    <?php if ($foto) : ?>
                        <a href="<?php echo $link; ?>" class="link_profe_carrusel_home">
                            <div class="imagen_carrusel_profe" style="background:url('<?php echo $foto; ?>')"></div>
                        </a>
                    <?php else : ?>
                        <div class="imagen_carrusel_profe" style="background:url('<?= get_template_directory_uri() ?>/assets/img/docentehold.png')"></div>
                    <?php endif; ?>
                    <div>
                        <p class="enlace_profe_home"><strong><a href="<?php echo get_author_posts_url($profe->ID);  ?>"><?php echo $profe->display_name; ?></a></strong></p>

                        <?php
                        if ($cargo) { ?>
                            <p><?php echo $cargo; ?></p>
                        <?php } ?>
                        <?php if ($categoria) { ?>
                            <ul class="cargo_home_profe">
                                <?php foreach ($categoria as $cat) {
                                    echo '<li>' . $cat->name . '</li>';
                                } ?>
                            </ul>
                        <?php }
                        ?>
                        <!-- <a href="<?php echo get_author_posts_url($profe->ID); ?>">Ver Especialista</a> -->
                    </div>
                </li>
            <?php
            } ?>



        </ul>

    </div>
<?php }
add_shortcode('especialistas', 'especialistas');


function especiales_membresias()
{ ?>
    <ul class="nav nav-tabs muestraSoloDesktop" id="tab_especial_membresia" role="tablist">
        <li class="nav-item" role="presentation">
            <button class="nav-link active" id="all-course-tab" data-bs-toggle="tab" data-bs-target="#all-course" type="button" role="tab" aria-controls="all-course" aria-selected="true">Todos los cursos</button>
        </li>
        <li class="nav-item" role="presentation">
            <button class="nav-link" id="nuevos-cursos-tab" data-bs-toggle="tab" data-bs-target="#nuevos-cursos" type="button" role="tab" aria-controls="nuevos-cursos" aria-selected="false">Nuevos cursos</button>
        </li>
        <li class="nav-item" role="presentation">
            <button class="nav-link" id="cursos-libres-tab" data-bs-toggle="tab" data-bs-target="#cursos-libres" type="button" role="tab" aria-controls="cursos-libres" aria-selected="false">Cursos libres</button>

        </li>

        <li class="nav-item" role="presentation">
            <button class="nav-link" id="cursos-gratis-tab" data-bs-toggle="tab" data-bs-target="#cursos-gratis" type="button" role="tab" aria-controls="cursos-gratis" aria-selected="false">Cursos gratis</button>

        </li>

        <li class="nav-item" role="presentation">
            <button class="nav-link" id="mas-vendidos-tab" data-bs-toggle="tab" data-bs-target="#mas-vendidos" type="button" role="tab" aria-controls="mas-vendidos" aria-selected="false">Lo más vendido</button>

        </li>

        <li class="nav-item" role="presentation">
            <button class="nav-link" id="ofertas-tab" data-bs-toggle="tab" data-bs-target="#ofertas" type="button" role="tab" aria-controls="ofertas" aria-selected="false">Ofertas</button>
        </li>

    </ul>

    <ul class="nav nav-tabs owl-carousel muestraSoloMobile" id="tab_especial_membresia" role="tablist">
        <li class="nav-item" role="presentation">
            <button class="nav-link active chequeaLinkAzul" id="all-course-tab" data-bs-toggle="tab" data-bs-target="#all-course" type="button" role="tab" aria-controls="all-course" aria-selected="true">Todos los cursos</button>
        </li>
        <li class="nav-item" role="presentation">
            <button class="nav-link chequeaLinkAzul" id="nuevos-cursos-tab" data-bs-toggle="tab" data-bs-target="#nuevos-cursos" type="button" role="tab" aria-controls="nuevos-cursos" aria-selected="false">Nuevos cursos</button>
        </li>
        <li class="nav-item" role="presentation">
            <button class="nav-link chequeaLinkAzul" id="cursos-libres-tab" data-bs-toggle="tab" data-bs-target="#cursos-libres" type="button" role="tab" aria-controls="cursos-libres" aria-selected="false">Cursos libres</button>

        </li>

        <li class="nav-item" role="presentation">
            <button class="nav-link chequeaLinkAzul" id="cursos-gratis-tab" data-bs-toggle="tab" data-bs-target="#cursos-gratis" type="button" role="tab" aria-controls="cursos-gratis" aria-selected="false">Cursos gratis</button>

        </li>

        <li class="nav-item" role="presentation">
            <button class="nav-link chequeaLinkAzul" id="mas-vendidos-tab" data-bs-toggle="tab" data-bs-target="#mas-vendidos" type="button" role="tab" aria-controls="mas-vendidos" aria-selected="false">Lo más vendido</button>

        </li>

        <li class="nav-item" role="presentation">
            <button class="nav-link chequeaLinkAzul" id="ofertas-tab" data-bs-toggle="tab" data-bs-target="#ofertas" type="button" role="tab" aria-controls="ofertas" aria-selected="false">Ofertas</button>
        </li>

    </ul>


    <div class="tab-content" id="nav_especial_membresia">

        <?php
        if (!function_exists('arreglo')) {
            function arreglo($tax = false)
            {
                $array = array(
                    'suppress_filters' => true,
                    'post_type' => 'product',
                    'posts_per_page' => 10,
                    'order' => 'ASC',
                    'orderby' => 'RAND',
                    'tax_query'            => array(
                        array(
                            'taxonomy' => 'product_cat',
                            'field'    => 'id', // Or 'name' or 'term_id'
                            'terms'    => array(24),
                            'operator' => 'NOT IN', // Excluded
                        )
                    )

                );
                if ($tax) {

                    $array = array(
                        'suppress_filters' => true,
                        'post_type' => 'product',
                        'posts_per_page' => 10,
                        'order' => 'ASC',
                        'orderby' => 'rand',
                        'tax_query' => array(
                            'relation' => 'AND',
                            array(
                                'tax_query'            => array(
                                    array(
                                        'taxonomy' => 'product_cat',
                                        'field'    => 'id', // Or 'name' or 'term_id'
                                        'terms'    => 24,
                                        'operator' => 'NOT IN', // Excluded
                                    ),
                                    array(
                                        'taxonomy'    => 'product_tag',
                                        'field'        => 'slug',
                                        'terms'        => $tax
                                    )
                                ),
                            ),
                        ),

                    );
                }

                return $array;
            }
        }

        $allCourse = arreglo(); ?>
        <div class="tab-pane fade show active" id="all-course" role="tabpanel" aria-labelledby="all-course-tab">
            <div class="woocommerce">
                <ul class="products woocommerce columns-1 owl-carousel especiales_membresias">
                    <?php
                    $the_query = new WP_Query($allCourse);
                    if ($the_query->have_posts()) {
                        while ($the_query->have_posts()) {
                            $the_query->the_post();
                            do_action('woocommerce_shop_loop');
                            wc_get_template_part('content', 'product');
                        }
                    }
                    wp_reset_postdata();
                    ?>

                </ul>
            </div>
        </div>
        <?php

        $nuevosCursos = arreglo('cursos-nuevos'); ?>
        <div class="tab-pane fade" id="nuevos-cursos" role="tabpanel" aria-labelledby="nuevos-cursos-tab">
            <div class="woocommerce">
                <ul class="products woocommerce columns-1 owl-carousel especiales_membresias">
                    <?php
                    $the_query = new WP_Query($nuevosCursos);
                    if ($the_query->have_posts()) {
                        while ($the_query->have_posts()) {
                            $the_query->the_post();
                            do_action('woocommerce_shop_loop');
                            wc_get_template_part('content', 'product');
                        }
                    }
                    wp_reset_postdata();
                    ?>

                </ul>
            </div>
        </div>
        <?php

        $cursosLibres = arreglo('cursos-libres'); ?>

        <div class="tab-pane fade" id="cursos-libres" role="tabpanel" aria-labelledby="cursos-libres-tab">
            <div class="woocommerce">
                <ul class="products woocommerce columns-1 owl-carousel especiales_membresias">
                    <?php
                    $the_query = new WP_Query($cursosLibres);
                    if ($the_query->have_posts()) {
                        while ($the_query->have_posts()) {
                            $the_query->the_post();
                            do_action('woocommerce_shop_loop');
                            wc_get_template_part('content', 'product');
                        }
                    }
                    wp_reset_postdata();
                    ?>

                </ul>
            </div>
        </div>
        <?php
        $cursosGratis = arreglo('cursos-gratis'); ?>
        <div class="tab-pane fade" id="cursos-gratis" role="tabpanel" aria-labelledby="cursos-gratis-tab">
            <div class="woocommerce">
                <ul class="products woocommerce columns-1 owl-carousel especiales_membresias">
                    <?php
                    $the_query = new WP_Query($cursosGratis);
                    if ($the_query->have_posts()) {
                        while ($the_query->have_posts()) {
                            $the_query->the_post();
                            do_action('woocommerce_shop_loop');
                            wc_get_template_part('content', 'product');
                        }
                    }
                    wp_reset_postdata();
                    ?>

                </ul>
            </div>
        </div>
        <?php
        $masVendidosArgs = array(
            'post_type' => 'product',
            'posts_per_page' => 5,
            'orderby' => 'RAND',
            'meta_key' => 'total_sales',
            'orderby' => 'meta_value_num',
        );
        $masVendidos = get_posts($masVendidosArgs); ?>
        <div class="tab-pane fade" id="mas-vendidos" role="tabpanel" aria-labelledby="mas-vendidos-tab">
            <div class="woocommerce">
                <ul class="products woocommerce columns-1 owl-carousel especiales_membresias">
                    <?php
                    $the_query = new WP_Query($allCourse);
                    if ($the_query->have_posts()) {
                        while ($the_query->have_posts()) {
                            $the_query->the_post();
                            do_action('woocommerce_shop_loop');
                            wc_get_template_part('content', 'product');
                        }
                    }
                    wp_reset_postdata();
                    ?>

                </ul>
            </div>

        </div>
        <?php

        $ofertasArgs = arreglo('cursos-ofertas'); ?>
        <div class="tab-pane fade" id="ofertas" role="tabpanel" aria-labelledby="ofertas-tab">
            <div class="woocommerce">
                <ul class="products woocommerce columns-1 owl-carousel especiales_membresias">
                    <?php
                    $the_query = new WP_Query($ofertasArgs);
                    if ($the_query->have_posts()) {
                        while ($the_query->have_posts()) {
                            $the_query->the_post();
                            do_action('woocommerce_shop_loop');
                            wc_get_template_part('content', 'product');
                        }
                    }
                    wp_reset_postdata();
                    ?>

                </ul>
            </div>
        </div>
    </div>
    <?php
}

add_shortcode('especiales_membresias', 'especiales_membresias');

add_action('wp_enqueue_scripts', 'test_enqueue');

function test_enqueue()
{
    if (defined('WHMC_URL')) {
        wp_dequeue_script('WHMC-js');
        wp_enqueue_script('WHMC-js', WHMC_URL . 'assets/public/js/whmc-public.js', array(
            'jquery',
            'wc-cart-fragments'
        ), time(), true);
    }
}



function reorder_account_menu($items)
{
    return array(
        'dashboard'          => __('Dashboard', 'woocommerce'),
        'membresia_dashboard'             => __('Membresias', 'woocommerce'),
        'certificados'             => __('Certificados', 'woocommerce'),
        'edit-account'       => __('Edit Account', 'woocommerce'),

        'orders'             => __('Orders', 'woocommerce'),
        'downloads'          => __('Downloads', 'woocommerce'),

        'edit-address'       => __('Addresses', 'woocommerce'),
        'customer-logout'    => __('Logout', 'woocommerce'),
    );
}
add_filter('woocommerce_account_menu_items', 'reorder_account_menu');


function remove_edit_account_tab($items)
{


    unset($items['downloads']);
    unset($items['edit-address']);
    unset($items['downloads']);
    return $items;
}
add_filter('woocommerce_account_menu_items', 'remove_edit_account_tab');

function rename_account_dashboard($items)
{

    $items['dashboard'] = "Mis Cursos";
    $items['orders'] = "Historial de compras";
    $items['edit-account'] = "Editar perfil";
    $items['customer-logout'] = "Cerrar Sesión";
    return $items;
}
add_filter('woocommerce_account_menu_items', 'rename_account_dashboard');




function register_membresia_dashboard_endpoint()
{
    add_rewrite_endpoint('membresia_dashboard', EP_ROOT | EP_PAGES);
    add_rewrite_endpoint('certificados', EP_ROOT | EP_PAGES);
}
add_action('init', 'register_membresia_dashboard_endpoint');


function membresia_dashboard_query_vars($vars)
{

    $vars[] = 'membresia_dashboard';
    $vars[] = 'certificados';
    return $vars;
}
add_filter('query_vars', 'membresia_dashboard_query_vars');

function add_membresia_dashboard_tab($items)
{

    $items['membresia_dashboard'] = 'Membresia';
    $items['certificados'] = 'Certificados';
    return $items;
}
add_filter('woocommerce_account_menu_items', 'add_membresia_dashboard_tab');


function add_membresia_dashboard_content()
{
    get_template_part('dashboard', 'membresias');
}
add_action('woocommerce_account_membresia_dashboard_endpoint', 'add_membresia_dashboard_content');

function add_certificados_content()
{
    get_template_part('dashboard', 'certificados');
}
add_action('woocommerce_account_certificados_endpoint', 'add_certificados_content');


function registraMail()
{
    if (is_user_logged_in() && !wp_get_current_user()->data->user_email) {
        $userdata = array(
            'ID' => get_current_user_id(),
            'user_email' => wp_get_current_user()->data->user_login,
        );
        wp_update_user($userdata);
    }
}

add_action('woocommerce_checkout_fields', 'customization_readonly_billing_fields', 10, 1);
function customization_readonly_billing_fields($checkout_fields)
{
    $current_user = wp_get_current_user();
    foreach ($checkout_fields['billing'] as $key => $field) {
        if ($key == 'billing_email') {
            if (strlen($current_user->user_login) > 0) {
                $checkout_fields['billing'][$key]['custom_attributes'] = array('readonly' => 'readonly');
            }
        }
    }
    return $checkout_fields;
}

add_filter('woocommerce_address_to_edit', 'cb_woocommerce_address_to_edit');
function cb_woocommerce_address_to_edit($address)
{
    array_key_exists('billing_email', $address) ? $address['billing_email']['custom_attributes'] = array('readonly' => 'readonly') : '';
    array_key_exists('billing_email-2', $address) ? $address['billing_email-2']['custom_attributes'] = array('readonly' => 'readonly') : '';
    return $address;
}


function woocommerce_template_loop_product_thumbnail()
{
    global $post;
    $imagen = get_the_post_thumbnail_url($post->ID);
    if ($imagen) : ?>
        <div class="img_catalog" style="background:url('<?php echo $imagen; ?>')"></div>
    <?php else : ?>
        <div class="img_catalog" style="background:url('<?= get_template_directory_uri() ?>/assets/img/backhold.png')"></div>
    <?php
    endif;
}

add_action('wpcf7_mail_sent', 'isil_gift');

function isil_gift($cf7form)
{
    //	include_once WC_ABSPATH . 'includes/wc-cart-functions.php';
    //	include_once WC_ABSPATH . 'includes/class-wc-cart.php';
    $nombre      = $cf7form->name();
    $submission  = WPCF7_Submission::get_instance();
    $posted_data = null;
    if (is_null(WC()->cart)) {
        wc_load_cart();
    }
    if ($nombre === 'regalo') {
        if ($submission) {
            if (!is_admin()) {
                $posted_data = $submission->get_posted_data();
                global $wpdb;
                $product_id = $posted_data['prodid']; //replace with your own product id
                $found = false;
                //check if product already in cart
                if (sizeof(WC()->cart->get_cart()) > 0) {
                    WC()->cart->empty_cart();
                    // if product not found, add it
                    WC()->cart->add_to_cart($product_id);
                } else {
                    // if no products in cart, add it
                    WC()->cart->add_to_cart($product_id);
                }
            }
            $postergar = $posted_data['fecha-envio'][0] == 'Programado' ? 1 : 0;

            $months = array(
                '01' => 'Enero',
                '02' => 'Febrero',
                '03' => 'Marzo',
                '04' => 'Abril',
                '05' => 'Mayo',
                '06' => 'Junio',
                '07' => 'Julio',
                '08' => 'Agosto',
                '09' => 'Septiembre',
                '10' => 'Octubre',
                '11' => 'Noviembre',
                '12' => 'Diciembre',

            );

            $mes = array_search($posted_data['mes'][0], $months);
            $fecha_completa = "{$posted_data['anio'][0]}-{$mes}-{$posted_data['dia'][0]} {$posted_data['hora'][0]}";
            $fecha_time = strtotime($fecha_completa);
            $fecha_ajustada = $fecha_time - get_option('gmt_offset') * 3600;
            $fecha = $postergar == 1 ? date('Y-m-d H:i:s', $fecha_ajustada) : date('Y-m-d H:i');
            //            error_reporting(E_ALL);
            //            ini_set('display_errors', 1);

            //            die();

            WC()->session->set('id_producto_regalo', $posted_data['prodid']);
            WC()->session->set('correo_destinatario', $posted_data['correo']);
            WC()->session->set('nombre_destinatario', $posted_data['para']);
            WC()->session->set('nombre_remitente', $posted_data['nombre']);
            WC()->session->set('mensaje', $posted_data['mensaje']);
            WC()->session->set('postergar', $postergar);
            WC()->session->set('fecha_envio', $fecha);
            $_SESSION['es_regalo_form'] = true;
            WC()->session->set('es_regalo_form', true);
        }
    }
}

add_filter('wpcf7_form_tag_data_option', 'set_years_gift', 10, 3);

function set_years_gift($null, $options, $args)
{
    if (in_array('gift-year', $options)) {
        $current = date('Y');
        $years = array();
        $years[$current] = $current;
        $years[$current + 1] = $current + 1;
        return $years;
    }
    return $null;
}

add_filter('wpcf7_form_tag_data_option', 'set_months_gift', 10, 3);

function set_months_gift($null, $options, $args)
{
    if (in_array('gift-month', $options)) {
        $months = array(
            '01' => 'Enero',
            '02' => 'Febrero',
            '03' => 'Marzo',
            '04' => 'Abril',
            '05' => 'Mayo',
            '06' => 'Junio',
            '07' => 'Julio',
            '08' => 'Agosto',
            '09' => 'Septiembre',
            '10' => 'Octubre',
            '11' => 'Noviembre',
            '12' => 'Diciembre',

        );
        return $months;
    }
    return $null;
}

add_filter('wpcf7_form_tag_data_option', 'set_days_gift', 10, 3);

function set_days_gift($null, $options, $args)
{
    if (in_array('gift-day', $options)) {
        for ($i = 1; $i <= 31; $i++) {
            $day = str_pad($i, 2, '0', STR_PAD_LEFT);
            $days[$day] = $day;
        }
        return $days;
    }
    return $null;
}

add_filter('wpcf7_form_tag_data_option', 'set_hours_gift', 10, 3);

function set_hours_gift($null, $options, $args)
{
    if (in_array('gift-hour', $options)) {
        $date = date('Y-m-d');
        $hours = array();
        for ($i = 0; $i <= 23; $i++) {
            $hour = date('H:i', strtotime($date . ' +' . $i . ' hours'));
            $hours[$hour] = $hour;
        }
        return $hours;
    }
    return $null;
}


add_action('woocommerce_thankyou', 'custom_woocommerce_auto_complete_order');
function custom_woocommerce_auto_complete_order($order_id)
{
    if (!$order_id) {
        return;
    }
    $order = wc_get_order($order_id);
    $order->update_status('completed');
}

add_action( 'woocommerce_before_thankyou', 'wp_woocommerce_thankyou_action' );
function wp_woocommerce_thankyou_action($order_id){
	$order = wc_get_order($order_id);
	$userdata = array(
	'ID' => get_current_user_id(),
	'display_name' => "{$order-> get_billing_first_name()} {$order-> get_billing_last_name()}",
	);
	wp_update_user($userdata);
	
	$phone = $order->get_billing_phone();
	$first_name = $order->get_billing_first_name();
	$last_name = $order->get_billing_last_name();
	$metas = array( 
		'telefono'   => $phone,
		'first_name' => $first_name, 
		'last_name'  => $last_name,
	);

	foreach($metas as $key => $value) {
		update_user_meta( get_current_user_id(), $key, $value );
	}
}

add_action('woocommerce_checkout_order_created', 'save_regalo_queue');

function save_regalo_queue($order)
{
    if (!empty(WC()->session->get('id_producto_regalo'))) {
        global $wpdb;
        $table_name = $wpdb->prefix . 'regalos_queue';
        $wpdb->insert(
            $table_name,
            array(
                'id_producto'         => WC()->session->get('id_producto_regalo'),
                'correo_destinatario' => WC()->session->get('correo_destinatario'),
                'nombre_destinatario' => WC()->session->get('nombre_destinatario'),
                'nombre_remitente'    => WC()->session->get('nombre_remitente'),
                'mensaje'             => WC()->session->get('mensaje'),
                'postergar'           => WC()->session->get('postergar'),
                'fecha_envio'         => WC()->session->get('fecha_envio'),
                'pagado'              => 0,
                'enviado'             => 0,
                'id_orden'            => $order->get_id()
            )
        );
        WC()->session->__unset('id_producto_regalo');
        WC()->session->__unset('correo_destinatario');
        WC()->session->__unset('nombre_destinatario');
        WC()->session->__unset('nombre_remitente');
        WC()->session->__unset('mensaje');
        WC()->session->__unset('postergar');
        WC()->session->__unset('fecha_envio');
        WC()->session->__unset('es_regalo_form');
    }
}

add_action('woocommerce_order_status_changed', 'completa_regalo', 99, 3);
//add_action( 'woocommerce_payment_complete_order_status_completed', 'completa_regalo' );

function completa_regalo($order_id, $old_status, $new_status)
{

    log_functions('Entra a completar regalo', 'ok', __FUNCTION__);

    if ($new_status == 'completed' || $new_status == 'processing') {

        global $wpdb;

        $table_name = $wpdb->prefix . 'regalos_queue';

        $sql = $wpdb->prepare("SELECT * FROM {$table_name} WHERE id_orden=%d", $order_id);

        $results = $wpdb->get_results($sql, ARRAY_A);
        log_functions('resultado de tabla', json_encode($results, JSON_PRETTY_PRINT), __FUNCTION__);

        if ($results) {
            log_functions('Encontró resultado', 'Entró if', __FUNCTION__);
            $row = $results[0];
            log_functions('Row de regalo que se acaba de pagar', json_encode($row, JSON_PRETTY_PRINT), __FUNCTION__);
            if ($row['pagado'] == 0) {
                log_functions('No está pagado y debería marcarla', 'Entró if pagado == 0', __FUNCTION__);
                $wpdb->update($table_name, array('pagado' => 1), array('id_orden' => $order_id));
                $usuario_beneficiario = get_user_by_email($row['correo_destinatario']);
                log_functions('Busco si existe usuario', var_export($usuario_beneficiario, true), __FUNCTION__);
                if ($usuario_beneficiario) {
                    asocia_curso($row['id_producto'], $usuario_beneficiario->ID, $order_id);
                }
            }
            log_functions('Busco si postergar está en 0 para enviar', var_export($row['postergar'], true), __FUNCTION__);
            if ($row['postergar'] == 0) {
                log_functions('Envío inmediato correo', 'ok', __FUNCTION__);
                envia_correo_regalo($row);
            }
        }
    }

    // do anything
}

function envia_correo_regalo($registro)
{
    log_functions('registro: ', json_encode($registro, JSON_PRETTY_PRINT), __FUNCTION__);
    global $wpdb;
    $table_name = $wpdb->prefix . 'regalos_queue';

    $curso  = wc_get_product($registro['id_producto']);
    $nombre_curso = $curso->get_name();
    $full_url = get_site_url() . '?option=oauthredirect&app_name=openidconnect&redirect_url=' . get_permalink($registro['id_producto']);
    $site_url = get_site_url();
    $register_url = 'https://login.isilgo.com/accountrecoveryendpoint/redirectregister.do';
    if (isset($registro['nombre_remitente'])) {
        $remitente = $registro['nombre_remitente'];
        $mensaje = $registro['mensaje'];
        $destinatario = $registro['nombre_destinatario'];
        $email = $registro['correo_destinatario'];
        $subject = '¡Una sorpresa increíble de parte de un gran amigo!';
    } else {
        $order = wc_get_order($registro['id_orden']);
        $remitente = $order->get_billing_first_name() . ' ' . $order->get_billing_last_name();
        $mensaje = false;
        $destinatario = '';
        $email = $registro['correo_suscripcion'];
        $subject = '¡Una sorpresa increíble de parte de un gran amigo!';
    }
    log_functions('recurrencia dato]: ', get_post_meta($registro['id_producto'], 'RADAR_RECURRENCE_FREQ', true), __FUNCTION__);
    if (!get_post_meta($registro['id_producto'], 'RADAR_RECURRENCE_FREQ', true)) {
        $main_body = sprintf('%s te ha regalado un curso online "%s" puedes iniciar tu aprendizaje iniciando sesión <a href="%s">aquí</a>', $remitente, $nombre_curso, $full_url);
    } else {
        $main_body = sprintf('%s te ha regalado una membresía "%s" puedes potenciar tu perfil profesional desde ahora, inicia sesión <a href="%s">aquí</a>', $remitente, $nombre_curso, $full_url);
    }

    log_functions('Body principal: ', $main_body, __FUNCTION__);

    ob_start();
    get_template_part('email-regalo', null, array(
        'nombre_destinatario' => $destinatario,
        'parrafo_regalo' => $main_body,
        'register' => $register_url,
        'site_url' => $site_url,
        'mensaje' => $mensaje
    ));
    $mensaje = ob_get_contents();
    ob_end_clean();
    $envio = wp_mail($email, $subject, $mensaje, array('Content-Type: text/html; charset=UTF-8'));
    ob_start();                    // start buffer capture

    $contents = ob_get_contents(); // put the buffer into a variable
    ob_end_clean();
    log_functions('Envio de correo: ', $contents, __FUNCTION__);
    if ($envio) {
        log_functions('Envío correcto', 'ok', __FUNCTION__);
        $wpdb->update($table_name, array('enviado' => 1), array('id_orden' => $registro['id_orden']));
    }
}

//if (!wp_next_scheduled('isil_regalos_cron')) {
//    $hour = date('H') + 1;
//    $time = strtotime(date('Y-m-d ' . $hour . ':00'));
//    wp_schedule_event($time, 'ten_seconds', 'isil_regalos_cron');
//}

//add_filter('cron_schedules', 'example_add_cron_interval');
//function example_add_cron_interval($schedules)
//{
//    $schedules['ten_seconds'] = array(
//        'interval' => 10,
//        'display'  => esc_html__('Every Ten Seconds'),
//    );
//    return $schedules;
//}


//add_action('isil_regalos_cron', 'envia_correos_queue_regalos');
add_action('wp_ajax_nopriv_isil_regalos', 'envia_correos_queue_regalos');
function envia_correos_queue_regalos()
{
    global $wpdb;
    $table_name = $wpdb->prefix . 'regalos_queue';

    $sql = $wpdb->prepare("SELECT * FROM {$table_name} WHERE pagado=1 AND postergar=1 AND enviado=0 AND asociado=0 AND fecha_envio <=%s", date('Y-m-d H:i'));

    $logger = wc_get_logger();
    $context = array('source' => 'regalos_queue');
    $logger->info('query ' . $wpdb->last_query, $context);

    $results = $wpdb->get_results($sql, ARRAY_A);
    if ($results) {
        foreach ($results as $row) {
            envia_correo_regalo($row);
        }
    }
}

add_action('wp_login', 'asocia_regalo', 99, 2);

function asocia_regalo($user_login, $user)
{
    //    if (!current_user_can('manage_options')) {
    // die('ah');
    log_functions('asociacion regalo', 'entra', __FUNCTION__);
    global $wpdb;
    $table_name = $wpdb->prefix . 'regalos_queue';

    $sql = $wpdb->prepare("SELECT * FROM {$table_name} WHERE correo_destinatario=%s AND pagado=1 AND asociado=0 AND id_usuario_asociado IS NULL ORDER BY id DESC", $user->user_email);
    log_functions('Query tabla regalos', $sql, __FUNCTION__);
    $results = $wpdb->get_results($sql, ARRAY_A);
    log_functions('resultado consulta', json_encode($results, JSON_PRETTY_PRINT), __FUNCTION__);
    if ($results) {
        log_functions('entra al resultado de regalos', '', __FUNCTION__);
        foreach ($results as $row) {
            $order = wc_get_order($row['id_orden']);
            //            $recurrent_table = $wpdb->prefix . 'niubiz_recurrent_payment';
            //            $sql = $wpdb->prepare("SELECT * FROM {$recurrent_table} WHERE purchaseNumber=%d", $row['id_orden']);
            //            log_functions('Query tabla recurrentes', $sql, __FUNCTION__);
            //            $membresia_result = $wpdb->get_results($sql, ARRAY_A);
            //            log_functions('Resultado tabla recurrentes', json_encode($membresia_result, JSON_PRETTY_PRINT), __FUNCTION__);
            log_functions('Orden pagada', $order->is_paid(), __FUNCTION__);
            if ($order->is_paid()) {

                asocia_curso($row['id_producto'], $user->ID, $row['id_orden']);
                $frequency = get_post_meta($row['id_producto'], 'RADAR_RECURRENCE_FREQ', true);
                if (!empty($frequency)) {
                    $meses = get_membership_frequency($row['id_producto']);
                    log_functions('Encuentra datos de membresia regalada', '', __FUNCTION__);
                    asocia_membresia_regalo($user->ID, $row, $order->get_user_id(), $meses);
                }
                $wpdb->update($table_name, array('asociado' => 1, 'id_usuario_asociado' => $user->ID), array('id' => $row['id']));
            }
        }
    }
    //    }
}

function log_functions($debug_desc, $message, $function)
{
    $logger = wc_get_logger();
    $context = array('source' => 'radar_' . $function);
    $logger->info($debug_desc . ': ' . $message, $context);
}

function asocia_curso($id_producto, $id_usuario, $order_id = false)
{
    $mis_cursos = get_field('mis_cursos', 'user_' . $id_usuario);
    $datos = array(
        'curso' => $id_producto,
        'porcentaje_del_curso' => 0,
        'estado' => 'regalado',
        'fecha_compra' => date('d/m/Y'),
        'orden_de_compra' => $order_id
    );
    foreach ($mis_cursos as $curso) {
        if ($curso['curso'] == $id_producto) {
            $existe = true;
            break;
        }
    }
    if (!$existe) {
        add_row('mis_cursos', $datos, 'user_' . $id_usuario);
    }
}

function valida_orden_regalo($id_orden)
{
    global $wpdb;
    $sql = $wpdb->prepare("SELECT * FROM {$wpdb->prefix}regalos_queue WHERE id_orden=%d AND pagado=1 AND enviado=1", $id_orden);
    $results = $wpdb->get_results($sql, ARRAY_A);
    $cursos_regalados = array();
    if ($results) {
        foreach ($results as $row) {
            $cursos_regalados[] = $row['id_producto'];
        }
    }
    return $cursos_regalados;
}

function trae_curso_regalado($id_producto, $email)
{
    global $wpdb;
    $sql = $wpdb->prepare("SELECT * FROM {$wpdb->prefix}regalos_queue WHERE correo_destinatario=%s AND id_producto=%d AND pagado=1", $email, $id_producto);
    $results = $wpdb->get_results($sql, ARRAY_A);

    return $results;
}

function dorzki_wc_track_product_views()
{
    if (is_active_widget(false, false, 'woocommerce_recently_viewed_products', true)) {
        return;
    }
    global $post;
    if (empty($_COOKIE['woocommerce_recently_viewed'])) {
        $viewed_products = array();
    } else {
        $viewed_products = wp_parse_id_list((array) explode('|', wp_unslash($_COOKIE['woocommerce_recently_viewed'])));
    }
    $keys = array_flip($viewed_products);
    if (isset($keys[$post->ID])) {
        unset($viewed_products[$keys[$post->ID]]);
    }

    $terms = get_the_terms($post->ID, 'product_cat');
    if ($terms) {
        foreach ($terms as $t) {
            if ($t->term_id != 24) {
                $viewed_products[] = $post->ID;
                break;
            }
        }
    }

    if (count($viewed_products) > 5) {
        array_shift($viewed_products);
    }

    wc_setcookie('woocommerce_recently_viewed', implode('|', $viewed_products));
}

add_action('template_redirect', 'dorzki_wc_track_product_views', 20);

add_action('wp_ajax_recientesVistos', 'recientesVistos');
add_action('wp_ajax_nopriv_recientesVistos', 'recientesVistos');

function recientesVistos()
{

    if (empty($_COOKIE['woocommerce_recently_viewed'])) {
        die();
    }
    $id_carrito = array();
    if (WC()->cart->get_cart()) {

        foreach (WC()->cart->get_cart() as $cart_item_key => $cart_item) {

            $id_carrito[] = $cart_item['product_id'];
        }
    }


    $viewed_products = wp_parse_id_list((array) explode('|', wp_unslash($_COOKIE['woocommerce_recently_viewed'])));
    if (count($id_carrito) > 0) {
        $muestreo = array_diff($viewed_products, $id_carrito);
    }

    $cursos = get_field('mis_cursos', 'user_' . wp_get_current_user()->ID);
    $misCursos = array();
    if ($cursos) {
        foreach ($cursos as $c) {
            $id_product = $c['curso'];
            $cats = get_the_terms($id_product, 'product_cat');
            foreach ($cats as $cat) {
                if ($cat->term_taxonomy_id != 24) {
                    $misCursos[] = $id_product;
                }
            }
        }
    }

    $listadoFinal = array_diff($muestreo, $misCursos);

    $args = array(
        'post_type' => 'product',
        'orderby' => 'date',
        'order' => 'ASC',
        'post__in' => $listadoFinal,
        'posts_per_page' => 1
    );

    $the_query = new WP_Query($args);

    $i = 0;
    echo '<div class="woocommerce recientes">';
    // woocommerce_product_loop_start();
    ?>
    <p><strong>Medios de pago</strong></p>
    <img class="medio_de_pago mb-3" src="<?php echo get_bloginfo('template_directory'); ?>/assets/img/medio_pago.png" alt="">
    <p><strong>¡No dejes pasar esta oportunidad!</strong></p>
    <?php
    echo '<ul class="products columns-1">';
    if ($the_query->have_posts()) {

        echo '<div class="listado_recientes_carrito">';
        while ($the_query->have_posts()) {
            $the_query->the_post();
            do_action('woocommerce_shop_loop');


            wc_get_template_part('content', 'product');
            $i++;
        }
        echo '</div>';
    }
    // woocommerce_product_loop_end();
    echo '</ul></div>';

    /* Restore original Post Data */
    wp_reset_postdata();
    die();
}




add_action('wp_ajax_recientesVistosCarroVacio', 'recientesVistosCarroVacio');
add_action('wp_ajax_nopriv_recientesVistosCarroVacio', 'recientesVistosCarroVacio');

function recientesVistosCarroVacio()
{
    if (empty($_COOKIE['woocommerce_recently_viewed'])) {
        $args = array(
            'post_type' => 'product',
            'orderby' => 'date',
            'order' => 'ASC',
            'order_by' => 'rand',
            'posts_per_page' => 2,
            'tax_query'            => array(
                array(
                    'taxonomy' => 'product_cat',
                    'field'    => 'id', // Or 'name' or 'term_id'
                    'terms'    => array(24),
                    'operator' => 'NOT IN', // Excluded
                )
            )
        );

        $the_query = new WP_Query($args);

        $i = 0;
        echo '<div class="woocommerce recientes">';

    ?>

        <h2><strong>¡Aún no tienes cursos agregados a tu carrito!</strong></h2>
        <p>Acá te mostramos algunos que te podrían interesar</p>
        <?php
        echo '<ul class="products columns-1">';
        if ($the_query->have_posts()) {

            echo '<div class="">';
            while ($the_query->have_posts()) {
                $the_query->the_post();
                do_action('woocommerce_shop_loop');


                wc_get_template_part('content', 'product');
                $i++;
            }
            echo '</div>';
        }

        echo '</ul></div>';

        wp_reset_postdata();
        die();
    } else {
        $viewed_products = wp_parse_id_list((array) explode('|', wp_unslash($_COOKIE['woocommerce_recently_viewed'])));
        $args = array(
            'post_type' => 'product',
            'orderby' => 'date',
            'order' => 'ASC',
            'post__in' => $viewed_products,
            'posts_per_page' => 2
        );

        $the_query = new WP_Query($args);

        $i = 0;
        echo '<div class="woocommerce recientes">';

        ?>

        <h2><strong>¡Aún no tienes cursos agregados a tu carrito!</strong></h2>
        <p>Acá te mostramos algunos que te podrían interesar</p>
    <?php
        echo '<ul class="products columns-1">';
        if ($the_query->have_posts()) {

            echo '<div class="">';
            while ($the_query->have_posts()) {
                $the_query->the_post();
                do_action('woocommerce_shop_loop');


                wc_get_template_part('content', 'product');
                $i++;
            }
            echo '</div>';
        }

        echo '</ul></div>';

        wp_reset_postdata();
        die();
    }
}




/**
 * Agrega fields en checkout si es que se elige un plan de + de 1 miembro
 **/

function agrega_emails_compra_membresia($checkout_fields)
{
    $carro = WC()->cart->get_cart();
    $multi = 1;
    foreach ($carro as $item) {
        if (is_a($item['data'], 'WC_Product_Variation')) {
            $personas = $item['data']->get_attributes();
            $multi = $personas['pa_personas'];
        }
    }
    for ($cantidad = 2; $cantidad <= $multi; $cantidad++) {
        $checkout_fields['billing']['billing_email' . $cantidad] = array(
            'type' => 'email',
            'label' => 'Correo membresia ' . $cantidad,
            'required' => true,
            'placeholder' => 'membresia' . $cantidad . '@isilgo.com'
        );
    }
    return $checkout_fields;
}

add_action('woocommerce_checkout_fields', 'agrega_emails_compra_membresia', 99);

add_action('woocommerce_checkout_order_created', 'save_membresia_multiple');
function save_membresia_multiple($order)
{
    if (get_post_meta($order->get_id(), '_billing_email2', true)) {
        global $wpdb;
        $table_name = $wpdb->prefix . 'membresias_multiples';
        $items = $order->get_items();
        $product = reset($items);
        for ($email_lines = 2; $email_lines < 5; $email_lines++) {
            $email = get_post_meta($order->get_id(), '_billing_email' . $email_lines, true);
            if (!empty($email)) {
                $wpdb->insert(
                    $table_name,
                    array(
                        'id_producto'         => $product['product_id'],
                        'correo_suscripcion' => $email,
                        'id_orden'            => $order->get_id(),
                        'id_suscriptor' => $order->get_customer_id(),
                        'pagado' => 0
                    )
                );
            }
        }
    }
}

add_action('woocommerce_order_status_changed', 'completa_membresia_multiple', 99, 3);
//add_action( 'woocommerce_payment_complete_order_status_completed', 'completa_regalo' );

function completa_membresia_multiple($order_id, $old_status, $new_status)
{

    if ($new_status == 'completed' || $new_status == 'processing') {

        global $wpdb;

        $table_name = $wpdb->prefix . 'membresias_multiples';

        $sql = $wpdb->prepare("SELECT * FROM {$table_name} WHERE id_orden=%d", $order_id);

        $results = $wpdb->get_results($sql, ARRAY_A);
        if ($results) {
            $row = $results[0];
            if ($row['pagado'] == 0) {
                envia_correo_regalo($row);
                $wpdb->update($table_name, array('pagado' => 1), array('id_orden' => $order_id));
            }
        }
    }
}

add_action('wp_login', 'asocia_membresia', 90, 2);

function asocia_membresia($user_login, $user)
{

    if (!current_user_can('manage_options') && !tieneMembresia()) {
        global $wpdb;
        $table_name = $wpdb->prefix . 'membresias_multiples';

        $sql = $wpdb->prepare("SELECT * FROM {$table_name} WHERE correo_suscripcion=%s AND pagado=1 AND asociado=0 AND id_usuario_asociado IS NULL ORDER BY id DESC LIMIT 1", $user->user_email);


        $results = $wpdb->get_results($sql, ARRAY_A);
        if ($results) {
            $row = $results[0];
            $fecha_suscripcion = get_field('fecha_suscripcion', 'user_' . $row['id_suscriptor'], true);
            $fecha_expiracion = get_field('fecha_expiracion', 'user_' . $row['id_suscriptor'], true);
            $id_membresia = get_field('id_membresia', 'user_' . $row['id_suscriptor'], true);
            $orden_de_compra = get_field('orden_de_compra', 'user_' . $row['id_suscriptor'], true);
            $id_afiliacion = get_field('id_afiliacion', 'user_' . $row['id_suscriptor'], true);

            update_field('fecha_suscripcion', $fecha_suscripcion, 'user_' . $user->ID);
            update_field('fecha_expiracion', $fecha_expiracion, 'user_' . $user->ID);
            update_field('id_membresia', $id_membresia, 'user_' . $user->ID);
            update_field('orden_de_compra', $orden_de_compra, 'user_' . $user->ID);
            update_field('membresia', true, 'user_' . $user->ID);
            update_field('id_afiliacion', $id_afiliacion, 'user_' . $user->ID);

            $documento_pagador = get_beneficiary_id($orden_de_compra);
            update_field('nro_documento', $documento_pagador, 'user_' . $user->ID);
            update_field('membresia_multiple', true, 'user_' . $user->ID);
            $wpdb->update($table_name, array('asociado' => 1, 'id_usuario_asociado' =>  $user->ID), array('id' => $row['id']));
        }
    }
}
function asocia_membresia_regalo($user_id, $row, $pagador_id, $frequency)
{

    if (!current_user_can('manage_options') && !tieneMembresia()) {
        $from = date('Y-m-d');
        update_field('fecha_suscripcion', date('Y-m-d'), 'user_' . $user_id);
        update_field('fecha_expiracion', date('Y-m-d', strtotime($from . ' +' . $frequency . ' months')), 'user_' . $user_id);
        update_field('id_membresia', $row['id_producto'], 'user_' . $user_id);
        update_field('orden_de_compra', $row['id_orden'], 'user_' . $user_id);
        //        update_field('membresia', true, 'user_' . $user_id);

        $documento_pagador = get_beneficiary_id($row['id_orden']);
        update_field('nro_documento', $documento_pagador, 'user_' . $user_id);
        //        if (!class_exists('WC_Radar_Niubiz')) {
        //            radar_niubiz_init();
        //        }
        //        $radar_niubiz = new WC_Radar_Niubiz();
        //        $affiliationId = $radar_niubiz->getCurrentSubscriptionId($recurrence_data['transactionDate'], $documento_pagador);
        //        if ($affiliationId) {
        //            update_field('id_afiliacion', $affiliationId, 'user_' . $user_id);
        //        }
    }
}

/* Cambia Billing Details por Datos de Facturación*/
add_filter('gettext', 'wc_billing_field_strings', 20, 3);

function wc_billing_field_strings($translated_text, $text, $domain)
{
    if (!is_admin() && $domain === 'woocommerce' && $translated_text === 'Billing Details') {
        $translated_text = 'Datos de Facturación';
    }
    return $translated_text;
}


/* Cambia "Facturación y envío" por "Detalles de Facturación"*/
add_filter('gettext', 'wc_detalles_facturacion', 20, 3);

function wc_detalles_facturacion($translated_text, $text, $domain)
{
    if (!is_admin() && $domain === 'woocommerce' && $translated_text === 'Facturación y envío') {
        $translated_text = 'Detalles de Facturación';
    }
    return $translated_text;
}


/* Cambia "Product remove Successfully" por "Se ha quitado el curso del Carro de Compras"*/
add_filter('gettext', 'wc_product_remove_ok', 20, 3);

function wc_product_remove_ok($translated_text, $text, $domain)
{
    if (!is_admin() && $domain === 'whmc' && $translated_text === 'Product remove Successfully') {
        $translated_text = 'Se ha quitado el curso del Carro de Compras';
    }
    return $translated_text;
}


/* Cambia "S/0.00" por "GRATIS"*/
function replace_price_with_gratis($price)
{
    //if (is_product()) {
    $price = str_replace('<span class="woocommerce-Price-currencySymbol">S/</span>0.00', 'GRATIS', $price);
    //}
    return $price;
}

add_filter('woocommerce_get_price_html', 'replace_price_with_gratis');


function cursosGratisHome()
{
    $args = array(
        'posts_per_page' => 2,
        'post_type' => 'product',
        'post_status' => 'publish',
        'ignore_sticky_posts' => 1,
        'order' => 'DESC',
        'tax_query'            => array(
            array(
                'taxonomy' => 'product_tag',
                'field'    => 'id', // Or 'name' or 'term_id'
                'terms'    => array(56),
                // 'operator' => 'NOT IN',
            )
        )
    );
    $query = new WP_Query($args);
    ?>
    <div class="col-md-12">
        <div class="woocommerce cursos_gratis_mobile_home">
            <ul class="products woocommerce columns-1 owl-carousel especiales_membresias">
                <?php

                if ($query->have_posts()) {
                    while ($query->have_posts()) {
                        $query->the_post();
                        do_action('woocommerce_shop_loop');
                        wc_get_template_part('content', 'product');
                    }
                }
                wp_reset_postdata();
                ?>

            </ul>
        </div>


        <div class="woocommerce cursos_gratis_desktop_home">
            <ul class="products woocommerce columns-2 cursos_gratis_desktop_home_carrusel owl-carousel">
                <?php

                if ($query->have_posts()) {
                    while ($query->have_posts()) {
                        $query->the_post();
                        do_action('woocommerce_shop_loop');
                        wc_get_template_part('content', 'product');
                    }
                }

                ?>

            </ul>
            <?php wp_reset_postdata(); ?>
        </div>
    </div>
<?php }

add_shortcode('cursosGratisHome', 'cursosGratisHome');


function masVendidosHome()
{
    $args = array(
        'posts_per_page' => 4,
        'post_type' => 'product',
        'post_status' => 'publish',
        'ignore_sticky_posts' => 1,
        'meta_key' => 'total_sales',
        'orderby' => 'meta_value_num',
        'order' => 'DESC',
        'tax_query'            => array(
            array(
                'taxonomy' => 'product_cat',
                'field'    => 'id', // Or 'name' or 'term_id'
                'terms'    => array(24),
                'operator' => 'NOT IN', // Excluded
            )
        )
    );
    $query = new WP_Query($args);
?>

    <div class="woocommerce esconde_mobile">
        <ul class="products woocommerce columns-1 owl-carousel especiales_membresias">
            <?php

            if ($query->have_posts()) {
                while ($query->have_posts()) {
                    $query->the_post();
                    do_action('woocommerce_shop_loop');
                    wc_get_template_part('content', 'product');
                }
            }
            wp_reset_postdata();
            ?>

        </ul>
    </div>

    <div class="woocommerce esconde_desktop">
        <ul class="products woocommerce columns-4">
            <?php

            if ($query->have_posts()) {
                while ($query->have_posts()) {
                    $query->the_post();
                    do_action('woocommerce_shop_loop');
                    wc_get_template_part('content', 'product');
                }
            }
            wp_reset_postdata();
            ?>

        </ul>
    </div>
    <?php }

add_shortcode('masVendidosHome', 'masVendidosHome');

function productosEtiqueta($atts)
{
    ob_start();
    $atributos = shortcode_atts(['product_tag' => 'cursos-mas-vendidos',], $atts);

    $args = array(
        'number' => 12,
        'product_tag' => array($atributos['product_tag']),
        'orderby' => 'rand'
    );
    $loop = new WP_Query($args);
    $product_count = $loop->post_count;

    if ($product_count > 0) {
        echo '<div class="woocommerce productosEtiqueta">';
        echo '<ul class="owl-carousel products productosEtiquetas">';
        while ($loop->have_posts()) : $loop->the_post();
            do_action('woocommerce_shop_loop');
            wc_get_template_part('content', 'product');
        endwhile;
        echo '</ul>';
        echo '</div>';
    }

    $result =  ob_get_clean();
    echo $result;
}
add_shortcode('productosEtiqueta', 'productosEtiqueta');

function productosRecomendados()
{
    if (is_user_logged_in()) {
    ?>
        <h5 style="text-align: center; color: #2e4259;" class="mb-5"><strong>Cursos <span style="color: #3377ff;">recomendados para ti</span></strong></h5>
        <?php
        $id = wp_get_current_user()->ID;
        $categorias = array();

        $interes_1 = get_term_by('name', get_field('interes_1_isil', 'user_' . $id), 'product_cat');
        if ($interes_1) {
            array_push($categorias, $interes_1->term_id);
        }
        $interes_2 = get_term_by('name', get_field('interes_2_isil', 'user_' . $id), 'product_cat');
        if ($interes_2) {
            array_push($categorias, $interes_2->term_id);
        }
        $interes_3 = get_term_by('name', get_field('interes_3_isil', 'user_' . $id), 'product_cat');
        if ($interes_3) {
            array_push($categorias, $interes_3->term_id);
        }
        $interes_4 = get_term_by('name', get_field('interes_4_isil', 'user_' . $id), 'product_cat');
        if ($interes_4) {
            array_push($categorias, $interes_4->term_id);
        }
        if (count($categorias) > 0) {
            $args = array(
                'number' => 12,
                'orderby' => 'rand',
                'tax_query' => array(
                    'relation' => 'AND',
                    array(
                        'taxonomy'  => 'product_cat',
                        'field'     => 'id',
                        'terms'     => $categorias
                    ),
                    array(
                        'taxonomy' => 'product_cat',
                        'field'    => 'id', // Or 'name' or 'term_id'
                        'terms'    => array(24),
                        'operator' => 'NOT IN', // Excluded
                    )
                )

            );
            $loop = new WP_Query($args);
            $product_count = $loop->post_count;

            if ($product_count > 0) { ?>
                <div class="woocommerce">
                    <ul class="owl-carousel products productosRecomendados">
                        <?php
                        if ($loop->have_posts()) {
                            while ($loop->have_posts()) {
                                $loop->the_post();
                                do_action('woocommerce_shop_loop');
                                wc_get_template_part('content', 'product');
                            }
                        }
                        wp_reset_postdata();
                        ?>
                    </ul>
                </div>
        <?php }
        } ?>
        <div style="text-align: center;"><a class="btn btn-primary" style="background-color: #00bcff; border: #00BCFF;" title="Ver todos los cursos" href="/cursos/">VER TODOS LOS CURSOS</a></div>
    <?php
    } else {
    ?>
        <h5 style="text-align: center; color: #2e4259;" class="mb-5"><strong>Cursos <span style="color: #3377ff;">recomendados</span></strong></h5>
        <?php

        $args = array(
            'post_type' => 'product',
            'posts_per_page' => 12,
            'post_status' => 'publish',
            'order' => 'DESC',
            'orderby' => 'rand',
        );
        $loop = new WP_Query($args);
        $product_count = $loop->post_count;

        if ($product_count > 0) { ?>
            <div class="woocommerce">
                <ul class="owl-carousel products productosRecomendados">
                    <?php
                    if ($loop->have_posts()) {
                        while ($loop->have_posts()) {
                            $loop->the_post();
                            do_action('woocommerce_shop_loop');
                            wc_get_template_part('content', 'product');
                        }
                    }
                    wp_reset_postdata();
                    ?>
                </ul>
            </div>
        <?php } ?>
        <div style="text-align: center;"><a class="btn btn-primary" style="background-color: #00bcff; border: #00BCFF;" title="Ver todos los cursos" href="/cursos/">VER TODOS LOS CURSOS</a></div>

    <?php }
}
add_shortcode('productosRecomendados', 'productosRecomendados');


function vuelvetePremium()
{ ?>
    <div class="decide_membresia">

        <p>
            <img src="/wp-content/uploads/2023/09/Vector-4.png" alt="" />
        </p>
        <p>¿Aún no te decides? <br><strong>Vuélvete premium</strong></p>
        <p>
            <a href="#membresias_ancla"><img src="/wp-content/uploads/2023/09/Group-645.png" alt="" /></a>
        </p>
    </div>
<?php }

add_shortcode('vuelvetePremium', 'vuelvetePremium');


function provincia_requerida($campos)
{
    foreach ($campos as $index => $atributos) {
        if (isset($atributos['state'])) {
            $campos[$index]['state']['required'] = true;
            if (isset($campos[$index]['state']['hidden'])) {
                unset($campos[$index]['state']['hidden']);
            }
        }
    }
    return $campos;
}

add_filter('woocommerce_get_country_locale', 'provincia_requerida', 99);




/**
 * Change default gravatar.
 */

add_filter('avatar_defaults', 'new_gravatar');
function new_gravatar($avatar_defaults)
{
    $myavatar = get_bloginfo('template_directory') . '/assets/img/avatar.jpg';
    $avatar_defaults[$myavatar] = "Default Gravatar";
    return $avatar_defaults;
}


add_filter('woocommerce_get_catalog_ordering_args', 'custom_woocommerce_get_catalog_ordering_args');

function custom_woocommerce_get_catalog_ordering_args($args)
{
    $orderby_value = isset($_GET['orderby']) ? woocommerce_clean($_GET['orderby']) : apply_filters('woocommerce_default_catalog_orderby', get_option('woocommerce_default_catalog_orderby'));

    if ('nombre-ASC' == $orderby_value) {
        $args['orderby'] = 'title';
        $args['order'] = 'ASC';
    }
    if ('nombre-DESC' == $orderby_value) {
        $args['orderby'] = 'title';
        $args['order'] = 'DESC';
    }

    return $args;
}

add_filter('woocommerce_default_catalog_orderby_options', 'custom_woocommerce_catalog_orderby');
add_filter('woocommerce_catalog_orderby', 'custom_woocommerce_catalog_orderby');

function custom_woocommerce_catalog_orderby($sortby)
{
    $sortby['nombre-ASC'] = __('De la A a la Z');
    $sortby['nombre-DESC'] = __('De la Z a la A');
    return $sortby;
}


add_filter('woocommerce_catalog_orderby', 'bbloomer_remove_sorting_option_woocommerce_shop');

function bbloomer_remove_sorting_option_woocommerce_shop($options)
{
    unset($options['rating']);
    unset($options['date']);
    return $options;
}


add_filter('woocommerce_catalog_orderby', 'bbloomer_rename_sorting_option_woocommerce_shop');

function bbloomer_rename_sorting_option_woocommerce_shop($options)
{
    $options['popularity'] = 'Recomendados';
    $options['price'] = 'Mayor a menor precio';
    $options['price-desc'] = 'Menor a mayor precio';
    return $options;
}

function testimonio_empresas()

{ ?>
    <h5 class="py-5" style="text-align: center; color: #2e4259;"><strong><span style="color: #2e4259;">Testimonios</span><span style="color: #3377ff;"> Empresas</span></strong></h5>
    <ul class="testimonio_empresas owl-carousel">
        <?php

        $testimonios = get_field('testimonios');

        if ($testimonios) {
            foreach ($testimonios as $testimonio) { ?>
                <li class="item_activo">
                    <div class="img_nombre_testimonio">

                        <img src="<?php echo $testimonio['imagen']; ?>" alt="Fotografia Testimonio">
                        <div>
                            <?php echo $testimonio['nombre_cargo']; ?>
                        </div>
                    </div>
                    <div class="col-12">


                        <?php echo $testimonio['texto']; ?>
                    </div>
                    <div class="col-12 text-right logo_isilgo_owl">
                        <img src="<?php echo get_bloginfo('template_directory'); ?>/assets/img/logo_isil_chico.png" alt="Logo IsilGO">
                    </div>
                </li>
        <?php }
        }
        ?>
    </ul>
<?php }


add_shortcode('testimonio_empresas', 'testimonio_empresas');




add_action('wp_ajax_dictadoPor', 'dictadoPor');
add_action('wp_ajax_nopriv_dictadoPor', 'dictadoPor');

function dictadoPor()
{
    $itemid = $_POST['itemid'];

    echo '<span>' . $itemid . '</span>';

    die();
}

function disable_browser_cache() {
    header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
    header("Cache-Control: post-check=0, pre-check=0", false);
    header("Pragma: no-cache");
}

add_action('init', 'disable_browser_cache');

