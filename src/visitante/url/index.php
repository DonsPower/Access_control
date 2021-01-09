<?php
    require_once 'config.php';
    require_once '../../clases/conexion.Class.php';
    require_once '../../clases/visitorController.Class.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bienvenido Visitante</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="../../css/dashboard.css">
    <script src="https://kit.fontawesome.com/a076d05399.js"></script>
</head>
<body>
<div class="card-top">

  <a href="../../dashboard.php"><img src="../../img/controlacceso.png" style="width: 20%; margin-top: 1%; margin-left: 20%; " alt="logo"></a>
  <a href="https://github.com/DonsPower/Access_control"><i class="fab fa-github" "></i></a>
  
  
</div>
    <div class="container mt-5">
        <?php
            if (isset($_COOKIE["id"])) {
                //echo "COOKIE ACTIVA";
                $visitor=new visitor;
                if ($visitor->userActivo($_COOKIE["id"])) {
        ?>      
            <form method="POST" action="salidaGoogle.php" >
                <div class="card text-center">
                    <div class="card-header">
                    <h3>Bienvenido <?php echo $visitor->imprimirResultados($_COOKIE["id"]);?></h3>
                    </div>
                    <div class="card-body">
                        <h5 class="card-title">Solo falta agregar tu razón de visita</h5>
                        <textarea REQUIRED class="form-control" cols="15" rows="5" name="razon" id="razon" placeholder="Razón de la visita e.g Dirección"></textarea>
                        <div class="form-group">
                        <label class="control-label"></label>
                        <input type="submit" name="submit" id="submit" class="btn btn-success" value="Generar código QR">
                    </div>
                    </div>
                    </div>
            </form>
               
            <a href="../index.php"><input type="button" value="Regresar"></a>
        <?php            
                }else{
                    echo "Error";
                    header('location: ../cerrarsesion.php');
                }

            }else{
        ?>
        <div class="card text-center">
            <div class="card-header" align="center">
            <h4 class="card-title">Crea una cuenta para tener el control</h4>
            <p ><small class="text-muted">Lorem ipsum dolor sit amet consectetur adipisicing elit. Sunt, quae maxime voluptatum ipsam quod placeat fuga repellat soluta.  </small></p>
            </div>
            <div class="card-body">
                <form action="">
                    <button onclick="window.location='<?php echo $login_url;?>'" type="button" class="btn btn-outline-primary">
                    <i class="fab fa-google"></i>
                        Google
                    </button>
                </form>
            <p class="m-4">O registrate manualmente</p>
            </div>
            <div class="card text-left" >
                <div class="card-body">
                <form method="POST" action="salida.php">
                    <div class="form-group">
                        <label >Nombre</label>
                        <!--TODO: VALIDAR ESTE PEDO-->
                        <input type="text" class="form-control" name="nombreauthmanual" id="nombreauthmanual" aria-describedby="emailHelp" placeholder="Nombre e.g Jose">
                        <label >Apellidos</label>
                        <input type="text" class="form-control" name="apellidoauthmanual" id="apellidoauthmanual"  placeholder="Apellidos e.g Hernandez Montalvo">
                        <small id="emailHelp" class="form-text text-muted">We'll never share your name with anyone else.</small>
                        
                    </div>
                    <div class="form-group">
                        <label >Razon visita</label>
                        <textarea REQUIRED class="form-control" cols="15" rows="5" name="razonvisitaauth"  placeholder="Razón de la visita e.g Dirección"></textarea>
                    </div>
                    <button type="submit" name="authmanueal" class="btn btn-primary">Enviar</button>
                </form>
                </div>
            </div>
        </div>
        <?php
            }
        ?>
    </div>
</body>
</html>
