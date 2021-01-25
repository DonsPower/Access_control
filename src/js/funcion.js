    var emailid=document.getElementById("email");
//Activar modal
    var modal = document.getElementById("myModal");
    // Obtengo "X" obtener evento.
    var span = document.getElementsByClassName("close")[0];
    //Precionamos "X" Y CERRAMOS MODAL
    span.onclick = function() {
        modal.style.display = "none";
    }
    //Si se preciona en otro cualquier lado cerramos modal.
    window.onclick = function(event) {
        if (event.target == modal) {
            modal.style.display = "none";
        }
    }
    //Variable total de resultados
    var total=[0];
//Buscador
//Obtenemos datos del buscador.
$('#enviar').click(regresar);

function regresar(){
    
    $.ajax({
        url: 'admin/buscarAdmin.php',
        type: 'post',
        dataType: 'json',
        data:{
            primero:$('#primero').val()
        }
    }).done(
        function(data){
            //console.log(data)
            //Obtenemos el numero mayor de consultas para así cambiar el estado del boton.
            if(total[0]<data.length){
                total.pop();
                total.push(data.length);
            }
            //console.log(total);
            if(total[0]>data.length) {
                //Ocultar input buscar
                $('#primero').css('visibility', 'hidden');
                //$( "#primero" ).hide();
                document.getElementById("enviar").innerHTML = "Regresar";
                alertify.success("Busqueda correcta");
            }
            else{
                //Mostrar input buscar
                $('#primero').css('visibility', 'visible');
               // $('#primero').toggle(); 
                document.getElementById("enviar").innerHTML = "Buscar";
            } 
            console.log(data);
            //Obtengo la cadena de datos que se encontraron en la BD desde uno hasta 100000000
            //Si data=1 = no hay datos
            if(data.length==1){
                $('#salida').html("<h2>No se encontraron resultados.</h2>");
                $('#primero').val('');
                //Alerta.
                alertify.error("No hay resultados");
               
            }else{
                //TODO: CLAVE ELIMINAR
                //2 Genaro Vazquez holaholahola Encargado Sistemas A…genaro@gmail.com 123424fr43e Bebida favorita Jugo
                var tabla;
                for (let index = 1; index < data.length; index++) {
                    console.log(datos);
                    var datos= data[index].split("||");
                    //console.log(datos[1]);
                    //Concatenamos los datos para hacer la editacion XD.
                   
                    var datosRetornar=datos[0]+"||"+datos[1]+"||"+datos[2]+"||"+datos[3]+"||"+datos[4]
                             +"||"+datos[5]+"||"+datos[6]+"||"+datos[7]+"||"+datos[8]
                             +"||"+datos[9]+"||"+datos[10];
                             //console.log(datosRetornar);
                    //Concateno para mostrar en la tabla.
                    tabla+="<tr><td>"+index+"</td><td>"+datos[1]+"</td><td>"+datos[2]+"</td><td>"
                    +datos[3]+"</td><td>"+datos[4]+"</td><td>"+datos[5]+"</td><td>"+datos[6]+"</td><td>"+datos[7]+"</td><td>"
                    +datos[8]+"</td><td><button type='button' id='editar' class='btn btn-success' onclick='editarDatos(`"+datosRetornar+"`)'><i class='fas fa-user-edit'></i></button></td> <td><button type='button' id='eliminar' class='btn btn-danger' onclick='eliminarAdmin(`"+datos[0]+"`,`"+datos[1]+"`)'><i class='fas fa-user-times'></i> </button></td></tr>";
                    
                }
                datosRetornar="";
                $('#salida').html(tabla);
                $('#primero').val('');
            }
           //var js= JSON.parse(data);
          //var a= data[0].split(' ');
          //var b= data[1].split(' ');
        //var tabal="<tr><td>"+a[0]+"</td><td>"+a[1]+ "</td></tr>"
          //console.log(a);
           
           //$('#salida').html(tabal);
           // $('#primero').val('');
        }
    );
}
//AGREGAR DATOS DEL ADMINISTRADOR AL MODAL
//var modal = document.getElementById("myModal");
function editarDatos(datos, id){
    //console.log(datos);
    //console.log(the.id);
    //Activa modal.
    modal.style.display = "block";
    
    //console.log(id);
    //console.log(datos);
    //Almacenamos los datos en una cadena y hacemos split para separarlos.
    cadena=datos.split("||");
    if(id){
        emailid.style.display="none";
    }
    //Cuando los datos vienen de la tabla buscar
    //Hacemos esto por que el nombre y los apellidos no vienen separados por "||"
    if(cadena[10]=="undefined"){
        //prueba prueba prueba jose pedro
        //juan admin admin
        nombreCompleto=cadena[1].split(" ");
        if(nombreCompleto.length==3){
            $('#name').val(nombreCompleto[0]);
            $('#apellidoP').val(nombreCompleto[1]);
            $('#apellidoM').val(nombreCompleto[2]);
            $('#puesto').val(cadena[2]);
            $('#areaAdministra').val(cadena[3]);
            //$('#tipo').val(cadena[4]);
            $('#email').val(cadena[5]);
            $('#claveTrabajador').val(cadena[6]);
            $('#preguntaSeg').val(cadena[7]);
            $('#respuestaSeg').val(cadena[8]);
            $('#idAdmin').val(cadena[0]);
    
        }else if(nombreCompleto.length==4){

            $('#name').val(nombreCompleto[0]+" "+nombreCompleto[1]);
            $('#apellidoP').val(nombreCompleto[2]);
            $('#apellidoM').val(nombreCompleto[3]);
            $('#puesto').val(cadena[2]);
            $('#areaAdministra').val(cadena[3]);
           // $('#tipo').val(cadena[4]);
            $('#email').val(cadena[5]);
            $('#claveTrabajador').val(cadena[6]);
            $('#preguntaSeg').val(cadena[7]);
            $('#respuestaSeg').val(cadena[8]);
            $('#idAdmin').val(cadena[0]);
    
        }else if(nombreCompleto.length==5){
            $('#name').val(nombreCompleto[0]+" "+nombreCompleto[1]+" "+nombreCompleto[2]);
            $('#apellidoP').val(nombreCompleto[3]);
            $('#apellidoM').val(nombreCompleto[4]);
            $('#puesto').val(cadena[2]);
            $('#areaAdministra').val(cadena[3]);
           // $('#tipo').val(cadena[4]);
            $('#email').val(cadena[5]);
            $('#claveTrabajador').val(cadena[6]);
            $('#preguntaSeg').val(cadena[7]);
            $('#respuestaSeg').val(cadena[8]);
            $('#idAdmin').val(cadena[0]);
        }
        //console.log(nombreCompleto);
       
    }else{
        //Aqui van los datos del usuario se escriben en la vista del modal
        //console.log(cadena[6]);
        $('#name').val(cadena[1]);
        $('#apellidoP').val(cadena[2]);
        $('#apellidoM').val(cadena[3]);
        $('#puesto').val(cadena[4]);
        $('#areaAdministra').val(cadena[5]);
        //$('#tipo').val(cadena[6]);
        $('#email').val(cadena[7]);
        $('#claveTrabajador').val(cadena[8]);
        $('#preguntaSeg').val(cadena[9]);
        $('#respuestaSeg').val(cadena[10]);
        
        //var PacienteId = $(this.datos("id"));
        //Decido agregar el id ya que en el futuro no quiero hacer la busqueda 
        //Y lo dejo no visible para el usuario.
        $('#idAdmin').val(cadena[0]);
        // if(cadena[6]=='AdministradorGlobal'){

        // }
        
    } 
    
}

