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
           
    }else{
        header('Location: ../index.php');
        die();
    }
?>


<!DOCTYPE html>
<html>
<head>
        <title>Generar Reporte</title>
        <meta charset="utf-8">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

</head>
    <body>
    <div class="container" >
    <div class="col-sm-12" style="margin-top:10%; text-align: center;">
  <div class="card" style="background-color:#EAEDED">
  <div class="mb-3">
  <br>
  <h1 vertical-align:middle>   Reportes </h1>

  <br>
  <h3 vertical-align:middle> Seleccione el Tipo de Reporte </h3>
  <br>


    <a href="reporteIncendio.php" class="btn btn btn-primary" > Reporte General </a> 
    <a href="selectorIncendioAreas.php" class="btn btn btn-primary" > Reporte por Áreas </a> 
     </body>
</html>