<?php
  require_once("./controllers/reportes_controller.php");
  require_once("./models/cls_proyecto.php");
  $model = new cls_proyecto();
  $datos = $model->consultaPdfWithFiltros($_POST);
  // rp_proyectos($datos);
  require './vendor/autoload.php';

  use PhpOffice\PhpSpreadsheet\Worksheet\Drawing;
  use PhpOffice\PhpSpreadsheet\Spreadsheet;
  use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
  use PhpOffice\PhpSpreadsheet\Style\Alignment;
  use PhpOffice\PhpSpreadsheet\Style\Border;
  
  function borders($sheet, $range){
    $sheet->getStyle($range)
    ->applyFromArray([
      'borders' => [
        'top' => [
          'borderStyle' => Border::BORDER_THIN,
          'color' => ['rgb' => '000000']
        ],      
        'left' => [
          'borderStyle' => Border::BORDER_THIN,
          'color' => ['rgb' => '000000']
        ],
        'bottom' => [
          'borderStyle' => Border::BORDER_THIN,
          'color' => ['rgb' => '000000']
        ],
        'right' => [
          'borderStyle' => Border::BORDER_THIN,
          'color' => ['rgb' => '000000']
        ]
      ]   
  ]);
  }

  $spreadsheet = new Spreadsheet();
  $drawing1 = new Drawing();
  $drawing2 = new Drawing();

  $spreadsheet->getProperties()->setCreator("UNEFA")->setTitle("Reportes proyectos");
  $sheet = $spreadsheet->getActiveSheet();
  $img1 = $drawing1->setPath('./views/img/logo_armas.png');
  $img1->setCoordinates('D2');
  $img1->setWidthAndHeight(200, 200);
  // Agregar el objeto Drawing a la hoja de cálculo
  $img1->setWorksheet($sheet);

  $img2 = $drawing2->setPath('./views/img/logo_unefa.png');
  $img2->setCoordinates('AD2');
  $img2->setWidthAndHeight(200, 200);
  // Agregar el objeto Drawing a la hoja de cálculo
  $img2->setWorksheet($sheet);

  $sheet->mergeCells("L2:S2")->setCellValue("L2","MINISTERIO DEL PODER POPULAR PARA LA DEFENSA");
  $sheet->mergeCells("K3:U3")->setCellValue("K3","MINISTERIO DEL PODER POPULAR PARA LA EDUCACION UNIVERSITARIA, CIENCIA Y TECNOLOGIA");
  $sheet->mergeCells("J4:V4")->setCellValue("J4","UNIVERSIDAD NACIONAL EXPERIMENTAL POLITECNICA DE LA FUERZA ARMADA NACIONAL VICERECTORADO ACADEMICO");
  $sheet->mergeCells("N5:Q5")->setCellValue("N5","COORDINACION DE ESTUDIOS AVANZADOS Y EXTENSION UNIVERSITARIA");
  $sheet->mergeCells("O6:P6")->setCellValue("O6","UNIDAD DE EXTENSION");

  $sheet->mergeCells("E10:G2")->setCellValue("E10","PORTUGUESA");
  $sheet->mergeCells("L10:M10")->setCellValue("L10","EXTENSIÓN");
  $sheet->getCell("N10")->getStyle()->getBorders()->getBottom()->setBorderStyle(Border::BORDER_THIN);
  $sheet->getCell("O10")->getStyle()->getBorders()->getBottom()->setBorderStyle(Border::BORDER_THIN);
  $sheet->setCellValue("P10","ACARIGUA");

  $sheet->mergeCells("B13:G13")->setCellValue("B13","Información del tutor");
  borders($sheet, "B13:G13");
  $sheet->mergeCells("H13:N13")->setCellValue("H13","Información de los estudiantes");
  borders($sheet, "H13:N13");
  $sheet->mergeCells("O13:W13")->setCellValue("O13","Información del proyecto");
  borders($sheet, "O13:W13");
  $sheet->mergeCells("X13:AF13")->setCellValue("X13","CANTIDAD DE ACTIVIDADES REALIZADAS EN EL MARCO DE LOS PROYECTOS");
  borders($sheet, "X13:AF13");
  // CONSIFURACION DE ANCHO DE LAS COLUMNAS
  $sheet->getRowDimension("14")->setRowHeight(30,"pt");
  $sheet->getColumnDimension('B')->setWidth(5);
  $sheet->getColumnDimension('C')->setWidth(20);
  $sheet->getColumnDimension('E')->setWidth(20);
  $sheet->getColumnDimension('F')->setWidth(19);
  $sheet->getColumnDimension('G')->setWidth(27);
  $sheet->getColumnDimension('H')->setWidth(5);
  $sheet->getColumnDimension('I')->setWidth(20);
  $sheet->getColumnDimension('K')->setWidth(20);
  $sheet->getColumnDimension('L')->setWidth(15);
  $sheet->getColumnDimension('M')->setWidth(15);
  $sheet->getColumnDimension('O')->setWidth(20);
  $sheet->getColumnDimension('P')->setWidth(35);
  $sheet->getColumnDimension('Q')->setWidth(30);
  $sheet->getColumnDimension('R')->setWidth(30);
  $sheet->getColumnDimension('T')->setWidth(15);
  $sheet->getColumnDimension('W')->setWidth(35);
  $sheet->getColumnDimension('AB')->setWidth(10);
  $sheet->getColumnDimension('AE')->setWidth(20);
  $sheet->getColumnDimension('AF')->setWidth(15);
  $celdas = ["B14","C14","D14","E14","F14","G14","H14","I14","J14","K14","L14","M14","N14","O14","P14","Q14","R14","S14","T14","U14","V14","W14","X14","Y14","Z14","AA14",
    "AB14","AC14","AD14","AE14","AF14"];
  foreach($celdas as $celda){
    borders($sheet, $celda);
  }
  // TUTOR
  $sheet->setCellValue("B14","N");
  $sheet->setCellValue("C14","Nombre y Apellido");
  $sheet->setCellValue("D14","CI");
  $sheet->setCellValue("E14","Tipo Personal");
  $sheet->setCellValue("F14","Indique la unidad a la que pertenece (Administrativo)");
  $sheet->setCellValue("G14","Indique categoria (Docente)");
  // ESTUDIANTES
  $sheet->setCellValue("H14","N");
  $sheet->setCellValue("I14","Nombre y Apellido");
  $sheet->setCellValue("J14","CI");
  $sheet->setCellValue("K14","Carrera");
  $sheet->setCellValue("L14","Semestre");
  $sheet->setCellValue("M14","Sección");
  $sheet->setCellValue("N14","Turno");
  // PROYECTO
  $sheet->setCellValue("O14","Nombre del proyecto");
  $sheet->setCellValue("P14","Nombre de la comunidad/Institución");
  $sheet->setCellValue("Q14","Dirección de la comunidad");
  $sheet->setCellValue("R14","Nombre del tutor-comunidad");
  $sheet->setCellValue("S14","CI");
  $sheet->setCellValue("T14","Telefono");
  $sheet->setCellValue("U14","C.B. (Cantidad de Beneficiados)");
  $sheet->setCellValue("V14","V.P. (Vinculación del proyecto con los planes, programas Y/O proyectos, establecidos por el ejecutivo nacional)");
  $sheet->setCellValue("W14","Indique Area de accion del proyecto");
  // OTROS DATOS
  $sheet->setCellValue("X14","Foros");
  $sheet->setCellValue("Y14","Charlas");
  $sheet->setCellValue("Z14","Jornadas");
  $sheet->setCellValue("AA14","Talleres");
  $sheet->setCellValue("AB14","Campañas");
  $sheet->setCellValue("AC14","Runión con Misiones");
  $sheet->setCellValue("AD14","Ferias");
  $sheet->setCellValue("AE14","Alianzas estrategias");
  $sheet->setCellValue("AF14","Observaciones");
  // DATOS
  $inicial_row1 = 15;
  for($i = 0; $i < sizeof($datos); $i++){
    $dp = $datos[$i]['pt'];
    $estudiantes = $datos[$i]['estu'];
    $num = $i + 1;
    $alto = (sizeof($estudiantes) > 1) ? $inicial_row1+(sizeof($estudiantes)-1) : $inicial_row1;
    
    if($dp['categoria_tutor'] == "TC") $categoria = "Tiempo Completo";
    if($dp['categoria_tutor'] == "DXCL") $categoria = "Tiempo Completo";
    if($dp['categoria_tutor'] == "MT") $categoria = "Tiempo Completo";
    if($dp['categoria_tutor'] == "TV") $categoria = "Tiempo Completo";

    $celdas2 = ["B$inicial_row1:B$alto","C$inicial_row1:C$alto","D$inicial_row1:D$alto","E$inicial_row1:E$alto","F$inicial_row1:F$alto","G$inicial_row1:G$alto"];
    foreach($celdas2 as $celda){
      borders($sheet, $celda);
    }
    // TUTOR
    $sheet->mergeCells("B$inicial_row1:B$alto")->setCellValue("B$inicial_row1",$num);
    $sheet->mergeCells("C$inicial_row1:C$alto")->setCellValue("C$inicial_row1",$dp['nombre_usuario']);
    $sheet->mergeCells("D$inicial_row1:D$alto")->setCellValue("D$inicial_row1",$dp['cedula_usuario']);
    $sheet->mergeCells("E$inicial_row1:E$alto")->setCellValue("E$inicial_row1",$dp['tipo_tutor']);
    $sheet->mergeCells("F$inicial_row1:F$alto")->setCellValue("F$inicial_row1","");
    $sheet->mergeCells("G$inicial_row1:G$alto")->setCellValue("G$inicial_row1",$categoria);
    $inicial_row2 = $inicial_row1;
    // ESTUDIANTES
    $num = 0;
    foreach($estudiantes as $estu){
      $num += 1;
      $celdas3 = ["H$inicial_row2","I$inicial_row2","J$inicial_row2","K$inicial_row2","L$inicial_row2","M$inicial_row2","N$inicial_row2"];
      foreach($celdas3 as $celda){
        borders($sheet, $celda);
      }
      $turno = ($estu['turno_estudiante'] == "D") ? "Diurno" : "Nocturno";
      $sheet->setCellValue("H$inicial_row2",$num);
      $sheet->setCellValue("I$inicial_row2",$estu['nombre_usuario']);
      $sheet->setCellValue("J$inicial_row2",$estu['cedula_usuario']);
      $sheet->setCellValue("K$inicial_row2",$estu['nombre_carrera']);
      $sheet->setCellValue("L$inicial_row2",$estu['des_semestre']);
      $sheet->setCellValue("M$inicial_row2",$estu['numero_seccion']);
      $sheet->setCellValue("N$inicial_row2",$turno);
      $inicial_row2 += 1;
    }

    $celdas4 = ["O$inicial_row1:O$alto","P$inicial_row1:P$alto","Q$inicial_row1:Q$alto","R$inicial_row1:R$alto","S$inicial_row1:S$alto","T$inicial_row1:T$alto",
      "U$inicial_row1:U$alto","V$inicial_row1:V$alto","W$inicial_row1:W$alto","X$inicial_row1:X$alto","Y$inicial_row1:Y$alto","Z$inicial_row1:Z$alto","AA$inicial_row1:AA$alto",
      "AB$inicial_row1:AB$alto","AC$inicial_row1:AC$alto","AD$inicial_row1:AD$alto","AE$inicial_row1:AE$alto","AF$inicial_row1:AF$alto"];
    foreach($celdas4 as $celda){
      borders($sheet, $celda);
    }
    $sheet->mergeCells("O$inicial_row1:O$alto")->setCellValue("O$inicial_row1",$dp['titulo_proyecto']);
    $sheet->mergeCells("P$inicial_row1:P$alto")->setCellValue("P$inicial_row1",$dp['nombre_comunidad']);
    $sheet->mergeCells("Q$inicial_row1:Q$alto")->setCellValue("Q$inicial_row1",$dp['direccion_comunidad']);
    $sheet->mergeCells("R$inicial_row1:R$alto")->setCellValue("R$inicial_row1",$dp['nombre_tutor_comunidad']);
    $sheet->mergeCells("S$inicial_row1:S$alto")->setCellValue("S$inicial_row1",$dp['cedula_tutor']);
    $sheet->mergeCells("T$inicial_row1:T$alto")->setCellValue("T$inicial_row1",$dp['telefono_tutor']);
    $sheet->mergeCells("U$inicial_row1:U$alto")->setCellValue("U$inicial_row1","");
    $sheet->mergeCells("V$inicial_row1:V$alto")->setCellValue("V$inicial_row1","");
    $sheet->mergeCells("W$inicial_row1:W$alto")->setCellValue("W$inicial_row1",$dp['tipo_proyecto']);
    $sheet->mergeCells("X$inicial_row1:X$alto")->setCellValue("X$inicial_row1","");
    $sheet->mergeCells("Y$inicial_row1:Y$alto")->setCellValue("Y$inicial_row1","");
    $sheet->mergeCells("Z$inicial_row1:Z$alto")->setCellValue("Z$inicial_row1","");
    $sheet->mergeCells("AA$inicial_row1:AA$alto")->setCellValue("AA$inicial_row1","");
    $sheet->mergeCells("AB$inicial_row1:AB$alto")->setCellValue("AB$inicial_row1","");
    $sheet->mergeCells("AC$inicial_row1:AC$alto")->setCellValue("AC$inicial_row1","");
    $sheet->mergeCells("AD$inicial_row1:AD$alto")->setCellValue("AD$inicial_row1","");
    $sheet->mergeCells("AE$inicial_row1:AE$alto")->setCellValue("AE$inicial_row1","");
    $sheet->mergeCells("AF$inicial_row1:AF$alto")->setCellValue("AF$inicial_row1","");
    
    $inicial_row1 += sizeof($estudiantes);
  }

  $dimensions = $sheet->calculateWorksheetDimension();
  $sheet->getStyle($dimensions)->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);
  $sheet->getStyle($dimensions)->getAlignment()->setVertical(Alignment::VERTICAL_CENTER);
  // Seleccionar el rango de celdas al que se le aplicarán los bordes
  $range = "B13:AF".($inicial_row1-1);
  borders($sheet, $range);

  // Aplicar los bordes a la parte superior de las celdas del rango seleccionado

  // $writer = new Xlsx($spreadsheet);
  // $writer->save('reporte.xlsx');

  header("Content-Type: application/vnd.ms-excel");
  header("Content-Disposition: attachment;filename=reporte.xlsx");
  header("Cache-Control: max-age-0");
  
  $writer = \PhpOffice\PhpSpreadsheet\IOFactory::createWriter($spreadsheet, "Xlsx");
  $writer->save("php://output");
  exit;
  ?>
  <script>
    window.matchMedia('download').addListener((evento) => {
      if (!evento.matches) window.close()
    });
    
  </script>