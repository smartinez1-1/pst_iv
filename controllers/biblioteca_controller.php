<?php

    require_once("../models/config.php");
	require_once("../models/cls_documentos.php");
	// AQUI YA ES DIFERENTE LA COSA, AQUI YA NO USAMOS CLASES, AQUI USAMOS OBJETOS, ARRIBA INCLUIMOS LOS MODELOS DE CARRERA Y EL ARCHIVO DE CONFIGURACION
	
	// ESTA PRIMERA VALIDACION ES PARA CUANDO ENVIAMOS DATOS POR METODO POST AL CONTROLADOR, BASICAMENTE, SI HAY UNA OPERACION, IDENTIFICAMOS QUE OPERACION VAMOS A HACER, 'REGISTRAR', 'ACTUALIZAR' Y LUEGO EJECUTAMOS DICHA OPERACION QUE ESTA MANDANDO DESDE LA VISTA
	if(isset($_POST['ope'])){
		switch($_POST['ope']){
			case "Registrar":
				guardar();
			break;
				
			// case "Actualizar":
			// 	print("Actualizar");
			// break;
		}
	}
	// ESTA ES LA MISMA VALIDACION DE ARRIBA, SOLO QUE POR METODO GET (OSEA, UNA CONSULTA POR LA URL)
	if(isset($_GET['ope'])){
		switch($_GET['ope']){
			case "Eliminar":
				eliminar();
			break;
		}
	}

// function fnBiblioteca(){
//     print("hola");
// }

function guardar(){
	$carpeta="biblioteca";
	$ruta="public/upload";
	$nombrePdf=generarUUID().".pdf";
	$hoy= new DateTime();

	crearCarpeta($carpeta,"../".$ruta);
	$rutaDestinoArchivo="../".$ruta."/".$carpeta."/".$nombrePdf;
	$_POST["ruta_file_documento"]=rutaHost()."/".$ruta."/".$carpeta."/".$nombrePdf;
	$_POST["extension_documento"]="pdf";
	$_POST["fecha_subida_documento"]=$hoy->format("Y-m-d");
	$documentosModelo=new cls_documentos();
	$documentosModelo->setDatos($_POST);
	$mensaje=$documentosModelo->crear();
	if($_FILES['archivoPdf']['error']==UPLOAD_ERR_OK){
		move_uploaded_file($_FILES["archivoPdf"]["tmp_name"],$rutaDestinoArchivo);
	}
	header("Location: ".constant("URL")."biblioteca/index/$mensaje");	
}

function crearCarpeta($nombreCarpeta, $rutaDestino) {
    // Comprobar si la carpeta ya existe
    $rutaCompleta = $rutaDestino . '/' . $nombreCarpeta;

    if (!is_dir($rutaCompleta)) {
        // La carpeta no existe, crearla
        if (!mkdir($rutaCompleta, 0777, true)) {
            // Si la creación falla, mostrar un mensaje de error
            die('Error al crear la carpeta ' . $rutaCompleta);
        } else {
            echo 'Carpeta creada con éxito: ' . $rutaCompleta;
        }
    } else {
        echo 'La carpeta ya existe: ' . $rutaCompleta;
    }
}

function rutaHost(){
	$rutaHost="";
	if (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on') {
		// echo 'La conexión es segura (HTTPS)';
		$rutaHost="https://";
	} else {
		// echo 'La conexión no es segura (HTTP)';
		$rutaHost="http://";
	}
	$rutaHost=$rutaHost.$_SERVER['HTTP_HOST'];
	return $rutaHost;
}

function generarUUID() {
    if (function_exists('uuid_create')) {
        $uuid = uuid_create(UUID_TYPE_RANDOM);
        return uuid_to_str($uuid);
    } else {
        // Si la extensión uuid no está disponible, generamos un UUID simple
        return sprintf(
            '%04x%04x-%04x-%04x-%04x-%04x%04x%04x',
            mt_rand(0, 0xffff),
            mt_rand(0, 0xffff),
            mt_rand(0, 0xffff),
            mt_rand(0, 0x0fff) | 0x4000,
            mt_rand(0, 0x3fff) | 0x8000,
            mt_rand(0, 0xffff),
            mt_rand(0, 0xffff),
            mt_rand(0, 0xffff)
        );
    }
}

function eliminar(){
	$mensaje=null;
	$carpeta="biblioteca";
	$ruta="public/upload";

	$documentosModelo=new cls_documentos();
	$documentosModelo->setDatos($_GET);
	$result=$documentosModelo->consultar();
	if($result){
		if(count($result)>0){
			$nombreDelArchivo=end(explode("/",$result[0]["ruta_file_documento"]));
			crearCarpeta($carpeta,"../".$ruta);
			$rutaDestinoArchivo="../".$ruta."/".$carpeta."/".$nombreDelArchivo;
			$mensaje=$documentosModelo->eliminar();
			if(file_exists($rutaDestinoArchivo)){
				unlink($rutaDestinoArchivo);
			}
			var_dump($result);
		}
	}
	header("Location: ".constant("URL")."biblioteca/index/$mensaje");	
}
    
?>
