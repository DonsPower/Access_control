<?php
    session_start();
    require_once 'config.php';
    require_once 'core/controller.Class.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bienvenido Visitante</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>
<body>
    <div class="container mt-5">
        <?php
            if (isset($_COOKIE["id"])) {
                //echo "COOKIE ACTIVA";
                $Controller = new Controller;
                if ($Controller->user_activo($_COOKIE["id"])) {
        ?>      
            <form method="POST" action="actualizarAuth.php" >
                <div class="card text-center">
                    <div class="card-header">
                    <h3>Bienvenido <?php echo $Controller->imprimir_resultados($_COOKIE["id"]);?></h3>
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
               
            <a href="../sessionclose.php"><input type="button" value="Regresar"></a>
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
                        <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-upc-scan" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd" d="M1.5 1a.5.5 0 0 0-.5.5v3a.5.5 0 0 1-1 0v-3A1.5 1.5 0 0 1 1.5 0h3a.5.5 0 0 1 0 1h-3zM11 .5a.5.5 0 0 1 .5-.5h3A1.5 1.5 0 0 1 16 1.5v3a.5.5 0 0 1-1 0v-3a.5.5 0 0 0-.5-.5h-3a.5.5 0 0 1-.5-.5zM.5 11a.5.5 0 0 1 .5.5v3a.5.5 0 0 0 .5.5h3a.5.5 0 0 1 0 1h-3A1.5 1.5 0 0 1 0 14.5v-3a.5.5 0 0 1 .5-.5zm15 0a.5.5 0 0 1 .5.5v3a1.5 1.5 0 0 1-1.5 1.5h-3a.5.5 0 0 1 0-1h3a.5.5 0 0 0 .5-.5v-3a.5.5 0 0 1 .5-.5z"/>
                        <path d="M3 4.5a.5.5 0 0 1 1 0v7a.5.5 0 0 1-1 0v-7zm2 0a.5.5 0 0 1 1 0v7a.5.5 0 0 1-1 0v-7zm2 0a.5.5 0 0 1 1 0v7a.5.5 0 0 1-1 0v-7zm2 0a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-.5.5h-1a.5.5 0 0 1-.5-.5v-7zm3 0a.5.5 0 0 1 1 0v7a.5.5 0 0 1-1 0v-7z"/>
                        </svg>
                        Google
                    </button>
                </form>
            <p class="m-4">O registrate manualmente</p>
            </div>
            <div class="card text-left" >
                <div class="card-body">
                <form method="POST">
                    <div class="form-group">
                        <label >Nombre completo</label>
                        <input type="text" class="form-control" name="nombreauthmanual" id="nombreauthmanual" aria-describedby="emailHelp" placeholder="Nombre e.g Jose Bascon">
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

<?php
 if(isset($_POST['authmanueal'])){
    $nombrecompleto= $_POST['nombreauthmanual'];
    $razonvisita = $_POST['razonvisitaauth'];
    $array = explode(" ", $nombrecompleto);
    $Controller = new Controller;
    //TODO: Y si son mas de 2 nombres? Corregir esta parte!!.
    echo $Controller ->insertData(array(
        'nombre'=> $array[0],
        'apellidop' => $array[1],
        'apellidom' => $array[2],
        'razonvisita' => $razonvisita
    ));
 }
?>