<?php
  $url = explode('/', $_SERVER['SCRIPT_NAME']);
  $string_url = "";
  $host_string = $_SERVER['HTTP_HOST'];
  $port_string = $_SERVER['SERVER_PORT'];

  foreach($url as $item){
    if($item === "controllers") break;
    if($item != "index.php") $string_url .= $item."/"; else break;
  }
  // "grupos/index","grupos/form",
  $rutas_privadas = [
    ""
  ];

  define("URL", "http://$host_string:$port_string$string_url");
  define("PRIVATE_URLS", $rutas_privadas);
?>
