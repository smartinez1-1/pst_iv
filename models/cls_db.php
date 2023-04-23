<?php
    class cls_db{
			private $host, $dbname, $user, $pass, $conexion;
			public function __construct(){
				if(!isset($_SESSION)) session_start();

				$this->host = "localhost";
				$this->dbname = "bd_pst";
				$this->user = "root";
				$this->pass = "";
				$this->Connect();
			}

			private function Connect(){
				$this->conexion = mysqli_connect($this->host, $this->user, $this->pass, $this->dbname);
				if(mysqli_connect_error()) die("NO SE PUEDO CONECTAR A LA BASE DE DATOS: ".mysqli_connect_error());
			}

        // protected function reg_bitacora($datos_array){
        //     $descripcion = $datos_array['des'];
        //     $id_user = $datos_array['user_id'];
        //     $table_name = $datos_array['table_name'];
            
        //     $sql = "INSERT INTO bitacora(descripcion, tabla_change, hora_fecha, id_usuario)
        //         VALUES('$descripcion','$table_name',NOW(),$id_user)";
        //     $this->Query($sql);
        // }

			protected function Query($sql){ $this->Connect(); return mysqli_query($this->conexion, $sql); }
			protected function Start_transacction(){ mysqli_autocommit($this->conexion, false); }
			protected function End_transacction(){ mysqli_commit($this->conexion); }
			protected function Rollback(){ mysqli_rollback($this->conexion); }
			protected function Result_last_query(){ return (mysqli_affected_rows($this->conexion)) ? true : false;}
			protected function Get_array($results){ return mysqli_fetch_array($results); }
			protected function Get_todos_array($results){
				if($results) return mysqli_fetch_all($results, MYSQLI_ASSOC); else return [];
			}
			protected function Returning_id(){ return mysqli_insert_id($this->conexion); }
			protected function Clean($variable){
				$variable = stripslashes($variable);
				$variable = str_ireplace("SELECT * FROM","",$variable);
				$variable = str_ireplace("DELETE * FROM","",$variable);
				$variable = str_ireplace("INSERT INTO","",$variable);
				$variable = str_ireplace("[","",$variable);
				$variable = str_ireplace("]","",$variable);
				$variable = str_ireplace("(","",$variable);
				$variable = str_ireplace(")","",$variable);
				$variable = str_ireplace("{","",$variable);
				$variable = str_ireplace("}","",$variable);
				$variable = str_ireplace("==","",$variable);
				$variable = str_ireplace("=","",$variable);
				$variable = str_ireplace("<script>","",$variable);
				$variable = str_ireplace("<script src= >","",$variable);
				$variable = str_ireplace("src=","",$variable);

				if(!is_numeric($variable)) $variable = strtoupper($variable);
				else $variable = str_ireplace(" ","",$variable);
				return $variable;
			}
			public function __destruct(){ mysqli_close($this->conexion); }
    }
?>
