<?php
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
    $offset = 0;
    do {
        $consulta = "SELECT `student`.email, `student`.id_student, `student_course`.`id_student_course` ,`student_course`.`id_course`, `student_course`.avance 
            FROM `student_course` 
            INNER JOIN `student` ON `student`.id_student = `student_course`.`id_student`
            WHERE `student_course`.estado = 0 LIMIT $offset, $registroPorLotes;";        

        if ($resultado = $mysqli->query($consulta)) {
            $mysqli->begin_transaction();

            while ($fila = $resultado->fetch_assoc()) {
                procesarRegistro($fila, $mysqli);
            }

            $mysqli->commit();
            $resultado->close();
        }

        $offset += $registroPorLotes;
    } while ($resultado->num_rows > 0);

    $mysqli->close();
}

function procesarRegistro($fila, $mysqli) {
    $user = get_user_by('email', $fila['email']);

    if ($user) {
        echo $user->get('user_firstname').' '.$user->ID.' '.$fila['email']. ' '.$fila['id_student']. ' '.$fila['id_course'];

        $id_producto = wc_get_product_id_by_sku($fila['id_course']);
        $producto = $id_producto ? wc_get_product($id_producto) : false;

        if ($producto) {
            $cursos = get_field('mis_cursos', 'user_'.$user->ID);
            $estado = 'iniciado';
            if ($fila['avance'] == '100') {
                $estado = 'finalizado';
            }

            $switch = 0;
            foreach ($cursos as $key => $value) {
                if ($id_producto == $value['curso']) {
                    $cursos[$key]['porcentaje_del_curso'] = intval($fila['avance']) / 100;
                    $cursos[$key]['estado'] = $estado;
                    $cursos[$key]['orden_de_compra'] = 'migrado';
                    $cursos[$key]['fecha_compra'] = date('d/m/Y');
                    $switch = 1;
                    break;
                }
            }

            if ($switch == 1) {
                update_field('mis_cursos', $cursos, 'user_' . $user->ID);
            } else {
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
        } else {
            $consulta = "UPDATE `student_course` SET `estado` = '2' WHERE `id_student_course` = '".$fila['id_student_course']."'";
            $mysqli->query($consulta);
        }
    } else {
        $consulta = "UPDATE `student_course` SET `estado` = '3' WHERE `id_student_course` = '".$fila['id_student_course']."'";
        $mysqli->query($consulta);
    }

    echo '<br>';
}

// Llamada a la función principal
asociarCursos();
?>
