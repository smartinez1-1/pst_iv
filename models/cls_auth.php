<?php
  if(!class_exists("cls_db")) require("cls_db.php");

  class cls_auth extends cls_db{
    private $cedula_usuario, $cedula, $clave_usuario, $pregunta1, $pregunta2, $pregunta3, $respuesta1, $respuesta2, $respuesta3;

    public function __construct(){
      parent::__construct();
      $this->cedula_usuario = null;
      $this->cedula = null;
      $this->clave_usuario = null;
      $this->pregunta1 = null;
      $this->pregunta2 = null;
      $this->respuesta1 = null;
      $this->respuesta2 = null;
    }
    
    public function SetDatos($d){
      $this->cedula_usuario = isset($d['cedula_usuario']) ? $d['cedula_usuario'] : null;
      $this->clave_usuario = isset($d['clave_usuario']) ? $d['clave_usuario'] : null;
      $this->pregunta1 = isset($d['pregunta1']) ? $d['pregunta1'] : null;
      $this->pregunta2 = isset($d['pregunta2']) ? $d['pregunta2'] : null;
      $this->pregunta3 = isset($d['pregunta3']) ? $d['pregunta3'] : null;
      $this->respuesta1 = isset($d['respuesta1']) ? strtoupper($d['respuesta1']) : null;
      $this->respuesta2 = isset($d['respuesta2']) ? strtoupper($d['respuesta2']) : null;
      $this->respuesta3 = isset($d['respuesta3']) ? strtoupper($d['respuesta3']) : null;
    }
    
    public function Login(){
      $res = $this->Query("SELECT * FROM usuario WHERE cedula_usuario = '$this->cedula_usuario' ;");
      
      if($res->num_rows > 0){
        $datos = $this->Get_array($res);
        if($datos['estatus_usuario'] === "0") return [false,"err/06AUTH"];
        
        if(password_verify($this->clave_usuario, $datos['clave_usuario'])){
          session_start();
          $_SESSION['cedula'] = $datos['cedula_usuario'];
          $_SESSION['username'] = $datos['nombre_usuario'];
          $_SESSION['permisos'] = $datos['permiso_usuario'];
          $_SESSION['nom_rol'] = $datos['tipo_usuario'];
          
          return [true,'msg/01AUTH'];
        }
        // if($datos['id_rol'] != 1) $this->intentos($datos['id_user']);
        return [false,'err/07AUTH'];
      }
      else return [false,"err/05AUTH"];
      
    }

    public function consulta($id){
			$sqlConsulta = "SELECT * FROM usuario WHERE cedula_usuario = '$id'";
			$result = $this->Query($sqlConsulta);
			return $this->Get_array($result);
		}

    public function ValidaPreguntas($d){
      $rp1 = strtoupper($d['respuesta_1']);
      $rp2 = strtoupper($d['respuesta_2']);
      $rp3 = strtoupper($d['respuesta_3']);
      $cedula = $d['cedula_usuario'];
      $sql = "SELECT cedula_usuario FROM usuario WHERE respuesta_1 = '$rp1' AND respuesta_2 = '$rp2' AND respuesta_3 = '$rp3' AND cedula_usuario = '$cedula';";

      $result = $this->Query($sql);
      return $this->Get_array($result);
    }

    public function ChangePsw($d){
      $clave_usuario = password_hash($d['clave_usuario'], PASSWORD_BCRYPT,['cost' => 12]);
      $cedula = $d['cedula_usuario'];
      $sql = "UPDATE usuario SET clave_usuario = '$clave_usuario' WHERE cedula_usuario = '$cedula';";

      $result = $this->Query($sql);
      return true;
    }
  }