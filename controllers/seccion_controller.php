<?php
	require_once("../models/config.php");
	require_once("../models/cls_seccion.php");
	    
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
			case "Get_seccion_por_carrera":
				fn_secciones_por_carrera();
			break;

			case "Get_secciones":
				fn_secciones();
			break;
		}
	}

	function fn_Registrar(){
		$model_s = new cls_seccion();
				
		$model_s->setDatos($_POST);
		$mensaje = $model_s->create();

		header("Location: ".constant("URL")."seccion/index/$mensaje");	
	}

	function fn_Actualizar(){
		$model_s = new cls_seccion();
				
		$model_s->setDatos($_POST);
		$mensaje = $model_s->update();

		header("Location: ".constant("URL")."seccion/index/$mensaje");	
	}

	function fn_secciones_por_carrera(){
		$models_s = new cls_seccion();
		$result = $models_s->consultaPorCarrera($_GET['id_carrera']);

		print json_encode(["data" => $result]);
	}

	function fn_secciones(){
		$models_s = new cls_seccion();
		$result = $models_s->Get_secciones();

		print json_encode(["data" => $result]);
	}
?>