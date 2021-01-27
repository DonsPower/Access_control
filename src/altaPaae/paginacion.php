<?php
     include("../../database/con_db.php");
    
     $num = $_POST['ids'];
     $num=($num-1)*10;
     $sql="SELECT * FROM paaes ORDER BY id DESC LIMIT ".$num.", 10";
     $ejecutar= $conex->query($sql);
     if($ejecutar) {
         while ($row = mysqli_fetch_assoc($ejecutar)) {
            // $datos[]=$row['name'];     
            $datos[]=$row['id']."||".$row['nombrePaae']."||".$row['apellidoPatPaae']."||".$row['apellidoMatPaae']."||". $row['area']."||". $row['RFC']."||". $row['telefono']."||". $row['extension']."||".$row['emailPaae'].$row['numcodqr'];
         }
         echo json_encode($datos);
         
     }
?>