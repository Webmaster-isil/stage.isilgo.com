 $consulta = "SELECT `student`.`email` ,`student_profile`.`id_student_profile`, 
 `student_profile`.`telefono` , `student_profile`.`tipo_documento`, 
 `student_profile`.`nro_documento`, `student_profile`.`descripcion`, `student_profile`.`grado`,
  `student_profile`.`ocupacion`, `student_profile`.`linkedin`





    FROM `student` JOIN `student_profile` ON `student_profile`.`id_student_profile` = `student`.`id_student_profile`
    WHERE `student_profile`.`estado` = 0 LIMIT 2000;";


$consulta = "UPDATE `student_profile` SET `estado` = '1' WHERE `id_student_profile` = '".$fila['id_student_profile']."'";  
                $mysqli->query($consulta);  



$consulta = "SELECT `certificate`.`id_certificate`, `certificate`.`nombre`, `student`.`email`,
 `certificate`.`id_api` FROM `certificate` 
    INNER JOIN `student` ON `student`.`id_student` = `certificate`.`id_student` WHERE `certificate`.`estado` = 0 LIMIT 700";


$consulta = "UPDATE `certificate` SET `estado` = '1' WHERE `id_certificate` = '".$fila['id_certificate']."'"; 
$consulta = "UPDATE `certificate` SET `estado` = '2' WHERE `id_certificate` = '".$fila['id_certificate']."'"; 
$consulta = "UPDATE `certificate` SET `estado` = '3' WHERE `id_certificate` = '".$fila['id_certificate']."'"; 
   $consulta = "SELECT * FROM coupon WHERE estado = 0 LIMIT 800";
  $consulta = "UPDATE `coupon` SET `estado` = '1' WHERE `id_coupon` = '".$fila['id_coupon']."'"; 

 $consulta = "UPDATE `coupon` SET `estado` = '2' WHERE `id_coupon` = '".$fila['id_coupon']."'";  

 $consulta = "SELECT `student`.`email`, `student_membership`.`id_student_membership` ,`student_membership`.`fecha_limite`, `student_membership`.`id_membership` 
    FROM `student_membership` INNER JOIN `student` ON `student`.`id_student` = `student_membership`.`id_student` WHERE `student_membership`.`estado` = 3 LIMIT 200;";

   $consulta = "UPDATE `student_membership` SET `estado` = '1' WHERE `id_student_membership` = '".$fila['id_student_membership']."'";  
                 
                    $consulta = "UPDATE `student_membership` SET `estado` = '3' WHERE `id_student_membership` = '".$fila['id_student_membership']."'";  
 $consulta = "UPDATE `student_membership` SET `estado` = '2' WHERE `id_student_membership` = '".$fila['id_student_membership']."'";  
$consulta = "SELECT * FROM `course` WHERE estado = 0 LIMIT 100";
           $consulta = "UPDATE `course` SET `estado` = '3' WHERE `id_curso` = '".$fila['id_curso']."'";  


           $consulta = "SELECT * FROM `course` WHERE estado = 0 LIMIT 20";
           $consulta = "UPDATE `course` SET `estado` = '1' WHERE `id_curso` = '".$fila['id_curso']."'"; 
           $consulta = "UPDATE `course` SET `estado` = '2' WHERE `id_curso` = '".$fila['id_curso']."'";
           $consulta = "SELECT * FROM `course_description` WHERE estado = 0";
 $consulta = "UPDATE `course_description` SET `estado` = '2' WHERE `id_course_description` = '".$fila['id_course_description']."'"

$consulta = "SELECT * FROM `course_evaluation` WHERE estado = 0";
$consulta = "UPDATE `course_evaluation` SET `estado` = '1' WHERE `id_evaluation` = '".$fila['id_evaluation']."'"; 

  $consulta = "SELECT professor.nombre, work_experience.empresa , work_experience.cargo, professor.id_profesor, work_experience.id_work
    FROM professor INNER JOIN work_experience ON work_experience.id_professor = professor.id_profesor
    WHERE work_experience.estado = 0;";

     $consulta = "UPDATE `work_experience` SET `estado` = '2' WHERE `id_work` = '".$fila['id_work']."'";  

     $consulta = "UPDATE `work_experience` SET `estado` = '1' WHERE `id_work` = '".$fila['id_work']."'";
      $consulta = "SELECT `professor`.`id_profesor`, `professor`.`nombre`, `course_professors_professor`.`id_curso` FROM `professor` INNER JOIN `course_professors_professor` ON `professor`.`id_profesor` = `course_professors_professor`.`id_profesor`;";
