<?php
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
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Control-ListaAdmin</title>
    <!--CSS-->
    <link rel="stylesheet" href="lib/alertifyjs/css/alertify.css">
    <link rel="stylesheet" href="lib/alertifyjs/css/themes/default.css">
    <!--JS-->
    <script type="text/javascript" src="js/funcion.js"></script>
    <script src="lib/alertifyjs/alertify.js"></script>
    <script src="lib/alertifyjs/alertify.js"></script>
</head>
<body>
<div class="container">
      <h4>
        <?php echo $_SESSION['tipo'];?>
      </h4>
      <nav aria-label="breadcrumb" style="margin-top: 20px;">
        <ol class="breadcrumb">
            <li class="breadcrumb-item">Inicio</li>
            <li class="breadcrumb-item active" aria-current="page">Lista Administradores</li>
        </ol>
        </nav>
      <hr>
    </div>
    
    <!--Boton buscar-->
    <div class="container">
    <a href="dashboard.php"><button type="button"  class="btn btn-info" style="float:center; width:20%; margin-left:2px; margin-bottom:10px; ">  Regresar </button></a>
    </div>
    
    <div class="container" >

        <button type="button" id="enviar" class="btn btn-success" style=" float: right; margin-left:2px">Buscar</button>
        <input type="text" id="primero" style="width: 20%; height: 1px; float: right; " maxlength="30" placeholder="Buscar usuario" aria-label="Buscar usuario">
       
    </div>
    <div>
    
        <div class="container">
        <caption>
            <div class="titulos "><h2>Lista administradores</h2></div>
        </caption>
        <div class=" table-responsive-md">
        <table class="table table-hover">
            <thead>
                <tr>
                <th scope="col">#</th>
                <th scope="col">Nombre</th>
                <th scope="col">Puesto</th>
                <th scope="col">Area</th>
                <th scope="col">Tipo</th>
                <th scope="col">Correo</th>
                <th scope="col">Clave</th>
                <th scope="col">Pregunta</th>
                <th scope="col">Respuesta</th>
                <th scope="col">Editar</th>
                <th scope="col">Borrar</th>
                </tr>
            </thead>
       
        <tbody id="salida">
    <!--Mostrar los registros de la BD -->
      <?php
        $i=0;
        $resultado=$admin->getAdmin();
        while($row=$resultado->fetch(PDO::FETCH_ASSOC))
        {
            $i+=1;
            //Buscamos area
            $area=$admin->buscarArea($row['AreaAdm']);
            //Concatenamos datos para editarlos. los pasamos a la funcion editarDatos
            $datos=$row['id']."||".$row['name']."||".$row['ApellidoPAdm']."||".$row['ApellidoMFAdm']."||".$row['Puesto']
                             ."||".$row['AreaAdm']."||".$row['Tipo']."||".$row['email']."||".$row['TrabajadorAdm']
                             ."||".$row['PreguntaS']."||".$row['RespuestaS'];
            //Concatenamos para mandarlos a la funcion eliminarADMIN.
            $nombre=$row['name']." ".$row['ApellidoPAdm']." ".$row['ApellidoMFAdm'];
            $ocultarCorreo=True;
            ?>   
                
            <tr>
                <td ><?php echo $i;?> </td>
                <td><?php echo $row['name'];?> <?php echo $row['ApellidoPAdm'];?> <?php echo $row['ApellidoMFAdm'];?></td>
                <td><?php echo $row['Puesto'];?></td>
                <td><?php echo $area?></td>
                <td><?php echo $row['Tipo'];?></td>
                <td><?php echo $row['email'];?></td>
                <td><?php echo $row['TrabajadorAdm'];?></td>
                <td><?php echo $row['PreguntaS'];?></td>
                <td><?php echo $row['RespuestaS'];?></td>
                <?php
                  if($row['id']==$_SESSION['id']){
                    $ocultarCorreo=False;
                    ?>
                    <td><button type="button" id="editar" disabled class="btn btn-success" ><i class="fas fa-user-edit"></i></button></td>
                    <td><button type="button" id="eliminar" class="btn btn-danger" disabled ><i class="fas fa-user-times"></i> </button></td>
                   <?php
                  }else{
                    ?>
                    <td><button type="button" id="editar" class="btn btn-success" onclick="editarDatos('<?php echo $datos; ?>')"><i class="fas fa-user-edit"></i></button></td>
                   <td><button type="button" id="eliminar" class="btn btn-danger" onclick="eliminarAdmin(<?php echo $row['id']; ?>,'<?php echo $nombre ?>')"><i class="fas fa-user-times"></i> </button></td>
                    <?php
                  }
                ?>
                

                </tr>
         <?php  
        } ?>
        </tbody>
        </table>
              <div style="float: right;">
                    <nav aria-label="Page navigation example">
                    <ul class="pagination">
                     
                      <?php
                        $i=1;
                        $total= $admin->getDataAdmin();
                        $celdas=ceil($total/10);
                        while($i<=$celdas){
                          ?>
                            <li class="page-item"><a class="page-link" href="#" onclick="paginacion(<?php echo $i; ?>)"><?php echo $i; ?></a></li>
                            
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
              <h5 class="modal-title">Editar administrador</h5>
              
                <span  class="close1 close">&times; </span>
              
            </div>
            <div class="modal-body">
              <div class="container-fluid">
                  
                  
                <div class="row">
                  <div class="col-4 col-sm-4">Nombre<input type="text" name="name" id="name"></div>
                  <div class="col">Apellido paterno<input type="text" name="" id="apellidoP"></div>
                  <div class="col">Apellido materno<input type="text" name="" id="apellidoM"></div>
                  
                </div>
                <div class="row">
                  <div class="col">Puesto<input type="text" name="" id="puesto"></div>
                  <?php 
                  if($_SESSION['tipo']=='AdministradorGlobal'){
                  ?>
                  
                  <select name="areaAdministra" class="col" id="area" required="required"  style=" border-radius: 5px;  margin-top:5%" >
                  
                      <option value="0">Seleccione el area que administra</option>
                      <?php
                          $res=$admin->getAreas();
                          while($row=$res->fetch(PDO::FETCH_ASSOC)){
                              ?>
                                  <option value="<?echo $row['id'];?>"><?php echo $row['nombreArea'];?></option>
                              <?php
                          }
                      ?>
                  </select>
                  <?php
                }
                 ?>
                </div>

                <div class="row">
                <div class="col">
                
                <select name="pais" id="tipo" style="border-radius: 5px;  margin-top:10%" >
                  <option value="0">Tipo de administrador</option>
                  <option value="admin">AdministradorGlobal</option>
                  <option value="noadmin">AdministradorArea</option>
                </select>
                <script>
$(document).ready(function() {
    $('#area').hide();

    $("#tipo").click(function() {
        $resultado=$('#tipo').val();
       // console.log($resultado);
        if ($("#tipo").val() == "admin"){
            $("#tipo").show();
            $('#area').hide();
            
        } else {
            $("#pais-error").text("");
            $("#tipo").show();
            $('#area').show();
            
        }
        if($resultado=="noadmin" || $resultado==0){
            $("#pais-error").text("");
            $("#tipo").show();
            $('#area').show();
        }else{
            $("#tipo").show();
            $('#area').hide();
        }
        
    });
});
</script>
                </div>
                  <div class="col">Correo<input type="text" name="" id="email"></div>
                </div>  

                <div>
                  <div class="col">Clave trabajador <input type="text" name="" id="claveTrabajador"></div>
                  
                </div>

                <div class="row">
                  <div class="col"> Pregunta seguridad<input type="text" name="" id="preguntaSeg"></div>
                  <div class="col">Respuesta de seguridad<input type="text" name="" id="respuestaSeg"></div>
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
      <input type="text" id="idbusc" disabled style="visibility: hidden;" value="<?php echo $_SESSION['id']; ?>">
</body>
</html>