<?php
	if(!class_exists("cls_db")) require_once("cls_db.php");

	class cls_semestre extends cls_db{
		private $id_semestre, $des_semestre, $fecha_inicio_semestre, $fecha_cierre_semestre, $estado_semestre;
			public function __construct(){
			parent::__construct();
			$this->id_semestre = $this->des_semestre = $this->fecha_inicio_semestre = $this->fecha_cierre_semestre = $this->estado_semestre = "";
		}

		public function setDatos($d){
			$this->id_semestre = isset($d['id_semestre']) ? $this->Clean(intval($d['id_semestre'])) : null;
			$this->des_semestre = isset($d['des_semestre']) ? $this->Clean($d['des_semestre']) : null;
			$this->fecha_inicio_semestre = isset($d['fecha_inicio_semestre']) ? $this->Clean($d['fecha_inicio_semestre']) : '';
			$this->fecha_cierre_semestre = isset($d['fecha_cierre_semestre']) ? $this->Clean($d['fecha_cierre_semestre']) : '';
      $this->estado_semestre = isset($d['estado_semestre']) ? $this->Clean($d['estado_semestre']) : null;
		}

		public function create(){
			$sqlConsulta = "SELECT * FROM semestre WHERE des_semestre = '$this->des_semestre'";
			$result = $this->Query($sqlConsulta);
			
			if($result->num_rows > 0) return "err/02ERR";
			$sql = "INSERT INTO semestre(des_semestre,fecha_inicio_semestre,fecha_cierre_semestre,estado_semestre) 
			VALUES('$this->des_semestre','$this->fecha_inicio_semestre','$this->fecha_cierre_semestre','$this->estado_semestre');";
			
			$this->Query($sql);

			if($this->Result_last_query()) return "msg/01DONE"; else return "err/01ERR";
		}

		public function update(){
			$sqlConsulta = "SELECT * FROM semestre WHERE des_semestre = '$this->des_semestre';";
			$result = $this->Query($sqlConsulta);
			
			if($result->num_rows > 0) return "err/02ERR";

			$sql = "UPDATE semestre SET 
				des_semestre = '$this->des_semestre',
				estado_semestre = '$this->estado_semestre',
				fecha_inicio_semestre = '$this->fecha_inicio_semestre',
				fecha_cierre_semestre = '$this->fecha_cierre_semestre'
				WHERE id_semestre = $this->id_semestre ;";

      $this->Query($sql);
			return "msg/01DONE";
		}

		public function Get_semestres(){
			$sql = "SELECT * FROM semestre;";
			$results = $this->Query($sql);
			return $this->Get_todos_array($results);
		}

		// public function Get_semestres_activos(){
		// 	$sql = "SELECT * FROM semestre INNER JOIN ;";
		// 	$results = $this->Query($sql);
		// 	return $this->Get_todos_array($results);
		// }

		public function consulta($id){
			$sql = "SELECT * FROM semestre WHERE id_semestre = '$id';";
			$results = $this->Query($sql);
			return $this->Get_array($results);
		}
	}
?>