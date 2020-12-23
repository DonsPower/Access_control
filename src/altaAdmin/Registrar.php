<?php

include("con_db.php");
if(isset($_POST['register'])){

	if(strlen($_POST['name']) >= 1 && strlen($_POST['ApellidoPAdm']) >= 1 && strlen($_POST['ApellidoMFAdm']) >= 1 && strlen($_POST['Puesto']) >= 1 &&
		strlen($_POST['AreaAdm']) >= 1 && strlen($_POST['Tipo']) >= 1 && strlen($_POST['email']) >= 1 && strlen($_POST['TrabajadorAdm']) >= 1 &&
		strlen($_POST['contraseña']) >= 1 && strlen($_POST['PreguntaS']) >= 1 && strlen($_POST['RespuestaS']) >= 1  ){


	
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
	


		$consulta = "INSERT INTO administradores (name,ApellidoPAdm,ApellidoMFAdm,Puesto,AreaAdm,Tipo,email,TrabajadorAdm,contraseña,PreguntaS,RespuestaS) 
					 VALUES('$name','$ApellidoPAdm','$ApellidoMFAdm','$Puesto','$AreaAdm','$Tipo','$email','$TrabajadorAdm','$contraseña','$PreguntaS','$RespuestaS')";
		$resultado = mysqli_query($conex,$consulta);

			if ($resultado){
				?>
				   <h3 class="ok" align="center"> Administrador Registrado Exitosamente</h3>
				<?php
				header ('Location: index.php');
			}else{
				?>
				   <h3 class="bad" align="center"> Ocurrio un error</h3>
				<?php
			}
		}else{
				?>
				   <h3 class="bad" align="center"> Complete todos los campos</h3>
				<?php
		}

	}



?>