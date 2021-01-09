<?php
include("../../database/con_db.php");
    $primero=$_POST['primero'];
    //Si no encuentra nada en la busqueda retorna No resultado esta mal pero funciona tnego mello Y HAMBRE 
    $datos[]=["No resultado"];
    //echo json_encode($datos);
    
    $sql="SELECT * FROM administradores WHERE name like '".$primero."%'";
    $ejecutar= $conex->query($sql);
    //echo json_encode($ejecutar);
if($ejecutar) {

    while ($row = mysqli_fetch_assoc($ejecutar)) {
       // $datos[]=$row['name'];
       
        $datos[]=$row['id']."||".$row['name']." ".$row['ApellidoPAdm']." ".$row['ApellidoMFAdm']."||". $row['Puesto']."||". $row['AreaAdm']."||". $row['Tipo']."||". $row['email']."||".$row['TrabajadorAdm']."||".$row['PreguntaS']."||".$row['RespuestaS'];
    }
    echo json_encode($datos);
    
}
?>
