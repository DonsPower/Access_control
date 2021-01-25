
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Control de acceso</title>
    <!--CSS - Bootstrap-->
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
    <link rel="stylesheet" href="css/style.css">
    <!--JavaScript-->
    <script src="https://code.jquery.com/jquery-3.2.1.js"></script>
    <script src="js/index.js"></script>
    <link rel="stylesheet" href="lib/alertifyjs/css/alertify.css">
    <link rel="stylesheet" href="lib/alertifyjs/css/themes/default.css">

    
    <link rel="stylesheet" href="lib/alertifyjs/css/alertify.css">
    <link rel="stylesheet" href="lib/alertifyjs/css/themes/default.css">

    <script>
function comprobarClave(){
    contraseña = document.f1.contraseña.value
    contraseña = document.f1.contraseña.value

    if (contraseña == contraseña)
       alert("Las dos claves son iguales...")
       
    else
       alert("Las dos claves son distintas...")
}
</script>
    
</head>
<body>
<?php
$var1=$_GET["var1"];

?>
<form action="up2.php?var1=<?php echo $var1;?>" method="post" name="f1">
  <div class="container">

     <div class="row ">
      
      <div class="col-sm-5" style="width: 50%; margin-left: 6%; margin-top:16%;">
      <!--<img src="img/logo.png" alt="logo-ControlAccess" width="80" height="80">-->
        <img src="img/controlacceso.png"  width="320" height="100">
       
      </div>
      <div class="col-sm-5" style="margin-top:10%; text-align: center;">
        <div class="card">
        <div class="mb-3">
		<h1 vertical-align:middle>   Ingrese su nueva contraseña </h1>
			
			<input  type="password" name="contraseña" placeholder="Contraseña" />
      <br>
      <input  type="password" name="contraseña" placeholder="Confirma la contraseña" />

			<br><br>
			<input type="submit" class="btn btn-secundary btn-lg btn-block" value="Actualizar" name="action" />
			<br>
			<br>
			<td><a href="index.php" class="btn btn-primary btn-block" > Regresar </a></td>
	</div>
</form>
			
		
	</div>
</div>
	
</form>
</body>
</html>


