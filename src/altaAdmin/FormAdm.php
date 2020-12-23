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
       
<form method ="post">
<div class="form-row p-2 text-center">
 <div class="form-group">
    <input type="text" size=60 style="width:770px"  REQUIRED class="form-control" name="name" id="name" placeholder="Nombre">
 </div>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp

<div class="form-row p-1">
    <div class="form-group col-md-5">

        <input type="text" size=60 style="width:310px" REQUIRED class="form-control" name="ApellidoPAdm" id="ApellidoPAdm" placeholder="Apellido Paterno">
</div>

<div class="form-group col-md-5">
    
    <input type="text" size=60 style="width:300px" REQUIRED class="form-control" name="ApellidoMFAdm" id="ApellidoMFAdm" placeholder="Apellido Materno">
</div>

<div class="form-group col-md-5">
    <input type="text" size=60 style="width:300px" REQUIRED  class="form-control" name="Puesto" id="Puesto" placeholder="Puesto">
</div>

<div class="form-group col-md-5">
   
    <select name="AreaAdm" class="form-control " REQUIRED style="width:300px" font-size: "10px">
        <option value="Seleccione el Area" > Seleccione el Area </option>
        <option value="Sistemas" > Sistemas </option>
        <option value="Ambiental" > Ambiental </option>
    </select>
</div>

<div class="form-group col-md-5">
    
    <input type="email" size=60 style="width:300px"  REQUIRED class="form-control" name="email" id="email" placeholder="Correo">
</div>

<div class="form-group col-md-5">
    
    <input type="text"  size=60 style="width:300px" REQUIRED class="form-control" name="TrabajadorAdm" id="TrabajadorAdm" placeholder="Clave de Trabajador">
</div>


<div class="form-group col-md-5">
   
    <input type="text" size=60 style="width:300px" REQUIRED class="form-control"  name="contraseña" id="contraseña" placeholder="contraseña">
</div>
  
<div class="form-group col-md-5">
   
    <select name="Tipo" class="form-control " style="width:300px" font-size: "10px">
        <option value="Seleccione el Administrador" > Seleccione el Tipo de Administrador </option>
        <option value="AdministradorGlobal" > Administrador General </option>
        <option value="AdministradorArea" > Administrador de Area </option>
    </select>
</div>

    
<div class="form-row p-2">
    <div class="form-group">
       
     <input type="text" size=60 style="width:770px"  REQUIRED class="form-control"  name="PreguntaS" id="PreguntaS"  placeholder="Pregunta de Seguridad">

    <div class="form-row p-2">
        <div class="form-group">
        
        <input type="text" size=60 style="width:770px"  REQUIRED  class="form-control"  name="RespuestaS" id="RespuestaS"  placeholder="Pregunta de Seguridad">
    </div>

        </div> 
        </div>
</div> 

</div>

      <input type="submit" name="register"  value="Continuar" class="btn btn-primary  btn-lg align="center style="width:380px"  > 
      <td><a href="index.php"  align="center" class="btn btn-danger  btn-lg" style="width:380px" > Regresar </a></td>

</div>
</form>

</div></div>

</body>
</html>


<?php
include("con_db.php");
include ("Registrar.php");
?>