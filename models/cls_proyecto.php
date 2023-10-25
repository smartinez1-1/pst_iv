<?php
	if(!class_exists("cls_db")) require_once("cls_db.php");
  // id_proyecto	id_comunidad	id_grupo	id_ano_escolar	id_tutor	titulo_proyecto	plantamiento_proyecto	objetivos_generales_proyecto	
  // objetivos_espesificos_proyecto	tipo_proyecto	estado_proyecto	
	class cls_proyecto extends cls_db{
		private $id_proyecto, $id_comunidad, $id_grupo, $id_ano_escolar, $id_tutor, $titulo_proyecto, $planteamiento_proyecto, 
		$objetivos_generales_proyecto, $objetivos_especificos_proyecto, $tipo_proyecto, $estado_proyecto;
			public function __construct(){
			parent::__construct();
			$this->id_proyecto = $this->id_comunidad = $this->id_grupo = $this->id_ano_escolar = $this->id_tutor = $this->titulo_proyecto = $this->planteamiento_proyecto =
			$this->objetivos_generales_proyecto = $this->objetivos_especificos_proyecto = $this->tipo_proyecto = $this->estado_proyecto = null;
		}

		public function setDatos($d){
			$this->id_proyecto = isset($d['id_proyecto']) ? $this->Clean(intval($d['id_proyecto'])) : null;
			$this->id_comunidad = isset($d['id_comunidad']) ? $this->Clean(intval($d['id_comunidad'])) : null;
			$this->id_grupo = isset($d['id_grupo']) ? $this->Clean(intval($d['id_grupo'])) : null;
			$this->id_ano_escolar = isset($d['id_ano_escolar']) ? $this->Clean(intval($d['id_ano_escolar'])) : null;
			$this->id_tutor = isset($d['id_tutor']) ? $this->Clean(intval($d['id_tutor'])) : null;
			$this->titulo_proyecto = isset($d['titulo_proyecto']) ? $this->Clean($d['titulo_proyecto']) : null;
			$this->planteamiento_proyecto = isset($d['planteamiento_proyecto']) ? $this->Clean($d['planteamiento_proyecto']) : null;
			$this->objetivos_generales_proyecto = isset($d['objetivos_generales_proyecto']) ? $this->Clean($d['objetivos_generales_proyecto']) : null;
			$this->objetivos_especificos_proyecto = isset($d['objetivos_especificos_proyecto']) ? $this->Clean($d['objetivos_especificos_proyecto']) : null;
			$this->tipo_proyecto = isset($d['tipo_proyecto']) ? $this->Clean($d['tipo_proyecto']) : null;
      $this->estado_proyecto = isset($d['estado_proyecto']) ? $this->Clean($d['estado_proyecto']) : '';
		}

		public function create(){
			$sqlConsulta = "SELECT * FROM proyecto WHERE titulo_proyecto = '$this->titulo_proyecto' AND id_ano_escolar = '$this->id_ano_escolar' AND id_comunidad = '$this->id_comunidad';";
			$result = $this->Query($sqlConsulta);
			
			if($result->num_rows > 0) return "err/02ERR";
			$sql = "INSERT INTO proyecto(
				id_comunidad,id_grupo,id_ano_escolar,id_tutor,titulo_proyecto,planteamiento_proyecto,
				objetivos_generales_proyecto,objetivos_especificos_proyecto,tipo_proyecto,estado_proyecto) 
				VALUES('$this->id_comunidad','$this->id_grupo','$this->id_ano_escolar','$this->id_tutor','$this->titulo_proyecto','$this->planteamiento_proyecto',
				'$this->objetivos_generales_proyecto','$this->objetivos_especificos_proyecto','$this->tipo_proyecto','$this->estado_proyecto');";

			$this->Query($sql);

			if($this->Result_last_query()) return "msg/01DONE"; else return "err/01ERR";
		}

		public function update(){
			$sqlConsulta = "SELECT * FROM proyecto WHERE 
				titulo_proyecto = '$this->titulo_proyecto' AND 
				id_ano_escolar = '$this->id_ano_escolar' AND 
				planteamiento_proyecto = '$this->planteamiento_proyecto' AND
				objetivos_generales_proyecto = '$this->objetivos_generales_proyecto' AND
				objetivos_especificos_proyecto = '$this->objetivos_especificos_proyecto' AND
				tipo_proyecto = '$this->tipo_proyecto' AND
				id_comunidad = '$this->id_comunidad';";
			$result = $this->Query($sqlConsulta);
			if($result->num_rows > 0) return "err/02ERR";

			// numero_proyecto = '$this->numero_proyecto',
			$sql = "UPDATE proyecto SET 
				id_comunidad = '$this->id_comunidad',
				id_grupo = '$this->id_grupo',
				id_ano_escolar = '$this->id_ano_escolar',
				id_tutor = '$this->id_tutor',
				titulo_proyecto = '$this->titulo_proyecto',
				planteamiento_proyecto = '$this->planteamiento_proyecto',
				objetivos_generales_proyecto = '$this->objetivos_generales_proyecto',
				objetivos_especificos_proyecto = '$this->objetivos_especificos_proyecto',
				tipo_proyecto = '$this->tipo_proyecto',
				estado_proyecto = '$this->estado_proyecto'
				WHERE id_proyecto = $this->id_proyecto ;";

      $this->Query($sql);
			return "msg/01DONE";
		}

		public function Get_proyectos(){
			$sql = "SELECT * FROM proyecto 
				INNER JOIN ano_escolar ON ano_escolar.id_ano_escolar = proyecto.id_ano_escolar
				INNER JOIN comunidad ON comunidad.id_comunidad = proyecto.id_comunidad
				INNER JOIN grupo ON grupo.id_grupo = proyecto.id_grupo
				INNER JOIN seccion ON seccion.id_seccion = grupo.id_seccion
				INNER JOIN carrera ON carrera.id_carrera = seccion.carrera_id;";
			$results = $this->Query($sql);
			return $this->Get_todos_array($results);
		}

		public function consulta($id){
			$sql = "SELECT * FROM proyecto WHERE id_proyecto = '$id';";
			$results = $this->Query($sql);
			return $this->Get_array($results);
		}

		public function consultaPorCarrera($id){
			$sql = "SELECT * FROM proyecto
				INNER JOIN grupo ON grupo.id_grupo = proyecto.id_grupo
				INNER JOIN seccion ON seccion.id_seccion = grupo.id_seccion
				INNER JOIN carrera ON carrera.id_carrera = seccion.carrera_id
				INNER JOIN comunidad ON comunidad.id_comunidad = proyecto.id_comunidad
			 	WHERE carrera.id_carrera = '$id';";
			$results = $this->Query($sql);
			return $this->Get_todos_array($results);
		}

		public function consultaPdfProyecto($id){
			$sql_pr = "SELECT * FROM proyecto 
				INNER JOIN ano_escolar ON ano_escolar.id_ano_escolar = proyecto.id_ano_escolar
				INNER JOIN comunidad ON comunidad.id_comunidad = proyecto.id_comunidad
				INNER JOIN tutor_comunidad ON comunidad.id_comunidad = tutor_comunidad.id_comunidad
				INNER JOIN tutor ON tutor.id_tutor = proyecto.id_tutor WHERE proyecto.id_proyecto = '$id';";
			$results_pr = $this->Query($sql_pr);

			$datos_proyecto =  $this->Get_array($results_pr);
			if(!isset($datos_proyecto)) return false;

			$id_grupo = $datos_proyecto['id_grupo'];

			$sql_est = "SELECT * FROM grupo_alumno 
				INNER JOIN estudiante ON estudiante.id_estudiante = grupo_alumno.id_alumno
				INNER JOIN usuario ON usuario.cedula_usuario = estudiante.cedula_usuario 
				INNER JOIN inscripcion ON inscripcion.id_estudiante = estudiante.id_estudiante
				INNER JOIN carrera ON carrera.id_carrera = inscripcion.id_carrera
				INNER JOIN semestre ON semestre.id_semestre = inscripcion.id_semestre 
				WHERE grupo_alumno.id_grupo = '$id_grupo';";
			$results_est = $this->Query($sql_est);
			$datos_estudiantes = $this->Get_todos_array($results_est);

			return [$datos_proyecto, $datos_estudiantes];
		}

		public function consultaPdfWithFiltros($filtros){
			$filtro = $filtros['filtro_lapsos'];
			$carreras = $filtros['filtro_carreras'];
			$tipos = $filtros['tipo_proyecto'];
			$where = "WHERE";
			$d_proyectos = [];

			if($filtro == "All_lapsos"){
				$where .= " ano_escolar.id_ano_escolar != '' ";
			}else $where .= " ano_escolar.id_ano_escolar = $filtro ";

			if($carreras == "All_carreras"){
				$where .= " AND carrera.id_carrera != '' ";
			}else $where .= " AND carrera.id_carrera = '$carreras' ";

			if($tipos == "All_proyectos"){
				$where .= " AND proyecto.tipo_proyecto != '' ";
			}else $where .= " AND proyecto.tipo_proyecto = '$tipos' ";

			$sql = "SELECT * FROM proyecto
				INNER JOIN ano_escolar ON ano_escolar.id_ano_escolar = proyecto.id_ano_escolar
				INNER JOIN comunidad ON comunidad.id_comunidad = proyecto.id_comunidad 
				INNER JOIN tutor_comunidad ON comunidad.id_comunidad = tutor_comunidad.id_comunidad
				INNER JOIN tutor ON tutor.id_tutor = proyecto.id_tutor
				INNER JOIN usuario ON usuario.cedula_usuario = tutor.cedula_usuario
				INNER JOIN grupo ON grupo.id_grupo = proyecto.id_grupo
				INNER JOIN grupo_alumno ON grupo_alumno.id_grupo = grupo.id_grupo
				INNER JOIN estudiante ON estudiante.id_estudiante = grupo_alumno.id_alumno
				INNER JOIN inscripcion ON inscripcion.id_estudiante = estudiante.id_estudiante
				INNER JOIN carrera ON carrera.id_carrera = inscripcion.id_carrera $where GROUP BY proyecto.id_proyecto";
			
			$results_pt = $this->Query($sql);
			$d_pt = $this->Get_todos_array($results_pt);
			
			foreach($d_pt as $d){
				$id_grupo = $d['id_grupo'];
				$sql = "SELECT * FROM grupo_alumno 
				INNER JOIN estudiante ON estudiante.id_estudiante = grupo_alumno.id_alumno 
				INNER JOIN inscripcion ON inscripcion.id_estudiante = estudiante.id_estudiante
				INNER JOIN carrera ON carrera.id_carrera = inscripcion.id_carrera
				INNER JOIN seccion ON seccion.id_seccion = inscripcion.id_seccion
				INNER JOIN semestre ON semestre.id_semestre = inscripcion.id_semestre
				INNER JOIN usuario ON usuario.cedula_usuario = estudiante.cedula_usuario WHERE grupo_alumno.id_grupo = '$id_grupo';";
				$results = $this->Query($sql);
				$estudiantes = $this->Get_todos_array($results);
				array_push($d_proyectos, [
					'pt' => $d,
					'estu' => $estudiantes
				]);
			}

			return $d_proyectos;
		}
	}
?>