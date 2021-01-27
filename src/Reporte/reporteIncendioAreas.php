<?php
    //TODO: Cuando se haga el redireccionamiento redireccionar al sahboar en vez del index
    //importamos la clase auth
    require_once '../clases/conexion.Class.php';
    require_once '../clases/authController.Class.php';
    require_once "../clases/adminController.Class.php";
    session_start();
    //creamos el objeto cliente
    $auth=new auth;
    $admin=new admin;
    $location="../index.php";
    if (isset($_SESSION['nombre'])){
        $cliente = $_SESSION['nombre'];
            //Consultamos datos del administrador para obtenerlos en una tabla.
            $row=$admin->getAdmin();
            //Enviamos el tiempo y si pasan ciertos minutos lo redireccionamos
           
    }else{
        header('Location: ../index.php');
        die();
    }
?>


<?php
 $selector=($_POST['repIncendio']);
// $algo=($_POST['algo']);
// echo $selector;
?>

<!DOCTYPE html>
<html>
<head>
        <title>Generar Reporte</title>
        <meta charset="utf-8">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
</head>
    <body>
    <?php
                     include("../../database/con_db.php"); 
                     
                     $sql = "SELECT nombreArea FROM area where id=$selector ";
                     $resultado = $conex->query($sql);
                     if($resultado->num_rows> 0){
                         while($row = $resultado->fetch_assoc()){
                        
                        $area=$row['nombreArea'];
                        }
                        }
                        $conex->close();
                    ?>
        <div class="container mt-5">
        <h2 align="center"> Reportes </h2>
        <h2 align="center"> Simulacro por Incendio en <?php echo $area ?></h2>
        
        </div>
       
        <div class="container">
            <div class="row justify-content-center"> 
            <form action="convertirIncendio.php" method ="post">
       
                <!--Datos Generales -->
                <table class="table table-hover" class="row table-responsive">
                            <thead>
                                <tr><td><input type="text" size=60 style="width:1100px"  REQUIRED class="form-control" name="nombreInmueble" id="nombreInmueble" placeholder="Nombre de Inmueble"></td></tr> 
                            </thead>
               </table>
               <table class="table table-hover" class="row table-responsive">
                            <thead>
                            <tr><td> <input type="text" size=60 style="width:500px" REQUIRED class="form-control" name="domicilio" id="domicilio" placeholder="Domicilio"> </td>
                                 <td> <input type="text" size=60 style="width:500px" REQUIRED class="form-control" name="col" id="col" placeholder="Colonia"></td></tr>
                            <tr> <td><input type="text" size=60 style="width:500px" REQUIRED class="form-control" name="delegacion" id="delegacion" placeholder="Delegación"></td>
                                 <td><input type="text" size=60 style="width:500px" REQUIRED class="form-control" name="cp" id="cp" placeholder="C.P."></td></tr> 
                           <tr><td> <input type="text" size=60 style="width:500px" REQUIRED class="form-control" name="responsable" id="responsable" placeholder="Responsable del Inmueble"></td>
                                <td><input type="text" size=60 style="width:500px" REQUIRED class="form-control" name="coordinador" id="coordinador" placeholder="Suplente o Coordinador Operativo de la UIPC"></td></tr>
                            <tr><td><input type="email" size=60 style="width:500px" REQUIRED class="form-control" name="email" id="email" placeholder="Correo Electrónico"></td>
                                <td> <input type="text" size=60 style="width:500px" REQUIRED class="form-control" name="telefono" id="telefono" placeholder="Teléfono"></td></tr>
                           <tr><td> <input type="text" size=60 style="width:500px" REQUIRED class="form-control" name="ext" id="ext" placeholder="Ext"></td>
                                <td><input type="text" size=60 style="width:500px" REQUIRED class="form-control" name="fax" id="fax" placeholder="Fax"></td></tr>
                            </thead>
               </table>
               <table class="table table-hover" class="row table-responsive">
                            <thead>
                            <tr> <th ><Label>Uso del inmueble : </Label>
                                      <th> <label><input type="radio" name="uso"  value="Educativo" checked> Educativo</label> </th>
                                      <th><label><input type="radio" name="uso"  value="Administrativo" checked> Administrativo</label> </th>
                                      <th><label><input type="radio" name="uso"  value="Otro" checked> Otro</label> </th>
                                      </tr>
                            </thead>
               </table>
               <br>

