<?php
    require_once '../clases/conexion.Class.php';
    require_once "../clases/alumnosController.Class.php";

    $alumno=new alumno;
    $id=$_POST['ids'];
    $edit=$alumno->deleteAlumno($id);
    echo json_encode($edit);