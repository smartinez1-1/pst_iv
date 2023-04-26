<?php
	require_once("../models/config.php");
	require_once("../models/cls_tutor_comunidad.php");
    
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

	// if(isset($_GET['ope'])){
	// 	switch($_GET['ope']){
	// 		case "Todos_personas":
	// 			fn_Consultar_todos();
	// 		break;

	// 		case "Consultar_persona":
	// 			fn_Consultar_persona();
	// 		break;
	// 	}
	// }

	function fn_Registrar(){
		$model_t = new cls_tutor_comunidad();
				
		$model_t->setDatos($_POST);
    $mensaje = $model_t->create();

		header("Location: ".constant("URL")."tutor-comunidad/index/$mensaje");	
	}

	function fn_Actualizar(){
		$model = new cls_tutor_comunidad();
		$model->setDatos($_POST);
		$mensaje = $model->Update();

		header("Location: ".constant("URL")."tutor-comunidad/index/$mensaje");	
	}

    // function fn_Consultar_persona(){
    //     $model = new m_persona();
    //     $model->setDatos(["id_persona" => $_GET["id_persona"]]);
    //     $result = $model->Get_persona();
    //     $result2 = $model->GetMarcasProveedor();

    //     print json_encode(["data" => $result, 'marcas' => $result2]);
    // }
?>