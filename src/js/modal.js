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
