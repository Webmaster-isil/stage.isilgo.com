<?php 
// 1
add_action('wp_ajax_crearCursos', 'crearCursos');
add_action('wp_ajax_nopriv_crearCursos', 'crearCursos');
// 2
add_action('wp_ajax_actualizarCursos', 'actualizarCursos');
add_action('wp_ajax_nopriv_actualizarCursos', 'actualizarCursos');
// 3
add_action('wp_ajax_crearProfesores', 'crearProfesores');
add_action('wp_ajax_nopriv_crearProfesores', 'crearProfesores');
// 4
add_action('wp_ajax_actualizarProfesores', 'actualizarProfesores');
add_action('wp_ajax_nopriv_actualizarProfesores', 'actualizarProfesores');
// 5
add_action('wp_ajax_crearAlumnos', 'crearAlumnos');
add_action('wp_ajax_nopriv_crearAlumnos', 'crearAlumnos');

// ESTE DEPENDE DE QUE EXISTAN LOS ALUMNOS Y LOS CURSOS 
add_action('wp_ajax_asociarCursos', 'asociarCursos');
add_action('wp_ajax_nopriv_asociarCursos', 'asociarCursos');

// ESTE DEPENDE DE QUE EXISTASN LOS CURSOS, Y LOS PROFESORES
add_action('wp_ajax_actualizarCursosReview', 'actualizarCursosReview');
add_action('wp_ajax_nopriv_actualizarCursosReview', 'actualizarCursosReview');

// DEPENDE DE QUE EXISTAN LOS CURSOS 
add_action('wp_ajax_planesDeEstudio', 'planesDeEstudio');
add_action('wp_ajax_nopriv_planesDeEstudio', 'planesDeEstudio');

// DEPENDE DE QUE EXISTAN CURSOS 
add_action('wp_ajax_atributosCursos', 'atributosCursos');
add_action('wp_ajax_nopriv_atributosCursos', 'atributosCursos');

// DEPENDE QUE EXISTAN CURSOS Y PROFESORES 
add_action('wp_ajax_asignarCursosProfesores', 'asignarCursosProfesores');
add_action('wp_ajax_nopriv_asignarCursosProfesores', 'asignarCursosProfesores');

// DEPENDE DE QUE EXISTAN LOS PROFESORES 
add_action('wp_ajax_cargarCargosProfesores', 'cargarCargosProfesores');
add_action('wp_ajax_nopriv_cargarCargosProfesores', 'cargarCargosProfesores');

// DEPENDE DE LOS ALUMNOS Y DE LOS CURSOS Y D ELOS PROFESORES 
add_action('wp_ajax_cargarEvaluacionCurso', 'cargarEvaluacionCurso');
add_action('wp_ajax_nopriv_cargarEvaluacionCurso', 'cargarEvaluacionCurso');

// DEPENDE DE LOS CURSOS 
add_action('wp_ajax_cargarInfoCurso', 'cargarInfoCurso');
add_action('wp_ajax_nopriv_cargarInfoCurso', 'cargarInfoCurso');

// DEPENDE SOLO DE LOS ALUMNOS Y DE SUS CURSOS
add_action('wp_ajax_cargarCertificados', 'cargarCertificados');
add_action('wp_ajax_nopriv_cargarCertificados', 'cargarCertificados');

// DEPENDE DE LOS ALUMNOS Y USUARIOS (PROFESORES)
add_action('wp_ajax_cargarDNIDATA', 'cargarDNIDATA');
add_action('wp_ajax_nopriv_cargarDNIDATA', 'cargarDNIDATA');

// DEPENDE DE LOS ALUMNOS 
add_action('wp_ajax_cargarMembresias', 'cargarMembresias');
add_action('wp_ajax_nopriv_cargarMembresias', 'cargarMembresias');

// DEPENDEN DE LOS CURSOS
add_action('wp_ajax_cargarCupones', 'cargarCupones');
add_action('wp_ajax_nopriv_cargarCupones', 'cargarCupones');

// DEPENDE DE QUE EXISTAN PROFESORES 
add_action('wp_ajax_asociarCategoriasProfe', 'asociarCategoriasProfe');
add_action('wp_ajax_nopriv_asociarCategoriasProfe', 'asociarCategoriasProfe');

/* codigo brindado por radar*/
// DEPENDE DE LOS CURSOS
add_action('wp_ajax_cargarMetadata', 'cargarMetadata');
add_action('wp_ajax_nopriv_cargarMetadata', 'cargarMetadata');

// add_action('wp_ajax_actualziarCuponesSegundoCheck', 'actualziarCuponesSegundoCheck');
// add_action('wp_ajax_nopriv_actualziarCuponesSegundoCheck', 'actualziarCuponesSegundoCheck');



function cargarDNIDATA(){
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);
  $mysqli = new mysqli("ecommerce-db-instance-1.c6dtz61dw11m.us-east-1.rds.amazonaws.com", "ecommerce_usr_qa2", 'hSg%34fdFsre$F', "isilgo_stage2_ecommerce_db");
    
    /* verificar la conexi贸n */
    if ($mysqli->connect_errno) {
        printf("Conexión fallida: %s\n", $mysqli->connect_error);
        exit();
    }    
    $consulta = "SELECT `student`.`email` ,`student_profile`.`id_student_profile`, `student_profile`.`telefono` , `student_profile`.`tipo_documento`, `student_profile`.`nro_documento`, `student_profile`.`descripcion`, `student_profile`.`grado`, `student_profile`.`ocupacion`, `student_profile`.`linkedin`
    FROM `student` JOIN `student_profile` ON `student_profile`.`id_student_profile` = `student`.`id_student_profile`
    WHERE `student_profile`.`estado` = 0 LIMIT 2000;";

    if ($resultado = $mysqli->query($consulta)) {
        //tener un array asociativo */
        $i = 0;
        while ($fila = $resultado->fetch_assoc()) {            
            $user = get_user_by( 'email', $fila['email'] );
            if($user){                
                echo $user->ID. ' '.$fila['email'];
                // if($fila['tipo_documento'] != '' && $fila['nro_documento'] != ''){

                    
                //     $dni_tipo = get_user_meta($user->ID, 'billing_documento', true);
                //     if(!$dni_tipo){
                //         if($fila['tipo_documento'] == 'DNI'){
                //             update_user_meta($user->ID, 'billing_documento', 'dni');
                //         }else if($fila['tipo_documento'] == 'Carnet de Extranjería'){
                //             update_user_meta($user->ID, 'billing_documento', 'dni');
                //         }
                        
                //         echo $fila['tipo_documento'];
                //         echo '<br>';
                //     }
                // }

                 // NRO DE DOCUMENTO
                 if($fila['nro_documento'] != ''){                    
                    update_field('nro_documento', $fila['nro_documento'] , 'user_'.$user->ID);
                }

                 // TELEFONO
                 if($fila['telefono'] != ''){                    
                    update_field('telefono', $fila['telefono'] , 'user_'.$user->ID);
                }

                // DESCRIPCIÓN DEL USUARIO .
                if($fila['descripcion'] != ''){
                    update_user_meta($user->ID, 'description', $fila['descripcion']);  
                }

                // GRADO 
                if($fila['grado'] != '' && !get_field('grado_isil', 'user_'.$user->ID)){
                    update_field('grado_isil', $fila['grado'] , 'user_'.$user->ID);
                }

                // OCUPACIÓN 
                if($fila['ocupacion'] != '' && !get_field('situacion_isil', 'user_'.$user->ID)){
                    update_field('situacion_isil', $fila['ocupacion'] , 'user_'.$user->ID);
                }

                // LINKED in 
                if($fila['linkedin'] != '' && !get_field('linkedin', 'user_'.$user->ID)){
                    update_field('linkedin', $fila['linkedin'] , 'user_'.$user->ID);
                }

                $consulta = "UPDATE `student_profile` SET `estado` = '1' WHERE `id_student_profile` = '".$fila['id_student_profile']."'";  
                $mysqli->query($consulta);  

                echo '<br>';

            }
                
        }
    }
    die();
}

