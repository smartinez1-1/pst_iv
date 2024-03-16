<?php
	if(!class_exists("cls_db")) require_once("cls_db.php");

	class cls_lapso_academico extends cls_db{
		private $id_ano_escolar, $ano_escolar_nombre, $fase_ano_escolar, $estado_inscripciones, $estado_ano_escolar, $fecha_inicio, $fecha_cierre;
		public function __construct(){
			parent::__construct();
			$this->id_ano_escolar = $this->ano_escolar_nombre = $this->estado_inscripciones = $this->estado_ano_escolar = $this->fecha_inicio = $this->fecha_cierre = "";
		}

		public function setDatos($d){
			$this->id_ano_escolar = isset($d['id_ano_escolar']) ? $this->Clean(intval($d['id_ano_escolar'])) : null;
			$this->ano_escolar_nombre = isset($d['ano_escolar_nombre']) ? $this->Clean($d['ano_escolar_nombre']) : null;
      $this->estado_inscripciones = isset($d['estado_inscripciones']) ? $this->Clean($d['estado_inscripciones']) : '';
			$this->estado_ano_escolar = isset($d['estado_ano_escolar']) ? $this->Clean($d['estado_ano_escolar']) : '';
			$this->fecha_inicio = isset($d['fecha_inicio']) ? $this->Clean($d['fecha_inicio']) : '';
			$this->fecha_cierre = isset($d['fecha_cierre']) ? $this->Clean($d['fecha_cierre']) : '';
		}

		public function create(){
			// NO PUEDE EXISTIR DOS LAPSOS ESCOLARES CON EL MISMO NOMBRE
			$sqlConsulta = "SELECT * FROM ano_escolar WHERE ano_escolar_nombre = '$this->ano_escolar_nombre'";
			$result = $this->Query($sqlConsulta);
			
			if($result->num_rows > 0) return "err/02ERR";

			// NO PUEDE HABER DOS LAPSOS ESCOLARES ACTIVOS AL MISMO TIEMPO
			$sqlConsult2 = "SELECT * FROM ano_escolar WHERE estado_ano_escolar = '1'";
			$result2 = $this->Query($sqlConsult2);

			if($result2->num_rows > 0) $this->estado_ano_escolar = 0;

			$sql = "INSERT INTO ano_escolar(ano_escolar_nombre,estado_ano_escolar,estado_incripciones,fecha_inicio,fecha_cierre) VALUES('$this->ano_escolar_nombre','$this->estado_ano_escolar','$this->estado_inscripciones','$this->fecha_inicio','$this->fecha_cierre');";
						
			$this->Query($sql);

			if($this->Result_last_query()) return "msg/01DONE"; else return "err/01ERR";
		}

		public function update(){
			// NO SE PUEDEN DUPLICAR DATOS DE DIFERENTES REGISTROS
			$sqlConsulta = "SELECT * FROM ano_escolar WHERE ano_escolar_nombre = '$this->ano_escolar_nombre' AND id_ano_escolar != $this->id_ano_escolar;";
			$result = $this->Query($sqlConsulta);
			
			if($result->num_rows > 0) return "err/02ERR";

			// NO SE PUEDE ACTIVAR UN PERIODO ESCOLAR CUANDO YA HAY OTRO ACTIVO
			if($this->estado_ano_escolar == '1'){
				$sqlConsult2 = "SELECT * FROM ano_escolar WHERE estado_ano_escolar = '1' AND id_ano_escolar != $this->id_ano_escolar;";
				$result2 = $this->Query($sqlConsult2);
			}

			if($result->num_rows > 0) return "err/03ERR";

			$sql = "UPDATE ano_escolar SET 
				ano_escolar_nombre = '$this->ano_escolar_nombre',
				estado_incripciones = '$this->estado_inscripciones',
				estado_ano_escolar = '$this->estado_ano_escolar',
				fecha_inicio = '$this->fecha_inicio',
				fecha_cierre = '$this->fecha_cierre'
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