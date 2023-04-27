<!DOCTYPE html>
<html lang="en">
<?php 
  $this->GetHeader("SGSC | UNEFA");

  require_once("./models/cls_carrera.php");
  require_once("./models/cls_semestre.php");
  require_once("./models/cls_estudiante.php");
  require_once("./models/cls_inscripcion.php");
  require_once("./models/cls_lapso_academico.php");

  $model_i = new cls_inscripcion();

  $model_c = new cls_carrera();
  $carreras = $model_c->Get_carreras();

  $model_s = new cls_semestre();
  $semestres = $model_s->Get_semestres();

  $model_e = new cls_estudiante();
  
  $model_l = new cls_lapso_academico();
  $lapso = $model_l->Get_lapso_activo();

  $tipo_registro = "N";

  $op = "Registrar";
  $id_inscripcion = null;
  $id_seccion = null;
  $id_carrera = null;
  $id_estudiante = null;
  $id_semestre = null;
  $numero_seccion = null;
  $carrera_id = null;
  $turno_estudiante = null;
  $date_before = $date_now = '';

  if($_SESSION['permisos'] == 3){
    $date_now = $model_i->consultar_inscripcion($_SESSION['cedula'],'NOW');    
    $date_before = $model_i->consultar_inscripcion($_SESSION['cedula'],'BEFORE');

    if(isset($date_before[0])){
      $id_estudiante = $date_before[0]['id_estudiante'];
      $turno_estudiante = $date_before[0]['turno_estudiante'];     
      $tipo_registro = "R";
    }

    $estudiantes = $model_e->Get_me($_SESSION['cedula']);
  }else{
    $estudiantes = $model_e->Get_estudiantes("NO-INS");
  }

  if(isset($this->id_consulta)){
    $datos = $model_i->consulta($this->id_consulta);

    if(isset($datos['id_inscripcion'])){      
      $op = "Actualizar";
      $id_seccion = $datos['id_seccion'];
      $numero_seccion = $datos['numero_seccion'];
      $id_carrera = $datos['carrera_id'];
      $turno_estudiante = $datos['turno_estudiante'];
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
          $this->GetComplement('breadcrumb',['title_breadcrumb' => "Gestion Inscripción"]);
        ?>
          <!-- ====== Form Layout Section Start -->   
          <div class="grid grid-cols-1 gap-9 sm:grid-cols-1">
            <div class="flex flex-col gap-9">
              <!-- Contact Form -->
              <div id="app_vue"
                class="rounded-sm border border-stroke bg-white shadow-default dark:border-strokedark dark:bg-boxdark">
                <div class="border-b border-stroke py-4 px-6.5 dark:border-strokedark">
                  <h3 class="font-semibold text-black dark:text-white">
                    Getion de Inscripción
                  </h3>

                  <div class="flex items-center space-x-2">
                    <div class="mr-3">
                      <label for="checkboxLabelFour" class="flex cursor-pointer select-none items-center">
                        <div class="relative">
                          <input type="radio" v-model="tipo_registro" :checked="tipo_registro == 'N'" required id="checkboxLabelFour" class="" name="tipo_registro" checked value="N"/>
                        </div>
                        Nuevo ingreso
                      </label>
                    </div>

                    <div >
                      <label for="checkboxLabelFour" class="flex cursor-pointer select-none items-center">
                        <div class="relative">
                          <input type="radio" v-model="tipo_registro" :checked="tipo_registro == 'R'" required id="checkboxLabelFour" class="" name="tipo_registro" value="R"/>
                        </div>
                        Estudiante regular
                      </label>
                    </div>
                  </div>
                </div>
                <form  action="<?php $this->SetURL('controllers/inscripcion_controller.php');?>" autocomplete="off" method="POST">
                  <input type="hidden" name="ope" value="<?php echo $op;?>">
                  <input type="hidden" name="id_inscripcion" value="<?php echo $id_inscripcion;?>">
                  <input type="hidden" name="id_ano_escolar" value="<?php echo (isset($lapso['id_ano_escolar']) ? $lapso['id_ano_escolar'] : '');?>">
                  <?php 
                    if(!isset($lapso)){
                      ?>
                      <div class="w-full p-4 text-center">
                        <h1 class="text-danger">No existe un lapso academico activo</h1>
                      </div>
                      <?php
                    }else if(isset($date_now[0])){
                      ?>
                      <div class="w-full p-4 text-center">
                        <h1 class="text-danger">El estudiante ya se encuentra inscrito</h1>
                      </div>
                      <?php
                    }else{
                  ?>
                  <div class="p-6.5">
                    <div class="mb-4.5 grid grid-cols-3 gap-6 xl:grid-cols-1">
                      <div class="w-full xl:w-4/6">
                        <label class="mb-3 block font-medium text-black dark:text-white">
                          Seleccione una carrera <span class="text-meta-1">*</span>
                        </label>
                        <div class="relative z-20 bg-white dark:bg-form-input">
                          <select required name="id_carrera" v-model="id_carrera" v-on:change="consultar_seccione_por_carrera"
                            class="relative z-20 w-full appearance-none rounded border border-stroke bg-transparent py-3 px-12 outline-none transition focus:border-primary active:border-primary dark:border-form-strokedark dark:bg-form-input">
                            <option value="">Seleccione una opcion</option>
                            <?php foreach($carreras as $carr){?>
                              <option 
                                <?php echo ($id_carrera == $carr['id_carrera']) ? "selected" : "";?> 
                                value="<?php echo $carr['id_carrera'];?>">
                                  <?php echo $carr['nombre_carrera'];?></option>
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
                          Seleccione una Sección <span class="text-meta-1">*</span>
                        </label>
                        <div class="relative z-20 bg-white dark:bg-form-input">
                          <select required name="id_seccion" v-model="id_seccion"
                            class="relative z-20 w-full appearance-none rounded border border-stroke bg-transparent py-3 px-12 outline-none transition focus:border-primary active:border-primary dark:border-form-strokedark dark:bg-form-input">
                            <option value="">Seleccione una opcion</option>
                            <option v-for="sec in secciones" :key="sec.id_seccion" :value="sec.id_seccion">{{ sec.numero_seccion}}</option>
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
                          Seleccione una Semestre <span class="text-meta-1">*</span>
                        </label>
                        <div class="relative z-20 bg-white dark:bg-form-input">
                          <select required name="id_semestre" v-model="id_semestre"
                            class="relative z-20 w-full appearance-none rounded border border-stroke bg-transparent py-3 px-12 outline-none transition focus:border-primary active:border-primary dark:border-form-strokedark dark:bg-form-input">
                            <option value="">Seleccione una opcion</option>
                            <?php foreach($semestres as $seme){?>
                              <option <?php echo ($id_semestre == $seme['id_semestre']) ? "selected" : "";?> value="<?php echo $seme['id_semestre'];?>"><?php echo $seme['des_semestre'];?></option>
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
                          Seleccione un estudiante <span class="text-meta-1">*</span>
                        </label>
                        <div class="relative z-20 bg-white dark:bg-form-input">
                          <select v-if="tipo_registro == 'N' && if_estudiante == false " required id="sel_estudiantes" name="id_estudiante" v-model="id_estudiante" v-on:change="consultarEstudiante"
                            class="relative z-20 w-full appearance-none rounded border border-stroke bg-transparent py-3 px-12 outline-none transition focus:border-primary active:border-primary dark:border-form-strokedark dark:bg-form-input">
                            <option value="">Seleccione una opcion</option>
                            <?php 
                              if(!is_array($estudiantes)){
                                ?>
                                <option selected value="<?php echo $estudiantes['id_estudiante'];?>"><?php echo $estudiantes['cedula_usuario']." ".$estudiantes['nombre_usuario'];?></option>
                                <?php
                              }else{
                                foreach($estudiantes as $est){?>
                                  <option <?php echo ($id_estudiante == $est['id_estudiante']) ? "selected" : "";?> value="<?php echo $est['id_estudiante'];?>"><?php echo $est['cedula_usuario']." ".$est['nombre_usuario'];?></option>
                            <?php 
                                }
                              }?>
                          </select>
                          <select v-if="tipo_registro == 'R' && if_estudiante == false " required id="sel_estudiantes" name="id_estudiante" v-model="id_estudiante" v-on:change="consultarEstudiante"
                            class="relative z-20 w-full appearance-none rounded border border-stroke bg-transparent py-3 px-12 outline-none transition focus:border-primary active:border-primary dark:border-form-strokedark dark:bg-form-input">
                            <option value="">Seleccione una opcion</option>
                            <option v-for="estudi in estudiantes" :key="estudi.id_estudiante" :value="estudi.id_estudiante">{{ estudi.cedula_usuario }} {{ estudi.nombre_usuario }}</option>
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
                        <label class="mb-2.5 block text-black dark:text-white">
                          lapso académico activo <span class="text-meta-1">*</span>
                        </label>
                        <input type="text" disabled placeholder="" value="<?php echo ($lapso) ? $lapso['ano_escolar_nombre'] : '';?>"
                          class="w-full rounded border-[1.5px] border-stroke bg-transparent py-3 px-5 font-medium outline-none transition focus:border-primary active:border-primary disabled:cursor-default disabled:bg-whiter dark:border-form-strokedark dark:bg-form-input dark:focus:border-primary" />
                      </div>
                      <div class="w-full xl:w-2/6">
                        <label class="mb-2.5 block text-black dark:text-white">
                          Turno <span class="text-meta-1">*</span>
                        </label>
                        <div class="flex items-center space-x-2">
                          <div class="mr-3">
                            <label for="checkboxLabelFour" class="flex cursor-pointer select-none items-center">
                              <div class="relative">
                                <input type="radio" required id="checkboxLabelFour" class="" name="turno_estudiante" value="D" <?php echo ($turno_estudiante == 'D') ? "checked" : "";?>/>
                              </div>
                              Diurno
                            </label>
                          </div>

                          <div >
                            <label for="checkboxLabelFour" class="flex cursor-pointer select-none items-center">
                              <div class="relative">
                                <input type="radio" required id="checkboxLabelFour" class="" name="turno_estudiante" value="N" <?php echo ($turno_estudiante == 'N') ? "checked" : "";?>/>
                              </div>
                              Nocturno
                            </label>
                          </div>
                        </div>
                      </div>
                    </div>

                    <button class="flex w-full justify-center rounded bg-primary p-3 font-medium text-gray">
                      Guardar
                    </button>
                  </div>
                  <?php }?>
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

  <script>
    const { createApp } = Vue;

    let app = createApp({
      data(){
        return {
          message: "hola vue",
          id_seccion: "",
          id_estudiante: "",
          id_semestre: "",
          id_carrera: "",
          data_estudiante: "",
          tipo_registro: "",
          secciones: [],
          if_estudiante: false,
          estudiantes: [],
        }
      },
      methods:{
        async consultar_seccione_por_carrera(){
          if(this.id_carrera == '') return false;

          await fetch(`<?php $this->SetURL('controllers/seccion_controller.php?ope=Get_seccion_por_carrera&id_carrera=');?>${this.id_carrera}`)
          .then( response => response.json())
          .then( result => {
            
            if(result) this.secciones = result['data']; else this.secciones = [];
          }).catch( error => console.error(error))

          await this.consultar_estudiantes_por_carrera();
        },
        async consultar_estudiantes_por_carrera(){
          if(this.id_carrera == '') return false;

          await fetch(`<?php $this->SetURL('controllers/carrera_controller.php?ope=Get_estudiantes_por_carrera&id_carrera=');?>${this.id_carrera}`)
          .then( response => response.json())
          .then( result => {
            
            if(result) this.estudiantes = result['data']; else this.estudiantes = [];
          }).catch( error => console.error(error))
        },
        async consultarEstudiante(){
          if(this.id_estudiante == '') return false;

          await fetch(`<?php $this->SetURL('controllers/estudiante_controller.php?ope=Get_estudiante&id_estudiante=');?>${this.id_estudiante}`)
          .then( response => response.json())
          .then( result => {
            
            if(result) this.datos_estudiante = result['data']['cedula_estudiante']+""+result['data']['nombre_usuario']; else this.datos_estudiante = "";
          }).catch( error => console.error(error))
        }
      }
    }).mount("#app_vue");
    <?php
      if(isset($date_before[0])){
        $d = $date_before[0];
        ?>
        app.id_carrera = '<?php echo $d["id_carrera"];?>';
        app.tipo_registro = "R";
        app.if_estudiante = true;
        app.consultar_seccione_por_carrera();

        setTimeout(() => {
          app.id_seccion = '<?php echo $d["id_seccion"];?>';
          app.id_estudiante = '<?php echo $d["id_estudiante"];?>';

          let sel = document.querySelector("#sel_estudiantes");

          for (let x = 0; x < sel.children.length; ++x) {
            let child_e = sel.children[x];
            if (child_e.tagName == 'OPTION' && child_e.value != this.id_seccion) child_e.disabled = "disabled";
          }  
        }, 100);
        
        <?php
      }else{
        ?>
        app.tipo_registro = "N";
        <?php
      }
    ?>
  </script>
</body>

</html>