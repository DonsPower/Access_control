

$('#registrarPaae').click(registroPae);


function registroPae(){
    //console.log("sads");
    nombrePaae = $('#nombrePaae').val();
    apellidoPatPaae = $('#apellidoPatPaae').val();
    apellidoMatPaae = $('#apellidoMatPaae').val();
    area=$("#area option:selected").text();
    RFC = $('#RFC').val();
    telefono = $('#telefono').val();
    extension = $('#extension').val();
    emailPaae = $('#emailPaae').val();
    console.log(area);
    if(nombrePaae=="" || apellidoPatPaae=="" || apellidoMatPaae=="" || area=="Seleccione Área" || telefono=="" || extension=="" || emailPaae=="") alertify.error("Campos vacíos, por favor llene todos los campos");
    else{
        
        //La cadena para pasarla al POST.
        cadena="nombrePaae="+nombrePaae+"&apellidoPatPaae="+apellidoPatPaae+"&apellidoMatPaae="+apellidoMatPaae+"&area="+
        area+"&RFC="+RFC+"&telefono="+telefono+"&extension="+extension+"&emailPaae="+emailPaae;

        $.ajax({
            url:"altaPaae/agregarPaae.php",
            type: "POST",
            dataType: "json",
            data: cadena,
        }).done(
            function(data){
                //console.log(data);
                if(data==1){
                    $('#RFC').val("");
                    alertify.error("El RFC ya esta registrado.");
                }
                else if(data==2){
                    //nombre incorrecto
                $('#nombrePaae').val("");
                    alertify.error("El nombre no debe de llevar números o caracteres especiales");

                }else if(data==3){
                    //apellido
                    $('#apellidoPatPaae').val("");
                    alertify.error("El Apellido paterno no debe de llevar números o caracteres especiales");
                }else if(data==4){
                    //apellido
                    $('#apellidoMatPaae').val("");
                    alertify.error("El Apellido materno no debe de llevar números o caracteres especiales");
                }else if(data==5){
                    //apellido
                    $('#RFC').val("");
                    alertify.error("El RFC es incorrecto");
                }
                else if(data==6){
                    //apellido
                    $('#telefono').val("");
                    alertify.error("Telefono incorrecto");
                }
                else if(data==7){
                    //apellido
                    $('#extension').val("");
                    alertify.error("Extencion incorrecta");
                }
                else if(data==8){
                    //apellido
                    $('#emailPaae').val("");
                    alertify.error("El Correo debe de ser valido");
                }else if(data==10){
                    $('#emailPaae').val("");
                    alertify.error("El Correo ya registrado");
                }
                else if(data==0){
                    $('#nombrePaae').val("");
                    $('#apellidoPatPaae').val("");
                    $('#apellidoMatPaae').val("");
                    //Este valor no se limpia ya que borra el contenido del select, entonces solo dejarlo asi.
                    $("#area option:selected").text();
                    $('#RFC').val("");
                    $('#telefono').val("");
                    $('#extension').val("");
                    $('#emailPaae').val("");
                    $('#numcodqr').val();
                    //console.log(data);
                    alertify.success("Usuario registrado exitosamente.");
                    $("#main").load("altaPaae/index.php");
                }else{
                    //console.log("Error de servidor");
                    alertify.error("Error del servidor");
                }
            }
        );
    }

}



function editarDatosPaae(datos){
    modal.style.display = "block";
    console.log(datos);
    cadena=datos.split("||");

        $('#nombrePaae').val(cadena[1]);
        $('#apellidoPatPaae').val(cadena[2]);
        $('#apellidoMatPaae').val(cadena[3]);
        $("#area option:selected").text();
        $('#RFC').val(cadena[5]);
        $('#telefono').val(cadena[6]);
        $('#extension').val(cadena[7]);
        $('#emailPaae').val(cadena[8]);
        $('#numcodqr').val(cadena[9]);
        $('#idAdmin').val(cadena[0]);
        
}

