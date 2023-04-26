<?php
  class alerts{
    private $list_errors = [
      '01AUTH' => "NO EXISTE SESSION ACTIVA",
      '02AUTH' => "La cédula es invalida o no esta registrado en el sistema",
      '03AUTH' => "Usted no esta habilitado para poseer un usuario",
      '04AUTH' => "Usted ya posee un usuario registrado",
      '05AUTH' => "Usuario no registrado",
      '06AUTH' => "Usuario Inactivo o bloqueado!",
      '07AUTH' => "La clave ingresada no coincide!",
      '08AUTH' => "Respuestas de seguridad no coindiden!",
      '08AUTH' => "No tienes permisos para entrar a esta ruta",
      '01ERR' => "Operación fallida!",
      '02ERR' => "El registro no se puede duplicar",
    ];

    private $list_messages = [
      '01DONE' => "Operación exitosa!",
      '01AUTH' => "Login exitoso!",
      '02AUTH' => "Registro de usuario exitoso!",
      '03AUTH' => "Cambio de clave exitoso!"
    ];

    public function printError($indexError){
      foreach($this->list_errors as $error => $key){
        if($indexError === $error){
          ?>
          <script>
            Toast.fire({
              icon: "error",
              title: "<?php echo $key; ?>"
            });
          </script>
          <?php
        }
      }
    }

    public function printMessage($indexMessage){
      foreach($this->list_messages as $msg => $key){
        if($indexMessage === $msg){
          ?>
          <script>
            Toast.fire({
              icon: "success",
              title: "<?php echo $key; ?>"
            });
          </script>
          <?php
        }
      }
    }

    public function MensajePersonal($array){
      $code = $array['code'];
      $mensaje = $array['msg'];
      ?>
      <script>
        Toast.fire({
          icon: "<?php echo $code; ?>",
          title: "<?php echo $mensaje; ?>"
        });
      </script>
      <?php
    }
  }
?>
