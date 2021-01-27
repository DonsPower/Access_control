
$('#registrarAlumno').click(registro);

function registro(){
   
    nombre=$('#nombreAlumno').val();
    apellidoP=$('#apellidoPatAlumno').val();
    apellidoM=$('#apellidoMatAlumno').val();
    carrera=$("#carrera option:selected").text();
    boleta=$('#boleta').val();
    telefonoMovil=$('#telefonoMovil').val();
    telefonoFijo=$('#telefonoFijo').val();
    telefonoPersonal=$('#telefonoPersonal').val();
    nss=$('#NSS').val();
    emailAlumno=$('#emailAlumno').val();
    
    if(nombre=="" || apellidoP=="" || apellidoM=="" || carrera=="Seleccione Programa Académico" || boleta=="" || telefonoMovil=="" || telefonoFijo==""|| telefonoPersonal=="" || nss=="" || emailAlumno=="")alertify.error("Campos vacíos, por favor llene todos los campos");
    else{
        //La cadena para pasarla al POST.
        cadena="nombre="+nombre+"&apellidop="+apellidoP+"&apellidom="+apellidoM+"&carrera="+
        carrera+"&boleta="+boleta+"&telefonomovil="+telefonoMovil+"&telefonoFijo="+telefonoFijo+"&telefonoPersonal="
        +telefonoPersonal+"&nss="+nss+"&email="+emailAlumno;
        
        $.ajax({
            url:"altaAlumnos/agregarAlumno.php",
            type: "POST",
            dataType: "json",
            data: cadena,
        }).done(
            function(data){
               // console.log(data);
               if(data==10){
                alertify.error("El email ya existe en la base de datos.");
               }
                else if(data==1){
                    alertify.error("La boleta ya existe en la base de datos.");
                }else if(data==2){
                    //nombre incorrecto
                    $('#nombreAlumno').val("");
                    alertify.error("El nombre no debe de llevar números o caracteres especiales");

                }else if(data==3){
                    //apellido
                    $('#apellidoPatAlumno').val("");
                    alertify.error("El Apellido paterno no debe de llevar números o caracteres especiales");
                }else if(data==4){
                    //apellido
                    $('#apellidoMatAlumno').val("");
                    alertify.error("El Apellido materno no debe de llevar números o caracteres especiales");
                }else if(data==5){
                    //apellido
                    $('#boleta').val("");
                    alertify.error("Boleta no valido");
                }else if(data==6){
                    //apellido 11 digitos
                    $('#telefonoMovil').val("");
                    alertify.error("Telefono no valido");
                }else if(data==7){
                    $('#telefonoFijo').val("");
                    alertify.error("Telefono fijo no valido");
                } 
                else if(data==8){
                    //apellido 11 digitos
                    $('#telefonoPersonal').val("");
                    alertify.error("Telefono personal no valido");
                }
                else if(data==9){
                    //apellido 11 digitos
                    $('#NSS').val("");
                    alertify.error("NSS no valido");
                }
                else if(data==11){
                    //apellido 11 digitos
                    $('#emailAlumno').val("");
                    alertify.error("Email no valido");
                }
                else if(data==0){
                    $('#nombreAlumno').val("");
                    $('#apellidoPatAlumno').val("");
                    $('#apellidoMatAlumno').val("");
                    //Este valor no se limpia ya que borra el contenido del select, entonces solo dejarlo asi.
                    $("#carrera option:selected").text();
                    $('#boleta').val("");
                    $('#telefonoMovil').val("");
                    $('#telefonoFijo').val("");
                    $('#telefonoPersonal').val("");
                    $('#NSS').val("");
                    $('#emailAlumno').val("");
                    $('#numcodqr').val("");
                    alertify.success("Usuario registrado exitosamente.");
                    $("#main").load("altaAlumnos/index.php");
                }else{
                    console.log("Error de servidor");
                    alertify.error("Error");
                }
            }

        );
    }
    
}

function editarDatosAlumnos(datos){
    modal.style.display = "block";
    console.log(datos);
    cadena=datos.split("||");
        $('#nombreAlumno').val(cadena[1]);
        $('#apellidoPatAlumno').val(cadena[2]);
        $('#apellidoMatAlumno').val(cadena[3]);
        $("#area option:selected").text();
        $('#boleta').val(cadena[5]);
        $('#telefonoMovil').val(cadena[6]);
        $('#telefonoFijo').val(cadena[7]);
        $('#telefonoPersonal').val(cadena[8]);
        $('#emailAlumno').val(cadena[9]);
        $('#NSS').val(cadena[10]);
        
        $('#idAdmin').val(cadena[0]);
    
}

