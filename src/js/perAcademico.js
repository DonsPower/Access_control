
$('#registrarPerAcademico').click(registro);


function registro(){
   
    nombrePerAcademico = $('#nombrePerAcademico').val();
    apellidoPatPerAcademico = $('#apellidoPatPerAcademico').val();
    apellidoMatPerAcademico = $('#apellidoMatPerAcademico').val();
    academia=$("#academia option:selected").text();
    RFC = $('#RFC').val();
    telefono = $('#telefono').val();
    extension = $('#extension').val();
    emailPerAcademico = $('#emailPerAcademico').val();
    
    if(nombrePerAcademico=="" || apellidoPatPerAcademico=="" || apellidoMatPerAcademico=="" || academia=="Seleccione Academia" || RFC=="" || telefono=="" || extension=="" || emailPerAcademico=="") alertify.error("Campos vacíos, por favor llene todos los campos");
    else{
        cadena="nombrePerAcademico="+nombrePerAcademico+"&apellidoPatPerAcademico="+apellidoPatPerAcademico+"&apellidoMatPerAcademico="+apellidoMatPerAcademico+"&academia="+
        academia+"&RFC="+RFC+"&telefono="+telefono+"&extension="+extension+"&emailPerAcademico="
        +emailPerAcademico;

        $.ajax({
            url:"altaPerAcademico/agregarPerAcademico.php",
            type: "POST",
            dataType: "json",
            data: cadena,
        }).done(
            function(data){
                //console.log(data);
                
                    if(data==10){
                        $('#email').val("");
                        alertify.error("El correo ya existe en la base de datos.");
                    }else if(data==2){
                        //nombre incorrecto
                        $('#nombrePerAcademico').val("");
                        alertify.error("El nombre no debe de llevar números o caracteres especiales");

                    }else if(data==3){
                        //apellido
                        $('#apellidoPatPerAcademico').val("");
                        alertify.error("El Apellido paterno no debe de llevar números o caracteres especiales");
                    }else if(data==4){
                        //apellido
                        $('#apellidoMatPerAcademico').val("");
                        alertify.error("El Apellido materno no debe de llevar números o caracteres especiales");
                    }else if(data==5){
                        //apellido
                        $('#RFC').val("");
                        alertify.error("RFC no valido");
                    }else if(data==6){
                        //apellido 11 digitos
                        $('#telefono').val("");
                        alertify.error("El NSS debe de ser valido");
                    }else if(data==7){
                        $('#extensión').val("");
                        alertify.error("Extensión no valido");
                    } 
                    else if(data==8){
                        //apellido 11 digitos
                        $('#email').val("");
                        alertify.error("El Correo debe de ser valido");
                    }else if(data==1){
                        $('#RFC').val("");
                        alertify.error("RFC ya esta registrado");
                    }else if(data==0){
                        $('#nombrePerAcademico').val("");
                        $('#apellidoPatPerAcademico').val("");
                        $('#apellidoMatPerAcademico').val("");
                        //Este valor no se limpia ya que borra el contenido del select, entonces solo dejarlo asi.
                        $("#academia option:selected").text();
                        $('#RFC').val("");
                        $('#telefono').val("");
                        $('#extension').val("");
                        $('#emailPerAcademico').val("");
                        alertify.success("Usuario registrado exitosamente.");
                    }
                }
            
        );
    }
    //La cadena para pasarla al POST.
    
}



function editarDatosPerAcademico(datos){
    modal.style.display = "block";
    console.log(datos);
    cadena=datos.split("||");

        $('#nombrePerAcademico').val(cadena[1]);
        $('#apellidoPatPerAcademico').val(cadena[2]);
        $('#apellidoMatPerAcademico').val(cadena[3]);
        $("#academia option:selected").text();
        $('#RFC').val(cadena[5]);
        $('#telefono').val(cadena[6]);
        $('#extension').val(cadena[7]);
        $('#emailPerAcademico').val(cadena[8]);
        $('#numcodqr').val(cadena[9]);
        $('#idAdmin').val(cadena[0]);
        
}

