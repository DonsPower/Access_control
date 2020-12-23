<?php

session_start();
//creamos variable cliente log y si no esta log lo redireccionamos 
if (isset($_SESSION['nombre'])){
    $cliente = $_SESSION['nombre'];    
}else{
    header('Location: ../index.php');
 die() ;
}


include("../../database/con_db.php");
$id=$_REQUEST['id'];
        $query="SELECT * FROM visitantes where id='$id'";
        $resultado=$conex->query($query);
        //Obtener una fila de resultado
        $row=$resultado->fetch_assoc();
?>


<!DOCTYPE html>
<html>
<head>
        <title>Actualizar visitantes</title>
        <meta charset="utf-8">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
</head>
    <body>
        <div class="container mt-5">
        <h2 > Actualizar visitante </h2>
        </div>
        <div class="container">
            <div class="row justify-content-center"> 
                <form method ="post">
                    <div class="form-row p-2 text-center">
                        <div class="form-group">
                            <input type="text" size=60 style="width:770px"  REQUIRED class="form-control" name="nombre" id="nombre" placeholder="Nombre" value="<?php echo $row['nombre'];?>">
                        </div>
                        <div class="form-row p-1">
                            <div class="form-group col-md-5">
                                <input type="text" size=60 style="width:310px" REQUIRED class="form-control" name="apellidop" id="apellidop" placeholder="Apellido Paterno" value="<?php echo $row['apellidop'];?>">
                        </div>
                        <div class="form-group col-md-5">
                            <input type="text" size=60 style="width:300px" REQUIRED class="form-control" name="apellidom" id="apellidom" placeholder="Apellido Materno" value="<?php echo $row['apellidom'];?>">
                        </div>
                        <div class="form-row p-2">
                            <div class="form-group"> 
                                <textarea REQUIRED class="form-control" cols="30" rows="10" name="razonvisita" id="razonvisita"  placeholder="Razón de la visita"><?php echo $row['razonvisita'];?></textarea>
                                <div class="form-row p-2">
                                        <input type="text" size=60 style="width:770px"  REQUIRED  class="form-control"  name="numcodqr" id="numcodqr"  placeholder="Código QR" value="<?php echo $row['numcodqr'];?>">      
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
    
include("../../database/con_db.php");
    if(isset($_POST['register'])){
        if(strlen($_POST['nombre']) >= 1 && strlen($_POST['apellidop']) >= 1 && strlen($_POST['apellidom']) >= 1 && strlen($_POST['razonvisita']) >= 1 &&
            strlen($_POST['numcodqr']) >= 1)
            {
                $nombre = ($_POST['nombre']);
                $apellidop = ($_POST['apellidop']);
                $apellidom = ($_POST['apellidom']);
                $razonvisita = ($_POST['razonvisita']);
                $numcodqr = ($_POST['numcodqr']);
                $query="UPDATE visitantes SET nombre='$nombre',apellidop='$apellidop',apellidom='$apellidom', razonvisita='$razonvisita', numcodqr='$numcodqr' where id='$id'";
                $resultado=$conex->query($query);
                   if($resultado){
                       header ('Location: ../dashboard.php');
                   }else{
                       echo "modificacion  no exitosa";
                    }
            }
        }
?>