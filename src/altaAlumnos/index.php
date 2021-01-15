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
       <script type="text/javascript" src="js/alumno.js"></script>
       <script type="text/javascript" src="js/modal.js"></script>
       

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
      <th scope="col">Código QR </th>

     
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
        $i=0;
        while($row=mysqli_fetch_array($resultado)){
         
          $i+=1;
            //Concatenamos datos para editarlos. los pasamos a la funcion editarDatos
            $datos=$row['id']."||".$row['nombreAlumno']."||".$row['apellidoPatAlumno']."||".$row['apellidoMatAlumno']."||".$row['carrera']
                             ."||".$row['boleta']."||".$row['telefonoMovil']."||".$row['telefonoFijo']."||".$row['telefonoPersonal']
                             ."||".$row['emailAlumno']."||".$row['NSS']."||".$row['numcodqr'];
                              //Concatenamos para mandarlos a la funcion eliminarADMIN.
            $nombre=$row['nombreAlumno']." ".$row['apellidoPatAlumno']." ".$row['apellidoMatAlumno'];
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
          <td><?php echo $row['numcodqr'];?></td>
          
         
          <td><button type="button" id="editar" class="btn btn-success" onclick="editarDatosAlumnos('<?php echo $datos; ?>')"><i class="fas fa-user-edit"></i></button></td>
                <td><button type="button" id="eliminar" class="btn btn-danger" onclick="eliminarAlumno(<?php echo $row['id']; ?>,'<?php echo $nombre ?>')"><i class="fas fa-user-times"></i> </button></td>


      </tr>
    <?php  } ?>
    

  </tbody>
</table>

         <!--Modal cuando se activa editar-->
        <div class="modal" id="myModal" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title">Editar administrador</h5>
              
                <span  class="close1 close">&times; </span>
              
            </div>
            <div class="modal-body">
              <div class="container-fluid">
              
                <div class="row">
                  <div class="col-4 col-sm-4">Nombre<input type="text" name="name" id="nombreAlumno"></div>
                  <div class="col">Apellido paterno<input type="text" name="" id="apellidoPatAlumno"></div>
                  <div class="col">Apellido materno<input type="text" name="" id="apellidoMatAlumno"></div>
                  
                </div>
                <div class="row">
                  <div class="col">carrera<input type="text" name="" id="carrera"></div>
                  <div class="col">boleta <input type="text" name="" id="boleta"></div>
                </div>

                <div class="row">
                  <div class="col">telefonoMovil<input type="text" name="" id=telefonoMovil></div>
                  <div class="col">telefonoFijo<input type="text" name="" id="telefonoFijo"></div>
                </div>  

                <div>
                  <div class="col">telefonoPersonal <input type="text" name="" id="telefonoPersonal"></div>
                  
                </div>

                <div class="row">
                  <div class="col"> email<input type="text" name="" id="emailAlumno"></div>
                  <div class="col">NSS<input type="text" name="" id="NSS"></div>
                </div>
                <div>
                  <div class="col">Código QR <input type="text" name="" id="numcodqr"></div>
                  
                </div>
                
              </div>
            </div>
            <div class="modal-footer">
            <div class="col-4 col-sm-4"> <input type="text" name="idperson" id="idAdmin" disabled style="visibility: hidden;"></div>
              <button type="button" class="btn btn-primary" id="editActualizar">Guardar cambios</button>
             
            </div>
          </div>
        </div>
      </div>
</body>
</html>