$("#editActualizarperacademico").click(actualizardataPerAcademico);
function actualizardataPerAcademico(){
    //obtenemos los datos de los input que el usaurioi editó.
    //alertify.success("Entro");
    nombre=$('#nombrePerAcademico').val();
    apellidoP=$('#apellidoPatPerAcademico').val();
    apellidoM=$('#apellidoMatPerAcademico').val();
    puesto=$("#academia option:selected").text();
    areaAdministra=$('#RFC').val();
    tipo=$('#telefono').val();
    email=$('#extension').val();
    clave=$('#emailPerAcademico').val();
    
    id=$('#idAdmin').val();
    //Concatenamos los resultados
    if(nombre=="" || apellidoP=="" || apellidoM=="" || puesto=="Seleccione Academia" || areaAdministra=="" || tipo=="" || email=="" || clave=="") alertify.error("Campos vacíos, por favor llene todos los campos");
    else{
        cadena="id="+id+"&nombrePerAcademico="+nombre+"&apellidoPatPerAcademico="+apellidoP+
            "&apellidoMatPerAcademico="+apellidoM+"&academia="+puesto+"&RFC="+areaAdministra+
            "&telefono="+tipo+"&extension="+email+"&emailPerAcademico="+clave;
        //Mandamos datos con ajax
        $.ajax({
            type:"POST",
            url:"altaPerAcademico/actualizarPerAcademico.php",
            data:cadena,
            success:function(data){
                if(data==10){
                    $('#email').val("");
                    alertify.error("El correo ya existe en la base de datos.");
                }else if(data==2){
                    //nombre incorrecto
                    $('#nombrePerAcademico').val("");
                    alertify.error("El nombre no debe de llevar números o caracteres especiales");

                }else if(data==3){
                    //apellido
                    $('#apellidoPatPerAcademico').val("");
                    alertify.error("El Apellido paterno no debe de llevar números o caracteres especiales");
                }else if(data==4){
                    //apellido
                    $('#apellidoMatPerAcademico').val("");
                    alertify.error("El Apellido materno no debe de llevar números o caracteres especiales");
                }else if(data==5){
                    //apellido
                    $('#RFC').val("");
                    alertify.error("RFC no valido");
                }else if(data==6){
                    //apellido 11 digitos
                    $('#telefono').val("");
                    alertify.error("El NSS debe de ser valido");
                }else if(data==7){
                    $('#extensión').val("");
                    alertify.error("Extensión no valido");
                } 
                else if(data==8){
                    //apellido 11 digitos
                    $('#email').val("");
                    alertify.error("El Correo debe de ser valido");
                }else if(data==1){
                    $('#RFC').val("");
                    alertify.error("RFC ya esta registrado");
                }else if(data==0){
                    $('#nombrePerAcademico').val("");
                    $('#apellidoPatPerAcademico').val("");
                    $('#apellidoMatPerAcademico').val("");
                    //Este valor no se limpia ya que borra el contenido del select, entonces solo dejarlo asi.
                    $("#academia option:selected").text();
                    $('#RFC').val("");
                    $('#telefono').val("");
                    $('#extension').val("");
                    $('#emailPerAcademico').val("");
                    alertify.success("Usuario registrado exitosamente.");
                    $("#main").load("altaPerAcademico/index.php");
                }
                //console.log(r);
                // if(r){
                //     //cont=true;
                // //Eliminamos el modal
                // modal.style.display = "none";
                // //recargamos la pagina con los datos actualizados
                // alertify.success("Datos actualizados");
                // $("#main").load("altaPerAcademico/index.php");
                // }else{
                //     alertify.error("Problemas con el servidor.");
                //     $("#main").load("dashboard.php");
                // }
            

            }
        });
    }

}



