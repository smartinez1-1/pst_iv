<?php
	require_once("cls_db.php");

	class cls_usuario extends cls_db{
		private $cedula_usuario, $clave_usuario, $nombre_usuario, $estatus_usuario, $nacionalidad, $edad_usuario;
    private $genero_usuario, $permisos_usuario, $tipo_usuario, $telefono_usuario, $correo_usuario;
    private $pregunta1, $pregunta2, $pregunta3, $respuesta1, $respuesta2, $respuesta3;

    public function __construct(){
			parent::__construct();
      $this->cedula_usuario = $this->clave_usuario = $this->nombre_usuario = $this->nacionalidad = $this->estatus_usuario = $this->edad_usuario;
      $this->genero_usuario = $this->permisos_usuario = $this->tipo_usuario = $this->telefono_usuario = $this->correo_usuario;
      $this->pregunta1 = $this->pregunta2 = $this->pregunta3 = $this->respuesta1 = $this->respuesta2 = $this->respuesta3 = "";
		}

		public function setDatos($d){
			$this->cedula_usuario = isset($d['cedula_usuario']) ? $this->Clean(intval($d['cedula_usuario'])) : null;
			$this->clave_usuario = isset($d['clave_usuario']) ? $this->Clean($d['clave_usuario'], false) : $this->cedula_usuario;
			$this->nacionalidad = isset($d['nacionalidad_usuario']) ? $this->Clean($d['nacionalidad_usuario'], false) : null;
      $this->nombre_usuario = isset($d['nombre_usuario']) ? $this->Clean($d['nombre_usuario']) : null;
      $this->genero_usuario = isset($d['genero_usuario']) ? $this->Clean($d['genero_usuario']) : null;
      $this->edad_usuario = isset($d['edad_usuario']) ? $this->Clean(intval($d['edad_usuario'])) : null;
      $this->permisos_usuario = isset($d['permisos_usuario']) ? $this->Clean($d['permisos_usuario']) : null;
      $this->tipo_usuario = isset($d['tipo_usuario']) ? $this->Clean($d['tipo_usuario']) : null;
      $this->telefono_usuario = isset($d['telefono_usuario']) ? $this->Clean($d['telefono_usuario']) : null;
      $this->correo_usuario = isset($d['correo_usuario']) ? $this->Clean($d['correo_usuario']) : null;
      $this->pregunta1 = isset($d['id_pregunta_1']) ? $this->Clean($d['id_pregunta_1']) : null;
      $this->pregunta2 = isset($d['id_pregunta_2']) ? $this->Clean($d['id_pregunta_2']) : null;
      $this->pregunta3 = isset($d['pregunta_3']) ? $this->Clean($d['pregunta_3']) : null;
      $this->respuesta1 = isset($d['respuesta_1']) ? $this->Clean($d['respuesta_1']) : null;
      $this->respuesta2 = isset($d['respuesta_2']) ? $this->Clean($d['respuesta_2']) : null;
      $this->respuesta3 = isset($d['respuesta_3']) ? $this->Clean($d['respuesta_3']) : null;
      $this->estatus_usuario = isset($d['estatus_usuario']) ? $this->Clean($d['estatus_usuario']) : null;
		}

		public function create(){
			$sqlConsulta = "SELECT * FROM usuario WHERE cedula_usuario = '$this->cedula_usuario'";
			$result = $this->Query($sqlConsulta);
			
			if($result->num_rows > 0) return false;
			$pss = $this->clave_usuario;
			$this->clave_usuario = password_hash($this->clave_usuario, PASSWORD_BCRYPT,['cost' => 12]);
			$sql = "INSERT INTO usuario
        (cedula_usuario,clave_usuario,nacionalidad_usuario,nombre_usuario,estatus_usuario,edad_usuario,genero_usuario,permiso_usuario,
        tipo_usuario,telefono_usuario,correo_usuario,id_pregunta_1,id_pregunta_2,pregunta_3,respuesta_1,respuesta_2,respuesta_3) 

        VALUES ('$this->cedula_usuario','$this->clave_usuario','$this->nacionalidad','$this->nombre_usuario',1,'$this->edad_usuario','$this->genero_usuario',
        '$this->permisos_usuario','$this->tipo_usuario','$this->telefono_usuario','$this->correo_usuario',
        '$this->pregunta1','$this->pregunta2','$this->pregunta3','$this->respuesta1','$this->respuesta2','$this->respuesta3');";

			$sql = str_ireplace("''","null",$sql);
						
			$this->Query($sql);
			if($this->Result_last_query()) return true; else return false;
		}

		public function update(){
			//$this->clave_usuario = password_hash($this->clave_usuario, PASSWORD_BCRYPT,['cost' => 12]);
			if($this->clave_usuario != null) $this->updatePassword($this->clave_usuario);
			$sql = "UPDATE usuario SET
				nombre_usuario = '$this->nombre_usuario',
				edad_usuario = '$this->edad_usuario',
				genero_usuario = '$this->genero_usuario',
				correo_usuario = '$this->correo_usuario',
				telefono_usuario = '$this->telefono_usuario',
				estatus_usuario = '1', 

				id_pregunta_1 = '$this->pregunta1',
				id_pregunta_2 = '$this->pregunta2',
				pregunta_3 = '$this->pregunta3',

				respuesta_1 = '$this->respuesta1',
				respuesta_2 = '$this->respuesta2',
				respuesta_3 = '$this->respuesta3'
				
				WHERE cedula_usuario = '$this->cedula_usuario';";
      $this->Query($sql);
			return "msg/01DONE";
		}

		private function updatePassword($password){
			$pass = password_hash($password, PASSWORD_BCRYPT,['cost' => 12]);
			$sql = "UPDATE usuario SET
			clave_usuario = '$pass',
			estatus_usuario = '1' WHERE cedula_usuario = '$this->cedula_usuario';";
			$this->Query($sql);
		}
	}
