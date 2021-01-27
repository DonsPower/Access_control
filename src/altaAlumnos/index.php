<?php
    //TODO: Cuando se haga el redireccionamiento redireccionar al sahboar en vez del index
    //importamos la clase auth
    require_once '../clases/conexion.Class.php';
    require_once '../clases/authController.Class.php';
    require_once "../clases/adminController.Class.php";
    require_once "../clases/alumnosController.Class.php";
    session_start();
    //creamos el objeto cliente
    $auth=new auth;
    $alum=new alumno;
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
       <script type="text/javascript" src="js/alumno.js"></script>
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
            <li class="breadcrumb-item active" aria-current="page">Lista de Alumnos</li>
        </ol>
        </nav>
      <hr>
    </div>
    
  <!--Boton buscar-->
  <div class="container">
    <a href="dashboard.php"><button type="button"  class="btn btn-info" style="float:center; width:20%; margin-left:2px; margin-bottom:10px; ">  Regresar </button></a>
    </div>
  <div class="container">
        <button type="button" id="enviarAlumno" class="btn btn-success" style=" float: right; margin-left:2px">Buscar</button>
        <input type="text" id="buscarAlumno" style="width: 20%; height: 1px; float: right; " maxlength="30" placeholder="Buscar usuario" aria-label="Buscar usuario">
    </div>
    <div>
    
    <div>
    
        
    <div class="container">
    <caption>
        <div class="titulos "><h2>Lista de Alumnos</h2></div>
    </caption>
     <div class=" table-responsive-md">
    <table class="table table-hover">
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">Nombre</th>
      <th scope="col">Carrera</th>
      <th scope="col">Boleta</th>
      <th scope="col">Teléfono Móvil</th>
      <th scope="col">Teléfono Fijo</th>
      <th scope="col">Teléfono Personal</th>
      <th scope="col">Correo</th>
      <th scope="col">NSS </th>
      <th scope="col">Código QR </th>
      <th scope="col">Editar </th>
      <th scope="col">Borrar</th>
     
    </tr>
   </thead>
  
  <tbody id="salida">
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
        $sql="SELECT * FROM alumnos $where  ORDER BY id DESC LIMIT 0,10";
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
      <td ><?php echo $i;?> </td>
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
          <!--paginacion-->
                <div style="float: right;">
                    <nav aria-label="Page navigation example">
                    <ul class="pagination">
                     
                      <?php
                        $i=1;
                        $total= $alum->getDataAlumno();
                        $celdas=ceil($total/10);
                        while($i<=$celdas){
                          ?>
                            <li class="page-item"><a class="page-link" href="#" onclick="paginacion2(<?php echo $i; ?>)"><?php echo $i; ?></a></li>
                            
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
                  <div class="col">Apellido Paterno<input type="text" name="" id="apellidoPatAlumno"></div>
                  <div class="col">Apellido Materno<input type="text" name="" id="apellidoMatAlumno"></div>
                  
                </div>
                <div class="row">
                
                    Carrera
                <select id="carrera" name="carrera"  REQUIRED>
                    <option value="Seleccione la Carerra" >Seleccione Programa Académico</option>
                    <option value="Ingenieria en Sistemas Computacionales">Ingeniería en Sistemas Computacionales</option>
                    <option value="Ingenieria Ambiental" >Ingeniería Ambiental</option>
                    <option value="Ingenieria Mecatronica" >Ingenieria Mecatrónica</option>
                    <option value="Ingenieria Metalurgica" >Ingeniría Metalurgíca</option>
                    <option value="Ingenieria en Alimentos" >Ingeniería en Alimentos</option>
                </select>
                  <div class="col">boleta <input type="text" name="" id="boleta"></div>
                </div>

                <div class="row">
                  <div class="col">telefonoMovil<input type="text" name="" id="telefonoMovil"></div>
                  <div class="col">telefonoFijo<input type="text" name="" id="telefonoFijo"></div>
                </div>  

                <div>
                  <div class="col">Teléfono Personal <input type="text" name="" id="telefonoPersonal"></div>
                  
                </div>

                <div class="row">
                  <div class="col">Correo<input type="text" name="" id="emailAlumno"></div>
                  <div class="col">NSS<input type="text" name="" id="NSS"></div>
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
