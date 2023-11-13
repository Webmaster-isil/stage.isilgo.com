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
                            <div class="d-flex justify-content-end"><a class='descargar_certificado' data-codigoOperacionGrupo="<?php echo $c['certificado'] ?>" href="#">Descargar certificado <span class="loaderCustom"></span></a></div>

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
