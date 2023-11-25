<!DOCTYPE html>
<html lang="en">
<?php $this->GetHeader("SGSC | UNEFA"); ?>

<body x-data="{ page: 'signin', 'loaded': true, 'darkMode': true, 'stickyMenu': false, 'sidebarToggle': false, 'scrollTop': false }" x-init="
          darkMode = JSON.parse(localStorage.getItem('darkMode'));
          $watch('darkMode', value => localStorage.setItem('darkMode', JSON.stringify(value)))" :class="{'dark text-bodydark bg-boxdark-2': darkMode === true}">

  <!-- ===== Page Wrapper Start ===== -->
  <div class="flex h-screen overflow-hidden">
    <!-- AQUI ESTAMOS EN LA VISTA DE CARRERA, AJA, AQUI USAMOS LOS METODOS GETCOMPLEMENT PARA IR METIENDO, LO QUE NECESITAMOS EN LA VISTA, EL SIDEBAR_MENU, EL HEADER Y BREADCRUMB (SON EL TITULO Y EL ENLACE QUE SALEN ARRIBA DE CADA MODULO) -->
    <?php $this->GetComplement('sidebar_menu'); ?>
    <!-- ===== Content Area Start ===== -->
    <div class="relative flex flex-1 flex-col overflow-y-auto overflow-x-hidden">
      <?php $this->GetComplement('header'); ?>
      <main>
        <div class="max-w-screen-2xl mx-auto p-4 md:p-6 2xl:p-10">
          <?php
          $this->GetComplement('breadcrumb', ['title_breadcrumb' => "Biblioteca"]);
          ?>
          <!-- ====== Table Three Start -->
          <div class="w-full mb-5">
            <div x-data="{modalOpen: false}">
              <button @click="modalOpen = true" class="rounded-md bg-primary py-3 px-9 font-medium text-white w-28">Categoria </button>
              <div x-show="modalOpen" x-transition class="fixed top-0 left-0 z-999999 flex h-full min-h-screen w-full items-center justify-center bg-black/90 px-4 py-5">
                <div @click.outside="modalOpen = false" class="w-full max-w-142.5 rounded-lg bg-white py-12 px-8 dark:bg-boxdark md:py-15 md:px-17.5 relative">
                  <div style="position: absolute;top: 20px;right: 20px;">
                    <svg @click="modalOpen = false" xmlns="http://www.w3.org/2000/svg" width="40" height="40" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg>
                  </div>
                  <div class="text-center">
                    <h3 class="pb-2 text-xl font-bold text-black dark:text-white sm:text-2xl">
                      Categoria
                    </h3>
                    <span class="mx-auto mb-6 inline-block h-1 w-22.5 rounded bg-primary"></span>
                  </div>
                  <form>
                    <div class="mb-4.5 flex flex-col gap-6 xl:flex-row">
                      <div class="w-full xl:w-2/6">
                        <label class="mb-2.5 block text-black dark:text-white">
                          Nombre <span class="text-meta-1">*</span>
                        </label>
                        <input type="text" pattern="[a-zA-ZñÑáéíóúÁÉÍÓÚ\s]+" required placeholder="Nombre" name="des_categoria" class="w-full rounded border-[1.5px] border-stroke bg-transparent py-3 px-5 font-medium outline-none transition focus:border-primary active:border-primary disabled:cursor-default disabled:bg-whiter dark:border-form-strokedark dark:bg-form-input dark:focus:border-primary" />
                      </div>
                    </div>
                    <div class="mb-4.5 flex flex-col gap-6 xl:flex-row">
                      <div class="w-full xl:w-2/6">
                        <label class="mb-2.5 block text-black dark:text-white">
                          Estado<span class="text-meta-1">*</span>
                        </label>
                        <div class="flex items-center space-x-2">
                          <div class="mr-3">
                            <label for="checkboxLabelFour" class="flex cursor-pointer select-none items-center">
                              <div class="relative">
                                <input type="radio" required="" id="checkboxLabelFour" name="estatus_documento" value="1" checked>
                              </div>
                              Activo
                            </label>
                          </div>
                          <!-- LO QUE QUEDA ABAJO ES EL BOTON DE GUARDAR -->

                          <div>
                            <label for="checkboxLabelFour" class="flex cursor-pointer select-none items-center">
                              <div class="relative">
                                <input type="radio" required="" id="checkboxLabelFour" name="estatus_documento" value="0">
                              </div>
                              Inactivo
                            </label>
                          </div>
                        </div>
                      </div>
                    </div>
                  </form>

                  <table class="w-full table-auto mb-10">
                    <thead>
                      <tr class="bg-gray-2 text-left dark:bg-meta-4">
                        <th class="min-w-[150px] py-4 px-4 font-medium text-black dark:text-white" style="width: 280px !important;">
                          Nombre
                        </th>
                        <th class="min-w-[150px] py-4 px-4 font-medium text-black dark:text-white">

                        </th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr>
                        <td class="border-b border-[#eee] py-5 px-4 dark:border-strokedark" >
                          hola
                        </td>
                        <td class="border-b border-[#eee] py-5 px-4 dark:border-strokedark">
                          <button class="block rounded border bg-danger p-3 text-center font-medium text-white transition hover:bg-opacity-90 w-full flex justify-center">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-trash-2"><polyline points="3 6 5 6 21 6"></polyline><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path><line x1="10" y1="11" x2="10" y2="17"></line><line x1="14" y1="11" x2="14" y2="17"></line></svg>
                          </button>
                        </td>
                      </tr>

                    </tbody>
                  </table>



                  <div class="-mx-3 flex flex-wrap justify-end gap-4">
                    <!-- <div class="w-28">
                      <button @click="modalOpen = false" class="block rounded border border-stroke bg-gray p-3 text-center font-medium text-black transition hover:border-meta-1 hover:bg-meta-1 hover:text-white dark:border-strokedark dark:bg-meta-4 dark:text-white dark:hover:border-meta-1 dark:hover:bg-meta-1">
                        Cancelar
                      </button>
                    </div> -->
                    <div class="w-28">
                      <button class="block rounded border border-primary bg-primary p-3 text-center font-medium text-white transition hover:bg-opacity-90">
                        Guardar
                      </button>
                    </div>
                  </div>

                </div>
              </div>
            </div>
          </div>



















          <div class="rounded-sm border border-stroke bg-white px-5 pt-6 pb-2.5 shadow-default dark:border-strokedark dark:bg-boxdark sm:px-7.5 xl:pb-1">
            <div class="max-w-full overflow-x-auto">
              <!-- YA QUE ESTA ES LA VISTA INDEX, AQUI TENEMOS UNA TABLA DONDE SE MUESTRAN TODOS LOS DATOS REGISTRADOS -->
              <table class="w-full table-auto">
                <thead>
                  <tr class="bg-gray-2 text-left dark:bg-meta-4">
                    <th class="min-w-[150px] py-4 px-4 font-medium text-black dark:text-white">
                      Nombre
                    </th>
                    <th class="min-w-[150px] py-4 px-4 font-medium text-black dark:text-white">
                      Categoria
                    </th>
                    <th class="min-w-[150px] py-4 px-4 font-medium text-black dark:text-white">
                      Estado
                    </th>
                    <th class="min-w-[150px] py-4 px-4 font-medium text-black dark:text-white">

                    </th>
                    <th class="min-w-[150px] py-4 px-4 font-medium text-black dark:text-white">

                    </th>
                    <th class="min-w-[150px] py-4 px-4 font-medium text-black dark:text-white">

                    </th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                  require_once("./models/cls_documentos.php");
                  $model = new cls_documentos();
                  $datos = $model->consultarTodo();


                  foreach ($datos as $documento) {
                  ?>
                    <tr>

                      <td class="border-b border-[#eee] py-5 px-4 dark:border-strokedark">
                        <p class="text-black dark:text-white"><?php print($documento["nombre_documento"]) ?></p>
                      </td>
                      <td class="border-b border-[#eee] py-5 px-4 dark:border-strokedark">
                        <p class="text-black dark:text-white"><?php print($documento["des_categoria"]) ?></p>
                      </td>
                      <td class="border-b border-[#eee] py-5 px-4 dark:border-strokedark">
                        <?php $text = ($documento['estatus_documento'] == '1') ? "text-success" : "text-danger"; ?>
                        <p class="inline-flex rounded-full bg-success bg-opacity-10 py-1 px-3 text-sm font-medium <?php echo $text; ?>">
                          <?php echo ($documento['estatus_documento'] == '1') ? "Activo" : "Inactivo"; ?>
                      </td>
                      <td class="border-b border-[#eee] py-5 px-4 dark:border-strokedark">
                        <p class="text-black dark:text-white">
                          <a title="descargar" class="inline-flex rounded-full bg-success bg-opacity-10 py-1 px-3 text-sm font-medium text-primary" href="<?php print($documento["ruta_file_documento"]); ?>" download>
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-download">
                              <path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"></path>
                              <polyline points="7 10 12 15 17 10"></polyline>
                              <line x1="12" y1="15" x2="12" y2="3"></line>
                            </svg>
                          </a>
                        </p>
                      </td>
                      <td class="border-b border-[#eee] py-5 px-4 dark:border-strokedark">
                        <p class="text-black dark:text-white">
                          <a title="ver documento" class="inline-flex rounded-full bg-success bg-opacity-10 py-1 px-3 text-sm font-medium text-danger" href="<?php print($documento["ruta_file_documento"]); ?>" target="_blank">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-link">
                              <path d="M10 13a5 5 0 0 0 7.54.54l3-3a5 5 0 0 0-7.07-7.07l-1.72 1.71"></path>
                              <path d="M14 11a5 5 0 0 0-7.54-.54l-3 3a5 5 0 0 0 7.07 7.07l1.71-1.71"></path>
                            </svg>
                          </a>
                        </p>
                      </td>
                      <td class="border-b border-[#eee] py-5 px-4 dark:border-strokedark">
                        <p class="text-black dark:text-white">
                          <a class="inline-flex rounded-full bg-success bg-opacity-10 py-1 px-3 text-sm font-medium text-danger" href="<?php $this->SetURL('controllers/biblioteca_controller.php' . "?ope=Eliminar&id_documento=" . $documento["id_documento"]); ?>">
                            Eliminar
                          </a>
                        </p>
                      </td>
                    </tr>

                  <?php
                  }
                  ?>
                </tbody>
              </table>
            </div>
          </div>
          <!-- ====== Table Three End -->
        </div>
      </main>
    </div>
    <!-- ===== Content Area End ===== -->
  </div>
  <!-- ===== Page Wrapper End ===== -->
  <?php $this->GetComplement('scripts'); ?>
</body>

</html>