<?php
	if(!class_exists("cls_db")) require_once("cls_db.php");

	class cls_lapso_academico extends cls_db{
		private $id_ano_escolar, $ano_escolar_nombre, $fase_ano_escolar, $estado_inscripciones, $estado_ano_escolar;
		public function __construct(){
			parent::__construct();
			$this->id_ano_escolar = $this->ano_escolar_nombre = $this->estado_inscripciones = $this->estado_ano_escolar = "";
		}

		public function setDatos($d){
			$this->id_ano_escolar = isset($d['id_ano_escolar']) ? $this->Clean(intval($d['id_ano_escolar'])) : null;
			$this->ano_escolar_nombre = isset($d['ano_escolar_nombre']) ? $this->Clean($d['ano_escolar_nombre']) : null;
      $this->estado_inscripciones = isset($d['estado_inscripciones']) ? $this->Clean($d['estado_inscripciones']) : '';
			$this->estado_ano_escolar = isset($d['estado_ano_escolar']) ? $this->Clean($d['estado_ano_escolar']) : '';
		}

		public function create(){
			$sqlConsulta = "SELECT * FROM ano_escolar WHERE ano_escolar_nombre = '$this->ano_escolar_nombre'";
			$result = $this->Query($sqlConsulta);
			
			if($result->num_rows > 0) return "err/02ERR";
			$sql = "INSERT INTO ano_escolar(ano_escolar_nombre,estado_ano_escolar,estado_incripciones) VALUES('$this->ano_escolar_nombre','$this->estado_ano_escolar','$this->estado_inscripciones');";
			
			$this->Query($sql);

			if($this->Result_last_query()) return "msg/01DONE"; else return "err/01ERR";
		}

		public function update(){
			$sqlConsulta = "SELECT * FROM ano_escolar WHERE ano_escolar_nombre = '$this->ano_escolar_nombre' AND id_ano_escolar != $this->id_ano_escolar;";
			$result = $this->Query($sqlConsulta);
			
			if($result->num_rows > 0) return "err/02ERR";

			$sql = "UPDATE ano_escolar SET 
				ano_escolar_nombre = '$this->ano_escolar_nombre',
				estado_incripciones = '$this->estado_inscripciones',
				estado_ano_escolar = '$this->estado_ano_escolar'
				WHERE id_ano_escolar = $this->id_ano_escolar ;";

      $this->Query($sql);
			return "msg/01DONE";
		}

		public function Get_lapsos(){
			$sql = "SELECT * FROM ano_escolar;";
			$results = $this->Query($sql);
			return $this->Get_todos_array($results);
		}

		public function consulta($id){
			$sql = "SELECT * FROM ano_escolar WHERE id_ano_escolar = '$id';";
			$results = $this->Query($sql);
			return $this->Get_array($results);
		}

		public function Get_lapso_activo(){
			$sql = "SELECT * FROM ano_escolar WHERE estado_ano_escolar = '1';";
			$results = $this->Query($sql);
			return $this->Get_array($results);
		}
	}
?>