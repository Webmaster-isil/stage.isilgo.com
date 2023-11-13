<div class="video_imagen">
    <?php
    $video_youtube = get_field('video_youtube');
    $video_medios = get_field('video_medios');


    if ($video_youtube || $video_medios) {
        if ($video_medios) {
            $video = $video_medios;
        } else if ($video_youtube) {
            $video = $video_youtube;
        }

    ?>
        <div class="lateral shadow">
            <div class="imagen_video">
                <img class="destacada  w-100" src="<?php echo get_the_post_thumbnail_url(); ?>" alt="">
                <div class="play_video levanta_popup">
                    <img src="<?php echo get_bloginfo('template_directory'); ?>/assets/img/play.svg" alt="" class="">
                </div>
            </div>
            <div class="pop_video">
                <div class="cont_video">
                    <div class="display_video">
                        <?php
                        $args = array(
                            'src' => $video,
                            'width' => '640',
                            'height' => '360'
                        );
                        echo wp_video_shortcode($args);
                        ?>
                    </div>
                    <div class="cerrar_video">Volver</div>
                </div>
            </div>
        <?php } else { ?>
            <div class="lateral shadow">
                <div class="imagen_video">
                    <img class="destacada w-100" src="<?php echo get_the_post_thumbnail_url(); ?>" alt="">
                </div>
            <?php }
            ?>
            </div>
        </div>