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
          $this->GetComplement('breadcrumb',['title_breadcrumb' => "Gestión Carrera"]);
        ?>
          <!-- ====== Table Three Start -->
          <div class="rounded-sm border border-stroke bg-white px-5 pt-6 pb-2.5 shadow-default dark:border-strokedark dark:bg-boxdark sm:px-7.5 xl:pb-1">
            <div class="max-w-full overflow-x-auto">
              <!-- YA QUE ESTA ES LA VISTA INDEX, AQUI TENEMOS UNA TABLA DONDE SE MUESTRAN TODOS LOS DATOS REGISTRADOS -->
              <table class="w-full table-auto">
                <thead>
                  <tr class="bg-gray-2 text-left dark:bg-meta-4">
                    <th class="min-w-[220px] py-4 px-4 font-medium text-black dark:text-white xl:pl-11">
                      ID
                    </th>
                    <th class="min-w-[150px] py-4 px-4 font-medium text-black dark:text-white">
                      Nombre
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
                    require_once("./models/cls_carrera.php");
                    $model = new cls_carrera();
                    $datos = $model->Get_carreras();
                    // AQUI HAGO USO DE EL METODO GET_CARRERAS PARA CONSULTAR TODAS LAS CARRERAS REGISTRADAS (PUEDO USAR DICHO METODO YA QUE GET_CARRERAS ES UNA METODO PUBLICO), ABAJO LO QUE HAY ES UN FOREACH PARA RECORRER CADA CARRERA QUE ESTE REGISTRADA Y ASI IR CREANDO LOS TR DE LA TABLA
                    
                    foreach($datos as $car){
                      ?>
                      <tr>
                        <td class="border-b border-[#eee] py-5 px-4 pl-9 dark:border-strokedark xl:pl-11">
                          <h5 class="font-medium text-black dark:text-white"><?php echo $car['codigo_carrera'];?></h5>
                        </td>
                        <td class="border-b border-[#eee] py-5 px-4 dark:border-strokedark">
                          <p class="text-black dark:text-white"><?php echo $car['nombre_carrera'];?></p>
                        </td>
                        <td class="border-b border-[#eee] py-5 px-4 dark:border-strokedark">
                          <?php $text = ($car['estado_carrera'] == '1') ? "text-success" : "text-danger";?>
                          <p class="inline-flex rounded-full bg-success bg-opacity-10 py-1 px-3 text-sm font-medium <?php echo $text;?>">
                          <?php echo ($car['estado_carrera'] == '1') ? "Activo" : "Inactivo";?>
                          </p>
                        </td>
                        <td class="border-b border-[#eee] py-5 px-4 dark:border-strokedark">
                          <div class="flex items-center space-x-3.5">
                            <!-- SET_URL ES PARA IMPRIMIR LA URL ESTATICA, AÑADIENDO QUE VAMOS A APUNTAR AL MODULO CARRERA, VISTA FORMULARIO, AGREGAMOS LA 'B' PARA DECIR QUE VAMOS A 'BUSCAR' Y LUEGO AGREGO EL ID DEL REGISTRO (OSEA EL ID DE LA CARRERA), PARA PODER ENTRAR A DICHA VISTA Y CONSULTAR LA INFORMACION Y ASI PODER EDITAR -->
                            <a href="<?php $this->SetURL('carrera/formulario/b/'.$car['id_carrera']);?>">Editar</a>
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