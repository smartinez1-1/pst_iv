<?php
	if(!class_exists("cls_db")) require_once("cls_db.php");

	class cls_estudiante extends cls_db{
		private $id_estudiante, $cedula_usuario, $turno_estudiante;
			public function __construct(){
			parent::__construct();
			$this->id_estudiante = $this->cedula_usuario = $this->turno_estudiante = "";
		}

		public function setDatos($d){
			$this->id_estudiante = isset($d['id_estudiante']) ? $this->Clean(intval($d['id_estudiante'])) : null;
			$this->cedula_usuario = isset($d['cedula_usuario']) ? $this->Clean(intval($d['cedula_usuario'])) : null;
			$this->turno_estudiante = isset($d['turno_estudiante']) ? $this->Clean($d['turno_estudiante']) : '';
		}

		public function create(){
			$sqlConsulta = "SELECT * FROM estudiante WHERE cedula_usuario = '$this->cedula_usuario'";
			$result = $this->Query($sqlConsulta);
			
			if($result->num_rows > 0) return "err/02ERR";
			$sql = "INSERT INTO estudiante(cedula_usuario,turno_estudiante) VALUES('$this->cedula_usuario','$this->turno_estudiante');";
			$this->Query($sql);

			if($this->Result_last_query()) return "msg/01DONE"; else return "err/01ERR";
		}

		// public function update(){
		// 	$sql = "UPDATE estudiante SET turno_estudiante = '$this->turno_estudiante' WHERE id_estudiante = $this->id_estudiante ;";
    //   $this->Query($sql);
		// 	return "msg/01DONE";
		// }

		public function Get_estudiantes($condicion = ''){
			if($condicion == '') $sql = "SELECT * FROM estudiante INNER JOIN usuario ON usuario.cedula_usuario = estudiante.cedula_usuario";
			if($condicion == 'NO-INS') $sql = "SELECT * FROM estudiante INNER JOIN usuario ON usuario.cedula_usuario = estudiante.cedula_usuario WHERE NOT EXISTS (SELECT * FROM inscripcion WHERE estudiante.id_estudiante = inscripcion.id_alumno);";
			
			$results = $this->Query($sql);
			return $this->Get_todos_array($results);
		}

		public function consulta($id){
			$sql = "SELECT * FROM estudiante INNER JOIN usuario ON usuario.cedula_usuario = estudiante.cedula_usuario WHERE estudiante.id_estudiante = $id;";
			$results = $this->Query($sql);
			return $this->Get_array($results);
		}
	}
?>