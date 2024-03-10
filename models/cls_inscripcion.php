<?php
	if(!class_exists("cls_db")) require_once("cls_db.php");

	class cls_inscripcion extends cls_db{
		private $id_inscripcion, $id_carrera, $id_seccion, $id_estudiante, $id_semestre, $id_ano_escolar, $turno, $des_semestre;
		public function __construct(){
			parent::__construct();
      $this->id_inscripcion = $this->id_carrera = $this->id_seccion = $this->id_estudiante = $this->id_semestre = $this->id_ano_escolar = $this->turno = $this->des_semestre = "";
		}

		public function setDatos($d){
      $this->id_inscripcion = isset($d['id_inscripcion']) ? $this->Clean(intval($d['id_inscripcion'])) : null;
			$this->id_carrera = isset($d['id_carrera']) ? $this->Clean(intval($d['id_carrera'])) : null;
      $this->id_seccion = isset($d['id_seccion']) ? $this->Clean(intval($d['id_seccion'])) : null;
      $this->id_estudiante = isset($d['id_estudiante']) ? $this->Clean(intval($d['id_estudiante'])) : null;
			$this->id_semestre = isset($d['id_semestre']) ? $this->Clean(intval($d['id_semestre'])) : null;
			$this->des_semestre = isset($d['des_semestre']) ? $this->Clean(intval($d['des_semestre'])) : null;
      $this->id_ano_escolar = isset($d['id_ano_escolar']) ? $this->Clean(intval($d['id_ano_escolar'])) : null;
      $this->turno = isset($d['turno_estudiante']) ? $this->Clean($d['turno_estudiante']) : null;
		}

		public function create(){

      try{

				$this->verificarMatricula();
				// la matricula es
				// lapso academico-numero de la carrera+turno-nacionalidad-numero de cédula
        $sqlConsulta = "SELECT * FROM inscripcion WHERE id_estudiante = '$this->id_estudiante' AND id_ano_escolar = '$this->id_ano_escolar';";
        $result = $this->Query($sqlConsulta);
        if($result->num_rows > 0) return "err/02ERR";

        $this->Start_transacction();

        $sql = "INSERT INTO inscripcion(id_carrera,id_seccion,id_estudiante,id_ano_escolar,des_semestre) 
        VALUES('$this->id_carrera','$this->id_seccion','$this->id_estudiante','$this->id_ano_escolar','$this->des_semestre');";
        if(!$this->Query($sql)){
					$this->Rollback();
					return "err/01ERR"; 
				}

				// $sqlCon = "SELECT * FROM estudiante WHERE id_estudiante = '$this->id_estudiante' AND turno_estudiante <> '$this->turno';";
				// $result2 = $this->Query($sqlCon);

        $sql2 = "UPDATE estudiante SET turno_estudiante = '$this->turno' WHERE id_estudiante = '$this->id_estudiante' AND turno_estudiante <> '$this->turno';";
        if($this->Query($sql2)){
					$this->End_transacction();
					return "msg/01DONE"; 
				}
				
      }catch (Exception $e) {
        die("AH OCURRIDO UN ERROR: " . $e->getMessage());
      }
		}

		public function verificarMatricula(){
			try{
				$res = $this->Query("SELECT * FROM estudiante WHERE id_estudiante = $this->id_estudiante");
				if($res->num_rows > 0){
					$result = $this->Get_array($res);
					
					if(!isset($result['matricula_estudiante'])){
						$matricula = $this->makeCodeMatricula($result['cedula_usuario']);
						$sql2 = $this->Query("UPDATE estudiante SET matricula_estudiante = '$matricula' WHERE id_estudiante = '$this->id_estudiante'");
						if($sql2->num_rows > 0) return true; else return false;
					}

					return true;
				}

				return true;
			}catch (Exception $e){
				die("ERROR: ". $e->getMessage());
			}
		}

		private function makeCodeMatricula($cedula){
			try{
				$lapso = $this->getData("SELECT * FROM ano_escolar WHERE id_ano_escolar = '$this->id_ano_escolar';")['ano_escolar_nombre'];
				$carrera = $this->getData("SELECT * FROM carrera WHERE id_carrera = '$this->id_carrera';")['codigo_carrera'];
				$nacionalidad = $this->getData("SELECT * FROM usuario WHERE cedula_usuario = '$cedula';")['nacionalidad_usuario'];

				$matricula = $lapso."-".$carrera.$this->turno."-".$nacionalidad."-".$cedula;
				return $matricula;
			}catch (Exception $e){
				die("ERROR: ". $e->getMessage());
			}
		}

		private function getData($sql){
			$results = $this->Query($sql);
			return $this->Get_array($results);
		}

		public function update(){
			// $sqlConsulta = "SELECT * FROM seccion WHERE numero_seccion = '$this->numero_seccion';";
			// $result = $this->Query($sqlConsulta);
			
			// if($result->num_rows > 0) return "err/02ERR";
			// numero_seccion = '$this->numero_seccion',
			$sql = "UPDATE inscripcion SET 
				id_carrera = '$this->id_carrera',
				id_seccion = '$this->id_seccion'
				WHERE id_inscripcion = $this->id_inscripcion ;";

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

		public function Get_estudiantes(){
			$sql = "SELECT estudiante.id_estudiante, estudiante.matricula_estudiante, estudiante.cedula_usuario, usuario.nombre_usuario,
				usuario.nacionalidad_usuario, inscripcion.id_inscripcion, carrera.*, seccion.*, ano_escolar.* FROM estudiante
				LEFT JOIN(SELECT id_estudiante, MAX(id_inscripcion) AS max_id_inscripcion FROM inscripcion GROUP BY id_estudiante) AS max_inscripcion ON 
					estudiante.id_estudiante = max_inscripcion.id_estudiante
				LEFT JOIN inscripcion ON max_inscripcion.max_id_inscripcion = inscripcion.id_inscripcion
				LEFT JOIN ano_escolar ON ano_escolar.id_ano_escolar = inscripcion.id_ano_escolar
				LEFT JOIN carrera ON carrera.id_carrera = inscripcion.id_carrera
				LEFT JOIN seccion ON seccion.id_seccion = inscripcion.id_seccion
				INNER JOIN usuario ON usuario.cedula_usuario = estudiante.cedula_usuario
				GROUP BY estudiante.id_estudiante;";
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

		public function consultar_inscripcion($cedula, $filtro = ''){
			if($filtro == 'NOW') $con = "ano_escolar.estado_ano_escolar = 1 AND"; 
			if($filtro == 'BEFORE') $con = "ano_escolar.estado_ano_escolar = 0 AND";
			if($filtro == "ALL") $con = '';

			$sql = "SELECT * FROM inscripcion 
				INNER JOIN estudiante ON estudiante.id_estudiante = inscripcion.id_estudiante 
        INNER JOIN ano_escolar ON ano_escolar.id_ano_escolar = inscripcion.id_ano_escolar 
        INNER JOIN carrera ON carrera.id_carrera = inscripcion.id_carrera
        INNER JOIN seccion ON seccion.id_seccion = inscripcion.id_seccion 
				INNER JOIN usuario ON usuario.cedula_usuario = estudiante.cedula_usuario
				WHERE $con estudiante.cedula_usuario = '$cedula';";

			$results = $this->Query($sql);
			return $this->Get_todos_array($results);
		}
	}
?>