
<?php
 require_once '../clases/conexion.Class.php';
 require_once '../clases/authController.Class.php';
 require_once "../clases/adminController.Class.php";

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
<html>
<head>
        <title>Registrar Docente</title>
        <meta charset="utf-8">
        <script src="js/perAcademico.js"></script>
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
            <li class="breadcrumb-item active" aria-current="page">Alta Docente</li>
        </ol>
        </nav>
        <div class="container form1">
        <div style="margin-bottom: 30px; margin-top:10px;">
        <caption>
            <div class="titulos "><h2>Almacenar Docente</h2></div>
        </caption>
        </div>
         <!--Lo anterior solo son los titulos, de aquí para abajo va lo que tien que ir el los datos usuario-->
            <!--Row=Fila entonces agregar los row necesarios.-->
            <div class="row"> 
                <!--Dentro de los row deberan ir maximo 3 input para que no se salga de la pagina-->
                <!--Agregar las clases col para que losidentifique el row  el "sm" significa que cuando la pagina se reduzca el sm interactue osea lo responsivo.-->
                <div class="col-4 col-sm-4"><input type="text"name="nombrePerAcademico" id="nombrePerAcademico" placeholder="Nombre" REQUIRED></div>
                <div class="col"><input type="text"  name="apellidoPatPerAcademico" id="apellidoPatPerAcademico" placeholder="Apellido Paterno" required></div>
                <div class="col"><input type="text" name="apellidoMatPerAcademico" id="apellidoMatPerAcademico" placeholder="Apellido Materno"></div>
            </div>
             <!--Aquí no utilice row ya que esto es una fila completa.-->     
             <select id="academia" name="academia"  REQUIRED>
                    <option value="Seleccione la academia" >Seleccione Academia</option>
                    <option value="Matemáticas">Matemáticas</option>
                    <option value="Fisica" >Física</option>
                    <option value="Ambiental" >Ambiental</option>
                </select>

                <div class="row">
            <!--Es necesario que cada input valla con un Div -->
                <div class="col-4 col-sm-4"><input type="text" name="RFC" id="RFC" placeholder="RFC"></div>
                <div class="col"><input type="text" name="telefono" id="telefono" placeholder="Telefono"></div>
                <div class="col"><input type="text" name="extension" id="extension" placeholder="Ext"></div>
            </div>
            <div class="row">
            <!--Es necesario que cada input valla con un Div -->
                <div class="col-4 col-sm-4"><input type="text" name="emailPerAcademico" id="emailPerAcademico" placeholder="Correo"></div>
           </div>
           <!--Es necesario que cada input valla con un Div -->
           <div class="col-4 col-sm-4"><input type="text" name="numcodqr" id="numcodqr" placeholder="Número de código QR"></div>
           </div>
            <!--Botones para regresar o guardar datos.-->
            <div class="container">
                <button  type="button" id="registrarPerAcademico" class="btn btn-success" style="width: 100px;">Registrar</button>
                <button type="button" class="btn btn-danger" style="width: 100px; "><a href="dashboard.php">Regresar</a></button>
            </div>
        </div>
    </body>
</html>