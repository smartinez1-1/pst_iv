<?php

    require_once("../models/config.php");
	require_once("../models/cls_carrera.php");
	// AQUI YA ES DIFERENTE LA COSA, AQUI YA NO USAMOS CLASES, AQUI USAMOS OBJETOS, ARRIBA INCLUIMOS LOS MODELOS DE CARRERA Y EL ARCHIVO DE CONFIGURACION
	
	// ESTA PRIMERA VALIDACION ES PARA CUANDO ENVIAMOS DATOS POR METODO POST AL CONTROLADOR, BASICAMENTE, SI HAY UNA OPERACION, IDENTIFICAMOS QUE OPERACION VAMOS A HACER, 'REGISTRAR', 'ACTUALIZAR' Y LUEGO EJECUTAMOS DICHA OPERACION QUE ESTA MANDANDO DESDE LA VISTA
	if(isset($_POST['ope'])){
		switch($_POST['ope']){
			case "Registrar":
				print("Registrar");
				// fn_Registrar();
				break;
				
			case "Actualizar":
				print("Actualizar");
				// fn_Actualizar();
			break;
		}
	}
	// ESTA ES LA MISMA VALIDACION DE ARRIBA, SOLO QUE POR METODO GET (OSEA, UNA CONSULTA POR LA URL)
	// if(isset($_GET['ope'])){
	// 	switch($_GET['ope']){
	// 		case "Get_estudiantes_por_carrera":
	// 			// fn_Estudians_por_Carrera();
	// 		break;
	// 	}
	// }

// function fnBiblioteca(){
//     print("hola");
// }
    
?>
