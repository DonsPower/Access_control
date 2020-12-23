<?php 

    session_start();
    require_once '../clases/authController.Class.php';
    if(isset($_SESSION['tiempo'])){
      $auth=new Auth;
      $location="../index.php";
      echo $auth-> lifeSession($_SESSION['tiempo'],$location );
    } else {
     //Activamos sesion tiempo.
      $_SESSION['tiempo'] = time();
    }
    //creamos variable cliente log y si no esta log lo redireccionamos 
    if (isset($_SESSION['nombre'])){
        $cliente = $_SESSION['nombre'];
       
    }else{
        header('Location: ../index.php');
     die();
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
       <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
      <meta name="viewport" content="width=device-width. initial-scale=1">
<title>Alta de población flotante </title>
</head>
<body>
 
    <div class="container">
     <br>
      
      <h2 class="text-center">Lista de visitantes</h2>
      <hr>
    <br>
    <br>
    <div class="container">


    <div class="row mx-md-n5">
      <!--
      <div class="col px-md-5 mb-4"> 
        <a href="formVisitante.php"  align="center" class="btn btn-success  btn-lg" style="width:380px" >  Nuevo Visitante</a>
      </div>-->
      <div class="col px-md-5"> 
        <form method="POST">
        <div class="input-group mb-3" style="float:right; width:400px">
          <input type="text" name="buscarUser" REQUIRED class="form-control" placeholder="Nombre del usuario" aria-label="Recipient's username" aria-describedby="button-addon2">
          <div class="input-group-append">
            <button class="btn btn-outline-secondary" type="submit" name="buscar" >Buscar usuario</button>
          </div>
        </div>
        </form>
      </div>
    </div>

    </div>
    
<table class="table table-hover" class="row table-responsive">
  <thead>
    <tr>
      <th scope="col">ID</th>
      <th scope="col">NOMBRE</th>
      <th scope="col">RAZON DE VISITA</th>
      <th scope="col">NUMERO DE CODIGO QR</th>
     
    </tr>
  </thead>
  <tbody>
    <!--Mostrar los registros de la BD -->
  
      <?php
     
      
        include("../../database/con_db.php");
        if(!empty($_POST['buscarUser'])) $nombre=$_POST['buscarUser'];
        $where="";
        if(isset($_POST['buscar'])) {
          $where="where nombre like '".$nombre."%'";
        }
        $limite_pagina_mostrar=5;
        
        //$desde=($pagina-1) * 
        $sql="SELECT * FROM visitantes $where ";
        $resultado=mysqli_query($conex,$sql);
        $num_total_consultas= mysqli_num_rows($resultado);
        
        while($row=mysqli_fetch_array($resultado)){
      ?>   
         
      <tr>
          <td><?php echo $row['id'];?> </td>
          <td><?php echo $row['nombre'];?> <?php echo $row['apellidop'];?> <?php echo $row['apellidom'];?></td>
          <td><?php echo $row['razonvisita'];?></td>
          <td><?php echo $row['numcodqr'];?></td>
         
          <td><a href="altaVisitantes/actualizar.php?id=<?php echo $row ['id']; ?>" class="btn btn-success" > Editar </a></td>
          <td><a href="altaVisitantes/deletevisitante.php?id=<?php echo $row['id']; ?>" class="btn btn-danger" > Borrar </a></td>
      </tr>
    <?php  } ?>
  </tbody>
</table>
</body>
</html>
