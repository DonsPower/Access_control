
<?php
    require_once '../clases/conexion.Class.php';
    require_once "../clases/paaeController.Class.php";

    $paae=new paae;
    $id=$_POST['ids'];
    $edit=$paae->deletePaae($id);
    echo json_encode($edit);

?>