<?php
    require_once '../clases/conexion.Class.php';
    require_once '../clases/authController.Class.php';
    require_once "../clases/adminController.Class.php";
    $admin=new admin;
    //AGREGAR NUEVO ususario..
    $name=$_POST['name'];
    $apellidoP=$_POST['apellidoP'];
    $apellidoM=$_POST['apellidoM'];
    $puesto=$_POST['puesto'];
    $areaAdministra=$_POST['areaAdministra'];
    $tipo=$_POST['tipo'];
    $email=$_POST['email'];
    $password=$_POST['password'];
    $clave=$_POST['clave'];
    $preguntaS=$_POST['preguntaS'];
    $respuestaS=$_POST['respuestaS'];
    if($areaAdministra=="Seleccione el área que administra")$areaAdministra="1";
    else{
       $id= $admin->buscarIdAdmin($areaAdministra);
       $areaAdministra=$id['id'];
    } 
    //Si es administrador por area buscar el ID para almacenarlo.
    
    
    //Mandamos la consul    ta con todos los datos
    $algo=$admin->agregarAdmin($name,$apellidoP,$apellidoM,$puesto,$areaAdministra,$tipo,$email,$clave,$password,$preguntaS,$respuestaS);

    echo json_encode($algo);

?>