$("#editActualizarPaae").click(actualizardata);
function actualizardata(){
    //obtenemos los datos de los input que el usaurioi editó.
    //alertify.success("Entro");
    nombre=$('#nombrePaae').val();
    apellidoP=$('#apellidoPatPaae').val();
    apellidoM=$('#apellidoMatPaae').val();
    puesto=$("#area option:selected").text();
    areaAdministra=$('#RFC').val();
    tipo=$('#telefono').val();
    email=$('#extension').val();
    clave=$('#emailPaae').val();
    numcodqr=$('#numcodqr').val();
    id=$('#idAdmin').val();
    if(nombre=="" || apellidoP=="" || apellidoM=="" || puesto=="Seleccione el área que administra" || areaAdministra=="" || tipo=="" || email=="" || clave=="") alertify.error("Campos vacíos, por favor llene todos los campos");
    else{
    //Concatenamos los resultados
        cadena="id="+id+"&nombrePaae="+nombre+"&apellidoPatPaae="+apellidoP+
            "&apellidoMatPaae="+apellidoM+"&area="+puesto+"&RFC="+areaAdministra+
            "&telefono="+tipo+"&extension="+email+"&emailPaae="+clave+"&numcodqr="+numcodqr;
        //Mandamos datos con ajax
        $.ajax({
            type:"POST",
            url:"altaPaae/actualizarPaae.php",
            data:cadena,
            success:function(data){
                if(data==10){
                    $('#emailPaae').val("");
                    alertify.error("El Correo ya esta registrado");
                }
                else if(data==2){
                    //nombre incorrecto
                $('#nombrePaae').val("");
                    alertify.error("El nombre no debe de llevar números o caracteres especiales");

                }else if(data==3){
                    //apellido
                    $('#apellidoPatPaae').val("");
                    alertify.error("El Apellido paterno no debe de llevar números o caracteres especiales");
                }else if(data==4){
                    //apellido
                    $('#apellidoMatPaae').val("");
                    alertify.error("El Apellido materno no debe de llevar números o caracteres especiales");
                }else if(data==5){
                    //apellido
                    $('#RFC').val("");
                    alertify.error("El RFC es incorrecto");
                }
                else if(data==6){
                    //apellido
                    $('#telefono').val("");
                    alertify.error("Telefono incorrecto");
                }
                else if(data==7){
                    //apellido
                    $('#extension').val("");
                    alertify.error("Extencion incorrecta");
                }
                else if(data==8){
                    //apellido
                    $('#emailPaae').val("");
                    alertify.error("El Correo debe de ser valido");
                }else if(data==1){
                    $('#RFC').val("");
                    alertify.error("El RFC ya esta registrado");
                }
                else if(data==0){
                    $('#nombrePaae').val("");
                    $('#apellidoPatPaae').val("");
                    $('#apellidoMatPaae').val("");
                    //Este valor no se limpia ya que borra el contenido del select, entonces solo dejarlo asi.
                    $("#area option:selected").text();
                    $('#RFC').val("");
                    $('#telefono').val("");
                    $('#extension').val("");
                    $('#emailPaae').val("");
                    $('#numcodqr').val();
                    //console.log(data);
                    alertify.success("Usuario actualizado exitosamente.");
                    $("#main").load("altaPaae/index.php");
                }else{
                    //console.log("Error de servidor");
                    alertify.error("Error del servidor");
                }
          
                //console.log(r);
                // if(r){
                //     //cont=true;
                // //Eliminamos el modal
                // modal.style.display = "none";
                // //recargamos la pagina con los datos actualizados
                // alertify.success("Datos actualizados");
                // $("#main").load("altaPaae/index.php");
                // }else{
                //     alertify.error("Problemas con el servidor.");
                //     $("#main").load("dashboard.php");
                // }
            

            }
        });
    }

}



//Eliminar paae
function eliminarPaae(id,nombre){
    //console.log(id);
    alertify.prompt( 'Eliminar Paae', 'Estas seguro que quieres eliminar a:', nombre
    , function(evt, value) { 
        
        $.ajax({
            type:"POST",
            url:"altaPaae/deletePaae.php",
            data:{ids:id},
            success:function(r){
                console.log(r);
                if(r){
                    //console.log("deberiaentrar");
                    //TODO: Cuando hay llaves foraneas no elimina.
                    alertify.success('Se elimino as: ' + value) 
                    $("#main").load("altaPaae/index.php");
                }else{
                    alertify.error("Problemas con el servidor.");
                    $("#main").load("dashboard.php");
                }
            },
            error: function (xhr) {
                console.log(xhr);
                alertify.error("Error al eliminar datos");
            }
        });
    
    }
    , function() { alertify.error('Cancelado') });

}
$('#datosSaes2').click(datosSaes2);

