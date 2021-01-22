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
    $usuario=$_POST['email'];
    $contraseña=$_POST['contraseña'];

    session_start();
    $_SESSION['email']=$usuario;


    include('con_db.php');

    $consulta="SELECT*FROM administradores where email='$usuario' and contraseña='$contraseña'";
    $resultado=mysqli_query($conex,$consulta);

    $row=mysqli_num_rows($resultado);

    if($row){
        header("Location: AltaAdministradores/MP_AdmG.php");
    }else{
        ?>
        <?php
            include("index.php");  
            header("Location: index.php");
        ?>
     
       <h3> Error en la Autenticación</h3>	
	</div>       
    
       <?php 
}        

mysqli_free_result($resultado);
mysqli_close($conex);