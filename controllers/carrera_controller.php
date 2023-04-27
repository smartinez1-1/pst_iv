<?php
	require_once("../models/config.php");
	require_once("../models/cls_carrera.php");
	    
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

	if(isset($_GET['ope'])){
		switch($_GET['ope']){
			case "Get_estudiantes_por_carrera":
				fn_Estudians_por_Carrera();
			break;
		}
	}

	

	function fn_Registrar(){
		$model_c = new cls_carrera();
				
		$model_c->setDatos($_POST);
		$mensaje = $model_c->create();

		header("Location: ".constant("URL")."carrera/index/$mensaje");	
	}

	function fn_Actualizar(){
		$model_c = new cls_carrera();
				
		$model_c->setDatos($_POST);
		$mensaje = $model_c->update();

		header("Location: ".constant("URL")."carrera/index/$mensaje");	
	}

	function fn_Estudians_por_Carrera(){
		$models_c = new cls_carrera();
		$result = $models_c->ConsultaEstudiantesPorCarrera($_GET['id_carrera']);

		print json_encode(["data" => $result]);
	}
?>