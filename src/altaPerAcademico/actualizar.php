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
        $query="SELECT * FROM personalacademico where id='$id'";
        $resultado=$conex->query($query);
        //Obtener una fila de resultado
        $row=$resultado->fetch_assoc();
?>


<!DOCTYPE html>
<html>
<head>
        <title>Actualizar Personal Academico</title>
        <meta charset="utf-8">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
</head>
    <body>
        <div class="container mt-5">
        <h2 > Actualizar Personal Academico </h2>
        </div>
        <div class="container">
            <div class="row justify-content-center"> 
                <form method ="post">
                    <div class="form-row p-2 text-center">
                        <div class="form-group">
                        <input type="text" size=60 style="width:770px"  REQUIRED class="form-control" name="nombrePerAcademico" id="nombrePerAcademico" placeholder="Nombre"  value ="<?php echo $row ['nombrePerAcademico']; ?>"> 
 </div>

 <div class="form-row p-1">
    <div class="form-group col-md-5">

        <input type="text" size=60 style="width:310px" REQUIRED class="form-control" name="apellidoPatPerAcademico" id="apellidoPatPerAcademico" placeholder="Apellido Paterno" value ="<?php echo $row ['apellidoPatPerAcademico']; ?>">
</div>

<div class="form-group col-md-5">
    
    <input type="text" size=60 style="width:300px" REQUIRED class="form-control" name="apellidoMatPerAcademico" id="apellidoMatPerAcademico" placeholder="Apellido Materno" value ="<?php echo $row ['apellidoMatPerAcademico']; ?>">e
</div>

<div class="form-group col-md-5">
   
    <select name="academia" class="form-control " REQUIRED style="width:300px" font-size: "10px" value ="<?php echo $row ['academia']; ?>">
       
    
        <?php
              if($row['academia']=="Matematicas"){
              	echo '<option value="Matematicas" selected> Matemáticas </option>';
              }else{
              	echo '<option value="Matematicas" >Matematicas </option>';
              } if($row['academia']=="Academia"){
              	echo '<option value="Fisica" selected> Fisica </option>';
              }else{
              	echo '<option value="Fisica" >Fisica</option>';
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
        
        <input type="email" size=60 style="width:770px"  REQUIRED  class="form-control"  name="emailPerAcademico" id="emailPerAcademico"  placeholder="Correo" value ="<?php echo $row ['emailPerAcademico']; ?>">
    </div>
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
            if(strlen($_POST['nombrePerAcademico']) >= 1 && strlen($_POST['apellidoPatPerAcademico']) >= 1 && strlen($_POST['apellidoMatPerAcademico']) >= 1 && strlen($_POST['academia']) >= 1 &&
                strlen($_POST['RFC']) >= 1 && strlen($_POST['telefono']) >= 1 && strlen($_POST['extension']) >= 1 && strlen($_POST['emailPerAcademico']) >= 1 &&
                strlen($_POST['huella']) >= 1   ){
        
        
            
                 
                         $nombrePerAcademico = ($_POST['nombrePerAcademico']);
                        $apellidoPatPerAcademico = ($_POST['apellidoPatPerAcademico']);
                        $apellidoMatPerAcademico = ($_POST['apellidoMatPerAcademico']);
                        $academia = ($_POST['academia']);
                        $RFC = ($_POST['RFC']);
                        $telefono = ($_POST['telefono']);
                        $extension = ($_POST['extension']);
                        $emailPerAcademico = ($_POST['emailPerAcademico']);
                        $huella = ($_POST['huella']);

                        $query="UPDATE personalacademico SET


                        nombrePerAcademico='$nombrePerAcademico',apellidoPatPerAcademico='$apellidoPatPerAcademico',apellidoMatPerAcademico='$apellidoMatPerAcademico', academia='$academia', RFC='$RFC', telefono='$telefono', extension='$extension',
                        emailPerAcademico='$emailPerAcademico',huella='$huella' where id='$id'";
               
                $resultado=$conex->query($query);
                   if($resultado){
                       header ('Location: index.php');
                   }else{
                       echo "modificacion  no exitosa";
                    }
            }
        }
?>