$("#editActualizarAlu").click(actualizardataAlu);
function actualizardataAlu(){
    //obtenemos los datos de los input que el usaurioi editó.
    //alertify.success("Entro");
    
    nombre=$('#nombreAlumno').val();
    apellidoP=$('#apellidoPatAlumno').val();
    apellidoM=$('#apellidoMatAlumno').val();
    puesto=$("#carrera option:selected").text();
    areaAdministra=$('#boleta').val();
    tipo=$('#telefonoMovil').val();
    email=$('#telefonoFijo').val();
    clave=$('#telefonoPersonal').val();
    preguntaS=$('#emailAlumno').val();
    respuetaS=$('#NSS').val();
    
    id=$('#idAdmin').val();
    if(nombre=="" || apellidoP=="" || apellidoM=="" || puesto=="Seleccione Programa Académico" || areaAdministra=="" || tipo=="" || email==""|| clave=="" || preguntaS=="" || respuetaS=="")alertify.error("Campos vacíos, por favor llene todos los campos");
    else{
        //Concatenamos los resultados
        cadena="id="+id+"&nombreAlumno="+nombre+"&apellidoPatAlumno="+apellidoP+
            "&apellidoMatAlumno="+apellidoM+"&carrera="+puesto+"&boleta="+areaAdministra+
            "&telefonoMovil="+tipo+"&telefonoFijo="+email+"&telefonoPersonal="+clave+"&emailAlumno="+
            preguntaS+"&NSS="+respuetaS;
        //Mandamos datos con ajax
        $.ajax({
            type:"POST",
            url:"altaAlumnos/actualizarAlumnos.php",
            data:cadena,
            success:function(data){
               // console.log(data);
               if(data==10){
                alertify.error("El email ya existe en la base de datos.");
               }
                else if(data==1){
                    alertify.error("La boleta ya existe en la base de datos.");
                }else if(data==2){
                    //nombre incorrecto
                    $('#nombreAlumno').val("");
                    alertify.error("El nombre no debe de llevar números o caracteres especiales");

                }else if(data==3){
                    //apellido
                    $('#apellidoPatAlumno').val("");
                    alertify.error("El Apellido paterno no debe de llevar números o caracteres especiales");
                }else if(data==4){
                    //apellido
                    $('#apellidoMatAlumno').val("");
                    alertify.error("El Apellido materno no debe de llevar números o caracteres especiales");
                }else if(data==5){
                    //apellido
                    $('#boleta').val("");
                    alertify.error("Boleta no valido");
                }else if(data==6){
                    //apellido 11 digitos
                    $('#telefonoMovil').val("");
                    alertify.error("Telefono no valido");
                }else if(data==7){
                    $('#telefonoFijo').val("");
                    alertify.error("Telefono fijo no valido");
                } 
                else if(data==8){
                    //apellido 11 digitos
                    $('#telefonoPersonal').val("");
                    alertify.error("Telefono personal no valido");
                }
                else if(data==9){
                    //apellido 11 digitos
                    $('#NSS').val("");
                    alertify.error("NSS no valido");
                }
                else if(data==11){
                    //apellido 11 digitos
                    $('#emailAlumno').val("");
                    alertify.error("Email no valido");
                }
                else if(data==0){
                    $('#nombreAlumno').val("");
                    $('#apellidoPatAlumno').val("");
                    $('#apellidoMatAlumno').val("");
                    //Este valor no se limpia ya que borra el contenido del select, entonces solo dejarlo asi.
                    $("#carrera option:selected").text();
                    $('#boleta').val("");
                    $('#telefonoMovil').val("");
                    $('#telefonoFijo').val("");
                    $('#telefonoPersonal').val("");
                    $('#NSS').val("");
                    $('#emailAlumno').val("");
                    $('#numcodqr').val("");
                    alertify.success("Usuario actualizado exitosamente.");
                    $("#main").load("altaAlumnos/index.php");
                }else{
                    console.log("Error de servidor");
                    alertify.error("Error");
                }
                
                // if(r){
                    
                //     console.log(r);
                //     //cont=true;
                // //Eliminamos el modal
                // modal.style.display = "none";
                // //recargamos la pagina con los datos actualizados
                // alertify.success("Datos actualizados");
                // $("#main").load("altaAlumnos/index.php");
                // }else{
                //     alertify.error("Problemas con el servidor.");
                //     //$("#main").load("dashboard.php");
                // }
            

            }
        });
    }
}

