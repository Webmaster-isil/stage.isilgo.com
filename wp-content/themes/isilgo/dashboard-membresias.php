<h3 class="mi_membresia">Mi <span>membresia</span></h3>

<div class="col-12">
    <?php
    global $estadoMembresia;

    if ($estadoMembresia) {
        $cliente = wp_get_current_user();
        $idProducto = get_field( 'id_membresia', 'user_' . $cliente->ID );
        $fecha_expiracion = get_field( 'fecha_expiracion', 'user_' . $cliente->ID );
	    $recurrencia_activa = get_field('membresia', 'user_' . $cliente->ID);
        $multiple = get_field('membresia_multiple', 'user_' . $cliente->ID);
        $product = wc_get_product($idProducto);

    ?>
        <div class="membresia_dash">
            <img class="detalleMembresia" src="<?php echo get_bloginfo('template_directory'); ?>/assets/img/detalleMembresia.svg" alt="">
            <h3><?php echo get_the_title($idProducto); ?></h3>
            <div class="price_myAccount">
                <?php echo $product->get_price_html(); ?>
            </div>
            <div class="listado_caracteristicas">

                <?php $detalles = get_field('detalles', $product->get_ID());
                if ($detalles) {
                    echo '
                    <p><strong>Este plan te da acceso a:</strong></p>
                    <ul>';
                    foreach ($detalles as $detalle) {
                        if ($detalle['valida'] == 1) {
                            echo '<li><img src="' . get_bloginfo('template_directory') . '/assets/img/ok.svg">' . $detalle['detalle'] . '</li>';
                        }
                    }
                    echo '</ul>';
                } ?>
            </div>
        </div>
        <?php if($recurrencia_activa && !$multiple){?>
                <form id="valida_desuscripcion">
                    <input type="hidden" value="<?php echo wp_create_nonce('user_unsuscribe') ?>" name="hash"/>
                    <input type="hidden" value="<?php echo md5($cliente->ID) ?>" name="input"/>
                </form>
        <p class="vencimiento">Fecha de renovación / <span><?php echo date('d/m/Y', strtotime($fecha_expiracion)); ?><span> (ESTADO ACTIVO)</span></span> </p>
        <p class="anular_suscripcion">¿Quieres <span>desactivar</span> el cobro automático de tu suscripción?</p>

            <label class="switch" for="checkbox">
                <input type="checkbox" id="checkbox" class="check_suscripcion" checked />
                <div class="slider round"></div>

                <div class="pop_alerta_membresia_inactiva">
                    <div class="centra">
                        <div class="contenido_pop_alerta shadow">
                            <div class="col-md-8 mx-auto">
                                <div class="row align-items-center justify-content-center">
                                    <div class="col-12">

                                        <h3>¡ESTÁS DESACTIVANDO <span>TU COBRO AUTOMÁTICO!</span></h3>
                                    </div>
                                    <div class="col-md-2">
                                        <img class="w-100" src="<?php echo get_bloginfo('template_directory'); ?>/assets/img/warning.svg" alt="">
                                    </div>
                                    <div class="col-md-10 mx-auto txt">

                                        <p>Al continuar estarás desactivando el cobro automático de la renovación de tu membresía.Tu membresía seguirá vigente hasta la fecha de vencimiento de la membresía comprada.</p>

                                    </div>
                                    <div class="col-12" id="botones-confirmacion-des">
                                        <a class="cancelar_desuscripcion" href="#">CANCELAR</a>
                                        <a class="confirmar_desuscripcion" href="#">CONFIRMAR</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </label>
            <p class="alert-danger" id="no-desuscripcion"></p>
<?php } else { ?>
            <p class="vencimiento">Fecha de <?php echo ($multiple && $recurrencia_activa? 'renovación': 'vencimiento')?> / <span><?php echo date('d/m/Y', strtotime($fecha_expiracion)); ?></span> </p>
            <?php
        } ?>
    <?php } else {
    ?>
        <p>Actualmente no posees una membresía</p>
        <a class="bnt_naranjo" href="/membresias">VUÉLVETE PREMIUM</a>
    <?php
    }
    ?>
</div>