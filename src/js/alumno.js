
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
    numcodqr=$('#numcodqr').val();

    //La cadena para pasarla al POST.
    cadena="nombre="+nombre+"&apellidop="+apellidoP+"&apellidom="+apellidoM+"&carrera="+
    carrera+"&boleta="+boleta+"&telefonomovil="+telefonoMovil+"&telefonoFijo="+telefonoFijo+"&telefonoPersonal="
    +telefonoPersonal+"&nss="+nss+"&email="+emailAlumno+"&numcodqr="+numcodqr;
    
    $.ajax({
        url:"altaAlumnos/agregarAlumno.php",
        type: "POST",
        dataType: "json",
        data: cadena,
    }).done(
        function(data){
            console.log(data);
            if(data){
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
            }else{
                console.log("Error de servidor");
                alertify.error("Error");
            }
        }

    );
}

function editarDatosAlumnos(datos){
    modal.style.display = "block";
    console.log(datos);
    cadena=datos.split("||");

        $('#nombreAlumno').val(cadena[1]);
        $('#apellidoPatAlumno').val(cadena[2]);
        $('#apellidoMatAlumno').val(cadena[3]);
        $('#carrera').val(cadena[4]);
        $('#boleta').val(cadena[5]);
        $('#telefonoMovil').val(cadena[6]);
        $('#telefonoFijo').val(cadena[7]);
        $('#telefonoPersonal').val(cadena[8]);
        $('#emailAlumno').val(cadena[9]);
        $('#NSS').val(cadena[10]);
        $('#numcodqr').val(cadena[11]);
        $('#idAdmin').val(cadena[0]);
        
}

$("#editActualizar").click(actualizardata);
function actualizardata(){
    //obtenemos los datos de los input que el usaurioi editó.
    //alertify.success("Entro");
    nombre=$('#nombreAlumno').val();
    apellidoP=$('#apellidoPatAlumno').val();
    apellidoM=$('#apellidoMatAlumno').val();
    puesto=$('#carrera').val();
    areaAdministra=$('#boleta').val();
    tipo=$('#telefonoMovil').val();
    email=$('#telefonoFijo').val();
    clave=$('#telefonoPersonal').val();
    preguntaS=$('#emailAlumno').val();
    respuetaS=$('#NSS').val();
    numcodqr=$('#numcodqr').val();
    id=$('#idAdmin').val();

    //Concatenamos los resultados
    cadena="id="+id+"&nombreAlumno="+nombre+"&apellidoPatAlumno="+apellidoP+
           "&apellidoMatAlumno="+apellidoM+"&carrera="+puesto+"&boleta="+areaAdministra+
           "&telefonoMovil="+tipo+"&telefonoFijo="+email+"&telefonoPersonal="+clave+"&emailAlumno="+
           preguntaS+"&NSS="+respuetaS+"&numcodqr="+numcodqr;
    //Mandamos datos con ajax
    $.ajax({
        type:"POST",
        url:"altaAlumnos/actualizarAlumnos.php",
        data:cadena,
        success:function(r){
            console.log(r);
            if(r){
                //cont=true;
            //Eliminamos el modal
            modal.style.display = "none";
            //recargamos la pagina con los datos actualizados
            alertify.success("Datos actualizados");
            $("#main").load("altaAlumnos/index.php");
            }else{
                alertify.error("Problemas con el servidor.");
                $("#main").load("dashboard.php");
            }
           

        }
    });

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