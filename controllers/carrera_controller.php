<?php
	require_once("../models/config.php");
	require_once("../models/cls_carrera.php");
	// AQUI YA ES DIFERENTE LA COSA, AQUI YA NO USAMOS CLASES, AQUI USAMOS OBJETOS, ARRIBA INCLUIMOS LOS MODELOS DE CARRERA Y EL ARCHIVO DE CONFIGURACION
	
	// ESTA PRIMERA VALIDACION ES PARA CUANDO ENVIAMOS DATOS POR METODO POST AL CONTROLADOR, BASICAMENTE, SI HAY UNA OPERACION, IDENTIFICAMOS QUE OPERACION VAMOS A HACER, 'REGISTRAR', 'ACTUALIZAR' Y LUEGO EJECUTAMOS DICHA OPERACION QUE ESTA MANDANDO DESDE LA VISTA
	if(isset($_POST['ope'])){
		switch($_POST['ope']){
			case "Registrar":
				fn_Registrar();
			break;

			case "Actualizar":
				fn_Actualizar();
			break;
		}
	}
	// ESTA ES LA MISMA VALIDACION DE ARRIBA, SOLO QUE POR METODO GET (OSEA, UNA CONSULTA POR LA URL)
	if(isset($_GET['ope'])){
		switch($_GET['ope']){
			case "Get_estudiantes_por_carrera":
				fn_Estudians_por_Carrera();
			break;
		}
	}

	

	function fn_Registrar(){
		// MODEL_C, ES UN OBJETO DE LA CLASE CLS_CARRERA, ESTO SIGNIFICA QUE MODEL_C, TIENE LOS METODOS DE CLS_CARREA, PEROOO, SOLO LOS METODOS PUBLICOS DE DICHA CLASE, NO TIENE ACCESO A LOS PRIVADOS NI A LOS PROTEJIDOS
		$model_c = new cls_carrera();
		// MANDA LOS DATOS QUE ESTA RECIBIENDO EL CONTROLADOR AL MODELO, LUEGO LO GUARDA, Y CUALQUIER MENSAJE QUE RETORNO DE LA CLASE, LO MANDA POR LA URL EN LA FUNCION DE ABAJO
		$model_c->setDatos($_POST);
		$mensaje = $model_c->create();
		// HEADER ES UNA FUNCION PARA REDIRECCIONAR AL USUARIO, LO MANDO AL MODULO CARRERA, A LA VISTA INDEX Y LE PASO EL CODIGO QUE RESULTA DE LA OPERACION, SI FUE EXITOSO O FALLIDO
		// CONSTANT(URL) = ESTO TIENE DEL ARCHIVO DE CONFIGURACION, BASICAMENTE ES LA URL ESTATICA QUE ESTOY GENERANDO ALLA, Y QUE ESTOY USANDO EN TODOS LADOS
		header("Location: ".constant("URL")."carrera/index/$mensaje");	
	}
	// ESTO FUNCIONA EXACTAMENTE IGUAL
	function fn_Actualizar(){
		$model_c = new cls_carrera();
				
		$model_c->setDatos($_POST);
		$mensaje = $model_c->update();

		header("Location: ".constant("URL")."carrera/index/$mensaje");	
	}

	function fn_Estudians_por_Carrera(){
		$models_c = new cls_carrera();
		$result = $models_c->ConsultaEstudiantesPorCarrera($_GET['id_carrera']);
		// ESTA FUNCIONA UN POCO DIFERENTE, PORQUE AL FINAL, NO ESTOY HACIENDO NINGUNA REDIRECCION, ESTOY IMPRIMIENDO UNA RESPUSTA, DICHA RESPUESTA LA ESTOY RECIBIENDO CON JAVASCRIPT EN LA VISTA
		print json_encode(["data" => $result]);
	}
?>