<?php
  // YA TODO ESTO SON COSAS DE CONFIGURACION, BASICAMENTE ES PARA TENER UNA URL ESTATICA, Y ASI HACER LA NAVEGACION AUTOMATICA DEL PROYECTO DE MEJOR FORMA
  $url = explode('/', $_SERVER['SCRIPT_NAME']);
  $string_url = "";
  $host_string = $_SERVER['HTTP_HOST'];
  $port_string = $_SERVER['SERVER_PORT'];
  $protocolo = explode('/', $_SERVER['SERVER_PROTOCOL']);
  $protocolo = strtolower($protocolo[0]);

  foreach($url as $item){
    if($item === "controllers") break;
    if($item != "index.php") $string_url .= $item."/"; else break;
  }
  // "grupos/index","grupos/form",
  // ESTA ES LA LISTA DE RUTAS PRIVADAS, SI YO BORRO ALGUNA RUTA DE AHI, ESTARIA DEJANDO LIBRE ESA RUTA PARA QUE CUALQUIERA ENTRE Y PASE POR ENCIMA DE LA VALIDACION DE SEGURIDAD
  $rutas_privadas = [
    "carrera/index","carrera/formulario","inicio/index","seccion/index","seccion/formulario",
    "comunidad/index","comunidad/formulario","tutor/index","tutor/formulario","estudiante/index","estudiante/formulario",
    "tutor-comunidad/index","tutor-comunidad/formulario","grupo/index","grupo/formulario","semestre/index","semestre/formulario",
    "inscripcion/index","inscripcion/formulario","profile/index"
  ];
  
  define("URL", "$protocolo://$host_string:$port_string$string_url");
  define("PRIVATE_URLS", $rutas_privadas);
?>
