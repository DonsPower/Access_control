<?php
//$_SESSION["token"] = md5(uniqid(mt_rand(), true)); add token en la sesion.n
  session_start();
  require_once ('./clases/conexion.Class.php');
  require_once ('./clases/authController.Class.php');
  if (!empty($_POST['email']) && !empty($_POST['password'])) {
    $usuario=$_POST['email'];
    $password= $_POST['password'];
    //preg_match("/^[a-zA-Z]*$/", $usuario) || preg_match("/^[a-zA-Z]*$/", $password)
      //valdiamos correo.
      if(filter_var($usuario, FILTER_VALIDATE_EMAIL)){
        //redireccionamos.
        //Llamaos a la clase.
        $auth= new auth;
        $row= $auth->addUser($usuario,$password); 
        
        if($row==2) $resultado=2;
        else if ($row==1) {
          //Obtengo los datos del usuario
          $userinfo=$auth->userInfo($usuario, $password);
          //Almaceno el usuario el la variable sesion para utilizarla despues
          //print_r($userinfo); 
          //Almacenamos el id para utilizarlo en el lector de QR
          $_SESSION['id']=$userinfo['id'];
          $_SESSION['nombre'] = $userinfo['name']." ".$userinfo['ApellidoPAdm'];
          //Almacenamos tiempo.
          $_SESSION['tiempo'] = time();
          $_SESSION['tipo']= $userinfo['Tipo'];
          $_SESSION['AreaAdm']=$userinfo['AreaAdm'];
          //echo "Si funciona";
          header('location: dashboard.php');
        }else{
      
          //Mandar notificacion con js de usuario no registrado.
          $resultado=1;
          
        }
      }else{
        $resultado=1;
          
      }
	}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Control de acceso</title>
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
  <div class="container">

     <div class="row ">
      
      <div class="col-sm-5" style="width: 50%; margin-left: 6%; margin-top:16%;">
      <!--<img src="img/logo.png" alt="logo-ControlAccess" width="80" height="80">-->
        <img src="img/controlacceso.png"  width="320" height="60">
        <div class="titulos" style="margin-top: 10px;">Lorem ipsum dolor sit amet consectetur adipisicing elit. Dignissimos ea commodi debitis </div>
      </div>
      <div class="col-sm-5" style="margin-top:10%; text-align: center;">
        <div class="card">
        <div class="mb-3">
           <form class="container" method="POST" autocomplete="off" >
            <input class="input-group" type="email" name="email"  REQUIERED maxlength="30"  autofocus="1" placeholder="Correo electronico" style="width: 95%; margin-right: 15px;" aria-label="Correo electronico">
            <input type="password" name="password" REQUIERED maxlength="30"  autofocus="0" placeholder="Contraseña" aria-label="Contraseña" style="width: 95%;">
            <button type="submit" class="buttomPrimary">Iniciar Sesión</button>
            </form>
            <div class="mt-3">
            <a  href="metodos.php">¿Se te olvido tu contraseña?</a>
            </div>
            <hr>
            <?php
              if (!empty($resultado) ) {
                # code...
                if($resultado==1){
                  ?>
                  <div class="container">

                  <div class="alert alert-danger content" role="alert">
                  Correo ó contraseña <p style="color: red;"> Incorrectos!!</p>
                  </div>
                  
                  </div>
                  <?php
                  }
                else if($resultado==2){
                  ?>
                  <div class="container">
                    <div class="alert alert-danger content" role="alert">
                    El correo electrónico que ingresaste no coinciden con ninguna cuenta. <p style="color: red;"> Registre una cuenta con el administrador</p>
                    </div>
                    </div>
                    <?php
                }
              }
            ?>

             
          </div>
        </div>
      </div>
    </div>
    <hr>
    Eres visitante registrate aqui

   
</body>
</html>
