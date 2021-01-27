<?php
     include("../../database/con_db.php");
    
     $num = $_POST['ids'];
     $num=($num-1)*10;
     $sql="SELECT * FROM personalacademico ORDER BY id DESC LIMIT ".$num.", 10";
     $ejecutar= $conex->query($sql);
     if($ejecutar) {
         while ($row = mysqli_fetch_assoc($ejecutar)) {
            // $datos[]=$row['name'];     
            $datos[]=$row['id']."||".$row['nombrePerAcademico']."||".$row['apellidoPatPerAcademico']."||".$row['apellidoMatPerAcademico']."||". $row['academia']."||". $row['RFC']."||". $row['telefono']."||". $row['extension']."||".$row['emailPerAcademico']."||".$row['numcodqr'];
         }
         echo json_encode($datos);
         
     }
?>