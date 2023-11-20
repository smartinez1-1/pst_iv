<!DOCTYPE html>
<html lang="en">
<?php 
  $this->GetHeader("SGSC | UNEFA");

  $op = "Registrar";
  $cedula = null;
  $nombre = null;
  $correo = null;
  $edad = null;
  $clave = null;
  $sexo = null;
  $telefono = null;
  $categoria = null;
  $tipo_tutor = null;
  $if_tutor = true;
  $id_tutor = null;
  $id_parroquia = null;
  $sector_tutor = null;
  $avenida_tutor = null;
  $calle_tutor = null;
  $id_estado = null;
  $id_municipio = null;
  $id_parroquia = null;

  require_once("./models/cls_tutor.php");
  $model = new cls_tutor();

  $estados = $model->getListOfEstados();

  if(isset($this->id_consulta)){
    $datos = $model->consulta($this->id_consulta);

    if(isset($datos['cedula_usuario'])){      
      $op = "Actualizar";
			$cedula = $datos['cedula_usuario'];
			$nombre = $datos['nombre_usuario'];
			$correo = $datos['correo_usuario'];
			$edad = $datos['edad_usuario'];
			$clave = '';
			$sexo = $datos['genero_usuario'];
			$telefono = $datos['telefono_usuario'];
      $categoria = $datos['categoria_tutor'];
      $tipo_tutor = $datos['tipo_tutor'];
      $sector_tutor = $datos['sector_tutor'];
      $avenida_tutor = $datos['avenida_tutor'];
      $calle_tutor = $datos['calle_tutor'];

      $id_estado = $datos['id_estado'];
      $id_municipio = $datos['id_municipio'];
      $id_parroquia = $datos['id_parroquia'];

      // var_dump($id_estado);
      // die("sdfdf");
      $id_tutor = $this->id_consulta;

      $lista_preguntas = $model->getListOfPreguntas();
      $if_tutor = ($_SESSION['cedula'] === $datos['cedula_usuario']) ? true : false;

      $pregunta1 = $datos['id_pregunta_1'];
      $respuesta1 = "";
      $pregunta2 = $datos['id_pregunta_2'];
      $respuesta2 = "";
      $pregunta3 = $datos['pregunta_3'];
      $respuesta3 = "";
    }else{
      $if_tutor = false;
    }
  }

