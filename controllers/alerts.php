<?php
  class alerts{
    // ESTAS SON LAS LISTAS DE ERRORES, SOLO PASO EL CODIGO Y ME RETORNA EL TEXTO QUE SIGNIFICA DICHO CODIGO
    // TODO, TODO, TODO, ES CODIGO DE ANTERIORES PROYECTOS, COSAS QUE HICE UNA SOLA VEZ, LAS USO DE AQUI HASTA NOSE
    // YOUTUBE Y WILIAM VALERA, SI UN ESTUDIANTE TRATA DE ENTRAR AL REGISTRO DE COMUNIDAD, NO, YAVA, ESTE CODIGO SI NO SE USA AQUI, ESTO LO TENGO QUE QUITAR, LISTO
    private $list_errors = [
      '01AUTH' => "NO EXISTE SESION ACTIVA",
      '02AUTH' => "La cédula es invalida o no esta registrado en el sistema",
      '04AUTH' => "Usted ya posee un usuario registrado",
      '05AUTH' => "Usuario no registrado",
      '06AUTH' => "Usuario Inactivo o bloqueado!",
      '07AUTH' => "La clave ingresada no coincide!",
      '08AUTH' => "Respuestas de seguridad no coindiden!",
      '08AUTH' => "No tienes permisos para entrar a esta ruta",
      '01ERR' => "Operación fallida!",
      '02ERR' => "El registro no se puede duplicar",
      '03ERR' => "No pueden existir dos registros activos al mismo tiempo",
    ];

    private $list_messages = [
      '01DONE' => "Operación exitosa!",
      '01AUTH' => "Login exitoso!",
      '02AUTH' => "Registro de usuario exitoso!",
      '03AUTH' => "Cambio de clave exitoso!"
    ];
    // EL FOREACH BUSCA DENTRO DE LA LISTA DE ERRORES, SI ENCUENTRA DICHO ERROR, PUES LUEGO MUESTRA LA ALERTA
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
    // AQUI ES LO MISMO, SI
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
    // ESTO CREO QUE TAMPOCO LO ESTOY USANDO, CREO QUE LO USABA CUANDO ME PONIA CREATIVO CON MENSAJES PERSONALES PARA LOS USUARIOS
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
