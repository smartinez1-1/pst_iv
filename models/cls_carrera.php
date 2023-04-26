<?php
	if(!class_exists("cls_db")) require_once("cls_db.php");

	class cls_carrera extends cls_db{
		private $id_carrera, $nombre_carrera, $codigo_carrera, $estado_carrera;
			public function __construct(){
			parent::__construct();
			$this->id_carrera = $this->nombre_carrera = $this->codigo_carrera = $this->estado_carrera = "";
		}

		public function setDatos($d){
			$this->id_carrera = isset($d['id_carrera']) ? $this->Clean(intval($d['id_carrera'])) : null;
			$this->nombre_carrera = isset($d['nombre_carrera']) ? $this->Clean($d['nombre_carrera']) : null;
			$this->codigo_carrera = isset($d['codigo_carrera']) ? $this->Clean($d['codigo_carrera']) : '';
      $this->estado_carrera = isset($d['estado_carrera']) ? $this->Clean($d['estado_carrera']) : '';
		}

		public function create(){
			$sqlConsulta = "SELECT * FROM carrera WHERE codigo_carrera = '$this->codigo_carrera'";
			$result = $this->Query($sqlConsulta);
			
			if($result->num_rows > 0) return "err/02ERR";
			$sql = "INSERT INTO carrera(nombre_carrera,codigo_carrera,estado_carrera) VALUES('$this->nombre_carrera','$this->codigo_carrera','$this->estado_carrera');";
			$this->Query($sql);

			if($this->Result_last_query()) return "msg/01DONE"; else return "err/01ERR";
		}

		public function update(){
			$sqlConsulta = "SELECT * FROM carrera WHERE codigo_carrera = '$this->codigo_carrera' AND nombre_carrera = '$this->nombre_carrera' AND estado_carrera = '1';";
			$result = $this->Query($sqlConsulta);
			
			if($result->num_rows > 0) return "err/02ERR";

			$sql = "UPDATE carrera SET 
				codigo_carrera = '$this->codigo_carrera', 
				nombre_carrera = '$this->nombre_carrera',
				estado_carrera = '$this->estado_carrera'
				WHERE id_carrera = $this->id_carrera ;";
			
      $this->Query($sql);
			return "msg/01DONE";
		}

		public function Get_carreras(){
			$sql = "SELECT * FROM carrera;";
			$results = $this->Query($sql);
			return $this->Get_todos_array($results);
		}

		public function consulta($id){
			$sql = "SELECT * FROM carrera WHERE id_carrera = '$id';";
			$results = $this->Query($sql);
			return $this->Get_array($results);
		}
	}
?>