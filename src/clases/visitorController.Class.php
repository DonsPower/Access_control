<?php 

    //PHP Data Objects
    class visitor {
        //Obengo el total de visitantes activos
        function getVisitorActive(){
            $db = new Connect;
            $user = $db-> prepare("SELECT * FROM visitantes WHERE estado=1");
            $user->execute();
            $userinfo = $user->rowCount();
            return  $userinfo;
        }
        //Obtengo TOTAL DE VISITANTES
        function getVisitorData(){
            $db = new Connect;
            $user = $db-> prepare("SELECT * FROM visitantes");
            $user->execute();
            $userinfo = $user->rowCount();
            return  $userinfo;
        }
        //Dar de baja al visitante 
        //TODO: MATAR EL TIEMPO DE SALIDA DE ELLOS falta agregar.
        function deathVisitor(){
            $db = new Connect;
            $user = $db-> prepare("UPDATE visitantes SET estado= 0 WHERE estado=1");
            $user->execute();
            return $user;
        }
        //Mostrar datos user
        function tablaVisitantes(){
            $db= new Connect;
            $user= $db->prepare("SELECT * FROM visitantes  ORDER BY id DESC");
            $user->execute();
            return $user;

        }
        //Actualizar al visitante-Obtenemos los datos del modal.
        function actualizarVis($id,$nombre,$apellidop,$apellidom,$razon){
            $db=new Connect;
            $user=$db->prepare("UPDATE visitantes SET nombre=:nombre, apellidop=:apellidop, apellidom=:apellidom, razonvisita=:razon WHERE id=:id");
            $user->execute([
                ':id'=>$id,
                ':nombre'=>$nombre,
                ':apellidop'=>$apellidop,
                ':apellidom'=>$apellidom,
                ':razon'=>$razon
            ]);
            return $user;
        }
        //Dar de baja a solo un visitante
        function bajaVist($id){
            $db = new Connect;
            $user = $db->prepare("UPDATE visitantes SET estado= 0 WHERE id=:id");
            $user->execute([
                ':id'=>$id
            ]);
            return $user;
        }
        //Agregar a un visitante
        function agregarVis($nombre, $apellidop, $apellidom, $razon, $codigoQr){
            //Verifico que el codigo QR no este en uso.
            $db=new Connect;
            $contqr=$db->prepare("SELECT * FROM visitantes WHERE numcodqr=:codigoQr" );
            $contqr->execute([
                ':codigoQr'=>$codigoQr
            ]);
            $contador=$contqr->rowCount();
            if ($contador>0) {
                # ya existe un codigo qr existente
                return 1;
            }else{
                //No esta en uso el qr
                $user=$db->prepare("INSERT INTO visitantes (nombre, apellidop, apellidom, razonvisita, numcodqr, estado) VALUES (:nombre, :apellidop, :apellidom, :razon, :codigoQr, :estado)");
                $user->execute([
                    ':nombre'=>$nombre,
                    ':apellidop'=>$apellidop,
                    ':apellidom'=>$apellidom,
                    ':razon'=>$razon,
                    ':codigoQr'=>$codigoQr,
                    ':estado'=>"1"
                ]);
                return 0;
            }
        }
        //generar token
        function generarToken($tamaño){
            $char = "qwertywDns07";
            $code = "";
            $clean = strlen($char) -1;
            //$random_number = intval( "0" . rand(1,9) . rand(0,9) . rand(0,9) . rand(0,9) . rand(0,9) );
            //$random_string = chr(rand(65,90)) . chr(rand(65,90)) . chr(rand(65,90)) . chr(rand(65,90)) . chr(rand(65,90));
            
            while(strlen($code) < $tamaño){
                //si se agrega al sistema aumentar rango.
                $code .= $char[rand(0,$clean)];
            }
            return "vis-".$code;
        }
        function validarToken($token){
            $db=new Connect;
            $contqr=$db->prepare("SELECT * FROM visitantes WHERE numcodqr=:codigo" );
            $contqr->execute([
                ':codigo'=>$token
            ]);
            $contador=$contqr->rowCount();
            if($contador>0){
                //Si existe el codigo qr
                return 1;
            }else{
                return 0;
            }
        }
        //registrar Visitante por metodo URL
        function registerVisURL($data){
            //Hay 2 tipos de redireccionamiento cuando tengo la razonvisita=palabrasecreta=google y cuando no
            //Entonces almaceno la razon de vista que trae al principio el array para despues comparar
            $comparar_razon_redireccionamiento=$data['razonvisita'];
            $token = $this->generarToken(10); //vis-4
            $comprobarToken=$this->validarToken($token);
            //me retorna si el token ya existe en la BD 0 o 1
            if($comprobarToken==1){
                //funcion recursiva no se si esto se pueda hacer aqui pero como tal debe de funcionar 
                return $this->registerVisURL($data);
            }else{
                //Si no existe el token en la BD entra aqui
                $db=new Connect;
                $addUser = $db->prepare('INSERT INTO  visitantes (nombre, apellidop, apellidom, razonvisita, numcodqr, estado) 
                                        VALUES (:nombre, :apellidop, :apellidom, :razonvisita, :numcodqr, :estado)');
                $addUser->execute([
                    ':nombre'=>$data['nombre'],
                    ':apellidop'=>$data['apellidop'],
                    ':apellidom'=> $data["apellidom"],
                    ':razonvisita'=> $data["razonvisita"],
                    ':numcodqr' => $token,
                    ':estado'=> 1
                ]);
                //Si en la razon no hay nada almacenado redirecciona para agregarlo
                if($comparar_razon_redireccionamiento == "palabrasecreta"){
                    if ($addUser) {
                        setcookie("id", $db->lastInsertId(), time()+60*60*24*30, "/", NULL);
                        header("location: ../url/index.php");
                        exit();
                        
                    }else{
                        return "Error -> No se agrego el usuario";
                        exit();
                    }
                }else{
                
                 //Generar codigo qr
                 require '../../lib/phpqrcode/qrlib.php';
                 //require '../../phpqrcode/qrlib.php';
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
            }
            
        } 
         //Checamos que el usuario esta en la BD 
         function userActivo($id){
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
        //Obtenemos el usuario que obtuvimos con el registro de google URL visitante
        function imprimirResultados($id){
            $db = new Connect;
            $user = $db-> prepare("SELECT * FROM visitantes WHERE id=:id");
            $user->execute([
                ':id' =>intval($id)
            ]);
            $userinfo = $user->fetch(PDO::FETCH_ASSOC);
            return  $userinfo["nombre"]. " ". $userinfo["apellidop"]." ".$userinfo["apellidom"];
        }
        //Editar la razon de la visita
        function editarRazon($razon, $id){
            $db = new Connect;
           
            $user2 = $db-> prepare("UPDATE visitantes SET razonvisita=:razon where id=:id");
            $user2->execute([
                ':id' =>intval($id),
                ':razon'=>$razon
            ]);
            $user = $db-> prepare("SELECT * FROM visitantes WHERE id=:id");
            $user->execute([
                ':id' =>intval($id)
            ]);
            $userinfo = $user->fetch(PDO::FETCH_ASSOC);
            return  $userinfo;
        }
        //Buscamos Codigo QR
        //Hacer el filtro del codigo QR para poblacion fija y flotante
        function buscarQr($codigoQr, $idAdmin, $hora){
            $db=new Connect;
            $contqro=$db->prepare("SELECT * FROM visitantes WHERE numcodqr=:codigo" );
            $contqro->execute([
                ':codigo'=>$codigoQr
            ]);
            $userinfo = $contqro->fetch(PDO::FETCH_ASSOC);
            
            if($userinfo){
             //Si encontro el codigo qr en la base de datos.
             $estado=$userinfo['estado'];
             $idVis=$userinfo['id'];
             //Cuando el estado es 0 se registrara un nuevo registro en el área
             if($estado==0){
                 //pasaremos de cero a uno. inactivo - activo
                 //Guardo la hora en la tabla.
                 $user=$db->prepare("INSERT INTO  registro_visitante (id_visitante, id_administrador, entrada) VALUES (:idVis, :idAdmin, :entrada)");
                 $user->execute([
                     ':idVis'=>$idVis,
                     ':idAdmin'=>$idAdmin,
                     ':entrada'=>$hora,
                     
                 ]);
                 //Cambio el estado a 1. 
                $user2 = $db-> prepare("UPDATE visitantes SET estado=1 WHERE id=:id");
                 $user2->execute([
                     ':id'=>$idVis
                 ]);
                if($user){
                    return $userinfo['nombre']."||".$userinfo['apellidop']."||".$userinfo['apellidom']."||".$userinfo['estado']."||".$userinfo['numcodqr']."||".$hora;
                } 
                else{
                    return "Error : No se guardo la entrada.";
                } ; 
                // return  $user;       
             }else{
                 //El usuario registrara su salida pasaremos de 1 a 0 el QR
                 $time = time();
                 $hora2=date("d-m-Y H:i:s", $time);
                 
                 $user=$db->prepare("UPDATE registro_visitante SET salida=:salida WHERE id_visitante=:id");
                 $user->execute([
                     ':salida'=>$hora,
                     ':id'=>$idVis
                 ]);
                 $user2 = $db-> prepare("UPDATE visitantes SET estado= 0 WHERE id=:id");
                 $user2->execute([
                     ':id'=>$idVis
                 ]);
                 if($user2){
                     return $hora2;
                 }else{
                     return "Error: no se guardo la salida";
                 }
             }
            }
            else{
                //Si no encontro el codigo qr
                return "Error: No se encontro el codigo QR";
            }
        }

    }
?>