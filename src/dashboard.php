<?php 
    session_start();
    //importamos la clase auth
    require_once 'clases/authController.Class.php';
    //creamos el objeto
    $auth=new auth;
    $location="index.php";
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
<link rel="stylesheet" href="css/dasch.css">
<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
    <link rel="stylesheet" href="css/style.css">
    <script type="text/javascript" src="js/dash.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

</head>
<body>

  <div id="mySidebar" class="sidebar">
    <div class="container">
      
    <div class="chip">
      <img src="img/img_avatar.png" alt="Person" width="96" height="96">
      <?php echo $_SESSION['nombre']?>
    </div>
    <hr>
    </div>
    <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">×</a>
    
    <a href="#">
        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-upc-scan" viewBox="0 0 16 16">
          <path fill-rule="evenodd" d="M1.5 1a.5.5 0 0 0-.5.5v3a.5.5 0 0 1-1 0v-3A1.5 1.5 0 0 1 1.5 0h3a.5.5 0 0 1 0 1h-3zM11 .5a.5.5 0 0 1 .5-.5h3A1.5 1.5 0 0 1 16 1.5v3a.5.5 0 0 1-1 0v-3a.5.5 0 0 0-.5-.5h-3a.5.5 0 0 1-.5-.5zM.5 11a.5.5 0 0 1 .5.5v3a.5.5 0 0 0 .5.5h3a.5.5 0 0 1 0 1h-3A1.5 1.5 0 0 1 0 14.5v-3a.5.5 0 0 1 .5-.5zm15 0a.5.5 0 0 1 .5.5v3a1.5 1.5 0 0 1-1.5 1.5h-3a.5.5 0 0 1 0-1h3a.5.5 0 0 0 .5-.5v-3a.5.5 0 0 1 .5-.5z"/>
          <path d="M3 4.5a.5.5 0 0 1 1 0v7a.5.5 0 0 1-1 0v-7zm2 0a.5.5 0 0 1 1 0v7a.5.5 0 0 1-1 0v-7zm2 0a.5.5 0 0 1 1 0v7a.5.5 0 0 1-1 0v-7zm2 0a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-.5.5h-1a.5.5 0 0 1-.5-.5v-7zm3 0a.5.5 0 0 1 1 0v7a.5.5 0 0 1-1 0v-7z"/>
        </svg>
       Leer codigo QR
    </a>
    <a href="#" id="regVis">
      <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-bookmark-plus" viewBox="0 0 16 16">
        <path fill-rule="evenodd" d="M2 2a2 2 0 0 1 2-2h8a2 2 0 0 1 2 2v13.5a.5.5 0 0 1-.777.416L8 13.101l-5.223 2.815A.5.5 0 0 1 2 15.5V2zm2-1a1 1 0 0 0-1 1v12.566l4.723-2.482a.5.5 0 0 1 .554 0L13 14.566V2a1 1 0 0 0-1-1H4z"/>
        <path fill-rule="evenodd" d="M8 4a.5.5 0 0 1 .5.5V6H10a.5.5 0 0 1 0 1H8.5v1.5a.5.5 0 0 1-1 0V7H6a.5.5 0 0 1 0-1h1.5V4.5A.5.5 0 0 1 8 4z"/>
      </svg>
      Registrar visitante</a>
    <?php
    //Checamos tipo de administrador.
      if($_SESSION['tipo']=='AdministradorArea'){
        ?>
        <a href="" id="regAdmin">
          <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-bookmark-plus" viewBox="0 0 16 16">
            <path fill-rule="evenodd" d="M2 2a2 2 0 0 1 2-2h8a2 2 0 0 1 2 2v13.5a.5.5 0 0 1-.777.416L8 13.101l-5.223 2.815A.5.5 0 0 1 2 15.5V2zm2-1a1 1 0 0 0-1 1v12.566l4.723-2.482a.5.5 0 0 1 .554 0L13 14.566V2a1 1 0 0 0-1-1H4z"/>
            <path fill-rule="evenodd" d="M8 4a.5.5 0 0 1 .5.5V6H10a.5.5 0 0 1 0 1H8.5v1.5a.5.5 0 0 1-1 0V7H6a.5.5 0 0 1 0-1h1.5V4.5A.5.5 0 0 1 8 4z"/>
          </svg>
        Registrar administrador</a>
        <?php
      }
      ?>
      <a href="">
        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-clipboard-plus" viewBox="0 0 16 16">
          <path fill-rule="evenodd" d="M4 1.5H3a2 2 0 0 0-2 2V14a2 2 0 0 0 2 2h10a2 2 0 0 0 2-2V3.5a2 2 0 0 0-2-2h-1v1h1a1 1 0 0 1 1 1V14a1 1 0 0 1-1 1H3a1 1 0 0 1-1-1V3.5a1 1 0 0 1 1-1h1v-1z"/>
          <path fill-rule="evenodd" d="M9.5 1h-3a.5.5 0 0 0-.5.5v1a.5.5 0 0 0 .5.5h3a.5.5 0 0 0 .5-.5v-1a.5.5 0 0 0-.5-.5zm-3-1A1.5 1.5 0 0 0 5 1.5v1A1.5 1.5 0 0 0 6.5 4h3A1.5 1.5 0 0 0 11 2.5v-1A1.5 1.5 0 0 0 9.5 0h-3zM8 7a.5.5 0 0 1 .5.5V9H10a.5.5 0 0 1 0 1H8.5v1.5a.5.5 0 0 1-1 0V10H6a.5.5 0 0 1 0-1h1.5V7.5A.5.5 0 0 1 8 7z"/>
        </svg>
        Generar reportes
      </a>
      <a href="#">
        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-asterisk" viewBox="0 0 16 16">
          <path fill-rule="evenodd" d="M8 0a1 1 0 0 1 1 1v5.268l4.562-2.634a1 1 0 1 1 1 1.732L10 8l4.562 2.634a1 1 0 1 1-1 1.732L9 9.732V15a1 1 0 1 1-2 0V9.732l-4.562 2.634a1 1 0 1 1-1-1.732L6 8 1.438 5.366a1 1 0 0 1 1-1.732L7 6.268V1a1 1 0 0 1 1-1z"/>
        </svg>
        Nosotros
      </a>
    <a href="closeSeasson.php">
      <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-backspace-reverse" viewBox="0 0 16 16">
        <path fill-rule="evenodd" d="M9.08 2H2a1 1 0 0 0-1 1v10a1 1 0 0 0 1 1h7.08a1 1 0 0 0 .76-.35L14.682 8 9.839 2.35A1 1 0 0 0 9.08 2zM2 1a2 2 0 0 0-2 2v10a2 2 0 0 0 2 2h7.08a2 2 0 0 0 1.519-.698l4.843-5.651a1 1 0 0 0 0-1.302L10.6 1.7A2 2 0 0 0 9.08 1H2zm7.854 4.146a.5.5 0 0 1 0 .708L7.707 8l2.147 2.146a.5.5 0 0 1-.708.708L7 8.707l-2.146 2.147a.5.5 0 0 1-.708-.708L6.293 8 4.146 5.854a.5.5 0 1 1 .708-.708L7 7.293l2.146-2.147a.5.5 0 0 1 .708 0z"/>
      </svg>
      Cerrar sesión</a>
  </div>
  <!--ALL CODE -->    
  <div id="main">
          
  <div class="topnav">
    <a class="active" onclick="openNav()">☰</a>
    <h2>Control de acceso</h2>
  </div>
    <div class="container mt-5">
      <h3>
        <?php echo $_SESSION['tipo']?>
      </h3>
      <hr>
    </div>
    <!--card-->
    <div class="container ">
      <div class="row">
        <?php 
        if($_SESSION['tipo']=='AdministradorGlobal'){?>
        <div class="col mb-6 p-3">
        <div class="card card-5 text-white bg-success " >
          <h5 class="card-title">Total de administradores</h5>
          <p class="card-text">0</p>
        </div>
        </div>
        <?php
          }
        ?>
        <div class="col mb-6 p-3">
          <div class="card card-5 text-white bg-dark " >
            <h5 class="card-title">Total de visitantes</h5>
            <p class="card-text">0</p>
          </div>
        </div>
        <div class="col mb-6 p-3">
          <div class="card card-5 text-white bg-danger " >
            <h5 class="card-title">Total de visitantes activos </h5>
            <p class="card-text">0</p>
          </div>
        </div>
      </div>
      <!--containber-->
      <hr>
       <div class="container" id="contenido"></div>
    
     
        <script>
              $('#regVis').click(function(){
              var esperar= 2000;
              $.ajax({
                  url: "altaVisitantes/index.php",
                  beforeSend: function(){
                    
                      $('#contenido').text('Cargando...');
                  },
                  success: function(data){
                    
                      setTimeout(function(){
                          $('#contenido').html(data);
                      },esperar);
                  }
              });
          });
          $('#regAdm').click(function(){
              var esperar= 2000;
              $.ajax({
                  url: "altaAdmin/index.php",
                  beforeSend: function(){
                    
                      $('#contenido').text('Cargando...');
                  },
                  success: function(data){
                    
                      setTimeout(function(){
                          $('#contenido').html(data);
                      },esperar);
                  }
              });
          });
        </script>
         
    
</body>
</html> 