<!--Población Total turno Matutino -->
<table class="table table-hover" class="row table-responsive">
        <thead>
            <tr><th ALIGN="center">Población Total de Turno Matutino</th></tr> 
        </thead>
        
<table class="table table-hover" class="row table-responsive">
        <thead>
             <tr><th>Docentes</th>
                 <th >PAAE</th>
                 <th >Estudiantes</th>
                 <th >Visitantes</th>
                 <th >Total de participantes en simulacro</th>
             <tr> 
             
             <tr>  
             
             <?php
              include("../../database/con_db.php");  
               $sql = "SELECT count(*) numcodqr,estado FROM registro where numcodqr like 'pro-%' and estado='1' and id_administrador=$selector ";
               $resultado = $conex->query($sql);

               if($resultado->num_rows> 0){
                   while($row = $resultado->fetch_assoc()){ ?>
                    <td> <input type="submit" size=60 style="width:160px" REQUIRED class="form-control" name="numcodqr" id="fax" value="<?php echo $row['numcodqr']; ?> " type="text"> </td>
                    <?php
                      }
                    }
                          $conex->close();
               ?>
              <?php

          include("../../database/con_db.php");  
          $sql = "SELECT count(*) numcodqr,estado FROM registro where numcodqr like 'pae-%' and estado='1' and id_administrador=$selector ";
               $resultado = $conex->query($sql);

               if($resultado->num_rows> 0){
                   while($row = $resultado->fetch_assoc()){ ?>
                    <td> <input type="submit" size=60 style="width:160px" REQUIRED class="form-control" name="numcodqr" id="fax" value="<?php echo $row['numcodqr']; ?> " type="text"> </td>
                    
             <?php
               }
            }

                  $conex->close();
       ?>

            <?php

            include("../../database/con_db.php");  
            $sql = "SELECT count(*) numcodqr,estado FROM registro where numcodqr like 'alu-%' and estado='1' and id_administrador=$selector ";
                $resultado = $conex->query($sql);

                if($resultado->num_rows> 0){
                    while($row = $resultado->fetch_assoc()){ ?>
                    <td> <input type="submit" size=60 style="width:160px" REQUIRED class="form-control" name="numcodqr" id="fax" value="<?php echo $row['numcodqr']; ?> " type="text"> </td>
                    
            <?php
                }
            }

                    $conex->close();
            ?>

            <?php

            include("../../database/con_db.php");  
            $sql = "SELECT count(*) numcodqr,estado FROM registro where numcodqr like 'vis-%' and estado='1'and id_administrador=$selector ";
                $resultado = $conex->query($sql);

                if($resultado->num_rows> 0){
                    while($row = $resultado->fetch_assoc()){ ?>
                    <td> <input type="submit" size=60 style="width:160px" REQUIRED class="form-control" name="numcodqr" id="fax" value="<?php echo $row['numcodqr']; ?> " type="text"> </td>
                    
            <?php
                }
            }

                    $conex->close();
            ?>

            <?php

            include("../../database/con_db.php");  
            $sql = "SELECT count(*) estado FROM registro where  estado='1'  and id_administrador=$selector";
                $resultado = $conex->query($sql);

                if($resultado->num_rows> 0){
                    while($row = $resultado->fetch_assoc()){ ?>
                    <td> <input type="submit" size=60 style="width:160px" REQUIRED class="form-control" name="estado" id="fax" value="<?php echo $row['estado']; ?> " type="text"> </td>
                    
            <?php
                }
            }

                    $conex->close();
            ?>
        
                  </thead>        
</table>

  <!--Población Total turno Vespertino -->
  <table class="table table-hover" class="row table-responsive">
        <thead>
            <tr><th ALIGN="center">Población Total de Turno Vespertino</th></tr> 
        </thead>
