
<?php
  require_once '../../clases/conexion.Class.php';
  REQUIRE_ONCE '../../clases/visitorController.Class.php';
    require '../../lib/phpqrcode/qrlib.php';
    $dir='temp/';
    if(!file_exists($dir)){
        mkdir($dir);
    }

    $filename=$dir.'test.png';
    $tamanio=10;
    $level='M';
    $frameSize=3;
    $contenido="";
    
    $id=intval($_COOKIE["id"]);
    if(isset($_POST['submit'])){
        if(strlen($_POST['razon']) >= 1)
            { 
                $razon = ($_POST['razon']);
                $visitor=new visitor;
                $resultado= $visitor->editarRazon($razon,$id);
                QRcode::png($resultado['numcodqr'], $filename, $level, $tamanio, $frameSize);
            }
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
         echo '<img src="'.$filename.'"/> ';
        ?>
        <hr>
        
        <div class="row">
            <div class="col"><h7>Nombre: </h7> <?php echo $resultado['nombre'];?> <?php echo $resultado['apellidop'];?> <?php echo $resultado['apellidom'];?></div>
        </div>
        <div class="row">
            <div class="col"><h7>Razón de la visita: </h7> <?php echo $resultado['razonvisita'];?></div>
        </div>
        <div class="row mt-1" style="margin-left:10vh">
            <form method="POST" action="download.php">
                <button type="submit" id="getImage" class="btn btn-primary">Descargar código QR</button>
            </form>
        </div>
        <small id="emailHelp" class="form-text text-muted">Si alguno de tus datos son incorrectos por favor contacte con el administrador .</small>
    </div>
   
</body>
</html>
