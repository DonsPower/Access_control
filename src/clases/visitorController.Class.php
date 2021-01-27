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
        
        function deathVisitor($idArea){
            $db = new Connect;
            $user = $db-> prepare("UPDATE registro SET estado= 0 WHERE id_administrador=:idArea AND estado=:estado");
            $user->execute([
                ':idArea'=>$idArea,
                ':estado'=>'1'

            ]);
            return $user;
        }
        //Mostrar datos user
        function tablaVisitantes($num){
            $db= new Connect;
            //El cero tiene que cambiar 
            $user= $db->prepare("SELECT * FROM visitantes  ORDER BY id DESC LIMIT 0, 10");
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
                    ':estado'=>"0"
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
                    ':estado'=> 0
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
        function buscarQrVis($codigoQr, $idAdmin, $hora){
            $db=new Connect;
            $contqro=$db->prepare("SELECT * FROM visitantes WHERE numcodqr=:codigo" );
            $contqro->execute([
                ':codigo'=>$codigoQr
            ]);
            $userinfo = $contqro->fetch(PDO::FETCH_ASSOC);
            
            if($userinfo){
                //Obtengo el id del visitante.
                $idVis=$userinfo['id'];
                //Como saber cuando entro y salio. con un ID 
                //Primero buscamos si no existe ningun registro en la BD.
                $buscarRegistro=$db->prepare("SELECT * FROM registro WHERE numcodqr=:idVis AND id_administrador=:idAdmin AND estado=:estado");
                $buscarRegistro->execute([
                    ':idVis'=>$codigoQr,
                    ':idAdmin'=>$idAdmin,
                    ':estado' => "1"
                ]);
                $res=$buscarRegistro->fetch(PDO::FETCH_ASSOC);
                //SI $res>1 entonces si hay un registro y buscar en que estado esta el campo 'ESTADO'
                if($res){
                    //Buscar si es 0 o 1 el campo 'ESTADO'
                    //1 es igual a la entrada. cero es la salida
                    $checarEstado=$db->prepare("UPDATE registro SET estado=0 WHERE numcodqr=:idVis AND id_administrador=:idAdmin AND estado=1");
                    $checarEstado->execute([
                        'idVis'=>$codigoQr,
                        'idAdmin'=>$idAdmin
                    ]);
                    $retornar="||"."vis"."||".$userinfo['nombre']."||".$hora."||"."1"."||";
                    return $retornar;
                }else{
                    //Activamos el estado del codigo QR y activamos la entrada al area del registro
                    $user=$db->prepare("INSERT INTO  registro (numcodqr, id_administrador, entrada, estado) VALUES (:idVis, :idAdmin, :entrada, :estado)");
                    $user->execute([
                        ':idVis'=>$codigoQr,
                        ':idAdmin'=>$idAdmin,
                        ':entrada'=>$hora,
                        ':estado'=>"1" 
                    ]);
                    $userActive=$db->prepare("UPDATE visitantes SET estado= 1 WHERE id=:id");
                    $userActive->execute([
                        ':id'=>$idVis
                    ]);
                    $res2="||"."vis"."||".$userinfo['nombre']."||".$hora."||"."2"."||";
                    return $res2;
                }
            }
            else{
                //Si no encontro el codigo qr
                return "||"."vis"."||"."No user"."||"."No hora"."||"."0"."||";
            }
        }
        function bajaVistQR($qr, $id){
            $db = new Connect;
            $user = $db->prepare("UPDATE registro SET estado= 0 WHERE numcodqr=:id and id_administrador=:ids ");
            $user->execute([
                ':id'=>$qr,
                ':ids'=>$id
            ]);
            return $user;
            
        }

    }
?>