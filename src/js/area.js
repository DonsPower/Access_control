

function editarDatosArea(datos){
    modal.style.display = "block";
    console.log(datos);
    cadena=datos.split("||");
        $('#nombreAlumno').val(cadena[1]);
        $('#idAdmin').val(cadena[0]);
    
}

$("#editActualizarAlu").click(actualizardataAlu);
function actualizardataAlu(){
    //obtenemos los datos de los input que el usaurioi editó.
    //alertify.success("Entro");
    
    nombre=$('#nombreAlumno').val();
    id=$('#idAdmin').val();
    if(nombre=="")alertify.error("Campos vacíos, por favor llene todos los campos");
    else{
        //Concatenamos los resultados
        cadena="id="+id+"&nombreAlumno="+nombre;
        //Mandamos datos con ajax
        $.ajax({
            type:"POST",
            url:"area/actualizarArea.php",
            data:cadena,
            success:function(data){
               // console.log(data);
               if(data==1){
                    alertify.error("El área ya existe en la base de datos.");
                }else if(data==2){
                    //nombre incorrecto
                    $('#nombreAlumno').val("");
                    alertify.error("El nombre no debe de llevar números o caracteres especiales");

                }
                else if(data==0){
                    $('#nombreAlumno').val("");
                    alertify.success("Área actualizada exitosamente.");
                    $("#main").load("area/index.php");
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

//Paginacion de la tabla administradores.
function paginacion5(numPagina){
    //Obtengo al numero de pagina que quiero ir.
    //console.log(numPagina);
    //Se supone que si llega un 2 debo de recuperar un 20.
    let id=$('#idbusc').val();
    $.ajax({
        type:"POST",
        dataType: 'json',
        url: "area/paginacion.php",
        data:{ 
            ids: numPagina 
        }
    }).done(
        function(data){
            
            
            console.log(id);
            var tabla;
            let i=(numPagina-1)*10;
                for (let index = 0; index < data.length; index++) {
                    i++;
                    //console.log(datos);
                    var datos= data[index].split("||");
                    //console.log(datos[1]);
                    //Concatenamos los datos para hacer la editacion XD.
                    var datosRetornar=datos[0]+"||"+datos[1];
                             //console.log(datosRetornar);
                    //Concateno para mostrar en la tabla.
                    tabla+="<tr><td>"+i+"</td><td>"+datos[1]+"</td><td><button type='button' id='editar' class='btn btn-success'  ><i class='fas fa-user-edit'></i></button></td></tr>";

                }
                datosRetornar="";
                $('#salida').html(tabla);
                $('#primero').val('');
        });
}