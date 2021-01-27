
<?php
 require_once '../clases/conexion.Class.php';
 require_once '../clases/authController.Class.php';
 require_once "../clases/adminController.Class.php";
 require_once "../clases/paaeController.Class.php";

//TODO: Cuando se haga el redireccionamiento redireccionar al sahboar en vez del index
    //importamos la clase auth
    require_once '../clases/conexion.Class.php';
    require_once '../clases/authController.Class.php';
    require_once "../clases/adminController.Class.php";
    session_start();
    //creamos el objeto cliente
    $auth=new auth;
    $admin=new admin;
    $paae=new paae;
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
        <title>Alta PAAE</title>
        <meta charset="utf-8">
        <script src="js/paae.js"></script>
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
            <li class="breadcrumb-item active" aria-current="page">Alta de PAAE</li>
        </ol>
        </nav>
        <div class="container form1">
        <div style="margin-bottom: 30px; margin-top:10px;">
        <?php
        
            if($_SESSION['tipo']=='AdministradorGlobal'){

                ?>
                <div style="float: right;">
                    <button type="button" id="datosSaes2" class="btn btn-success">Carga de datos</button>
                </div>
              <?php 
            } ?>
        <caption>
            <div class="titulos "><h2>Alta de PAAE</h2></div>
            
        </caption>
        
        </div>
         <!--Lo anterior solo son los titulos, de aquí para abajo va lo que tien que ir el los datos usuario-->
            <!--Row=Fila entonces agregar los row necesarios.-->
            <div class="row"> 
                <!--Dentro de los row deberan ir maximo 3 input para que no se salga de la pagina-->
                <!--Agregar las clases col para que losidentifique el row  el "sm" significa que cuando la pagina se reduzca el sm interactue osea lo responsivo.-->
                <div class="col-4 col-sm-4"><input type="text"name="nombrePaae" id="nombrePaae" placeholder="Nombre" REQUIRED></div>
                <div class="col"><input type="text"  name="apellidoPatPaae" id="apellidoPatPaae" placeholder="Apellido Paterno" required></div>
                <div class="col"><input type="text" name="apellidoMatPaae" id="apellidoMatPaae" placeholder="Apellido Materno"></div>
            </div>
             <!--Aquí no utilice row ya que esto es una fila completa.-->     
             <select name="areaAdministra" class="col" id="area" required="required" >
                    <option value="0">Seleccione el área que administra</option>
                    <?php
                        $res=$admin->getAreas();
                        while($row=$res->fetch(PDO::FETCH_ASSOC)){
                            ?>
                                <option value="<?echo $row['id'];?>"><?php echo $row['nombreArea'];?></option>
                            <?php
                        }
                    ?>
                </select>

                <div class="row">
            <!--Es necesario que cada input valla con un Div -->
                <div class="col-4 col-sm-4"><input type="text" name="RFC" id="RFC" placeholder="RFC"></div>
                <div class="col"><input type="text" name="telefono" id="telefono" placeholder="Teléfono"></div>
                <div class="col"><input type="text" name="extension" id="extension" placeholder="Ext"></div>
            </div>
           
            <!--Es necesario que cada input valla con un Div -->
                <div class="col-4 col-sm-12"><input type="email" name="emailPaae" id="emailPaae" placeholder="Correo"></div>
           
    
             <!--Botones para regresar o guardar datos.-->
             <div class="container">
                <button  type="button" id="registrarPaae" class="btn btn-success" style="width: 100px;">Registrar</button>
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
                        <button type="button" class="btn btn-primary" id="dataSaes2">Bajar datos del sistema</button>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>
