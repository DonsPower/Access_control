<?php

    require_once "../clases/conexion.Class.php";
    require_once "../clases/adminController.Class.php";
    require_once "../clases/validacionController.Class.php";
    $val=new validacion;
    $admin=new admin;
    //Actualizar los datos.
    $id=$_POST['id'];
    $name=$_POST['name'];
    $apellidoP=$_POST['apellidoP'];
    $apellidoM=$_POST['apellidoM'];
    $puesto=$_POST['puesto'];
    $areaAdministra=$_POST['areaAdministra'];
    $tipo=$_POST['tipo'];
    $email=$_POST['email'];
    $clave=$_POST['clave'];
    $preguntaS=$_POST['preguntaS'];
    $respuestaS=$_POST['respuestaS'];
    
    
    if($areaAdministra=="Seleccione el area que administra")$areaAdministra="1";
    else{
        
        $areaAdministra=$admin->buscarIdAdmin($areaAdministra);
        
    } 
    if($val->is_val($name)){
        echo json_encode(2);
    }else if($val->is_val($apellidoP)){
        echo json_encode(3);
    }else if($val->is_val($apellidoM)){
        echo json_encode(4);
    }else if($val->is_val($puesto)){
        echo json_encode(5);
    }else if($val->solo_numeros($clave)){
        echo json_encode(6);
    }else if(!$val->is_valid_email($email)){
        echo json_encode(7);
    }
    else{
        $algo=$admin->actualizarAdmin($id,$name,$apellidoP,$apellidoM,$puesto,$areaAdministra,$tipo,$email,$clave,$preguntaS,$respuestaS);
        echo json_encode($algo);
    }
    



?>