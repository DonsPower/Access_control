<?php
    //autload api-google
    require_once '../../../vendor/autoload.php';
    //Creamos conexion con el cliente.
    //Ignorar error.
    $gClient = new Google_Client();
    //Credenciales aplicación
    $gClient->setClientId("1016561284982-j949kd2rc84icu5fmuc4nb7hlf40jdqj.apps.googleusercontent.com");
    $gClient->setClientSecret("E0b1dOm5mFR5kpx3Cib1Ywgb");
    $gClient->setApplicationName("auth with google control");
    //redireccionamiento de Url.
    $gClient->setRedirectUri("http://localhost/ACCESS_CONTROL/src/visitante/url/controller.php");
    //ir y obtener login y email.com
    $gClient->addScope("https://www.googleapis.com/auth/plus.login https://www.googleapis.com/auth/userinfo.email");
    $login_url = $gClient->createAuthUrl();
    
?> 