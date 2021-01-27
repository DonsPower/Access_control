<?php
    Class area{
        function getArea(){
            $db = new Connect;
            $user = $db-> prepare("SELECT * FROM area");
            $user->execute();
            $userinfo = $user->rowCount();
            return  $userinfo;
        }
        function almacenarArea($area){
            $db = new Connect;
            $user = $db-> prepare("SELECT * FROM area WHERE nombreArea=:area");
            $user->execute([
                ':area'=>$area
            ]);
            $userinfo = $user->rowCount();
            if($userinfo>0){
                return 1;
            }else{
                $user2=$db->prepare("INSERT INTO area (nombreArea) VALUES (:nombre)");
                $user2->execute([
                    ':nombre'=>$area
                ]);
                return  0;
            }
            
        }
        function getAreas(){
            $db = new Connect;
            $user = $db-> prepare("SELECT * FROM area ORDER BY id DESC LIMIT 0 , 10");
            $user->execute();
            return  $user;
        }
        function editarArea($id,$area){
            $db = new Connect;
            $user = $db-> prepare("SELECT * FROM area WHERE nombreArea=:area");
            $user->execute([
                ':area'=>$area
            ]);
            $userinfo = $user->rowCount();
            if($userinfo>0){
                return 1;
            }else{
                $user = $db-> prepare("UPDATE area SET nombreArea=:area WHERE id=:id");
                $user->execute([
                    ':area'=>$area,
                    ':id'=>$id
                ]);
                return 0;
            }
        }
    }

?>