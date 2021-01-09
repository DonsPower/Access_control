
<?php
    require_once '../../clases/conexion.Class.php';
    REQUIRE_ONCE '../../clases/visitorController.Class.php';
    if(isset($_POST['authmanueal'])){
        $nombre= $_POST['nombreauthmanual'];
        $apellido= $_POST['apellidoauthmanual'];
        $razonvisita = $_POST['razonvisitaauth'];
        $lista =  explode(" ", $apellido);
        $visitor = new visitor;
        //print_r($lista);
        //TODO: Y si son mas de 2 nombres? Corregir esta parte!!.
       
    }
     
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bienvenido-visitante</title>
    <!--CSS-->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="../../css/dashboard.css">
    <link rel="stylesheet" href="../../lib/alertifyjs/css/alertify.css">
    <link rel="stylesheet" href="../../lib/alertifyjs/css/themes/default.css">
    <!--JS-->
    <script src="../../lib/alertifyjs/alertify.js"></script>
    <script src="https://kit.fontawesome.com/a076d05399.js"></script>
</head>
<body>
<div class="card-top">

<a href="../../dashboard.php"><img src="../../img/controlacceso.png" style="width: 20%; margin-top: 1%; margin-left: 20%; " alt="logo"></a>
<a href="https://github.com/DonsPower/Access_control"><i class="fab fa-github" "></i></a>


</div>
<div class=" container mt-3">
      <h4>
        Bienvenido visitante
      </h4>
      <hr>
    </div>
<div class="container mt-2">
        
        <H6>Su codigo de acceso es:</H6>
        <?php
         echo $visitor ->registerVisURL(array(
            'nombre'=> $nombre,
            'apellidop' => $lista[0],
            'apellidom' => $lista[1], 
            'razonvisita' => $razonvisita
        ));
        ?>
        <hr>
        <div class="row">
            <div class="col"><h6> Nombre:</h6> <?php echo $nombre;?> <?php echo $apellido?></div>
        </div>

        <div class="row"><div class="col mt-2"> <h6>Razon de visita: </h6><?php echo $razonvisita?></div></div>
        <div class="row mt-1" style="margin-left:10vh">
            <form method="POST" action="download.php">
                <button type="submit" id="getImage" class="btn btn-primary">Descargar código QR</button>
            </form>
        </div>
        <small id="emailHelp" class="form-text text-muted">Si alguno de tus datos son incorrectos por favor contacte con el administrador .</small>
    </div>
   
</body>
</html>
