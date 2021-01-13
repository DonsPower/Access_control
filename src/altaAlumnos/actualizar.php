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
        $query="SELECT * FROM alumnos where id='$id'";
        $resultado=$conex->query($query);
        //Obtener una fila de resultado
        $row=$resultado->fetch_assoc();
?>


<!DOCTYPE html>
<html>
<head>
        <title>Actualizar Informacion de Alumno</title>
        <meta charset="utf-8">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
</head>
    <body>
        <div class="container mt-5">
             <h2 > Actualizar Alumno </h2>
        </div>
        <div class="container">
            <div class="row justify-content-center"> 
                <form method ="post">
                    <div class="form-row p-2 text-center">
                        <div class="form-group">
                             <input type="text" size=60 style="width:770px"  REQUIRED class="form-control" name="nombreAlumno" id="nombreAlumno" placeholder="Nombre"  value ="<?php echo $row ['nombreAlumno']; ?>"> 
                        </div>

                        <div class="form-row p-1">
                            <div class="form-group col-md-5">
                                <input type="text" size=60 style="width:310px" REQUIRED class="form-control" name="apellidoPatAlumno" id="apellidoPatAlumno" placeholder="Apellido Paterno" value ="<?php echo $row ['apellidoPatAlumno']; ?>">
                            </div>

                            <div class="form-group col-md-5">
                                <input type="text" size=60 style="width:300px" REQUIRED class="form-control" name="apellidoMatAlumno" id="apellidoMatAlumno" placeholder="Apellido Materno" value ="<?php echo $row ['apellidoMatAlumno']; ?>">
                            </div>

                            <div class="form-group col-md-5">
                                <select name="carrera" class="form-control " REQUIRED style="width:300px" font-size: "10px" value ="<?php echo $row ['carrera']; ?>">
                                    <?php
                                        if($row['carrera']=="Ingenieria en Sistemas Computacionales"){
                                            echo '<option value="Ingenieria en Sistemas Computacionales" selected> Ingenieria en Sistemas Computacionales </option>';
                                        }else{
                                            echo '<option value="Ingenieria en Sistemas Computacionales" >Ingenieria en Sistemas Computacionales </option>';
                                        } if($row['carrera']=="Ingenieria Ambiental"){
                                            echo '<option value="Ingenieria Ambiental" selected> Ingenieria Ambiental </option>';
                                        }else{
                                            echo '<option value="Ingenieria Ambiental" >Ingenieria Ambiental </option>';
                                        }if($row['carrera']=="Ingenieria Mecatronica"){
                                            echo '<option value="Ingenieria Mecatronica" selected> Ingenieria Mecatronica </option>';
                                        }else{
                                            echo '<option value="Ingenieria Mecatronica" >Ingenieria Mecatronica </option>';
                                        }if($row['carrera']=="Ingenieria Metalurgica"){
                                            echo '<option value="Ingenieria Metalurgica" selected> Ingenieria Metalurgica </option>';
                                        }else{
                                            echo '<option value="Ingenieria Metalurgica" >Ingenieria Metalurgica </option>';
                                        }if($row['carrera']=="Ingenieria en Alimentos"){
                                            echo '<option value="Ingenieria en Alimentos" selected> Ingenieria en Alimentos </option>';
                                        }else{
                                            echo '<option value="Ingenieria en Alimentos" >Ingenieria en Alimentos </option>';
                                        }
                                ?>
                                </select>
                            </div>

                            <div class="form-group col-md-5">
                                <input type="text" size=60 style="width:300px"  REQUIRED class="form-control" name="boleta" id="boleta" placeholder="Boleta" value ="<?php echo $row ['boleta']; ?>">
                            </div>

                            <div class="form-group col-md-5">
                                <input type="text"  size=60 style="width:300px" REQUIRED class="form-control" name="telefonoMovil" id="telefonoMovil" placeholder="TelefonoMovil" value ="<?php echo $row ['telefonoMovil']; ?>">
                            </div>

                            <div class="form-group col-md-5">
                                <input type="text" size=60 style="width:300px" REQUIRED class="form-control"  name="telefonoFijo" id="telefonoFijo" placeholder="TelefonoFijo" value ="<?php echo $row ['telefonoFijo']; ?>">
                            </div>

                            <div class="form-group col-md-5">
                                <input type="text"  size=60 style="width:300px" REQUIRED class="form-control" name="telefonoPersonal" id="telefonoPersonal" placeholder="TelefonoPersonal" value ="<?php echo $row ['telefonoPersonal']; ?>">
                            </div>

                            <div class="form-group col-md-5">
                                <input type="text" size=60 style="width:300px" REQUIRED class="form-control"  name="NSS" id="NSS" placeholder="NSS" value ="<?php echo $row ['NSS']; ?>">
                            </div>

                            <div class="form-row p-2">
                                 <div class="form-group">
                                    <input type="email" size=60 style="width:770px"  REQUIRED  class="form-control"  name="emailAlumno" id="emailAlumno"  placeholder="Correo" value ="<?php echo $row ['emailAlumno']; ?>">
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
       if(strlen($_POST['nombreAlumno']) >= 1 && strlen($_POST['apellidoPatAlumno']) >= 1 && strlen($_POST['apellidoMatAlumno']) >= 1 && strlen($_POST['carrera']) >= 1 &&
           strlen($_POST['boleta']) >= 1 && strlen($_POST['telefonoMovil']) >= 1 && strlen($_POST['telefonoFijo']) >= 1 && strlen($_POST['telefonoPersonal']) >= 1 &&
           strlen($_POST['emailAlumno']) >= 1 && strlen($_POST['NSS']) >= 1 && strlen($_POST['huella']) >= 1  ){
   
            $nombreAlumno = ($_POST['nombreAlumno']);
            $apellidoPatAlumno = ($_POST['apellidoPatAlumno']);
            $apellidoMatAlumno = ($_POST['apellidoMatAlumno']);
            $carrera = ($_POST['carrera']);
            $boleta = ($_POST['boleta']);
            $telefonoMovil = ($_POST['telefonoMovil']);
            $telefonoFijo = ($_POST['telefonoFijo']);
            $telefonoPersonal = ($_POST['telefonoPersonal']);
            $emailAlumno = ($_POST['emailAlumno']);
            $NSS = ($_POST['NSS']);
            $huella = ($_POST['huella']);


            $query="UPDATE alumnos SET


            nombreAlumno='$nombreAlumno',apellidoPatAlumno='$apellidoPatAlumno',apellidoMatAlumno='$apellidoMatAlumno', carrera='$carrera', boleta='$boleta', telefonoMovil='$telefonoMovil', telefonoFijo='$telefonoFijo',
            telefonoPersonal='$telefonoPersonal',emailAlumno='$emailAlumno', NSS='$NSS', huella='$huella' where id='$id'";
                
            $resultado=$conex->query($query);
                   if($resultado){
                       header ('Location: index.php');
                   }else{
                       echo "modificacion  no exitosa";
                    }
            }
        }
?>