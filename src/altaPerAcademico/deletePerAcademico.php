
<?php
    require_once '../clases/conexion.Class.php';
    require_once "../clases/perAcademicoController.Class.php";

    $perAcademico=new perAcademico;
    $id=$_POST['ids'];
    $edit=$perAcademico->deletePerAcademico($id);
    echo json_encode($edit);

?>