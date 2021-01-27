<?php 
    session_start();
    //importamos la clase auth
    require_once 'clases/conexion.Class.php';
    require_once 'clases/authController.Class.php';
    require_once 'clases/visitorController.Class.php';
    require_once 'clases/adminController.Class.php';
    require_once 'clases/alumnosController.Class.php';
    require_once 'clases/paaeController.Class.php';
    require_once 'clases/perAcademicoController.Class.php';
    require_once 'clases/areaController.Class.php';
   
    
    date_default_timezone_set('GMT');
    //creamos el objeto cliente
    $auth=new auth;
    
    $alumno=new alumno;
    $perAcademico=new perAcademico;
    $paae=new paae;
    $area=new area;
    //objeto visitante
    $visitor= new visitor;
    $admin=new admin;
    $location="index.php";
   
   
    //creamos variable cliente logueado y si no esta logueado lo redireccionamos 
   
    if (isset($_SESSION['nombre'])){
        $cliente = $_SESSION['nombre'];
        //Checar los registros 
       
    }else{
        header('Location: ./index.php');
        die();
    }
    if($_SESSION['tipo']=='AdministradorArea'){
      
        $resultado=$admin->obtenerDia($_SESSION['AreaAdm']);
        while($row=$resultado->fetch(PDO::FETCH_ASSOC)){
          
          $data=explode(" ",$row['entrada']);
          $dia=explode("-",$data[0]);
           //año
          
          $total=date("j")-$dia[2];//dia
          $total2=date("n")-$dia[1];//mes
          $total3=date("Y")-$dia[0];
         // echo $total." ".$total2." ".$total3."||";
          if($total3>0){
             $visitor-> bajaVistQR($row['numcodqr'],$_SESSION['AreaAdm']);
           }else{
             if($total2>1){
              $visitor-> bajaVistQR($row['numcodqr'],$_SESSION['AreaAdm']);
             }else if($total>0){
              $visitor-> bajaVistQR($row['numcodqr'],$_SESSION['AreaAdm']);
             }
           }
           
        }
    }
   
    
?>
<!DOCTYPE html>
<html>
<head>
    <title>Dashboard</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!--CSS-->
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
    <link rel="stylesheet" href="css/dashboard.css">
    <link rel="stylesheet" href="lib/alertifyjs/css/alertify.css">
    <link rel="stylesheet" href="lib/alertifyjs/css/themes/default.css">
    <link rel="stylesheet" href="css/admin.css">
    
    <link rel="stylesheet" href="css/visitante.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.0/jquery-confirm.min.css">
    
    <!--JS-->
    
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.0/jquery-confirm.min.js"></script>
    <script src="https://kit.fontawesome.com/a076d05399.js"></script>
    <script src="js/dashboar.js"></script>
    <script src="lib/alertifyjs/alertify.js"></script>
    <script src="js/sesion.js"></script>
    <script src="js/alumno.js"></script>
    <script src="js/perAcademico.js"></script>
    <script src="js/menu.js"></script>
   
   
   
</head>
<body>
<div class="card-top">
  <form action="closeSeasson.php">
<button type="submit" class="btn btn-primary">Cerrar sesión</button>
</form>
  <a href="dashboard.php"><img src="img/controlacceso.png" style="height: auto; max-width: 20%; ; margin-left: 15%; margin-top:3px " alt="logo"></a>
  <a href="https://github.com/DonsPower/Access_control"><i class="fab fa-github" "></i></a>
  <p class="chip"><?php echo $_SESSION['nombre']?></p>
  
