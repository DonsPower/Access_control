<?php
    //TODO: Cuando se haga el redireccionamiento redireccionar al sahboar en vez del index
    //importamos la clase auth
    require_once '../clases/conexion.Class.php';
    require_once '../clases/authController.Class.php';
    require_once "../clases/adminController.Class.php";
    require_once "../clases/perAcademicoController.Class.php";
    session_start();
    //creamos el objeto cliente
    $auth=new auth;
    $admin=new admin;
    $per=new perAcademico;
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
      <title>Personal Academico </title>
      <!--CSS-->
      <link rel="stylesheet" href="lib/alertifyjs/css/alertify.css">
      <link rel="stylesheet" href="lib/alertifyjs/css/themes/default.css">
      <!--JS-->
      <script type="text/javascript" src="js/funcion.js"></script>
      <script src="lib/alertifyjs/alertify.js"></script>
      <script type="text/javascript" src="js/perAcademico.js"></script>
      <script type="text/javascript" src="js/modal.js"></script>
  </head>
  <body>

  <div class="container">
      <h4>
        <?php echo $_SESSION['tipo']?>
      </h4>
      <nav aria-label="breadcrumb" style="margin-top: 20px;">
        <ol class="breadcrumb">
            <li class="breadcrumb-item">Inicio</li>
            <li class="breadcrumb-item active" aria-current="page">Lista Personal Académico</li>
        </ol>
        </nav>
      <hr>
    </div>
    
    <!--Boton buscar-->
    <div class="container">
    <a href="dashboard.php"><button type="button"  class="btn btn-info" style="float:center; width:20%; margin-left:2px; margin-bottom:10px; ">  Regresar </button></a>
    </div>
    <div class="container">
        <button type="button" id="enviarPerAcademico" class="btn btn-success" style=" float: right; margin-left:2px">Buscar</button>
        <input type="text" id="buscarPeracademico" style="width: 20%; height: 1px; float: right; " maxlength="30" placeholder="Buscar usuario" aria-label="Buscar usuario">
    </div>
    
    <div>
    
        
    <div class="container">
    <caption>
        <div class="titulos "><h2>Lista Personal Académico</h2></div>
    </caption>
     <div class=" table-responsive-md">
    <table class="table table-hover">
  <thead>
    <tr>
   <th scope="col">#</th>
      <th scope="col">Nombre</th>
      <th scope="col">Academia</th>
      <th scope="col">RFC</th>
      <th scope="col">Teléfono</th>
      <th scope="col">Extensión</th>
      <th scope="col">Correo</th>
      <th scope="col">Código QR</th>
      <th scope="col">Editar </th>
      <th scope="col">Borrar</th>
     
    </tr>
  </thead>
  <tbody id="salida">
    <!--Mostrar los registros de la BD -->
  
      <?php
    include("../../database/con_db.php");
    if(!empty($_POST['buscarUser'])) $nombrePerAcademico=$_POST['buscarUser'];
    $where="";
    if(isset($_POST['buscar'])) {
      $where="where nombrePerAcademico like '".$nombrePerAcademico."%'";
    }
    $pagina=5;
     
     //$desde=($pagina-1) * 
     $sql="SELECT * FROM personalacademico $where  ORDER BY id DESC LIMIT 0,10  ";
     $resultado=mysqli_query($conex,$sql);
     $i=0;
     while($row=mysqli_fetch_array($resultado)){
      
       $i+=1;
         //Concatenamos datos para editarlos. los pasamos a la funcion editarDatos
         $datos=$row['id']."||".$row['nombrePerAcademico']."||".$row['apellidoPatPerAcademico']."||".$row['apellidoMatPerAcademico']."||".$row['academia']
                          ."||".$row['RFC']."||".$row['telefono']."||".$row['extension']."||".$row['emailPerAcademico']."||".$row['numcodqr'];
          //Concatenamos para mandarlos a la funcion eliminarPaae.
         $nombre=$row['nombrePerAcademico']." ".$row['apellidoPatPerAcademico']." ".$row['apellidoMatPerAcademico'];
   ?>   
        
  
      <tr>
      <td ><?php echo $i;?> </td>
        <td><?php echo $row['nombrePerAcademico'];?> <?php echo $row['apellidoPatPerAcademico'];?> <?php echo $row['apellidoMatPerAcademico'];?></td>
          <td><?php echo $row['academia'];?></td>
          <td><?php echo $row['RFC'];?></td>
          <td><?php echo $row['telefono'];?></td>
          <td><?php echo $row['extension'];?></td>
          <td><?php echo $row['emailPerAcademico'];?></td>
          <td><?php echo $row['numcodqr'];?></td>
         
          <td><button type="button" id="editar" class="btn btn-success" onclick="editarDatosPerAcademico('<?php echo $datos; ?>')"><i class="fas fa-user-edit"></i></button></td>
                <td><button type="button" id="eliminar" class="btn btn-danger" onclick="eliminarPerAcademico(<?php echo $row['id']; ?>,'<?php echo $nombre ?>')"><i class="fas fa-user-times"></i> </button></td>

      </tr>
    <?php  } ?>
    

  </tbody>
</table>

                      <div style="float: right;">
                    <nav aria-label="Page navigation example">
                    <ul class="pagination">
                     
                      <?php
                        $i=1;
                        $total= $per-> getDataPerAcademico();
                        $celdas=ceil($total/10);
                        while($i<=$celdas){
                          ?>
                            <li class="page-item"><a class="page-link" href="#" onclick="paginacion4(<?php echo $i; ?>)"><?php echo $i; ?></a></li>
                            
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
              <h5 class="modal-title">Editar Personal Académico</h5>
              
                <span  class="close1 close">&times; </span>
              
            </div>
            <div class="modal-body">
              <div class="container-fluid">
              
                <div class="row">
                  <div class="col-4 col-sm-4">Nombre<input type="text" name="name" id="nombrePerAcademico"></div>
                  <div class="col">Apellido Paterno<input type="text" name="" id="apellidoPatPerAcademico"></div>
                  <div class="col">Apellido Materno<input type="text" name="" id="apellidoMatPerAcademico"></div>
                  
                </div>
                <div class="row">
                Academia
                <select id="academia" name="academia"  REQUIRED>
                    <option value="Seleccione la academia" >Seleccione Academia</option>
                    <option value="Matemáticas">Matemáticas</option>
                    <option value="Fisica" >Física</option>
                    <option value="Ambiental" >Ambiental</option>
                </select>
                  <div class="col">RFC <input type="text" name="" id="RFC"></div>
                </div>

                <div class="row">
                  <div class="col">Teléfono<input type="text" name="" id=telefono></div>
                  <div class="col">Extensión<input type="text" name="" id="extension"></div>
                </div>  

                <div>
                  <div class="col">Correo <input type="text" name="" id="emailPerAcademico"></div>
                  
                </div>
            
              
              </div>
            </div>
            <div class="modal-footer">
            <div class="col-4 col-sm-4"> <input type="text" name="idperson" id="idAdmin" disabled style="visibility: hidden;"></div>
              <button type="button" class="btn btn-primary" id="editActualizarperacademico">Guardar cambios</button>
             
            </div>
          </div>
        </div>
      </div>
</body>
</html>
