<?php
    include("../../database/con_db.php");
    
    $num = $_POST['ids'];
    $num=($num-1)*10;
    $sql="SELECT * FROM visitantes ORDER BY id DESC LIMIT ".$num.", 10";
    $ejecutar= $conex->query($sql);
    if($ejecutar) {

        while ($row = mysqli_fetch_assoc($ejecutar)) {
           // $datos[]=$row['name'];
           
            $datos[]=$row['id']."||".$row['nombre']." ".$row['apellidop']." ".$row['apellidom']."||". $row['razonvisita']."||". $row['numcodqr']."||". $row['estado'];
        }
        echo json_encode($datos);
        
    }
    

?>