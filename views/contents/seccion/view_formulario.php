<!DOCTYPE html>
<html lang="en">
<?php
$this->GetHeader("SGSC | UNEFA");

require_once("./models/cls_carrera.php");
$model = new cls_carrera();
$carreras = $model->Get_carreras();

$op = "Registrar";
$id_seccion = null;
$numero_seccion = null;
$carrera_id = null;
$estado_seccion = null;

if (isset($this->id_consulta)) {
  require_once("./models/cls_seccion.php");
  $model = new cls_seccion();
  $datos = $model->consulta($this->id_consulta);

  if (isset($datos['id_seccion'])) {
    $op = "Actualizar";
    $id_seccion = $datos['id_seccion'];
    $numero_seccion = $datos['numero_seccion'];
    $carrera_id = $datos['carrera_id'];
    $estado_seccion = $datos['estado_seccion'];
  }
}

?>

<body x-data="{ page: 'signin', 'loaded': true, 'darkMode': true, 'stickyMenu': false, 'sidebarToggle': false, 'scrollTop': false }" x-init="
          darkMode = JSON.parse(localStorage.getItem('darkMode'));
          $watch('darkMode', value => localStorage.setItem('darkMode', JSON.stringify(value)))" :class="{'dark text-bodydark bg-boxdark-2': darkMode === true}">

  <!-- ===== Page Wrapper Start ===== -->
  <div class="flex h-screen overflow-hidden">
    <?php $this->GetComplement('sidebar_menu'); ?>
    <!-- ===== Content Area Start ===== -->
    <div class="relative flex flex-1 flex-col overflow-y-auto overflow-x-hidden">
      <?php $this->GetComplement('header'); ?>
      <main>
        <div class="max-w-screen-2xl mx-auto p-4 md:p-6 2xl:p-10">
          <?php
          $this->GetComplement('breadcrumb', ['title_breadcrumb' => "Gestión Sección"]);
          ?>
          <!-- ====== Form Layout Section Start -->
          <div class="grid grid-cols-1 gap-9 sm:grid-cols-1">
            <div class="flex flex-col gap-9">
              <!-- Contact Form -->
              <div class="rounded-sm border border-stroke bg-white shadow-default dark:border-strokedark dark:bg-boxdark">
                <div class="border-b border-stroke py-4 px-6.5 dark:border-strokedark">
                  <h3 class="font-semibold text-black dark:text-white">
                    Gestión de Sección
                  </h3>
                </div>
                <form action="<?php $this->SetURL('controllers/seccion_controller.php'); ?>" autocomplete="off" method="POST">
                  <input type="hidden" name="ope" value="<?php echo $op; ?>">
                  <input type="hidden" name="id_seccion" value="<?php echo $id_seccion; ?>">
                  <div class="p-6.5">
                    <div class="mb-4.5 flex flex-col gap-6 xl:flex-row">
                      <div class="w-full xl:w-4/6">
                        <label class="mb-2.5 block text-black dark:text-white">
                          Código de la sección <span class="text-meta-1">*</span>
                        </label>
                        <input type="text" maxlength="13" minlength="10" id="seccion_code" style="text-transform: uppercase;" title="Solo de admiten numeros" required placeholder="" name="numero_seccion" value="<?php echo $numero_seccion; ?>" class="w-full rounded border-[1.5px] border-stroke bg-transparent py-3 px-5 font-medium outline-none transition focus:border-primary active:border-primary disabled:cursor-default disabled:bg-whiter dark:border-form-strokedark dark:bg-form-input dark:focus:border-primary" />
                      </div>
                      <div class="w-full xl:w-2/6">
                        <label class="mb-2.5 block text-black dark:text-white">
                          Estado de la sección <span class="text-meta-1">*</span>
                        </label>
                        <div class="flex items-center space-x-2">
                          <div class="mr-4">
                            <label for="checkboxLabelFour" class="flex cursor-pointer select-none items-center">
                              <div class="relative">
                                <input type="radio" required id="checkboxLabelFour" class="" name="estado_seccion" value="1" <?php echo ($estado_seccion == '1') ? "checked" : ""; ?> />
                              </div>
                              Activo
                            </label>
                          </div>

                          <div class="ml-4">
                            <label for="checkboxLabelFour" class="flex cursor-pointer select-none items-center">
                              <div class="relative">
                                <input type="radio" required id="checkboxLabelFour" class="" name="estado_seccion" value="0" <?php echo ($estado_seccion == '0') ? "checked" : ""; ?> />
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
  <?php $this->GetComplement('scripts'); ?>
</body>

</html>