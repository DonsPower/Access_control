<?php
include("../../database/con_db.php");
    require_once '../clases/conexion.Class.php';
    require_once '../clases/adminController.Class.php';
    $admin=new admin;
    $primero=$_POST['primero'];
    //Si no encuentra nada en la busqueda retorna No resultado esta mal pero funciona tnego mello Y HAMBRE 
    $datos[]=["No resultado"];
    //echo json_encode($datos);
    
    $sql="SELECT * FROM administradores WHERE name like '".$primero."%' ORDER BY id DESC ";
    $ejecutar= $conex->query($sql);
    //echo json_encode($ejecutar);
if($ejecutar) {

    while ($row = mysqli_fetch_assoc($ejecutar)) {
       // $datos[]=$row['name'];
       $area=$admin->buscarArea($row['AreaAdm']);
        $datos[]=$row['id']."||".$row['name']." ".$row['ApellidoPAdm']." ".$row['ApellidoMFAdm']."||". $row['Puesto']."||". $area."||". $row['Tipo']."||". $row['email']."||".$row['TrabajadorAdm']."||".$row['PreguntaS']."||".$row['RespuestaS'];
    }
    echo json_encode($datos);
    
}
?>