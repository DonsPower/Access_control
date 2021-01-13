$('#registrarAdmin').click(registrar);

function registrar(){
    idArea=$('#id').val();
    nombre=$('#name').val();
    apellidoP=$('#apellidoP').val();
    apellidoM=$('#apellidoM').val();
    puesto=$('#puesto').val();
    areaAdministra=$("#area option:selected").text();
    tipo=$("#tipo option:selected").text();
    clave=$('#clave').val();
    email=$('#email').val();
    password=$('#password').val();
    preguntaS=$('#preguntaSeg').val();
    respuestaS=$('#respuestaSeg').val();
    if(nombre=="" || apellidoP=="" || apellidoM=="" || puesto=="" ||  tipo=="Seleccione el tipo de administrador" || clave=="" || email=="" || password=="" ||preguntaS=="" ||respuestaS=="" ) alertify.error("Campo vacío");
    else{
        
        
        //bandera me sirve para saber si es un admin global o no
        bandera=false;
    //Si es admin global no tendra area o su area sera UPIIZ==ID=1
        if(tipo!="AdministradorGlobal"){
            //verificamos que el campo area no este vacio.
            if(areaAdministra=="Seleccione el área que administra"){
                alertify.error("Área vacia");
                bandera=true;    
            }
        }
        //Si los campos no estan vacios entramos al if.
        if(bandera==false){
            //Buscamos el Id del area.
                //Concatenamos los resultados
                
            cadena="name="+nombre+"&apellidoP="+apellidoP+
                    "&apellidoM="+apellidoM+"&puesto="+puesto+"&areaAdministra="+areaAdministra+
                    "&tipo="+tipo+"&email="+email+"&clave="+clave+"&password="+password+"&preguntaS="+
                    preguntaS+"&respuestaS="+respuestaS;
                $.ajax({
                    url: 'admin/agregarAdmin.php',
                    type: 'post',
                    dataType: 'json',
                    data: cadena
                }).done(
                    function(data){
                        console.log(data);
                        if(data==1){
                            alertify.error("El correo ya existe en la base de datos.");
                        } 
                        else {
                            $('#name').val("");
                            $('#apellidoP').val("");
                            $('#apellidoM').val("");
                            $('#puesto').val("");
                            $("#area option:selected").text();
                            $("#tipo option:selected").text();
                            $('#clave').val("");
                            $('#email').val("");
                            $('#password').val("");
                            $('#preguntaSeg').val("");
                            $('#respuestaSeg').val("");
                            alertify.success("Usuario registrado exitosamente.");   
                        }
                    }
                );
        }
    }
    //console.log(tipo, areaAdministra);
    //TODO:Validar que los datos introducidos sean correctos
    //Si estan vacios los campos retornar vacio si no almacenarlos
    // if(nombre=="" || apellidoP=="" || apellidoM=="" || puesto=="" ||  tipo=="Seleccione el tipo de administrador" || clave=="" || email=="" || password=="" ||preguntaS=="" ||respuestaS=="" ) alertify.error("Campo vacío");
    // else{
    //     //Buscamos el Id del area.
    //     if(areaAdministra!=""){
            
    //     }
    //     //Concatenamos los resultados
    // cadena="name="+nombre+"&apellidoP="+apellidoP+
    //         "&apellidoM="+apellidoM+"&puesto="+puesto+"&areaAdministra="+areaAdministra+
    //         "&tipo="+tipo+"&email="+email+"&clave="+clave+"&password="+password+"&preguntaS="+
    //         preguntaS+"&respuestaS="+respuestaS;
    //     $.ajax({
    //         url: 'admin/agregarAdmin.php',
    //         type: 'post',
    //         dataType: 'json',
    //         data: cadena
    //     }).done(
    //         function(data){
    //             if(data==1){
    //                 alertify.error("El correo ya existe en la base de datos.");
    //             } 
    //             else {
    //                 $('#name').val("");
    //                 $('#apellidoP').val("");
    //                 $('#apellidoM').val("");
    //                 $('#puesto').val("");
    //                 $("#area option:selected").text();
    //                 $("#tipo option:selected").text();
    //                 $('#clave').val("");
    //                 $('#email').val("");
    //                 $('#password').val("");
    //                 $('#preguntaSeg').val("");
    //                 $('#respuestaSeg').val("");
    //                 alertify.success("Usuario registrado exitosamente.");   
    //             }
    //         }
    //     );
    //}
}
//Boto de registrar visitante
$('#registrarVis').click(registrarvist);

function registrarvist(){
    //Obtenemos los datos de la validacion
    nombre=$('#name').val();
    apellidoP=$('#apellidoP').val();
    apellidoM=$('#apellidoM').val();
    razon=$('#razon').val();
    codigoQr=$('#codigoqr').val();
    //console.log("entro");
    cadena="name="+nombre+"&apellidoP="+apellidoP+
    "&apellidoM="+apellidoM+"&razon="+razon+
    "&codigoQr="+codigoQr;
   
    //TODO: agregar validacion
    if(nombre=="" || apellidoP=="" || apellidoM=="" || razon==""|| codigoQr=="" ) alertify.error("Campo vacío");
    else{
        $.ajax({
            url: 'visitante/addVis.php',
            type: 'post',
            dataType: 'json',
            data: cadena
        }).done(
            function(data){
                if(data==1){
                    alertify.error("El codigo QR ya esta registrado.");
                } 
                else {
                    $('#name').val("");
                    $('#apellidoP').val("");
                    $('#apellidoM').val("");
                    $('#razon').val("");
                    $('#codigoqr').val("");
                    alertify.success("Visitante registrado exitosamente.");   
                }
            }
        );
    }
}
/*
TODO:Agregar eventos de error en todos los metodos ajax
var objetoAJAX = $.get( "loquesea.php", function() {
  //hacer algo cuando hay respuesta del AJAX
});
 objetoAJAX.done(function() {
    //hacer otra cosa cuando hay respuesta correcta de la solicitud
  })
   objetoAJAX.fail(function() {
    //hacer algo cuando se produce un error
  })
   objetoAJAX.always(function() {
    //hacer algo tanto en error como en éxito
  });

  $.ajax({
    url: url,
    type: "get",
    data: {
        'sld': dominio_sld,
        'tld': dominio_tld
    },
    dataType: "json",
    headers: {
        'X-TOKEN': user_key
    },
    crossDomain: true,
    beforeSend: function (xhr) {
        beforeSend();
    },
    success: function (response) {
        afterSend();
    },
    error: function (xhr) {
        afterSend();
        showError();
    }
}).done(function (data) {
    // Mas código
});
*/