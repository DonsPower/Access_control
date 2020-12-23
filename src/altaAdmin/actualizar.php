<?php

include("con_db.php");

$id=($_POST['id']);
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

         
		$query="UPDATE administradores SET


	     name='$name',ApellidoPAdm='$ApellidoPAdm',ApellidoMFAdm='$ApellidoMFAdm', Puesto='$Puesto', AreaAdm='$AreaAdm', Tipo='$Tipo', email='$email',
	     TrabajadorAdm='$TrabajadorAdm',contraseña='$contraseña', PreguntaS='$PreguntaS', RespuestaS='$RespuestaS' where id='$id'";


		$resultado=$conex->query($query);

				if($resultado){
					header ('Location: ../dashboard.php');
				}else{
				    echo "modificacion  no exitosa";
			}


?>


 