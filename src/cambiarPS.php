
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
    
</head>
<body>
<?php
$var1=$_GET["var1"];
$var2=$_GET["var2"];
$var3=$_GET["var3"];
?>

<form action="upPS2.php?var1=<?php echo $var1;?>&var2=<?php echo $var2;?>&var3=<?php echo $var3;?>" method="post">
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
		

			<br><br>
			<input type="submit" class="btn btn-secundary btn-lg btn-block" value="Actualizar" name="action" />
			<br>
			<br>
			<td><a href="index.php" class="btn btn-primary btn-block" > Iniciar Sesion  </a></td>
	</div>
</form>
			
			
		
	</div>
</div>
	
</form>
</body>
</html>



