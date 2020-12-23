<?php 
    session_start();
    //importamos la clase auth
    require_once 'clases/authController.Class.php';
    require_once 'clases/visitorController.Class.php';
    require_once 'clases/adminController.Class.php';
    //creamos el objeto cliente
    $auth=new auth;
    //objeto visitante
    $visitor= new visitor;
    $admin=new admin;
    $location="index.php";
   
    if(!empty($_POST['conf'])){
      if($_POST['conf']=="confirmar")echo $visitor->deathVisitor();
      else{
        echo "Palabra incorrecta";
      }
    }
    //creamos variable cliente logueado y si no esta logueado lo redireccionamos 
   
    if (isset($_SESSION['nombre'])){
        $cliente = $_SESSION['nombre'];
        
            //Enviamos el tiempo y si pasan ciertos minutos lo redireccionamos
            if(isset($_SESSION['tiempo'])){
                echo $auth-> lifeSession($_SESSION['tiempo'],$location );
            } else {
                //Activamos sesion tiempo con cualquier uso de la pagina.
                $_SESSION['tiempo'] = time();
           } 
    }else{
        header('Location: ./index.php');
        die();
    }
?>
<!DOCTYPE html>
<html>
<head>
    <title>Dashboard</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="css/style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://kit.fontawesome.com/a076d05399.js"></script>
    <link rel="stylesheet" href="css/dashboard.css">
</head>
<body>
<div class="card-top">
  <form action="closeSeasson.php">
<button type="submit" class="btn btn-success">Cerrar sesión</button>
</form>
  <img src="img/controlacceso.png" style="width: 270px; margin-top: 13px; margin-left: 200px; " alt="logo">
  <a href="https://github.com/DonsPower/Access_control"><i class="fab fa-github" "></i></a>
  <p class="chip"><?php echo $_SESSION['nombre']?></p>
  
</div>
<input type="checkbox" id="check">
        <label for="check">
            <i class="fas fa-bars" id="btn"></i>
            <i class="fas fa-times" id="cancel"></i>
        </label>
        
  <div class="sidebar">
  <header>Dashboard</header>
      <a href="#"><i class="fas fa-user-plus"></i></i>Alumnos</a>
      <a href="#"><i class="fas fa-user-plus"></i></i>Docente</a>
      <a href="#"><i class="fas fa-user-plus"></i></i>PAEE</a>
      <a href="#" id="alta"><i class="fas fa-user-plus"></i>Visitantes</i></a>
      <a href="#"><i class="fas fa-file-medical"></i>Reportes</a>
      <?php
      //Checamos tipo de administrador.
        if($_SESSION['tipo']=='AdministradorGlobal'){
          ?>
          <a href="#"><i class="fas fa-address-card"></i>Alta administradores</i></a>
          <?php
        }
        ?>
        <a href="#"><i class="fas fa-asterisk"></i>Nosotros</a>
        <div class="container mt-5" >
        <form method="POST">
          <input type="text" name="conf" id="conf"></input>
          <button class="btn btn-danger" type="submit" id="button">Muerte al visitante</button>
        </form>
        </div>

  </div>
  <!--ALL CODE -->    
  <div id="main">
  <div class=" container">
      <h4>
        <?php echo $_SESSION['tipo']?>
      </h4>
      <hr>
    </div>
        
            <div class="container ">
                <div class="row">
                    <?php 
                    if($_SESSION['tipo']=='AdministradorGlobal'){?>
                      <div class="col mb-6 ">
                      <div class="card card-5 text-white bg-success " >
                      <div class="card-body">
                      <h5 class="card-title" style="margin-top: 10px;">Total administradores</h5>
                        <h3 class="card-text"><?php echo $admin->getDataAdmin()?></h3>
                        <a href="#" id="totalAdmin" class="btn btn-primary" style="float:right; margin-bottom:10px; width:100px;">Ir <i class="fas fa-arrow-right"></i></a>
                      </div>
                      </div>
                      </div>
                    <?php
                      }
                    ?>
              <div class="col mb-6">
                <div class="card card-5 text-white bg-success " >
                <div class="card-body">
                    <h5 class="card-title" style="margin-top: 10px;">Total visitantes</h5>
                      <h3 class="card-text"><?php echo $visitor->getVisitorData();?></h3>
                      <a href="#" id="totalVist" class="btn btn-primary" style="float:right; margin-bottom:10px; width:100px;">Ir <i class="fas fa-arrow-right"></i></a>
                    </div>
                  </div>
              </div>
              <div class="col mb-6 ">
                <div class="card card-5 text-white  bg-success " >
                <div class="card-body">
                    <h5 class="card-title" style="margin-top: 10px;">Total usuarios</h5>
                    <h3 class="card-text"><?php echo $visitor->getVisitorActive();?></h3>
                      <a href="#" class="btn btn-primary" style="float:right; margin-bottom:10px; width:100px;">Ir <i class="fas fa-arrow-right"></i></a>
                    </div>
                  
                </div>
              </div>
             
            </div>
            
            </div>
            
      
        <div id="prueba"></div>
        <script>
                      $(document).ready(function(){
                        $("#totalVist").click(function(){
                          $("#main").load("altaVisitantes/index.php");
                        });
                      });
                      $(document).ready(function(){
                        $("#totalAdmin").click(function(){
                          $("#main").load("altaAdmin/index.php");
                        });
                      });
         </script>
        
</body>
</html> 
