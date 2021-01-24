<?php
require('fpdf.php');

//Creación del objeto de la clase heredada


class PDF extends FPDF
{
// Cabecera de página
function Header()
{
  
    // Logo
    $this->Image('img/logo.jpg',15,10,15);
     // Logo PC
     $this->Image('img/pclogo.jpg',170,15,15);
     // Escudo  Inmueble
     $this->Image('img/escudoInm.png',170,33,15);
    // Arial bold 15
    $this->SetFont('Times','B',10);
    // Movernos a la derecha
    $this->Cell(150);
    // Título 
    $this->Cell(10,3,'Fecha: '.date('d-m-y'),0);
    $this->Ln();
    $this->Cell(60);
    // Título 
    $this->Cell(10,5,utf8_decode(' INSTITUTO POLITÉCNICO NACIONAL'));
    // Salto de línea
    $this->Ln(3);
    $this->Cell(75);
    $this->Cell(10,5,utf8_decode('SECRETARIA GENERAL '));
   
    // Salto de línea
    $this->Ln(3);
    $this->Cell(57);
    $this->Cell(10,5,utf8_decode(' DEPARTAMENTO DE PROTECCIÓN CIVIL'));
    // Salto de línea
    $this->Ln(10);
    $this->Cell(80);
    $this->Cell(10,5,utf8_decode('ANEXO 9.2'));
    // Salto de línea
    $this->Ln(10);
    $this->Cell(50);
    $this->Cell(10,5,utf8_decode(' CÉDULA DE EVALUACIÓN DE SIMULACROS '));
    // Salto de línea
    $this->Ln(3);
    $this->Cell(70);
    $this->Cell(10,5,utf8_decode('ARTEFACTO EXPLOSIVO '));
    // Salto de línea
    $this->Ln(10);
}

// Pie de página
function Footer()
{
    // Posición: a 1,5 cm del final
    $this->SetY(-15);
    // Arial italic 8
    $this->SetFont('Arial','I',8);
    // Número de página
    $this->Cell(0,10,'Page '.$this->PageNo().'/{nb}',0,0,'C');
}
function Datos1 ($header)
   {
    //Cabecera
    
    foreach($header as $col)
    $this->SetFont('Times','B',10);
    $this->Cell(190,7,$col,1);
    $this->SetFillColor(234, 237, 237 );
    $this->SetFont('Times','B',10);
    $this->Ln();
      $this->Cell(40,5,"Nombre del Inmueble",1);
      $this->SetFont('Times','',10);
      $this->Cell(150,5,$_POST['nombreInmueble'],1);
    $this->Ln();  
    $this->SetFont('Times','B',10);
      $this->Cell(40,5,"Domicilio",1);
      $this->SetFont('Times','',10);
      $this->Cell(50,5,$_POST['domicilio'],1);
      $this->SetFont('Times','B',10);
      $this->Cell(15,5,"Col",1);
      $this->SetFont('Times','',10);
      $this->Cell(85,5,$_POST['col'],1);
      $this->Ln();
      $this->SetFont('Times','B',10);
      $this->Cell(40,5,utf8_decode("Delegación "),1);
      $this->SetFont('Times','',10);
      $this->Cell(50,5,$_POST['delegacion'],1);
      $this->SetFont('Times','B',10);
      $this->Cell(15,5,"C.P",1);
      $this->SetFont('Times','',10);
      $this->Cell(85,5,$_POST['cp'],1);
      $this->Ln();
      $this->SetFont('Times','B',10);
      $this->Cell(40,5,"Responsable del inmueble",1);
      $this->SetFont('Times','',10);
      $this->Cell(150,5,utf8_decode($_POST['responsable']),1);
      $this->Ln();
      $this->SetFont('Times','B',10);
      $this->Cell(71,5,"Suplente o coordinador Operativo de la UIPC",1);
      $this->SetFont('Times','',10);
      $this->Cell(119,5,$_POST['coordinador'],1);
      $this->Ln();
      $this->SetFont('Times','B',10);
      $this->Cell(30,5,utf8_decode("Correo Electrónico"),1);
      $this->SetFont('Times','',10);
      $this->Cell(160,5,utf8_decode($_POST['email']),1);
      $this->Ln();
      $this->SetFont('Times','B',10);
      $this->Cell(15,5,utf8_decode("Teléfono"),1);
      $this->SetFont('Times','',10);
      $this->Cell(50,5,utf8_decode($_POST['telefono']),1);
      $this->SetFont('Times','B',10);
      $this->Cell(10,5,"Ext",1);
      $this->SetFont('Times','',10);
      $this->Cell(50,5,utf8_decode($_POST['ext']),1);
      $this->SetFont('Times','B',10);
      $this->Cell(10,5,"Fax",1);
      $this->SetFont('Times','',10);
      $this->Cell(55,5,utf8_decode($_POST['fax']),1);
      $this->Ln();
      $this->SetFont('Times','B',10);
      $this->Cell(30,5,utf8_decode("Uso de Inmueble:"),1);
      $this->SetFont('Times','',10);
      $this->Cell(160,5,utf8_decode($_POST['uso']),1);
      
      $this->Ln(10);
      $this->SetFont('Times','B',10);
      $this->Cell(190,5,utf8_decode("POBLACIÓN TOTAL DEL TURNO MATUTINO"),1);
      $this->Ln();
      $this->SetFont('Times','',10);
      $this->Cell(25,5,utf8_decode("Docentes"),1);
      $this->Cell(75,5,utf8_decode("Personal de Apoyo de Asistencia a la Educación"),1);
      $this->Cell(25,5,utf8_decode("Estudiantes"),1);
      $this->Cell(25,5,utf8_decode("Visitantes"),1);
      $this->Cell(40,5,utf8_decode("Total de Participantes"),1);
      $this->Ln();
      
    //  $conex = mysqli_connect("localhost","root","","SistemaControlAcceso");
    include("../../database/con_db.php");  
    $sql = "SELECT count(*) numcodqr,estado FROM registro where numcodqr like 'pro-%' and estado='1' ";
               $resultado = $conex->query($sql);
          while($row = $resultado->fetch_assoc()){

     $this->Cell(25,5,$row['numcodqr'],1);}
     $sql = "SELECT count(*) numcodqr,estado FROM registro where numcodqr like 'pae-%' and estado='1' ";
               $resultado = $conex->query($sql);
          while($row = $resultado->fetch_assoc()){
     $this->Cell(75,5,$row['numcodqr'],1);}
     $sql = "SELECT count(*) numcodqr,estado FROM registro where numcodqr like 'alu-%' and estado='1' ";
               $resultado = $conex->query($sql);
          while($row = $resultado->fetch_assoc()){
    $this->Cell(25,5,$row['numcodqr'],1);}
    $sql = "SELECT count(*) numcodqr,estado FROM registro where numcodqr like 'vis-%' and estado='1' ";
               $resultado = $conex->query($sql);
          while($row = $resultado->fetch_assoc()){
    $this->Cell(25,5,$row['numcodqr'],1);}
    $sql = "SELECT count(*) estado FROM registro where estado='1' ";
    $resultado = $conex->query($sql);
    while($row = $resultado->fetch_assoc()){
      $this->Cell(40,5,$row['estado'],1);}
          
      $this->Ln(10);
      $this->SetFont('Times','B',10,);
      $this->Cell(190,5,utf8_decode("POBLACIÓN TOTAL DEL TURNO VESPERTINO"),1);
      $this->Ln();
      $this->SetFont('Times','',10);
      $this->Cell(25,5,utf8_decode("Docentes"),1);
      $this->Cell(75,5,utf8_decode("Personal de Apoyo de Asistencia a la Educación"),1);
      $this->Cell(25,5,utf8_decode("Estudiantes"),1);
      $this->Cell(25,5,utf8_decode("Visitantes"),1);
      $this->Cell(40,5,utf8_decode("Total de Participantes"),1);
      $this->Ln();
      include("../../database/con_db.php");  
    $sql = "SELECT count(*) numcodqr,estado FROM registro where numcodqr like 'pro-%' and estado='1' ";
               $resultado = $conex->query($sql);
          while($row = $resultado->fetch_assoc()){

     $this->Cell(25,5,$row['numcodqr'],1);}
     $sql = "SELECT count(*) numcodqr,estado FROM registro where numcodqr like 'pae-%' and estado='1' ";
               $resultado = $conex->query($sql);
          while($row = $resultado->fetch_assoc()){
     $this->Cell(75,5,$row['numcodqr'],1);}
     $sql = "SELECT count(*) numcodqr,estado FROM registro where numcodqr like 'alu-%' and estado='1' ";
               $resultado = $conex->query($sql);
          while($row = $resultado->fetch_assoc()){
    $this->Cell(25,5,$row['numcodqr'],1);}
    $sql = "SELECT count(*) numcodqr,estado FROM registro where numcodqr like 'vis-%' and estado='1' ";
               $resultado = $conex->query($sql);
          while($row = $resultado->fetch_assoc()){
    $this->Cell(25,5,$row['numcodqr'],1);}
    $sql = "SELECT count(*) estado FROM registro where  estado='1' ";
    $resultado = $conex->query($sql);
    while($row = $resultado->fetch_assoc()){
      $this->Cell(40,5,$row['estado'],1);}

     //Datos simulacro
     $this->Ln(10);
     $this->SetFont('Times','B',10);
     $this->Cell(45,5,utf8_decode("FECHA DE SIMULACRO"),1);
     $this->Cell(35,5,utf8_decode("HORA DE INICIO"),1);
     $this->Cell(49,5,utf8_decode("HORA EN QUE FINALIZA"),1);
     $this->Cell(61,5,utf8_decode("DURACIÓN DE LA EVACUACIÓN"),1);
     $this->Ln();
     $this->SetFont('Times','',10);
    $this->Cell(45,5,utf8_decode($_POST['fecha']),1);
    $this->Cell(35,5,utf8_decode($_POST['inicio']),1);
    $this->Cell(49,5,utf8_decode($_POST['fin']),1);
    $this->Cell(61,5,utf8_decode($_POST['duracion']),1);
    $this->Ln();
    $this->SetFont('Times','B',10);
    $this->Cell(70,5,utf8_decode("El simulacro:"),1);
    $this->SetFont('Times','',10);
    $this->Cell(120,5,utf8_decode($_POST['aviso']),1);
    $this->Ln();
    $this->SetFont('Times','B',10);
    $this->Cell(70,5,utf8_decode("¿Qué tipo de alertamiento se utilizó?"),1);
    $this->SetFont('Times','',10);
    $this->Cell(120,5,utf8_decode($_POST['alertamiento']),1);
    $this->Ln();
    $this->SetFont('Times','B',10);
    $this->Cell(70,5,utf8_decode("El desalojo fue:"),1);
    $this->SetFont('Times','',10);
    $this->Cell(120,5,utf8_decode($_POST['desalojo']),1);
    $this->Ln();
    $this->SetFont('Times','B',10);
    $this->Cell(70,5,utf8_decode("¿Porqué?"),1);
    $this->SetFont('Times','',10);
    $this->Cell(120,5,utf8_decode($_POST['porque']),1);

        //Medidas de Seguridad
    $this->Ln(10);
    $this->SetFont('Times','B',10); 
    $this->Cell(190,5,utf8_decode("MEDIDAS DE SEGURIDAD"),1);
    $this->Ln();
    $this->SetFont('Times','B',10);
    $this->Cell(120,5,utf8_decode("¿Cuenta con escaleras de emergencia?"),1);
    $this->SetFont('Times','',10);
    $this->Cell(70,5,utf8_decode($_POST['escaleras']),1);
    $this->Ln();
    $this->SetFont('Times','B',10);
    $this->Cell(120,5,utf8_decode("¿Se tienen rutas de evacuación señalizadas?"),1);
    $this->SetFont('Times','',10);
    $this->Cell(70,5,utf8_decode($_POST['rutas']),1);
    $this->Ln();
    $this->SetFont('Times','B',10);
    $this->Cell(120,5,utf8_decode("¿El personal cuenta con identificación de acceso al inmueble?"),1);
    $this->SetFont('Times','',10);
    $this->Cell(70,5,utf8_decode($_POST['identificacion']),1);
    $this->Ln();
    $this->SetFont('Times','B',10);
    $this->Cell(120,5,utf8_decode("¿El plantel cuenta con bitácora de visitantes?"),1);
    $this->SetFont('Times','',10);
    $this->Cell(70,5,utf8_decode($_POST['bitacora']),1);
    $this->Ln();
    $this->SetFont('Times','B',10);
    $this->Cell(120,5,utf8_decode("¿Cuenta con bitácora de entrada y salida de vehículos?"),1);
    $this->SetFont('Times','',10);
    $this->Cell(70,5,utf8_decode($_POST['bitacoraVehiculo']),1);
    $this->Ln();
    $this->SetFont('Times','B',10);
    $this->Cell(120,5,utf8_decode("¿Se lleva un control de entrada y salida de objetos al interior del inmueble?"),1);
    $this->SetFont('Times','',10);
    $this->Cell(70,5,utf8_decode($_POST['control']),1);
    $this->Ln();
    $this->SetFont('Times','B',10);
    $this->Cell(30,5,utf8_decode("Otra"),1);
    $this->SetFont('Times','',10);
    $this->Cell(160,5,utf8_decode($_POST['otra']),1);


    //Hipotesis del simulacro
    $this->Ln(10);
    $this->SetFont('Times','B',10);
    $this->Cell(190,5,utf8_decode("HIPÓTESIS DEL SIMULACRO"),1);
    $this->Ln();
    $this->SetFont('Times','',10);
    $this->Cell(190,5,utf8_decode($_POST['hipotesis']),1);
    $this->Ln();
    $this->SetFont('Times','B',10);
    $this->Cell(120,5,utf8_decode("¿La amenaza por Artefacto explosivo fue?"),1);
    $this->SetFont('Times','',10);
    $this->Cell(70,5,utf8_decode($_POST['artefacto']),1);
    $this->Ln();
    $this->SetFont('Times','B',10);
    $this->Cell(120,5,utf8_decode("¿La ubicación del artefacto explosivo fue?"),1);
    $this->SetFont('Times','',10);
    $this->Cell(70,5,utf8_decode($_POST['ubicacion']),1);
    $this->Ln();
    $this->SetFont('Times','B',10);
    $this->Cell(120,5,utf8_decode("¿Descripción del sujeto que informo del artefacto explosivo?"),1);
    $this->SetFont('Times','',10);
    $this->Cell(70,5,utf8_decode($_POST['descripcion']),1);
    $this->Ln();
    $this->SetFont('Times','B',10);
    $this->Cell(120,5,utf8_decode("¿Se logro identificar algunos sonidos de fondo al momento de la emergenca?"),1);
    $this->SetFont('Times','',10);
    $this->Cell(70,5,utf8_decode($_POST['sonidos']),1);
    $this->Ln();
    $this->SetFont('Times','B',10);
    $this->Cell(120,5,utf8_decode("El lenguaje usado en la amenaza fue:"),1);
    $this->SetFont('Times','',10);
    $this->Cell(70,5,utf8_decode($_POST['lenguaje']),1);
    $this->Ln();
    $this->SetFont('Times','B',10);
    $this->Cell(120,5,utf8_decode("El simulacro: "),1);
    $this->SetFont('Times','',10);
    $this->Cell(70,5,utf8_decode($_POST['aaviso']),1);
    

    //Evaluación del simulacro
    $this->Ln(10);
    $this->SetFont('Times','B',10);
    $this->Cell(190,5,utf8_decode("EVALUACIÓN DEL SIMULACRO"),1);
    $this->Ln();
    $this->SetFont('Times','B',10);
    $this->Cell(140,5,utf8_decode("¿Las brigadas respondieron oportunamente ante la emergencia?"),1);
    $this->SetFont('Times','',10);
    $this->Cell(50,5,utf8_decode($_POST['brigadas']),1);
    $this->Ln();
    $this->SetFont('Times','B',10);
    $this->Cell(140,5,utf8_decode("¿Se activaron los servicios de emergencias externos?"),1);
    $this->SetFont('Times','',10);
    $this->Cell(50,5,utf8_decode($_POST['servicios']),1);
    $this->Ln();
    $this->SetFont('Times','B',10);
    $this->Cell(140,5,utf8_decode("¿Se solicitó oportunamente el apoyo externo de algún grupo especializado?"),1);
    $this->SetFont('Times','',10);
    $this->Cell(50,5,utf8_decode($_POST['apoyo']),1);
    $this->Ln();
    $this->SetFont('Times','B',10);
    $this->Cell(140,5,utf8_decode("¿Se instaló el puesto de mando?"),1);
    $this->SetFont('Times','',10);
    $this->Cell(50,5,utf8_decode($_POST['mando']),1);
    $this->Ln();
    $this->SetFont('Times','B',10);
    $this->Cell(140,5,utf8_decode("¿Quién proporcionó la información al grupo de apoyo externo?"),1);
    $this->SetFont('Times','',10);
    $this->Cell(50,5,utf8_decode($_POST['informacion']),1);
    $this->Ln();
    $this->SetFont('Times','B',10);
    $this->Cell(140,5,utf8_decode("¿Cuanto tiempo se utilizó para que las actividades del inmueble volvieran a la normalidad?"),1);
    $this->SetFont('Times','',10);
    $this->Cell(50,5,utf8_decode($_POST['tiempo']),1);

    //Observaciones
    $this->Ln(10);
    $this->SetFont('Times','B',10);
    $this->Cell(190,5,utf8_decode("OBSERVACIONES"),1);
    $this->Ln();
    $this->SetFont('Times','',10);
    $this->Cell(190,5,utf8_decode($_POST['observaciones']),1);

   }
   

}
$pdf=new PDF();
//Títulos de las columnas
$header=array(80,5,'DATOS DEL INMUEBLE');

$pdf->AliasNbPages();
//Primera página
$pdf->AddPage('portrait','A4');
$pdf->SetY(60);
$pdf->SetFont('Times','',10);
$pdf->SetDrawColor(242, 243, 244);
$pdf->SetTextColor(40,40,40);
//$pdf->AddPage();
$pdf->Datos1 ($header);

$pdf->Output();


?>