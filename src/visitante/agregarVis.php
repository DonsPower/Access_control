<?php
    //TODO: Cuando se haga el redireccionamiento redireccionar al sahboar en vez del index
    //importamos la clase auth
    require_once '../clases/conexion.Class.php';
    require_once '../clases/authController.Class.php';
    require_once "../clases/adminController.Class.php";
    session_start();
    //creamos el objeto cliente
    $auth=new auth;
    $admin=new admin;
    $location="../dashboar.php";
    if (isset($_SESSION['nombre'])){
        $cliente = $_SESSION['nombre'];
            //Consultamos datos del administrador para obtenerlos en una tabla.
            $row=$admin->getAdmin();
            //Enviamos el tiempo y si pasan ciertos minutos lo redireccionamos
            if(isset($_SESSION['tiempo'])){
                echo $auth-> lifeSession($_SESSION['tiempo'],$location );
            } else {
                //Activamos sesion tiempo con cualquier uso de la pagina.
                $_SESSION['tiempo'] = time();
           } 
    }else{
        header('Location: ../index.php');
        die();
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Agregar-Visitante</title>
        <!--CSS-->
        <link rel="stylesheet" href="lib/alertifyjs/css/alertify.css">
    <link rel="stylesheet" href="lib/alertifyjs/css/themes/default.css">
    <!--JS-->
    
    <script src="lib/alertifyjs/alertify.js"></script>
    <script src="js/admin.js"></script>
</head>
<body>
      <!--tituto-->
      <div class="container">
      <h4>
        <?php echo $_SESSION['tipo']?>
      </h4>
      <hr>
    </div>
    <div class="container form1" >
    <div style="margin-bottom: 30px; margin-top:10px;">
    <caption>
        <div class="titulos "><h2>Almacenar visitante</h2></div>
    </caption>
    </div>
    
        <div class="row">
            <div class="col-4 col-sm-4"><input type="text" name="name" id="name" REQUIRED placeholder="Nombre"></div>
            <div class="col"><input type="text" name="apellidoP" id="apellidoP" REQUIRED placeholder="Apellido paterno"></div>
            <div class="col"><input type="text" name="apellidoM" id="apellidoM" REQUIRED placeholder="Apellido materno"></div>
        </div>
     
       
        <div class="row">
            <div class="col"><input type="text" REQUIRED class="col" name="razon" id="razon" placeholder="Razón de la visita"></div>
         </div>
        <div class="row">
            <div class="col"><input type="text"   REQUIRED  name="codigoqr" id="codigoqr"  placeholder="Numero de codigo QR"></div>
          
        </div>
        <div class="container">
            <button  type="button" id="registrarVis" class="btn btn-success" style="width: 100px;">Registrar</button>
            <button type="button" class="btn btn-danger" style="width: 100px; "><a href="dashboard.php">Regresar</a></button>
        </div>
    </div>
   
</body>
</html>