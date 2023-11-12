<!DOCTYPE html>
<html lang="en">
<?php $this->GetHeader("SGSC | UNEFA");?>
<body
	x-data="{ page: 'signin', 'loaded': true, 'darkMode': true, 'stickyMenu': false, 'sidebarToggle': false, 'scrollTop': false }"
	x-init="
          darkMode = JSON.parse(localStorage.getItem('darkMode'));
          $watch('darkMode', value => localStorage.setItem('darkMode', JSON.stringify(value)))"
	:class="{'dark text-bodydark bg-boxdark-2': darkMode === true}">

	<!-- ===== Page Wrapper Start ===== -->
	<div class="flex h-screen overflow-hidden">
    <!-- AQUI ESTAMOS EN LA VISTA DE CARRERA, AJA, AQUI USAMOS LOS METODOS GETCOMPLEMENT PARA IR METIENDO, LO QUE NECESITAMOS EN LA VISTA, EL SIDEBAR_MENU, EL HEADER Y BREADCRUMB (SON EL TITULO Y EL ENLACE QUE SALEN ARRIBA DE CADA MODULO) -->
		<?php $this->GetComplement('sidebar_menu');?>
		<!-- ===== Content Area Start ===== -->
		<div class="relative flex flex-1 flex-col overflow-y-auto overflow-x-hidden">
		<?php $this->GetComplement('header');?>
      <main>
        <div class="max-w-screen-2xl mx-auto p-4 md:p-6 2xl:p-10">
        <?php 
          $this->GetComplement('breadcrumb',['title_breadcrumb' => "Biblioteca"]);
        ?>
          <!-- ====== Table Three Start -->
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
                   
                    
                    foreach($datos as $documento){
                      ?>
                      <tr>

                        <td class="border-b border-[#eee] py-5 px-4 dark:border-strokedark">
                          <p class="text-black dark:text-white"><?php print($documento["nombre_documento"])?></p>
                        </td>
                        <td class="border-b border-[#eee] py-5 px-4 dark:border-strokedark">
                          <p class="text-black dark:text-white"><?php print($documento["des_categoria"])?></p>
                        </td>
                        <td class="border-b border-[#eee] py-5 px-4 dark:border-strokedark">
                          <?php $text = ($documento['estatus_documento'] == '1') ? "text-success" : "text-danger";?>
                          <p class="inline-flex rounded-full bg-success bg-opacity-10 py-1 px-3 text-sm font-medium <?php echo $text;?>">
                          <?php echo ($documento['estatus_documento'] == '1') ? "Activo" : "Inactivo";?>
                        </td>
                        <td class="border-b border-[#eee] py-5 px-4 dark:border-strokedark">
                          <p class="text-black dark:text-white"> 
                            <a title="descargar" class="inline-flex rounded-full bg-success bg-opacity-10 py-1 px-3 text-sm font-medium text-primary" href="<?php print($documento["ruta_file_documento"]);?>" download>
                              <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-download"><path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"></path><polyline points="7 10 12 15 17 10"></polyline><line x1="12" y1="15" x2="12" y2="3"></line></svg>
                            </a> 
                          </p>
                        </td>
                        <td class="border-b border-[#eee] py-5 px-4 dark:border-strokedark">
                          <p class="text-black dark:text-white"> 
                            <a title="ver documento" class="inline-flex rounded-full bg-success bg-opacity-10 py-1 px-3 text-sm font-medium text-danger" href="<?php print($documento["ruta_file_documento"]);?>" target="_blank">
                              <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-link"><path d="M10 13a5 5 0 0 0 7.54.54l3-3a5 5 0 0 0-7.07-7.07l-1.72 1.71"></path><path d="M14 11a5 5 0 0 0-7.54-.54l-3 3a5 5 0 0 0 7.07 7.07l1.71-1.71"></path></svg>
                            </a> 
                          </p>
                        </td>
                        <td class="border-b border-[#eee] py-5 px-4 dark:border-strokedark">
                          <p class="text-black dark:text-white"> 
                            <a class="inline-flex rounded-full bg-success bg-opacity-10 py-1 px-3 text-sm font-medium text-danger" href="<?php $this->SetURL('controllers/biblioteca_controller.php'."?ope=Eliminar&id_documento=".$documento["id_documento"]);?>">
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
	<?php $this->GetComplement('scripts');?>
</body>

</html>