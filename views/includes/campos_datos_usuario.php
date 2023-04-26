<?php 
  if(!isset($this->id_consulta)){
    $cedula = null;
    $nombre = null;
    $correo = null;
    $edad = null;
    $clave = null;
    $sexo = null;
    $telefono = null;
    $categoria = null;
    $tipo_tutor = null;

    $id_tutor = null;
    $id_estudiante = null;
  }
?>
<div class="mb-4">
  <label class="mb-2.5 block font-medium text-black dark:text-white">Cedula</label>
  <div class="relative">
    <?php 
      if($this->controlador == "tutor"){
        ?>
        <input type="hidden" name="id_tutor" value="<?php echo $id_tutor;?>"/>
        <?php
      }
    ?>
    <input type="text" maxlength="8" placeholder="Ingrese su cedula" name="cedula_usuario" value="<?php echo $cedula;?>" <?php echo ($op == "Actualizar") ? "readonly" : "";?>
      class="w-full rounded-lg border border-stroke bg-transparent py-4 pl-6 pr-10 outline-none focus:border-primary focus-visible:shadow-none dark:border-form-strokedark dark:bg-form-input dark:focus:border-primary" />
  </div>
</div>

<div class="mb-4">
  <label class="mb-2.5 block font-medium text-black dark:text-white">
    <?php 
      if($this->controlador == "auth") echo "Nombre del Usuario";
      else echo "Nombre y Apellido";
    ?>
  </label>
  <div class="relative">
    
    <input type="text" maxlength="45" placeholder="Ingrese su Nombre" name="nombre_usuario" value="<?php echo $nombre;?>"
      class="w-full rounded-lg border border-stroke bg-transparent py-4 pl-6 pr-10 outline-none focus:border-primary focus-visible:shadow-none dark:border-form-strokedark dark:bg-form-input dark:focus:border-primary" />
  </div>
</div>

<div class="mb-4">
  <label class="mb-2.5 block font-medium text-black dark:text-white">Correo</label>
  <div class="relative">
    <input type="email" maxlength="120" placeholder="Ingrese su Correo" name="correo_usuario" value="<?php echo $correo;?>"
      class="w-full rounded-lg border border-stroke bg-transparent py-4 pl-6 pr-10 outline-none focus:border-primary focus-visible:shadow-none dark:border-form-strokedark dark:bg-form-input dark:focus:border-primary" />
  </div>
</div>

<div class="mb-4">
  <label class="mb-2.5 block font-medium text-black dark:text-white">Edad</label>
  <div class="relative">
    <input type="text" maxlength="2" placeholder="edad" name="edad_usuario" value="<?php echo $edad;?>"
      class="w-full rounded-lg border border-stroke bg-transparent py-4 pl-6 pr-10 outline-none focus:border-primary focus-visible:shadow-none dark:border-form-strokedark dark:bg-form-input dark:focus:border-primary" />
  </div>
</div>
<?php if($op != "Actualizar"){?>
<div class="mb-6">
  <label class="mb-2.5 block font-medium text-black dark:text-white">Contraseña</label>
  <div class="relative">
    <input type="password" minlength="8" maxlength="12" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" title="Su clave debe de tener almenos, uan letra miniscula, mayuscula, caracteres especiales, numero de 8 caracteres minimo" placeholder="Ingrese su Contraseña" name="clave_usuario" value="<?php echo $clave;?>"
      class="w-full rounded-lg border border-stroke bg-transparent py-4 pl-6 pr-10 outline-none focus:border-primary focus-visible:shadow-none dark:border-form-strokedark dark:bg-form-input dark:focus:border-primary" />
  </div>
</div>
<?php }?>
<div class="mb-6">
  <label class="mb-2.5 block font-medium text-black dark:text-white">Numero de Teléfono</label>
  <div class="relative">
    <input type="text" minmength="11" maxlength="11" placeholder="Ingrese su Numero de Teléfono" name="telefono_usuario" value="<?php echo $telefono;?>"
      class="w-full rounded-lg border border-stroke bg-transparent py-4 pl-6 pr-10 outline-none focus:border-primary focus-visible:shadow-none dark:border-form-strokedark dark:bg-form-input dark:focus:border-primary" />
  </div>
</div>

