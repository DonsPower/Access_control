<?php
     include("../../database/con_db.php");
    
     $num = $_POST['ids'];
     $num=($num-1)*10;
     $sql="SELECT * FROM administradores ORDER BY id DESC LIMIT ".$num.", 10";
     $ejecutar= $conex->query($sql);
     if($ejecutar) {
 
         while ($row = mysqli_fetch_assoc($ejecutar)) {
            // $datos[]=$row['name'];
            
            $datos[]=$row['id']."||".$row['name']." ".$row['ApellidoPAdm']." ".$row['ApellidoMFAdm']."||". $row['Puesto']."||". $row['AreaAdm']."||". $row['Tipo']."||". $row['email']."||".$row['TrabajadorAdm']."||".$row['PreguntaS']."||".$row['RespuestaS'];
         }
         echo json_encode($datos);
         
     }


?>