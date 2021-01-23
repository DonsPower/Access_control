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


$('#enviarVisitante').click(regresar);
var total=[0];
//Boton buscar usuario.
function regresar(){
    
    $.ajax({
        url: 'visitante/buscarVist.php',
        type: 'post',
        dataType: 'json',
        data:{
            buscar:$('#buscar').val()
        }
    }).done(
        function(data){
           //console.log(total[0]);
             //Obtenemos el numero mayor de consultas para así cambiar el estado del boton.
             if(total[0]<data.length){
                total.pop();
                total.push(data.length);
            }
            //console.log(total);
            if(total[0]>data.length) {
                //Ocultar input buscar
                $('#buscar').css('visibility', 'hidden');
                //$( "#primero" ).hide();
                document.getElementById("enviarVisitante").innerHTML = "Regresar";
                alertify.success("Busqueda correcta");
            }
            else{
                //Mostrar input buscar
                $('#buscar').css('visibility', 'visible');
               // $('#primero').toggle(); 
                document.getElementById("enviarVisitante").innerHTML = "Buscar";
            }
            //Si el array solo trae un dato significa que no hay resultados.
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
                    
                    //console.log(datos);
                    var datos= data[index].split("||");
                    //console.log(datos[1]);
                    //Activo e inactivo 
                    var estado="";
                    if(datos[4]==1) estado="Activo";
                    else estado="Inactivo";
                    //Concatenamos los datos para hacer la editacion XD.
                   
                    var datosRetornar=datos[0]+"||"+datos[1]+"||"+datos[2]+"||"+datos[3]+"||"+datos[4]+"||tabla";
                    //console.log(datosRetornar);
                    //Concateno para mostrar en la tabla.
                    tabla+="<tr><td>"+index+"</td><td>"+datos[1]+"</td><td>"+datos[2]+"</td><td>"
                    +datos[3]+"</td><td>"+estado+"</td><td><button type='button' id='editar' class='btn btn-success' onclick='editarDatosVis(`"+datosRetornar+"`)'><i class='fas fa-user-edit'></i></button></td> <td><button type='button' id='eliminar' class='btn btn-danger' onclick='bajaVist(`"+datos[0]+"`,`"+datos[1]+"`)'><i class='fas fa-user-minus'></i></button></td></tr>";
                    
                }
                datosRetornar="";
                $('#salida').html(tabla);
                $('#primero').val('');
            }
        }
    );

}

//Funcion para activar modal. editar visitante.
function editarDatosVis(datos){
    console.log(datos);
    modal.style.display = "block";
    datosVist=datos.split("||");
        //console.log(datosVist[5]);
        if(datosVist[5]=="tabla"){
            //TODO: QUE PASA CUANDO HAY MAS DE DOS NOMBRES.
            //juan hernandez montalvo
            //Abraham hernandez montalvo
            let total=datosVist[1].split(" ");
            if(total.length==3){
                //1 nombre
                $('#idVist').val(datosVist[0]);
                let completo=datosVist[1].split(" ");
                $('#name').val(completo[0]);
                $('#apellidoP').val(completo[1]);
                 $('#apellidoM').val(completo[2]);
                $('#razon').val(datosVist[2]);
            }else if(total.length==4){
                $('#idVist').val(datosVist[0]);
                let completo=datosVist[1].split(" ");
                $('#name').val(completo[0]+" "+completo[1]);
                $('#apellidoP').val(completo[2]);
                 $('#apellidoM').val(completo[3]);
                $('#razon').val(datosVist[2]);
            }else if(total.length==5){
                //3 nombres.
                $('#idVist').val(datosVist[0]);
                let completo=datosVist[1].split(" ");
                $('#name').val(completo[0]+" "+completo[1]+" "+completo[2]);
                $('#apellidoP').val(completo[3]);
                 $('#apellidoM').val(completo[4]);
                $('#razon').val(datosVist[2]);
            }

        }else{
            $('#idVist').val(datosVist[0]);
            $('#apellidoP').val(datosVist[2]);
            $('#apellidoM').val(datosVist[3]);
            $('#razon').val(datosVist[4]);
            $('#name').val(datosVist[1]);
        }
}
    //Al precionar el boton editar datos en el modal.
    $("#editVistActualizar").click(actualizarvist);
function actualizarvist(){
        id=$('#idVist').val();
        nombre=$('#name').val();
        apellidoP=$('#apellidoP').val();
        apellidoM=$('#apellidoM').val();
        razon=$('#razon').val();
        //La cadena para pasarla al POST.
        cadena="id="+id+"&nombre="+nombre+"&apellidop="+apellidoP+"&apellidom="+apellidoM+"&razon="+razon;
        $.ajax({
            type: "POST",
            url: "visitante/actualizarVis.php",
            data: cadena,
            success:function(data){
                console.log(data);
                if(data){
                    //Eliminamos el modal
                     modal.style.display = "none";
                     //recargamos la pagina con los datos actualizados
                   $("#main").load("visitante/index.php");
                    alertify.success("Datos actualizados");
                }else{
                    alertify.error("Problemas con el servidor.");
                $("#main").load("dashboard.php");
                }
            }
        })
}

function bajaVist(id, nombre){
    
    alertify.prompt( 'Baja al visitante', 'Estas seguro que quieres dar de baja a:', nombre
    , function(evt, value) { 
         
        $.ajax({
            type:"POST",
            url:"visitante/bajaVistOne.php",
            data:{ids:id},
            success:function(r){
                if(r){
                    //console.log("deberiaentrar");
                    $("#main").load("visitante/index.php");
                    alertify.success("Se hizo de baja correctamente.");
                }else{
                    alertify.error("Problemas con el servidor.");
                    $("#main").load("dashboard.php");
                }
            }
        });
    
    }
    , function() { alertify.error('Cancelado') });
}

function paginacion(numPagina){
    //Obtengo al numero de pagina que quiero ir.
    //console.log(numPagina);
    //Se supone que si llega un 2 debo de recuperar un 20.
    $.ajax({
        type:"POST",
        dataType: 'json',
        url: "visitante/paginacion.php",
        data:{ 
            ids: numPagina 
        }
    }).done(
        function(data){
            //console.log(data[0]);
            var tabla;
                //console.log(numPagina);
                //No se en que momento o cual sea mejor entre var y let.
                let i=(numPagina-1)*10;
                for (let index = 0; index < data.length; index++) {
                    i++;
                    //console.log(datos);
                    var datos= data[index].split("||");
                    //console.log(datos[1]);
                    //Activo e inactivo 
                    var estado="";
                    if(datos[4]==1) estado="Activo";
                    else estado="Inactivo";
                    //Concatenamos los datos para hacer la editacion XD.
                   
                    var datosRetornar=datos[0]+"||"+datos[1]+"||"+datos[2]+"||"+datos[3]+"||"+datos[4]+"||tabla";
                    //console.log(datosRetornar);
                    //Concateno para mostrar en la tabla.
                    tabla+="<tr><td>"+i+"</td><td>"+datos[1]+"</td><td>"+datos[2]+"</td><td>"
                    +datos[3]+"</td><td>"+estado+"</td><td><button type='button' id='editar' class='btn btn-success' onclick='editarDatosVis(`"+datosRetornar+"`)'><i class='fas fa-user-edit'></i></button></td> <td><button type='button' id='eliminar' class='btn btn-danger' onclick='bajaVist(`"+datos[0]+"`,`"+datos[1]+"`)'><i class='fas fa-user-minus'></i></button></td></tr>";
                    
                    
                }
                datosRetornar="";
                //console.log(tabla);
                $('#salida').html(tabla);
                
        }
    );
}

