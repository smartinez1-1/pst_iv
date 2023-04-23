<!DOCTYPE html>
<html lang="en">
<?php 
  $this->GetHeader("SGSC | UNEFA");

  require_once("./models/cls_comunidad.php");
  $model_c = new cls_comunidad();
  $comu = $model_c->Get_comunidades();

  $op = "Registrar";
  $id_tutor = null;
  $cedula_tutor = null;
  $nombre_tutor = null;
  $telefono_tutor = null;
  $id_comunidad = null;

  if(isset($this->id_consulta)){
    require_once("./models/cls_tutor_comunidad.php");
    
    $model = new cls_tutor_comunidad();
    $datos = $model->consulta($this->id_consulta);
    

    if(isset($datos['id_tutor'])){      
      $op = "Actualizar";
      $id_tutor = $datos['id_tutor'];
      $cedula_tutor = $datos['cedula_tutor'];
      $nombre_tutor = $datos['nombre_tutor_comunidad'];
      $telefono_tutor = $datos['telefono_tutor'];
      $id_comunidad = $datos['id_comunidad'];
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
          $this->GetComplement('breadcrumb',['title_breadcrumb' => "Modulo Tutor-Comunidad"]);
        ?>
          <!-- ====== Form Layout Section Start -->   
          <div class="grid grid-cols-1 gap-9 sm:grid-cols-1">
            <div class="flex flex-col gap-9">
              <!-- Contact Form -->
              <div
                class="rounded-sm border border-stroke bg-white shadow-default dark:border-strokedark dark:bg-boxdark">
                <div class="border-b border-stroke py-4 px-6.5 dark:border-strokedark">
                  <h3 class="font-semibold text-black dark:text-white">
                    Getion de Tutor-comunidad
                  </h3>
                </div>
                <form action="<?php $this->SetURL('controllers/tutor_comunidad_controller.php');?>" autocomplete="off" method="POST">
                  <input type="hidden" name="ope" value="<?php echo $op;?>">
                  <input type="hidden" name="id_tutor" value="<?php echo $id_tutor;?>">
                  <div class="p-6.5">
                    <div class="mb-4.5 flex flex-col gap-6 xl:flex-row">
                      <div class="w-full xl:w-4/6">
                        <label class="mb-2.5 block text-black dark:text-white">
                          Cedula del tutor <span class="text-meta-1">*</span>
                        </label>
                        <input required type="text" maxlength="8" pattern="[0-9]{8}" title="Solo de admiten numeros" required placeholder="Enter your first name" name="cedula_tutor" value="<?php echo $cedula_tutor;?>" <?php echo (isset($cedula_tutor)) ? "readonly" : "";?>
                          class="w-full rounded border-[1.5px] border-stroke bg-transparent py-3 px-5 font-medium outline-none transition focus:border-primary active:border-primary disabled:cursor-default disabled:bg-whiter dark:border-form-strokedark dark:bg-form-input dark:focus:border-primary" />
                      </div>
                    </div>
                    <div class="mb-4.5 flex flex-col gap-6 xl:flex-row">
                      <div class="w-full xl:w-4/6">
                        <label class="mb-2.5 block text-black dark:text-white">
                          Nombre del tutor <span class="text-meta-1">*</span>
                        </label>
                        <input required type="text" maxlength="45" title="Solo de admiten numeros" required placeholder="Enter your first name" name="nombre_tutor_comunidad" value="<?php echo $nombre_tutor;?>"
                          class="w-full rounded border-[1.5px] border-stroke bg-transparent py-3 px-5 font-medium outline-none transition focus:border-primary active:border-primary disabled:cursor-default disabled:bg-whiter dark:border-form-strokedark dark:bg-form-input dark:focus:border-primary" />
                      </div>
                    </div>
                    <div class="mb-4.5 flex flex-col gap-6 xl:flex-row">
                      <div class="w-full xl:w-4/6">
                        <label class="mb-2.5 block text-black dark:text-white">
                          Telefono <span class="text-meta-1">*</span>
                        </label>
                        <input type="text" maxlength="11" pattern="[0-9]{11}" title="Solo de admiten numeros" required placeholder="Enter your first name" name="telefono_tutor" value="<?php echo $telefono_tutor;?>"
                          class="w-full rounded border-[1.5px] border-stroke bg-transparent py-3 px-5 font-medium outline-none transition focus:border-primary active:border-primary disabled:cursor-default disabled:bg-whiter dark:border-form-strokedark dark:bg-form-input dark:focus:border-primary" />
                      </div>
                    </div>
                    <div class="mb-4.5">
                      <label class="mb-3 block font-medium text-black dark:text-white">
                        Seleccione una comunidad
                      </label>
                      <div class="relative z-20 bg-white dark:bg-form-input">
                        <select required name="id_comunidad"
                          class="relative z-20 w-full appearance-none rounded border border-stroke bg-transparent py-3 px-12 outline-none transition focus:border-primary active:border-primary dark:border-form-strokedark dark:bg-form-input">
                          <option value="">Seleccione una opcion</option>
                          <?php foreach($comu as $co){?>
                            <option <?php echo ($id_comunidad == $co['id_comunidad']) ? "selected" : "";?> value="<?php echo $co['id_comunidad'];?>">Comunidad: <?php echo $co['nombre_comunidad'];?></option>
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