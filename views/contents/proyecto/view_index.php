<!DOCTYPE html>
<html lang="en">
<?php 
  $this->GetHeader("SGSC | UNEFA");
  
  require_once("./models/cls_lapso_academico.php");
  $model_l = new cls_lapso_academico();
  $lapsos = $model_l->Get_lapsos();

  require_once("./models/cls_carrera.php");
  $model_c = new cls_carrera();
  $carreras = $model_c->Get_carreras();
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
          $this->GetComplement('breadcrumb',['title_breadcrumb' => "Gestión Proyecto"]);
        ?>
          <!-- ====== Table Three Start -->
          <div class="rounded-sm border border-stroke bg-white px-5 mb-2 pt-6 pb-2.5 shadow-default dark:border-strokedark dark:bg-boxdark sm:px-7.5 xl:pb-1">
            <div class="max-w-full overflow-x-auto">
              <table class="w-full table-auto overflow-x-auto my-2" id="tabla">
                <thead>
                  <tr class="bg-gray-2 text-left dark:bg-meta-4">
                    <th class="min-w-[20px] py-4 px-4 font-medium text-black dark:text-white xl:pl-11">
                      ID
                    </th>
                    <th class="min-w-[220px] py-4 px-4 font-medium text-black dark:text-white xl:pl-11">
                      Titulo
                    </th>
                    <th class="min-w-[220px] py-4 px-4 font-medium text-black dark:text-white xl:pl-11">
                      Comunidad
                    </th>
                    <th class="min-w-[220px] py-4 px-4 font-medium text-black dark:text-white xl:pl-11">
                      Grupo
                    </th>
                    <th class="min-w-[220px] py-4 px-4 font-medium text-black dark:text-white xl:pl-11">
                      Carrera
                    </th>
                    <th class="min-w-[220px] py-4 px-4 font-medium text-black dark:text-white xl:pl-11">
                      Lapso académico
                    </th>
                    <th class="min-w-[40px] py-4 px-4 font-medium text-black dark:text-white">
                      Estado
                    </th>
                    <th class="py-4 px-4 font-medium text-black dark:text-white">
                      Opciones
                    </th>
                  </tr>
                </thead>
                <tbody>
                </tbody>
              </table>
            </div>
          </div>
          <!-- ====== Table Three End -->
          <!-- ====== Table Three Start -->
          <div class="rounded-sm border border-stroke bg-white px-5 mb-2 pt-6 pb-2.5 shadow-default dark:border-strokedark dark:bg-boxdark sm:px-7.5 xl:pb-1">
            <div class="border-b border-stroke py-4 px-6.5 dark:border-strokedark">
              <h3 class="font-semibold text-black dark:text-white">
              Reporte de proyectos por lapso académico
              </h3>
            </div>
            <!-- ACA ESTA EL FOMULARIO, EL ACTION CONTIENE LA URL ESTATICA QUE APUNTA AL CONTROLADOR DE CARRERA, DICHO FORMULARIO CONTIENE PRIMERO 2 INPUTS DE TIPO HIDDEN (ESCONDIDO), UNO ES PARA DEFINIR QUE OPERACION VAMOS A REALIZAR OPE, Y EL OTRO CAMPO ES PARA METER EL ID DE LA CARRERA -->
            <form action="<?php $this->SetURL('proyecto/rp2');?>" target="__blank" autocomplete="off" method="POST">
              <!-- OH BUENO, FALTA VER LA TRANSACCION -->
              <div class="p-6.5">
                <div class="mb-4.5 flex flex-col gap-6 xl:flex-row">
                  <div class="w-full xl:w-4/6">
                    <label class="mb-3 block font-medium text-black dark:text-white">
                      Seleccione un periodo escolar <span class="text-meta-1">*</span>
                    </label>
                    <div class="relative z-20 bg-white dark:bg-form-input">
                      <select required name="filtro_lapsos"
                        class="relative z-20 w-full appearance-none rounded border border-stroke bg-transparent py-3 px-12 outline-none transition focus:border-primary active:border-primary dark:border-form-strokedark dark:bg-form-input">
                        <option value="All_lapsos">Todos los lapsos académico</option>
                        <?php foreach($lapsos as $lap){?>
                          <option value="<?php echo $lap['id_ano_escolar'];?>"><?php echo $lap['ano_escolar_nombre'];?></option>
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
                  <div class="w-full xl:w-4/6">
                    <label class="mb-3 block font-medium text-black dark:text-white">
                      Seleccione una carrera <span class="text-meta-1">*</span>
                    </label>
                    <div class="relative z-20 bg-white dark:bg-form-input">
                      <select required name="filtro_carreras"
                        class="relative z-20 w-full appearance-none rounded border border-stroke bg-transparent py-3 px-12 outline-none transition focus:border-primary active:border-primary dark:border-form-strokedark dark:bg-form-input">
                        <option value="All_carreras">Todas las carreras</option>
                        <?php foreach($carreras as $carr){?>
                          <option value="<?php echo $carr['id_carrera'];?>">
                              <?php echo $carr['nombre_carrera'];?>
                          </option>
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
                  <div class="w-full xl:w-4/6">
                    <label class="mb-3 block font-medium text-black dark:text-white">
                      Tipo de proyecto <span class="text-meta-1">*</span>
                    </label>
                    <div class="relative z-20 bg-white dark:bg-form-input">
                      <select required name="tipo_proyecto"
                        class="relative z-20 w-full appearance-none rounded border border-stroke bg-transparent py-3 px-12 outline-none transition focus:border-primary active:border-primary dark:border-form-strokedark dark:bg-form-input">
                        <option value="All_proyectos">Todo tipo de proyectos</option>
                        <option value="SOCIO-PRODUCTIVO">Socio-productivo</option>
                        <option value="SOCIO-COMUNITARIO">Socio-comunitario</option>
                        <option value="AMBIENTAL">Ambiental</option>
                        <option value="EDUCATIVO">Educativo</option>
                        <option value="SOCIAL">Social</option>
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
                  <!-- Y YA -->
                </div>

                <button class="flex w-full justify-center rounded bg-primary p-3 font-medium text-gray">
                  Solicitar
                </button>
              </div>
            </form>
          </div>
          <!-- ====== Table Three End -->
        </div>
      </main>
		</div>
		<!-- ===== Content Area End ===== -->
	</div>
	<!-- ===== Page Wrapper End ===== -->
	<?php $this->GetComplement('scripts');?>
  <script>
      $(document).ready(function () {
        let table = $("#tabla").dataTable({
          "ajax": {
            "url": "<?php $this->SetURL('controllers/proyecto_controller.php?ope=Get_todos');?>",
            "dataSrc": "data"
          },
          "columns": [
          { data: "id_proyecto" },{ data: "titulo_proyecto"},{ data: "nombre_comunidad"},
          { data: "nombre_grupo"},{ data: "nombre_carrera"},{ data: "ano_escolar_nombre"},
          { data: "estado_proyecto"},
          {
            defaultContent: "",
            render(data, type, row) {
              return `
                <a class="text-primary" href="<?php $this->SetURL('proyecto/formulario/b/');?>${row['id_proyecto']}">Editar</a>
                <a class="text-danger" target="__blank" href="<?php $this->SetURL('proyecto/rp/b/');?>${row['id_proyecto']}">PDF</a>`;
            }
          }
          ],
          language: {
            url: `<?php $this->SetURL('views/js/DataTable.config.json');?>`
          },
          "pagingType": "simple",
        });

        setTimeout(() => {
          $("#tabla tr td").addClass("border-b border-[#eee] py-5 px-4 pl-9 dark:border-strokedark xl:pl-11 text-center")
          $("#tabla_length").addClass("p-2 flex flex-end")
          $("#tabla_filter").addClass("p-2 flex flex-end")
          $("#tabla_filter input").addClass("w-2/1 rounded border-[1.5px] border-stroke bg-transparent py-3 px-5 font-medium outline-none transition focus:border-primary active:border-primary disabled:cursor-default disabled:bg-whiter dark:border-form-strokedark dark:bg-form-input dark:focus:border-primary")
          $("#tabla_previous").addClass("p-2 rounded-md bg-meta-4 text-white")
          $("#tabla_next").addClass("p-2 rounded-md bg-meta-4 text-white")  
        }, 100);
      });
  </script>
</body>

</html>