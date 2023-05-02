<script defer src="<?php echo constant("URL");?>views/js/bundle.js"></script>
<script src="<?php echo constant("URL");?>views/js/sweetalert.js"></script>
<script src="<?php echo constant("URL");?>views/js/vue.js"></script>
<!-- ARRIBA TENGO LOS SCRIPTS, SI, YA VERAN, TENGO COMBINACIONES DE PHP, HTML Y JS -->
<!-- Y BUENO, ABAJO ESTA PRIMERO, LA CONFIGURACION DE LA ALERTA Y ABAJO TENGO LAS FUNCIONES PARA IMPRIMIR LOS CODIGOS DE ERROR O LOS OTROS CODIGOS DE ESTADO PUES, Y COMO ESTE ARCHIVO SCRIPT ESTA EN TODAS LAS VISTA, ESTO SE USA GLOBALMENTE PUES -->
<script>
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