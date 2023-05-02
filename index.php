<?php
  require_once("./models/config.php");
  require_once("./controllers/alerts.php");

  // los arhivos de arriba son de configuracion y un controlador para el tema de las alertas por pantalla, ya luego los veremos, aqui abajo vemos la primera clase 'APP', esta tiene atributos privados que solo puede usar la misma clase, tiene un constructor que se ejecuta automaticamente en cada peticion
  class App{
    private $ruta_actual, $code_error, $code_done, $titleContent, $controlador, $file_view_name, $ObjMessage, $id_consulta;

    public function __construct(){
      // session_start es una funcion para activar la sesion de usuario, si la hay, se puede entrar al sistema, sino, pues no deja entrar, id_consulta es una variable global que uso para todas las consultas de cada modulo
      // objmessage es una variable que contiene todos los metodos de la clase alert (esta clase viene del controlador de alertas que esta arriba, de esta manera se consigue que las alertas esten presentes en todas las vistas, sin copiar y pegar infinitamente)
      // this->getview es un metodo que uso para buscar la vista que se esta pidiendo por la ruta (la url), le estoy pasando por parametro justo la ruta que quiero ver, ejemplo: cuando se ingresa al login, pues justamente se esta buscando la palabra 'login' dentro de las carpetas que tiene views, si lo encuentra, lo muestra, sino, pues muestra una vista de error 404, asi basicamente se ejecuta el sistema en cada peticion
      session_start();
      $this->id_consulta = null;
      $this->ObjMessage = new alerts();
      $this->GetView($this->GetRoute());
    }
    // esta funcion de aqui abajo, ni la estoy usando, asi que x, no es importante :)
    private function IsActive($nameRoute){
      if(is_array($nameRoute) && in_array($this->ruta_actual, $nameRoute)) echo "active";
      if($nameRoute === $this->ruta_actual) echo "active";
    }
    // esta funcion es para incluir un archivo externo llamado head (ahi tengo el title de todas las vistas, y el link del css), esto funciona para todas las rutas
    private function GetHeader($titulo = "SGSC | UNEFA"){
      $this->Auth();
      include_once("./views/includes/head.php");
    }
    // esta funcion tiene la misma finalidad que la de arriba, solo que aqui puedo requerir cualquier archivo, solo pasando el nombre, ya veran que arvhivos externos
    private function GetComplement($name, $options = []){
      $ruta = "./views/includes/$name.php";
      if(file_exists($ruta)) require_once("./views/includes/$name.php");
    }
    // esto es solo para requerir la vista de error 404
    private function NotFound404(){
      require_once("./views/contents/error/404.php");
    }
    // esta es la unica validacion que hay para la seguridad de las rutas, funciona asi, si la vista que estoy buscando esta dentro de una lista de rutas privadas, y no hay una sesion activa, pues manda al usuario directo al login, ahora si hay sesion activa, pues el usuario puede pasar a donde quiera
    private function Auth(){
      if(in_array($this->ruta_actual, constant("PRIVATE_URLS"))){
        if(!isset($_SESSION['cedula'])){
          $this->Redirect("auth/login","err/01AUTH");
        }
      }
    }
    // esto luego lo borro, creo que no lo estoy usando
    private function DateNow($param = ""){
      $unixTime = time();
      $timeZone = new \DateTimeZone('America/Caracas');

      $time = new \DateTime();
      $time->setTimestamp($unixTime)->setTimezone($timeZone);

      if($param == "") $fecha = $time->format('Y-m-d');
      else $fecha = $fecha = $time->format($param);

      return $fecha;
    }
    private function thisDateMoreOneHour(){
      $date = $this->DateNow("Y-m-d H:i");
      $fecha = new DateTime($this->DateNow("Y-m-d H:i"));
      $fecha->add(new dateInterval("PT1H"));
      return $fecha->format("Y-m-d\TH:i");
    }
    private function Redirect($view, $params){ header("Location: ".constant("URL")."$view/$params"); }
    // aqui se procesan las peticiones, por defecto si no hay ninguna peticion, el sistema manda al usuario al login, ahi abajo esta como seria, el controlador es 'auth' y la vista se llama 'login'
    // 'auth' seria la carpeta dentro de contents y login el archivo dentro de esta
    private function GetRoute(){
      $url = isset($_GET['url']) ? $_GET['url'] : "auth/login";
      $url = rtrim($url, '/');
      $url = explode('/', $url);
      // ESTAS VALIDACIONES DE ABAJO SON POR SI SE ESTA RECIBIENDO ALGUN TIPO DE CODIGO DE ESTADO O SI SE VA A CONSULTAR ALGO
      if(sizeof($url) > 2 && $url[2] === "err") $this->code_error = $url[3];
      if(sizeof($url) > 2 && $url[2] === "msg") $this->code_done = $url[3];
      if(sizeof($url) > 2 && $url[2] === "b") $this->id_consulta = $url[3];
      return $url;
    }

    private function SetURL($vista = ''){ 
      if($vista == '') echo constant("URL"). $this->controlador;
      else echo constant("URL"). $vista;
    }
    // con esta funcion busco el archivo dentro de mi carpeta views/contents/{aqui va el nombre del controlador}/{luego iria el nombre del archivo} y listo, aqui no es necesario que aparezca la extension .php de cada vista
    private function GetView($nameView){
      $this->file_view_name = (isset($nameView[1]) && $nameView[1] != "err" ? $nameView[1] : "index");
      $file_view_path = "./views/contents/".$nameView[0]."/view_".$this->file_view_name.".php";
      if(file_exists($file_view_path)){
        $this->ruta_actual = $nameView[0]."/".$this->file_view_name;
        $this->controlador = $nameView[0];
        require_once($file_view_path);
      }else $this->NotFound404();
    }
  }
  // y aqui se ejecutan todos los metodos de la clase APP
  $app = new App();
?>
