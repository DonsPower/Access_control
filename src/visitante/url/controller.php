<?php
    //TODO: Agregar Token de usuario unico
    require_once '../../clases/conexion.Class.php';
    require_once '../../clases/visitorController.Class.php';
    require_once 'config.php';
    $token='';
    
    if(isset($_GET["code"])){
        //obtengo token del cliente.
        $token= $gClient->fetchAccessTokenWithAuthCode($_GET["code"]);
    }else{
        header('Location: ../index.php');
        exit();
    }
   
    //Verificamos si el token es valido. 
    if(isset($token['error']) != "invalid_grant"){
        //Obtengo servicio Y  paso el parametro cliente= google profile
       $oAuth = new Google_Service_Oauth2($gClient);
       //datos del usuario
        $useData= $oAuth->userinfo_v2_me->get();
        //Insertamos datos al objeto
        $visitor = new visitor;
       
        $array = explode(" ", $useData['familyName']);
        echo $visitor ->registerVisURL(array(
            'nombre'=> $useData['givenName'],
            'apellidop' => $array[0],
            'apellidom' => $array[1],
            // agregar una razon x y cuando lo redireccione a la pagina actualizar la razon.
            'razonvisita' => "palabrasecreta"
        ));
        //echo "<pre>";
        //var_dump($useData);
        //echo "</pre>";

    }else{
        //echo "haces algo";
        //si no redireccionamos
        header('location: ../index.php');
        //Ya matenme :C 
        exit();
    }

?>