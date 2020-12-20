<?php
//$_SESSION["token"] = md5(uniqid(mt_rand(), true)); add token en la sesion.n
  session_start();
  require_once ('./clases/authController.Class.php');
  if (!empty($_POST['email']) && !empty($_POST['password'])) {
		$usuario=$_POST['email'];
		$password= $_POST['password'];
    //Llamaos a la clase.
    $auth= new auth;
    $row= $auth->addUser($usuario,$password); 

		if (!empty($row)) {
      //Obtengo los datos del usuario
      $userinfo=$auth->userInfo($usuario, $password);
      //Almaceno el usuario el la variable sesion para utilizarla despues
      //print_r($userinfo); 
      $_SESSION['nombre'] = $userinfo['name']." ".$userinfo['ApellidoPAdm'];
			 //Almacenamos tiempo.
       $_SESSION['tiempo'] = time();
       $_SESSION['tipo']= $userinfo['Tipo'];
       $_SESSION['AreaAdm']=$userinfo['AreaAdm'];
       //echo "Si funciona";
			header('location: dashboard.php');
		}else{
      
      //TODO: Mandar notificacion con js de usuario no registrado.
      $resultado=true;
      
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
</head>
<body>
  <div class="container">
    <div class="row ">
      <div class="col-sm-5" style="width: 50%; margin-left: 6%; margin-top:18%;">
      <!--<img src="img/logo.png" alt="logo-ControlAccess" width="80" height="80">-->
        <img src="img/controlacceso.png"  width="320" height="60">
        <div class="titulos" style="margin-top: 10px;">Lorem ipsum dolor sit amet consectetur adipisicing elit. Dignissimos ea commodi debitis </div>
      </div>
      <div class="col-sm-5" style="margin-top:10%; text-align: center;">
        <div class="card">
        <div class="mb-3">
           <form class="container" method="POST" autocomplete="off">
            <input type="email" name="email"  REQUIERED maxlength="30"  autofocus="1" placeholder="Correo electronico" aria-label="Correo electronico">
            <input type="password" name="password" REQUIERED maxlength="30"  autofocus="0" placeholder="Contraseña" aria-label="Contraseña">
            <button type="submit" class="buttomPrimary">Iniciar Sesión</button>
            </form>
            <div class="mt-3">
            <a  href="">¿Se te olvido tu contraseña?</a>
            </div>
            <hr>
            <?php
              if (!empty($resultado)) {
                # code...
              if($resultado){
                ?>
                <div class="container">

                <div class="alert alert-danger content" role="alert">
                  Usuario o contraseña incorrecto!
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
    <script src="https://code.jquery.com/jquery-3.2.1.js"></script>
<script type="text/javascript">
$(document).ready(function() {
    setTimeout(function() {
        $(".content").fadeOut(2000);
    },3000);

});
</script>
   
</body>
</html>
