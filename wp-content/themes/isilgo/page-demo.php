<?php //template name: demo

// ini_set('display_errors', 1);
// ini_set('display_startup_errors', 1);
// error_reporting(E_ALL);



get_header();
?>
<div class="container bg-gray">
    <div class="row">
        <div class="col-12">
            <ul class="testimonio_empresas owl-carousel">
                <?php
                $a = 0;
                while ($a <= 3) {
                ?>
                    <li class="item_activo">
                        <div class="img_nombre_testimonio">
                            <img src="https://stage.isilgo.com/wp-content/uploads/2023/08/Empresa-testimonio-persona-1.png" alt="">
                            <div>
                                <p><strong>Katia Gonzalez</strong></p>
                                <p>Cargo</p>
                            </div>
                        </div>
                        <div class="col-12">


                            <p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit.
                                Aenean commodo ligula eget dolor. Aenean massa.
                                Cum sociis natoque penatibus et magnis dis parturient
                                montes, nascetur ridiculus mus. Donec quam felis, ultricies
                                nec, pellentesque eu, pretium quis, sem. Nulla consequat
                                massa quis enim.</p>
                        </div>
                        <div class="col-12 text-right logo_isilgo_owl">
                            <img src="https://stage.isilgo.com/wp-content/uploads/2023/08/Frame-2.png" alt="">
                        </div>
                    </li>


                <?php
                    $a++;
                } ?>
            </ul>
        </div>
    </div>
</div>

<?php get_footer(); ?>