//Eliminar paae
function eliminarPerAcademico(id,nombre){
    //console.log(id);
    alertify.prompt( 'Eliminar Personal Academico', 'Estas seguro que quieres eliminar a:', nombre
    , function(evt, value) { 
        
        $.ajax({
            type:"POST",
            url:"altaPerAcademico/deletePerAcademico.php",
            data:{ids:id},
            success:function(r){
                console.log(r);
                if(r){
                    //console.log("deberiaentrar");
                    //TODO: Cuando hay llaves foraneas no elimina.
                    alertify.success('Se elimino as: ' + value) 
                    $("#main").load("altaPerAcademico/index.php");
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


$('#datosSaes3').click(datosSaes2);

function datosSaes2(){
    modal.style.display = "block";
}
$('#dataSaes3').click(guardarDatosPer);
function guardarDatosPer(){
    
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
                                url: 'altaPerAcademico/addData.php',
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

$('#enviarPerAcademico').click(buscarPer);

function buscarPer(){
     //console.log("asd");
     $.ajax({
        url: 'altaPerAcademico/buscarPerAcademico.php',
        type: 'post',
        dataType: 'json',
        data:{
            buscar: $('#buscarPeracademico').val()
        }
    }).done(
        function(data){
            console.log(total1[0]);
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
                       
                    var datosRetornar=datos[0]+"||"+datos[1]+"||"+datos[2]+"||"+datos[3]+"||"+datos[4]+"||"+datos[5]+"||"+datos[6]+"||"+datos[7]+"||"+datos[8]+"||"+datos[9]+"||tabla";
                    //console.log(datosRetornar);
                    //Concateno para mostrar en la tabla.
                    tabla+="<tr><td>"+index+"</td><td>"+datos[1]+" "+datos[2]+" "+datos[3]+"</td><td>"
                    +datos[4]+"</td><td>"
                    +datos[5]+"</td><td>"
                    +datos[6]+"</td><td>"
                    +datos[7]+"</td><td>"
                    +datos[8]+"</td><td>"
                    +datos[9]+"</td><td><button type='button' id='editar' class='btn btn-success' onclick='editarDatosPerAcademico(`"+datosRetornar+"`)'><i class='fas fa-user-edit'></i></button></td> <td><button type='button' id='eliminar' class='btn btn-danger' onclick='eliminarPerAcademico(`"+datos[0]+"`,`"+datos[1]+"`,`"+datos[2]+"`,`"+datos[3]+"`)'><i class='fas fa-user-minus'></i></button></td></tr>";
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
function paginacion4(numPagina){
    //Obtengo al numero de pagina que quiero ir.
    //console.log(numPagina);
    //Se supone que si llega un 2 debo de recuperar un 20.
    //console.log(numPagina);
    $.ajax({
        type:"POST",
        dataType: 'json',
        url: "altaPerAcademico/paginacion.php",
        data:{ 
            ids: numPagina 
        }
    }).done(
        function(data){
            
            var tabla;
            let i=0;
                for(let index=0; index<data.length;index++){
                    i++;
                    //console.log(data);
                    var datos= data[index].split("||");
                       
                    var datosRetornar=datos[0]+"||"+datos[1]+"||"+datos[2]+"||"+datos[3]+"||"+datos[4]+"||"+datos[5]+"||"+datos[6]+"||"+datos[7]+"||"+datos[8]+"||"+datos[9]+"||tabla";
                    //console.log(datosRetornar);
                    //Concateno para mostrar en la tabla.
                    tabla+="<tr><td>"+i+"</td><td>"+datos[1]+" "+datos[2]+" "+datos[3]+"</td><td>"
                    +datos[4]+"</td><td>"
                    +datos[5]+"</td><td>"
                    +datos[6]+"</td><td>"
                    +datos[7]+"</td><td>"
                    +datos[8]+"</td><td>"
                    +datos[9]+"</td><td><button type='button' id='editar' class='btn btn-success' onclick='editarDatosPerAcademico(`"+datosRetornar+"`)'><i class='fas fa-user-edit'></i></button></td> <td><button type='button' id='eliminar' class='btn btn-danger' onclick='eliminarPerAcademico(`"+datos[0]+"`,`"+datos[1]+"`,`"+datos[2]+"`,`"+datos[3]+"`)'><i class='fas fa-user-minus'></i></button></td></tr>";
                }
                datosRetornar="";
                    $('#salida').html(tabla);
                    $('#primero').val('');
        });
    
}