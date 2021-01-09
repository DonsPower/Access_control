<?php
    require_once '../clases/conexion.Class.php';
    require_once '../clases/visitorController.Class.php';
    $visitor= new visitor;
    $confirmar=$_POST['conf'];
    
    $algo= $visitor->deathVisitor();
    echo json_encode($algo);

?>