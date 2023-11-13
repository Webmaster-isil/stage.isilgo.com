<?php get_header(); ?>

<div class="container">
    <div class="row">
        <?php $cabezal = get_field('cabezales'); ?>
        <div class="col-12 my-5 py-5 text-center">
            <img class="img_404" src="<?php echo get_field('imagen_404', 'options'); ?>" alt="Error 404">
            <p class="p_404"><?php echo get_field('texto_404', 'options'); ?></p>
            
            <div class="cursos_404 row">
                <?php
                $cursos_404 = get_field('cursos_404', 'options');

                if ($cursos_404) {
                    foreach ($cursos_404 as $curso) {
                        $nombre_del_curso = $curso['nombre_del_curso'];
                        $link_del_curso = $curso['link_del_curso'];
                        $color_de_fondo = $curso['color_de_fondo'];
                        ?>
                        <div class="cursos col-md-4">
                            <a href="<?php echo $link_del_curso ?>" style="background-color: <?php echo $color_de_fondo; ?>"><?php echo $nombre_del_curso; ?></a>
                        </div>
                        <?php
                    }
                }
                ?>
            </div>
        </div>
    </div>
</div>


<?php get_footer(); ?>