function cargarCertificados(){
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);
  $mysqli = new mysqli("ecommerce-db-instance-1.c6dtz61dw11m.us-east-1.rds.amazonaws.com", "ecommerce_usr_qa2", 'hSg%34fdFsre$F', "isilgo_stage2_ecommerce_db");
    
    /* verificar la conexi贸n */
    if ($mysqli->connect_errno) {
        printf("Conexión fallida: %s\n", $mysqli->connect_error);
        exit();
    }    
    $consulta = "SELECT `certificate`.`id_certificate`, `certificate`.`nombre`, `student`.`email`, `certificate`.`id_api` FROM `certificate` 
    INNER JOIN `student` ON `student`.`id_student` = `certificate`.`id_student` WHERE `certificate`.`estado` = 0 LIMIT 700";

    if ($resultado = $mysqli->query($consulta)) {
        //tener un array asociativo */
        $i = 0;
        while ($fila = $resultado->fetch_assoc()) {            
            $user = get_user_by( 'email', $fila['email']);
            if($user){                                    
                $mis_cursos = get_field('mis_cursos', 'user_'.$user->ID);
                if($mis_cursos){
                    foreach ($mis_cursos as $key => $value) {
                        
                        $nombre = get_the_title($value['curso']);                            
                        if($nombre == $fila['nombre']){          
                            $mis_cursos[$key]['certificado'] = $fila['id_api'];
                            print_r($mis_cursos);
                            echo '<br>';
                            break;
                        }                                                    
                    }
                    update_field('mis_cursos', $mis_cursos , 'user_'.$user->ID);                    
                    $consulta = "UPDATE `certificate` SET `estado` = '1' WHERE `id_certificate` = '".$fila['id_certificate']."'";  
                    $mysqli->query($consulta);          
                }else{
                    $consulta = "UPDATE `certificate` SET `estado` = '2' WHERE `id_certificate` = '".$fila['id_certificate']."'";  
                    $mysqli->query($consulta);          
                }                   
                echo '<br>';
            }else{
                $consulta = "UPDATE `certificate` SET `estado` = '3' WHERE `id_certificate` = '".$fila['id_certificate']."'";  
                $mysqli->query($consulta);          
            }
        }
    }
    die();
}

function asociarCategoriasProfe(){

    $authors = get_users([ 'fields'  => ['ID', 'display_name'], 'role' => 'author', 'orderby' => 'display_name', ]);

    if($authors){
        foreach ($authors as $key => $value) {            
            $products = wc_get_products( array( 'status'    => 'publish', 'limit'     => -1, 'author'    => $value->ID) );
            $categorias = array();
            if($products){
                foreach ($products as $key => $producto) {
                    $terms = get_the_terms( $producto->get_id(), 'product_cat' );
                    if($terms){
                        foreach ($terms as $key => $termino) {                            
                            array_push($categorias, $termino->term_id);                            
                        }
                    }
                }
            }

            if(count($categorias) > 0 ){ 
                print_r($categorias);
                echo ' | ';
                $categorias = array_unique($categorias); 
                update_field('categoria', $categorias, 'user_'.$value->ID );
                print_r($categorias);
                echo ' | ';
                echo $value->ID;
                echo '<br>';echo '<br>';
            }
        }
    }

    die();

}

function cargarCupones(){
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);
  $mysqli = new mysqli("ecommerce-db-instance-1.c6dtz61dw11m.us-east-1.rds.amazonaws.com", "ecommerce_usr_qa2", 'hSg%34fdFsre$F', "isilgo_stage2_ecommerce_db");
    
    /* verificar la conexión */
    if ($mysqli->connect_errno) {
        printf("Conexión fallida: %s\n", $mysqli->connect_error);
        exit();
    }    
    $consulta = "SELECT * FROM coupon WHERE estado = 0 LIMIT 800";

    if ($resultado = $mysqli->query($consulta)) {        
        while ($fila = $resultado->fetch_assoc()) {
            echo $fila['nombre']  . ' | ';
                        
            $coupon = array( 'post_title' => $fila['codigo'], 'post_content' => '', 'post_excerpt' => $fila['nombre'] .' - '. $fila['descripcion'], 'post_status' => 'publish', 'post_author' => 1, 'post_type' => 'shop_coupon' );
            $condiciones = str_replace("'", '"', $fila['condiciones']);
            $condiciones = json_decode($condiciones, true);
            $ids_productos = false;
            if(isset($condiciones['coursePool']) && count($condiciones['coursePool']) > 0){
                $ids_productos = array();
                foreach ($condiciones['coursePool'] as $key => $cursito) {
                    $id_producto = wc_get_product_id_by_sku($cursito);                    
                    if($id_producto){                        
                        array_push($ids_productos, $id_producto);
                    }
                }
               
            }
                            
            $new_coupon_id = wp_insert_post( $coupon );
            
            if ( $new_coupon_id ) {

                //fixed_cart, percent, fixed_product, percent_product                
                update_post_meta( $new_coupon_id, 'discount_type', 'percent' );                
                update_post_meta( $new_coupon_id, 'coupon_amount', $fila['descuento']);                
                update_post_meta( $new_coupon_id, 'individual_use', 'yes' );
                update_post_meta( $new_coupon_id, 'exclude_sale_items', 'no' );
                
                                
                if($ids_productos){ update_post_meta( $new_coupon_id, 'product_ids',  implode(', ', $ids_productos )); }                
                                                                                                
                // update_post_meta( $new_coupon_id, 'exclude_product_ids', '' );
                update_post_meta( $new_coupon_id, 'usage_limit', $fila['limite'] );
                update_post_meta( $new_coupon_id, 'expiry_date', $fila['fecha_limite'] );
                update_post_meta( $new_coupon_id, 'usage_limit_per_user', 1);
                
                update_post_meta( $new_coupon_id, 'apply_before_tax', 'yes' );
                update_post_meta( $new_coupon_id, 'free_shipping', 'no' );

                $consulta = "UPDATE `coupon` SET `estado` = '1' WHERE `id_coupon` = '".$fila['id_coupon']."'";  
                $mysqli->query($consulta);
                echo "Creado con éxito....";

            } else {                
                $consulta = "UPDATE `coupon` SET `estado` = '2' WHERE `id_coupon` = '".$fila['id_coupon']."'";  
                $mysqli->query($consulta);
                echo "No creado....";
            }

            echo '<br>'; 
        }
    }
    die();
}