//Al precionar actualizar datos dentro el modal se registran en la BD.
$("#editActualizar").click(actualizardata);
function actualizardata(){
    //obtenemos los datos de los input que el usaurioi editó.
    //alertify.success("Entro");
    nombre=$('#name').val();
    apellidoP=$('#apellidoP').val();
    apellidoM=$('#apellidoM').val();
    puesto=$('#puesto').val();
    areaAdministra=$("#area option:selected").text();
    tipo=$("#tipo option:selected").text();
    email=$('#email').val();
    clave=$('#claveTrabajador').val();
    preguntaS=$('#preguntaSeg').val();
    respuetaS=$('#respuestaSeg').val();
    id=$('#idAdmin').val();
    //Concatenamos los resultados
    cadena="id="+id+"&name="+nombre+"&apellidoP="+apellidoP+
           "&apellidoM="+apellidoM+"&puesto="+puesto+"&areaAdministra="+areaAdministra+
           "&tipo="+tipo+"&email="+email+"&clave="+clave+"&preguntaS="+
           preguntaS+"&respuestaS="+respuetaS;
    //Mandamos datos con ajax
    $.ajax({
        type:"POST",
        url:"admin/actualizarAdmin.php",
        data:cadena,
        success:function(r){
            console.log("dimequeentro");
            console.log(r);
            // if(r){
            //     //cont=true;
            // //Eliminamos el modal
            // modal.style.display = "none";
            // //recargamos la pagina con los datos actualizados
            // $("#main").load("admin/index.php");
            // }else{
            //     alertify.error("Problemas con el servidor.");
            //     $("#main").load("dashboard.php");
            // }
            // alertify.success("Datos actualizados");

        }
    });

}

