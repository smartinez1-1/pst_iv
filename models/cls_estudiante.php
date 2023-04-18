<?php
    require_once("m_db.php");

    class m_persona extends m_db{
        private $id_persona, $nom_persona, $sexo_persona, $status_persona, $cedula_persona, $tipo_persona, $telefono_movil_persona, $telefono_casa_persona, $direccion_persona, $correo_persona, $if_proveedor, $if_user, $cargo_id;

        public function __construct(){
            parent::__construct();
            $this->id_persona = $this->nom_persona = $this->status_persona = $this->cedula_persona = $this->tipo_persona = $this->cargo_id = "";
            $this->telefono_movil_persona = $this->telefono_casa_persona = $this->direccion_persona = $this->correo_persona = $this->if_user = $this->status_persona = "";
        }

        public function setDatos($d){
            $this->id_persona = isset($d['id_persona']) ? $this->Clean(intval($d['id_persona'])) : null;
            $this->nom_persona = isset($d['nom_persona']) ? $this->Clean($d['nom_persona']) : null;
            $this->sexo_persona = isset($d['sexo_persona']) ? $this->Clean($d['sexo_persona']) : null;
            $this->status_persona = isset($d['status_persona']) ? $this->Clean(intval($d['status_persona'])) : null;
            $this->cedula_persona = isset($d['cedula_persona']) ? $this->Clean($d['cedula_persona']) : null;
            $this->tipo_persona = isset($d['tipo_persona']) ? $this->Clean($d['tipo_persona']) : null;
            $this->telefono_movil_persona = isset($d['telefono_movil_persona']) ? $this->Clean($d['telefono_movil_persona']) : null;
            $this->telefono_casa_persona = isset($d['telefono_casa_persona']) ? $this->Clean($d['telefono_casa_persona']) : null;
            $this->direccion_persona = isset($d['direccion_persona']) ? $this->Clean($d['direccion_persona']) : null;
            $this->correo_persona = isset($d['correo_persona']) ? $this->Clean($d['correo_persona']) : null; 
            $this->if_proveedor = isset($d['if_proveedor']) ? $d['if_proveedor'] : null;
            $this->if_user = isset($d['if_user']) ? $d['if_user'] : null;
            $this->status_persona =  isset($d['status_persona']) ? $d['status_persona'] : null;
            $this->cargo_id = isset($d['cargo_id']) ? $d['cargo_id'] : null;
        }

        public function Create(){
            $sqlConsulta = "SELECT * FROM personas WHERE cedula_person = $this->cedula_persona";
            $result = $this->Query($sqlConsulta);
            
            if($result->num_rows > 0){
                return "err/02ERR";
            }else{
                $sql = "INSERT INTO personas(id_person,cedula_person,tipo_person,nom_person,sexo_person,telefono_movil_person,telefono_casa_person,direccion_person,correo_person,cargo_id,if_proveedor,if_user,status_person,created_person) 
                VALUES(null,'$this->cedula_persona','$this->tipo_persona','$this->nom_persona', '$this->sexo_persona',
                '$this->telefono_movil_persona','$this->telefono_casa_persona','$this->direccion_persona','$this->correo_persona','$this->cargo_id',$this->if_proveedor,$this->if_user,$this->status_persona, NOW());";
                $this->Query($sql);

                $this->id_persona = $this->Returning_id();                
                
                if(!isset($_SESSION['user_id'])) session_start();
                if($this->Result_last_query()){
                    $this->reg_bitacora([
                        'user_id' => $_SESSION['user_id'],
                        'table_name'=> "PERSONAS",
                        'des' => "REGISTRO DE NUEVO PERSONAS: $this->cedula_persona, NOMBRE: $this->nom_persona, TELEFONO: $this->telefono_movil_persona"
                    ]);
                    return "msg/01DONE";
                }
                else return "err/01ERR";
            }
        }

        public function Update(){
            $sqlConsulta = "SELECT * FROM personas WHERE cedula_person = $this->cedula_persona AND id_person != $this->id_persona;";
            $result = $this->Query($sqlConsulta);

            if($result->num_rows > 0)return ["code" => "error", "message" => "Estas duplicando la informacion de otra persona"];
            else{
                $sql = "UPDATE personas SET nom_person = '$this->nom_persona', sexo_person = '$this->sexo_persona', 
                telefono_movil_person = '$this->telefono_movil_persona', telefono_casa_person = '$this->telefono_casa_persona', 
                direccion_person = '$this->direccion_persona', correo_person = '$this->correo_persona', 
                if_proveedor = '$this->if_proveedor', if_user = '$this->if_user', cargo_id = '$this->cargo_id' WHERE id_person = $this->id_persona ;";
                $this->Query($sql);
                
                if(!isset($_SESSION['user_id'])) session_start();

                $this->reg_bitacora([
                    'user_id' => $_SESSION['user_id'],
                    'table_name'=> "PERSONAS",
                    'des' => "ACTUALIZACIÓN DE PERSONAS: $this->nom_persona, ID DEL CARGO: $this->cargo_id, TELEFONO: $this->telefono_movil_persona"
                ]);
                return ["code" => "success", "message" => "Operación Exitosa"];
                // if($this->Result_last_query()) 
                // else return ["code" => "error", "message" => "Operación Fallida"];
            }
        }

        public function Disable(){
            
            $sql = "UPDATE personas SET status_person = $this->status_persona WHERE id_person = $this->id_persona ;";
            $this->Query($sql);

            if(!isset($_SESSION['user_id'])) session_start();
            
            if($this->Result_last_query()){
              if($this->status_persona == 0) $des_estatus = "DESACTIVACIÓN"; else $des_estatus = "ACTIVACIÓN";
              $this->reg_bitacora([
                'user_id' => $_SESSION['user_id'],
                'table_name'=> "PERSONAS",
                'des' => "$des_estatus DEL PERSONAS: ID => $this->id_persona"
              ]);
      
              return ["code" => "success", "message" => "Operación Exitosa"];
            }
            else return ["code" => "error", "message" => "Operación Fallida"];
        }

        public function Delete(){
            $sqlConsulta = "SELECT * FROM inventario WHERE person_id_invent = $this->id_persona ;";
            $result = $this->Query($sqlConsulta);
            
            if($result->num_rows > 0){
                return ["code" => "error", "message" => "Esta persona no puede ser eliminada de los registros, ya que esta ligada a los registros de inventario"];
            }else{
                $sql = "DELETE FROM personas WHERE id_person = $this->id_persona AND status_person = '0' ;";
                $this->Query($sql);

                if(!isset($_SESSION['user_id'])) session_start();
            
                if($this->Result_last_query()){
                  $this->reg_bitacora([
                    'user_id' => $_SESSION['user_id'],
                    'table_name'=> "PERSONAS",
                    'des' => "ELIMINACIÓN DEL PERSONAS: ID => $this->id_persona"
                  ]);
          
                  return ["code" => "success", "message" => "Operación Exitosa"];
                }
                else return ["code" => "error", "message" => "Operación Fallida"]; 
            }
        }

        public function RegistroMarcasProveedor($marcas){
            $sql = "DELETE FROM proveedor_marca WHERE pro_id_persona =  $this->id_persona ;";
            $this->Query($sql);
            if(isset($marcas[0])){
                foreach($marcas as $marca){
                    $sqlInsert = "INSERT INTO proveedor_marca(pro_id_persona, pro_id_marca) VALUES($this->id_persona, $marca);";
                    $this->Query($sqlInsert);
                }
            }

            if(!isset($_SESSION['user_id'])) session_start();
            $count = sizeof($marcas);

            $this->reg_bitacora([
                'user_id' => $_SESSION['user_id'],
                'table_name'=> "PROOVEDOR_MARCA",
                'des' => "REGISTRO NUEVO PROOVEDOR_MARCA: ID DE LA PERSONA => $this->id_persona, $count MARCAS"
            ]);
        }

        public function GetMarcasProveedor(){
            $sql = "SELECT * FROM proveedor_marca INNER JOIN marca ON marca.id_marca = proveedor_marca.pro_id_marca WHERE proveedor_marca.pro_id_persona = $this->id_persona ;";
            $results = $this->Query($sql);
            return $this->Get_todos_array($results);
        }

        public function Get_todos_personas($status = ''){
            if($status != '') $sql = "SELECT * FROM personas WHERE status_person = '1';"; else $sql = "SELECT * FROM personas LEFT JOIN cargo ON cargo.id_cargo = personas.cargo_id;";            
            $results = $this->query($sql);
            return $this->Get_todos_array($results);
        }

        public function Get_persona(){
            $sql = "SELECT * FROM personas WHERE id_person = $this->id_persona ;";
            $results = $this->Query($sql);
            return $this->Get_array($results);
        }

        public function Get_proveedor(){
            $sql = "SELECT * FROM personas WHERE if_proveedor = '1' AND status_person = '1' ;";
            $results = $this->Query($sql);
            return $this->Get_todos_array($results);
        }

        public function Get_Personas(){
            // NO PROVEDORES
            $sql = "SELECT * FROM personas WHERE status_person = '1' AND tipo_person = 'V' ;";
            $results = $this->Query($sql);
            return $this->Get_todos_array($results);
        }
    }
?>