<script defer src="<?php echo constant("URL");?>views/js/bundle.js"></script>
<script src="<?php echo constant("URL");?>views/js/sweetalert.js"></script>
<script src="<?php echo constant("URL");?>views/js/vue.js"></script>
<script src="<?php echo constant("URL");?>views/js/input_mask.js"></script>
<script src="<?php echo constant("URL");?>views/jQuery/jquery-3.6.0.min.js"></script>
<script src="<?php echo constant("URL");?>views/DataTables/js/dataTables.dataTables.js"></script>
<script src="<?php echo constant("URL");?>views/DataTables/js/jquery.dataTables.js"></script>

<!-- ARRIBA TENGO LOS SCRIPTS, SI, YA VERAN, TENGO COMBINACIONES DE PHP, HTML Y JS -->
<!-- Y BUENO, ABAJO ESTA PRIMERO, LA CONFIGURACION DE LA ALERTA Y ABAJO TENGO LAS FUNCIONES PARA IMPRIMIR LOS CODIGOS DE ERROR O LOS OTROS CODIGOS DE ESTADO PUES, Y COMO ESTE ARCHIVO SCRIPT ESTA EN TODAS LAS VISTA, ESTO SE USA GLOBALMENTE PUES -->
<script>
  if(document.getElementById("telefono")){
    let input_telefono = document.getElementById("telefono");

    let maskOptions = {
      mask: '0000-000-0000' 
    };

    IMask(input_telefono, maskOptions);
  }

  // if(document.getElementById("seccion_code")){
  //   let input_seccion = document.getElementById("seccion_code");

  //   let maskOptions = {
  //     mask: '000-0000-000' 
  //   };

  //   IMask(input_seccion, maskOptions);
  // }

  

  const Toast = Swal.mixin({
    toast: true,
    position: "top-end",
    showConfirmButton: false,
    timer: 4000
  });
</script>
<?php 
  if(isset($this->code_error)) $this->ObjMessage->printError($this->code_error);
  if(isset($this->code_done)) $this->ObjMessage->printMessage($this->code_done);
?>