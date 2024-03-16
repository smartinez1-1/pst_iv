<?php
  require_once("../models/config.php");
  require_once("../models/cls_auth.php");
  require_once("../models/cls_usuario.php");
  require_once("../models/cls_historial_claves.php");
    
  if(isset($_POST['ope'])){
    switch($_POST['ope']){
      case "Ingresar":
        fn_Login();
      break;

      case "Actualizar":
        fn_Actualizar();
      break;

      // case "Register":
      //   fn_Register();
      // break;

      case "logout":
        fn_Cerrar();
      break;
    }
  }

  // if(isset($_GET['ope'])){
  //   switch($_GET['ope']){
  //     case "Get_respuesta":
  //       fn_Get_respuesta();
  //     break;

  //     case "Consultar_grupo":
  //       fn_Consultar_grupo();
  //     break;
  //   }
  // }

  function fn_Login(){
    $model = new cls_auth();    
    
    $model->setDatos($_POST);
    $mensaje = $model->Login();
    
    if($mensaje[0]) header("Location: ".constant("URL").$mensaje[2].$mensaje[1]);
    else header("Location: ".constant("URL").$mensaje[2].$mensaje[1]);
  }

  function fn_Actualizar(){
    
    $model_u = new cls_usuario();
    $model_historial_claves = new cls_historial_claves($_POST["cedula_usuario"]);

    $fecha=new DateTime("now");
    $fechaCaducidad=$fecha->modify("+".$_POST["periodo_caducidad"]." days");
    $_POST["fecha_de_caducidad_clave"]=$fechaCaducidad->format("y-m-d");
    $validar=$model_historial_claves->validarClaveHistorial($_POST["clave_usuario"],$_POST["cedula_usuario"]);

    if($validar==false){
      $model_u->setDatos($_POST);
      $mensaje = $model_u->Update();
      $estadoRegistroDelHistorial=$model_historial_claves->crearRegistro();
    }

    header("Location: ".constant("URL")."profile/index/".$mensaje);	
  }

  // function fn_Register(){
  //   $model = new cls_auth();
  //   $model->setDatos($_POST);
  //   $mensaje = $model->Register_user();

  //   header("Location: ".constant("URL")."auth/sign_in/$mensaje");
  // }

  // function fn_Get_respuesta(){
  //   $model = new cls_auth();
  //   $result = $model->Get_Respuestas_to_preguntas($_GET['id']);
  //   print json_encode(["data" => $result]);
  // }

  function fn_Cerrar(){
    session_start();
    session_unset();
    session_destroy();
    header("Location: ".constant("URL")."auth/login");
  }