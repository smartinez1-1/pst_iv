<?php
  if(!class_exists("cls_db")) require_once("cls_db.php");

	class cls_tutor extends cls_db{
		private $id_tutor, $cedula_alumno, $tipo_tutor, $categoria_tutor, $parroquia_id_tutor, $calle_tutor, $avenida_tutor, $sector_tutor;
			public function __construct(){
			parent::__construct();
			$this->id_tutor = $this->cedula_usuario = $this->tipo_tutor = $this->parroquia_id_tutor = $this->calle_tutor = $this->avenida_tutor = $this->sector_tutor = "";
		}

		public function setDatos($d){
			$this->id_tutor = isset($d['id_tutor']) ? $this->Clean(intval($d['id_tutor'])) : null;
			$this->cedula_usuario = isset($d['cedula_usuario']) ? $this->Clean(intval($d['cedula_usuario'])) : null;
			$this->tipo_tutor = isset($d['tipo_tutor']) ? $this->Clean($d['tipo_tutor']) : null;
      $this->categoria_tutor = isset($d['categoria_tutor']) ? $this->Clean($d['categoria_tutor']) : null;
			$this->parroquia_id_tutor = isset($d['id_parroquia']) ? $this->Clean($d['id_parroquia']) : null;
			$this->calle_tutor = isset($d['calle_tutor']) ? $this->Clean($d['calle_tutor']) : null;
			$this->avenida_tutor = isset($d['avenida_tutor']) ? $this->Clean($d['avenida_tutor']) : null;
			$this->sector_tutor = isset($d['sector_tutor']) ? $this->Clean($d['sector_tutor']) : null;
		}

		public function create(){
			$sqlConsulta = "SELECT * FROM tutor WHERE cedula_usuario = $this->cedula_usuario";
			$result = $this->Query($sqlConsulta);

			if($result->num_rows > 0) return "err/02ERR";
			$sql = "INSERT INTO tutor(cedula_usuario,tipo_tutor,categoria_tutor,parroquia_id_tutor,calle_tutor,avenida_tutor,sector_tutor) VALUES('$this->cedula_usuario','$this->tipo_tutor','$this->categoria_tutor',$this->parroquia_id_tutor,'$this->calle_tutor','$this->avenida_tutor','$this->sector_tutor');";
			$this->Query($sql);

			if($this->Result_last_query()) return "msg/01DONE"; else return "err/01ERR";
		}

		public function update(){
			$sql = "UPDATE tutor SET tipo_tutor = '$this->tipo_tutor', categoria_tutor = '$this->categoria_tutor', parroquia_id_tutor = $this->parroquia_id_tutor, calle_tutor = '$this->calle_tutor', avenida_tutor = '$this->avenida_tutor', sector_tutor = '$this->sector_tutor' WHERE id_tutor = $this->id_tutor ;";
      $this->Query($sql);
			return "msg/01DONE";
		}

		public function Get_tutores(){
			$sql = "SELECT * FROM tutor INNER JOIN usuario ON usuario.cedula_usuario = tutor.cedula_usuario";
			$results = $this->Query($sql);
			return $this->Get_todos_array($results);
		}

		public function consulta($id){
			$sql = "SELECT * FROM tutor 
				INNER JOIN usuario ON usuario.cedula_usuario = tutor.cedula_usuario 
				INNER JOIN parroquias ON parroquias.id_parroquia = tutor.parroquia_id_tutor
				INNER JOIN municipios ON municipios.id_municipio = parroquias.id_municipio
				INNER JOIN estados ON estados.id_estado = municipios.id_estado
				WHERE tutor.id_tutor = $id;";
			$results = $this->Query($sql);
			return $this->Get_array($results);
		}
	}
?>