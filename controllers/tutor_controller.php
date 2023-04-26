<?php
	require_once("../models/config.php");
	require_once("../models/cls_usuario.php");
	require_once("../models/cls_tutor.php");
    
	if(isset($_POST['ope'])){
		switch($_POST['ope']){
			case "Registrar":
				fn_Registrar();
			break;

			case "Actualizar":
				fn_Actualizar();
			break;

			// case "Desactivar":
			// 	fn_Desactivar();
			// break;

			// case "Eliminar":
			// 	fn_Eliminar();
			// break;
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
		$model_u = new cls_usuario();
		$model_t = new cls_tutor();
				
		$model_u->setDatos($_POST);
		$result = $model_u->create();

		if($result){
			$model_t->setDatos($_POST);
			$mensaje = $model_t->create();
		}else $mensaje = "err/01ERR";

		header("Location: ".constant("URL").$_POST['return']."/$mensaje");	
	}

	function fn_Actualizar(){
		$model_u = new cls_usuario();
		$model_u->setDatos($_POST);
		$model_u->Update();

		$model_t = new cls_tutor();
		$model_t->setDatos($_POST);
		$mensaje = $model_t->Update();

		header("Location: ".constant("URL").$_POST['return']."/$mensaje");	
	}

  //   function fn_Desactivar(){
  //       $model = new m_persona();
  //       $model->setDatos(["id_persona" => $_POST["id_persona"], "status_persona" => $_POST["status_persona"]]);
  //       $result = $model->Disable();

  //       print json_encode(["data" => $result]);
  //   }

  //   function fn_Eliminar(){
  //       $model = new m_persona();
  //       $model->setDatos(["id_persona" => $_POST['id_persona']]);
  //       $result = $model->Delete();

  //       print json_encode(["data" => $result]);
  //   }

    // function fn_Consultar_todos(){
    //     $model = new m_persona();
    //     $results = $model->Get_todos_personas();

    //     print json_encode(["data" => $results]);
    // }

    // function fn_Consultar_persona(){
    //     $model = new m_persona();
    //     $model->setDatos(["id_persona" => $_GET["id_persona"]]);
    //     $result = $model->Get_persona();
    //     $result2 = $model->GetMarcasProveedor();

    //     print json_encode(["data" => $result, 'marcas' => $result2]);
    // }
?>