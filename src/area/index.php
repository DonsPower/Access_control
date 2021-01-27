<?php
    //TODO: Cuando se haga el redireccionamiento redireccionar al sahboar en vez del index
    //importamos la clase auth
    require_once '../clases/conexion.Class.php';
    require_once '../clases/authController.Class.php';
    require_once "../clases/adminController.Class.php";
    require_once "../clases/areaController.Class.php";
    session_start();
    //creamos el objeto cliente
    $auth=new auth;
    $area=new area;
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
       
       <meta name="viewport" content="width=device-width. initial-scale=1">
       <script type="text/javascript" src="js/area.js"></script>
       <script type="text/javascript" src="js/modal.js"></script>
        <!--CSS-->
      <link rel="stylesheet" href="lib/alertifyjs/css/alertify.css">
      <link rel="stylesheet" href="lib/alertifyjs/css/themes/default.css">
      <!--JS-->
      <script src="lib/alertifyjs/alertify.js"></script>
      <script src="lib/alertifyjs/alertify.js"></script>
       
       

<title>Alumnos </title>
 <!--CSS-->
 <link rel="stylesheet" href="lib/alertifyjs/css/alertify.css">
    <link rel="stylesheet" href="lib/alertifyjs/css/themes/default.css">
    <!--JS-->
    <script type="text/javascript" src="js/funcion.js"></script>
    <script src="lib/alertifyjs/alertify.js"></script>
  </head>
  <body>
  <div class="container">
      <h4>
        <?php echo $_SESSION['tipo']?>
      </h4>
      <nav aria-label="breadcrumb" style="margin-top: 20px;">
        <ol class="breadcrumb">
            <li class="breadcrumb-item">Inicio</li>
            <li class="breadcrumb-item active" aria-current="page">Lista de áreas</li>
        </ol>
        </nav>
      <hr>
    </div>
    
  <!--Boton buscar-->
  <div class="container">
    <a href="dashboard.php"><button type="button"  class="btn btn-info" style="float:center; width:20%; margin-left:15%; margin-bottom:10px; ">  Regresar </button></a>
    </div>
    
    <div>
    
    <div>
    
        
    <div class="container" style="width: 80%; margin-left:200px;">
    <caption>
        <div class="titulos "><h2>Lista de áreas</h2></div>
    </caption>
    
     <div class=" table-responsive-md">
    <table class="table table-hover">
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">Nombre de la área</th>
      <th scope="col">Editar área</th>

    </tr>
   </thead>
  
  <tbody id="salida">
    <!--Mostrar los registros de la BD -->
      <?php
       $i=0;
       $resultado=$area->getAreas();
       while($row=$resultado->fetch(PDO::FETCH_ASSOC))
       {
           $i+=1;
           //Concatenamos datos para editarlos. los pasamos a la funcion editarDatos
           $datos=$row['id']."||".$row['nombreArea'];
           ?>   
      <tr>
      <td ><?php echo $i;?> </td>
          <td><?php echo $row['nombreArea'];?> </td>
          <td><button type="button" id="editar" class="btn btn-success" onclick="editarDatosArea('<?php echo $datos; ?>')"><i class="fas fa-user-edit"></i></button></td>
      </tr>
    <?php  } ?>
      </tbody>
    </table>
          <!--paginacion-->
                <div style="float: right; margin-right:25%;">
                    <nav aria-label="Page navigation example">
                    <ul class="pagination" ">
                     
                      <?php
                        $i=1;
                        $total= $area->getArea();
                        $celdas=ceil($total/10);
                        while($i<=$celdas){
                          ?>
                            <li class="page-item"><a class="page-link" href="#" onclick="paginacion5(<?php echo $i; ?>)"><?php echo $i; ?></a></li>
                            
                          <?php
                          $i+=1;
                        }
                      ?>                 
                    </ul>
                  </nav>
                </div>

        </div>
        </div>

         <!--Modal cuando se activa editar-->
        <div class="modal" id="myModal" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title">Editar Alumno</h5>
              
                <span  class="close1 close">&times; </span>
              
            </div>
            <div class="modal-body">
              <div class="container-fluid">
              
                <div class="row">
                  <div class="col-4 col-sm-4">Nombre<input type="text" name="name" id="nombreAlumno"></div>
                </div>
              </div>
            </div>
            <div class="modal-footer">
            <div class="col-4 col-sm-4"> <input type="text" name="idperson" id="idAdmin" disabled style="visibility: hidden;"></div>
              <button type="button" class="btn btn-primary" id="editActualizarAlu">Guardar cambios</button>
             
            </div>
          </div>
        </div>
      </div>
</body>
</html>