</div>
<input type="checkbox" id="check">
        <label for="check">
            <i class="fas fa-bars" id="btn"></i>
            <i class="fas fa-times" id="cancel"></i>
        </label>
        
  <div class="sidebar">
  <header>Inicio</header>
      <a href="#" id="altaAlumno"><i class="fas fa-user-plus"></i></i>Alumnos</a>
      <a href="#" id="altaPerAcademico"><i class="fas fa-user-plus"></i></i>Docente</a>
      <a href="#" id="altaPaae"><i class="fas fa-user-plus"></i></i>PAAE</a>
      <a href="#" id="altaVis"><i class="fas fa-user-plus"></i>Visitantes</i></a>
      
      <nav>
        
           
            <li class="submenu"><a href="#"><i class="fas fa-file-medical"></i>Reportes<i class="fas fa-caret-square-down more"></i></a>
            <ul>
                <li><a href="././Reporte/reporteSismoConsulta.php" id="altaRepSismo" target="_blank"><i class="fas fa-mountain"></i>Sismo</a></li>
                <li><a href="././Reporte/reporteIncendioConsulta.php" id="altaRepSismo" target="_blank"><i class="fab fa-free-code-camp"></i>Incendio</a></li>
                <li><a href="././Reporte/reporteArtExploConsulta.php" id="altaRepSismo" target="_blank"><i class="fas fa-bomb"></i>Artefacto Explosivo</a></li>
            </ul></li>
         
    </nav>

    <!--  <a href="#"><i class="fas fa-file-medical"></i>Reportes</a>
      
				<ul>
        <li><a href="/Reporte/reporteSismo.php" id="altaRepSismo" target="_blank">Sismo</a></li>
					<li><a href="/Reporte/reporteIncendio.php" id="altaRepInc" target="_blank">Incendio</a></li>
					<li><a href="/Reporte/reporteArtExplo.php" id="altaRepAE" target="_blank">Artefacto explosivo</a></li>
				</ul>
			-->

      <?php
      //Checamos tipo de administrador.
        if($_SESSION['tipo']=='AdministradorGlobal'){
          ?>
          <a href="#" id="altaAdmin"><i class="fas fa-address-card"></i>Alta administradores</i></a>
          <a href="#" id="altaAreaAdmin"><i class="fas fa-clinic-medical"></i>Alta área</i></a>
          <?php
        }
        ?>
        <a href="#"><i class="fas fa-asterisk"></i>Nosotros</a>
        <div class="container mt-5" >
                   <!--Para dar de baja a todos los vistantes-->
           <?php
           if($_SESSION['tipo']=="AdministradorArea"){
            ?>
            <button  type="button" id="smodalBtn" onclick="darBaja(`<?php echo $_SESSION['AreaAdm']?>`)" class="btn btn-danger">Dar de baja visitantes activos</button>
          <?php
           }        
          ?>
        
        </div>
       

  </div>
  <!--ALL CODE -->    
  
  <div id="main">
            
          <div class=" container">
              <h4>
                <?php echo $_SESSION['tipo']?>
              </h4>
              <nav aria-label="breadcrumb" style="margin-top: 20px;">
        <ol class="breadcrumb">
            <li class="breadcrumb-item">Inicio / </li>
            
        </ol>
        </nav>
              <hr>
            </div>

            <div class="container ">
            <div class="row">
                      <?php 
                        if ($_SESSION['tipo']=='AdministradorArea') {
                      ?>
                        <div class="card" style="background-color:#4c6ef5;; border-radius:10px">
                            <div >
                            <i class="fas fa-qrcode" style="color: white;"></i>
                            <h5 class="card-title" style="margin-top: 10px;">Leer códigos QR</h5>
                            <a href="visitante/readqr/index.php" id="lector" class="btn btn-primary" style="float:right; margin-bottom:10px; width:100px;">Ir <i class="fas fa-arrow-right"></i></a>
                            </div>
                           
                        </div>
                      <?php   
                        }
                      ?>
                    </div>
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
                    <h5 class="card-title" style="margin-top: 10px;">Total de áreas</h5>
                    <h3 class="card-text"><?php echo $area->getArea();?></h3>
                      <a href="#" id="totalArea" class="btn btn-primary" style="float:right; margin-bottom:10px; width:100px;">Ir <i class="fas fa-arrow-right"></i></a>
                    </div>
                  
                </div>
              </div>
                  
            </div>
            <div class="row">
            <div class="col mb-6 ">
                <div class="card card-5 text-white  bg-success " >
                <div class="card-body">
                    <h5 class="card-title" style="margin-top: 10px;">Total alumnos</h5>
                    <h3 class="card-text"><?php echo $alumno->getDataAlumno();?></h3>
                      <a href="#" id="tablaAlumno" class="btn btn-primary" style="float:right; margin-bottom:10px; width:100px;">Ir <i class="fas fa-arrow-right"></i></a>
                    </div>
                  
                </div>
              </div>
              <div class="col mb-6 ">
                <div class="card card-5 text-white  bg-success " >
                <div class="card-body">
                    <h5 class="card-title" style="margin-top: 10px;">Total PAAE</h5>
                    <h3 class="card-text"><?php echo $paae->getDataPaae();?></h3>
                      <a href="#" id="tablaPaae" class="btn btn-primary" style="float:right; margin-bottom:10px; width:100px;">Ir <i class="fas fa-arrow-right"></i></a>
                    </div>
                  
                </div>
              </div>
              <div class="col mb-6 ">
                <div class="card card-5 text-white  bg-success " >
                <div class="card-body">
                    <h5 class="card-title" style="margin-top: 10px;">Total Personal Academico</h5>
                    <h3 class="card-text"><?php echo $perAcademico->getDataPerAcademico();?></h3>
                      <a href="#" id="tablaPerAcademico" class="btn btn-primary" style="float:right; margin-bottom:10px; width:100px;">Ir <i class="fas fa-arrow-right"></i></a>
                    </div>
                  
                </div>
              </div>
            </div>


             <!--Modal cuando se activa editar-->
     <div class="modal" id="myModal" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title">Alta área</h5>
              
                <span  class="close1 close">&times; </span>
              
            </div>
            <div class="modal-body">
              <div class="container-fluid">
              
                <div class="row">
                  <div class="col-4 col-sm-4">área<input type="text" name="name" id="areaNew"></div>
                  
                </div>
                
              
              
              </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-primary" id="editActualizarPaae">Guardar</button>
             
            </div>
          </div>
        </div>
      </div>
</body>
</html> 