function cargarMembresias(){
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);
  $mysqli = new mysqli("ecommerce-db-instance-1.c6dtz61dw11m.us-east-1.rds.amazonaws.com", "ecommerce_usr_qa2", 'hSg%34fdFsre$F', "isilgo_stage2_ecommerce_db");
    
    /* verificar la conexión */
    if ($mysqli->connect_errno) {
        printf("Conexión fallida: %s\n", $mysqli->connect_error);
        exit();
    }    
    $consulta = "SELECT `student`.`email`, `student_membership`.`id_student_membership` ,`student_membership`.`fecha_limite`, `student_membership`.`id_membership` 
    FROM `student_membership` INNER JOIN `student` ON `student`.`id_student` = `student_membership`.`id_student` WHERE `student_membership`.`estado` = 0 LIMIT 200;";

    if ($resultado = $mysqli->query($consulta)) {  
        $i = 0;             
        while ($fila = $resultado->fetch_assoc()) {

            $user = get_user_by( 'email', $fila['email'] );
            if($user){                
                echo $user->ID. ' '.$fila['email'];
                $codigo_membresia = false;
                if($fila['id_membership'] == 'f1bb22a3-930a-4bca-b839-d628420a2fcc' || $fila['id_membership'] == '0c9ce408-8308-47d1-819f-6a8e037058b5'){
                     // 6 meses 
                    $codigo_membresia = 112;
                }else if($fila['id_membership'] == 'ac6c1f8f-40ad-4772-8f52-e96d801fc686'){
                    // 3 meses 
                    $codigo_membresia = 105;
                }else if($fila['id_membership'] == 'c5a99594-9162-404c-99a0-ee3769f15b4d' || $fila['id_membership'] == '480fea1a-ca26-49a8-9059-a6f96af6164c'){
                    // 12 meses
                    $codigo_membresia = 113;
                }

                if($codigo_membresia){

                    echo $fila['fecha_limite'];
                    $limite   = new DateTime($fila['fecha_limite']);
                    $ahora    = new DateTime();
                    if($limite > $ahora){
                        update_field('membresia',true, 'user_'.$user->ID);                         
                    }
                    // fecha_suscripcion
                    update_field('fecha_expiracion',$limite->format('Y-m-d'), 'user_'.$user->ID);     
                    update_field('id_membresia',$codigo_membresia, 'user_'.$user->ID);    
                    update_field('orden_de_compra','migrado', 'user_'.$user->ID);    
                     
                    
                    echo '<br>';
                    $consulta = "UPDATE `student_membership` SET `estado` = '1' WHERE `id_student_membership` = '".$fila['id_student_membership']."'";  
                    $mysqli->query($consulta);

                }else{
                    echo ' Membresia antigua <br>';
                    $consulta = "UPDATE `student_membership` SET `estado` = '3' WHERE `id_student_membership` = '".$fila['id_student_membership']."'";  
                    $mysqli->query($consulta);
                }

            }else{
                echo ' No encuentra al Alumno <br>';
                $consulta = "UPDATE `student_membership` SET `estado` = '2' WHERE `id_student_membership` = '".$fila['id_student_membership']."'";  
                $mysqli->query($consulta);
            }
            
            $i++; 
            // if($i > 1){ die(); }                        
        }
    }
    die();
}

function actualizarCursos(){
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);
  $mysqli = new mysqli("ecommerce-db-instance-1.c6dtz61dw11m.us-east-1.rds.amazonaws.com", "ecommerce_usr_qa2", 'hSg%34fdFsre$F', "isilgo_stage2_ecommerce_db");
    
    /* verificar la conexi贸n */
    if ($mysqli->connect_errno) {
        printf("Conexión fallida: %s\n", $mysqli->connect_error);
        exit();
    }    
    $consulta = "SELECT * FROM `course` WHERE estado = 0";
    
    if ($resultado = $mysqli->query($consulta)) {
        //tener un array asociativo */
        $i = 0;
        while ($fila = $resultado->fetch_assoc()) {
        
            $id_producto = wc_get_product_id_by_sku($fila['id_curso']);
            $producto = false;
            if($id_producto) { $producto = wc_get_product($id_producto); }                                                
            if($producto){
                // ACTUALIZAR ESTADO 
                if($fila['post_status'] == 'draft'){
                    $producto->set_status('draft'); // Set status to draft
                }

                // ACTUALIZAR SKU 
                if($producto->get_sku() == '' || $producto->get_sku() == false){
                    $producto->set_sku($fila['id_curso']); // Set status to draft
                }

                // // IMAGEN
                // $image = wp_get_attachment_image_src( get_post_thumbnail_id( $id_producto ), 'single-post-thumbnail' );
                // if(!$image){
                //     $a = media_sideload_image($fila['foto'], $id_producto, 'Foto curso','id');                                        
                //     if($a){                            
                //         $producto->set_image_id( $a );
                //     }   
                // }

                $producto->save();
                echo 'Producto Actualizado: <a href="https://stage2.isilgo.com/wp-admin/post.php?post='.$id_producto.'&action=edit" target="_blank">'.$fila['nombre'].'</a>';          
                $consulta = "UPDATE `course` SET `estado` = '3' WHERE `id_curso` = '".$fila['id_curso']."'";  
                $mysqli->query($consulta);           
                echo '<br>';
            }                       
        }
    }

}   

