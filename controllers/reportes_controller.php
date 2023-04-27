<?php
  require_once("../models/fpdf/fpdf.php");
  class new_fpdf extends FPDF
  {
    private $nombre;
  
    public function SetNombre($name, $des = '')
    {
      $this->nombre = $name;
      $this->des = $des;
    }
    public function Footer()
    {
      $this->SetY(-35);
      $this->setFont('Arial', '', 9);
      $this->cell(190, 5, "Punto de CuentaN VAC-04 Punto de Cuenta al Consejo Universitario OrdinarionN 004-2017 de Fecha 12 de Julio del 2017",0,1,"C",0);
      $this->cell(190, 5, "Cargo: Vicerrector Academico",0,1,"C",0);
      $this->Multicell(190, 5, "ASUNTO: SOLICITUD DE APROBACION DE LA 'REFORMA DEL REGLAMENTO DE SERVICIO COMUNITARIO DEL ESTUDIANTE DE LA UNIVERSIDAD NACIONAL EXPERIMENTAL POLITECNICA DE LA FUERZA ARMADA NACIONAL BOLIVARIANA (UNEFA)'");
    }
  }
  
  
  function rp_inscripcion(){
    $pdf = new new_fpdf();
    $pdf->addPage();
    $pdf->setFont('Arial', 'B', 11);
    $pdf->cell(190, 5, "FORMATOS PARA LA EJECUCION DEL SERVICIO COMUNITARIO",0,1,"C",0);
    $pdf->ln(5);
    $pdf->setFont('Arial', 'B', 9);
    $pdf->cell(190, 5, "a.- Planilla S.C.1 Inscripcion",0,1,"L",0);
    $pdf->setFont('Arial', '', 8);
    $pdf->Image("../views/img/logo_armas.png",10,25,20,25);
    $pdf->cell(190, 5, "MINISTERIO DEL PODER POPULAR PARA LA DEFENSA",0,1,"C",0);
    $pdf->Image("../views/img/logo_unefa.png",180,25,20,25);
    $pdf->cell(190, 5, "MINISTERIO DEL PODER POPULAR PARA LA EDUCACION UNIVERSITARIA, CIENCIA Y TECNOLOGIA",0,1,"C",0);
    $pdf->cell(190, 5, "UNIVERSIDAD NACIONAL EXPERIMENTAL POLITECNICA DE LA FUERZA ARMADA NACIONAL",0,1,"C",0);
    $pdf->cell(190, 5, "VICERECTORADO ACADEMICO",0,1,"C",0);
    $pdf->cell(190, 5, "COORDINACION DE ESTUDIOS AVANZADOS Y EXTENSION UNIVERSITARIA",0,1,"C",0);
    $pdf->cell(190, 5, "UNIDAD DE EXTENSION",0,1,"C",0);
    $pdf->ln(8);
    $pdf->cell(95, 5, "NUMERO DE CONTROL: ______________________",0,0,"L");
    $pdf->cell(95, 5, "FECHA 00/00/0000",0,1,"R",0);
    $pdf->ln(10);
    $pdf->cell(95, 5, "NUCLEO:______________________",0,0,"L");
    $pdf->cell(95, 5, "EMISION:_______________________",0,1,"R",0);
    $pdf->ln(10);
    $pdf->setFont('Arial', 'B', 12);
    $pdf->cell(190, 5, "PLANILLA DE INSCRIPCION AL SERVICIO COMUNITARIO",0,1,"C",0);
    $pdf->setFont('Arial', '', 9);
    $pdf->cell(190, 5, "1. Datos de los preestadores del servicio comunitario:",0,1,"C",0);
    $pdf->ln(5);
    $pdf->cell(5, 5, "N",1,0,"C");
    $pdf->cell(50, 5, "APELLIDOS Y NOMBRES",1,0,"C");
    $pdf->cell(20, 5, "CEDULA",1,0,"C");
    $pdf->cell(20, 5, "TELEFONO",1,0,"C");
    $pdf->cell(40, 5, "CORREO ELECTRONICO",1,0,"C");
    $pdf->cell(20, 5, "CARRERA",1,0,"C");
    $pdf->cell(15, 5, "TURNO",1,0,"C");
    $pdf->cell(20, 5, "SEMESTRE",1,1,"C");
    for($i = 0; $i < 7; $i++){
      $pdf->cell(5, 10, "",1,0,"C");
      $pdf->cell(50, 10, "",1,0,"C");
      $pdf->cell(20, 10, "",1,0,"C");
      $pdf->cell(20, 10, "",1,0,"C");
      $pdf->cell(40, 10, "",1,0,"C");
      $pdf->cell(20, 10, "",1,0,"C");
      $pdf->cell(15, 10, "",1,0,"C");
      $pdf->cell(20, 10, "",1,1,"C");
    }
    $pdf->ln(5);
    $pdf->setFont('Arial', '', 9);
    $pdf->cell(190, 5, "2. Datos de la comunidad / Institucion:",0,1,"C",0);
    $pdf->cell(50, 5, "NOMBRE DE LA COMUNIDAD",1,0,"C");
    $pdf->cell(30, 5, "DIRECCION",1,0,"C");
    $pdf->cell(30, 5, "RESPONSABLE",1,0,"C");
    $pdf->cell(30, 5, "CEDULA",1,0,"C");
    $pdf->cell(50, 5, "TELEFONO DE CONTACTO",1,1,"C");
  
    $pdf->cell(50, 15, "",1,0,"C");
    $pdf->cell(30, 15, "",1,0,"C");
    $pdf->cell(30, 15, "",1,0,"C");
    $pdf->cell(30, 15, "",1,0,"C");
    $pdf->cell(50, 15, "",1,1,"C");
  
    $pdf->ln(5);
    $pdf->setFont('Arial', '', 9);
    $pdf->cell(190, 5, "3. Datos del proyecto:",0,1,"L",0);
    $pdf->cell(190, 5, "3.1 Titulo del proyecto: ___________________________________",0,1,"L",0);
    $pdf->ln(10);
  
    $pdf->addPage();
    $pdf->ln(60);
    $pdf->MultiCell(190, 5, "3.2 Planteamiento del proyecto: ___________________________________");
    $pdf->ln(20);
    $pdf->MultiCell(190, 5, "3.3 Objetivo General del proyecto: ___________________________________");
    $pdf->ln(20);
    $pdf->MultiCell(190, 5, "3.4 Objetivos Especificos del proyecto: ___________________________________");
    $pdf->ln(70);
    $pdf->cell(190, 5, "FIRMA",0,1,"C",0);
    $pdf->ln(10);
    $pdf->cell(190, 5, "__________________________________",0,1,"C",0);
    $pdf->cell(190, 5, "RESPONSABLE DEL EQUIPO DE TRABAJO DE EXTENSION",0,1,"C",0);
    $pdf->ln(20);
    $pdf->cell(190, 5, "Anexos:",0,1,"L",0);
    $pdf->cell(190, 5, "Carta aceptacion tutor de servicio comunitario. Formato S.C.1-A:____________",0,1,"L",0);
    $pdf->cell(190, 5, "Carta aceptacion responsable de la comunidad. Formato S.C.1-B:____________",0,1,"L",0);
    
    $pdf->Output();
  }
  
  class new_fpdf2 extends FPDF
  {
    // $this->DefOrientation = "L";
    public function __construct(){
      parent::__construct('L','mm','Legal');
    }
   
    public function Footer()
    {
      $this->setFont('Arial', 'B', 3);
      $this->SetY(-15);
      $this->ln();
      $this->Multicell(330, 5, "C.B = CANTIDAD DE BENEFICIADOS, V.P = VINCULACION DEL PROYECTO CON LOS PLANES, PROGRAMAS Y/O PROYECTOS, ESTABLECIDOS POR EL EJECUTIVO NACIONAL, Indique A.A.P. = INDIQUE AREA DE ACCION DEL PROYECTO (AMBIENTAL, SOCIO PRODUCTIVO, TECNOLOGICO, SOCIAL, EDUCATIVO, SOCIO-COMUNITARIO, ENTRE OTROS) SOLO COLOCAR UN NOMBRE, R.M = REUNION CON MISIONES, Alianzas E. = ALIANZAS ESTRATEGICAS");
    }
  }
  
  function rp_proyectos(){  
    $fpdf2 = new new_fpdf2();
    $fpdf2->addPage();
    $fpdf2->setFont('Arial', 'B', 7);
    $fpdf2->Image("../views/img/logo_armas.png",10,6,20,25);
    $fpdf2->cell(330, 5, "MINISTERIO DEL PODER POPULAR PARA LA DEFENSA",0,0,"C");
    $fpdf2->Image("../views/img/logo_unefa.png",315,6,20,25);
    $fpdf2->ln();
    $fpdf2->cell(330, 5, "MINISTERIO DEL PODER POPULAR PARA LA EDUCACION UNIVERSITARIA, CIENCIA Y TECNOLOGIA",0,1,"C",0);
    $fpdf2->cell(330, 5, "UNIVERSIDAD NACIONAL EXPERIMENTAL POLITECNICA DE LA FUERZA ARMADA NACIONAL",0,1,"C",0);
    $fpdf2->cell(330, 5, "VICERECTORADO ACADEMICO",0,1,"C",0);
    $fpdf2->cell(330, 5, "COORDINACION DE ESTUDIOS AVANZADOS Y EXTENSION UNIVERSITARIA",0,1,"C",0);
    $fpdf2->cell(330, 5, "UNIDAD DE EXTENSION",0,1,"C",0);
    $fpdf2->setFont('Arial', '', 5);
    $fpdf2->cell(150, 5, "Portuguesa",0,0,"C");
    $fpdf2->cell(150, 5, "EXTENSION: ___________________________ Acarigua",0,1,"C",0);
    $fpdf2->ln(3);
    $fpdf2->setFont('Arial', '', 4);
    $fpdf2->cell(80, 5, "Informacion del tutor",1,0,"C");
    $fpdf2->cell(80, 5, "Informacion de los estudiantes",1,0,"C");
    $fpdf2->cell(110, 5, "Informacion del proyecto",1,0,"C");
    $fpdf2->cell(60, 5, "CANTIDAD DE ACTIVIDADES REALIZADAS EN EL MARCO DE LOS PROYECTOS",1,1,"C");
    // INFORMACION DEL TUTOR (WIDTH: 70)
    $fpdf2->setFont('Arial', '', 3);
    $fpdf2->cell(3, 6, "N",1,0,"C");
    $fpdf2->cell(17, 6, "Nombre y Apellido",1,0,"C");
    $fpdf2->cell(12, 6, "CI",1,0,"C");
    $fpdf2->cell(16, 6, "TIPO PERSONAL",1,0,"C");
    $fpdf2->cell(16, 6, "U.P(ADMINISTRATIVO)",1,0,"C");
    $fpdf2->cell(16, 6, "CATEGORIA(DOCENTE)",1,0,"C");
    // INFORMACION DEL ESTUDIANTE (WIDTH: 80)
    $fpdf2->cell(3, 6, "N",1,0,"C");
    $fpdf2->cell(20, 6, "Nombre y Apellido",1,0,"C");
    $fpdf2->cell(12, 6, "CI",1,0,"C");
    $fpdf2->cell(12, 6, "CARRERA",1,0,"C");
    $fpdf2->cell(11, 6, "SEMESTRE",1,0,"C");
    $fpdf2->cell(12, 6, "SECCION",1,0,"C");
    $fpdf2->cell(10, 6, "TURNO",1,0,"C");
    // INFORMACION DEL PROYECTO (WIDTH(90))
    $fpdf2->cell(14, 6, "N. DEL PROYECTO",1,0,"C");
    $fpdf2->cell(20, 6, "N. DE LA COMUNIDAD/INSTITUCION",1,0,"C");
    $fpdf2->cell(12, 6, "D. DE LA COMUNIDAD",1,0,"C");
    $fpdf2->cell(12, 6, "N. DEL TUTOR C.",1,0,"C");
    $fpdf2->cell(8, 6, "CI",1,0,"C");
    $fpdf2->cell(6, 6, "TELEFONO",1,0,"C");
    $fpdf2->cell(10, 6, "C.B",1,0,"C");
    $fpdf2->cell(15, 6, "V.P.",1,0,"C");
    $fpdf2->cell(13, 6, "INDIQUE A.A.P.",1,0,"C");
    // CANTIDAD DE ACTIVIDADES REALIZADAS EN EL MARCO DE LOS PROYECTOS (WIDTH: 90)
    $fpdf2->cell(5, 6, "FOROS",1,0,"C");
    $fpdf2->cell(6, 6, "CHARLAS",1,0,"C");
    $fpdf2->cell(7, 6, "JORNADAS",1,0,"C");
    $fpdf2->cell(7, 6, "TALLERES",1,0,"C");
    $fpdf2->cell(7, 6, "CAMPANAS",1,0,"C");
    $fpdf2->cell(5, 6, "R.M",1,0,"C");
    $fpdf2->cell(6, 6, "FERIAS",1,0,"C");
    $fpdf2->cell(7, 6, "ALIANZAS E.",1,0,"C");
    $fpdf2->cell(10, 6, "OBSERVACIONES",1,0,"C");
  
    $fpdf2->Output();
  }
  
  rp_inscripcion();
  ?>