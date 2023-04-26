<?php
	if(!class_exists("cls_db")) require_once("cls_db.php");

	class cls_inscripcion extends cls_db{
		private $id_inscripcion, $id_carrera, $id_seccion, $id_estudiante, $id_semestre, $id_ano_escolar, $turno;
		public function __construct(){
			parent::__construct();
      $this->id_inscripcion = $this->id_carrera = $this->id_seccion = $this->id_estudiante = $this->id_semestre = $this->id_ano_escolar = $this->turno = "";
		}

		public function setDatos($d){
      $this->id_inscripcion = isset($d['id_inscripcion']) ? $this->Clean(intval($d['id_inscripcion'])) : null;
			$this->id_carrera = isset($d['id_carrera']) ? $this->Clean(intval($d['id_carrera'])) : null;
      $this->id_seccion = isset($d['id_seccion']) ? $this->Clean(intval($d['id_seccion'])) : null;
      $this->id_estudiante = isset($d['id_estudiante']) ? $this->Clean(intval($d['id_estudiante'])) : null;
			$this->id_semestre = isset($d['id_semestre']) ? $this->Clean(intval($d['id_semestre'])) : null;
      $this->id_ano_escolar = isset($d['id_ano_escolar']) ? $this->Clean(intval($d['id_ano_escolar'])) : null;
      $this->turno = isset($d['turno_estudiante']) ? $this->Clean($d['turno_estudiante']) : null;
		}

		public function create(){

      try{
        $sqlConsulta = "SELECT * FROM inscripcion WHERE id_estudiante = '$this->id_estudiante' AND id_ano_escolar = '$this->id_ano_escolar';";
        $result = $this->Query($sqlConsulta);
        
        if($result->num_rows > 0) return "err/02ERR";

        $this->Start_transacction();
        $sql = "INSERT INTO inscripcion(id_carrera,id_seccion,id_estudiante,id_semestre,id_ano_escolar) 
        VALUES('$this->id_carrera','$this->id_seccion','$this->id_estudiante','$this->id_semestre','$this->id_ano_escolar');";
        $this->Query($sql);

        $sql2 = "UPDATE estudiante SET turno_estudiante = '$this->turno' WHERE id_estudiante = '$this->id_estudiante';";
        $this->Query($sql2);
				
        if($this->Result_last_query()){
          $this->End_transacction();
          return "msg/01DONE"; 
        }else{
          $this->Rollback();
          return "err/01ERR";
        }
      }catch (Exception $e) {
        die("AH OCURRIDO UN ERROR: " . $e->getMessage());
      }
		}

		public function update(){
			// $sqlConsulta = "SELECT * FROM seccion WHERE numero_seccion = '$this->numero_seccion';";
			// $result = $this->Query($sqlConsulta);
			
			// if($result->num_rows > 0) return "err/02ERR";
			// numero_seccion = '$this->numero_seccion',
			$sql = "UPDATE seccion SET 
				carrera_id = '$this->carrera_id',
				estado_seccion = '$this->estado_seccion'
				WHERE id_seccion = $this->id_seccion ;";

      $this->Query($sql);
			return "msg/01DONE";
		}

		public function Get_inscripciones(){
			$sql = "SELECT * FROM inscripcion 
				INNER JOIN estudiante ON estudiante.id_estudiante = inscripcion.id_estudiante 
        INNER JOIN ano_escolar ON ano_escolar.id_ano_escolar = inscripcion.id_ano_escolar 
        INNER JOIN carrera ON carrera.id_carrera = inscripcion.id_carrera
        INNER JOIN seccion ON seccion.id_seccion = inscripcion.id_seccion 
				INNER JOIN usuario ON usuario.cedula_usuario = estudiante.cedula_usuario
				WHERE ano_escolar.estado_ano_escolar = 1;";
			$results = $this->Query($sql);
			return $this->Get_todos_array($results);
		}

		public function consulta($id){
			$sql = "SELECT * FROM inscripcion 
				INNER JOIN estudiante ON estudiante.id_estudiante = inscripcion.id_estudiante 
        INNER JOIN ano_escolar ON ano_escolar.id_ano_escolar = inscripcion.id_ano_escolar 
        INNER JOIN carrera ON carrera.id_carrera = inscripcion.id_carrera
        INNER JOIN seccion ON seccion.id_seccion = inscripcion.id_seccion WHERE inscripcion.id_inscripcion = '$id';";
			$results = $this->Query($sql);
			return $this->Get_array($results);
		}

		public function consultaPorSeccion($id){
			$sql = "SELECT * FROM inscripcion 
				INNER JOIN estudiante ON estudiante.id_estudiante = inscripcion.id_estudiante 
				INNER JOIN ano_escolar ON ano_escolar.id_ano_escolar = inscripcion.id_ano_escolar 
				INNER JOIN usuario ON usuario.cedula_usuario = estudiante.cedula_usuario
				WHERE ano_escolar.estado_ano_escolar = 1 AND inscripcion.id_seccion = $id;";
			$results = $this->Query($sql);
			return $this->Get_todos_array($results);
		}
	}
?>