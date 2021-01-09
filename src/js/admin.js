$('#registrarAdmin').click(registrar);

function registrar(){
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
    //TODO:Validar que los datos introducidos sean correctos
    //Si estan vacios los campos retornar vacio si no almacenarlos
    if(nombre=="" || apellidoP=="" || apellidoM=="" || puesto=="" || area=="Seleccione el área que administra" || tipo=="Seleccione el tipo de administrador" || clave=="" || email=="" || password=="" ||preguntaS=="" ||respuestaS=="" ) alertify.error("Campo vacío");
    else{
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
*/