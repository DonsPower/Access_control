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
    <link rel="stylesheet" href="../../lib/alertifyjs/css/alertify.css">
    <link rel="stylesheet" href="../../lib/alertifyjs/css/themes/default.css">
    <script src="../../lib/alertifyjs/alertify.js"></script>
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

    <div class="row mt-5">
      <div class="col">
             <div class="col-md-6" id="camera" style="width:300px; margin-left:25%">
        <div class="led"></div>
        <div class="strip">
          <video id="preview" class="video" style="height: 100%; "></video>
        </div>
      </div>
      </div>
      <div class="col">
      <input type="hidden" id="idAdmin" value="<?php echo $_SESSION['AreaAdm']; ?>"></input>
        <div class="row" style="margin-top:10px;">
          <div clas="col"><h4>Datos del usuario</h4></div>
          <div class="col" style="margin-lefth:10px;"><h4>Área: <?PHP echo $admin-> buscarArea($_SESSION['AreaAdm']);?></h4></div>
        </div>
        <hr>
        <div class="row"><div class="col"><h6>Tipo de usuario: <span id="tipoqr"></span></h6></div></div>
        <div class="row"><div class="col"> <h6> Nombre: <span id="nombreqr"></span></h6></div></div>
        <div class="row"><div class="col"><h6>Hora de registro: <span id="horaqr"></span> </h6></div></div>
        <div class="row"><div class="col"> <h6> Codigo QR: <span id="salida"></span></h6></div></div>
      </div>
      <!-- <div class="col-md-6" id="camera" >
        <div class="led"></div>
        <div class="strip">
          <video id="preview" class="video" style="height: 100%;"></video>
        </div>
      </div> -->
      <!-- <div class="col-md-6">
        <div class="row" style="text-align: center;" style="margin-left: 30%;">
        <div class="row">
            <div class="col" style="margin-left: 50%;"><h5>Datos del Usuario</h5></div>
            <hr>
        </div>
          <div class="row" >
              <div class="col"style="margin-top: 10px;" ><h6>Área: <?PHP echo $admin-> buscarArea($_SESSION['AreaAdm']);?></h6></div>
          </div>

            
            
            
             
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
            
        <!-- </div>
        
      </div>
    </div> 
   -->
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
      setInterval('eliminarCampos()',30000);
     function eliminarCampos(){
      $('#nombreqr').html("");
                    $('#tipoqr').html("");
                    $('#horaqr').html("");
                    $('#salida').html("");
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
                    (async () => {
                    const rawResponse = await fetch('http://localhost:8081/ledred', {
                        method: 'POST',
                        dataType: 'json',
                        headers: {
                        'Accept': 'application/json',
                        'Content-Type': 'application/json'
                        },
                        body: JSON.stringify({estado: 1})
                    });
                    const content = await rawResponse.json();

                    console.log(content);
                    })();
              }else{  
                var resultado=data.split("||");
                console.log(resultado);
                console.log(resultado[4]);
                //lA ESTRUCTURA DE RESIVIR LOS DATOS ES=
                //"tipodeusuario"." "."Nombre user"."||"."hora"."||"."numero respuesta";
                //Resivimos el tipo de usuario que pase con el qr
                if(resultado[1]=="vis"){
                  //Elijimos el tipo de resultado que nos mando el servidor.
                  if(resultado[4]==0){
                    alertify.error("No se encontro el codigo QR");
                    (async () => {
                    const rawResponse = await fetch('http://localhost:8081/ledred', {
                        method: 'POST',
                        dataType: 'json',
                        headers: {
                        'Accept': 'application/json',
                        'Content-Type': 'application/json'
                        },
                        body: JSON.stringify({estado: 1})
                    });
                    const content = await rawResponse.json();

                    console.log(content);
                    })();
                  }else if(resultado[4]==1){
                    $('#nombreqr').html(resultado[2]);
                    $('#tipoqr').html("Visitante");
                    $('#horaqr').html(resultado[3]);
                    alertify.success("Salida registrada.");
                    (async () => {
                    const rawResponse = await fetch('http://localhost:8081/led', {
                        method: 'POST',
                        dataType: 'json',
                        headers: {
                        'Accept': 'application/json',
                        'Content-Type': 'application/json'
                        },
                        body: JSON.stringify({estado: 1})
                    });
                    const content = await rawResponse.json();

                    console.log(content);
                    })();
                  }else if(resultado[4]==2){
                    $('#nombreqr').html(resultado[2]);
                    $('#tipoqr').html("Visitante");
                    $('#horaqr').html(resultado[3]);
                    alertify.success("Entrada registrada.");
                    (async () => {
                    const rawResponse = await fetch('http://localhost:8081/led', {
                        method: 'POST',
                        dataType: 'json',
                        headers: {
                        'Accept': 'application/json',
                        'Content-Type': 'application/json'
                        },
                        body: JSON.stringify({estado: 1})
                    });
                    const content = await rawResponse.json();

                    console.log(content);
                    })();
                  }
                  
                }else if(resultado[1]=="alu"){
                  if(resultado[4]==0){
                    alertify.error("No se encontro el codigo QR");
                    (async () => {
                    const rawResponse = await fetch('http://localhost:8081/ledred', {
                        method: 'POST',
                        dataType: 'json',
                        headers: {
                        'Accept': 'application/json',
                        'Content-Type': 'application/json'
                        },
                        body: JSON.stringify({estado: 1})
                    });
                    const content = await rawResponse.json();

                    console.log(content);
                    })();
                  }else if(resultado[4]==1){
                    $('#nombreqr').html(resultado[2]);
                    $('#tipoqr').html("Alumno");
                    $('#horaqr').html(resultado[3]);
                    alertify.success("Salida registrada.");
                    (async () => {
                    const rawResponse = await fetch('http://localhost:8081/led', {
                        method: 'POST',
                        dataType: 'json',
                        headers: {
                        'Accept': 'application/json',
                        'Content-Type': 'application/json'
                        },
                        body: JSON.stringify({estado: 1})
                    });
                    const content = await rawResponse.json();

                    console.log(content);
                    })();
                  }else if(resultado[4]==2){
                    $('#nombreqr').html(resultado[2]);
                    $('#tipoqr').html("Alumno");
                    $('#horaqr').html(resultado[3]);
                    alertify.success("Entrada registrada.");
                    (async () => {
                    const rawResponse = await fetch('http://localhost:8081/led', {
                        method: 'POST',
                        dataType: 'json',
                        headers: {
                        'Accept': 'application/json',
                        'Content-Type': 'application/json'
                        },
                        body: JSON.stringify({estado: 1})
                    });
                    const content = await rawResponse.json();

                    console.log(content);
                    })();
                  }
                }else if(resultado[1]=="pae"){
                  if(resultado[4]==0){
                    alertify.error("No se encontro el codigo QR");
                    (async () => {
                    const rawResponse = await fetch('http://localhost:8081/ledred', {
                        method: 'POST',
                        dataType: 'json',
                        headers: {
                        'Accept': 'application/json',
                        'Content-Type': 'application/json'
                        },
                        body: JSON.stringify({estado: 1})
                    });
                    const content = await rawResponse.json();

                    console.log(content);
                    })();
                  }else if(resultado[4]==1){
                    $('#nombreqr').html(resultado[2]);
                    $('#tipoqr').html("PAAE");
                    $('#horaqr').html(resultado[3]);
                    alertify.success("Salida registrada.");
                    (async () => {
                    const rawResponse = await fetch('http://localhost:8081/led', {
                        method: 'POST',
                        dataType: 'json',
                        headers: {
                        'Accept': 'application/json',
                        'Content-Type': 'application/json'
                        },
                        body: JSON.stringify({estado: 1})
                    });
                    const content = await rawResponse.json();

                    console.log(content);
                    })();
                  }else if(resultado[4]==2){
                    $('#nombreqr').html(resultado[2]);
                    $('#tipoqr').html("PAAE");
                    $('#horaqr').html(resultado[3]);
                    alertify.success("Entrada registrada.");
                    (async () => {
                    const rawResponse = await fetch('http://localhost:8081/led', {
                        method: 'POST',
                        dataType: 'json',
                        headers: {
                        'Accept': 'application/json',
                        'Content-Type': 'application/json'
                        },
                        body: JSON.stringify({estado: 1})
                    });
                    const content = await rawResponse.json();

                    console.log(content);
                    })();
                  }
                }else if(resultado[1]=="pro"){
                  if(resultado[4]==0){
                    alertify.error("No se encontro el codigo QR");
                    (async () => {
                    const rawResponse = await fetch('http://localhost:8081/ledred', {
                        method: 'POST',
                        dataType: 'json',
                        headers: {
                        'Accept': 'application/json',
                        'Content-Type': 'application/json'
                        },
                        body: JSON.stringify({estado: 1})
                    });
                    const content = await rawResponse.json();

                    console.log(content);
                    })();
                  }else if(resultado[4]==1){
                    $('#nombreqr').html(resultado[2]);
                    $('#tipoqr').html("Profesor");
                    $('#horaqr').html(resultado[3]);
                    alertify.success("Salida registrada.");
                    (async () => {
                    const rawResponse = await fetch('http://localhost:8081/led', {
                        method: 'POST',
                        dataType: 'json',
                        headers: {
                        'Accept': 'application/json',
                        'Content-Type': 'application/json'
                        },
                        body: JSON.stringify({estado: 1})
                    });
                    const content = await rawResponse.json();

                    console.log(content);
                    })();
                  }else if(resultado[4]==2){
                    $('#nombreqr').html(resultado[2]);
                    $('#tipoqr').html("Profesor");
                    $('#horaqr').html(resultado[3]);
                    alertify.success("Entrada registrada.");
                    (async () => {
                    const rawResponse = await fetch('http://localhost:8081/led', {
                        method: 'POST',
                        dataType: 'json',
                        headers: {
                        'Accept': 'application/json',
                        'Content-Type': 'application/json'
                        },
                        body: JSON.stringify({estado: 1})
                    });
                    const content = await rawResponse.json();

                    console.log(content);
                    })();
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
