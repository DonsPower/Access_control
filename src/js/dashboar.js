$(document).ready(function(){
    $("#totalArea").click(function(){
        $("#main").load("area/index.php");
    });
});
$(document).ready(function(){
    $("#tablaAlumno").click(function(){
        $("#main").load("altaAlumnos/index.php");
    });
});
//Mostrar alta de alumnos
$(document).ready(function(){
    $("#altaAlumno").click(function(){
        $("#main").load("altaAlumnos/formAlumno.php");
    });
});

//Mostrar tabla Paaes
$(document).ready(function(){
    $("#tablaPaae").click(function(){
        $("#main").load("altaPaae/index.php");
    });
});
//Mostrar alta de paaes
$(document).ready(function(){
    $("#altaPaae").click(function(){
        $("#main").load("altaPaae/formPaae.php");
    });
});

//Mostrar tabla Personal Academico
$(document).ready(function(){
    $("#tablaPerAcademico").click(function(){
        $("#main").load("altaPerAcademico/index.php");
    });
});
//Mostrar alta de personal Academico
$(document).ready(function(){
    $("#altaPerAcademico").click(function(){
        $("#main").load("altaPerAcademico/formPerAcademico.php");
    });
});

//Mostrar agregar visitantes
$(document).ready(function(){
    $("#altaVis").click(function(){
        $("#main").load("visitante/agregarVis.php");
    });
});

//Mostrar tabla visitantes
$(document).ready(function(){
    $("#totalVist").click(function(){
        $("#main").load("visitante/index.php");
    });
});
//Mostrar tabla administradores
$(document).ready(function(){
    $("#totalAdmin").click(function(){
        $("#main").load("admin/index.php");
    });
});
//Mostrar form agregar admin 
$(document).ready(function(){
    $("#altaAdmin").click(function(){
        $("#main").load("admin/addAdmin.php");
    });
});
$(document).ready(function(){
    $("#altaAreaAdmin").click(function(){
        modalopen();
    });
});
//Daremos de baja al visitante y mostraremos un modal para la confirmacion 
// $(document).ready(function(){
//     $("#smodalBtn").click(function(){
//         darBaja();
//     });
// });

function darBaja(id){
    
    alertify.prompt( 'Baja de visitante', '¿Estas seguro que quieres dar de baja a todos los visitantes? Escribe "confirmar" para dar de baja', '...'
    , function(evt, value) {
        if(value=='confirmar'){
            
            $.ajax({
                type:"POST",
                url:"visitante/bajaVisitante.php",
                data:{
                    ids:id
                },
                success:function(r){
                    //console.log(r);
                    if(r){
                        alertify.success('Se dierón de baja todos los usuarios') 
                        $("#main").load("visitante/index.php");
                    }else{
                        alertify.error("Error con el servidor");
                    }
                }
            });
        }else alertify.error('Palabra incorrecta');
       
    
    }
    , function() { alertify.error('Cancelado') });
}


function modalopen(){
    alertify.prompt( 'Alta área', 'Nombre de la nueva área.', '...'
    , function(evt, value) {
        if(value=='...' || value==""){
            alertify.error('Espacios vacíos');
           
        }else{
            $.ajax({
                type:"POST",
                url:"area/addArea.php",
                data:{
                    ids:value
                },
                success:function(r){
                    //console.log(r);
                   if(r==1){
                    alertify.error('Área ya registrada.') 
                   }else if(r==2){
                    alertify.error('Área no valida.') 
                   }
                   else if(r==0){
                        alertify.success('Se almaceno el área') 
                        $("#main").load("area/index.php");
                    }else{
                        alertify.error("Error con el servidor");
                    }
                }
            });
        } 
       
    
    }
    , function() { alertify.error('Cancelado') });
}
