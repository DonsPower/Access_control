<?php
include("../../database/con_db.php");
$palabraBuscar=$_POST['buscar'];
// si no se encuentran datos en la consulta
$datos[]=["No resultado"];


$sql="SELECT * FROM paaes WHERE nombrePaae like '".$palabraBuscar."%'";
$ejecutar= $conex->query($sql);

if($ejecutar) {

    while ($row = mysqli_fetch_assoc($ejecutar)) {
       
       
        $datos[]=$row['id']."||".$row['nombrePaae']."||".$row['apellidoPatPaae']."||".$row['apellidoMatPaae']."||". $row['area']."||". $row['RFC']."||". $row['telefono']."||". $row['extension']."||".$row['emailPaae']."||".$row['numcodqr'];
    }
    echo json_encode($datos);
    
}
?>
