<?php 
    session_start();
    //creamos variable cliente log y si no esta log lo redireccionamos 
    //creamos variable cliente logueado y si no esta logueado lo redireccionamos 
    require_once '../clases/authController.Class.php';
    //creamos el objeto cliente
    $auth=new auth;
    if (isset($_SESSION['nombre'])){
        $cliente = $_SESSION['nombre'];
        $location="../index.php";
            //Enviamos el tiempo y si pasan ciertos minutos lo redireccionamos
            if(isset($_SESSION['tiempo'])){
                echo $auth-> lifeSession($_SESSION['tiempo'],$location );
            } else {
                //Activamos sesion tiempo con cualquier uso de la pagina.
                $_SESSION['tiempo'] = time();
           } 
    }else{
        header('Location: ./index.php');
        die();
    }
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
            $consulta = "INSERT INTO visitantes (nombre,apellidop,apellidom,razonvisita,numcodqr) 
                        VALUES('$nombre','$apellidop','$apellidom','$razonvisita','$numcodqr')";
            $resultado = mysqli_query($conex,$consulta);
            echo $resultado;
            if ($resultado){
				?>
				   <h3 class="ok" align="center"> Administrador Registrado Exitosamente</h3>
				<?php
				header ('Location: index.php');
			}else{
				?>
				   <h3 class="bad" align="center"> Ocurrio un error</h3>
				<?php
			}
		}else{
				?>
				   <h3 class="bad" align="center"> Complete todos los campos</h3>
				<?php
		}

	}
?>
<!DOCTYPE html>
<html>
<head>
        <title>Registrar visitante</title>
        <meta charset="utf-8">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
</head>
    <body>
        <div class="container mt-5">
        <h2 > Alta de Visitante </h2>
        </div>
        <div class="container">
            <div class="row justify-content-center"> 
                <form method ="post">
                    <div class="form-row p-2 text-center">
                        <div class="form-group">
                            <input type="text" size=60 style="width:770px"  REQUIRED class="form-control" name="nombre" id="nombre" placeholder="Nombre">
                        </div>
                        <div class="form-row p-1">
                            <div class="form-group col-md-5">
                                <input type="text" size=60 style="width:310px" REQUIRED class="form-control" name="apellidop" id="apellidop" placeholder="Apellido Paterno">
                        </div>
                        <div class="form-group col-md-5">
                            <input type="text" size=60 style="width:300px" REQUIRED class="form-control" name="apellidom" id="apellidom" placeholder="Apellido Materno">
                        </div>
                        <div class="form-row p-2">
                            <div class="form-group"> 
                                <textarea REQUIRED class="form-control" cols="30" rows="10" name="razonvisita" id="razonvisita"  placeholder="Razón de la visita"></textarea>
                                <div class="form-row p-2">
                                        <input type="text" size=60 style="width:770px"  REQUIRED  class="form-control"  name="numcodqr" id="numcodqr"  placeholder="Código QR">      
                                </div> 
                            </div>
                            </div> 
                        </div>
                        <div class="container">

                       
                    <input type="submit" name="register"  value="Continuar" class="btn btn-primary  btn-lg align="center   > 
                    <a href="index.php"  align="center" class="btn btn-danger  btn-lg"  > Regresar </a>
                        </div>
                </div>
            </form>
        </div>
    </div>
</body>
</html>

