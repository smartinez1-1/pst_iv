<?php 
  if(!isset($this->id_consulta)) $pregunta1 = $respuesta1 = $pregunta2 = $respuesta2 = $pregunta3 = $respuesta3 = null;
?>
<div class="mb-6">
    <label class="mb-2.5 block font-medium text-black dark:text-white">Primera pregunta de seguridad</label>
    <div class="relative">
      <input type="text" placeholder="Ingrese pregunta de Seguridad" value="<?php echo $pregunta1;?>"
        class="w-full rounded-lg border border-stroke bg-transparent py-4 pl-6 pr-10 outline-none focus:border-primary focus-visible:shadow-none dark:border-form-strokedark dark:bg-form-input dark:focus:border-primary" />
    </div>
  </div>
  
  <div class="mb-6">
    <label class="mb-2.5 block font-medium text-black dark:text-white">Primera respuesta de seguridad</label>
    <div class="relative">
      <input type="text" placeholder="Ingrese respuesta" value="<?php echo $respuesta1;?>"
        class="w-full rounded-lg border border-stroke bg-transparent py-4 pl-6 pr-10 outline-none focus:border-primary focus-visible:shadow-none dark:border-form-strokedark dark:bg-form-input dark:focus:border-primary" />
    </div>
  </div>

  <div class="mb-6">
    <label class="mb-2.5 block font-medium text-black dark:text-white">Segunda pregunta de seguridad</label>
    <div class="relative">
      <input type="text" placeholder="Ingrese pregunta de Seguridad" value="<?php echo $pregunta2;?>"
        class="w-full rounded-lg border border-stroke bg-transparent py-4 pl-6 pr-10 outline-none focus:border-primary focus-visible:shadow-none dark:border-form-strokedark dark:bg-form-input dark:focus:border-primary" />
    </div>
  </div>

  <div class="mb-6">
    <label class="mb-2.5 block font-medium text-black dark:text-white">Segunda respuesta de seguridad</label>
    <div class="relative">
      <input type="text" placeholder="Ingrese respuesta" value="<?php echo $respuesta2;?>"
        class="w-full rounded-lg border border-stroke bg-transparent py-4 pl-6 pr-10 outline-none focus:border-primary focus-visible:shadow-none dark:border-form-strokedark dark:bg-form-input dark:focus:border-primary" />
    </div>
  </div>

  <div class="mb-6">
    <label class="mb-2.5 block font-medium text-black dark:text-white">tercera pregunta de seguridad</label>
    <div class="relative">
      <input type="text" placeholder="Ingrese pregunta de Seguridad" value="<?php echo $pregunta3;?>"
        class="w-full rounded-lg border border-stroke bg-transparent py-4 pl-6 pr-10 outline-none focus:border-primary focus-visible:shadow-none dark:border-form-strokedark dark:bg-form-input dark:focus:border-primary" />
    </div>
  </div>

    <div class="mb-6">
    <label class="mb-2.5 block font-medium text-black dark:text-white">tercera respuesta de seguridad</label>
    <div class="relative">
      <input type="text" placeholder="Ingrese respuesta" value="<?php echo $respuesta3;?>"
        class="w-full rounded-lg border border-stroke bg-transparent py-4 pl-6 pr-10 outline-none focus:border-primary focus-visible:shadow-none dark:border-form-strokedark dark:bg-form-input dark:focus:border-primary" />
    </div>
  </div>