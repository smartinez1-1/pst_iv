<?php
	if(!class_exists("cls_db")) require_once("cls_db.php");

	class cls_tutor_comunidad extends cls_db{
		private $id_tutor, $cedula_tutor, $nombre_tutor_comunidad, $telefono_tutor, $id_comunidad;
			public function __construct(){
			parent::__construct();
			$this->id_tutor = $this->cedula_tutor = $this->nombre_tutor_comunidad = $this->telefono_tutor = $this->id_comunidad = "";
		}

		public function setDatos($d){
			$this->id_tutor = isset($d['id_tutor']) ? $this->Clean(intval($d['id_tutor'])) : null;
      $this->cedula_tutor = isset($d['cedula_tutor']) ? $this->Clean($d['cedula_tutor']) : '';
			$this->nombre_tutor_comunidad = isset($d['nombre_tutor_comunidad']) ? $this->Clean($d['nombre_tutor_comunidad']) : null;
      $this->telefono_tutor = isset($d['telefono_tutor']) ? $this->Clean($d['telefono_tutor']) : '';
      $this->id_comunidad = isset($d['id_comunidad']) ? $this->Clean($d['id_comunidad']) : '';
		}

		public function create(){
			$sqlConsulta = "SELECT * FROM tutor_comunidad WHERE id_comunidad = '$this->id_comunidad'";
			$result = $this->Query($sqlConsulta);
			
			if($result->num_rows > 0) return "err/02ERR";
			$sql = "INSERT INTO tutor_comunidad(cedula_tutor,nombre_tutor_comunidad,telefono_tutor,id_comunidad) VALUES('$this->cedula_tutor','$this->nombre_tutor_comunidad','$this->telefono_tutor','$this->id_comunidad');";
			$this->Query($sql);

			if($this->Result_last_query()) return "msg/01DONE"; else return "err/01ERR";
		}

		public function update(){
			$sqlConsulta = "SELECT * FROM tutor_comunidad WHERE nombre_tutor_comunidad = '$this->nombre_tutor_comunidad';";
			$result = $this->Query($sqlConsulta);
			
			if($result->num_rows > 0) return "err/02ERR";

			$sql = "UPDATE tutor_comunidad SET 
				nombre_tutor_comunidad = '$this->nombre_tutor_comunidad',
				telefono_tutor = '$this->telefono_tutor',
        id_comunidad = '$this->id_comunidad'
				WHERE id_tutor = $this->id_tutor ;";

      $this->Query($sql);
			return "msg/01DONE";
		}

		public function Get_tutores_comu(){
			$sql = "SELECT * FROM tutor_comunidad INNER JOIN comunidad ON comunidad.id_comunidad = tutor_comunidad.id_comunidad;";
			$results = $this->Query($sql);
			return $this->Get_todos_array($results);
		}

		public function consulta($id){
			$sql = "SELECT * FROM tutor_comunidad WHERE id_tutor = '$id';";
			$results = $this->Query($sql);
			return $this->Get_array($results);
		}
	}
?>