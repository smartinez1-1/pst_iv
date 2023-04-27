<?php
	if(!class_exists("cls_db")) require_once("cls_db.php");

	class cls_grupo extends cls_db{
		private $id_grupo, $nombre_grupo, $id_seccion, $estudiante, $estado_grupo;
			public function __construct(){
			parent::__construct();
			$this->id_grupo = $this->nombre_grupo = $this->id_seccion = $this->estudiantes = $this->estado_grupo = "";
		}

		public function setDatos($d){
			$this->id_grupo = isset($d['id_grupo']) ? $this->Clean(intval($d['id_grupo'])) : null;
			$this->nombre_grupo = isset($d['nombre_grupo']) ? $this->Clean($d['nombre_grupo']) : null;
			$this->id_seccion = isset($d['id_seccion']) ? $this->Clean(intval($d['id_seccion'])) : null;
      $this->estado_grupo = isset($d['estado_grupo']) ? $this->Clean($d['estado_grupo']) : '';
			$this->estudiantes = isset($d['id_estudiante']) ? $d['id_estudiante'] : '';
		}

		public function create(){
			$sqlConsulta = "SELECT * FROM grupo WHERE nombre_grupo = '$this->nombre_grupo' AND estado_grupo = '1'";
			$result = $this->Query($sqlConsulta);
			
			if($result->num_rows > 0) return "err/02ERR";

			try{
				$this->Start_transacction();
				$sql = "INSERT INTO grupo(nombre_grupo,id_seccion,estado_grupo) VALUES('$this->nombre_grupo','$this->id_seccion','$this->estado_grupo');";
				$this->Query($sql);

				$id = $this->Returning_id();
				foreach($this->estudiantes as $est) $this->Query("INSERT INTO grupo_alumno(id_grupo, id_alumno) VALUES('$id','$est');");

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
			$sqlConsulta = "SELECT * FROM grupo WHERE nombre_grupo = '$this->nombre_grupo' AND estado_grupo = '1';";
			$result = $this->Query($sqlConsulta);
			
			if($result->num_rows > 0) return "err/02ERR";
      
			try{
				$this->Start_transacction();
				$sql = "UPDATE grupo SET nombre_grupo = '$this->nombre_grupo', id_seccion = '$this->id_seccion', estado_grupo = '$this->estado_grupo' WHERE id_grupo = $this->id_grupo ;";
				$this->Query($sql);
				
				foreach($this->estudiantes as $est){
					$this->Query("DELETE FROM grupo_alumno WHERE id_grupo = '$this->id_grupo';");
					$this->Query("INSERT INTO grupo_alumno(id_grupo, id_alumno) VALUES('$this->id_grupo','$est');");
				}

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

		public function Get_grupos(){
			$sql = "SELECT grupo.*,COUNT(grupo_alumno.id_grupo) AS cantidad FROM grupo INNER JOIN grupo_alumno ON grupo_alumno.id_grupo = grupo.id_grupo;";
			$results = $this->Query($sql);
			$d = $this->Get_todos_array($results);
			if($d[0]['cantidad'] > 0) return $d; else return [];
		}

		public function consulta($id){
			$sql = "SELECT * FROM grupo INNER JOIN seccion ON seccion.id_seccion = grupo.id_seccion WHERE grupo.id_grupo = '$id';";

			$results = $this->Query($sql);
			return $this->Get_array($results);
		}

		public function Get_estudiasntes_grup($id){
			$sql = "SELECT * FROM grupo_alumno WHERE id_grupo = '$id';";
			$results = $this->Query($sql);
			return $this->Get_todos_array($results);
		}

		public function consultar_grupo($cedula){
			$sql = "SELECT grupo.id_grupo FROM grupo_alumno INNER JOIN estudiante ON estudiante.id_estudiante = grupo_alumno.id_alumno
				INNER JOIN grupo On grupo.id_grupo = grupo_alumno.id_grupo WHERE grupo.estado_grupo = 1 AND estudiante.cedula_usuario = '$cedula';";

			$results = $this->Query($sql);
			return $this->Get_array($results);
		}
	}
?>