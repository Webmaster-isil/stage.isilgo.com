<?php $carrusel = get_field('carrusel'); ?>
<div id="carouselExampleIndicators" class="carousel slide" data-bs-ride="carousel">
    <div class="carousel-indicators">
        <?php
        if ($carrusel) {
            foreach ($carrusel as $key => $car) {
                if ($key == 0) { ?>
                    <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="<?php echo $key; ?>" class="active" aria-current="true" aria-label="Slide-<?php echo $key; ?>"></button>

                <?php } else { ?>
                    <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="<?php echo $key; ?>" aria-label="Slide-<?php echo $key; ?>"></button>
        <?php }
            }
        }; ?>
    </div>
    <div class="carousel-inner">
        <?php

        if ($carrusel) {
            foreach ($carrusel as $key => $c) {
                if ($key == 0) { ?>
                    <div class="carousel-item active">
                        <img class="carrusel_mobile" src="<?php echo $c['imagen_mobile']; ?>" class="w-100" alt="Carrusel IsilGo">
                        <img class="carrusel_desktop" src="<?php echo $c['imagen_desktop']; ?>" class="w-100" alt="Carrusel IsilGo">
                    </div>
                <?php } else { ?>
                    <div class="carousel-item">
                        <img class="carrusel_mobile" src="<?php echo $c['imagen_mobile']; ?>" class="w-100" alt="Carrusel IsilGo">
                        <img class="carrusel_desktop" src="<?php echo $c['imagen_desktop']; ?>" class="w-100" alt="Carrusel IsilGo">
                    </div>
        <?php }
            }
        } ?>



    </div>
    <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Anterior</span>
    </button>
    <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Siguiente</span>
    </button>
</div>