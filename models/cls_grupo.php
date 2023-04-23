<?php
	if(!class_exists("cls_db")) require_once("cls_db.php");

	class cls_grupo extends cls_db{
		private $id_grupo, $nombre_grupo, $estado_grupo;
			public function __construct(){
			parent::__construct();
			$this->id_grupo = $this->nombre_grupo = $this->estado_grupo = "";
		}

		public function setDatos($d){
			$this->id_grupo = isset($d['id_grupo']) ? $this->Clean(intval($d['id_grupo'])) : null;
			$this->nombre_grupo = isset($d['nombre_grupo']) ? $this->Clean($d['nombre_grupo']) : null;
      $this->estado_grupo = isset($d['estado_grupo']) ? $this->Clean($d['estado_grupo']) : '';
		}

		public function create(){
			$sqlConsulta = "SELECT * FROM grupo WHERE nombre_grupo = '$this->nombre_grupo'";
			$result = $this->Query($sqlConsulta);
			
			if($result->num_rows > 0) return "err/02ERR";
			$sql = "INSERT INTO grupo(nombre_grupo,estado_grupo) VALUES('$this->nombre_grupo','$this->estado_grupo');";
			$this->Query($sql);

			if($this->Result_last_query()) return "msg/01DONE"; else return "err/01ERR";
		}

		public function update(){
			$sqlConsulta = "SELECT * FROM grupo WHERE nombre_grupo = '$this->nombre_grupo' AND estado_grupo = '1';";
			$result = $this->Query($sqlConsulta);
			
			if($result->num_rows > 0) return "err/02ERR";

			$sql = "UPDATE grupo SET 
				nombre_grupo = '$this->nombre_grupo',
				estado_grupo = '$this->estado_grupo'
				WHERE id_grupo = $this->id_grupo ;";

      $this->Query($sql);
			return "msg/01DONE";
		}

		public function Get_grupos(){
			$sql = "SELECT * FROM grupo;";
			$results = $this->Query($sql);
			return $this->Get_todos_array($results);
		}

		public function consulta($id){
			$sql = "SELECT * FROM grupo WHERE id_grupo = '$id';";
			$results = $this->Query($sql);
			return $this->Get_array($results);
		}
	}
?>