<?php
    require_once '../clases/conexion.Class.php';
    require_once "../clases/paaeController.Class.php";
    require_once "../clases/validacionController.Class.php";
    $val=new validacion;

    $paae=new paae;
    $nombrePaae = ($_POST['nombrePaae']);
    $apellidoPatPaae = ($_POST['apellidoPatPaae']);
    $apellidoMatPaae = ($_POST['apellidoMatPaae']);
    $area = ($_POST['area']);
    $RFC = ($_POST['RFC']);
    $telefono = ($_POST['telefono']);
    $extension = ($_POST['extension']);
    $emailPaae = ($_POST['emailPaae']);
    if($val->is_val($nombrePaae)){
      echo json_encode(2);
    }else if($val->is_val($apellidoPatPaae)){
        echo json_encode(3);
    }else if($val->is_val($apellidoMatPaae)){
        echo json_encode(4);
    }else if($val->RFC($RFC)){
        echo json_encode(5);
    }else if($val->telefono($telefono)){
        echo json_encode(6);
    }else if($val->ext($extension)){
        echo json_encode(7);
    }else if(!$val->is_valid_email($emailPaae)){
      echo json_encode(8);
  }else{
      //Mandamos la consulta con todos los datos
      $algo=$paae->agregarPaae($nombrePaae,$apellidoPatPaae,$apellidoMatPaae,$area,$RFC,$telefono,$extension,$emailPaae);
      
      echo json_encode($algo);
     }


    


    
     ?>