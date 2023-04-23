<?php
	require_once("../models/config.php");
	require_once("../models/cls_comunidad.php");
	    
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
		$model_c = new cls_comunidad();
				
		$model_c->setDatos($_POST);
		$mensaje = $model_c->create();

		header("Location: ".constant("URL")."comunidad/formulario/$mensaje");	
	}

	function fn_Actualizar(){
		$model_c = new cls_comunidad();
				
		$model_c->setDatos($_POST);
		$mensaje = $model_c->update();

		header("Location: ".constant("URL")."comunidad/formulario/$mensaje");	
	}
?>