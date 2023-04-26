<!DOCTYPE html>
<html lang="en">
<?php 
  $this->GetHeader("SGSC | UNEFA");

  $op = "Registrar";
  $id_comunidad = null;
  $nombre_comunidad = null;
  $tipo_comunidad = null;
  $direccion_comunidad = null;

  if(isset($this->id_consulta)){
    require_once("./models/cls_comunidad.php");
    $model = new cls_comunidad();
    $datos = $model->consulta($this->id_consulta);

    if(isset($datos['id_comunidad'])){      
      $op = "Actualizar";
      $id_comunidad = $datos['id_comunidad'];
      $nombre_comunidad = $datos['nombre_comunidad'];
      $tipo_comunidad = $datos['tipo_comunidad'];
      $direccion_comunidad = $datos['direccion_comunidad'];
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
          $this->GetComplement('breadcrumb',['title_breadcrumb' => "Modulo Comunidad"]);
        ?>
        <div class="grid grid-cols-1 gap-9 sm:grid-cols-1">
            <div class="flex flex-col gap-9">
              <!-- Contact Form -->
              <div
                class=" rounded-sm border border-stroke bg-white shadow-default dark:border-strokedark dark:bg-boxdark">
                <div class="border-b border-stroke py-4 px-6.5 dark:border-strokedark">
                  <h3 class="font-semibold text-black dark:text-white text-center">
                    Gestion de Comunidad 
                  </h3>
                </div>
                <form action="<?php $this->SetURL('controllers/comunidad_controller.php');?>" autocomplete="off" method="POST">
                  <input type="hidden" name="ope" value="<?php echo $op;?>">  
                  <input type="hidden" name="id_comunidad" value="<?php echo $id_comunidad;?>">
                  <div class="p-6.5">
                    <div class="mb-4.5 flex flex-col gap-6 xl:flex-row">
                      <div class="w-full xl:w-2/6">
                        <label class="mb-2.5 block text-black dark:text-white">
                          Nombre de la Comunidad <span class="text-meta-1">*</span>
                        </label>
                        <input type="text" maxlength="45" minlength="5" pattern="[a-zA-Z]" placeholder="" name="nombre_comunidad" value="<?php echo $nombre_comunidad;?>"
                          class="w-full rounded border-[1.5px] border-stroke bg-transparent py-3 px-5 font-medium outline-none transition focus:border-primary active:border-primary disabled:cursor-default disabled:bg-whiter dark:border-form-strokedark dark:bg-form-input dark:focus:border-primary" />
                      </div>

                      <div class="w-full xl:w-2/6">
                        <label class="mb-2.5 block text-black dark:text-white">
                          Tipo de Comunidad<span class="text-meta-1">*</span>
                        </label>
                        <input type="text" maxlength="45" minlength="5" pattern="[a-zA-Z]" placeholder="" name="tipo_comunidad" value="<?php echo $tipo_comunidad;?>"
                          class="w-full rounded border-[1.5px] border-stroke bg-transparent py-3 px-5 font-medium outline-none transition focus:border-primary active:border-primary disabled:cursor-default disabled:bg-whiter dark:border-form-strokedark dark:bg-form-input dark:focus:border-primary" />
                      </div>
                  </div>
                  <div>
                    <div class="mb-6">
                      <label class="mb-2.5 block text-black dark:text-white">
                       Direccion de la comunidad <span class="text-meta-1">*</span>
                      </label>
                      <textarea rows="6" maxlength="80" minlength="5" pattern="[a-zA-Z]" placeholder="Ingrese su Direccion" name="direccion_comunidad" value="<?php echo $direccion_comunidad;?>"
                        class="w-full rounded border-[1.5px] border-stroke bg-transparent py-3 px-5 font-medium outline-none transition focus:border-primary active:border-primary disabled:cursor-default disabled:bg-whiter dark:border-form-strokedark dark:bg-form-input dark:focus:border-primary"></textarea>
                    </div>
                    <div class="flex flex-row justify-center items-center">
                      <button class="flex w-72 flex-col justify-center items-center rounded bg-primary p-3 font-medium text-gray">
                        Guardar
                       </button>
                    </div>
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