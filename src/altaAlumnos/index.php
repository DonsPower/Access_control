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
       <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
       <meta name="viewport" content="width=device-width. initial-scale=1">

<title>Alumnos </title>
  </head>
  <body>
   
    
    <div class="container">
      
      
      <div class="col px-md-5"> 
        <form method="POST">
          <div class="input-group mb-3">
              <input type="text" name="buscarUser" REQUIRED class="form-control" placeholder="Nombre del usuario" aria-label="Recipient's username" aria-describedby="button-addon2">
          <div class="input-group-append">
              <button class="btn btn-outline-secondary" type="submit" name="buscar">Buscar usuario</button>
            </div>
          </div>
       </form>
     </div>
     
      
    </div>
    
<table class="table table-hover" class="row table-responsive">
  <thead>
    <tr>
      <th scope="col">ID</th>
      <th scope="col">NOMBRE</th>
      <th scope="col">CARRERA</th>
      <th scope="col">BOLETA</th>
      <th scope="col">TELEFONO MOVIL</th>
      <th scope="col">TELEFONO FIJO</th>
      <th scope="col">TELEFONO PERSONAL</th>
      <th scope="col">CORREO</th>
      <th scope="col">NSS </th>
     
    </tr>
   </thead>
  
  <tbody>
    <!--Mostrar los registros de la BD -->
      <?php
       include("../../database/con_db.php");
       if(!empty($_POST['buscarUser'])) $nombreAlumno=$_POST['buscarUser'];
       $where="";
       if(isset($_POST['buscar'])) {
         $where="where nombreAlumno like '".$nombreAlumno."%'";
       }
       $pagina=5;
        
        //$desde=($pagina-1) * 
        $sql="SELECT * FROM alumnos $where ";
        $resultado=mysqli_query($conex,$sql);
        while($row=mysqli_fetch_array($resultado)){
      ?>   
        
  
      <tr>
          <td><?php echo $row['id'];?> </td>
          <td><?php echo $row['nombreAlumno'];?> <?php echo $row['apellidoPatAlumno'];?> <?php echo $row['apellidoMatAlumno'];?></td>
          <td><?php echo $row['carrera'];?></td>
          <td><?php echo $row['boleta'];?></td>
          <td><?php echo $row['telefonoMovil'];?></td>
          <td><?php echo $row['telefonoFijo'];?></td>
          <td><?php echo $row['telefonoPersonal'];?></td>
          <td><?php echo $row['emailAlumno'];?></td>
          <td><?php echo $row['NSS'];?></td>
          
         
          <td><a href="actualizar.php?id=<?php echo $row ['id']; ?>" class="btn btn-success" > Editar </a></td>
          <td><a href="deleteAlumno.php?id=<?php echo $row['id']; ?>" class="btn btn-danger" > Borrar </a></td>


      </tr>
    <?php  } ?>
    

  </tbody>
</table>

</body>
</html>
