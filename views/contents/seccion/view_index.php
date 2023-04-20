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
		<?php $this->GetComplement('sidebar_menu');?>
		<!-- ===== Content Area Start ===== -->
		<div class="relative flex flex-1 flex-col overflow-y-auto overflow-x-hidden">
		<?php $this->GetComplement('header');?>
      <main>
        <div class="max-w-screen-2xl mx-auto p-4 md:p-6 2xl:p-10">
        <?php 
          $this->GetComplement('breadcrumb',['title_breadcrumb' => "Modulo Seccion"]);
        ?>
          <!-- ====== Table Three Start -->
          <div class="rounded-sm border border-stroke bg-white px-5 pt-6 pb-2.5 shadow-default dark:border-strokedark dark:bg-boxdark sm:px-7.5 xl:pb-1">
            <div class="max-w-full overflow-x-auto">
              <table class="w-full table-auto">
                <thead>
                  <tr class="bg-gray-2 text-left dark:bg-meta-4">
                    <th class="min-w-[220px] py-4 px-4 font-medium text-black dark:text-white xl:pl-11">
                      Id seccion
                    </th>
                    <th class="min-w-[220px] py-4 px-4 font-medium text-black dark:text-white xl:pl-11">
                      numero de seccion
                    </th>
                    <th class="min-w-[120px] py-4 px-4 font-medium text-black dark:text-white">
                      Estado
                    </th>
                    <th class="py-4 px-4 font-medium text-black dark:text-white">
                      Opciones
                    </th>
                  </tr>
                </thead>
                <tbody>
                  <?php 
                    require_once("./models/cls_seccion.php");
                    $model = new cls_seccion();
                    $datos = $model->Get_secciones();
                    
                    foreach($datos as $sec){
                      ?>
                      <tr>
                        <td class="border-b border-[#eee] py-5 px-4 pl-9 dark:border-strokedark xl:pl-11">
                          <h5 class="font-medium text-black dark:text-white"><?php echo $sec['id_seccion'];?></h5>
                        </td>
                        <td class="border-b border-[#eee] py-5 px-4 dark:border-strokedark">
                          <p class="text-black dark:text-white"><?php echo $sec['numero_seccion'];?></p>
                        </td>
                        <td class="border-b border-[#eee] py-5 px-4 dark:border-strokedark">
                          <?php $text = ($sec['estado_seccion'] == '1') ? "text-success" : "text-danger";?>
                          <p class="inline-flex rounded-full bg-success bg-opacity-10 py-1 px-3 text-sm font-medium <?php echo $text;?>">
                          <?php echo ($sec['estado_seccion'] == '1') ? "Activo" : "Inactivo";?>
                          </p>
                        </td>
                        <td class="border-b border-[#eee] py-5 px-4 dark:border-strokedark">
                          <div class="flex items-center space-x-3.5">
                            <a href="<?php $this->SetURL('carrera/formulario/b/'.$sec['id_seccion']);?>">Editar</a>
                          </div>
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