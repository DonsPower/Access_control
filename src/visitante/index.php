<?php
    //TODO: Cuando se haga el redireccionamiento redireccionar al sahboar en vez del index
    //importamos la clase auth
    //TODO: Eliminar llave foranea y agregar un boton de "Agregar áreas"
    require_once '../clases/conexion.Class.php';
    require_once '../clases/authController.Class.php';
    require_once "../clases/visitorController.Class.php";
    session_start();
    //creamos el objeto cliente
    $auth=new auth;
    $visitor=new visitor;
    $location="../index.php";
    if (isset($_SESSION['nombre'])){
        $cliente = $_SESSION['nombre'];
            //Enviamos el tiempo y si pasan ciertos minutos lo redireccionamos
            if(isset($_SESSION['tiempo'])){
                echo $auth-> lifeSession($_SESSION['tiempo'],$location);
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
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ControlAcceso-atablavisitantes</title>
    <!--CSS-->
    <link rel="stylesheet" href="lib/alertifyjs/css/alertify.css">
    <link rel="stylesheet" href="lib/alertifyjs/css/themes/default.css">
    
    <!--JS-->
    
    <script src="js/visitante.js"></script>
    <script src="lib/alertifyjs/alertify.js"></script>
    
</head>
<body>
    <div class="container">
      <h4>
        <?php echo $_SESSION['tipo']?>
      </h4>
      <!--muestra la ubicación de donde esta-->
      <nav aria-label="breadcrumb" style="margin-top: 20px;">
        <ol class="breadcrumb">
            <li class="breadcrumb-item">Inicio</li>
            <li class="breadcrumb-item active" aria-current="page">Lista visitantes</li>
        </ol>
        </nav>
      <hr>
    </div>
    <!--Boton buscar visitante-->
    <div class="container" style="float: right;">
        <button type="button" id="enviarVisitante" class="btn btn-success" style=" float: right; margin-left:2px">Buscar</button>
        <input type="text" id="buscar" style="width: 20%; height: 1px; float: right; " maxlength="30" placeholder="Buscar visitante" aria-label="Buscar usuario">
    </div>
    
    <div class="container">
        <caption>
            <div class="titulos "><h2>Lista visitantes</h2></div>
        </caption>
        <div class="table-responsive-md">
        <table class="table table-hover">
            <thead>
                <tr>
                <th scope="col">#</th>
                <th scope="col">Nombre</th>
                <th scope="col">Razón visita</th>
                <th scope="col">Codigo QR</th>
                <th scope="col">Estado</th>
                <th scope="col">Editar</th>
                <th scope="col">Baja</th>
                </tr>
            </thead>
       
        <tbody id="salida">
    <!--Mostrar los registros de la BD -->
      <?php
        $i=0;
        $resultado=$visitor->tablaVisitantes();
        while($row=$resultado->fetch(PDO::FETCH_ASSOC))
        {
            $i+=1;
            $estado="";
            if($row['estado']==1)$estado="Activo";
            else $estado="Inactivo";
              //Concatenamos datos para editarlos. los pasamos a la funcion editarDatos
              $datos=$row['id']."||".$row['nombre']."||".$row['apellidop']."||".$row['apellidom']."||".$row['razonvisita']
              ."||".$row['numcodqr']."||".$row['estado'];
              $nombre=$row['nombre']." ".$row['apellidop']." ".$row['apellidom'];
            ?>   
                
            <tr>
                <td ><?php echo $i;?> </td>
                <td><?php echo $row['nombre'];?> <?php echo $row['apellidop'];?> <?php echo $row['apellidom'];?></td>
                <td><?php echo $row['razonvisita'];?></td>
                <td><?php echo $row['numcodqr'];?></td>
                <td><?php echo $estado;?></td>
                <!--TODO: inactivo el usuaro desabilitar boton.-->
                <td><button type="button" id="editar" class="btn btn-success" onclick="editarDatosVis('<?php echo $datos; ?>')"><i class="fas fa-user-edit"></i></button></td>
                <td><button type="button" id="eliminar" class="btn btn-danger" onclick="bajaVist('<?php echo $row['id']; ?>','<?php echo $nombre?>')"><i class="fas fa-user-minus"></i> </button></td>

                </tr>
         <?php  
        } ?>

        </tbody>
        </table>
        </div>
        </div>

        <!--Modal cuando se activa editar-->
        <div class="modal" id="myModal" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title">Editar visitante</h5>
              
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
                  <div class="col">Razón visita<input type="text" name="" id="razon"></div>               
                </div>

            </div>
            <div class="modal-footer">
            <div class="col-4 col-sm-4"> <input type="text" name="idperson" id="idVist" disabled style="visibility: hidden;"></div>
              <button type="button" class="btn btn-primary" id="editVistActualizar">Guardar cambios</button>
             
            </div>
          </div>
        </div>
      </div>
</body>
</html>