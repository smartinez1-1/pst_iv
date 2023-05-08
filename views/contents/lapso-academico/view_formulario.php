<!DOCTYPE html>
<html lang="en">
<?php 
  $this->GetHeader("SGSC | UNEFA");

  $op = "Registrar";
  $id_ano_escolar = null;
  $ano_escolar_nombre = null;
  $estado_ano_escolar = null;
  $estado_inscripciones = null;
  $fecha_inicio = null;
  $fecha_cierre = null;

  if(isset($this->id_consulta)){
    require_once("./models/cls_lapso_academico.php");
    $model = new cls_lapso_academico();
    $datos = $model->consulta($this->id_consulta);

    if(isset($datos['id_ano_escolar'])){      
      $op = "Actualizar";
      $id_ano_escolar = $datos['id_ano_escolar'];
      $ano_escolar_nombre = $datos['ano_escolar_nombre'];
      $estado_ano_escolar = $datos['estado_ano_escolar'];
      $estado_inscripciones = $datos['estado_incripciones'];
      $fecha_inicio = $datos['fecha_inicio'];
      $fecha_cierre = $datos['fecha_cierre'];
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
          $this->GetComplement('breadcrumb',['title_breadcrumb' => "Gestión Lapso Académico"]);
        ?>
          <!-- ====== Form Layout Section Start -->   
          <div class="grid grid-cols-1 gap-9 sm:grid-cols-1">
            <div class="flex flex-col gap-9">
              <!-- Contact Form -->
              <div
                class="rounded-sm border border-stroke bg-white shadow-default dark:border-strokedark dark:bg-boxdark">
                <div class="border-b border-stroke py-4 px-6.5 dark:border-strokedark">
                  <h3 class="font-semibold text-black dark:text-white">
                  Gestión de Lapso Académico
                  </h3>
                </div>
                <form id="app_vue" action="<?php $this->SetURL('controllers/lapso_academico_controller.php');?>" autocomplete="off" method="POST">
                  <input type="hidden" name="ope" value="<?php echo $op;?>">
                  <input type="hidden" name="id_ano_escolar" value="<?php echo $id_ano_escolar;?>">
                  <div class="p-6.5">
                    <div class="mb-4.5 flex flex-col gap-6 xl:flex-row">
                      <div class="w-full xl:w-2/6">
                        <label class="mb-2.5 block text-black dark:text-white">
                          Descripción <span class="text-meta-1">*</span>
                        </label>
                        <input type="text" maxlength="10" minlength="5" placeholder="" name="ano_escolar_nombre" value="<?php echo $ano_escolar_nombre;?>"
                          class="w-full rounded border-[1.5px] border-stroke bg-transparent py-3 px-5 font-medium outline-none transition focus:border-primary active:border-primary disabled:cursor-default disabled:bg-whiter dark:border-form-strokedark dark:bg-form-input dark:focus:border-primary" />
                      </div>
                    </div>
                    <div class="relative">
                      <label class="mb-2.5 block text-black dark:text-white">Fecha de Inicio</label>
                      <input type="date" :max="fecha_maxima" v-model="fecha_minima" name="fecha_inicio" value="<?php echo $fecha_inicio;?>"
                        class="w-full rounded border-[1.5px] border-stroke bg-transparent py-3 px-5 font-medium outline-none transition focus:border-primary active:border-primary dark:border-form-strokedark dark:bg-form-input dark:focus:border-primary" />
                      <span
                        class="absolute right-0.5 top-0.5 block rounded-tr rounded-br bg-white p-3.5 dark:bg-form-input">
                        <svg width="18" height="18" viewBox="0 0 18 18" fill="none"
                          xmlns="http://www.w3.org/2000/svg">
                          <path
                            d="M15.7504 2.9812H14.2879V2.36245C14.2879 2.02495 14.0066 1.71558 13.641 1.71558C13.2754 1.71558 12.9941 1.99683 12.9941 2.36245V2.9812H4.97852V2.36245C4.97852 2.02495 4.69727 1.71558 4.33164 1.71558C3.96602 1.71558 3.68477 1.99683 3.68477 2.36245V2.9812H2.25039C1.29414 2.9812 0.478516 3.7687 0.478516 4.75308V14.5406C0.478516 15.4968 1.26602 16.3125 2.25039 16.3125H15.7504C16.7066 16.3125 17.5223 15.525 17.5223 14.5406V4.72495C17.5223 3.7687 16.7066 2.9812 15.7504 2.9812ZM1.77227 8.21245H4.16289V10.9968H1.77227V8.21245ZM5.42852 8.21245H8.38164V10.9968H5.42852V8.21245ZM8.38164 12.2625V15.0187H5.42852V12.2625H8.38164V12.2625ZM9.64727 12.2625H12.6004V15.0187H9.64727V12.2625ZM9.64727 10.9968V8.21245H12.6004V10.9968H9.64727ZM13.8379 8.21245H16.2285V10.9968H13.8379V8.21245ZM2.25039 4.24683H3.71289V4.83745C3.71289 5.17495 3.99414 5.48433 4.35977 5.48433C4.72539 5.48433 5.00664 5.20308 5.00664 4.83745V4.24683H13.0504V4.83745C13.0504 5.17495 13.3316 5.48433 13.6973 5.48433C14.0629 5.48433 14.3441 5.20308 14.3441 4.83745V4.24683H15.7504C16.0316 4.24683 16.2566 4.47183 16.2566 4.75308V6.94683H1.77227V4.75308C1.77227 4.47183 1.96914 4.24683 2.25039 4.24683ZM1.77227 14.5125V12.2343H4.16289V14.9906H2.25039C1.96914 15.0187 1.77227 14.7937 1.77227 14.5125ZM15.7504 15.0187H13.8379V12.2625H16.2285V14.5406C16.2566 14.7937 16.0316 15.0187 15.7504 15.0187Z"
                            fill="#64748B" />
                        </svg>
                      </span>
                    </div>

                    <div class="relative">
                      <label class="mb-2.5 block text-black dark:text-white">Fecha de Cierre</label>
                      <input type="date" :min="fecha_minima" v-model="fecha_maxima" name="fecha_cierre" value="<?php echo $fecha_cierre;?>"
                        class="w-full rounded border-[1.5px] border-stroke bg-transparent py-3 px-5 font-medium outline-none transition focus:border-primary active:border-primary dark:border-form-strokedark dark:bg-form-input dark:focus:border-primary" />

                      <span
                        class="absolute right-0.5 top-0.5 block rounded-tr rounded-br bg-white p-3.5 dark:bg-form-input">
                        <svg width="18" height="18" viewBox="0 0 18 18" fill="none"
                          xmlns="http://www.w3.org/2000/svg">
                          <path
                            d="M15.7504 2.9812H14.2879V2.36245C14.2879 2.02495 14.0066 1.71558 13.641 1.71558C13.2754 1.71558 12.9941 1.99683 12.9941 2.36245V2.9812H4.97852V2.36245C4.97852 2.02495 4.69727 1.71558 4.33164 1.71558C3.96602 1.71558 3.68477 1.99683 3.68477 2.36245V2.9812H2.25039C1.29414 2.9812 0.478516 3.7687 0.478516 4.75308V14.5406C0.478516 15.4968 1.26602 16.3125 2.25039 16.3125H15.7504C16.7066 16.3125 17.5223 15.525 17.5223 14.5406V4.72495C17.5223 3.7687 16.7066 2.9812 15.7504 2.9812ZM1.77227 8.21245H4.16289V10.9968H1.77227V8.21245ZM5.42852 8.21245H8.38164V10.9968H5.42852V8.21245ZM8.38164 12.2625V15.0187H5.42852V12.2625H8.38164V12.2625ZM9.64727 12.2625H12.6004V15.0187H9.64727V12.2625ZM9.64727 10.9968V8.21245H12.6004V10.9968H9.64727ZM13.8379 8.21245H16.2285V10.9968H13.8379V8.21245ZM2.25039 4.24683H3.71289V4.83745C3.71289 5.17495 3.99414 5.48433 4.35977 5.48433C4.72539 5.48433 5.00664 5.20308 5.00664 4.83745V4.24683H13.0504V4.83745C13.0504 5.17495 13.3316 5.48433 13.6973 5.48433C14.0629 5.48433 14.3441 5.20308 14.3441 4.83745V4.24683H15.7504C16.0316 4.24683 16.2566 4.47183 16.2566 4.75308V6.94683H1.77227V4.75308C1.77227 4.47183 1.96914 4.24683 2.25039 4.24683ZM1.77227 14.5125V12.2343H4.16289V14.9906H2.25039C1.96914 15.0187 1.77227 14.7937 1.77227 14.5125ZM15.7504 15.0187H13.8379V12.2625H16.2285V14.5406C16.2566 14.7937 16.0316 15.0187 15.7504 15.0187Z"
                            fill="#64748B" />
                        </svg>
                      </span>
                    </div>

                    <div class="mb-6">
                      <label class="mb-2.5 block font-medium text-black dark:text-white">
                        Estado de Inscripciones <span class="text-meta-1 ">*</span>
                      </label>
                      <div class="flex items-center space-x-2">
                        <div class="mr-3">
                          <label for="checkboxLabelFour" class="flex cursor-pointer select-none items-center">
                            <div class="relative">
                              <input type="radio" id="checkboxLabelFour" required class="" name="estado_inscripciones" value="1" <?php if(isset($estado_inscripciones) && $estado_inscripciones == "1") echo "checked";?>/>
                            </div>
                            Activo
                          </label>
                        </div>

                        <div >
                          <label for="checkboxLabelFour" class="flex cursor-pointer select-none items-center">
                            <div class="relative">
                              <input type="radio" id="checkboxLabelFour" required class="" name="estado_inscripciones" value="0" <?php if(isset($estado_inscripciones) && $estado_inscripciones == "0") echo "checked";?>/>
                            </div>
                            Inactivo
                          </label>
                        </div>
                      </div>
                    </div>

                    <div class="mb-6">
                      <label class="mb-2.5 block font-medium text-black dark:text-white">
                        Estado del lapso académico<span class="text-meta-1 ">*</span>
                      </label>
                      <div class="flex items-center space-x-2">
                        <div class="mr-3">
                          <label for="checkboxLabelFour" class="flex cursor-pointer select-none items-center">
                            <div class="relative">
                              <input type="radio" id="checkboxLabelFour" class="" requried name="estado_ano_escolar" value="1" <?php if(isset($estado_ano_escolar) && $estado_ano_escolar == "1") echo "checked";?>/>
                            </div>
                            Activo
                          </label>
                        </div>

                        <div >
                          <label for="checkboxLabelFour" class="flex cursor-pointer select-none items-center">
                            <div class="relative">
                              <input type="radio" id="checkboxLabelFour" class="" required name="estado_ano_escolar" value="0" <?php if(isset($estado_ano_escolar) && $estado_ano_escolar == "0") echo "checked";?>/>
                            </div>
                            Inactivo
                          </label>
                        </div>
                      </div>
                    </div>
                  </div>

                    <button class="flex w-full justify-center rounded bg-primary p-3 font-medium text-gray">
                      Guardar
                    </button>
                  </div>
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
  <script>
    const { createApp } = Vue;

    createApp({
      data(){
        return {
          fecha_minima:"",
          fecha_maxima:""
        }
      },
    }).mount("#app_vue");
  </script>
</body>

</html>