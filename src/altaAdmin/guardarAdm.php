
<?php
include("con_db.php");

         $name = ($_POST['name']);
        $ApellidoPAdm = ($_POST['ApellidoPAdm']);
        $ApellidoMFAdm = ($_POST['ApellidoMFAdm']);
        $Puesto = ($_POST['Puesto']);
        $AreaAdm = ($_POST['AreaAdm']);
        $Tipo = ($_POST['Tipo']);
        $email = ($_POST['email']);
        $TrabajadorAdm = ($_POST['TrabajadorAdm']);
        $contraseña = ($_POST['contraseña']);
        $PreguntaS = ($_POST['PreguntaS']);
        $RespuestaS = ($_POST['RespuestaS']);


        $query = "INSERT INTO administradores (name,ApellidoPAdm,ApellidoMFAdm,Puesto,AreaAdm,Tipo,email,TrabajadorAdm,contraseña,PreguntaS,RespuestaS) 
                     VALUES('$name','$ApellidoPAdm','$ApellidoMFAdm','$Puesto','$AreaAdm','$Tipo','$email','$TrabajadorAdm','$contraseña','$PreguntaS','$RespuestaS')";


$resultado=$conex->query($query);

if($resultado)
{
  header ('Location: index.php');
}else
{
    echo "insercion no exitosa";
}

?>