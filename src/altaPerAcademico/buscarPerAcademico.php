<?php
include("../../database/con_db.php");
$palabraBuscar=$_POST['buscar'];
//si no se encuentram datos en la consuulta
$datos[]=["No resultado"];

$sql="SELECT * FROM personalacademico WHERE nombrePerAcademico like '".$palabraBuscar."%' ORDER BY id DESC";
$ejecutar= $conex->query($sql);

if($ejecutar) {

    while ($row = mysqli_fetch_assoc($ejecutar)) {
      
       
        $datos[]=$row['id']."||".$row['nombrePerAcademico']."||".$row['apellidoPatPerAcademico']."||".$row['apellidoMatPerAcademico']."||". $row['academia']."||". $row['RFC']."||". $row['telefono']."||". $row['extension']."||".$row['emailPerAcademico']."||".$row['numcodqr'];
    }
    echo json_encode($datos);
    
}
?>
