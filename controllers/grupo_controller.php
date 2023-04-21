<?php
	require_once("../models/config.php");
	require_once("../models/cls_grupo.php");
	    
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
		$model_g = new cls_grupo();
				
		$model_g->setDatos($_POST);
		$mensaje = $model_g->create();

		header("Location: ".constant("URL")."grupo/formulario/$mensaje");	
	}

	function fn_Actualizar(){
		$model_g = new cls_grupo();
				
		$model_g->setDatos($_POST);
		$mensaje = $model_g->update();

		header("Location: ".constant("URL")."grupo/formulario/$mensaje");	
	}
?>