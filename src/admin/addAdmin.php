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
    $location="../index.php";
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
    <title>Control-addAdministrador</title>
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
        <div class="titulos "><h2>Almacenar nuevo administrador</h2></div>
    </caption>
    </div>
    
        <div class="row">
            <div class="col-4 col-sm-4"><input type="text" name="name" id="name" REQUIRED placeholder="Nombre"></div>
            <div class="col"><input type="text" name="apellidoP" id="apellidoP" REQUIRED placeholder="Apellido paterno"></div>
            <div class="col"><input type="text" name="apellidoM" id="apellidoM" REQUIRED placeholder="Apellido materno"></div>
        </div>
        <div class="row">
            <div class="col"><input type="text" id="puesto"name="puesto"  required  id="puesto" placeholder="Puesto"></div>
            <div class="col" style="margin-top: 10px;"> 
                <select name="areaAdministra" class="col" id="area" required="required" >
                    <option value="" selected="selected">Seleccione el área que administra</option>
                    <option value="Sistemas" >Sistemas </option>
                    <option value="Ambiental" >Ambiental </option>
                </select>
            </div>
            <div class="col" style="margin-top: 10px;">
                <select name="tipo" required="required" id="tipo">
                    <option value="" selected="selected">Seleccione el tipo de administrador</option>
                    <option value="AdministradorGlobal" >AdministradorGlobal</option>
                    <option value="AdministradorArea" >AdministradorArea</option>
                </select>
             </div>
        </div>
       
        <div class="row">
            <div class="col"><input type="text" REQUIRED class="col" name="clave" id="clave" placeholder="Clave de Trabajador"></div>
            <div class="col"><input type="email"  REQUIRED  name="email" id="email" placeholder="Correo"></div>
            <div class="col"><input type="password" REQUIRED name="password" id="password" placeholder="Contraseña"></div> 
        </div>
        <div class="row">
            <div class="col"><input type="text"   REQUIRED  name="preguntaSeg" id="preguntaSeg"  placeholder="Pregunta de seguridad"></div>
           <div class="col"><input type="text" REQUIRED   name="PreguntaSeg" id="respuestaSeg"  placeholder="Respuesta de seguridad"></div>
        </div>
        <div class="container">
            <button  type="button" id="registrarAdmin" class="btn btn-success" style="width: 100px;">Registrar</button>
            <button type="button" class="btn btn-danger" style="width: 100px; "><a href="dashboard.php">Regresar</a></button>
        </div>
    </div>
    
   
    
   
</body>
</html>
