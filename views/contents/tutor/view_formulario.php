<!DOCTYPE html>
<html lang="en">
<?php 
  $this->GetHeader("SGSC | UNEFA");

  $op = "Registrar";
  $cedula = null;
  $nombre = null;
  $correo = null;
  $edad = null;
  $clave = null;
  $sexo = null;
  $telefono = null;
  $categoria = null;
  $tipo_tutor = null;
  $if_tutor = true;
  $if_estudiante = false;
  $id_tutor = null;

  if(isset($this->id_consulta)){
    require_once("./models/cls_tutor.php");
    $model = new cls_tutor();
    $datos = $model->consulta($this->id_consulta);

    if(isset($datos['cedula_usuario'])){      
      $op = "Actualizar";
			$cedula = $datos['cedula_usuario'];
			$nombre = $datos['nombre_usuario'];
			$correo = $datos['correo_usuario'];
			$edad = $datos['edad_usuario'];
			$clave = '';
			$sexo = $datos['genero_usuario'];
			$telefono = $datos['telefono_usuario'];
      $categoria = $datos['categoria_tutor'];
      $tipo_tutor = $datos['tipo_tutor'];
      $id_tutor = $this->id_consulta;
			// $pregunta1 = $datos['pregunta1'];
			// $respuesta1 = "";
			// $pregunta2 = $datos['pregunta2'];
			// $respuesta2 = "";
			// $pregunta3 = $datos['pregunta3'];
			// $respuesta3 = "";
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
          $this->GetComplement('breadcrumb',['title_breadcrumb' => "Gestión Tutor"]);
        ?>
					<div class="rounded-sm border border-stroke bg-white shadow-default dark:border-strokedark dark:bg-boxdark">
						<div class="border-b border-stroke py-4 px-6.5 dark:border-strokedark">
							<h3 class="font-semibold text-black dark:text-white">
              Gestión de Tutor
							</h3>
						</div>
            <form action="<?php $this->SetURL("controllers/tutor_controller.php");?>" method="POST" autocomplete="off" class="flex flex-wrap items-center">
              <div class="<?php echo ($op != "Actualizar") ? "w-1/2 xl:w-1/2" : "w-full";?> border-stroke dark:border-strokedark xl:border-l-2">
                <div class="w-full grid grid-cols-<?php echo (isset($this->id_consulta)) ? "3" : "2";?> gap-4 p-4 sm:p-12.5 xl:p-17.5">
                  <!-- <span class="mb-1.5 block font-medium">Por favor verifica todos tus datos antes de guardar</span>
                  <h2 class="mb-9 text-2xl font-bold text-black dark:text-white sm:text-title-xl2">
                    Bienvenido al registro de Estudiante
                  </h2> -->

									<input type="hidden" name="ope" value="<?php echo $op;?>">
                  <input type="hidden" name="permisos_usuario" value="2" readonly>
                  <input type="hidden" name="tipo_usuario" value="Tutor" readonly>
                  <input type="hidden" name="return" value="tutor/index" readonly>
                  <!-- AQUI ESTAMOS EN LA VISTA DEL TUTOR DENTRO DEL SISTEMA, Y DE NUEVO ESTA LOS MISMO CAMPOS -->
                  <?php require_once("./views/includes/campos_datos_usuario.php");?>
                  <?php if($op == "Actualizar"){?>
                    <div class="mb-5 block mx-auto w-full col-3">
                      <input type="submit" value="Guardar"
                        class="w-full cursor-pointer rounded-lg border border-primary bg-primary p-4 font-medium text-white transition hover:bg-opacity-90" />
                      </div>
                    </div>
                  <?php }?>
                </div>
              </div>
              <?php if($op != "Actualizar"){?>
              <div class="w-1/2 border-stroke dark:border-strokedark xl:w-1/2 xl:border-l-2">
                <div class="w-full p-4 sm:p-12.5 xl:p-17.5">
                  <!-- Preguntas de seguridad  -->
                  <h2 class="mb-9 text-2xl font-bold text-black dark:text-white sm:text-title-xl2">
                  Preguntas De Seguridad
                  </h2>
                  <?php require_once("./views/includes/campos_seguridad_usuario.php");?>
                  <!-- fin de las preguntas de seguridad -->
                  <div class="mb-5">
                    <input type="submit" value="Guardar"
                      class="w-full cursor-pointer rounded-lg border border-primary bg-primary p-4 font-medium text-white transition hover:bg-opacity-90" />
                  </div>
                </div>
              </div>
              <?php }?>
            </form>
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