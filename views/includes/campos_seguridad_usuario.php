<?php 
// AQUI LO MISMO QUE PARA LOS CAMPOS DE USUARIO, PERO LA PARTE DE SEGURIDAD, NO, SON LOS CAMPOS PARA REGITRAR LAS PREGUNTAS Y RESPUESTAS DE SEGURIDAD DEL USUARIO, YA QUE ESA VISTA, EL FORMULARIO ESTA DIVIDIDO
  if(!isset($this->id_consulta)) $pregunta1 = $respuesta1 = $pregunta2 = $respuesta2 = $pregunta3 = $respuesta3 = null;
?>
<div class="mb-6">
    <label class="mb-2.5 block font-medium text-black dark:text-white">Primera pregunta de seguridad</label>
    <div class="relative">
      <input type="text" maxlength="45" placeholder="Ingrese pregunta de Seguridad" value="<?php echo $pregunta1;?>" name="pregunta1"
        class="w-full rounded-lg border border-stroke bg-transparent py-4 pl-6 pr-10 outline-none focus:border-primary focus-visible:shadow-none dark:border-form-strokedark dark:bg-form-input dark:focus:border-primary" />
    </div>
  </div>
  
  <div class="mb-6">
    <label class="mb-2.5 block font-medium text-black dark:text-white">Primera respuesta de seguridad</label>
    <div class="relative">
      <input type="text" maxlength="45" placeholder="Ingrese respuesta" value="<?php echo $respuesta1;?>" name="respuesta1"
        class="w-full rounded-lg border border-stroke bg-transparent py-4 pl-6 pr-10 outline-none focus:border-primary focus-visible:shadow-none dark:border-form-strokedark dark:bg-form-input dark:focus:border-primary" />
    </div>
  </div>

  <div class="mb-6">
    <label class="mb-2.5 block font-medium text-black dark:text-white">Segunda pregunta de seguridad</label>
    <div class="relative">
      <input type="text" maxlength="45" placeholder="Ingrese pregunta de Seguridad" value="<?php echo $pregunta2;?>" name="pregunta2"
        class="w-full rounded-lg border border-stroke bg-transparent py-4 pl-6 pr-10 outline-none focus:border-primary focus-visible:shadow-none dark:border-form-strokedark dark:bg-form-input dark:focus:border-primary" />
    </div>
  </div>

  <div class="mb-6">
    <label class="mb-2.5 block font-medium text-black dark:text-white">Segunda respuesta de seguridad</label>
    <div class="relative">
      <input type="text" maxlength="45" placeholder="Ingrese respuesta" value="<?php echo $respuesta2;?>" name="respuesta2"
        class="w-full rounded-lg border border-stroke bg-transparent py-4 pl-6 pr-10 outline-none focus:border-primary focus-visible:shadow-none dark:border-form-strokedark dark:bg-form-input dark:focus:border-primary" />
    </div>
  </div>

  <div class="mb-6">
    <label class="mb-2.5 block font-medium text-black dark:text-white">Tercera pregunta de seguridad</label>
    <div class="relative">
      <input type="text" maxlength="45" placeholder="Ingrese pregunta de Seguridad" value="<?php echo $pregunta3;?>" name="pregunta3"
        class="w-full rounded-lg border border-stroke bg-transparent py-4 pl-6 pr-10 outline-none focus:border-primary focus-visible:shadow-none dark:border-form-strokedark dark:bg-form-input dark:focus:border-primary" />
    </div>
  </div>

    <div class="mb-6">
    <label class="mb-2.5 block font-medium text-black dark:text-white">Tercera respuesta de seguridad</label>
    <div class="relative">
      <input type="text" maxlength="45" placeholder="Ingrese respuesta" value="<?php echo $respuesta3;?>" name="respuesta3"
        class="w-full rounded-lg border border-stroke bg-transparent py-4 pl-6 pr-10 outline-none focus:border-primary focus-visible:shadow-none dark:border-form-strokedark dark:bg-form-input dark:focus:border-primary" />
    </div>
  </div>