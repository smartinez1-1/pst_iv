<?php

require_once("cls_db.php");

class cls_historial_claves extends cls_db{

    function __construct(
        private $cedula_usuario 
    )
    {
        parent::__construct();   
        $this->$cedula_usuario=$this->Clean(intval( $this->$cedula_usuario));
    }

    function crearRegistro(){
        $sqlConsulta="SELECT * FROM usuario WHERE cedula_usuario='".$this->cedula_usuario."';";

        $result = $this->Query($sqlConsulta);
			
        $respuestaConsulta=[];
	    if($result->num_rows == 1) {
            $respuestaConsulta=$this->Get_todos_array($result);
        }

        if(count($respuestaConsulta)>0){
            $sql="INSERT INTO historial_claves(clave_vieja,cedula_usuario) VALUES('".$respuestaConsulta[0]["clave_usuario"]."','".$this->cedula_usuario."');";
    
            $sql = str_ireplace("''","null",$sql);
                            
            $this->Query($sql);
            if($this->Result_last_query()) return true; else return false;
        }
        else{
            return false;
        }
    }

    function validarClaveHistorial($clave,$cedula){
        $sqlConsulta="SELECT * FROM historial_claves WHERE cedula_usuario='".$cedula."';";
        $result = $this->Query($sqlConsulta);
        $historial=$this->Get_todos_array($result);
        $estado=false;
        for ($index=0; $index < count($historial); $index++) { 
            # code...
            if (password_verify($clave,$historial[$index]["clave_vieja"])){
                $estado=true;
            }
        }
        return $estado;
    }

}


?>