<?php
	if(!class_exists("cls_db")) require_once("cls_db.php");

	class cls_comunidad extends cls_db{
		private $id_comunidad, $nombre_comunidad, $tipo_comunidad;
			public function __construct(){
			parent::__construct();
			$this->id_comunidad = $this->nombre_comunidad = $this->tipo_comunidad = "";
		}

		public function setDatos($d){
			$this->id_comunidad = isset($d['id_comunidad']) ? $this->Clean(intval($d['id_comunidad'])) : null;
			$this->nombre_comunidad = isset($d['nombre_comunidad']) ? $this->Clean($d['nombre_comunidad']) : null;
      $this->tipo_comunidad = isset($d['tipo_comunidad']) ? $this->Clean($d['tipo_comunidad']) : '';
      $this->direccion_comunidad = isset($d['direccion_comunidad']) ? $this->Clean($d['direccion_comunidad']) : '';
		}

		public function create(){
			$sqlConsulta = "SELECT * FROM comunidad WHERE nombre_comunidad = '$this->nombre_comunidad'";
			$result = $this->Query($sqlConsulta);
			
			if($result->num_rows > 0) return "err/02ERR";
			$sql = "INSERT INTO comunidad(nombre_comunidad,tipo_comunidad,direccion_comunidad) VALUES('$this->nombre_comunidad','$this->tipo_comunidad','$this->direccion_comunidad');";
			$this->Query($sql);

			if($this->Result_last_query()) return "msg/01DONE"; else return "err/01ERR";
		}

		public function update(){
			$sqlConsulta = "SELECT * FROM comunidad WHERE nombre_comunidad = '$this->nombre_comunidad';";
			$result = $this->Query($sqlConsulta);
			
			if($result->num_rows > 0) return "err/02ERR";

			$sql = "UPDATE comunidad SET 
				nombre_comunidad = '$this->nombre_comunidad',
				tipo_comunidad = '$this->tipo_comunidad',
        direccion_comunidad = '$this->direccion_comunidad'
				WHERE id_comunidad = $this->id_comunidad ;";

      $this->Query($sql);
			return "msg/01DONE";
		}

		public function Get_comunidades(){
			$sql = "SELECT * FROM comunidad;";
			$results = $this->Query($sql);
			return $this->Get_todos_array($results);
		}

		public function consulta($id){
			$sql = "SELECT * FROM comunidad WHERE id_comunidad = '$id';";
			$results = $this->Query($sql);
			return $this->Get_array($results);
		}
	}
?>