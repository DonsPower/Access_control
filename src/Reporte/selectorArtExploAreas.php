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
<html>
<head>
        <title>Generar Reporte</title>
        <meta charset="utf-8">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
  <!--CSS - Bootstrap-->
        
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
        <link rel="stylesheet" href="css/style.css">
        <!--JavaScript-->
        <script src="https://code.jquery.com/jquery-3.2.1.js"></script>
        <script src="js/index.js"></script>
        <link rel="stylesheet" href="lib/alertifyjs/css/alertify.css">
        <link rel="stylesheet" href="lib/alertifyjs/css/themes/default.css">

        
        <link rel="stylesheet" href="lib/alertifyjs/css/alertify.css">
        <link rel="stylesheet" href="lib/alertifyjs/css/themes/default.css">
</head>
    <body>
    <form action="reporteArtExploAreas.php" method="POST">
    <div class="container" >


<div class="col-sm-12" style="margin-top:10%; text-align: center;">
  <div class="card" style="background-color:#EAEDED">
  <div class="mb-3">
  <br>
  <h1 vertical-align:middle>   Reportes Por Área </h1>

  <br>
  <h3 vertical-align:middle> Seleccione el área para generar el formulario de reporte</h3>
  <br>
                <select name="repArtExplo" class="col" id="repArtExplo" required="required" >
                    <option value="0">Seleccione el área que administra</option>
                   
                    <?php
                     include("../../database/con_db.php"); 
                     
                     $sql = "SELECT * FROM area ";
                     $resultado = $conex->query($sql);
                     if($resultado->num_rows> 0){
                         while($row = $resultado->fetch_assoc()){ ?>
                     <option value="<?php echo $row['id'];?>"><?php echo $row['nombreArea'];?></option>      
                            <?php
                        }
                        }
                        $conex->close();
                    ?>
                    
                </select>
            </div>
            <br><br><br><br>
            <th><input type="submit" class=" btn btn-primary btn-lg" value="Reporte Artefacto Explosivo"></th>
        </div>
    </form>
    </body>
</html>