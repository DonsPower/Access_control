<!DOCTYPE html>
<html>
    <head>
    
    <title> insercion_centro </title>
    </head>
    <body>
    <center>   
        <table >
        <thead>
        <tr>
         <th  colspan="1"> <a href="formulario_empleado.php"> Actual   </a></th>
        <th colspan="5">Registros</th>
       

         
         </tr>
         </thead>
         <tbody>
         
     <tr> 
     <td> id </td>
         <td>  </td>
         <td> apPat </td>
         <td> apMat </td>
         <td> estado_civil </td>
         <td>centro_id_centro</td>
         <td>sueldo</td>
         <td>tipo_id_tipo</td>
         <td>departamento_id_nombre</td>
         
         
          </tr>
               
    <?php
    include("conexion.php");
    $query="SELECT * FROM empelado";
    $resultado=$conexion->query($query);
    while($row=$resultado->fetch_assoc()){
   ?>
          
             <tr>
             <td><?php echo $row['id_empleado'];?></td>
            <td><?php echo $row['nombre'];?></td> 
            <td><?php echo $row['apPat'];?></td>
             <td><?php echo $row['apMat'];?></td>
            <td><?php echo $row['estado_civil'];?></td> 
            <td><?php echo $row['centro_id_centro'];?></td>
             <td><?php echo $row['sueldo'];?></td>
            <td><?php echo $row['tipo_id_tipo'];?></td> 
            <td><?php echo $row['departamento_id_nombre'];?></td>
           <td><a href="modificar_empleado.php?id_empleado=<?php echo $row ['id_empleado']; ?>">Modificar_empleado</a></td>
           <td><a href="eliminar_empleado.php?id_empleado=<?php echo $row['id_empleado']; ?>">Eliminar_empleado</a></td>
             </tr>
            
    <?php        
        }
      ?>       
    
    
        
     
        
          
            </tbody>
          </table>
          
          </center>
        
    </body>
</html>



             