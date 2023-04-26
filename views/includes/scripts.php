<script defer src="<?php echo constant("URL");?>views/js/bundle.js"></script>
<script src="<?php echo constant("URL");?>views/js/sweetalert.js"></script>
<script src="<?php echo constant("URL");?>views/js/vue.js"></script>

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