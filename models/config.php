<?php
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
  $rutas_privadas = [
    "carrera/index","carrera/formulario","inicio/index","seccion/index","seccion/formulario",
    "comunidad/index","comunidad/formulario","tutor/index","tutor/formulario","estudiante/index","estudiante/formulario",
    "tutor-comunidad/index","tutor-comunidad/formulario","grupo/index","grupo/formulario","semestre/index","semestre/formulario",
    "inscripcion/index","inscripcion/formulario",
  ];

  define("URL", "https://$host_string:$port_string$string_url");
  define("PRIVATE_URLS", $rutas_privadas);
?>
