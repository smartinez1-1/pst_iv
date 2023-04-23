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
  }
?>
<div class="mb-4">
  <label class="mb-2.5 block font-medium text-black dark:text-white">Cedula del Usuario</label>
  <div class="relative">
    <input type="text" maxlength="8" placeholder="Ingrese su cedula" name="cedula_usuario" value="<?php echo $cedula;?>" <?php echo ($op == "Actualizar") ? "readonly" : "";?>
      class="w-full rounded-lg border border-stroke bg-transparent py-4 pl-6 pr-10 outline-none focus:border-primary focus-visible:shadow-none dark:border-form-strokedark dark:bg-form-input dark:focus:border-primary" />
  </div>
</div>

<div class="mb-4">
  <label class="mb-2.5 block font-medium text-black dark:text-white">Nombre del Usuario</label>
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
    <input type="password" maxlength="12" placeholder="Ingrese su Contraseña" name="clave_usuario" value="<?php echo $clave;?>"
      class="w-full rounded-lg border border-stroke bg-transparent py-4 pl-6 pr-10 outline-none focus:border-primary focus-visible:shadow-none dark:border-form-strokedark dark:bg-form-input dark:focus:border-primary" />
  </div>
</div>
<?php }?>
<div class="mb-6">
  <label class="mb-2.5 block font-medium text-black dark:text-white">Numero de Teléfono</label>
  <div class="relative">
    <input type="text" maxlength="11" placeholder="Ingrese su Numero de Teléfono" name="telefono_usuario" value="<?php echo $telefono;?>"
      class="w-full rounded-lg border border-stroke bg-transparent py-4 pl-6 pr-10 outline-none focus:border-primary focus-visible:shadow-none dark:border-form-strokedark dark:bg-form-input dark:focus:border-primary" />
  </div>
</div>

<div class="mb-6">
  <label class="mb-2.5 block font-medium text-black dark:text-white">Sexo:</label>
  <div class="flex items-center space-x-2">
    <div class="mr-3">
      <label for="checkboxLabelFour" class="flex cursor-pointer select-none items-center">
        <div class="relative">
          <input type="radio" id="checkboxLabelFour" class="" name="genero_usuario" value="F" <?php if(isset($sexo) && $sexo == "F") echo "checked";?>/>
        </div>
        Femenino
      </label>
    </div>

    <div >
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
<div class="mb-6">
  <label class="mb-2.5 block font-medium text-black dark:text-white">Categoria Tutor</label>
  <div class="relative">
    <input type="text" maxlength="20" placeholder="Ingrese la categoria del tutor" name="categoria_tutor" value="<?php echo $categoria;?>"
      class="w-full rounded-lg border border-stroke bg-transparent py-4 pl-6 pr-10 outline-none focus:border-primary focus-visible:shadow-none dark:border-form-strokedark dark:bg-form-input dark:focus:border-primary" />
  </div>
</div>
<div class="mb-6">
  <label class="mb-2.5 block font-medium text-black dark:text-white">Tipo Tutor</label>
  <div class="relative">
    <input type="text" maxlength="20" placeholder="Ingrese el tipo de tutor" name="tipo_tutor" value="<?php echo $tipo_tutor;?>"
      class="w-full rounded-lg border border-stroke bg-transparent py-4 pl-6 pr-10 outline-none focus:border-primary focus-visible:shadow-none dark:border-form-strokedark dark:bg-form-input dark:focus:border-primary" />
  </div>
</div>
<?php }?>