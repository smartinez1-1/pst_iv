<!DOCTYPE html>
<html lang="en">
<?php 
  $this->GetHeader("SGSC | UNEFA");

  $op = "Registrar";
  $id_ano_escolar = null;
  $ano_escolar_nombre = null;
  $estado_ano_escolar = null;
  $estado_inscripciones = null;

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
          $this->GetComplement('breadcrumb',['title_breadcrumb' => "Modulo Lapso Academico"]);
        ?>
          <!-- ====== Form Layout Section Start -->   
          <div class="grid grid-cols-1 gap-9 sm:grid-cols-1">
            <div class="flex flex-col gap-9">
              <!-- Contact Form -->
              <div
                class="rounded-sm border border-stroke bg-white shadow-default dark:border-strokedark dark:bg-boxdark">
                <div class="border-b border-stroke py-4 px-6.5 dark:border-strokedark">
                  <h3 class="font-semibold text-black dark:text-white">
                    Getion de Lapso Academico
                  </h3>
                </div>
                <form action="<?php $this->SetURL('controllers/lapso_academico_controller.php');?>" autocomplete="off" method="POST">
                  <input type="hidden" name="ope" value="<?php echo $op;?>">
                  <input type="hidden" name="id_ano_escolar" value="<?php echo $id_ano_escolar;?>">
                  <div class="p-6.5">
                    <div class="mb-4.5 flex flex-col gap-6 xl:flex-row">
                      <div class="w-full xl:w-2/6">
                        <label class="mb-2.5 block text-black dark:text-white">
                          Descripcion<span class="text-meta-1">*</span>
                        </label>
                        <input type="text" placeholder="" name="ano_escolar_nombre" value="<?php echo $ano_escolar_nombre;?>"
                          class="w-full rounded border-[1.5px] border-stroke bg-transparent py-3 px-5 font-medium outline-none transition focus:border-primary active:border-primary disabled:cursor-default disabled:bg-whiter dark:border-form-strokedark dark:bg-form-input dark:focus:border-primary" />
                      </div>
                    </div>
                    <div class="mb-6">
                      <label class="mb-2.5 block font-medium text-black dark:text-white">
                        Estado de Inscripciones<span class="text-meta-1 ">*</span>
                      </label>
                      <div class="flex items-center space-x-2">
                        <div class="mr-3">
                          <label for="checkboxLabelFour" class="flex cursor-pointer select-none items-center">
                            <div class="relative">
                              <input type="radio" id="checkboxLabelFour" class="" name="estado_inscripciones" value="1" <?php if(isset($estado_inscripciones) && $estado_inscripciones == "1") echo "checked";?>/>
                            </div>
                            Activo
                          </label>
                        </div>

                        <div >
                          <label for="checkboxLabelFour" class="flex cursor-pointer select-none items-center">
                            <div class="relative">
                              <input type="radio" id="checkboxLabelFour" class="" name="estado_inscripciones" value="0" <?php if(isset($estado_inscripciones) && $estado_inscripciones == "0") echo "checked";?>/>
                            </div>
                            Inactivo
                          </label>
                        </div>
                      </div>
                    </div>

                    <div class="mb-6">
                      <label class="mb-2.5 block font-medium text-black dark:text-white">
                        Estado del Año Escolar<span class="text-meta-1 ">*</span>
                      </label>
                      <div class="flex items-center space-x-2">
                        <div class="mr-3">
                          <label for="checkboxLabelFour" class="flex cursor-pointer select-none items-center">
                            <div class="relative">
                              <input type="radio" id="checkboxLabelFour" class="" name="estado_ano_escolar" value="1" <?php if(isset($estado_ano_escolar) && $estado_ano_escolar == "1") echo "checked";?>/>
                            </div>
                            Activo
                          </label>
                        </div>

                        <div >
                          <label for="checkboxLabelFour" class="flex cursor-pointer select-none items-center">
                            <div class="relative">
                              <input type="radio" id="checkboxLabelFour" class="" name="estado_ano_escolar" value="0" <?php if(isset($estado_ano_escolar) && $estado_ano_escolar == "0") echo "checked";?>/>
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
</body>

</html>