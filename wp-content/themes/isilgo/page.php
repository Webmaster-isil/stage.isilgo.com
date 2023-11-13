<?php get_header();
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