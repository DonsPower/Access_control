<?php
    include("../con_db.php");
    require '../phpqrcode/qrlib.php';
    $dir='temp/';
    if(!file_exists($dir)){
        mkdir($dir);
    }

    $filename=$dir.'test.png';
    $tamanio=10;
    $level='M';
    $frameSize=3;
    

    
    $id=intval($_COOKIE["id"]);
    
    if(isset($_POST['submit'])){
        //echo "entro";
        if(strlen($_POST['razon']) >= 1)
            {
                
                $razon = ($_POST['razon']);
                $query="UPDATE visitantes SET razonvisita='$razon' where id='$id'";
                $resultado=$conex->query($query);
                $query2= "SELECT numcodqr FROM visitantes WHERE id='$id'";
                $resultado2=mysqli_query($conex,$query2);
                $row=$resultado2->fetch_assoc();
                if ($resultado2) {
                    print_r ($row);
                    $conenido=$row['numcodqr'];
                    QRcode::png($conenido, $filename, $level, $tamanio, $frameSize);
                     echo '<img src="'.$filename.'"/> ';
                }else{
                    echo "No se pudo registar el codigo qr";
                }
                if($resultado){
                       //header ('Location: index.php');
                }else{
                    echo "modificacion  no exitosa";
                }
            }
        }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>Holaaa</h1>
    <a href="actualizarAuth.php?file=test.png">Click me</a>
</body>
</html>

<?php
if (!empty($_GET['file'])) {
 
    $data=file_get_contents('temp/test.png');
    header("Cache-Control: public");
    header("Content-Description: File Transfer");
    header("Content-Disposition: attachment; filename=test.png");
    header("Content-Type: application/zip");
    header("Content-Transfer-Emcoding: binary");
    readfile($data);
    exit;   
}else{
    echo "No se pudo descargar";
}
?>