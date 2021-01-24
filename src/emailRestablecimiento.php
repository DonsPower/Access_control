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
<form action="emailRestablecimiento.php" method="post">

  <div class="container">

     <div class="row ">
      
      <div class="col-sm-5" style="width: 50%; margin-left: 6%; margin-top:16%;">
      <!--<img src="img/logo.png" alt="logo-ControlAccess" width="80" height="80">-->
        <img src="img/controlacceso.png"  width="320" height="100">
       
      </div>
      <div class="col-sm-5" style="margin-top:10%; text-align: center;">
        <div class="card">
        <div class="mb-3">
		<h1 vertical-align:middle>   Restablecer contraseña </h1>
			<input type="text" name="email" placeholder="Ingresa tu nombre de Usuario"/>
		

			<br><br>
            <input type="submit" class="btn btn-primary btn-block" value="Enviar Correo" />
		<br>
    <br>
    <td><a href="metodos.php" class="btn btn-primary btn-block" > Regresar</a></td>
	</div>
</form>
			
		
	</div>
</div>





<?php
        
		try{
			if(isset($_POST['email']) && !empty($_POST['email'])){
                $token = substr( md5(microtime()), 1, 10);
                $email = $_POST['email'];
                
                //Conexion con la base
             
                // Check connection
                if ($conex->connect_error) {
                    die("Connection failed: " . $conex->connect_error);
                } 
                
                $sql = "Update administradores Set token='$token' Where email='$email'";

                if ($conex->query($sql) === TRUE) {
                    echo "correcto: ";
                } else {
                    echo "Error modificando: " . $conex->error;
                }
                
                $to = $_POST['email'];//"mafrosh@gmail.com"
                $subject = "Restablecer Contraseña ";
                $message = '<html><body>';
                $message .= '<h1 style="color:#f40;">Hola!</h1>';
                $message .= "El sistema le asigno el siguiente token " . $token ;
                $message .= "\n copia e ingresa al siguiente enlace para restablecer tu contraseña \n Si no solicitaste cambio de contraseña omite este correo";
                $message .= '<p style="color:#080;font-size:18px;"></p>';
                $message .= '<a href=" https://a1009814fcec.ngrok.io/Access_control/src/emailToken.php" >Restablecer contraseña </a>';
                $message .= '</body></html>';
                $headers = "From:  mafrosh13@gmail.com";  
                            'Reply-To: .mafrosh13@gmail.com' ."\r\n" .
                            'X-Mailer: PHP/' . phpversion();
                
                $headers  = 'MIME-Version: 1.0' . "\r\n";
                $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
               
             
                mail($to, $subject, $message, $headers, $token);
                echo 'Correo enviado satisfactoriamente a ' . $_POST['email'];
            }
            else 
                echo 'Informacion incompleta';
		}
		catch (Exception $e) {
			echo 'Excepción capturada: ',  $e->getMessage(), "\n";
		}
           
        ?>
    </body>
</html>

</body>


</html>