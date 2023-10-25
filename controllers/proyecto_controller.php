<?php
	require_once("../models/config.php");
	require_once("../models/cls_proyecto.php");
	    
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
			case "Get_todos":
				fn_Get_todos();
			break;
		}
	}

	function fn_Registrar(){
		$model_s = new cls_proyecto();
				
		$model_s->setDatos($_POST);
		$mensaje = $model_s->create();

		header("Location: ".constant("URL")."proyecto/index/$mensaje");	
	}

	function fn_Actualizar(){
		$model_s = new cls_proyecto();
				
		$model_s->setDatos($_POST);
		$mensaje = $model_s->update();

		header("Location: ".constant("URL")."proyecto/index/$mensaje");	
	}

	function fn_Get_todos(){
		$models_s = new cls_proyecto();
		$result = $models_s->Get_proyectos();
		print json_encode(["data" => $result]);
	}

	// function fn_proyectoes_por_carrera(){
	// 	$models_s = new cls_proyecto();
	// 	$result = $models_s->consultaPorCarrera($_GET['id_carrera']);

	// 	print json_encode(["data" => $result]);
	// }
?>