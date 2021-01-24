
<?php
    $usuario=$_POST['email'];
    

    session_start();
    $_SESSION['email']=$usuario;



  $conex = mysqli_connect("localhost","root","","SistemaControlAcceso");


    $consulta="SELECT*FROM administradores where email='$usuario' ";
    $resultado=mysqli_query($conex,$consulta);

    $row=mysqli_num_rows($resultado);

    if($row){
        header("Location: restablecerContraseña.php");
    }else{
        ?>
        <?php
            include("index.php");  
            header("Location: index.php");
        ?>
     
       <h3> Error en la Autenticación</h3>	
	</div>       
    
       <?php 
}        

mysqli_free_result($resultado);
mysqli_close($conex);