<?php 
    

    include("../../database/con_db.php");
    $palabraBuscar=$_POST['buscar'];
    //No se por que agregue esto
    $datos[]=["No resultado"];
    //echo json_encode($datos);
    
    $sql="SELECT * FROM alumnos WHERE nombreAlumno like '".$palabraBuscar."%'";
    $ejecutar= $conex->query($sql);
    //echo json_encode($ejecutar);
if($ejecutar) {

    while ($row = mysqli_fetch_assoc($ejecutar)) {
       // $datos[]=$row['nombreAlumno'];
       
        $datos[]=$row['id']."||".$row['nombreAlumno']."||".$row['apellidoPatAlumno']."||".$row['apellidoMatAlumno']."||".$row['carrera']
        ."||".$row['boleta']."||".$row['telefonoMovil']."||".$row['telefonoFijo']."||".$row['telefonoPersonal']
        ."||".$row['emailAlumno']."||".$row['NSS']."||".$row['numcodqr'];
    }
    echo json_encode($datos);
    
}




?>