<?php
  require_once("./fpdf/fpdf.php");
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
  
  
  function rp_inscripcion($datos){
    $d_proyecto = $datos[0];
    $d_estudiantes = $datos[1];

    $pdf = new new_fpdf();
    $pdf->addPage();
    $pdf->setFont('Arial', 'B', 11);
    $pdf->cell(190, 5, "FORMATOS PARA LA EJECUCION DEL SERVICIO COMUNITARIO",0,1,"C",0);
    $pdf->ln(5);
    $pdf->setFont('Arial', 'B', 9);
    $pdf->cell(190, 5, "a.- Planilla S.C.1 Inscripcion",0,1,"L",0);
    $pdf->setFont('Arial', '', 8);
    $pdf->Image("./views/img/logo_armas.png",10,25,20,25);
    $pdf->cell(190, 5, "MINISTERIO DEL PODER POPULAR PARA LA DEFENSA",0,1,"C",0);
    $pdf->Image("./views/img/logo_unefa.png",180,25,20,25);
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
    $pdf->setFont('Arial', '', 8);
    $pdf->cell(5, 5, "N",1,0,"C");
    $pdf->cell(40, 5, "APELLIDOS Y NOMBRES",1,0,"C");
    $pdf->cell(16, 5, "CEDULA",1,0,"C");
    $pdf->cell(23, 5, "TELEFONO",1,0,"C");
    $pdf->cell(41, 5, "CORREO ELECTRONICO",1,0,"C");
    $pdf->cell(35, 5, "CARRERA",1,0,"C");
    $pdf->cell(11, 5, "TURNO",1,0,"C");
    $pdf->cell(19, 5, "SEMESTRE",1,1,"C");
    $pdf->setFont('Arial', '', 7);
    for($i = 0; $i < 7; $i++){
      $nombre = (isset($d_estudiantes[$i]['nombre_usuario']) ? utf8_decode($d_estudiantes[$i]['nombre_usuario']) : '');
      $cedula = (isset($d_estudiantes[$i]['cedula_usuario']) ? utf8_decode($d_estudiantes[$i]['cedula_usuario']) : '');
      $telefono = (isset($d_estudiantes[$i]['telefono_usuario']) ? utf8_decode($d_estudiantes[$i]['telefono_usuario']) : '');
      $correo = (isset($d_estudiantes[$i]['correo_usuario']) ? utf8_decode($d_estudiantes[$i]['correo_usuario']) : '');
      $carrera = (isset($d_estudiantes[$i]['nombre_carrera']) ? utf8_decode($d_estudiantes[$i]['nombre_carrera']) : '');
      $turno = (isset($d_estudiantes[$i]['turno_estudiante']) && isset($d_estudiantes[$i]['cedula_usuario']) ? utf8_decode($d_estudiantes[$i]['turno_estudiante']) : '');
      $semestre = (isset($d_estudiantes[$i]['des_semestre']) ? utf8_decode($d_estudiantes[$i]['des_semestre']) : '');

      if($turno == "D") $turno = "Diurno"; 
      if($turno == "N") $turno = "Nocturno";

      $pdf->cell(5, 10, ($i+1),1,0,"C");
      $pdf->cell(40, 10, utf8_decode($nombre),1,0,"C");
      $pdf->cell(16, 10, utf8_decode($cedula),1,0,"C");
      $pdf->cell(23, 10, utf8_decode($telefono),1,0,"C");
      $pdf->cell(41, 10, utf8_decode($correo),1,0,"C");
      $pdf->setFont('Arial', '', 5);
      $pdf->cell(35, 10, utf8_decode($carrera),1,0,"C");
      $pdf->setFont('Arial', '', 7);
      $pdf->cell(11, 10, $turno,1,0,"C");
      $pdf->cell(19, 10, $semestre,1,1,"C");
    }
    $pdf->ln(5);
    $pdf->setFont('Arial', '', 9);
    $pdf->cell(190, 5, "2. Datos de la comunidad / Institucion:",0,1,"C",0);
    $pdf->setFont('Arial', '', 8);
    $pdf->cell(73, 5, "NOMBRE DE LA COMUNIDAD",1,0,"C");
    $pdf->cell(46, 5, "DIRECCION",1,0,"C");
    $pdf->cell(25, 5, "RESPONSABLE",1,0,"C");
    $pdf->cell(14, 5, "CEDULA",1,0,"C");
    $pdf->cell(32, 5, "TELEFONO",1,1,"C");
    $pdf->setFont('Arial', '', 5);
    $pdf->cell(73, 15, utf8_decode($d_proyecto['nombre_comunidad']),1,0,"C");
    $pdf->cell(46, 15, utf8_decode($d_proyecto['direccion_comunidad']),1,0,"C");
    $pdf->setFont('Arial', '', 7);
    $pdf->cell(25, 15, utf8_decode($d_proyecto['nombre_tutor_comunidad']),1,0,"C");
    $pdf->cell(14, 15, utf8_decode($d_proyecto['cedula_tutor']),1,0,"C");
    $pdf->cell(32, 15, utf8_decode($d_proyecto['telefono_tutor']),1,1,"C");
  
    $pdf->ln(5);
    $pdf->setFont('Arial', '', 9);
    $pdf->cell(190, 5, "3. Datos del proyecto:",0,1,"L",0);
    $pdf->cell(190, 5, "3.1 Titulo del proyecto: ".utf8_decode($d_proyecto['titulo_proyecto']),0,1,"L",0);
    $pdf->ln(10);
  
    $pdf->addPage();
    $pdf->ln(50);
    $pdf->MultiCell(190, 5, "3.2 Planteamiento del proyecto: ".utf8_decode($d_proyecto['planteamiento_proyecto']).".");
    $pdf->ln(20);
    $pdf->MultiCell(190, 5, "3.3 Objetivo General del proyecto: ".utf8_decode($d_proyecto['objetivos_generales_proyecto']).".");
    $pdf->ln(20);
    $pdf->MultiCell(190, 5, "3.4 Objetivos Especificos del proyecto: ".utf8_decode($d_proyecto['objetivos_especificos_proyecto']).".");
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

    function CustomMultiCell($w, $h, $text)
    {
      $maxCharPerLine = 60; // Número máximo de caracteres por línea
      $lineHeight = 5; // Altura de línea

      $textLines = explode("\n", $text); // Dividir el texto en líneas
      foreach ($textLines as $line) {
        $words = explode(' ', $line); // Dividir la línea en palabras
        $currentLine = ''; // Cadena temporal para contener las palabras de la línea actual
        $currentHeight = 0; // Altura actual de la celda

        foreach ($words as $word) {
          if ($this->GetStringWidth($currentLine . ' ' . $word) <= $w) {
            $currentLine .= ' ' . $word;
          } else {
            // Límite de ancho alcanzado, generar una nueva línea
            $this->Cell($w, $h, trim($currentLine), 0, 1);
            $currentLine = $word;
            $currentHeight += $h;
          }
        }

        // Imprimir la última línea de la celda actual
        $this->Cell($w, $h, trim($currentLine), 0, 1);

        // Incrementar la altura actual con la altura de línea
        $currentHeight += $h;

        // Calcular el espacio restante en la celda actual
        $remainingSpace = $h - $currentHeight;

        // Añadir espacio vacío para igualar la altura de todas las celdas
        if ($remainingSpace > 0) {
          $this->Cell($w, $remainingSpace, '', 0, 1);
        }
      }
    }
   
    public function Footer()
    {
      $this->setFont('Arial', 'B', 3);
      $this->SetY(-15);
      $this->ln();
      $this->Multicell(330, 5, "C.B = CANTIDAD DE BENEFICIADOS, V.P = VINCULACION DEL PROYECTO CON LOS PLANES, PROGRAMAS Y/O PROYECTOS, ESTABLECIDOS POR EL EJECUTIVO NACIONAL, Indique A.A.P. = INDIQUE AREA DE ACCION DEL PROYECTO (AMBIENTAL, SOCIO PRODUCTIVO, TECNOLOGICO, SOCIAL, EDUCATIVO, SOCIO-COMUNITARIO, ENTRE OTROS) SOLO COLOCAR UN NOMBRE, R.M = REUNION CON MISIONES, Alianzas E. = ALIANZAS ESTRATEGICAS");
    }
  }
  
  function rp_proyectos($datos){  
        
    $fpdf2 = new new_fpdf2();
    $fpdf2->addPage();
    $fpdf2->setFont('Arial', 'B', 7);
    $fpdf2->Image("./views/img/logo_armas.png",10,6,20,25);
    $fpdf2->cell(330, 5, "MINISTERIO DEL PODER POPULAR PARA LA DEFENSA",0,0,"C");
    $fpdf2->Image("./views/img/logo_unefa.png",315,6,20,25);
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
    $fpdf2->cell(8, 6, "CI",1,0,"C");
    $fpdf2->cell(18, 6, "CARRERA",1,0,"C");
    $fpdf2->cell(9, 6, "SEMESTRE",1,0,"C");
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
    $fpdf2->cell(10, 6, "OBSERVACIONES",1,1,"C");
    
    
    for($i = 0; $i < sizeof($datos); $i++){
      $dp = $datos[$i]['pt'];
      $estudiantes = $datos[$i]['estu'];
      $height = 6 * sizeof($estudiantes);
            
      if($dp['categoria_tutor'] == "TC") $categoria = "Tiempo Completo";
      if($dp['categoria_tutor'] == "DXCL") $categoria = "Tiempo Completo";
      if($dp['categoria_tutor'] == "MT") $categoria = "Tiempo Completo";
      if($dp['categoria_tutor'] == "TV") $categoria = "Tiempo Completo";

      // INFORMACION DEL TUTOR (WIDTH: 70)
      $fpdf2->cell(3, $height, "N",1,0,"C");
      $fpdf2->cell(17, $height, utf8_decode($dp['nombre_usuario'])." $height",1,0,"C");
      $fpdf2->cell(12, $height, utf8_decode($dp['cedula_usuario']),1,0,"C");
      $fpdf2->cell(16, $height, utf8_decode($dp['tipo_tutor']),1,0,"C");
      $fpdf2->cell(16, $height, "",1,0,"C");
      $fpdf2->cell(16, $height, $categoria,1,0,"C");
      // INFORMACION DEL ESTUDIANTE (WIDTH: 80)
      foreach($estudiantes as $estu){
        $fpdf2->cell(3, 6, "N",1,0,"C");
        $fpdf2->cell(20, 6, utf8_decode($estu['nombre_usuario']),1,0,"C");
        $fpdf2->cell(8, 6, utf8_decode($estu['cedula_usuario']),1,0,"C");
        $fpdf2->cell(18, 6, utf8_decode($estu['nombre_carrera']),1,0,"C");
        $fpdf2->cell(9, 6, utf8_decode($estu['des_semestre']),1,0,"C");
        $fpdf2->cell(12, 6, utf8_decode($estu['numero_seccion']),1,0,"C");
        $fpdf2->cell(10, 6, ($estu['turno_estudiante'] == "D") ? "Diurno" : "Nocturno",1,0,"C");
        $x = $fpdf2->GetX(); // Obtener la posicion X actual
        $y = $fpdf2->GetY() + 6;
        $fpdf2->SetXY(90, $y);
      }     
      $x = $fpdf2->GetX() + 80; // Obtener la posicion X actual
      $y = $fpdf2->GetY() - $height;
      $fpdf2->SetXY($x, $y);

      // $alto = ceil($pdf->GetStringWidth($dp['titulo_proyecto']) / 14) * 5;
      // $pdf->MultiCell($ancho_maximo, $alto, $texto, 1, 'J');
      $fpdf2->Multicell(14, ($height*25/100), utf8_decode($dp['titulo_proyecto'])."$height",1,"C",false,0);
      $x = $fpdf2->GetX() + 174; // Obtener la posicion X actual
      $y = $fpdf2->GetY() - $height;
      $fpdf2->SetXY($x, $y);
      // $fpdf2->cell(10, 10, "CANTIDAD: $fpdf2->cantidad_cells",1,0,"C");
      $fpdf2->Multicell(20, ($height*33.5/100), utf8_decode($dp['nombre_comunidad'])."$height",1,"C",false,0);
      $x = $fpdf2->GetX() + 194; // Obtener la posicion X actual
      $y = $fpdf2->GetY() - $height;
      $fpdf2->SetXY($x, $y);
      // $fpdf2->cell(10, 10, "CANTIDAD: $fpdf2->cantidad_cells",1,0,"C");
      $fpdf2->Multicell(12, ($height*25/100), utf8_decode($dp['direccion_comunidad'])."$height",1,"C",false,0);
      $x = $fpdf2->GetX() + 206; // Obtener la posicion X actual
      $y = $fpdf2->GetY() / 1.30;
      $fpdf2->SetXY($x, $y);
      // $fpdf2->cell(10, 10, "CANTIDAD: $fpdf2->cantidad_cells",1,1,"C");
      $fpdf2->cell(12, $height, utf8_decode($dp['telefono_tutor']),1,0,"C");
      $fpdf2->cell(8, $height, utf8_decode($dp['cedula_tutor']),1,0,"C");
      $fpdf2->cell(6, $height, "TELEFONO",1,0,"C");
      $fpdf2->cell(10, $height, "",1,0,"C");
      $fpdf2->cell(15, $height, "",1,0,"C");
      $fpdf2->cell(13, $height, "",1,0,"C");
      $fpdf2->cell(5,$height, "",1,0,"C");
      $fpdf2->cell(6,$height, "",1,0,"C");
      $fpdf2->cell(7,$height, "",1,0,"C");
      $fpdf2->cell(7,$height, "",1,0,"C");
      $fpdf2->cell(7,$height, "",1,0,"C");
      $fpdf2->cell(5,$height, "",1,0,"C");
      $fpdf2->cell(6,$height, "",1,0,"C");
      $fpdf2->cell(7,$height, "",1,0,"C");
      $fpdf2->cell(10,$height, "",1,1,"C");
    }
    $fpdf2->Output();
  }

  function MultiCelda($pdf,$width,$height, $text){
    $max_height = $height;
    $current_y = $pdf->GetY();
    $cell_height = $height/2;
    // $course_text = 'Este es un texto muy largo que debe ser impreso en varias líneas';

    // Imprime la MultiCell con una altura de 10 unidades
    $pdf->MultiCell($width, $cell_height, utf8_decode($text),1,"C",false,0);
    $current_y += $cell_height;

    if ($current_y > $max_height) {
      $pdf->SetY($current_y - $cell_height); // Reinicia la posición Y a la anterior
    }
  }
  ?>