<?php
// Template name: Page Regalo
get_header(); 
$cabezal = get_field('cabezales');

if ($cabezal) { ?>
    <div>
        <img class="w-100" src="<?php echo $cabezal ?>" alt="">
    </div>
<?php }
?>

<div class="container">
    <div class="row">
        <div class="col-md-8 mx-auto text-center">
            <?php
            //var_dump($form);
            $idProducto = $_POST['idRegalo'];
            if ($idProducto && isset($idProducto)) {
	            $form = do_shortcode('[contact-form-7 id="4067288" title="Regalo" html_class="contenedor_regalo"]');
                echo str_replace('{{prodval}}', $idProducto, $form);
            } else { ?>
                <h1>No has seleccionado un curso para regalo.</h1>
                <a href="/cursos" class="my-5 btn btn-primary
                px-5 ">Ver todos los cursos</a>
            <?php }

            ?>

        </div>
    </div>
</div>
<script>
    document.addEventListener( 'wpcf7mailsent', function( event ) {
        location = '<?php echo wc_get_checkout_url() ?>';
    }, false );
</script>
<?php get_footer(); ?>