function crearCursos(){
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);
  $mysqli = new mysqli("ecommerce-db-instance-1.c6dtz61dw11m.us-east-1.rds.amazonaws.com", "ecommerce_usr_qa2", 'hSg%34fdFsre$F', "isilgo_stage2_ecommerce_db");
    
    /* verificar la conexi贸n */
    if ($mysqli->connect_errno) {
        printf("Conexión fallida: %s\n", $mysqli->connect_error);
        exit();
    }
    
    $consulta = "SELECT * FROM `course` WHERE estado = 0";
    
    if ($resultado = $mysqli->query($consulta)) {
        //tener un array asociativo */
        $i = 0;
        while ($fila = $resultado->fetch_assoc()) {
        
            $id_producto = wc_get_product_id_by_sku($fila['id_curso']);
            $producto = false;
            if($id_producto) { $producto = wc_get_product($id_producto); }                                                
            if(!$producto){
                
            
                $product = new WC_Product_Simple();
                $product->set_name( $fila['nombre']);        
                $product->set_regular_price( 250 );
                $product->set_short_description( $fila['short_description'] );       
                $product->set_sku($fila['id_curso']);

                $a = media_sideload_image($fila['foto'], FALSE, 'Foto curso','id');                                        
                if($a){                            
                    $product->set_image_id( $a );
                }            
                $product->save();    
                echo 'Producto Creado: '.  $fila['nombre'];          
                $consulta = "UPDATE `course` SET `estado` = '1' WHERE `id_curso` = '".$fila['id_curso']."'";  
                $mysqli->query($consulta);           

            }else{
                echo $producto->get_id(). ' '. $producto->get_name().' | Ya existe | ';
                $consulta = "UPDATE `course` SET `estado` = '2' WHERE `id_curso` = '".$fila['id_curso']."'";  
                $mysqli->query($consulta);  
            }
            echo '<br>';
            
        }
    }

}

function cargarInfoCurso(){
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);
    $mysqli = new mysqli("ecommerce-db-instance-1.c6dtz61dw11m.us-east-1.rds.amazonaws.com", "ecommerce_usr_qa2", 'hSg%34fdFsre$F', "isilgo_stage2_ecommerce_db");
    

    /* verificar la conexi贸n */
    if ($mysqli->connect_errno) {
        printf("Conexión fallida: %s\n", $mysqli->connect_error);
        exit();
    }
    
    $consulta = "SELECT * FROM `course_description` WHERE estado = 0";
    
    if ($resultado = $mysqli->query($consulta)) {
        //tener un array asociativo */
        $i = 0;
        while ($fila = $resultado->fetch_assoc()) {
        
            $id_producto = wc_get_product_id_by_sku($fila['id_course']);
            $producto = false;
            if($id_producto) { $producto = wc_get_product($id_producto); }                                                
            if($producto){
                echo $producto->get_id(). ' '. $producto->get_name();
                          
                if(!get_field('que_necesito', $producto->get_id())){ update_field('que_necesito', $fila['requisitos'], $producto->get_id()); }
                if(!get_field('aprenderas', $producto->get_id())){ update_field('aprenderas', $fila['contenido'], $producto->get_id()); }
                if(!get_field('sobre_el_curso', $producto->get_id())){ update_field('sobre_el_curso', $fila['sobre_el_curso'], $producto->get_id()); }
                 
                $consulta = "UPDATE `course_description` SET `estado` = '2' WHERE `id_course_description` = '".$fila['id_course_description']."'";  
                $mysqli->query($consulta);           
                echo '<br>';

            }
            
        }
    }

}

function cargarEvaluacionCurso(){
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);
  $mysqli = new mysqli("ecommerce-db-instance-1.c6dtz61dw11m.us-east-1.rds.amazonaws.com", "ecommerce_usr_qa2", 'hSg%34fdFsre$F', "isilgo_stage2_ecommerce_db");
    
    /* verificar la conexi贸n */
    if ($mysqli->connect_errno) {
        printf("Conexión fallida: %s\n", $mysqli->connect_error);
        exit();
    }
    
    // SELECT  course.nombre FROM `course_evaluation` 
    // INNER JOIN course ON course.id_curso = course_evaluation.id_course
    // WHERE course_evaluation.`estado` = 0;

    $consulta = "SELECT * FROM `course_evaluation` WHERE estado = 0";
    
    if ($resultado = $mysqli->query($consulta)) {
        //tener un array asociativo */
        $i = 0;
        while ($fila = $resultado->fetch_assoc()) {
        
            $id_producto = wc_get_product_id_by_sku($fila['id_course']);
            $producto = false;
            if($id_producto) { $producto = wc_get_product($id_producto); }                                                
            if($producto){
                echo $producto->get_id(). ' '. $producto->get_name();
                
                if(!get_field('evaluacion', $producto->get_id())){
                    update_field('evaluacion', $fila['contenido'], $producto->get_id());
                }    
                                  
                $consulta = "UPDATE `course_evaluation` SET `estado` = '1' WHERE `id_evaluation` = '".$fila['id_evaluation']."'";  
                $mysqli->query($consulta);           
                echo '<br>';

            }
            
        }
    }

}

function cargarCargosProfesores(){

    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);
  $mysqli = new mysqli("ecommerce-db-instance-1.c6dtz61dw11m.us-east-1.rds.amazonaws.com", "ecommerce_usr_qa2", 'hSg%34fdFsre$F', "isilgo_stage2_ecommerce_db");
    
    /* verificar la conexi贸n */
    if ($mysqli->connect_errno) {
        printf("Conexión fallida: %s\n", $mysqli->connect_error);
        exit();
    }
    
    $consulta = "SELECT professor.nombre, work_experience.empresa , work_experience.cargo, professor.id_profesor, work_experience.id_work
    FROM professor INNER JOIN work_experience ON work_experience.id_professor = professor.id_profesor
    WHERE work_experience.estado = 0;";
    
    if ($resultado = $mysqli->query($consulta)) {
        //tener un array asociativo */
        $i = 0;
        while ($fila = $resultado->fetch_assoc()) {
            $limpio = str_replace(' ', '', $fila['nombre']);
            $limpio = str_replace('á', '', $limpio);
            $limpio = str_replace('é', '', $limpio);
            $limpio = str_replace('í', '', $limpio);
            $limpio = str_replace('ó', '', $limpio);
            $limpio = str_replace('ú', '', $limpio);
            $limpio = str_replace('ñ', '', $limpio);
            $limpio = str_replace('Á', '', $limpio);
            $limpio = str_replace('É', '', $limpio);
            $limpio = str_replace('Í', '', $limpio);
            $limpio = str_replace('Ó', '', $limpio);
            $limpio = str_replace('Ó', '', $limpio);
            $limpio = str_replace('Ñ', '', $limpio);


            $email = strtolower(str_replace(' ', '', $limpio)).'@provisorio-isilgo.pe';                                           
            $user = get_user_by( 'email', $email );
            if($user){                
                    echo $user->ID. ' ' .$fila['id_profesor']. ' '.$fila['cargo'];
                    if(!get_field('empresa', 'user_'.$user->ID)){
                        update_field('empresa',$fila['cargo'], 'user_'.$user->ID);                               
                        $consulta = "UPDATE `work_experience` SET `estado` = '2' WHERE `id_work` = '".$fila['id_work']."'";                
                        $mysqli->query($consulta);
                        
                    }else{
                        $consulta = "UPDATE `work_experience` SET `estado` = '1' WHERE `id_work` = '".$fila['id_work']."'";                
                        $mysqli->query($consulta);                        
                        echo ' | Ya tiene Cargo';
                    }
                    echo '<br>';
                
            }
        }
    }
}

