<?php

session_start();
//creamos variable cliente log y si no esta log lo redireccionamos 
if (isset($_SESSION['nombres'])){
    $cliente = $_SESSION['nombres'];    
}else{
    header('Location: ../index.php');
 die() ;
}


include("../con_db.php");
$id=$_REQUEST['id'];
        $query="SELECT * FROM paaes where id='$id'";
        $resultado=$conex->query($query);
        //Obtener una fila de resultado
        $row=$resultado->fetch_assoc();
?>


<!DOCTYPE html>
<html>
<head>
        <title>Actualizar PAAE</title>
        <meta charset="utf-8">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
</head>
    <body>
        <div class="container mt-5">
        <h2 > Actualizar PAAE </h2>
        </div>
        <div class="container">
            <div class="row justify-content-center"> 
                <form method ="post">
                    <div class="form-row p-2 text-center">
                        <div class="form-group">
                        <input type="text" size=60 style="width:770px"  REQUIRED class="form-control" name="nombrePaae" id="nombrePaae" placeholder="Nombre"  value ="<?php echo $row ['nombrePaae']; ?>"> 
 </div>

 <div class="form-row p-1">
    <div class="form-group col-md-5">

        <input type="text" size=60 style="width:310px" REQUIRED class="form-control" name="apellidoPatPaae" id="apellidoPatPaae" placeholder="Apellido Paterno" value ="<?php echo $row ['apellidoPatPaae']; ?>">
</div>

<div class="form-group col-md-5">
    
    <input type="text" size=60 style="width:300px" REQUIRED class="form-control" name="apellidoMatPaae" id="apellidoMatPaae" placeholder="Apellido Materno" value ="<?php echo $row ['apellidoMatPaae']; ?>">
</div>

<div class="form-group col-md-5">
   
    <select name="area" class="form-control " REQUIRED style="width:300px" font-size: "10px" value ="<?php echo $row ['area']; ?>">
       
    
        <?php
              if($row['area']=="Laboratorio"){
              	echo '<option value="Laboratorios" selected> Laboratorios </option>';
              }else{
              	echo '<option value="Laboratorios" >Laboratorios </option>';
              } if($row['area']=="Aulas"){
              	echo '<option value="Aulas" selected> Aulas </option>';
              }else{
              	echo '<option value="Aulas" >Aulas</option>';
              }
              ?>
    </select>
</div>
 
<div class="form-group col-md-5">
    
    <input type="text" size=60 style="width:300px" REQUIRED class="form-control" name="RFC" id="RFC" placeholder="RFC" value ="<?php echo $row ['RFC']; ?>">
</div>

<div class="form-group col-md-5">
    
    <input type="text" size=60 style="width:300px" REQUIRED class="form-control" name="telefono" id="telefono" placeholder="Telefono" value ="<?php echo $row ['telefono']; ?>">
</div>
<div class="form-group col-md-5">
    
    <input type="text" size=60 style="width:300px" REQUIRED class="form-control" name="extension" id="extension" placeholder="Extension" value ="<?php echo $row ['extension']; ?>">
</div>
<div class="form-row p-2">
        <div class="form-group">
        
        <input type="email" size=60 style="width:770px"  REQUIRED  class="form-control"  name="emailPaae" id="emailPaae"  placeholder="Correo" value ="<?php echo $row ['emailPaae']; ?>">
    </div>
</div> 

<div class="form-group col-md-5">
   
   <input type="file" size=60 style="width:300px" REQUIRED class="form-control"  name="huella" id="huella" placeholder="huella" value ="<?php echo $row ['huella']; ?>">
</div>
        </div>
</div> 

</div>

                    <input type="submit" name="register"  value="Continuar" class="btn btn-primary  btn-lg align="center   > 
                    <a href="index.php"  align="center" class="btn btn-danger  btn-lg"  > Regresar </a>

                </div>
            </form>
        </div>
    </div>
</body>
</html>

<?php
    include("../con_db.php");
    if(isset($_POST['register'])){
        if(strlen($_POST['nombrePaae']) >= 1 && strlen($_POST['apellidoPatPaae']) >= 1 && strlen($_POST['apellidoMatPaae']) >= 1 && strlen($_POST['area']) >= 1 &&
            strlen($_POST['RFC']) >= 1 && strlen($_POST['telefono']) >= 1 && strlen($_POST['extension']) >= 1 && strlen($_POST['emailPaae']) >= 1 &&
            strlen($_POST['huella']) >= 1   ){

             
                     $nombrePaae = ($_POST['nombrePaae']);
                    $apellidoPatPaae = ($_POST['apellidoPatPaae']);
                    $apellidoMatPaae = ($_POST['apellidoMatPaae']);
                    $area = ($_POST['area']);
                    $RFC = ($_POST['RFC']);
                    $telefono = ($_POST['telefono']);
                    $extension = ($_POST['extension']);
                    $emailPaae = ($_POST['emailPaae']);
                    $huella = ($_POST['huella']);

                $query="UPDATE paaes SET nombrePaae='$nombrePaae',apellidoPatPaae='$apellidoPatPaae',apellidoMatPaae='$apellidoMatPaae',area='$area', RFC='$RFC', telefono='$telefono', extension='$extension',
                emailPaae='$emailPaae',huella ='$huella' where id='$id'";
                $resultado=$conex->query($query);
                   if($resultado){
                       header ('Location: index.php');
                   }else{
                       echo "modificacion  no exitosa";
                    }
            }
        }
?>