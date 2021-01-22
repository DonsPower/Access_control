<?php 
    session_start();
    //importamos la clase auth
    require_once '../../clases/conexion.Class.php';
    require_once '../../clases/authController.Class.php';
    require_once '../../clases/visitorController.Class.php';
    require_once '../../clases/adminController.Class.php';
    //creamos el objeto cliente
    $auth=new auth;
    //objeto visitante
    $visitor= new visitor;
    $admin=new admin;
    $location="index.php";
   
   //TODO: El usuario administrador global no deberia de entrar en esta pagina., terminar el tiempo de ejecucion de los usuarios.
    //creamos variable cliente logueado y si no esta logueado lo redireccionamos 
   
    if (isset($_SESSION['nombre'])){
        $cliente = $_SESSION['nombre'];
        
    }else{
        header('Location: ../../index.php');
        die();
    }
?>
<!DOCTYPE html>
<html>
  <head>
    <title>Leer codigo QR</title>
    <link rel="stylesheet" href="../../css/visitante.css">
    <script type="text/javascript" src="../../lib/instascan.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.0/jquery-confirm.min.css">
    <!--JS-->
    
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.0/jquery-confirm.min.js"></script>
    <script src="https://kit.fontawesome.com/a076d05399.js"></script>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="../../css/dashboard.css">
    <script src="https://kit.fontawesome.com/a076d05399.js"></script>
</head>
<body>
<div class="card-top">

  <a href="../../dashboard.php"><img src="../../img/controlacceso.png" style="width: 20%; margin-top: 0.5%; margin-left: 10%; " alt="logo"></a>
  <a href="https://github.com/DonsPower/Access_control"><i class="fab fa-github" "></i></a>
  
  
