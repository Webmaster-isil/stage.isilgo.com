<?php get_header(); 
$cabezal = get_field('cabezales');

if ($cabezal) { ?>
    <div>
        <img class="w-100" src="<?php echo $cabezal ?>" alt="">
    </div>
<?php }
?>

<div class="container">
    <div class="row">
        <div class="col-12 mt-3">
            <?php echo get_template_part('./woocommerce/global/breadcrumb'); ?>
        </div>
    </div>

    <?php if (is_checkout() && !is_user_logged_in()) { ?>
        <div class="row">
            <div class="col-12 mb-3 text-center">
                <div class="login_sso">

                    <h3>Para poder pagar <span>debes estar logueado</span></h3>
                    <?php
                    echo dynamic_sidebar('sso_widget');

                    ?>
                </div>

            </div>
        </div>
    <?php } ?>
    <div class="row">

        <?php the_content(); ?>
    </div>
</div>

<?php get_footer(); ?>