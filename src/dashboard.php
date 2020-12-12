<?php 
    session_start();
    //importamos la clase auth
    require_once 'clases/authController.Class.php';
    //creamos el objeto
    $auth=new auth;
    $location="index.php";
    print_r($_SESSION);
    //creamos variable cliente logueado y si no esta logueado lo redireccionamos 
    if (isset($_SESSION['nombre'])){
        $cliente = $_SESSION['nombre'];
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
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Administradores</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
   
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
     <a href="index.php">Control de acceso</a>
      <div class="navbar-nav">
        <a class="nav-item nav-link" href="#">Homes</a>
        <a class="nav-item nav-link" href="#">fEATURE</a>
        <!--Cambiar por onkeypress="myScript"-->
        <a class="nav-item nav-link" href="closeSeasson.php">Close Seasson</a>

       
      </div>
    </nav>
    
    <h1>Bienvenido <?php echo $_SESSION['nombre'];?></h1>
    <a href="altaAdmin/index.php"><input type="button" value="Alta de administradores globales y por área"></a>
    <a href="altaVisitantes/index.php"><input type="button" value="Alta de visitantes"></a>
    <a href="altaVisitantes/authVist.php"><input type="button" value="URL"></a>
    <a href="sessionclose.php"><input type="button" value="Cerrar sesión"></a>
</body>
</html>