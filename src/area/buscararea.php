<?php 
    

    include("../../database/con_db.php");
    $palabraBuscar=$_POST['buscar'];
    //No se por que agregue esto
    $datos[]=["No resultado"];
    //echo json_encode($datos);
    
    $sql="SELECT * FROM area WHERE nombreArea like '".$palabraBuscar."%' ORDER BY id DESC";
    $ejecutar= $conex->query($sql);
    //echo json_encode($ejecutar);
if($ejecutar) {

    while ($row = mysqli_fetch_assoc($ejecutar)) {
       // $datos[]=$row['nombreAlumno'];
       
        $datos[]=$row['id']."||".$row['nombreArea'];
    }
    echo json_encode($datos);
    
}




?>