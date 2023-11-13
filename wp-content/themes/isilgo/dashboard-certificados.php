<h3 class="mi_membresia">Mis <span>certificados</span></h3>
<?php

$cursos = get_field('mis_cursos', 'user_' . wp_get_current_user()->ID);
$cursos_completos = false;

if ($cursos) { ?>
    <ul class="listado_certificados">
        <?php
        foreach ($cursos as $c) {
            $id_product = $c['curso'];
            $cats = get_the_terms($id_product, 'product_cat');
            foreach ($cats as $cat) {
                if ($cat->term_taxonomy_id != 24) {

                    if ($c['porcentaje_del_curso'] == 1) {
                        $cursos_completos = true; ?>
                        <li>
                            <h3><?php echo 'Certificado en <span>' . get_the_title($c['curso']) . '</span>'; ?></h3>
                            <div class="row mt-4 mb-3">
                                <div class="col-7 d-flex align-items-center">
                                    <ul class="compartir_rrss_certificados">
                                        <li>Compartir en: </li>
                                        <li><a href="#" target="_blank" data-codigoOperacionGrupo="<?php echo $c['certificado'] ?>" data-medio="facebook" class="busca_link"><img src="<?php echo get_bloginfo('template_directory'); ?>/assets/img/membresia_facebook.svg" alt=""></a></li>
                                        <li><a href="#" target="_blank" data-codigoOperacionGrupo="<?php echo $c['certificado'] ?>" data-medio="twitter" class="busca_link"><img src="<?php echo get_bloginfo('template_directory'); ?>/assets/img/membresia_twitter.svg" alt=""></a></li>
                                        <li><a href="#" target="_blank" data-codigoOperacionGrupo="<?php echo $c['certificado'] ?>" data-medio="linkedin" class="busca_link"><img src="<?php echo get_bloginfo('template_directory'); ?>/assets/img/membresia_linkedin.svg" alt=""></a></li>
                                        <li><a href="#" target="_blank" data-codigoOperacionGrupo="<?php echo $c['certificado'] ?>" data-medio="whatsapp" class="busca_link"><img src="<?php echo get_bloginfo('template_directory'); ?>/assets/img/membresia_whatsapp.svg" alt=""></a></li>
                                        <li><a href="#" target="_blank" data-codigoOperacionGrupo="<?php echo $c['certificado'] ?>" data-medio="enlace" class="busca_link"><img src="<?php echo get_bloginfo('template_directory'); ?>/assets/img/membresia_enlace.svg" alt=""></a></li>
                                        <li><span class="loaderCertificados"></span></li>
                                    </ul>
                                </div>
                                <div class="col-5 text-right centra_certificado">
                                    <a class='descargar_certificado' data-codigoOperacionGrupo="<?php echo $c['certificado'] ?>" href="#">Descargar certificado <span class="loaderCustom"></span></a>
                                </div>


                            </div>

                        </li>

        <?php }
                    break;
                }
            }
        } ?>

    </ul>
<?php }

if (!$cursos_completos) {
    echo '<p>Actualmente no posees certificados.</p>';
}