function asignarCursosProfesores(){
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);
  $mysqli = new mysqli("ecommerce-db-instance-1.c6dtz61dw11m.us-east-1.rds.amazonaws.com", "ecommerce_usr_qa2", 'hSg%34fdFsre$F', "isilgo_stage2_ecommerce_db");
    
    /* verificar la conexi贸n */
    if ($mysqli->connect_errno) {
        printf("Conexión fallida: %s\n", $mysqli->connect_error);
        exit();
    }
    
    $consulta = "SELECT `professor`.`id_profesor`, `professor`.`nombre`, `course_professors_professor`.`id_curso` FROM `professor` INNER JOIN `course_professors_professor` ON `professor`.`id_profesor` = `course_professors_professor`.`id_profesor`;";
    
    if ($resultado = $mysqli->query($consulta)) {
        //tener un array asociativo */
        $i = 0;
        while ($fila = $resultado->fetch_assoc()) {
            $limpio = str_replace(' ', '', $fila['nombre']);
            $limpio = str_replace('á', '', $limpio);
            $limpio = str_replace('é', '', $limpio);
            $limpio = str_replace('í', '', $limpio);
            $limpio = str_replace('ó', '', $limpio);
            $limpio = str_replace('ú', '', $limpio);
            $limpio = str_replace('ñ', '', $limpio);
            $limpio = str_replace('Á', '', $limpio);
            $limpio = str_replace('É', '', $limpio);
            $limpio = str_replace('Í', '', $limpio);
            $limpio = str_replace('Ó', '', $limpio);
            $limpio = str_replace('Ó', '', $limpio);
            $limpio = str_replace('Ñ', '', $limpio);


            $email = strtolower(str_replace(' ', '', $limpio)).'@provisorio-isilgo.pe';                                           
            $user = get_user_by( 'email', $email );
            if($user){
                $id_producto = wc_get_product_id_by_sku($fila['id_curso']);
                $producto = false;
                if($id_producto) { $producto = wc_get_product($id_producto); }                                                
                if($producto){
                    // $author_id = get_post_field( 'post_author', $id_producto );
                    // echo $author_id;
                    // if($author_id == 1){                        
                        echo $user->ID. ' ' .$fila['id_profesor']. ' '.$producto->get_id(). ' '. $producto->get_name();
                        // $actual = get_field('docentes', $producto->get_id());
                        // if($actual){
                        //     array_push($actual, $user);
                        //     update_field('docentes', $actual, $producto->get_id());
                        // }else{
                        //     update_field('docentes', $user, $producto->get_id());
                        // }
                     
                        $arg = array(
                            'ID' => $id_producto,
                            'post_author' => $user->ID,
                            'post_type' => 'product'
                        );
                        wp_update_post( $arg );
                                                         
                    // }
                    echo '<br>';
                   
                }
            }
        }
    }
    die();

}

function actualizarCursosReview(){
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);
  $mysqli = new mysqli("ecommerce-db-instance-1.c6dtz61dw11m.us-east-1.rds.amazonaws.com", "ecommerce_usr_qa2", 'hSg%34fdFsre$F', "isilgo_stage2_ecommerce_db");
    
    /* verificar la conexi贸n */
    if ($mysqli->connect_errno) {
        printf("Conexión fallida: %s\n", $mysqli->connect_error);
        exit();
    }
    
    $consulta = "SELECT course_review.*, student.nombre , student.apellido, student.email FROM course_review INNER JOIN student  ON student.id_student = course_review.id_student WHERE course_review.estado = 0 LIMIT 50;";
    
    
    if ($resultado = $mysqli->query($consulta)) {
        //tener un array asociativo */
        $i = 0;
        while ($fila = $resultado->fetch_assoc()) {   
            $id_producto = wc_get_product_id_by_sku($fila['id_curso']);
            $producto = false;
            if($id_producto) { $producto = wc_get_product($id_producto); }  
            $user = get_user_by( 'email', $fila['email'] );                                                              
            if($producto && $user){                
                
                $comment_id = wp_insert_comment( array(
                    'comment_post_ID'      => $id_producto, // <=== The product ID where the review will show up
                    'comment_author'       => $fila['nombre']. ' ' . $fila['apellido'] ,
                    'comment_author_email' => $fila['email'], // <== Important
                    'comment_author_url'   => '',
                    'comment_content'      => $fila['texto'],
                    'comment_type'         => '',
                    'comment_parent'       => 0,
                    'user_id'              => $user->ID, // <== Important
                    'comment_author_IP'    => '',
                    'comment_agent'        => '',
                    'comment_date'         => date('Y-m-d H:i:s'),
                    'comment_approved'     => 1,
                ) );
                                
                update_comment_meta( $comment_id, 'rating', $fila['valor'] );
                echo $fila['texto']. ' ' .$comment_id. ' <br>';
                $consulta = "UPDATE `course_review` SET `estado` = '1' WHERE `id_review_curso` = '".$fila['id_review_curso']."'";                
                $mysqli->query($consulta);
            }              
            echo '<br>';
            $i++;
            if($i > 500) { die(); };
        }
    }
}

