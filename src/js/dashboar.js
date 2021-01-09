
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
//TODO: ENCRYPTAR PASSWORD
$(document).ready(function(){
    $("#altaAdmin").click(function(){
        $("#main").load("admin/addAdmin.php");
    });
});
//Daremos de baja al visitante y mostraremos un modal para la confirmacion 
$(document).ready(function(){
    $("#smodalBtn").click(function(){
        darBaja();
    });
});

function darBaja(){
    alertify.prompt( 'Baja de visitante', '¿Estas seguro que quieres dar de baja a todos los visitantes? Escribe "confirmar" para dar de baja', '...'
    , function(evt, value) {
        if(value=='confirmar'){
            alertify.success('Se dierón de baja todos los usuarios') 
            $.ajax({
                type:"POST",
                url:"visitante/bajaVisitante.php",
                data:{conf:value},
                success:function(r){
                    //console.log(r);
                    if(r){
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

