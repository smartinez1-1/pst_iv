<?php
	require_once("../models/config.php");
	require_once("../models/cls_lapso_academico.php");
	    
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

	function fn_Registrar(){
		$model_l = new cls_lapso_academico();
				
		$model_l->setDatos($_POST);
		$mensaje = $model_l->create();

		header("Location: ".constant("URL")."lapso-academico/index/$mensaje");	
	}

	function fn_Actualizar(){
		$model_l = new cls_lapso_academico();
				
		$model_l->setDatos($_POST);
		$mensaje = $model_l->update();

		header("Location: ".constant("URL")."lapso-academico/index/$mensaje");	
	}
?>