function actualizarProfesores(){
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);
  $mysqli = new mysqli("ecommerce-db-instance-1.c6dtz61dw11m.us-east-1.rds.amazonaws.com", "ecommerce_usr_qa2", 'hSg%34fdFsre$F', "isilgo_stage2_ecommerce_db");
    
    /* verificar la conexi贸n */
    if ($mysqli->connect_errno) {
        printf("Conexión fallida: %s\n", $mysqli->connect_error);
        exit();
    }
    
    $consulta = "SELECT * FROM professor WHERE estado = 1";
    
    if ($resultado = $mysqli->query($consulta)) {
        //tener un array asociativo */
        $i = 0;
        while ($fila = $resultado->fetch_assoc()) {   
            $limpio = str_replace(' ', '', $fila['nombre']);         
            $limpio = str_replace('á', '', $limpio);
            $limpio = str_replace('é', '', $limpio);
            $limpio = str_replace('í', '', $limpio);
            $limpio = str_replace('ó', '', $limpio);
            $limpio = str_replace('ú', '', $limpio);
            $limpio = str_replace('ñ', '', $limpio);
            $limpio = str_replace('Á', '', $limpio);
            $limpio = str_replace('É', '', $limpio);
            $limpio = str_replace('Í', '', $limpio);
            $limpio = str_replace('Ó', '', $limpio);
            $limpio = str_replace('Ó', '', $limpio);
            $limpio = str_replace('Ñ', '', $limpio);
            $email = strtolower(str_replace(' ', '', $limpio)).'@provisorio-isilgo.pe';                  
            $nombre = $fila['nombre'];                        
            $user = get_user_by( 'email', $email );
            if( $user ) {       
                echo $fila['id_profesor']. ' '. $email ;
                // ROL
                $user->add_role('author');

                // FOTO
                if(!get_field('foto_autor','user_'.$user->ID)){
                    $a = media_sideload_image($fila['foto'], $user->ID, 'Foto profesor','id');                    
                    if( is_wp_error( $a ) ) {
                        // $a->get_error_message();
                        $consulta = "UPDATE `professor` SET `estado` = '2' WHERE `professor`.`id_profesor` = '".$fila['id_profesor']."'";                
                        $mysqli->query($consulta);              
                        continue;
                    }else{
                        if($a){
                            // set_post_thumbnail($id_producto, $a);                                                                                   
                            update_field('foto_autor', $a, 'user_'.$user->ID);
                        }                                                                   
                    }
                }else{ echo ' | Ya tiene Foto'; }
                
                // LINKEDIN 
                if(!get_field('linkedin','user_'.$user->ID)){ update_field('linkedin',$fila['linkedin'], 'user_'.$user->ID); }else{ echo ' | Ya tiene LinkedIN'; }

                // DESCRIPCIÓN Y BIOGRAFIA
                if(!get_field('biografia','user_'.$user->ID)){
                    update_user_meta($user->ID, 'description', $fila['descripcion']);     
                    update_field('biografia',$fila['descripcion'], 'user_'.$user->ID);
                }else{ echo ' | Ya tiene Biografías'; }
                           
                            
                $consulta = "UPDATE `professor` SET `estado` = '4' WHERE `professor`.`id_profesor` = '".$fila['id_profesor']."'";                
                $mysqli->query($consulta);                
                echo ' Actualizado | Usuario ya existe bajo el nombre de : '. $user->get('user_firstname'). ' -> ' .  $user->get('user_email');
            }else{
                $consulta = "UPDATE `professor` SET `estado` = '3' WHERE `professor`.`id_profesor` = '".$fila['id_profesor']."'";                
                $mysqli->query($consulta); 
                echo 'no existe: '. $fila['id_profesor']. ' '. $email ;
            }


            echo '<br>';
            $i++;
            // if($i > 1) { die(); };
        }
    }
}

function crearProfesores(){
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);
  $mysqli = new mysqli("ecommerce-db-instance-1.c6dtz61dw11m.us-east-1.rds.amazonaws.com", "ecommerce_usr_qa2", 'hSg%34fdFsre$F', "isilgo_stage2_ecommerce_db");
    
    /* verificar la conexi贸n */
    if ($mysqli->connect_errno) {
        printf("Conexión fallida: %s\n", $mysqli->connect_error);
        exit();
    }
    
    $consulta = "SELECT * FROM professor WHERE estado = 0";
    
    if ($resultado = $mysqli->query($consulta)) {
        //tener un array asociativo */
        $i = 0;
        while ($fila = $resultado->fetch_assoc()) {
            echo $fila['id_profesor'];
            $limpio = str_replace(' ', '', $fila['nombre']);         
            $limpio = str_replace('á', '', $limpio);
            $limpio = str_replace('é', '', $limpio);
            $limpio = str_replace('í', '', $limpio);
            $limpio = str_replace('ó', '', $limpio);
            $limpio = str_replace('ú', '', $limpio);
            $limpio = str_replace('ñ', '', $limpio);
            $limpio = str_replace('Á', '', $limpio);
            $limpio = str_replace('É', '', $limpio);
            $limpio = str_replace('Í', '', $limpio);
            $limpio = str_replace('Ó', '', $limpio);
            $limpio = str_replace('Ó', '', $limpio);
            $limpio = str_replace('Ñ', '', $limpio);
            $email = strtolower(str_replace(' ', '', $limpio)).'@provisorio-isilgo.pe';        
            $nombre = $fila['nombre'];            
            
            $user = get_user_by( 'email', $email );
            if( ! $user ) {        
                $userdata = array(
                    'user_login' =>  $email,
                    'first_name' => $nombre,
                    'last_name' => '',
                    'user_email' => $email,
                    'display_name' =>  $nombre,
                    'user_pass'  =>  '',
                    'role' => 'customer'
                );                
                $user_id = wp_insert_user( $userdata ) ;
                                
                if ( ! is_wp_error( $user_id ) ) {
                    echo "Profesor Creado : ". $nombre. ' -> ' .$user_id;
                    $user = get_user_by( 'id', $user_id );                
                    $user->add_role('faculty' );                                             
                    update_field('linkedin', $fila['linkedin'], $user_id);                    
                    $consulta = "UPDATE `professor` SET `estado` = '1' WHERE `professor`.`id_profesor` = '".$fila['id_profesor']."'";                
                    $mysqli->query($consulta);
                }
        
                
                
            }else{       
                $consulta = "UPDATE `professor` SET `estado` = '1' WHERE `professor`.`id_profesor` = '".$fila['id_profesor']."'";                
                $mysqli->query($consulta);                
                echo ' | Usuario ya existe bajo el nombre de : '. $user->get('user_firstname'). ' -> ' .  $user->get('user_email');
            }

            echo '<br>';
        }
    }
}

