<?php 
    session_start();
    
    //creamos variable cliente logueado y si no esta logueado lo redireccionamos 
    require_once '../clases/authController.Class.php';
 
    //creamos el objeto cliente
    $auth=new auth;
    if (isset($_SESSION['nombre'])){
        $cliente = $_SESSION['nombre'];
        
            //Enviamos el tiempo y si pasan ciertos minutos lo redireccionamos
            if(isset($_SESSION['tiempo'])){
                $location="../index.php";
                echo $auth-> lifeSession($_SESSION['tiempo'],$location );
            } else {
                //Activamos sesion tiempo con cualquier uso de la pagina.
                $_SESSION['tiempo'] = time();
           } 
    }else{
        header('Location: ./index.php');
        die();
    }
?>
<?php

include("../../database/con_db.php");

    $id=$_REQUEST['id'];

    $query= " DELETE FROM  visitantes WHERE id='$id' ";

    $resultado=$conex->query($query);

    if($resultado)
    {
        header ('Location: ../dashboard.php');
    }
    else
    {
        echo "Hubo un problema";
    }

?>