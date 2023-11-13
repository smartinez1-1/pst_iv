<?php
if(!class_exists("cls_db")) require_once("cls_db.php");

class cls_categorias_documentos extends cls_db{

    private $id_categoria;
    private $des_categoria;
    private $estatus_categoria;
    private $creacion_categoria;

    public function __construct(){
        parent::__construct();
        $this->id_categoria="";
        $this->des_categoria="";
        $this->estatus_categoria="";
        $this->creacion_categoria="";
    }

    public function setDatos($d){
        $this->id_categoria=isset($d['id_categoria']) ? $this->Clean(intval($d['id_categoria'])) : null;
        $this->des_categoria=isset($d['des_categoria']) ? $this->Clean(intval($d['des_categoria'])) : null;
        $this->estatus_categoria=isset($d['estatus_categoria']) ? $this->Clean(intval($d['estatus_categoria'])) : null;
        $this->creacion_categoria=isset($d['creacion_categoria']) ? $this->Clean(intval($d['creacion_categoria'])) : null;
    }

    public function consultarTodoActivo(){
        $sql="SELECT * FROM categorias_documentos WHERE estatus_categoria='1';";
        $results = $this->Query($sql);
        return $this->Get_todos_array($results);
    }

    public function consultarTodo(){
        $sql="SELECT * FROM categorias_documentos;";
        $results = $this->Query($sql);
        return $this->Get_todos_array($results);
    }

    // public function create(){}
    
    // public function update(){}


}

?>