function crearAlumnos(){
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);
  $mysqli = new mysqli("ecommerce-db-instance-1.c6dtz61dw11m.us-east-1.rds.amazonaws.com", "ecommerce_usr_qa2", 'hSg%34fdFsre$F', "isilgo_stage2_ecommerce_db");
    
    /* verificar la Conexión */
    if ($mysqli->connect_errno) {
        printf("Conexión fallida: %s\n", $mysqli->connect_error);
        exit();
    }
    
    $consulta = "SELECT * FROM student WHERE estado = 0";
    // $consulta = "SELECT * FROM student WHERE id_student = '0d03b549-9fec-433f-ba1b-ba75a563467a'";
    
    if ($resultado = $mysqli->query($consulta)) {
        //tener un array asociativo */
        $i = 0;
        while ($fila = $resultado->fetch_assoc()) {
            $username = $fila['email'];            
            $email = $fila['email'];
            $nombre = $fila['nombre'];
            $apellido = $fila['apellido'];
            $roles = json_decode(str_replace("'", '"',$fila['roles']), true);                                
            $user = get_user_by( 'email', $email );
            if( ! $user ) {        
                $userdata = array(
                    'user_login' =>  $email,
                    'first_name' => $nombre,
                    'last_name' => $apellido,
                    'user_email' => $email,
                    'display_name' =>  $nombre.' '.$apellido,
                    'user_pass'  =>  '',
                    'role' => 'customer'
                );
                
                $user_id = wp_insert_user( $userdata ) ;
                
                // On success.
                if ( ! is_wp_error( $user_id ) ) {
                    echo "Usuario Creado : ". $username. ' -> ' .$user_id;
                }
        
                
                $user = get_user_by( 'id', $user_id );
                if(is_array($roles) ||  is_object($roles) && $user){
                    foreach ($roles as $key => $rol) {                    
                        if($rol['name'] == 'STUDENT EE') { $user->add_role('student_ee' ); }
                        if($rol['name'] == 'STUDENT CT') { $user->add_role('student_ct' ); } 
                        if($rol['name'] == 'ALUMNI') { $user->add_role('alumni' ); } 
                        if($rol['name'] == 'EMPLOYEE') { $user->add_role('employee' ); }
                        if($rol['name'] == 'FACULTY') { $user->add_role('faculty' ); }
                    }
                    echo ' | Roles cargados';
                }
            }else{       
                $consulta = "UPDATE `student` SET `estado` = '1' WHERE `student`.`id_student` = '".$fila['id_student']."'";                
                $mysqli->query($consulta);
                
                echo ' | Usuario ya existe bajo el nombre de : '. $user->get('user_firstname'). ' -> ' .  $user->get('user_email');
            }
            

            echo '<br>';
            $i++;
           if($i ==5000) { die(); }
        }
    }
}

function asociarCursos(){
    
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);
    $mysqli = new mysqli("ecommerce-db-instance-1.c6dtz61dw11m.us-east-1.rds.amazonaws.com", "ecommerce_usr_qa2", 'hSg%34fdFsre$F', "isilgo_stage2_ecommerce_db");    
    if ($mysqli->connect_errno) {
        printf("Conexión fallida: %s\n", $mysqli->connect_error);
        exit();
    }  
    $registroPorLotes = 1000;  
    $consulta = "SELECT `student`.email, `student`.id_student, `student_course`.`id_student_course` ,`student_course`.`id_course`, `student_course`.avance 
    FROM `student_course` INNER JOIN `student` ON `student`.id_student = `student_course`.`id_student`
    WHERE `student_course`.estado = 0 LIMIT $registroPorLotes;";        
    if ($resultado = $mysqli->query($consulta)) {        
        $i = 0;
        while ($fila = $resultado->fetch_assoc()) {            
            $user = get_user_by( 'email', $fila['email'] );
            if($user){                
                echo $user->get('user_firstname').' '.$user->ID.' '.$fila['email']. ' '.$fila['id_student']. ' '.$fila['id_course'] ;
                $id_producto = wc_get_product_id_by_sku($fila['id_course']);
                $producto = false;
                if($id_producto) { $producto = wc_get_product($id_producto); }                                                
                
                 //cortado                
                 if($producto){
                    $cursos = get_field('mis_cursos', 'user_'.$user->ID);
                    $estado = 'iniciado';
                    if($fila['avance'] == '100'){ $estado = 'finalizado'; }  
                      //cortado2 
                      if($cursos){
                        $switch = 0;
                        foreach ($cursos as $key => $value) {                            
                            if($id_producto == $value['curso']){
                                $cursos[$key]['porcentaje_del_curso'] = intval($fila['avance']) / 100;
                                $cursos[$key]['estado'] = $estado;
                                $cursos[$key]['orden_de_compra'] = 'migrado';
                                $cursos[$key]['fecha_compra'] = date('d/m/Y');
                                $switch = 1;
                                break;
                            }
                        }
                        if($switch == 1){
                            update_field('mis_cursos', $cursos, 'user_' . $user->ID);
                        }else{
                            $datos = array(
                                'curso' => $producto->get_id(),
                                'porcentaje_del_curso' => intval($fila['avance']) / 100,
                                'estado' => $estado,
                                'fecha_compra' => date('d/m/Y'),
                                'orden_de_compra' => 'migrado'
                            );    
                                                                           
                            add_row('mis_cursos', $datos, 'user_' . $user->ID);
                        }

                    }else{                                         
                        $datos = array(
                            'curso' => $producto->get_id(),
                            'porcentaje_del_curso' => intval($fila['avance']) / 100,
                            'estado' => $estado,
                            'fecha_compra' => date('d/m/Y'),
                            'orden_de_compra' => 'migrado'
                        );    
                                                                       
                        add_row('mis_cursos', $datos, 'user_' . $user->ID);
                    }             
                    $consulta = "UPDATE `student_course` SET `estado` = '1' WHERE `id_student_course` = '".$fila['id_student_course']."'";                
                    $mysqli->query($consulta); 
                }else{
                    $consulta = "UPDATE `student_course` SET `estado` = '2' WHERE `id_student_course` = '".$fila['id_student_course']."'";                
                    $mysqli->query($consulta);
                }
             
            }else{
                $consulta = "UPDATE `student_course` SET `estado` = '3' WHERE `id_student_course` = '".$fila['id_student_course']."'";                
                $mysqli->query($consulta);
            }
            //fin de cortado
                        
            echo '<br>';  
            $i++;     
            if($i == 1000){ break; }
        }
    }
}



