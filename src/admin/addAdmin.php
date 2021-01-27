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
    }else{
        header('Location: ../index.php');
        die();
    } 
    //echo $hash = crypt("hola");
    //echo " ";
    //echo $hash = crypt("hola","salt");
 
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Control-addAdministrador</title>
    <!--CSS-->
    <link rel="stylesheet" href="lib/alertifyjs/css/alertify.css">
    <link rel="stylesheet" href="lib/alertifyjs/css/themes/default.css">
    <!--JS-->
    <script src="lib/alertifyjs/alertify.js"></script>
    <script src="js/admin.js"></script>

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
            <li class="breadcrumb-item active" aria-current="page">Alta administrador</li>
        </ol>
        </nav>
      <hr>
      
    </div>

    <div class="container form1" >
    <div style="margin-bottom: 30px; margin-top:10px;">
    <caption>
        <div class="titulos "><h2>Alta administrador</h2></div>
    </caption>
    </div>
            


    <div class="pcx_mns_form_control">
    <select name="pais" id="tipo" >
        <option value="0">Seleccione el tipo de administrador</option>
        <option value="admin">AdministradorGlobal</option>
        <option value="noadmin">AdministradorArea</option>
    </select>
    
</div>
 

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

        <div class="row">
            <div class="col-4 col-sm-4"><input type="text" name="name" id="name" REQUIRED placeholder="Nombre" maxlength="30"></div>
            <div class="col"><input type="text" name="apellidoP" id="apellidoP" REQUIRED placeholder="Apellido paterno" maxlength="30"></div>
            <div class="col"><input type="text" name="apellidoM" id="apellidoM" REQUIRED placeholder="Apellido materno" maxlength="30"></div>
        </div>
        <div class="row">
        <div class="col" style="margin-top: 10px;"> 
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
            </div>
        </div>
        <div class="row">
            <div class="col"><input type="text" id="puesto"name="puesto"  required  id="puesto" placeholder="Puesto" maxlength="30"></div>
        </div>
       
        <div class="row">
       <!-- //TODO: Preguntar si esta bien la clave del trabajador o si no cambiarla -->
            <div class="col"><input type="text" REQUIRED class="col" name="clave" id="clave" placeholder="Clave de Trabajador" maxlength="30"></div>
            <div class="col"><input type="email"  REQUIRED  name="email" id="email" placeholder="Correo" maxlength="40"></div>
            <div class="col"><input type="password" REQUIRED name="password" id="password" placeholder="Contraseña" maxlength="40"></div> 
        </div>
        <div class="row">
            <div class="col"><input type="text"   REQUIRED  name="preguntaSeg" id="preguntaSeg"  placeholder="Pregunta de seguridad" maxlength="40"></div>
           <div class="col"><input type="text" REQUIRED   name="PreguntaSeg" id="respuestaSeg"  placeholder="Respuesta de seguridad" maxlength="40"></div>
           
        </div>
        <div class="container">
            <button  type="button" id="registrarAdmin" class="btn btn-success" style="width: 100px;">Registrar</button>
            <button type="button" class="btn btn-danger" style="width: 100px; "><a href="dashboard.php">Regresar</a></button>
            
        </div>
    </div>
    
</body>
</html>
