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
          $this->GetComplement('breadcrumb',['title_breadcrumb' => "Gestión Estudiante"]);
        ?>
          <!-- ====== Table Three Start -->
          <div class="rounded-sm border border-stroke bg-white px-5 pt-6 pb-2.5 shadow-default dark:border-strokedark dark:bg-boxdark sm:px-7.5 xl:pb-1">
            <div class="max-w-full overflow-x-auto">
              <table class="w-full table-auto">
                <thead>
                  <tr class="bg-gray-2 text-left dark:bg-meta-4">
                    <th class="min-w-[220px] py-2 px-2 font-bold text-black dark:text-white xl:pl-11">
                      Matricula
                    </th>
                    <th class="min-w-[220px] py-2 px-2 font-bold text-black dark:text-white xl:pl-11">
                      Cédula
                    </th>
                    <th class="min-w-[220px] py-2 px-2 font-bold text-black dark:text-white xl:pl-11">
                      Nombre
                    </th>
                    <th class="min-w-[220px] py-2 px-2 font-bold text-black dark:text-white xl:pl-11">
                      Carrera 
                    </th>
                    <th class="min-w-[220px] py-2 px-2 font-bold text-black dark:text-white xl:pl-11">
                      Sección 
                    </th>
                    <th class="min-w-[220px] py-2 px-2 font-bold text-black dark:text-white xl:pl-11">
                      Lapso académico 
                    </th>
                    <th class="py-2 px-2 font-bold text-black dark:text-white">
                      Opciones
                    </th>
                  </tr>
                </thead>
                <tbody>
                  <?php 
                    require_once("./models/cls_inscripcion.php");
                    require_once("./models/cls_lapso_academico.php");
                    $model = new cls_inscripcion();
                    $datos = $model->Get_estudiantes();

                    $lapso_m = new cls_lapso_academico();
                    $lapso = $lapso_m->Get_lapso_activo();
                    
                    foreach($datos as $est){
                      ?>
                      <tr>
                        <td class="border-b border-[#eee] py-3 px-2 dark:border-strokedark">
                          <p class="text-black dark:text-white"><?php echo $est['matricula_estudiante'];?></p>
                        </td>
                        <td class="border-b border-[#eee] py-3 px-2 pl-9 dark:border-strokedark xl:pl-11">
                          <h5 class="font-medium text-black dark:text-white"><?php echo $est['nacionalidad_usuario'].'-'.$est['cedula_usuario'];?></h5>
                        </td>
                        <td class="border-b border-[#eee] py-3 px-2 dark:border-strokedark">
                          <p class="text-black dark:text-white"><?php echo $est['nombre_usuario'];?></p>
                        </td>
                        <td class="border-b border-[#eee] py-3 px-2 dark:border-strokedark">
                          <p class="text-black dark:text-white"><?php echo $est['nombre_carrera'];?></p>
                        </td>
                        <td class="border-b border-[#eee] py-3 px-2 dark:border-strokedark">
                          <p class="text-black dark:text-white"><?php echo $est['numero_seccion'];?></p>
                        </td>
                        <td class="border-b border-[#eee] py-3 px-2 dark:border-strokedark">
                          <?php 
                            if($lapso['id_ano_escolar'] == $est['id_ano_escolar']){
                          ?>
                          <p class="text-black dark:text-white"><?php echo $est['ano_escolar_nombre'];?></p>
                          <?php }else{?>
                          <p class="text-black dark:text-white">
                            <a href="<?php $this->SetURL('estudiante/formulario_inscripcion/i/'.$est['id_estudiante']);?>" class="w-full cursor-pointer rounded-lg border border-primary bg-primary p-2 font-medium text-white transition hover:bg-opacity-90">Click para inscribir</a>
                          </p>
                          <?php }?>
                        </td>
                        
                        <td class="border-b border-[#eee] py-3 px-2 dark:border-strokedark">
                          <div class="flex items-center space-x-3.5">
                            <a href="<?php $this->SetURL('estudiante/formulario/b/'.$est['id_estudiante']);?>">Editar</a>
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