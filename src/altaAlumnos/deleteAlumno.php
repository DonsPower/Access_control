
<?php
include("../con_db.php");

    $id=$_REQUEST['id'];
    $query= " DELETE FROM  alumnos WHERE id='$id' ";
    $resultado=$conex->query($query);

    if($resultado)
        {
            header ('Location: index.php');
        }
    else
        {
            echo "eliminación no exitosa";
        }
?>