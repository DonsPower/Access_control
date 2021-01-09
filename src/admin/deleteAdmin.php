<?php
    require_once "../clases/conexion.Class.php";
    require_once "../clases/adminController.Class.php";
    $admin=new admin;
    //Actualizar los datos.
    $id=$_POST['ids'];
    $edit=$admin->deleteAdmin($id);
    echo json_encode($edit);
?>