<?php
if(!class_exists("cls_db")) require_once("cls_db.php");

class cls_documentos extends cls_db{
    private $id_documento;
    private $nombre_documento;
    private $ruta_file_documento;
    private $categoria_id_documento ;
    private $extension_documento;
    private $fecha_subida_documento;
    private $estatus_documento;

    public function __construct(){
        parent::__construct();
        $this->id_documento="";
        $this->nombre_documento="";
        $this->ruta_file_documento="";
        $this->categoria_id_documento="";
        $this->extension_documento="";
        $this->fecha_subida_documento="";
        $this->estatus_documento="";
    }

    public function setDatos($d){
        $this->id_documento=isset($d['id_documento']) ? $this->Clean(intval($d['id_documento'])) : null;
        $this->nombre_documento=isset($d['nombre_documento']) ? $this->Clean(intval($d['nombre_documento'])) : null;
        $this->nombre_documento=isset($d['nombre_documento']) ? $this->Clean(intval($d['nombre_documento'])) : null;
        $this->ruta_file_documento=isset($d['ruta_file_documento']) ? $this->Clean(intval($d['ruta_file_documento'])) : null;
        $this->categoria_id_documento=isset($d['categoria_id_documento']) ? $this->Clean(intval($d['categoria_id_documento'])) : null;
        $this->extension_documento=isset($d['extension_documento']) ? $this->Clean(intval($d['extension_documento'])) : null;
        $this->fecha_subida_documento=isset($d['fecha_subida_documento']) ? $this->Clean(intval($d['fecha_subida_documento'])) : null;
        $this->estatus_documento=isset($d['estatus_documento']) ? $this->Clean(intval($d['estatus_documento'])) : null;
    }

}

?>