<div class="mb-6">
  <label class="mb-2.5 block font-medium text-black dark:text-white">Sexo:</label>
  <div class="flex items-center space-x-4">
    <div class="mr-3">
      <label for="checkboxLabelFour" class="flex cursor-pointer select-none items-center">
        <div class="relative">
          <input type="radio" id="checkboxLabelFour" class="" name="genero_usuario" value="F" <?php if(isset($sexo) && $sexo == "F") echo "checked";?>/>
        </div>
        Femenino
      </label>
    </div>

    <div class="ml-3">
      <label for="checkboxLabelFour" class="flex cursor-pointer select-none items-center">
        <div class="relative">
          <input type="radio" id="checkboxLabelFour" class="" name="genero_usuario" value="M" <?php if(isset($sexo) && $sexo == "M") echo "checked";?>/>
        </div>
        Masculino
      </label>
    </div>
  </div>
</div>
<?php if($if_tutor){?>
  
<!-- SELECT CATEGORIA DOCENTE:  EDUCACION EXCLUSIVA, TIEMPO COMPLETO, MEDIO TIEMPO, TIEMPO VARIABLE -->
<div class="w-full xl:w-4/6">
  <label class="mb-3 block font-medium text-black dark:text-white">
    Categoria Docente
  </label>
  <div class="relative z-20 bg-white dark:bg-form-input">
    <select required name="categoria_tutor" required
      class="relative z-20 w-full appearance-none rounded border border-stroke bg-transparent py-3 px-12 outline-none transition focus:border-primary active:border-primary dark:border-form-strokedark dark:bg-form-input">
      <option value="">Seleccione una opcion</option>
      <option <?php echo ($categoria == 'EXCL') ? "selected" : "";?> value="EXCL">Educacion exclusiva</option>
      <option <?php echo ($categoria == 'TC') ? "selected" : "";?> value="TC">Tiempo completo</option>
      <option <?php echo ($categoria == 'MT') ? "selected" : "";?> value="MT">Medio tiempo</option>
      <option <?php echo ($categoria == 'TV') ? "selected" : "";?> value="TV">Tiempo variable</option>
    </select>
    <span class="absolute top-1/2 right-4 z-10 -translate-y-1/2">
      <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
        <g opacity="0.8">
          <path fill-rule="evenodd" clip-rule="evenodd"
            d="M5.29289 8.29289C5.68342 7.90237 6.31658 7.90237 6.70711 8.29289L12 13.5858L17.2929 8.29289C17.6834 7.90237 18.3166 7.90237 18.7071 8.29289C19.0976 8.68342 19.0976 9.31658 18.7071 9.70711L12.7071 15.7071C12.3166 16.0976 11.6834 16.0976 11.2929 15.7071L5.29289 9.70711C4.90237 9.31658 4.90237 8.68342 5.29289 8.29289Z"
            fill="#637381"></path>
        </g>
      </svg>
    </span>
  </div>
</div>

<!-- // SELECT DE TIPO DE PERSONAL: DOCENTE - ADMINISTRATIVO -->
<div class="w-full xl:w-4/6">
  <label class="mb-3 block font-medium text-black dark:text-white">
    Tipo de personal
  </label>
  <div class="relative z-20 bg-white dark:bg-form-input">
    <select required name="tipo_tutor" required
      class="relative z-20 w-full appearance-none rounded border border-stroke bg-transparent py-3 px-12 outline-none transition focus:border-primary active:border-primary dark:border-form-strokedark dark:bg-form-input">
      <option value="">Seleccione una opcion</option>
      <option <?php echo ($tipo_tutor == 'DOCENTE') ? "selected" : "";?> value="DOCENTE">Docente</option>
      <option <?php echo ($tipo_tutor == 'ADMINISTRATIVO') ? "selected" : "";?> value="ADMINISTRATIVO">Administrativo</option>
    </select>
    <span class="absolute top-1/2 right-4 z-10 -translate-y-1/2">
      <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
        <g opacity="0.8">
          <path fill-rule="evenodd" clip-rule="evenodd"
            d="M5.29289 8.29289C5.68342 7.90237 6.31658 7.90237 6.70711 8.29289L12 13.5858L17.2929 8.29289C17.6834 7.90237 18.3166 7.90237 18.7071 8.29289C19.0976 8.68342 19.0976 9.31658 18.7071 9.70711L12.7071 15.7071C12.3166 16.0976 11.6834 16.0976 11.2929 15.7071L5.29289 9.70711C4.90237 9.31658 4.90237 8.68342 5.29289 8.29289Z"
            fill="#637381"></path>
        </g>
      </svg>
    </span>
  </div>
</div>
<?php }?>