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

    //La cadena para pasarla al POST.
    cadena="nombre="+nombre+"&apellidop="+apellidoP+"&apellidom="+apellidoM+"&carrera="+
    carrera+"&boleta="+boleta+"&telefonomovil="+telefonoMovil+"&telefonoFijo="+telefonoFijo+"&telefonoPersonal="
    +telefonoPersonal+"&nss="
    +nss+"&email="+emailAlumno;
    
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
                alertify.success("Usuario registrado exitosamente.");
            }else{
                console.log("Error de servidor");
                alertify.error("Error");
            }
        }
    );
}