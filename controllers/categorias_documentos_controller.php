<?php

require_once("../models/config.php");
require_once("../models/cls_categorias_documentos.php");
// AQUI YA ES DIFERENTE LA COSA, AQUI YA NO USAMOS CLASES, AQUI USAMOS OBJETOS, ARRIBA INCLUIMOS LOS MODELOS DE CARRERA Y EL ARCHIVO DE CONFIGURACION

// ESTA PRIMERA VALIDACION ES PARA CUANDO ENVIAMOS DATOS POR METODO POST AL CONTROLADOR, BASICAMENTE, SI HAY UNA OPERACION, IDENTIFICAMOS QUE OPERACION VAMOS A HACER, 'REGISTRAR', 'ACTUALIZAR' Y LUEGO EJECUTAMOS DICHA OPERACION QUE ESTA MANDANDO DESDE LA VISTA
if(isset($_POST['ope'])){
    switch($_POST['ope']){
        case "Registrar":
            guardar($_POST);
        break;
        case "eliminar":
            eliminar($_POST);
        break;
        // case "consultar_todo":
        //     consultarTodo();
        // break;
            
        // case "Actualizar":
        // 	print("Actualizar");
        // break;
    }
}

if(isset($_GET['ope'])){
    switch($_GET['ope']){
        case "consultar_todo":
            consultarTodo();
        break;
            
        // case "Actualizar":
        // 	print("Actualizar");
        // break;
    }
}

function guardar($post){
    $mensaje=null;
    $CategoriaDocumentosModelo=new cls_categorias_documentos();
    $CategoriaDocumentosModelo->setDatos($post);
    if($post["id_categoria"]==""){
        $mensaje=$CategoriaDocumentosModelo->create();
    }
    else{
        $mensaje=$CategoriaDocumentosModelo->update();
    }
    print(json_encode(["mensaje" => $mensaje]));
}

function eliminar($post){
    $CategoriaDocumentosModelo=new cls_categorias_documentos();
    $CategoriaDocumentosModelo->setDatos($post);
    $mensaje=$CategoriaDocumentosModelo->eliminar();
    print(json_encode(["mensaje" => $mensaje]));
}

function consultarTodo(){
    $CategoriaDocumentosModelo=new cls_categorias_documentos();
    $respuesta=$CategoriaDocumentosModelo->consultarTodo();
    if(count($respuesta)>0){
        print(json_encode(["datos" => $respuesta]));
    }
    else{
        print(json_encode(["datos" => []]));
    }
}



?>