<?php
	if(!class_exists("cls_db")) require_once("cls_db.php");
  // id_proyecto	id_comunidad	id_grupo	id_ano_escolar	id_tutor	titulo_proyecto	plantamiento_proyecto	objetivos_generales_proyecto	
  // objetivos_espesificos_proyecto	tipo_proyecto	estado_proyecto	
	class cls_proyecto extends cls_db{
		private $id_proyecto, $id_comunidad, $id_grupo, $id_ano_escolar, $titulo_proyecto, $planteamiento_proyecto, 
		$objetivos_generales_proyecto, $objetivos_especificos_proyecto, $tipo_proyecto, $estado_proyecto;
			public function __construct(){
			parent::__construct();
			$this->id_proyecto = $this->id_comunidad = $this->id_grupo = $this->id_ano_escolar = $this->titulo_proyecto = $this->planteamiento_proyecto =
			$this->objetivos_generales_proyecto = $this->objetivos_especificos_proyecto = $this->tipo_proyecto = $this->estado_proyecto = null;
		}

		public function setDatos($d){
			$this->id_proyecto = isset($d['id_proyecto']) ? $this->Clean(intval($d['id_proyecto'])) : null;
			$this->id_comunidad = isset($d['id_comunidad']) ? $this->Clean(intval($d['id_comunidad'])) : null;
			$this->id_grupo = isset($d['id_grupo']) ? $this->Clean(intval($d['id_grupo'])) : null;
			$this->id_ano_escolar = isset($d['id_ano_escolar']) ? $this->Clean(intval($d['id_ano_escolar'])) : null;
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
				id_comunidad,id_grupo,id_ano_escolar,titulo_proyecto,planteamiento_proyecto,
				objetivos_generales_proyecto,objetivos_especificos_proyecto,tipo_proyecto,estado_proyecto) 
				VALUES('$this->id_comunidad','$this->id_grupo','$this->id_ano_escolar','$this->titulo_proyecto','$this->planteamiento_proyecto',
				'$this->objetivos_generales_proyecto','$this->objetivos_especificos_proyecto','$this->tipo_proyecto','$this->estado_proyecto');";
			$this->Query($sql);

			if($this->Result_last_query()) return "msg/01DONE"; else return "err/01ERR";
		}

		public function update(){
			$sqlConsulta = "SELECT * FROM proyecto WHERE titulo_proyecto = '$this->titulo_proyecto' AND id_ano_escolar = '$this->id_ano_escolar' AND id_comunidad = '$this->id_comunidad';";
			$result = $this->Query($sqlConsulta);
			if($result->num_rows > 0) return "err/02ERR";

			// numero_proyecto = '$this->numero_proyecto',
			$sql = "UPDATE proyecto SET 
				id_comunidad = '$this->id_comunidad',
				id_grupo = '$this->id_grupo',
				id_ano_escolar = '$this->id_ano_escolar',
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
			 	WHERE carrera.id_carrera = '$id';";
			$results = $this->Query($sql);
			return $this->Get_todos_array($results);
		}
	}
?>