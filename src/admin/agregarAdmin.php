<?php
    require_once '../clases/conexion.Class.php';
    require_once '../clases/authController.Class.php';
    require_once "../clases/adminController.Class.php";
    require_once "../clases/adminController.Class.php";
    require_once "../clases/validacionController.Class.php";
    $val=new validacion;
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
    
    //if($val->is_num($name)==1)
        if($areaAdministra=="Seleccione el área que administra")$areaAdministra="1";
        else{
            $id= $admin->buscarIdAdmin($areaAdministra);
            $areaAdministra=$id['id'];
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
            //Mandamos la consulta con todos los datos
            $preguntaS=$val->preResSeg($preguntaS);
            $respuestaS=$val->preResSeg($respuestaS);
            $algo=$admin->agregarAdmin($name,$apellidoP,$apellidoM,$puesto,$areaAdministra,$tipo,$email,$clave,$password,$preguntaS,$respuestaS);
            echo json_encode($algo);
        }
        
        
   
    

?>