</div>
  <div class="container">
      <h4>
        <?php echo $_SESSION['tipo']?>
      </h4>
      <!--Mostrar la fecha -->
      <div style="float:right; margin-top:20px">
        <h5>Dia: <span id="dia"></span> Hora: <span id="hora"></span></h5>
      </div>
      <!--muestra la ubicación de donde esta-->
      <nav aria-label="breadcrumb" style="margin-top: 20px;">
        <ol class="breadcrumb">
            <li class="breadcrumb-item">Inicio</li>
            <li class="breadcrumb-item active" aria-current="page">Lector de códigos QR</li>
        </ol>
        </nav>
        
      <hr>
    </div>
  <div class="container">

    <div class="row mt-5" style="width:58%; height:290px;">
      <div class="col-md-6" id="camera" >
        <div class="led"></div>

        <div class="strip">
       
        <video id="preview" class="video" style="height: 100%;"></video>
        </div>

      <!--<video id="preview" style="width: 95%; height:95%; "></video>-->
      </div>
      <div class="col-md-6">
        <div class="row" style="margin-left: 25%;" >
            <input type="hidden" id="idAdmin" value="<?php echo $_SESSION['AreaAdm']; ?>"></input>
            
            <div class="col"style="margin-top: 10px;" ><h6>Área: <?PHP echo $_SESSION['AreaAdm'];?></h6></div>
            <hr>
              <h5>Datos del usuario.</h5>
              <hr>
            <div class="row" style="margin-top: 10px;">
              <div class="col"><h6>Tipo de usuario: <span id="tipoqr"></span></h6></div>
            </div>
            <div class="row" style="margin-top: 10px;">
              <div class="col"> <h6> Nombre: <span id="nombreqr"></span></h6></div>
            </div>
            <div class="row" style="margin-top: 10px;">
              <div class="col"><h6>Hora de registro: <span id="horaqr"></span> </h6></div>
            </div>
            <br>
            <div class="row" style="margin-top: 10px;">
              <div class="col"> <h6> Codigo QR: <span id="salida"></span></h6></div>
            </div>
              <!--
              <div class="col">Hora de entrada: <span id="entradaqr"></span></div>
              <div class="col">Salida: <span id="nombreqr"></span></div>
            -->
            
        </div>
        
      </div>
    </div>
  
  </div>

    
    <script type="text/javascript">
      //Obtengo el id del adminstrador
      var idAdmin=$('#idAdmin').val();
      //console.log(idVis);
      //Obtenemos el día
     var hoy= new Date();
     var hora = hoy.getHours() + ':' + hoy.getMinutes()+':'+hoy.getSeconds();
     var month=hoy.getMonth();
     //console.log(hora);
     var fecha;
     if(month<10) {
       fecha = hoy.getDate() + '-0' + ( hoy.getMonth() + 1 ) + '-' + hoy.getFullYear();
      }else{
        fecha = hoy.getDate() + '-' + ( hoy.getMonth() + 1 ) + '-' + hoy.getFullYear();
     }
     //Obtengo la fecha que guardara el sistema 
     var fechaConc="";
     function mueveReloj(){
       fechaConc="";
        momentoActual = new Date()
        hora2 = momentoActual.getHours()
        minuto = momentoActual.getMinutes()
        segundo = momentoActual.getSeconds()
        if(minuto<10){
          horaImprimible = hora2 + ":0" + minuto + ":" + segundo;
        }else{
          horaImprimible = hora2 + ":" + minuto + ":" + segundo;
        }
        
        //console.log(horaImprimible);
        //document.form_reloj.reloj.value = horaImprimible
        document.getElementById("hora").innerHTML =horaImprimible;
        //fechaConc=hoy.getFullYear() + '-0'+(hoy.getMonth()+1)+'-'+hoy.getDate()+' '+hoy.getHours()+':'+hoy.getMinutes()+':'+hoy.getSeconds();
        
        setTimeout("mueveReloj()",1000)
      }
     
     //console.log(fechaConc);
     // document.getElementById("hora").innerHTML =hora;
      document.getElementById("dia").innerHTML =fecha;
      //Ejecuto la funcion para que el reloj se actualice automaticamente
      setInterval('mueveReloj()',1000);

      //Obtenemos la imagen de video.
      const args = { video: document.getElementById('preview') };

      window.URL.createObjectURL = (stream) => {
                  args.video.srcObject = stream;
                  return stream;
      };

      let valorQR;
      let scanner = new Instascan.Scanner(args);
      scanner.addListener('scan', function (content) {
        //salida=hoy.getFullYear() + '-0'+(hoy.getMonth()+1)+'-'+hoy.getDate()+' '+hoy.getHours()+':'+hoy.getMinutes()+':'+hoy.getSeconds()
        valorQR=content;
       
        $('#salida').html(content);
        //console.log(hora)
        //var horas=salida;
        var today = new Date();
        //let horaMandar=today.getUTCFullYear();
        //let horaMandar=today.getHours();
        let horaMandar=today.getMinutes();
          $.ajax({
            type:"POST",
            url: 'buscarqr.php',
            data: {
              id:valorQR,
              id2: idAdmin,
              segundos: today.getSeconds(),
              minutos: today.getMinutes(),
              horas:today.getHours(),
              dia: today.getDate(),
              mes: today.getMonth()+1,
              anio: today.getFullYear()
            }
          }).done(
            function (data){
              if(data==10){
                alertify.error("CODIGO QR NO VALIDO");
                $('#nombreqr').html("");
                    $('#tipoqr').html("");
                    $('#horaqr').html("");
                    $('#salida').html("");
              }else{  
                var resultado=data.split("||");
                console.log(resultado[4]);
                //lA ESTRUCTURA DE RESIVIR LOS DATOS ES=
                //"tipodeusuario"." "."Nombre user"."||"."hora"."||"."numero respuesta";
                //Resivimos el tipo de usuario que pase con el qr
                if(resultado[1]=="vis"){
                  //Elijimos el tipo de resultado que nos mando el servidor.
                  if(resultado[4]==0){
                    alertify.error("No se encontro el codigo QR");
                  }else if(resultado[4]==1){
                    $('#nombreqr').html(resultado[2]);
                    $('#tipoqr').html("Visitante");
                    $('#horaqr').html(resultado[3]);
                    alertify.success("Salida registrada.");
                  }else if(resultado[4]==2){
                    $('#nombreqr').html(resultado[2]);
                    $('#tipoqr').html("Visitante");
                    $('#horaqr').html(resultado[3]);
                    alertify.success("Entrada registrada.");
                  }
                  
                }
              }
             
            }
          );
        return content;
      });
      Instascan.Camera.getCameras().then(function (cameras) {
        if (cameras.length > 0) {
          scanner.start(cameras[0]);
        } else {
          console.error('No cameras found.');
        }
      }).catch(function (e) {
        console.error(e);
      });
      //console.log(($('#salida').val()).length);
      // if(valorQR!=undefined){
      //   console.log("holi");
      // }
      

    </script>
  </body>
  </html>
