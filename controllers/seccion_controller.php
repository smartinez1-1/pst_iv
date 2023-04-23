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

	function fn_Registrar(){
		$model_s = new cls_seccion();
				
		$model_s->setDatos($_POST);
		$mensaje = $model_s->create();

		header("Location: ".constant("URL")."seccion/formulario/$mensaje");	
	}

	function fn_Actualizar(){
		$model_s = new cls_seccion();
				
		$model_s->setDatos($_POST);
		$mensaje = $model_s->update();

		header("Location: ".constant("URL")."seccion/formulario/$mensaje");	
	}
?>