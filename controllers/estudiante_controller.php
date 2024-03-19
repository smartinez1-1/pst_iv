<?php
	require_once("../models/config.php");
	require_once("../models/cls_usuario.php");
	require_once("../models/cls_estudiante.php");
	require_once("../models/cls_historial_claves.php");
    
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
			case "Get_estudiante":
				fn_consulta_estudiante();
			break;

			case 'Get_todos':
				fn_consulta_todos();
			break;

			case 'Get_todos_inscritos':
				fn_consulta_todos_Inscritos();
			break;
			
			case 'Get_todos_byTipoCarrera':
				fn_consulta_todos_PorTipoCarrera();
			break;
			
		}
	}

	function fn_Registrar(){
		$model_u = new cls_usuario();
		$model_e = new cls_estudiante();
		
		$model_historial_claves = new cls_historial_claves($_POST["cedula_usuario"]);
		
		$model_u->setDatos($_POST);
		$result = $model_u->create();

		if($result){
			$model_e->setDatos($_POST);
			$mensaje = $model_e->create();
			$estadoRegistroDelHistorial=$model_historial_claves->crearRegistro();
			
		}else $mensaje = "estudiante/formulario/err/01ERR";

		header("Location: ".constant("URL"). $mensaje);	
	}

	function fn_Actualizar(){
		$model_u = new cls_usuario();
		$model_e = new cls_estudiante();
		
		$model_u->setDatos($_POST);
		$model_u->Update();

		$model_e->setDatos($_POST);
		$mensaje = $model_e->Update();

		header("Location: ".constant("URL"). $mensaje);	
	}

	function fn_consulta_estudiante(){
		$model = new cls_estudiante();
		$result = $model->consulta($_GET["id_estudiante"]);

		print json_encode(["data" => $result]);
	}

	function fn_consulta_todos(){
		$model = new cls_estudiante();
		$result = $model->Get_estudiantes("NO-INS");

		print json_encode(["data" => $result]);
	}

	function fn_consulta_todos_Inscritos(){
		$model = new cls_estudiante();
		$result = $model->Get_estudiantes("INS");

		print json_encode(["data" => $result]);
	}

	function fn_consulta_todos_PorTipoCarrera(){
		$model = new cls_estudiante();
		$result = $model->Get_estudiantesPorTipoCarrera($_GET['tipo']);

		print json_encode(["data" => $result]);
	}
	
?>