$consulta = "SELECT course_review.*, student.nombre , student.apellido, student.email FROM course_review INNER JOIN student  ON student.id_student = course_review.id_student WHERE course_review.estado = 0 LIMIT 50;";
 $consulta = "UPDATE `course_review` SET `estado` = '1' WHERE `id_review_curso` = '".$fila['id_review_curso']."'";

 $consulta = "SELECT * FROM professor WHERE estado = 1 LIMIT 20";nombre,id_profesor,author,descripcion

  $consulta = "UPDATE `professor` SET `estado` = '4' WHERE `professor`.`id_profesor` = '".$fila['id_profesor']."'"; 
   $consulta = "SELECT * FROM professor WHERE estado = 0";
   $consulta = "UPDATE `professor` SET `estado` = '1' WHERE `professor`.`id_profesor` = '".$fila['id_profesor']."'";  

     $consulta = "UPDATE `professor` SET `estado` = '1' WHERE `professor`.`id_profesor` = '".$fila['id_profesor']."'"; 

     $consulta = "SELECT * FROM student WHERE estado = 0"; $username = $fila['email'];            
            $email = $fila['email'];
            $nombre = $fila['nombre'];
            $apellido = $fila['apellido'];$fila['roles'])


 $consulta = "UPDATE `student` SET `estado` = '1' WHERE `student`.`id_student` = '".$fila['id_student']."'";  


  $consulta = "SELECT `student`.email, `student`.id_student, `student_course`.`id_student_course` ,`student_course`.`id_course`, `student_course`.avance 
    FROM `student_course` INNER JOIN `student` ON `student`.id_student = `student_course`.`id_student`
    WHERE `student_course`.estado = 0 LIMIT 2000;";  

     $consulta = "UPDATE `student_course` SET `estado` = '1' WHERE `id_student_course` = '".$fila['id_student_course']."'";

      $consulta = "UPDATE `student_course` SET `estado` = '2' WHERE `id_student_course` = '".$fila['id_student_course']."'"; 

      $consulta = "UPDATE `student_course` SET `estado` = '3' WHERE `id_student_course` = '".$fila['id_student_course']."'";  
           $cursos_plan = 'SELECT * FROM course_study_plan WHERE id_curso = "'.$fila["id_curso"].'"';

   $consulta = "UPDATE `course_study_plan` SET `estado` = '2' WHERE `id` = '".$filaPlanes['id']."'"; 

    $consulta = "UPDATE `course_study_plan` SET `estado` = '1' WHERE `id` = '".$value."'"; 

     $consulta = "UPDATE `course_study_plan` SET `estado` = '3' WHERE `id` = '".$value."'"; 

      $consulta = "SELECT `course`.`id_curso`, `course_meta_tag`.`id_tag`, `course_meta_tag`.`title`, `course_meta_tag`.`description`, `course_meta_tag`.`keywords` FROM `course`
    INNER JOIN `course_course_meta_tag_course_meta_tag` ON `course_course_meta_tag_course_meta_tag`.`id_course` = `course`.`id_curso`
    INNER JOIN `course_meta_tag` ON `course_meta_tag`.`id_tag` = `course_course_meta_tag_course_meta_tag`.`id_metatag`
    WHERE `course_meta_tag`.`estado` = 0";

      $consulta = "UPDATE `course_meta_tag` SET `estado` = '1' WHERE `id_tag` = '".$fila['id_tag']."'"; 

          $consulta = "UPDATE `course_meta_tag` SET `estado` = '2' WHERE `id_tag` = '".$fila['id_tag']."'"; 