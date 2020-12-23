<?php
    
    class admin{
        function getDataAdmin(){
            $db = new Connect;
            $user = $db-> prepare("SELECT * FROM administradores");
            $user->execute();
            $userinfo = $user->rowCount();
            return  $userinfo;
        }
    }

?>