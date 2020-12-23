<?php

include("con_db.php");

$id=$_REQUEST['id'];



  
        $query="SELECT * FROM administradores where id='$id'";
        $resultado=$conex->query($query);
        $row=$resultado->fetch_assoc();





?>



<!DOCTYPE html>
<html>
<head>
        <title>Registrar Administrador</title>
        <meta charset="utf-8">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
</head>
<body>
<h2 align="center"> Alta de Administradores </h2>
<div class="container">
    <div class="row justify-content-center">
<form action="actualizar.php" method="post">

<div class="form-row p-2 text-center">

 <div class="form-group">  

 	<input type="hidden" size=60 style="width:770px"  REQUIRED class="form-control" name="id" id="id" placeholder="id"  value ="<?php echo $row ['id']; ?>" > 
 <input type="text" size=60 style="width:770px"  REQUIRED class="form-control" name="name" id="name" placeholder="Nombre"  value ="<?php echo $row ['name']; ?>"> 
 </div>

<div class="form-row p-1">
    <div class="form-group col-md-5">

        <input type="text" size=60 style="width:310px" REQUIRED class="form-control" name="ApellidoPAdm" id="ApellidoPAdm" placeholder="Apellido Paterno" value ="<?php echo $row ['ApellidoPAdm']; ?>">
</div>

<div class="form-group col-md-5">
    
    <input type="text" size=60 style="width:300px" REQUIRED class="form-control" name="ApellidoMFAdm" id="ApellidoMFAdm" placeholder="Apellido Materno" value ="<?php echo $row ['ApellidoMFAdm']; ?>">
</div>

<div class="form-group col-md-5">
    <input type="text" size=60 style="width:300px" REQUIRED  class="form-control" name="Puesto" id="Puesto" placeholder="Puesto" value ="<?php echo $row ['Puesto']; ?>">
</div>

<div class="form-group col-md-5">
   
    <select name="AreaAdm" class="form-control " REQUIRED style="width:300px" font-size: "10px" value ="<?php echo $row ['AreaAdm']; ?>">
       
        <option value="Sistemas" > Sistemas </option>
        <option value="Ambiental" > Ambiental </option>

        <?php
              if($row['AreaAdm']=="Sistemas"){
              	echo '<option value="Sistemas" selected> Sistemas </option>';
              }else{
              	echo '<option value="Sistemas" >Sistemas </option>';
              } if($row['AreaAdm']=="Ambiental"){
              	echo '<option value="Ambiental" selected> Ambiental </option>';
              }else{
              	echo '<option value="Ambiental" >Ambiental </option>';
              }
       ?>
    </select>
</div>

<div class="form-group col-md-5">
    
    <input type="email" size=60 style="width:300px"  REQUIRED class="form-control" name="email" id="email" placeholder="Correo" value ="<?php echo $row ['email']; ?>">
</div>

<div class="form-group col-md-5">
    
    <input type="text"  size=60 style="width:300px" REQUIRED class="form-control" name="TrabajadorAdm" id="TrabajadorAdm" placeholder="Clave de Trabajador" value ="<?php echo $row ['TrabajadorAdm']; ?>">
</div>


<div class="form-group col-md-5">
   
    <input type="text" size=60 style="width:300px" REQUIRED class="form-control"  name="contraseña" id="contraseña" placeholder="contraseña" value ="<?php echo $row ['contraseña']; ?>">
</div>
  
<div class="form-group col-md-5">
  
    <select name="Tipo" class="form-control " style="width:300px" font-size: "10px" value ="<?php echo $row ['Tipo']; ?>">
       <?php
              if($row['Tipo']=="AdministradorGlobal"){
              	echo '<option value="AdministradorGlobal" selected> Administrador General </option>';
              }else{
              	echo '<option value="AdministradorGlobal" >Administrador General </option>';
              } if($row['Tipo']=="AdministradorArea"){
              	echo '<option value="AdministradorArea" selected> Administrador Area </option>';
              }else{
              	echo '<option value="AdministradorArea" >Administrador Area </option>';
              }
       ?>
        
        
    </select>
</div>

    
<div class="form-row p-2">
    <div class="form-group">
       
     <input type="text" size=60 style="width:770px"  REQUIRED class="form-control"  name="PreguntaS" id="PreguntaS"  placeholder="Pregunta de Seguridad" value ="<?php echo $row ['PreguntaS']; ?>">

    <div class="form-row p-2">
        <div class="form-group">
        
        <input type="text" size=60 style="width:770px"  REQUIRED  class="form-control"  name="RespuestaS" id="RespuestaS"  placeholder="Pregunta de Seguridad" value ="<?php echo $row ['RespuestaS']; ?>">
    </div>

        </div> 
        </div>
</div> 

</div>

      <input type="submit" name="register"  value="Actualizar " class="btn btn-primary  btn-lg align="center style="width:380px"  > 

	  <td><a href="../dashboard.php"  align="center" class="btn btn-danger  btn-lg" style="width:380px" > Regresar </a></td>

</div>
</form>
</form>

</div></div>

 
</form>