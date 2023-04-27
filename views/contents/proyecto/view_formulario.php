<!DOCTYPE html>
<html lang="en">
<?php 
  $this->GetHeader("SGSC | UNEFA");

  require_once("./models/cls_comunidad.php");
  require_once("./models/cls_tutor.php");
  require_once("./models/cls_lapso_academico.php");
  require_once("./models/cls_grupo.php");
  
  $model_c = new cls_comunidad();
  $comunidades = $model_c->Get_comunidades();

  $model_g = new cls_grupo();
  $grupos = $model_g->Get_grupos();

  $model_t = new cls_tutor();
  $tutores = $model_t->Get_tutores();

  $model_l = new cls_lapso_academico();
  $lapso = $model_l->Get_lapso_activo();

  $op = "Registrar";
  $id_proyecto = null;
  $id_comunidad = null;
  $id_grupo = null;
  $id_tutor  = null;
  $titulo_proyecto = null;
  $planteamiento_proyecto = null;
  $objetivos_especificos_proyecto = null;
  $objetivos_generales_proyecto = null;
  $tipo_proyecto = null;
  $estado_proyecto = null;

  if(isset($this->id_consulta)){
    require_once("./models/cls_proyecto.php");
    $model = new cls_proyecto();
    $datos = $model->consulta($this->id_consulta);

    if(isset($datos['id_proyecto'])){      
      $op = "Actualizar";
      $id_proyecto = $datos['id_proyecto'];
      $id_comunidad = $datos['id_comunidad'];
      $id_grupo = $datos['id_grupo'];
      $id_tutor  = $datos['id_tutor'];
      $titulo_proyecto = $datos['titulo_proyecto'];
      $planteamiento_proyecto = $datos['planteamiento_proyecto'];
      $objetivos_especificos_proyecto = $datos['objetivos_especificos_proyecto'];
      $objetivos_generales_proyecto = $datos['objetivos_generales_proyecto'];
      $tipo_proyecto = $datos['tipo_proyecto'];
      $estado_proyecto = $datos['estado_proyecto'];
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
          $this->GetComplement('breadcrumb',['title_breadcrumb' => "Gestion Proyecto"]);
        ?>
          <!-- ====== Form Layout Section Start -->   
          <div class="grid grid-cols-1 gap-9 sm:grid-cols-1">
            <div class="flex flex-col gap-9">
              <!-- Contact Form -->
              <div
                class="rounded-sm border border-stroke bg-white shadow-default dark:border-strokedark dark:bg-boxdark">
                <div class="border-b border-stroke py-4 px-6.5 dark:border-strokedark">
                  <h3 class="font-semibold text-black dark:text-white">
                    Getion de Proyecto
                  </h3>
                </div>
                <form action="<?php $this->SetURL('controllers/proyecto_controller.php');?>" autocomplete="off" method="POST">
                  <input type="hidden" name="ope" value="<?php echo $op;?>">
                  <input type="hidden" name="id_proyecto" value="<?php echo $id_proyecto;?>">
                  <input type="hidden" name="id_ano_escolar" value="<?php echo (isset($lapso) ? $lapso['id_ano_escolar'] : '');?>">
                  <?php 
                    if(!isset($lapso)){
                      ?>
                      <div class="w-full p-4 text-center">
                        <h1 class="text-danger">No existe un lapso academico activo</h1>
                      </div>
                      <?php
                    }else{
                  ?>
                  <div class="p-6.5">
                    <div class="mb-4.5 grid grid-cols-3 gap-6">
                      <div class="w-full xl:w-4/6">
                        <label class="mb-3 block font-medium text-black dark:text-white">
                          Seleccione una comunidad
                        </label>
                        <div class="relative z-20 bg-white dark:bg-form-input">
                          <select required name="id_comunidad"
                            class="relative z-20 w-full appearance-none rounded border border-stroke bg-transparent py-3 px-12 outline-none transition focus:border-primary active:border-primary dark:border-form-strokedark dark:bg-form-input">
                            <option value="">Seleccione una opcion</option>
                            <?php foreach($comunidades as $comu){?>
                              <option <?php echo ($id_comunidad == $comu['id_comunidad']) ? "selected" : "";?> value="<?php echo $comu['id_comunidad'];?>"><?php echo $comu['nombre_comunidad'];?></option>
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
                          Seleccione un grupo
                        </label>
                        <div class="relative z-20 bg-white dark:bg-form-input">
                          <select required name="id_grupo"
                            class="relative z-20 w-full appearance-none rounded border border-stroke bg-transparent py-3 px-12 outline-none transition focus:border-primary active:border-primary dark:border-form-strokedark dark:bg-form-input">
                            <option value="">Seleccione una opcion</option>
                            <?php foreach($grupos as $grup){?>
                              <option <?php echo ($id_grupo == $grup['id_grupo']) ? "selected" : "";?> value="<?php echo $grup['id_grupo'];?>"><?php echo $grup['nombre_grupo'];?></option>
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
                          Seleccione una Tutor
                        </label>
                        <div class="relative z-20 bg-white dark:bg-form-input">
                          <select required name="id_tutor"
                            class="relative z-20 w-full appearance-none rounded border border-stroke bg-transparent py-3 px-12 outline-none transition focus:border-primary active:border-primary dark:border-form-strokedark dark:bg-form-input">
                            <option value="">Seleccione una opcion</option>
                            <?php foreach($tutores as $tut){?>
                              <option <?php echo ($id_tutor == $tut['id_tutor']) ? "selected" : "";?> value="<?php echo $tut['id_tutor'];?>"><?php echo $tut['cedula_usuario']." ".$tut['nombre_usuario'];?></option>
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
                        <label class="mb-2.5 block text-black dark:text-white">
                          Titulo del proyecto <span class="text-meta-1">*</span>
                        </label>
                        <input type="text" maxlength="45" minlength="4" required placeholder="" name="titulo_proyecto" value="<?php echo $titulo_proyecto;?>"
                          class="w-full rounded border-[1.5px] border-stroke bg-transparent py-3 px-5 font-medium outline-none transition focus:border-primary active:border-primary disabled:cursor-default disabled:bg-whiter dark:border-form-strokedark dark:bg-form-input dark:focus:border-primary" />
                      </div>
                      <div class="w-full xl:w-4/6">
                        <label class="mb-2.5 block text-black dark:text-white">
                          Planteamiento del proyecto <span class="text-meta-1">*</span>
                        </label>
                        <input type="text" maxlength="45" minlength="4" required placeholder="" name="planteamiento_proyecto" value="<?php echo $planteamiento_proyecto;?>"
                          class="w-full rounded border-[1.5px] border-stroke bg-transparent py-3 px-5 font-medium outline-none transition focus:border-primary active:border-primary disabled:cursor-default disabled:bg-whiter dark:border-form-strokedark dark:bg-form-input dark:focus:border-primary" />
                      </div>
                      <div class="w-full xl:w-4/6">
                        <label class="mb-2.5 block text-black dark:text-white">
                          Tipo de proyecto <span class="text-meta-1">*</span>
                        </label>
                        <input type="text" maxlength="45" minlength="4" required placeholder="" name="tipo_proyecto" value="<?php echo $tipo_proyecto;?>"
                          class="w-full rounded border-[1.5px] border-stroke bg-transparent py-3 px-5 font-medium outline-none transition focus:border-primary active:border-primary disabled:cursor-default disabled:bg-whiter dark:border-form-strokedark dark:bg-form-input dark:focus:border-primary" />
                      </div>
                      <div class="w-full">
                        <div class="mb-6">
                          <label class="mb-2.5 block text-black dark:text-white">
                          Objetivos generales <span class="text-meta-1">*</span>
                          </label>
                          <textarea rows="6" maxlength="120" minlength="5" placeholder="Ingrese su texto" name="objetivos_generales_proyecto"
                            class="w-full rounded border-[1.5px] border-stroke bg-transparent py-3 px-5 font-medium outline-none transition focus:border-primary active:border-primary disabled:cursor-default disabled:bg-whiter dark:border-form-strokedark dark:bg-form-input dark:focus:border-primary"><?php echo $objetivos_generales_proyecto;?>
                          </textarea>
                        </div>
                      </div>
                      <div class="w-full">
                        <div class="mb-6">
                          <label class="mb-2.5 block text-black dark:text-white">
                          Objetivos especificos <span class="text-meta-1">*</span>
                          </label>
                          <textarea rows="6" maxlength="120" minlength="5" placeholder="Ingrese su texto" name="objetivos_especificos_proyecto"
                            class="w-full rounded border-[1.5px] border-stroke bg-transparent py-3 px-5 font-medium outline-none transition focus:border-primary active:border-primary disabled:cursor-default disabled:bg-whiter dark:border-form-strokedark dark:bg-form-input dark:focus:border-primary"><?php echo $objetivos_especificos_proyecto;?>
                          </textarea>
                        </div>
                      </div>

                      <div class="w-full xl:w-2/6">
                        <label class="mb-2.5 block text-black dark:text-white">
                          Estado del proyecto <span class="text-meta-1">*</span>
                        </label>
                        <div class="flex items-center space-x-2">
                          <div class="mr-3">
                            <label for="checkboxLabelFour" class="flex cursor-pointer select-none items-center">
                              <div class="relative">
                                <input type="radio" required id="checkboxLabelFour" class="" name="estado_proyecto" value="1" <?php echo ($estado_proyecto == '1') ? "checked" : "";?>/>
                              </div>
                              Aprobado
                            </label>
                          </div>

                          <div >
                            <label for="checkboxLabelFour" class="flex cursor-pointer select-none items-center">
                              <div class="relative">
                                <input type="radio" required id="checkboxLabelFour" class="" name="estado_proyecto" value="0" <?php echo ($estado_proyecto == '0') ? "checked" : "";?>/>
                              </div>
                              En proceso
                            </label>
                          </div>
                        </div>
                      </div>
                    </div>

                    <button class="flex w-full justify-center rounded bg-primary p-3 font-medium text-gray">
                      Guardar
                    </button>
                  </div>
                  <?php }?>
                </form>
              </div>
            </div>
          </div>
        </div>
      </main>
		</div>
		<!-- ===== Content Area End ===== -->
	</div>
	<!-- ===== Page Wrapper End ===== -->
	<?php $this->GetComplement('scripts');?>
</body>

</html>