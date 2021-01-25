

<?php
 require_once '../clases/conexion.Class.php';
 require_once '../clases/authController.Class.php';
 require_once '../clases/adminController.Class.php';
  require_once "../clases/alumnosController.Class.php";

//TODO: Cuando se haga el redireccionamiento redireccionar al sahboar en vez del index
    //importamos la clase auth
    require_once '../clases/conexion.Class.php';
    require_once '../clases/authController.Class.php';
    require_once "../clases/adminController.Class.php";
    session_start();
    //creamos el objeto cliente
    $auth=new auth;
    $alumno=new alumno;
    $qr = $alumno->generarToken(10);
    
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
<html>
<head>
        <title>Registrar Alumno</title>
        <meta charset="utf-8">
        <link rel="stylesheet" href="css/dashboard.css">
        <script src="js/alumno.js"></script>
        <script src="js/modal.js"></script>
    </head>
    <body>
        <!--tituto-->
      <div class="container">
      <h4>
        <?php echo $_SESSION['tipo']?>
      </h4>
         <!--muestra la ubicación de donde esta-->
      <nav aria-label="breadcrumb" style="margin-top: 20px;">
        <ol class="breadcrumb">
            <li class="breadcrumb-item">Inicio</li>
            <li class="breadcrumb-item active" aria-current="page">Alta de Alumnos</li>
        </ol>
        </nav>
        <div class="container form1">
        <div style="margin-bottom: 30px; margin-top:10px;">
        <?php
        
            if($_SESSION['tipo']=='AdministradorGlobal'){

                ?>
                <div style="float: right;">
                    <button type="button" id="datosSaes" class="btn btn-success">Carga de datos</button>
                </div>
              <?php 
            } ?>
        <caption>
            <div class="titulos "><h2>Alta de Alumnos</h2></div>
            
        </caption>
        
        </div>
        <!--Lo anterior solo son los titulos, de aquí para abajo va lo que tien que ir el los datos usuario-->
            <!--Row=Fila entonces agregar los row necesarios.-->
            <div class="row"> 
                <!--Dentro de los row deberan ir maximo 3 input para que no se salga de la pagina-->
                <!--Agregar las clases col para que losidentifique el row  el "sm" significa que cuando la pagina se reduzca el sm interactue osea lo responsivo.-->
                <div class="col-4 col-sm-4"><input type="text"name="nombreAlumno" id="nombreAlumno" placeholder="Nombre" REQUIRED></div>
                <div class="col"><input type="text"  name="apellidoPatAlumno" id="apellidoPatAlumno" placeholder="Apellido Paterno" required></div>
                <div class="col"><input type="text" name="apellidoMatAlumno" id="apellidoMatAlumno" placeholder="Apellido Materno"></div>
            </div>
           
           <!--Aquí no utilice row ya que esto es una fila completa.-->     
                <select id="carrera" name="carrera"  REQUIRED>
                    <option value="Seleccione la Carerra" >Seleccione Programa Académico</option>
                    <option value="Ingenieria en Sistemas Computacionales">Ingeniería en Sistemas Computacionales</option>
                    <option value="Ingenieria Ambiental" >Ingeniería Ambiental</option>
                    <option value="Ingenieria Mecatronica" >Ingenieria Mecatrónica</option>
                    <option value="Ingenieria Metalurgica" >Ingeniría Metalurgíca</option>
                    <option value="Ingenieria en Alimentos" >Ingeniería en Alimentos</option>
                </select>
           

            <div class="row">
            <!--Es necesario que cada input valla con un Div -->
                <div class="col-4 col-sm-4"><input type="text" name="boleta" id="boleta" placeholder="Boleta"></div>
                <div class="col"><input type="text" name="telefonoMovil" id="telefonoMovil" placeholder="Telefono Móvil"></div>
                <div class="col"><input type="text" name="telefonoFijo" id="telefonoFijo" placeholder="Telefono Fijo"></div>
            </div>

            <div class="row">
                <div class="col-4 col-sm-4"><input type="text" name="telefonoPersonal" id="telefonoPersonal" placeholder="Teléfono Personal"></div>
                <div class="col"><input type="text"name="NSS" id="NSS" placeholder="NSS"></div>
                <div class="col"><input type="text"  name="emailAlumno" id="emailAlumno"  placeholder="Correo"></div>
            </div>
           

           <div class="row">
              <div class="col"></div>

           </div>
            <!--Botones para regresar o guardar datos.-->
            <div class="container">
                <button  type="button" id="registrarAlumno"  class="btn btn-success" style="width: 100px;">Registrar</button>
                <button type="button" class="btn btn-danger" style="width: 100px; "><a href="dashboard.php">Regresar</a></button>
            </div>
        </div>


         <!--Modal cuando se activa editar-->
        <div class="modal" id="myModal" tabindex="-1" role="dialog">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Cargar datos</h5>
                        <span  class="close1 close">&times; </span>
                    </div>
                    <div class="modal-body">
                        <div class="container-fluid">
                            <div class="row">
                                <div class="col">Usuario<input type="text" name="name" id="usuarioSaes"></div>
                                <div class="col">Contraseña<input type="text" name="name" id="passwordSaes"></div>
                            </div>
                            <div class="row">
                                <div class="col">Token<input type="password" name="name" id="token"></div>
                               
                            </div>
                            <div class="row">
                            <div class="col">URL<input type="text" name="name" id="url"></div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-primary" id="dataSaes">Bajar datos del sistema</button>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>


