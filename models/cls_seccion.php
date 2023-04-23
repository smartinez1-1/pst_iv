<?php
	if(!class_exists("cls_db")) require_once("cls_db.php");

	class cls_seccion extends cls_db{
		private $id_seccion, $numero_seccion, $estado_seccion;
			public function __construct(){
			parent::__construct();
			$this->id_seccion = $this->numero_seccion = $this->estado_seccion = "";
		}

		public function setDatos($d){
			$this->id_seccion = isset($d['id_seccion']) ? $this->Clean(intval($d['id_seccion'])) : null;
			$this->numero_seccion = isset($d['numero_seccion']) ? $this->Clean($d['numero_seccion']) : null;
      $this->estado_seccion = isset($d['estado_seccion']) ? $this->Clean($d['estado_seccion']) : '';
		}

		public function create(){
			$sqlConsulta = "SELECT * FROM seccion WHERE numero_seccion = '$this->numero_seccion'";
			$result = $this->Query($sqlConsulta);
			
			if($result->num_rows > 0) return "err/02ERR";
			$sql = "INSERT INTO seccion(numero_seccion,estado_seccion) VALUES('$this->numero_seccion','$this->estado_seccion');";
			$this->Query($sql);

			if($this->Result_last_query()) return "msg/01DONE"; else return "err/01ERR";
		}

		public function update(){
			$sqlConsulta = "SELECT * FROM seccion WHERE numero_seccion = '$this->numero_seccion';";
			$result = $this->Query($sqlConsulta);
			
			if($result->num_rows > 0) return "err/02ERR";

			$sql = "UPDATE seccion SET 
				numero_seccion = '$this->numero_seccion',
				estado_seccion = '$this->estado_seccion'
				WHERE id_seccion = $this->id_seccion ;";

      $this->Query($sql);
			return "msg/01DONE";
		}

		public function Get_secciones(){
			$sql = "SELECT * FROM seccion;";
			$results = $this->Query($sql);
			return $this->Get_todos_array($results);
		}

		public function consulta($id){
			$sql = "SELECT * FROM seccion WHERE id_seccion = '$id';";
			$results = $this->Query($sql);
			return $this->Get_array($results);
		}
	}
?>