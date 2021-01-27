<?php
     include("../../database/con_db.php");
    
     $num = $_POST['ids'];
     $num=($num-1)*10;
     $sql="SELECT * FROM alumnos ORDER BY id DESC LIMIT ".$num.", 10";
     $ejecutar= $conex->query($sql);
     if($ejecutar) {
         while ($row = mysqli_fetch_assoc($ejecutar)) {
            // $datos[]=$row['name'];     
            $datos[]=$row['id']."||".$row['nombreAlumno']."||".$row['apellidoPatAlumno']."||".$row['apellidoMatAlumno']."||". $row['carrera']."||". $row['boleta']."||". $row['telefonoMovil']."||". $row['telefonoFijo']."||".$row['telefonoPersonal']."||".$row['emailAlumno']."||".$row['NSS']."||".$row['numcodqr'];
         }
         echo json_encode($datos);
         
     }
?>