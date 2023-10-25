<?php
  require_once("./controllers/reportes_controller.php");
  require_once("./models/cls_proyecto.php");
  // rp_proyectos();
  $model = new cls_proyecto();
  $datos = $model->consultaPdfProyecto($this->id_consulta);

  if($datos){
    rp_inscripcion($datos);
  }else{
    ?>
      <script>
        alert("El registro a consultar no existe o su id es incorrecto");
      </script>
    <?php
  }  
?>