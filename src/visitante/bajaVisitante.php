<?php
    require_once '../clases/conexion.Class.php';
    require_once '../clases/visitorController.Class.php';
    $visitor= new visitor;
    $id=$_POST['ids'];
    
    $algo= $visitor->deathVisitor($id);
    echo json_encode($algo);

?>