<?php 
    
    
    include("../../database/con_db.php");
    $palabraBuscar=$_POST['buscar'];
    //No se por que agregue esto
    $datos[]=["No resultado"];
    //echo json_encode($datos);
    
    $sql="SELECT * FROM visitantes WHERE nombre like '".$palabraBuscar."%'";
    $ejecutar= $conex->query($sql);
    //echo json_encode($ejecutar);
if($ejecutar) {

    while ($row = mysqli_fetch_assoc($ejecutar)) {
       // $datos[]=$row['name'];
       
        $datos[]=$row['id']."||".$row['nombre']." ".$row['apellidop']." ".$row['apellidom']."||". $row['razonvisita']."||". $row['numcodqr']."||". $row['estado'];
    }
    echo json_encode($datos);
    
}




?>