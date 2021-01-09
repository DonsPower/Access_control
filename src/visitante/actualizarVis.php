<?php
     require_once "../clases/conexion.Class.php";
     require_once "../clases/visitorController.Class.php";
     $visitor=new visitor;
     //Actualizar los datos.
     $id=$_POST['id'];
     $name=$_POST['nombre'];
     $apellidoP=$_POST['apellidop'];
     $apellidoM=$_POST['apellidom'];
     $razon=$_POST['razon'];
    
     
     $algo=$visitor->actualizarVis($id,$name,$apellidoP,$apellidoM,$razon);
 
     echo json_encode($algo);

?>