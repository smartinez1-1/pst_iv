<?php
	require('../vendor/autoload.php');
	$dotenv = Dotenv\Dotenv::createImmutable("../");
	$dotenv->load();
	// BUENO, ESTA CLASE 'CLS_DB', ES LA QUE SE USA PARA LA CONEXION A LA BASE DE DATOS, ES LA UNICA, DE AQUI EL RESTO DE CLASES DE CONECTAN PARA PODER PEDIR INFORMACION DE LA DB
    class cls_db{
			// ESTOS ATRIBUTOS SOLO SON DE ESTA CLASE, NO SE PUEDEN USAR EN OTROS ARCHIVOS EXTERNOS, SOLO AQUI, ES PARA MAYOR SEGURIDAD
			private $host, $dbname, $user, $pass, $conexion, $port;
			// YA LES COMENTE QUE EL CONSTRUCTOR ES ALGO QUE SE EJECUTA AUTOMATICAMENTE
			public function __construct(){
				if(!isset($_SESSION)) session_start();

				$this->host = $_ENV["HOST_DB"];
				$this->dbname = $_ENV["NAME_DB"];
				$this->user = $_ENV["USER_DB"];
				$this->pass = $_ENV["PASS_USER_DB"];
				$this->port = $_ENV["PORT_DB"];
				$this->Connect();
			}
			// ESTO CREA LA CONEXION A LA DB (POR SI HAY ALGUN PROBLEMA DE CONEXION DESPUES)
			private function Connect(){
				$this->conexion = mysqli_connect($this->host, $this->user, $this->pass, $this->dbname, $this->port);
				if(mysqli_connect_error()) die("NO SE PUEDO CONECTAR A LA BASE DE DATOS: ".mysqli_connect_error());
			}
			// CON ESTA FUNCION SE EJECUTAN TODAS LAS CONSULTAS
			protected function Query($sql){ $this->Connect(); return mysqli_query($this->conexion, $sql); }
			// CON ESTA FUNCION SE INICIAN LAS TRANSACCIONES (SABES LO QUE ES UNA TRANSACCION?),SON BASICAMENTE CONSULTAS QUE SE EJECUTAN SECUENCIALMENTE, UNA DETRAS DE OTRA, SI ALGUNA DE ESAS CONSULTAS FALLA, LA TRANSACCION SE DETIENE Y SE REVIERTEN LOS CAMBIOS QUE SE HAYAN HECHO, PARA NO DEJAR NADA A MEDIAS
			protected function Start_transacction(){ mysqli_autocommit($this->conexion, false); }
			// ESTO FINALIZA DICHA TRANSACCION
			protected function End_transacction(){ mysqli_commit($this->conexion); }
			// ESTA FUNCION REVIERTE CUALQUIER CAMBIO QUE HAYA REALIZADO
			protected function Rollback(){ mysqli_rollback($this->conexion); }
			// ESTA FUNCION ES PARA SABER SI MI CONSULTA TIENE ALGUN RESULTADO
			protected function Result_last_query(){ return (mysqli_affected_rows($this->conexion)) ? true : false;}
			// ESTAS DOS FUNCIONES DE ABAJO SON PARA EXTRAER DATOS DE LAS CONSULTAS
			protected function Get_array($results){ return mysqli_fetch_array($results); }
			protected function Get_todos_array($results){
				if($results) return mysqli_fetch_all($results, MYSQLI_ASSOC); else return [];
			}
			protected function Returning_id(){ return mysqli_insert_id($this->conexion); }
			// CON ESTA FUNCION LIMPIO TODO LO QUE MANDO A LA BASE DE DATOS (PARA EVITAR INYECCION SQL), ES CUANDO EJEMPLO, CUANDO TE HACER LOGIN EN UNA PAGINA, ESTAS METIENDO DATOS, DICHOS DATOS SE INTEGRAN A UNA CONSULTA QUE SE EJECUTA EN LA DB, Y SI TU METES UN COMANDO SQL, PARA ELIMINAR ALGO, Y SE LLEGA A EJECUTAR, SE PUEDE JODER LA BASE DE DATOS
			protected function Clean($variable, $upper = true){
				$variable = stripslashes($variable);
				// SI DETECTA QUE ESCRIBI CUALQUIERA DE ESTAS CONSULTAS, LAS ELIMINA, OSEA SI DETECTA ALGO DE LO QUE HAY ABAJO, LO ELIMINA
				$variable = str_ireplace("SELECT * FROM","",$variable);
				$variable = str_ireplace("DELETE * FROM","",$variable);
				$variable = str_ireplace("INSERT INTO","",$variable);
				$variable = str_ireplace("[","",$variable);
				$variable = str_ireplace("]","",$variable);
				$variable = str_ireplace("(","",$variable);
				$variable = str_ireplace(")","",$variable);
				$variable = str_ireplace("{","",$variable);
				$variable = str_ireplace("}","",$variable);
				$variable = str_ireplace("==","",$variable);
				$variable = str_ireplace("=","",$variable);
				$variable = str_ireplace("<script>","",$variable);
				$variable = str_ireplace("<script src= >","",$variable);
				$variable = str_ireplace("src=","",$variable);

				if(!is_numeric($variable) && $upper) $variable = strtoupper($variable);
				else $variable = str_ireplace(" ","",$variable);
				return $variable;
			}
			// Y ESTA ES UNA FUNCION PARA DESTRUIR LA CONEXION A LA BASE DE DATOS, YA QUE EN CADA CONSULTA SE CREA UNA, Y LUEGO SE TIENE QUE DESTRUIR (ASI NO SE COLAPSA LA BASE DE DATOS, PORQUE ELLA ESPERA TODAS ESAS CONEXIONES SI ES QUE QUEDAN ABIERTAS)
			public function __destruct(){ mysqli_close($this->conexion); }
    }
?>
