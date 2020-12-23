<?php 
    //PHP Data Objects
    class Connect extends PDO{
        //Conexion a la base de datos
        public function __construct(){
            parent::__construct("mysql:host=localhost;dbname=autenticaciónca",'root', '',
            array(PDO::MYSQL_ATTR_INIT_COMMAND=> "SET NAMES utf8"));
        }
    }
    class Controller {
       
        //Imprimir resultados
        function imprimir_resultados($id){
            $db = new Connect;
            $user = $db-> prepare("SELECT * FROM visitantes WHERE id=:id");
            $user->execute([
                ':id' =>intval($id)
            ]);
            $userinfo = $user->fetch(PDO::FETCH_ASSOC);
            return  $userinfo["nombre"]. " ". $userinfo["apellidop"]." ".$userinfo["apellidom"];
        }
        //Checamos que el usuario este dentro.
        function user_activo($id){
            //me conecto a la BD
            $db = new Connect;
            $user = $db-> prepare("SELECT id FROM visitantes WHERE id=:id");
            $user->execute([
                ':id' =>intval($id)
            ]);
            $userinfo= $user->fetch(PDO::FETCH_ASSOC);
            if (!$userinfo) {
                return FALSE;
            }else{
                return TRUE;
            }
        }
        //gemerar token
        function generar_token($tamaño){
            $char = "qwertywDns07";
            $code = "";
            $clean = strlen($char) -1;
            //$random_number = intval( "0" . rand(1,9) . rand(0,9) . rand(0,9) . rand(0,9) . rand(0,9) );
            //$random_string = chr(rand(65,90)) . chr(rand(65,90)) . chr(rand(65,90)) . chr(rand(65,90)) . chr(rand(65,90));
            
            while(strlen($code) < $tamaño){
                //si se agrega al sistema aumentar rango.
                $code .= $char[rand(0,$clean)];
            }
            return $code;
        }

        //Insertar datos a visitantes
          function insertData($data){ 
            //me conecto a la base de datos;
            $db = new Connect;
            //Genero token
            $token = $this->generar_token(10);
            //Hay 2 tipos de redireccionamiento cuando tengo la razon y cuando no
            //Entonces almaceno la razon de vista que trae al principio el array para despues comparar
            $comparar_razon_redireccionamiento=$data['razonvisita'];
            //Buscamos si ya hay un registro con este TOKEN.
            $sql = $db->prepare("SELECT * FROM visitantes WHERE numcodqr=:token");
            $sql ->execute([':token' => $token]);
            $respuesta_busqueda= $sql->fetch(PDO::FETCH_ASSOC);
            //Si no existe en la BD agregamos datos.
            if (!$respuesta_busqueda) {
                $addUser = $db->prepare('INSERT INTO  visitantes (nombre, apellidop, apellidom, razonvisita, numcodqr) 
                                        VALUES (:nombre, :apellidop, :apellidom, :razonvisita, :numcodqr)');
                $addUser->execute([
                    ':nombre'=> $data["nombre"],
                    ':apellidop'=> $data["apellidop"],
                    ':apellidom'=> $data["apellidom"],
                    ':razonvisita'=> $data["razonvisita"],
                    ':numcodqr' => $token
                ]);
                //Si en la razon no hay nada almacenado redirecciona para agregarlo
                if($comparar_razon_redireccionamiento == "palabrasecreta"){
                    if ($addUser) {
                        setcookie("id", $db->lastInsertId(), time()+60*60*24*30, "/", NULL);
                        header("location: authVist.php");
                        exit();
                        
                    }else{
                        return "Error -> No se agrego el usuario";
                    }
                }else{
                    //Aqui hay algo almacenado en la razon de visita
                    //Generar codigo qr
                    require '../phpqrcode/qrlib.php';
                    $dir='temp/';
                    if(!file_exists($dir)){
                        mkdir($dir);
                    }

                    $filename=$dir.'test.png';
                    $tamanio=10;
                    $level='M';
                    $frameSize=3;
                    $contenido= $token;
                    QRcode::png($contenido, $filename, $level, $tamanio, $frameSize);
                     echo '<img src="'.$filename.'"/> ';
                }
                

            }else{
                setcookie("id", $sql["id"], time()+60*60*24*1, "/", NULL);
                header("location: ../menu.php");
                exit();
            }
          }
    }
?>
/*Termino del dia a todos en ceros al dia 
    Dato tipo time actualizar estado.
    Demons configure -inv 
 */