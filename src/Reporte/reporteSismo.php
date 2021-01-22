

<!DOCTYPE html>
<html>
<head>
        <title>Generar Reporte</title>
        <meta charset="utf-8">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
</head>
    <body>
        <div class="container mt-5">
        <h2 align="center"> Reportes </h2>
        <h2 align="center"> Simulacro por Sismo </h2>
        
        </div>
       
        <div class="container">
            <div class="row justify-content-center"> 
            <form action="convertirSismo.php" method ="post">
       
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
                                      <th> <label><input type="radio" name="uso" value="Educativo"> Educativo</label> </th>
                                      <th><label><input type="radio" name="uso" value="Administrativo"> Administrativo</label> </th>
                                      <th><label><input type="radio" name="uso" value="Otro"> Otro</label> </th>
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
             
             <tr>    <?php
              include("../../database/con_db.php");  
               $sql = "SELECT count(*) numcodqr,salida FROM registro where numcodqr like 'pro-%' and salida='1' ";
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
          $sql = "SELECT count(*) numcodqr,salida FROM registro where numcodqr like 'pae-%' and salida='1' ";
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
            $sql = "SELECT count(*) numcodqr,salida FROM registro where numcodqr like 'alu-%' and salida='1' ";
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
            $sql = "SELECT count(*) numcodqr,salida FROM registro where numcodqr like 'vis-%' and salida='1' ";
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
            $sql = "SELECT count(*) salida FROM registro where  salida='1' ";
                $resultado = $conex->query($sql);

                if($resultado->num_rows> 0){
                    while($row = $resultado->fetch_assoc()){ ?>
                    <td> <input type="submit" size=60 style="width:160px" REQUIRED class="form-control" name="salida" id="fax" value="<?php echo $row['salida']; ?> " type="text"> </td>
                    
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
               $sql = "SELECT count(*) numcodqr,salida FROM registro where numcodqr like 'pro-%' and salida='1' ";
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
          $sql = "SELECT count(*) numcodqr,salida FROM registro where numcodqr like 'pae-%' and salida='1' ";
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
            $sql = "SELECT count(*) numcodqr,salida FROM registro where numcodqr like 'alu-%' and salida='1' ";
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
            $sql = "SELECT count(*) numcodqr,salida FROM registro where numcodqr like 'vis-%' and salida='1' ";
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
            $sql = "SELECT count(*) salida FROM registro where  salida='1' ";
                $resultado = $conex->query($sql);

                if($resultado->num_rows> 0){
                    while($row = $resultado->fetch_assoc()){ ?>
                    <td> <input type="submit" size=60 style="width:160px" REQUIRED class="form-control" name="salida" id="fax" value="<?php echo $row['salida']; ?> " type="text"> </td>
                    
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
                  <th> <label><input type="radio" name="aviso" value="Se realizo con aviso"checked> Se realizo con aviso</label> </th>
                  <th><label><input type="radio" name="aviso" value="Se realizo sin aviso"checked> Se realizo sin Aviso</label> </th>
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
                              <tr> <th ><Label>¿Se tienen rutas de evacuación señalizadas?</Label></th>
                                      <th> <label><input type="radio" name="rutas" value="Si" checked>Si</label> </th>
                                      <th><label><input type="radio" name="rutas" value="No"checked>No</label> </th>
                                </tr>
                                <tr> <th ><Label>¿Las rutas de emergencia están libres de obstáculos?</Label></th>
                                      <th> <label><input type="radio" name="salidas" value="Si" checked>Si</label> </th>
                                      <th><label><input type="radio" name="salidas"value="No" checked>No</label> </th>
                                </tr>
                                <tr> <th ><Label>¿Cuenta con salidas de emergencia señalizadas?</Label></th>
                                      <th> <label><input type="radio" name="salemergencia" value="Si" checked>Si</label> </th>
                                      <th><label><input type="radio" name="salemergencia" value="No"checked>No</label> </th>
                                </tr>
                                <tr> <th ><Label>¿Las salidas de emergencia pueden ser utilizadas?</Label></th>
                                      <th> <label><input type="radio" name="utilizadas" value="Si" checked>Si</label> </th>
                                      <th><label><input type="radio" name="utilizadas" value="No"checked>No</label> </th>
                                </tr>
                                <tr> <th ><Label>¿Las zonas de seguridad son de fácil acceso y están señalizadas?</Label></th>
                                      <th> <label><input type="radio" name="zonas" value="Si" checked>Si</label> </th>
                                      <th><label><input type="radio" name="zonas" value="No"checked>No</label> </th>
                                </tr>
                                <tr> <th ><Label>Otra</Label></th>
                                <th><input type="text" size=60 style="width:500px" REQUIRED class="form-control" name="otra" id="otra" ></th>
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
                                      <tr><th><input type="text" size=60 style="width:1000px"  class="form-control" name="cual" id="cual" placeholder="cual"></th></tr>
                                      <tr> <th ><Label>¿Se instaló el puesto de mando? </Label>
                                      <th> <label><input type="radio" name="mando" value="Si" checked> Si</label> </th>
                                      <th><label><input type="radio" name="mando" value="No" checked> No</label> </th>
                                      <tr> <th ><Label> ¿Quién proporcionó la información al grupo de apoyo externo? </Label>
                                      <tr><th><input type="text" size=60 style="width:1000px" REQUIRED class="form-control" name="informacion" id="informacion" ></th></tr>
                                      <tr> <th ><Label> ¿Cuánto tiempo se utilizó para que las actividades del inmueble volvieran a la normalidad? </Label>
                                      <tr><th><input type="text" size=60 style="width:1000px" REQUIRED class="form-control" name="actividades" id="actividades" ></th></tr>
                                    </thead>        
                    </table>

                    <!--Observaciones-->
                    <table class="table table-hover" class="row table-responsive">
                            <thead>
                                 <tr><th>Observaciones</th><tr> 
                                 <tr><th><input type="text" size=60 style="width:1000px" REQUIRED class="form-control" name="observaciones" id="observaciones" ></th></tr>
                                    </thead>  </table>
                                    <table class="table table-hover" class="row table-responsive">
        <thead>
             
             <tr><th><input type="reset" class=" btn btn-primary btn-lg" value="Borrar campos"></th>
             <th><input type="submit" class=" btn btn-primary btn-lg" value="Generar PDF"></th>
             </tr>
                </thead>  </table>