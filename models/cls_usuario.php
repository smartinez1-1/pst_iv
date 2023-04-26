<?php
	require_once("cls_db.php");

	class cls_usuario extends cls_db{
		private $cedula_usuario, $clave_usuario, $nombre_usuario, $estatus_usuario, $edad_usuario;
    private $genero_usuario, $permisos_usuario, $tipo_usuario, $telefono_usuario, $correo_usuario;
    private $pregunta1, $pregunta2, $pregunta3, $respuesta1, $respuesta2, $respuesta3;

    public function __construct(){
			parent::__construct();
      $this->cedula_usuario = $this->clave_usuario = $this->nombre_usuario = $this->estatus_usuario = $this->edad_usuario;
      $this->genero_usuario = $this->permisos_usuario = $this->tipo_usuario = $this->telefono_usuario = $this->correo_usuario;
      $this->pregunta1 = $this->pregunta2 = $this->pregunta3 = $this->respuesta1 = $this->respuesta2 = $this->respuesta3 = "";
		}

		public function setDatos($d){
			$this->cedula_usuario = isset($d['cedula_usuario']) ? $this->Clean(intval($d['cedula_usuario'])) : null;
			$this->clave_usuario = isset($d['clave_usuario']) ? $this->Clean($d['clave_usuario']) : null;
      $this->nombre_usuario = isset($d['nombre_usuario']) ? $this->Clean($d['nombre_usuario']) : null;
      $this->genero_usuario = isset($d['genero_usuario']) ? $this->Clean($d['genero_usuario']) : null;
      $this->edad_usuario = isset($d['edad_usuario']) ? $this->Clean(intval($d['edad_usuario'])) : null;
      $this->permisos_usuario = isset($d['permisos_usuario']) ? $this->Clean($d['permisos_usuario']) : null;
      $this->tipo_usuario = isset($d['tipo_usuario']) ? $this->Clean($d['tipo_usuario']) : null;
      $this->telefono_usuario = isset($d['telefono_usuario']) ? $this->Clean($d['telefono_usuario']) : null;
      $this->correo_usuario = isset($d['correo_usuario']) ? $this->Clean($d['correo_usuario']) : null;
      $this->pregunta1 = isset($d['pregunta1']) ? $this->Clean($d['pregunta1']) : null;
      $this->pregunta2 = isset($d['pregunta2']) ? $this->Clean($d['pregunta2']) : null;
      $this->pregunta3 = isset($d['pregunta3']) ? $this->Clean($d['pregunta3']) : null;
      $this->respuesta1 = isset($d['respuesta1']) ? $this->Clean($d['respuesta1']) : null;
      $this->respuesta2 = isset($d['respuesta2']) ? $this->Clean($d['respuesta2']) : null;
      $this->respuesta3 = isset($d['respuesta3']) ? $this->Clean($d['respuesta3']) : null;
      $this->estatus_usuario = isset($d['estatus_usuario']) ? $this->Clean($d['estatus_usuario']) : null;
		}

		public function create(){
			$sqlConsulta = "SELECT * FROM usuario WHERE cedula_usuario = '$this->cedula_usuario'";
			$result = $this->Query($sqlConsulta);
			
			if($result->num_rows > 0) return false;
			$this->clave_usuario = password_hash($this->clave_usuario, PASSWORD_BCRYPT,['cost' => 12]);
			$sql = "INSERT INTO usuario
        (cedula_usuario,clave_usuario,nombre_usuario,estatus_usuario,edad_usuario,genero_usuario,permiso_usuario,
        tipo_usuario,telefono_usuario,correo_usuario,pregunta_1,pregunta_2,pregunta_3,respuesta_1,respuesta_2,respuesta_3) 

        VALUES ('$this->cedula_usuario','$this->clave_usuario','$this->nombre_usuario',1,'$this->edad_usuario','$this->genero_usuario',
        '$this->permisos_usuario','$this->tipo_usuario','$this->telefono_usuario','$this->correo_usuario',
        '$this->pregunta1','$this->pregunta2','$this->pregunta3','$this->respuesta1','$this->respuesta2','$this->respuesta3');";
			
			$this->Query($sql);

			if($this->Result_last_query()) return true; else return false;
		}

		public function update(){
			$sql = "UPDATE usuario SET
				nombre_usuario = '$this->nombre_usuario',
				edad_usuario = '$this->edad_usuario',
				genero_usuario = '$this->genero_usuario',
				correo_usuario = '$this->correo_usuario',
				telefono_usuario = '$this->telefono_usuario',
				estatus_usuario = '1' WHERE cedula_usuario = '$this->cedula_usuario';";
      $this->Query($sql);
			return "msg/01DONE";
		}
	}
?>