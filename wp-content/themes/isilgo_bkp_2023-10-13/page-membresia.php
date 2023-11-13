<?php
// Template name: Membresías
get_header('shop');
$cabezal = get_field('cabezales');
if ($cabezal) { ?>
    <div>
        <img class="w-100" src="<?php echo $cabezal ?>" alt="">
    </div>
<?php }
?>
<div class="container">
    <div class="row">
        <?php echo get_template_part('./woocommerce/global/breadcrumb'); ?>
    </div>
</div>
<div class="container">
    <div class="row col-md-12">
        <div class="col-md-6 membresias-texto-sup">
            <h3>¿Por qué elegir nuestras membresías?</h3>
            <p>Potencia tu talento sin límites, con los diversos planes que tenemos para tí:</p>
        </div>

    </div>
</div>



<div class="container woocommerce membresias">
    <?php
    $args = array(
        'post_type'        => 'product',
        'orderby' => 'date',
        'order' => 'ASC',
        'posts_per_page' => 4,
        'tax_query'        => array(
            array(
                'taxonomy'    => 'product_cat',
                'field'        => 'slug',
                'terms'        => 'suscripciones'
            )
        ),

    );

    $the_query = new WP_Query($args);

    $i = 0;
    woocommerce_product_loop_start();
    if ($the_query->have_posts()) {

        while ($the_query->have_posts()) {
            $the_query->the_post();
            do_action('woocommerce_shop_loop'); ?>


            <?php wc_get_template_part('content', 'product');
            $i++; ?>

    <?php }
    }
    woocommerce_product_loop_end();

    /* Restore original Post Data */
    wp_reset_postdata();


    ?>
</div>
<div class="container">
    <?php the_content(); ?>
</div>

<?php


get_footer('shop'); ?>