function planesDeEstudio(){
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);

    // 0 no ejecutado
    // 2 tiene html , manual
    // 1 ejecutado
    // 3 no encuentra el curso
    // 4 sin plan
        
  $mysqli = new mysqli("ecommerce-db-instance-1.c6dtz61dw11m.us-east-1.rds.amazonaws.com", "ecommerce_usr_qa2", 'hSg%34fdFsre$F', "isilgo_stage2_ecommerce_db");
    
    /* verificar la conexi贸n */
    if ($mysqli->connect_errno) {
        printf("Conexión fallida: %s\n", $mysqli->connect_error);
        exit();
    }
    
    $consulta = "SELECT * FROM `course`";
    
    if ($resultado = $mysqli->query($consulta)) {
        //tener un array asociativo */
        $i = 0;
        while ($fila = $resultado->fetch_assoc()) {
            // $cursos_plan = 'SELECT * FROM course_study_plan WHERE id_curso = "'.$fila["id_curso"].'" AND estado = 1';  
            $cursos_plan = 'SELECT * FROM course_study_plan WHERE id_curso = "'.$fila["id_curso"].'"';  
            echo $cursos_plan .' ';  
                if ($planes = $mysqli->query($cursos_plan)) {                    
                    $plan = array();
                    $idFila = array();
                    while ($filaPlanes = $planes->fetch_assoc()) {                                                
                        if($filaPlanes["col_8"] != ''){ 
                            $consulta = "UPDATE `course_study_plan` SET `estado` = '2' WHERE `id` = '".$filaPlanes['id']."'";                
                            $mysqli->query($consulta);
                            continue; 
                        }
                        $indice = 0;
                        if($filaPlanes["sesion"] == 'Sesión 1'){ $indice = 0; }  
                        if($filaPlanes["sesion"] == 'Sesión 2'){ $indice = 1; }  
                        if($filaPlanes["sesion"] == 'Sesión 3'){ $indice = 2; }  
                        if($filaPlanes["sesion"] == 'Sesión 4'){ $indice = 3; }  
                        if($filaPlanes["sesion"] == 'Sesión 5'){ $indice = 4; }  
                        if($filaPlanes["sesion"] == 'Sesión 6'){ $indice = 5; }  

                        $plan[$indice] = array('titulo' => $filaPlanes["titulo"], 'contenido' => $filaPlanes["contenido"], );                         
                        array_push($idFila, $filaPlanes["id"]);
                    }
                    
                    ksort($plan);                    
                    if($plan){
                        $id_producto = wc_get_product_id_by_sku($fila['id_curso']);                    
                        $producto = false;
                        if($id_producto) { 
                            echo $id_producto. '<br>';
                            $producto = wc_get_product($id_producto); 
                            if($producto){
                                foreach ($plan as $key => $value) {
                                    $datos = array(
                                        'titulo' => $value['titulo'],
                                        'detalle' =>  $value['contenido'],                                    
                                    );                                                        
                                    // add_row('plan_de_estudio', $datos, $id_producto);
                                }                                                                      
                                foreach ($idFila as $key => $value) {
                                    $consulta = "UPDATE `course_study_plan` SET `estado` = '1' WHERE `id` = '".$value."'";                
                                    $mysqli->query($consulta);
                                }                                
                            }else{
                                foreach ($idFila as $key => $value) {
                                    $consulta = "UPDATE `course_study_plan` SET `estado` = '3' WHERE `id` = '".$value."'";                
                                    $mysqli->query($consulta);
                                }                                  
                                echo 'sin Curso encontrado <br>';
                            }
                        }else{
                            foreach ($idFila as $key => $value) {
                                $consulta = "UPDATE `course_study_plan` SET `estado` = '3' WHERE `id` = '".$value."'";                
                                $mysqli->query($consulta);
                            } 
                            echo 'sin Curso encontrado <br>';
                        }                                                    
                    }else{
                        foreach ($idFila as $key => $value) {
                            $consulta = "UPDATE `course_study_plan` SET `estado` = '4' WHERE `id` = '".$value."'";                
                            $mysqli->query($consulta);
                        }  
                        echo 'Sin nada en plan de estudios : <br>';
                    }
                    

                }else{
                    echo '<br>';
                } 
            echo  'contador: '. $i++;
            // if($i >= 100){ die(); }                             
        }
            
        $resultado->free();
    }
        
    /* cerrar la conexi贸n */
    $mysqli->close();
}

function atributosCursos(){
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);
    $args = array(
        'post_type'             => 'product',
        'post_status'           => 'publish',
        'ignore_sticky_posts'   => 1,
        'posts_per_page'        => -1,
        'tax_query'             => array(
            array(
                'taxonomy'      => 'product_cat',
                'field' => 'term_id', //This is optional, as it defaults to 'term_id'
                'terms'         => array(43),
                'operator'      => 'IN' // Possible values are 'IN', 'NOT IN', 'AND'.
            )
        )
    );
    $products = get_posts($args);
    if($products){
        foreach ($products as $key => $product) {
            echo get_permalink($product->ID). ' ' .$product->post_title;      
             update_field('documentos_descargables', 1, $product->ID);
            //  update_field('presentacion_interactiva', 1, $product->ID);
            //  update_field('evaluaciones', 1, $product->ID);
             update_field('video_clase_con_especialista', 1, $product->ID);
             update_field('certificado_por_isil', 1, $product->ID);
            echo '<br>';
        }
    }    
    
}




/* Brindado or radar */
function cargarMetadata(){
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);   
    $mysqli = new mysqli("ecommerce-db-instance-1.c6dtz61dw11m.us-east-1.rds.amazonaws.com", "ecommerce_usr_qa2", 'hSg%34fdFsre$F', "isilgo_stage2_ecommerce_db");       
    /* verificar la conexion */
    if ($mysqli->connect_errno) {
        printf("Conexión fallida: %s\n", $mysqli->connect_error);
        exit();
    }
    
    $consulta = "SELECT `course`.`id_curso`, `course_meta_tag`.`id_tag`, `course_meta_tag`.`title`, `course_meta_tag`.`description`, `course_meta_tag`.`keywords` FROM `course`
    INNER JOIN `course_course_meta_tag_course_meta_tag` ON `course_course_meta_tag_course_meta_tag`.`id_course` = `course`.`id_curso`
    INNER JOIN `course_meta_tag` ON `course_meta_tag`.`id_tag` = `course_course_meta_tag_course_meta_tag`.`id_metatag`
    WHERE `course_meta_tag`.`estado` = 0";
    
    if ($resultado = $mysqli->query($consulta)) {
        //tener un array asociativo */
        $i = 0;
        while ($fila = $resultado->fetch_assoc()) {
        
            $id_producto = wc_get_product_id_by_sku($fila['id_curso']);
            $producto = false;
            if($id_producto) { $producto = wc_get_product($id_producto); }                                                
            if($producto){
                echo $producto->get_id(). ' '. $producto->get_name();

                update_post_meta($producto->get_id(), '_yoast_wpseo_title', $fila['title']); 
                update_post_meta($producto->get_id(), '_yoast_wpseo_metadesc', $fila['description']); 
                update_post_meta($producto->get_id(), '_yoast_wpseo_focuskw', str_replace(',', ' ', $fila['keywords'])); 
                                    
                $consulta = "UPDATE `course_meta_tag` SET `estado` = '1' WHERE `id_tag` = '".$fila['id_tag']."'";  
                $mysqli->query($consulta);           
                echo '<br>';

            }else{
                $consulta = "UPDATE `course_meta_tag` SET `estado` = '2' WHERE `id_tag` = '".$fila['id_tag']."'";  
                $mysqli->query($consulta);           
                echo '<br>';
            }
            
        }
    }
}

function actualziarCuponesSegundoCheck(){
    $coupon_posts = get_posts( array(
        'posts_per_page'   => -1,
        'orderby'          => 'name',
        'order'            => 'asc',
        'post_type'        => 'shop_coupon',
        'post_status'      => 'publish',
    ) );

    $coupon_codes = []; // Initializing

    // Push to array
    foreach ( $coupon_posts as $coupon_post ) {        
        update_post_meta( $coupon_post->ID, 'exclude_sale_items', 'no' );
    }
}