<table class="table table-hover" class="row table-responsive">
        <thead>
             <tr><th>Docentes</th>
                 <th >PAAE</th>
                 <th >Estudiantes</th>
                 <th >Visitantes</th>
                 <th >Total de participantes en simulacro</th>
             <tr> 
             <?php
              include("../../database/con_db.php");  
               $sql = "SELECT count(*) numcodqr,estado FROM registro where numcodqr like 'pro-%' and estado='1' and id_administrador=$selector ";
               $resultado = $conex->query($sql);

               if($resultado->num_rows> 0){
                   while($row = $resultado->fetch_assoc()){ ?>
                    <td> <input type="submit" size=60 style="width:160px" REQUIRED class="form-control" name="numcodqr" id="fax" value="<?php echo $row['numcodqr']; ?> " type="text"> </td>
                    <?php
                      }
                    }
                          $conex->close();
               ?>
              <?php

          include("../../database/con_db.php");  
          $sql = "SELECT count(*) numcodqr,estado FROM registro where numcodqr like 'pae-%' and estado='1' and id_administrador=$selector ";
               $resultado = $conex->query($sql);

               if($resultado->num_rows> 0){
                   while($row = $resultado->fetch_assoc()){ ?>
                    <td> <input type="submit" size=60 style="width:160px" REQUIRED class="form-control" name="numcodqr" id="fax" value="<?php echo $row['numcodqr']; ?> " type="text"> </td>
                    
             <?php
               }
            }

                  $conex->close();
       ?>

            <?php

            include("../../database/con_db.php");  
            $sql = "SELECT count(*) numcodqr,estado FROM registro where numcodqr like 'alu-%' and estado='1' and id_administrador=$selector ";
                $resultado = $conex->query($sql);

                if($resultado->num_rows> 0){
                    while($row = $resultado->fetch_assoc()){ ?>
                    <td> <input type="submit" size=60 style="width:160px" REQUIRED class="form-control" name="numcodqr" id="fax" value="<?php echo $row['numcodqr']; ?> " type="text"> </td>
                    
            <?php
                }
            }

                    $conex->close();
            ?>

            <?php

            include("../../database/con_db.php");  
            $sql = "SELECT count(*) numcodqr,estado FROM registro where numcodqr like 'vis-%' and estado='1' and id_administrador=$selector ";
                $resultado = $conex->query($sql);

                if($resultado->num_rows> 0){
                    while($row = $resultado->fetch_assoc()){ ?>
                    <td> <input type="submit" size=60 style="width:160px" REQUIRED class="form-control" name="numcodqr" id="fax" value="<?php echo $row['numcodqr']; ?> " type="text"> </td>
                    
            <?php
                }
            }

                    $conex->close();
            ?>

            <?php

            include("../../database/con_db.php");  
            $sql = "SELECT count(*) estado FROM registro where estado='1' and id_administrador=$selector";
                $resultado = $conex->query($sql);

                if($resultado->num_rows> 0){
                    while($row = $resultado->fetch_assoc()){ ?>
                    <td> <input type="submit" size=60 style="width:160px" REQUIRED class="form-control" name="estado" id="fax" value="<?php echo $row['estado']; ?> " type="text"> </td>
                    
            <?php
                }
            }

                    $conex->close();
            ?>
        
        
                  </thead>        
</table>

    <!--Datos Simulacro -->
<table class="table table-hover" class="row table-responsive">
        <thead>
             <tr><th>Fecha del simulacro</th>
                 <th >Hora de Inicio</th>
                 <th >Hora en que finaliza</th>
                 <th >Duración de la evacuación</th>
             <tr> 
             <tr> <td> <input type="date" size=60 style="width:240px" REQUIRED class="form-control" name="fecha" id="fecha" ></td>
                  <td> <input type="time" size=60 style="width:240px" REQUIRED class="form-control" name="inicio" id="fecha" ></td>
                  <td> <input type="time" size=60 style="width:240px" REQUIRED class="form-control" name="fin" id="fecha" ></td>
                  <td> <input type="time" size=60 style="width:310px" REQUIRED class="form-control" name="duracion" id="fecha" ></td>
             </tr>   </thead>  </table>
             <table class="table table-hover" class="row table-responsive">
              <thead>
              <tr> <th ><Label>El simulacro : </Label>
                  <th> <label><input type="radio" name="aviso" value="Se realizó con aviso"checked> Se realizó con aviso</label> </th>
                  <th><label><input type="radio" name="aviso" value="Se realizó sin aviso"checked> Se realizó sin Aviso</label> </th>
                  </tr>
        </thead>        
