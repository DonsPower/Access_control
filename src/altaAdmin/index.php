<?php 
  session_start();
 
  
  
?>
 <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
       <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
      <meta name="viewport" content="width=device-width. initial-scale=1">
<title>Lista de Administradores </title>
</head>
<body>

    <div class="container">
     <br>
      
      <h2 class="text-center">Lista de Administradores</h2>
    <br>
    <br>


<br>
<br>
<table class="table table-hover" class="row table-responsive">
  <thead>
    <tr>
      <th scope="col">ID</th>
      <th scope="col">NOMBRE</th>
      <th scope="col">PUESTO</th>
      <th scope="col">ÁREA</th>
      <th scope="col">TIPO</th>
      <th scope="col">CORREO</th>
      <th scope="col">CLAVE </th>
      <th scope="col">PREGUNTA</th>
      <th scope="col">RESPUESTA</th>
    </tr>
  </thead>
  <tbody>
    <!--Mostrar los registros de la BD -->
  
      <?php
    include("../../database/con_db.php");
    $sql="SELECT * FROM administradores";
    $resultado=mysqli_query($conex,$sql);
    while($row=mysqli_fetch_array($resultado)){
      ?>   
         
      <tr>
          <td><?php echo $row['id'];?> </td>
          <td><?php echo $row['name'];?> <?php echo $row['ApellidoPAdm'];?> <?php echo $row['ApellidoMFAdm'];?></td>
          <td><?php echo $row['Puesto'];?></td>
          <td><?php echo $row['AreaAdm'];?></td>
          <td><?php echo $row['Tipo'];?></td>
          <td><?php echo $row['email'];?></td>
          <td><?php echo $row['TrabajadorAdm'];?></td>
          <td><?php echo $row['PreguntaS'];?></td>
          <td><?php echo $row['RespuestaS'];?></td>
          <td><a href="altaAdmin/Update1.php?id=<?php echo $row ['id']; ?>" class="btn btn-success" > Editar </a></td>
          <td><a href="altaAdmin/delete.php?id=<?php echo $row['id']; ?>" class="btn btn-danger" > Borrar </a></td>


      </tr>
    <?php  } ?>

  </tbody>
</table>

</body>
</html>