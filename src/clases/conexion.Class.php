<?php
class Connect extends PDO{
    //Conexion a la base de datos
    public function __construct(){
        parent::__construct("mysql:host=localhost;dbname=autenticaciónca",'root', '',
        array(PDO::MYSQL_ATTR_INIT_COMMAND=> "SET NAMES utf8"));
    }
}
?>