//Eliminar Alumno
function eliminarAlumno(id,nombre){
    //console.log(id);
    alertify.prompt( 'Eliminar Alumno', 'Estas seguro que quieres eliminar a:', nombre
    , function(evt, value) { 
        
        $.ajax({
            type:"POST",
            url:"altaAlumnos/deleteAlumnos.php",
            data:{ids:id},
            success:function(r){
                console.log(r);
                if(r){
                    //console.log("deberiaentrar");
                    //TODO: Cuando hay llaves foraneas no elimina.
                    alertify.success('Se elimino a: ' + value) 
                    $("#main").load("altaAlumnos/index.php");
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

$('#datosSaes').click(datosSaes);

function datosSaes(){
    modal.style.display = "block";
}
$('#dataSaes').click(guardarDatosAlumno);
function guardarDatosAlumno(){
    
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
                                url: 'altaAlumnos/addSaes.php',
                                type:'post',
                                data:{
                                    id:datas[i]
                                }
                            }).done(
                                function(data){
                                   total= parseInt(data,10);
                                    cont+=total;
                                    console.log(cont);
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

$('#enviarAlumno').click(buscarAlumno);
var total1=[0];
function buscarAlumno(){
    //console.log("asd");
    $.ajax({
        url: 'altaAlumnos/buscarAlumno.php',
        type: 'post',
        dataType: 'json',
        data:{
            buscar: $('#buscarAlumno').val()
        }
    }).done(
        function(data){
            //console.log(total1[0]);
            if(data.length==1){
                $('#salida').html("<h2>No se encontraron resultados.</h2>");
                $('#primero').val('');
                //Alerta.
                alertify.error("No hay resultados");
            }else{
                var tabla;
                for(let index=1; index<data.length;index++){
                    console.log(data);
                    var datos= data[index].split("||");
                       
                        var datosRetornar=datos[0]+"||"+datos[1]+"||"+datos[2]+"||"+datos[3]+"||"+datos[4]+"||"+datos[5]+"||"+datos[6]+"||"+datos[7]+"||"+datos[8]+"||"+datos[9]+"||"+datos[10]+"||"+datos[11]+"||tabla";
                        //console.log(datosRetornar);
                        //Concateno para mostrar en la tabla.
                        tabla+="<tr><td>"+index+"</td><td>"+datos[1]+" "+datos[2]+" "+datos[3]+"</td><td>"
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
                //     for (let index = 1; index < data.length; index++) {​​​​​
                        
                //         //console.log(datos);
                //         var datos= data[index].split("||");
                       
                //         var datosRetornar=datos[0]+"||"+datos[1]+"||"+datos[2]+"||"+datos[3]+"||"+datos[4]+"||"+datos[5]+"||"+datos[6]+"||"+datos[7]+"||"+datos[8]+"||"+datos[9]+"||"+datos[10]+"||"+datos[11]+"||tabla";
                //         //console.log(datosRetornar);
                //         //Concateno para mostrar en la tabla.
                //         tabla+="<tr><td>"+index+"</td><td>"+datos[1]+" "+datos[2]+" "+datos[3]+"</td><td>"
                //         +datos[4]+"</td><td>"
                //         +datos[5]+"</td><td>"
                //         +datos[6]+"</td><td>"
                //         +datos[7]+"</td><td>"
                //         +datos[8]+"</td><td>"
                //         +datos[9]+"</td><td>"
                //         +datos[10]+"</td><td>"
                //         +datos[11]+"</td><td><button type='button' id='editar' class='btn btn-success' onclick='editarDatosAlumnos(`"+datosRetornar+"`)'><i class='fas fa-user-edit'></i></button></td> <td><button type='button' id='eliminar' class='btn btn-danger' onclick='eliminarAlumno(`"+datos[0]+"`,`"+datos[1]+"`)'><i class='fas fa-user-minus'></i></button></td></tr>";
                        
                //     }​​​​​
                //     datosRetornar="";
                //     $('#salida').html(tabla);
                //     $('#primero').val('');
            }
            //     //Mostrar input buscar
            //     $('#buscar').css('visibility', 'visible');
            //    // $('#primero').toggle(); 
            //     document.getElementById("enviarAlumno").innerHTML = "Buscar";
            // }​​​​​
            // //Si el array solo trae un dato significa que no hay resultados.
            // if(data.length==1){​​​​​
            //     $('#salida').html("<h2>No se encontraron resultados.</h2>");
            //     $('#primero').val('');
            //     //Alerta.
            //     alertify.error("No hay resultados");
               
            // }​​​​​else
            // {​​​​​
            //      //TODO: CLAVE ELIMINAR
               
            //     var tabla;
            //     for (let index = 1; index < data.length; index++) {​​​​​
                    
            //         //console.log(datos);
            //         var datos= data[index].split("||");
                   
            //         var datosRetornar=datos[0]+"||"+datos[1]+"||"+datos[2]+"||"+datos[3]+"||"+datos[4]+"||"+datos[5]+"||"+datos[6]+"||"+datos[7]+"||"+datos[8]+"||"+datos[9]+"||"+datos[10]+"||"+datos[11]+"||tabla";
            //         //console.log(datosRetornar);
            //         //Concateno para mostrar en la tabla.
            //         tabla+="<tr><td>"+index+"</td><td>"+datos[1]+" "+datos[2]+" "+datos[3]+"</td><td>"
            //         +datos[4]+"</td><td>"
            //         +datos[5]+"</td><td>"
            //         +datos[6]+"</td><td>"
            //         +datos[7]+"</td><td>"
            //         +datos[8]+"</td><td>"
            //         +datos[9]+"</td><td>"
            //         +datos[10]+"</td><td>"
            //         +datos[11]+"</td><td><button type='button' id='editar' class='btn btn-success' onclick='editarDatosAlumnos(`"+datosRetornar+"`)'><i class='fas fa-user-edit'></i></button></td> <td><button type='button' id='eliminar' class='btn btn-danger' onclick='eliminarAlumno(`"+datos[0]+"`,`"+datos[1]+"`)'><i class='fas fa-user-minus'></i></button></td></tr>";
                    
            //     }​​​​​
            //     datosRetornar="";
            //     $('#salida').html(tabla);
            //     $('#primero').val('');
            // }​​​​​
        }
    );
}
function paginacion2(numPagina){
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