?>
<body
	x-data="{ page: 'signin', 'loaded': true, 'darkMode': true, 'stickyMenu': false, 'sidebarToggle': false, 'scrollTop': false }"
	x-init="
          darkMode = JSON.parse(localStorage.getItem('darkMode'));
          $watch('darkMode', value => localStorage.setItem('darkMode', JSON.stringify(value)))"
	:class="{'dark text-bodydark bg-boxdark-2': darkMode === true}">

	<!-- ===== Page Wrapper Start ===== -->
	<div class="flex h-screen overflow-hidden">
		<?php $this->GetComplement('sidebar_menu');?>
		<!-- ===== Content Area Start ===== -->
		<div class="relative flex flex-1 flex-col overflow-y-auto overflow-x-hidden">
		<?php $this->GetComplement('header');?>
      <main>
        <div class="max-w-screen-2xl mx-auto p-4 md:p-6 2xl:p-10">
        <?php 
          $this->GetComplement('breadcrumb',['title_breadcrumb' => "Gestión Tutor"]);
        ?>
					<div class="rounded-sm border border-stroke bg-white shadow-default dark:border-strokedark dark:bg-boxdark">
						<div class="border-b border-stroke py-4 px-6.5 dark:border-strokedark">
							<h3 class="font-semibold text-black dark:text-white">
              Gestión de Tutor
							</h3>
						</div>
            <form action="<?php $this->SetURL("controllers/tutor_controller.php");?>" method="POST" autocomplete="off" class="flex flex-wrap items-center" id="app_vue">
            <div class="w-full border-stroke dark:border-strokedark xl:border-l-2">
              <div class="w-full grid grid-cols-4 gap-4 p-4 sm:p-12.5 xl:p-17.5">

                <input type="hidden" name="ope" value="<?php echo $op;?>">
                <input type="hidden" name="permisos_usuario" value="2" readonly>
                <input type="hidden" name="tipo_usuario" value="TUTOR" readonly>
                <input type="hidden" name="return" value="tutor/index" readonly>

                  <div class="mb-4">
                    <label class="mb-2.5 block font-medium text-black dark:text-white">Cédula<span class="text-meta-1">*</span></label>
                    <div class="relative">
                      <input type="text" maxlength="8" autocomplete="off" title="solo se admiten numeros" pattern="[0-9]{7,8}" placeholder="Ingrese su cedula" name="cedula_usuario" value="<?php echo $cedula; ?>" <?php echo (isset($op) && $op == "Actualizar") ? "readonly" : ""; ?> class="w-full rounded-lg border border-stroke bg-transparent py-4 pl-6 pr-10 outline-none focus:border-primary focus-visible:shadow-none dark:border-form-strokedark dark:bg-form-input dark:focus:border-primary" />
                    </div>
                  </div>

                  <div class="mb-4">
                    <label class="mb-2.5 block font-medium text-black dark:text-white">
                      Nombre y Apellido<span class="text-meta-1">*</span>
                    </label>
                    <div class="relative">

                      <input type="text" maxlength="45" autocomplete="off" placeholder="Ingrese su Nombre" pattern="[a-zA-ZñÑáéíóúÁÉÍÓÚ\s]+" name="nombre_usuario" value="<?php echo $nombre; ?>" class="w-full rounded-lg border border-stroke bg-transparent py-4 pl-6 pr-10 outline-none focus:border-primary focus-visible:shadow-none dark:border-form-strokedark dark:bg-form-input dark:focus:border-primary" />
                    </div>
                  </div>

                  <div class="mb-4">
                    <label class="mb-2.5 block font-medium text-black dark:text-white">Correo<span class="text-meta-1">*</span></label>
                    <div class="relative">
                      <input type="email" maxlength="120" autocomplete="off" placeholder="Ingrese su Correo" name="correo_usuario" value="<?php echo $correo; ?>" class="w-full rounded-lg border border-stroke bg-transparent py-4 pl-6 pr-10 outline-none focus:border-primary focus-visible:shadow-none dark:border-form-strokedark dark:bg-form-input dark:focus:border-primary" />
                    </div>
                  </div>

                  <div class="mb-4">
                    <label class="mb-2.5 block font-medium text-black dark:text-white">Edad<span class="text-meta-1">*</span></label>
                    <div class="relative">
                      <input type="text" maxlength="2" autocomplete="off" placeholder="edad" pattern="[0-9]{1,2}" title="solo se ingresan numeros" name="edad_usuario" value="<?php echo $edad; ?>" class="w-full rounded-lg border border-stroke bg-transparent py-4 pl-6 pr-10 outline-none focus:border-primary focus-visible:shadow-none dark:border-form-strokedark dark:bg-form-input dark:focus:border-primary" />
                    </div>
                  </div>

                  <div class="mb-6">
                    <label class="mb-2.5 block font-medium text-black dark:text-white">Numero de Teléfono<span class="text-meta-1">*</span></label>
                    <div class="relative">
                      <input type="text" id="telefono" autocomplete="off" minmength="13" maxlength="13" title="solo se admiten numeros" placeholder="Ingrese su Numero de Teléfono" name="telefono_usuario" value="<?php echo $telefono; ?>" class="w-full rounded-lg border border-stroke bg-transparent py-4 pl-6 pr-10 outline-none focus:border-primary focus-visible:shadow-none dark:border-form-strokedark dark:bg-form-input dark:focus:border-primary" />
                    </div>
                  </div>

                  <div class="mb-6">
                    <label class="mb-2.5 block font-medium text-black dark:text-white">Sexo<span class="text-meta-1">*</span>:</label>
                    <div class="flex items-center space-x-4">
                      <div class="mr-3">
                        <label for="checkboxLabelFour" class="flex cursor-pointer select-none items-center">
                          <div class="relative">
                            <input type="radio" id="checkboxLabelFour1" required class="" name="genero_usuario" value="F" <?php if (isset($sexo) && $sexo == "F") echo "checked"; ?> />
                          </div>
                          Femenino
                        </label>
                      </div>

                      <div class="ml-3">
                        <label for="checkboxLabelFour" class="flex cursor-pointer select-none items-center">
                          <div class="relative">
                            <input type="radio" id="checkboxLabelFour2" required class="" name="genero_usuario" value="M" <?php if (isset($sexo) && $sexo == "M") echo "checked"; ?> />
                          </div>
                          Masculino
                        </label>
                      </div>
                    </div>
                  </div>
                  <div class="w-full xl:w-4/6">
                    <label class="mb-3 block font-medium text-black dark:text-white">
                      Categoria Docente
                    </label>
                    <div class="relative z-20 bg-white dark:bg-form-input">
                      <select required name="categoria_tutor"
                        class="relative z-20 w-full appearance-none rounded border border-stroke bg-transparent py-3 px-12 outline-none transition focus:border-primary active:border-primary dark:border-form-strokedark dark:bg-form-input">
                        <option value="">Seleccione una opcion</option>
                        <option <?php echo ($categoria == 'DXCL') ? "selected" : "";?> value="DXCL">Dedicación exclusiva</option>
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
                      <select required name="tipo_tutor"
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
                  <div class="col-span-3"></div>
                  <div class="w-full xl:w-4/6">
                    <label class="mb-3 block font-medium text-black dark:text-white">
                      Estado<span class="text-meta-1">*</span>
                    </label>
                    <div class="relative z-20 bg-white dark:bg-form-input">
                      <select required name="id_estado" @change="getMunicipios" v-model="id_estado"
                        class="relative z-20 w-full appearance-none rounded border border-stroke bg-transparent py-3 px-12 outline-none transition focus:border-primary active:border-primary dark:border-form-strokedark dark:bg-form-input">
                        <option value="">Seleccione una opcion</option>
                        <?php foreach($estados as $item){?>
                          <option <?php echo ($id_estado == $item['id_estado']) ? "selected" : "";?> value="<?php echo $item['id_estado'];?>"><?php echo $item['estado'];?></option>
                        <?php }?>
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
                  <div class="w-full xl:w-4/6">
                    <label class="mb-3 block font-medium text-black dark:text-white">
                      Municipio<span class="text-meta-1">*</span>
                    </label>
                    <div class="relative z-20 bg-white dark:bg-form-input">
                      <select required name="id_municipio" @change="getParroquias" v-model="id_municipio"
                        class="relative z-20 w-full appearance-none rounded border border-stroke bg-transparent py-3 px-12 outline-none transition focus:border-primary active:border-primary dark:border-form-strokedark dark:bg-form-input">
                        <option value="">Seleccione una opcion</option>
                        <option v-for="item in municipios" :value="item.id_municipio">{{item.municipio}}</option>
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
                  <div class="w-full xl:w-4/6">
                    <label class="mb-3 block font-medium text-black dark:text-white">
                      Parroquia<span class="text-meta-1">*</span>
                    </label>
                    <div class="relative z-20 bg-white dark:bg-form-input">
                      <select required name="id_parroquia" v-model="id_parroquia"
                        class="relative z-20 w-full appearance-none rounded border border-stroke bg-transparent py-3 px-12 outline-none transition focus:border-primary active:border-primary dark:border-form-strokedark dark:bg-form-input">
                        <option value="">Seleccione una opcion</option>
                        <option v-for="item in parroquias" :value="item.id_parroquia">{{item.parroquia}}</option>
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
                  <div class="mb-6">
                    <label class="mb-2.5 block font-medium text-black dark:text-white">Calle</label>
                    <div class="relative">
                      <input type="text" id="calle_tutor" autocomplete="off" placeholder="Ingrese su Numero de Teléfono" name="calle_tutor" value="<?php echo $calle_tutor; ?>" class="w-full rounded-lg border border-stroke bg-transparent py-4 pl-6 pr-10 outline-none focus:border-primary focus-visible:shadow-none dark:border-form-strokedark dark:bg-form-input dark:focus:border-primary" />
                    </div>
                  </div>
                  <div class="mb-6">
                    <label class="mb-2.5 block font-medium text-black dark:text-white">Avenida</label>
                    <div class="relative">
                      <input type="text" id="avenida_tutor" autocomplete="off" placeholder="Ingrese su Numero de Teléfono" name="avenida_tutor" value="<?php echo $avenida_tutor; ?>" class="w-full rounded-lg border border-stroke bg-transparent py-4 pl-6 pr-10 outline-none focus:border-primary focus-visible:shadow-none dark:border-form-strokedark dark:bg-form-input dark:focus:border-primary" />
                    </div>
                  </div>
                  <div class="mb-6">
                    <label class="mb-2.5 block font-medium text-black dark:text-white">Sector</label>
                    <div class="relative">
                      <input type="text" id="sector_tutor" autocomplete="off" placeholder="Ingrese su Numero de Teléfono" name="sector_tutor" value="<?php echo $sector_tutor; ?>" class="w-full rounded-lg border border-stroke bg-transparent py-4 pl-6 pr-10 outline-none focus:border-primary focus-visible:shadow-none dark:border-form-strokedark dark:bg-form-input dark:focus:border-primary" />
                    </div>
                  </div>
                  <?php if ($op === "Actualizar" && $if_tutor === true) { ?>
                    <div class="w-full">
                      <label class="mb-3 block font-medium text-black dark:text-white">
                        Seleccione su primera pregunta de seguridad <span class="text-meta-1">*</span>
                      </label>
                      <div class="relative z-20 bg-white dark:bg-form-input">
                        <select required name="id_pregunta_1" class="relative z-20 w-full appearance-none rounded border border-stroke bg-transparent py-3 px-12 outline-none transition focus:border-primary active:border-primary dark:border-form-strokedark dark:bg-form-input">
                          <option value="">Seleccione una opcion</option>
                          <?php foreach ($lista_preguntas as $item) { ?>
                            <option value="<?php echo $item['id_pregunta']; ?>" <?php echo (isset($pregunta1) && $pregunta1 === $item['id_pregunta']) ? "selected" : ""; ?>><?php echo $item['des_pregunta']; ?></option>
                          <?php } ?>
                        </select>
                        <span class="absolute top-1/2 right-4 z-10 -translate-y-1/2">
                          <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <g opacity="0.8">
                              <path fill-rule="evenodd" clip-rule="evenodd" d="M5.29289 8.29289C5.68342 7.90237 6.31658 7.90237 6.70711 8.29289L12 13.5858L17.2929 8.29289C17.6834 7.90237 18.3166 7.90237 18.7071 8.29289C19.0976 8.68342 19.0976 9.31658 18.7071 9.70711L12.7071 15.7071C12.3166 16.0976 11.6834 16.0976 11.2929 15.7071L5.29289 9.70711C4.90237 9.31658 4.90237 8.68342 5.29289 8.29289Z" fill="#637381"></path>
                            </g>
                          </svg>
                        </span>
                      </div>
                    </div>

                    <div class="mb-6 col-span-2">
                      <label class="mb-2.5 block font-medium text-black dark:text-white">Primera respuesta de seguridad</label>
                      <div class="relative">
                        <input type="text" maxlength="60" autocomplete="off" placeholder="Ingrese su respuesta de seguridad" name="2" value="<?php echo $respuesta1; ?>" class="w-full rounded-lg border border-stroke bg-transparent py-4 pl-6 pr-10 outline-none focus:border-primary focus-visible:shadow-none dark:border-form-strokedark dark:bg-form-input dark:focus:border-primary" />
                      </div>
                    </div>

                    <div class="w-full">
                      <label class="mb-3 block font-medium text-black dark:text-white">
                        Seleccione su segunda pregunta de seguridad <span class="text-meta-1">*</span>
                      </label>
                      <div class="relative z-20 bg-white dark:bg-form-input">
                        <select required name="id_pregunta_1" class="relative z-20 w-full appearance-none rounded border border-stroke bg-transparent py-3 px-12 outline-none transition focus:border-primary active:border-primary dark:border-form-strokedark dark:bg-form-input">
                          <option value="">Seleccione una opcion</option>
                          <?php foreach ($lista_preguntas as $item) { ?>
                            <option value="<?php echo $item['id_pregunta']; ?>" <?php echo (isset($pregunta2) && $pregunta2 === $item['id_pregunta']) ? "selected" : ""; ?>><?php echo $item['des_pregunta']; ?></option>
                          <?php } ?>
                        </select>
                        <span class="absolute top-1/2 right-4 z-10 -translate-y-1/2">
                          <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <g opacity="0.8">
                              <path fill-rule="evenodd" clip-rule="evenodd" d="M5.29289 8.29289C5.68342 7.90237 6.31658 7.90237 6.70711 8.29289L12 13.5858L17.2929 8.29289C17.6834 7.90237 18.3166 7.90237 18.7071 8.29289C19.0976 8.68342 19.0976 9.31658 18.7071 9.70711L12.7071 15.7071C12.3166 16.0976 11.6834 16.0976 11.2929 15.7071L5.29289 9.70711C4.90237 9.31658 4.90237 8.68342 5.29289 8.29289Z" fill="#637381"></path>
                            </g>
                          </svg>
                        </span>
                      </div>
                    </div>
                    <div class="mb-6 col-span-2">
                      <label class="mb-2.5 block font-medium text-black dark:text-white">Segunda respuesta de seguridad</label>
                      <div class="relative">
                        <input type="text" maxlength="60" autocomplete="off" placeholder="Ingrese su respuesta de seguridad" name="respuesta_2" value="<?php echo $respuesta2; ?>" class="w-full rounded-lg border border-stroke bg-transparent py-4 pl-6 pr-10 outline-none focus:border-primary focus-visible:shadow-none dark:border-form-strokedark dark:bg-form-input dark:focus:border-primary" />
                      </div>
                    </div>
                    <div class="mb-6 col-span-2">
                      <label class="mb-2.5 block font-medium text-black dark:text-white">Contraseña <span class="text-meta-1">*</span></label>
                      <div class="relative">
                        <input type="password" autocomplete="off" maxlength="60" placeholder="Ingrese su clave" name="clave_usuario" value="" class="w-full rounded-lg border border-stroke bg-transparent py-4 pl-6 pr-10 outline-none focus:border-primary focus-visible:shadow-none dark:border-form-strokedark dark:bg-form-input dark:focus:border-primary" />
                      </div>
                    </div>
                  <?php } ?>
                </div>
                <div class="mb-5 p-6">
                  <input type="submit" value="Guardar" class="w-full cursor-pointer rounded-lg border border-primary bg-primary p-4 font-medium text-white transition hover:bg-opacity-90" />
                </div>
              </div>
              <!-- <div class="w-full border-stroke dark:border-strokedark xl:border-l-2">
                <div class="w-full grid grid-cols-4 gap-4 p-4 sm:p-12.5 xl:p-17.5">
                  

                  <div class="mb-4">
                    <label class="mb-2.5 block font-medium text-black dark:text-white">Cédula</label>
                    <div class="relative">
                      <input type="hidden" name="id_tutor" value="<?php echo $id_tutor;?>"/>
                      <input type="text" maxlength="8" title="solo se admiten numeros" pattern="[0-9]{7,8}" placeholder="Ingrese su cedula" name="cedula_usuario" value="<?php echo $cedula;?>" <?php echo (isset($op) && $op == "Actualizar") ? "readonly" : "";?>
                        class="w-full rounded-lg border border-stroke bg-transparent py-4 pl-6 pr-10 outline-none focus:border-primary focus-visible:shadow-none dark:border-form-strokedark dark:bg-form-input dark:focus:border-primary" />
                    </div>
                  </div>

                  <div class="mb-4">
                    <label class="mb-2.5 block font-medium text-black dark:text-white">
                      Nombre y Apellido
                    </label>
                    <div class="relative">
                      
                      <input type="text" maxlength="45" placeholder="Ingrese su Nombre" pattern="[a-zA-ZñÑáéíóúÁÉÍÓÚ\s]+" name="nombre_usuario" value="<?php echo $nombre;?>"
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
                      <input type="text" maxlength="2" placeholder="edad" pattern="[0-9]{1,2}" title="solo se ingresan numeros" name="edad_usuario" value="<?php echo $edad;?>"
                        class="w-full rounded-lg border border-stroke bg-transparent py-4 pl-6 pr-10 outline-none focus:border-primary focus-visible:shadow-none dark:border-form-strokedark dark:bg-form-input dark:focus:border-primary" />
                    </div>
                  </div>

                </div>
              </div> -->
            </form>
          </div>
        </div>
      </main>
		</div>
		<!-- ===== Content Area End ===== -->
	</div>
	<!-- ===== Page Wrapper End ===== -->
	<?php $this->GetComplement('scripts');?>
  <script>
    const { createApp } = Vue;

    let app = createApp({
      data(){
        return {
          message: "hola vue",
          id_estado: "<?php echo $id_estado;?>",
          id_municipio: "<?php echo $id_municipio?>",
          id_parroquia: "<?php echo $id_parroquia?>",
          municipios: [],
          parroquias: []
        }
      },
      methods:{
        async getMunicipios(a){
          this.id_estado = a.target.value;

          await fetch(`<?php $this->SetURL('controllers/tutor_controller.php?ope=getMunicipios&id_estado=');?>${a.target.value}`)
          .then( response => response.json())
          .then( result => {
            if(result) this.municipios = result['data']; else this.municipios = [];
          }).catch( error => console.error(error))
        },
        async getParroquias(a){
          this.id_municipio = a.target.value;

          await fetch(`<?php $this->SetURL('controllers/tutor_controller.php?ope=getParroquias&id_municipio=');?>${a.target.value}`)
          .then( response => response.json())
          .then( result => {
            if(result) this.parroquias = result['data']; else this.parroquias = [];
          }).catch( error => console.error(error))
        }
      }
    }).mount("#app_vue")

    <?php 
      if($id_estado != null){
        ?>
          app.getMunicipios({target: {value: '<?php echo $id_estado;?>'}})
          app.getParroquias({target: {value: '<?php echo $id_municipio;?>'}})
        <?php
      }
    ?>
  </script>
</body>

</html>