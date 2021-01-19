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

<?php

$conex = mysqli_connect("localhost","root","","SistemaControlAcceso");
if(!$conex){
    die("no hay conexión: ".mysqli_connect_error());
}

$email = ($_POST['email']);

$query=mysqli_query($conex, "SELECT * FROM  administradores  WHERE email ='".$email."'");
$nr = mysqli_num_rows($query);

if($nr==1){
    header("Location:  cambiar.php?dato=2&var1=$email");
}else{
    header ("refresh:1; url=RestablecerContraseña.php?dato=1");
}



?>