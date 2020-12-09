<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Control de acceso</title>
    <!--CSS - Bootstrap-->
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
    <link rel="stylesheet" href="css/style.css">
    <!--JavaScript-->
</head>
<body background="red">
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container-fluid">
    
        <a class="navbar-brand" href="#">Control de acceso</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarText" aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarText">
        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
            <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="#">Home</a>
            </li>
            <li class="nav-item">
            <a class="nav-link" href="#">Features</a>
            </li>
            <li class="nav-item">
            <a class="nav-link" href="#">Pricing</a>
            </li>
        </ul>
        <span class="navbar-text">
            <a href="index.html">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16" width="32" height="32"><path fill-rule="evenodd" d="M8 0C3.58 0 0 3.58 0 8c0 3.54 2.29 6.53 5.47 7.59.4.07.55-.17.55-.38 0-.19-.01-.82-.01-1.49-2.01.37-2.53-.49-2.69-.94-.09-.23-.48-.94-.82-1.13-.28-.15-.68-.52-.01-.53.63-.01 1.08.58 1.23.82.72 1.21 1.87.87 2.33.66.07-.52.28-.87.51-1.07-1.78-.2-3.64-.89-3.64-3.95 0-.87.31-1.59.82-2.15-.08-.2-.36-1.02.08-2.12 0 0 .67-.21 2.2.82.64-.18 1.32-.27 2-.27.68 0 1.36.09 2 .27 1.53-1.04 2.2-.82 2.2-.82.44 1.1.16 1.92.08 2.12.51.56.82 1.27.82 2.15 0 3.07-1.87 3.75-3.65 3.95.29.25.54.73.54 1.48 0 1.07-.01 1.93-.01 2.2 0 .21.15.46.55.38A8.013 8.013 0 0016 8c0-4.42-3.58-8-8-8z"></path></svg>
            </a>   
        </span>
        </div>
    </div>
    </nav>

    <div class="row">
  <div class="col-sm-6">
    <div class="text-center m-2">
      <div class="card-body">
      <img src="img/logo-ControAcces.png" alt="">
        <div class="container mt-5">
          <h1 class="card-title">Lorem ipsum, dolor sit amet consectetur adipisicing elit. </h1>
          <p class="card-text">With supporting text below as a natural lead-in to additional content.</p>
        </div>
      </div>
    </div>
  </div>
  <div class="col-sm-5">
    <div class="container m-5">  
      <form method="POST">
        <h1>Bienvenido</h1>          
        <div class="card">
        <div class="container mt-3">
          <h4>Inicia sesion</h4>
          <div class="mb-3">
            <label for="exampleFormControlInput1" class="form-label">Correo</label>
            <input type="email" name="email" style="width: 100%;" value="asd@hotmail.com" placeholder="name@example.com">
          </div>
          <div class="mb-3">
            <label for="exampleFormControlTextarea1" class="form-label">Contraseña</label>
            <input type="password" name="password" style="width: 100%;" value="asd"> </input>
          </div>
          <div class=" mb-3">
            <button class="btn btn-primary" type="submit">Enviar</button>
          </div>
        </div>
        </div>
      </form>
    </div>
  </div>
  </div>
</div>
</body>
</html>
<?php
  session_start();
  require_once ('./clases/authController.Class.php');
  if (!empty($_POST['email']) && !empty($_POST['password'])) {
		$usuario=$_POST['email'];
		$password= $_POST['password'];
		$auth= new auth;
		$row= $auth->addUser($usuario,$password); 
		if ($row) {
			//Almaceno el usuario el la variable sesion para utilizarla despues
			 $_SESSION['nombre'] = $usuario;
			 //Almacenamos tiempo.
       $_SESSION['tiempo'] = time();
       echo "Si funciona";
			header('location: menu.php');
		}else{
      echo 'no funciona';
			$resultado=true;
		}
	}
?>