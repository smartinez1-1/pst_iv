<!DOCTYPE html>
<html lang="en">
<?php 
  $this->GetHeader("SGSC | UNEFA");

  $op = "Registrar";
  $id_documento  =null;
  $nombre_documento =null;
  $ruta_file_documento =null;
  $categoria_id_documento  =null;
  $extension_documento =null;
  $fecha_subida_documento =null;
  $estatus_documento =null;
  // AHORA, EN EL CASO DE QUE VAYAMOS A CONSULTAR, LA VARIABLE ID_CONSULTA YA ES DEFINIDA EN LA CLASE APP, AQUI VERIFICAMOS QUE DICHA ID EXISTA, SI EXISTE, REQUERIMOS LA CLASE CARRERA PARA PODER HACER LA CONSULTA DE LA INFORMACION Y ABAJO DEFINIR LAS VARIABLES
  // EN EL CASO DE QUE NO VAYAMOS A EDITAR NADA, LA OPERACION SERA REGISTRAR, SINO, LA OPERACION SERA ACTUALIZAR
//   if(isset($this->id_consulta)){
//     require_once("./models/cls_carrera.php");
//     $model = new cls_carrera();
//     $datos = $model->consulta($this->id_consulta);

//     if(isset($datos['id_carrera'])){      
//       $op = "Actualizar";
//       $id_carrera = $datos['id_carrera'];
//       $codigo_carrera = $datos['codigo_carrera'];
//       $nombre_carrera = $datos['nombre_carrera'];
//       $estado_carrera = $datos['estado_carrera'];
//     }
//   }

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
          $this->GetComplement('breadcrumb',['title_breadcrumb' => "Biblioteca"]);
        ?>
          <!-- ====== Form Layout Section Start -->   
          <div class="grid grid-cols-1 gap-9 sm:grid-cols-1">
            <div class="flex flex-col gap-9">
              <!-- Contact Form -->
              <div
                class="rounded-sm border border-stroke bg-white shadow-default dark:border-strokedark dark:bg-boxdark">
                <!-- <div class="border-b border-stroke py-4 px-6.5 dark:border-strokedark">
                  <h3 class="font-semibold text-black dark:text-white">
                  Gestión de carreras
                  </h3>
                </div> -->
                <!-- ACA ESTA EL FOMULARIO, EL ACTION CONTIENE LA URL ESTATICA QUE APUNTA AL CONTROLADOR DE CARRERA, DICHO FORMULARIO CONTIENE PRIMERO 2 INPUTS DE TIPO HIDDEN (ESCONDIDO), UNO ES PARA DEFINIR QUE OPERACION VAMOS A REALIZAR OPE, Y EL OTRO CAMPO ES PARA METER EL ID DE LA CARRERA -->
                <form id="formulario" action="<?php $this->SetURL('controllers/biblioteca_controller.php');?>" onsubmit="guardar(event)" autocomplete="off" method="POST" enctype="multipart/form-data">
                    <?php
                        include_once("./models/cls_categorias_documentos.php");
                        $CategoriDocumento=new cls_categorias_documentos();
                        $categorias=$CategoriDocumento->consultarTodo();
                        // print_r($datos);
                    ?>
                  <input type="hidden" name="ope" value="<?php echo $op;?>">
                  <input type="hidden" name="id_documento" value="<?php print($id_documento);?>">
                  <!-- <input type="submit" value=""> -->
                  <!-- OH BUENO, FALTA VER LA TRANSACCION -->
                  <div class="p-6.5">
                    <div class="mb-4.5 flex flex-col gap-6 xl:flex-row">
                      <div class="w-full xl:w-2/6">
                        <label class="mb-2.5 block text-black dark:text-white">
                          Nombre <span class="text-meta-1">*</span>
                        </label>
                        <input type="text" maxlength="45" minlength="5" pattern="[a-zA-ZñÑáéíóúÁÉÍÓÚ\s]+" required placeholder="Ingresa el nombre del documento" name="nombre_documento" value="<?php print($nombre_documento);?>"
                          class="w-full rounded border-[1.5px] border-stroke bg-transparent py-3 px-5 font-medium outline-none transition focus:border-primary active:border-primary disabled:cursor-default disabled:bg-whiter dark:border-form-strokedark dark:bg-form-input dark:focus:border-primary" />
                      </div>
                      <div class="w-full xl:w-2/6">
                        <label class="mb-3 block font-medium text-black dark:text-white">
                          Categoria <span class="text-meta-1"></span>
                        </label>
                        <div class="relative z-20 bg-white dark:bg-form-input">
                          <select required name="categoria_id_documento" class="relative z-20 w-full appearance-none rounded border border-stroke bg-transparent py-3 px-12 outline-none transition focus:border-primary active:border-primary dark:border-form-strokedark dark:bg-form-input">
                            <?php
                                foreach($categorias as $catergoria){
                                    print("<option value='".$catergoria["id_categoria"]."'>".$catergoria["des_categoria"]."</option>");
                                }                            
                            ?>
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
                    <div class="w-full xl:w-2/6 relative mb-5">
                      <div class="flex justify-center items-center" style="height: 100px;border: 5px #1a222c dashed;">
                          <div class=" absolute z-10" id="textoInputFiles">Abjuntar Pdf</div>
                      </div>
                      <input class=" absolute z-99 top-1 w-full h-full opacity-0" type="file" name="archivoPdf" id="archivoPdf" draggable="draggable" onchange="mensajeCargarDeArchivo()" accept=".pdf">
                    </div>
                    <div class="w-full xl:w-6/6">
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
  <script src="<?php echo constant("URL");?>views/js/biblioteca/formulario.js"></script>
</body>

</html>