function datosSaes2(){
    modal.style.display = "block";
}
$('#dataSaes2').click(guardarDatospaae);
function guardarDatospaae(){
    
    let nombre=$('#usuarioSaes').val();
    let contra=$('#passwordSaes').val();
    let token=$('#token').val();
    let url2=$('#url').val();
    let cont=0;
    let URL='http://localhost:3000/auth/login';
            fetch(URL, {
                method: "post",
                dataType: 'json',
                mode: 'cors',
                //headers: myHeaders
                headers:{
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify({
                    "username" : nombre,
                    "password" : contra,
                    "token1": token   
                })
            }).then((response) => {
                return response.json();   
            }).then((data) => {
                console.log(data);
                if(data['message']!='OK'){
                    //No se registro bien el usuario.
                    console.log("Registro incorrecto.");
                }else{
                    document.cookie = "token= "+data['token'];
                    fetch(url2, {
                        method: "get",
                        dataType: 'json',
                        mode: 'cors',
                        //headers: myHeaders
                        headers:{
                            'Content-Type': 'application/json',
                            'auth' : data['token']
                        }
                    }).then((response) => {
                        return response.json();   
                    }).then((datas) => {
                        for(let i=0;i<datas.length;i++){
                            $.ajax({
                                url: 'altaPaae/addData.php',
                                type:'post',
                                data:{
                                    id:datas[i]
                                }
                            }).done(
                                function(data){
                                    console.log(data);
                                //    total= parseInt(data,10);
                                //     cont+=total;
                                //     console.log(cont);
                                }
                            );
                        }
                        
                        //console.log(data['token']);
                        //console.log(data);
                    })
                }
                //document.cookie = "token= "+data['token'];
                //console.log(data['token']);
            });
}

$('#enviarPaae').click(regresar);
var total=[0];
//Boton buscar usuario.
function regresar(){
    //console.log("Entro");
    $.ajax({
        url: 'altaPaae/buscarPaae.php',
        type: 'post',
        dataType: 'json',
        data:{
            buscar:$('#buscar').val()
        }
    }).done(
        function(data){
          
            //Si el array solo trae un dato significa que no hay resultados.
            if(data.length==1){
                $('#salida').html("<h2>No se encontraron resultados.</h2>");
                $('#primero').val('');
                //Alerta.
                alertify.error("No hay resultados");
               
            }else{
                 
                var tabla;
                for (let index = 1; index < data.length; index++) {
                    
                    //console.log(datos);
                    var datos= data[index].split("||");
                    
                    var datosRetornar=datos[0]+"||"+datos[1]+"||"+datos[2]+"||"+datos[3]+"||"+datos[4]+"||"+datos[5]+"||"+datos[6]+"||"+datos[7]+"||"+datos[8]+"||"+datos[9]+"||tabla";
                    
                    //Concateno para mostrar en la tabla.
                    tabla+="<tr><td>"+index+"</td><td>"+datos[1]+" "+datos[2]+" "+datos[3]+"</td><td>"
                    +datos[4]+"</td><td>"
                    +datos[5]+"</td><td>"
                    +datos[6]+"</td><td>"
                    +datos[7]+"</td><td>"
                    +datos[8]+"</td><td>"
                    +datos[9]+"</td><td><button type='button' id='editar' class='btn btn-success' onclick='editarDatosPaae(`"+datosRetornar+"`)'><i class='fas fa-user-edit'></i></button></td> <td><button type='button' id='eliminar' class='btn btn-danger' onclick='eliminarPaae(`"+datos[0]+"`,`"+datos[1]+"`,`"+datos[2]+"`,`"+datos[3]+"`)'><i class='fas fa-user-minus'></i></button></td></tr>";
                    
                }
                datosRetornar="";
                $('#salida').html(tabla);
                $('#primero').val('');
            }
        }
    );

}
function paginacion3(numPagina){
    //Obtengo al numero de pagina que quiero ir.
    //console.log(numPagina);
    //Se supone que si llega un 2 debo de recuperar un 20.
    //console.log(numPagina);
    $.ajax({
        type:"POST",
        dataType: 'json',
        url: "altaAlumnos/paginacion.php",
        data:{ 
            ids: numPagina 
        }
    }).done(
        function(data){
            
            var tabla;
            let i=(numPagina-1)*10;
           
            for(let index=0; index<data.length;index++){
                i++;
                
                var datos= data[index].split("||");
                console.log(datos[4]);
                    //console.log(datos[10]);
                    //id|| nombre apellido apellido2||carrera||3- boleta||4-tm    
                    var datosRetornar=datos[0]+"||"+datos[1]+"||"+datos[2]+"||"+datos[3]+"||"+datos[4]+"||"+datos[5]+"||"+datos[6]+"||"+datos[7]+"||"+datos[8]+"||"+datos[9]+"||"+datos[10]+"||"+datos[11]+"||tabla";
                       //console.log(datosRetornar);
                    //console.log(datosRetornar);
                    //Concateno para mostrar en la tabla.
                    tabla+="<tr><td>"+i+"</td><td>"+datos[1]+" "+datos[2]+" "+datos[3]+"</td><td>"
                    +datos[4]+"</td><td>"
                    +datos[5]+"</td><td>"
                    +datos[6]+"</td><td>"
                    +datos[7]+"</td><td>"
                    +datos[8]+"</td><td>"
                    +datos[9]+"</td><td>"
                    +datos[10]+"</td><td>"
                    +datos[11]+"</td><td><button type='button' id='editar' class='btn btn-success' onclick='editarDatosAlumnos(`"+datosRetornar+"`)'><i class='fas fa-user-edit'></i></button></td> <td><button type='button' id='eliminar' class='btn btn-danger' onclick='eliminarAlumno(`"+datos[0]+"`,`"+datos[1]+"`)'><i class='fas fa-user-times'></i></button></td></tr>";
                    
            }
            datosRetornar="";
                $('#salida').html(tabla);
                $('#primero').val('');
        });
}