</table>
<table class="table table-hover" class="row table-responsive">
              <thead>
            <tr> <th><Label>¿Qué tipo de alertamiento utilizo? </Label></th>
            <th><input type="text" size=60 style="width:800px" REQUIRED class="form-control" name="alertamiento" id="alertamiento" ></th>
                 
            </tr>
        </thead>        
</table>
<table class="table table-hover" class="row table-responsive">
              <thead>
              <tr> <th ><Label>El desalojo fue : </Label>
                  <th> <label><input type="radio" name="desalojo" value="Total" checked> Total</label> </th>
                  <th><label><input type="radio" name="desalojo" value= "Parcial" checked> Pacial</label> </th>
                  </tr>
        </thead>        
</table>
<table class="table table-hover" class="row table-responsive">
              <thead>
            <tr> <th><Label>¿Porqué? </Label></th>
            <th><input type="text" size=60 style="width:1000px" REQUIRED class="form-control" name="porque" id="porque" ></th>
                 
            </tr>
        </thead>        
</table>


                    
                     <!--Medidas de Seguridad -->
                     <table class="table table-hover" class="row table-responsive">
                            <thead>
                                <tr><th ALIGN="center">Medidas de Seguridad</th></tr>
                            </thead>
                     </table>
                     <table class="table table-hover" class="row table-responsive">
                            <thead>
                              <tr> <th ><Label>¿Se tienen rutas de evacuación señalizadas?</Label>
                                      <th> <label><input type="radio" name="rutas" value="Si" checked> Si</label> </th>
                                      <th><label><input type="radio" name="rutas" value="No"checked> No</label> </th>
                                </tr>
                                <tr> <th ><Label>¿Las salidas de emergencia están libres de obstáculos?</Label>
                                      <th> <label><input type="radio" name="salidas" value="Si" checked> Si</label> </th>
                                      <th><label><input type="radio" name="salidas"value="No" checked> No</label> </th>
                                </tr>
                                <tr> <th ><Label>¿Se mantienen identificadas las áreas de riesgo?</Label>
                                      <th> <label><input type="radio" name="identificacion" value="Si" checked> Si</label> </th>
                                      <th><label><input type="radio" name="identificacion" value="No"checked> No</label> </th>
                                </tr>
                                <tr> <th ><Label>¿Tienen señalización los extintores?</Label>
                                      <th> <label><input type="radio" name="señalizacion" value="Si" checked> Si</label> </th>
                                      <th><label><input type="radio" name="señalizacion" value="No"checked> No</label> </th>
                                </tr>
                                <tr> <th ><Label>¿Los extintores se encuentran en puntos estrategicos?</Label>
                                      <th> <label><input type="radio" name="extintores" value="Si" checked> Si</label> </th>
                                      <th><label><input type="radio" name="extintores" value="No"checked> No</label> </th>
                                </tr>
                                <tr> <th ><Label>¿Cuenta con bitácoras de revisión de extintores?</Label>
                                      <th> <label><input type="radio" name="bitacorasextintores" value="Si" checked> Si</label> </th>
                                      <th><label><input type="radio" name="bitacorasextintores" value="No"checked> No</label> </th>
                                </tr>
                                <tr> <th ><Label>¿Cuenta con bitácoras de instalaciones electricas?</Label>
                                      <th> <label><input type="radio" name="bitinstalaciones" value="Si" checked> Si</label> </th>
                                      <th><label><input type="radio" name="bitinstalaciones" value="No"checked> No</label> </th>
                                </tr>
                            </thead>
                     </table>
                       <!--Hipotesis de Simulacro -->
                       <table class="table table-hover" class="row table-responsive">
                            <thead>
                                <tr><th ALIGN="center">Hipótesis del Simulacro</th></tr>
                                <th><input type="text" size=60 style="width:1100px" REQUIRED class="form-control" name="hipotesis" id="hipotesis" ></th>
                             </thead>
                            </table>
                            <table class="table table-hover" class="row table-responsive">
                            <thead>
                            <tr> <th ><Label>¿El origen del incendio fue de tipo: </Label>
                                      <th> <label><input type="radio" name="tipoincendio" value="A" checked> A</label> </th>
                                      <th><label><input type="radio" name="tipoincendio" value="B"checked> B</label> </th>
                                      <th><label><input type="radio" name="tipoincendio" value="C"checked> C</label> </th>
                                      <th><label><input type="radio" name="tipoincendio" value="D"checked> D</label> </th>
                                      </tr>
                            </thead>
               </table>
               <table class="table table-hover" class="row table-responsive">
                            <thead>
                                <tr><th ALIGN="center">¿El incendio se complicó con otro agente perturbador?</th></tr>
                                <th><input type="text" size=60 style="width:1100px" REQUIRED class="form-control" name="agenteper" id="agenteper"  ></th>
                             </thead>
                 </table>

                  <!--evaluacion del simulacro-->
                  <table class="table table-hover" class="row table-responsive">
                            <thead>
                                 <tr><th>Evaluación del simulacro</th><tr> 
                                    </thead>  </table>
                                 <table class="table table-hover" class="row table-responsive">
                                  <thead>
                                 <tr> <th ><Label>¿Las brigadas respondieron oportunamente a la emergencia? </Label>
                                      <th> <label><input type="radio" name="brigadas" value="Si" checked> Si</label> </th>
                                      <th><label><input type="radio" name="brigadas" value="No"checked> No</label> </th>
                                      </tr>
                                      <tr> <th ><Label>¿Se activaron los servicios de emergencias externos? </Label>
                                      <th> <label><input type="radio" name="servicios" value="Si" checked> Si</label> </th>
                                      <th><label><input type="radio" name="servicios" value="No"checked> No</label> </th>
                                      </tr>
                                      <tr> <th ><Label>¿Se solicitó oportunamente el apoyo externo de algún grupo especializado? </Label>
                                      <th> <label><input type="radio" name="apoyo" value="Si" checked> Si</label> </th>
                                      <th><label><input type="radio" name="apoyo" value="No"checked> No</label> </th>
                                      </tr>
                                      <tr><th><input type="text" size=60 style="width:1000px"  class="form-control" name="cual" id="cual" ></th></tr>
                                      <tr> <th ><Label>¿Se instaló el puesto de mando? </Label>
                                      <th> <label><input type="radio" name="mando" value="Si" checked> Si</label> </th>
                                      <th><label><input type="radio" name="mando" value="No" checked> No</label> </th>
                                      <tr> <th ><Label> ¿Quién proporcionó la información al grupo de apoyo externo? </Label>
                                      <tr><th><input type="text" size=60 style="width:1000px" REQUIRED class="form-control" name="informacion" id="informacion"  ></th></tr>
                                      <tr> <th ><Label> ¿Cuánto tiempo se utilizó para que las actividades del inmueble volvieran a la normalidad? </Label>
                                      <tr><th><input type="text" size=60 style="width:1000px" REQUIRED class="form-control" name="actividades" id="actividades" ></th></tr>
                                    </thead>        
                    </table>

                     <!--Observaciones-->
                     <table class="table table-hover" class="row table-responsive">
                            <thead>
                                 <tr><th>Observaciones</th><tr> 
                                 <tr><th><input type="text" size=60 style="width:1000px" REQUIRED class="form-control" name="observaciones" id="observaciones" placeholder="Observaciones"></th></tr>
                                    </thead>  </table>
                                    <table class="table table-hover" class="row table-responsive">
        <thead>
             
             <tr><th><input type="reset" class=" btn btn-primary btn-lg" value="Borrar campos"></th>
             <th><input type="submit" class=" btn btn-primary btn-lg" value="Generar PDF"></th>
             </tr>
                </thead>  </table>

                            </div>
            </form>
        </div>
    </div>
   
</body>
</html>