<!DOCTYPE html>
<html lang="en">
<?php 
  $if_tutor = false;
  $this->GetHeader("SGSC | UNEFA");
?>
<body
	x-data="{ page: 'signin', 'loaded': true, 'darkMode': true, 'stickyMenu': false, 'sidebarToggle': false, 'scrollTop': false }"
	x-init="
          darkMode = JSON.parse(localStorage.getItem('darkMode'));
          $watch('darkMode', value => localStorage.setItem('darkMode', JSON.stringify(value)))"
	:class="{'dark text-bodydark bg-boxdark-2': darkMode === true}">

	<!-- ===== Page Wrapper Start ===== -->
	<div class="flex h-screen overflow-hidden">
		<!-- ===== Content Area Start ===== -->
		<div class="relative flex flex-1 flex-col overflow-y-auto overflow-x-hidden">
			<!-- ===== Main Content Start ===== -->
			<main>
				<div class="mx-auto max-w-screen-2xl p-4 md:p-6 2xl:p-10">
					
          <!-- ====== Forms Section Start -->
          <div class="rounded-sm border border-stroke bg-white shadow-default dark:border-strokedark dark:bg-boxdark">
            <form action="<?php $this->SetURL("controllers/estudiante_controller.php");?>" method="POST" autocomplete="off" class="flex flex-wrap items-center">
              <div class="w-1/2 border-stroke dark:border-strokedark xl:w-1/2 xl:border-l-2">
                <div class="w-full p-4 sm:p-12.5 xl:p-17.5">
                  <span class="mb-1.5 block font-medium">Por favor verifica todos tus datos antes de guardar</span>
                  <h2 class="mb-9 text-2xl font-bold text-black dark:text-white sm:text-title-xl2">
                    Bienvenido al registro de Estudiante
                  </h2>
                  <input type="hidden" name="permisos_usuario" value="3">
                  <input type="hidden" name="tipo_usuario" value="Estudiante">
                  <input type="hidden" name="return" value="auth/registro_estudiante">
                  <input type="hidden" name="ope" value="Registrar">
                  <!-- CAMPOS DEL ESTUDIANTE -->
                  <?php require_once("./views/includes/campos_datos_usuario.php");?>
                </div>
              </div>
              <div class="w-1/2 border-stroke dark:border-strokedark xl:w-1/2 xl:border-l-2">
                <div class="w-full p-4 sm:p-12.5 xl:p-17.5">
                  <!-- Preguntas de seguridad  -->
                  <h2 class="mb-9 text-2xl font-bold text-black dark:text-white sm:text-title-xl2">
                  Preguntas De Seguridad
                  </h2>
                  <!-- CAMPOS DE SEGURIDAD DEL ESTUDIANTE -->
                  <?php require_once("./views/includes/campos_seguridad_usuario.php");?>
                  <!-- fin de las preguntas de seguridad -->
                  <div class="mb-5">
                    <input type="submit" value="Registrar datos"
                      class="w-full cursor-pointer rounded-lg border border-primary bg-primary p-4 font-medium text-white transition hover:bg-opacity-90" />
                  </div>

                  <div class="mt-6 text-center">
                    <p class="font-medium">
                      Ya tienes una cuenta?
                      <a href="<?php $this->SetURL($this->controlador."/login");?>" class="text-primary">Login</a>
                    </p>
                  </div>
                </div>
              </div>
            </form>
          </div>
          <!-- ====== Forms Section End -->
				</div>
			</main>
			<!-- ===== Main Content End ===== -->
		</div>
		<!-- ===== Content Area End ===== -->
	</div>
	<!-- ===== Page Wrapper End ===== -->
	<?php $this->GetComplement('scripts');?>
</body>

</html>