//EliminarAdmin
function eliminarAdmin(id,nombre){
    //console.log(id);
    alertify.prompt( 'Eliminar administrador', 'Estas seguro que quieres eliminar a:', nombre
    , function(evt, value) { 
        
        $.ajax({
            type:"POST",
            url:"admin/deleteAdmin.php",
            data:{ids:id},
            success:function(r){
                console.log(r);
                if(r){
                    //console.log("deberiaentrar");
                    //TODO: Cuando hay llaves foraneas no elimina.
                    alertify.success('Se elimino a: ' + value) 
                    $("#main").load("admin/index.php");
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
//Paginacion de la tabla administradores.
function paginacion(numPagina){
    //Obtengo al numero de pagina que quiero ir.
    //console.log(numPagina);
    //Se supone que si llega un 2 debo de recuperar un 20.
    $.ajax({
        type:"POST",
        dataType: 'json',
        url: "admin/paginacion.php",
        data:{ 
            ids: numPagina 
        }
    }).done(
        function(data){
            console.log(data);
            var tabla;
            let i=(numPagina-1)*10;
                for (let index = 0; index < data.length; index++) {
                    i++;
                    //console.log(datos);
                    var datos= data[index].split("||");
                    //console.log(datos[1]);
                    //Concatenamos los datos para hacer la editacion XD.
                    var datosRetornar=datos[0]+"||"+datos[1]+"||"+datos[2]+"||"+datos[3]+"||"+datos[4]
                             +"||"+datos[5]+"||"+datos[6]+"||"+datos[7]+"||"+datos[8]
                             +"||"+datos[9]+"||"+datos[10];
                             //console.log(datosRetornar);
                    //Concateno para mostrar en la tabla.
                    tabla+="<tr><td>"+i+"</td><td>"+datos[1]+"</td><td>"+datos[2]+"</td><td>"
                    +datos[3]+"</td><td>"+datos[4]+"</td><td>"+datos[5]+"</td><td>"+datos[6]+"</td><td>"+datos[7]+"</td><td>"
                    +datos[8]+"</td><td><button type='button' id='editar' class='btn btn-success' onclick='editarDatos(`"+datosRetornar+"`)'><i class='fas fa-user-edit'></i></button></td> <td><button type='button' id='eliminar' class='btn btn-danger' onclick='eliminarAdmin(`"+datos[0]+"`,`"+datos[1]+"`)'><i class='fas fa-user-times'></i> </button></td></tr>";
                    
                }
                datosRetornar="";
                $('#salida').html(tabla);
                $('#primero').val('');
        });
}

