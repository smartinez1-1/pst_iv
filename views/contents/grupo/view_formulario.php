<!DOCTYPE html>
<html lang="en">
<?php 
  $this->GetHeader("SGSC | UNEFA");

  require_once("./models/cls_carrera.php");
  $model_c = new cls_carrera();

  require_once("./models/cls_grupo.php");
  $model_g = new cls_grupo();

  require_once("./models/cls_inscripcion.php");
  $model_i = new cls_inscripcion();

  $carreras = $model_c->Get_carreras();

  if($_SESSION['permisos'] == 3){
    $date_now = $model_g->consultar_grupo($_SESSION['cedula']);
    $datos_inscripcion = $model_i->consultar_inscripcion($_SESSION['cedula'],'NOW');
    // var_dump($datos_inscripcion[0]['id_carrera']);
    // die("DFD");
  }

  $op = "Registrar";
  $id_grupo = null;
  $nombre_grupo = null;
  $estado_grupo = null;

  if(isset($this->id_consulta)){
    
    $datos = $model_g->consulta($this->id_consulta);

    if(isset($datos['id_grupo'])){      
      $op = "Actualizar";
      $id_grupo = $datos['id_grupo'];
      $nombre_grupo = $datos['nombre_grupo'];
      $estado_grupo = $datos['estado_grupo'];
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
          $this->GetComplement('breadcrumb',['title_breadcrumb' => "Gestión Grupo"]);
        ?>
          <!-- ====== Form Layout Section Start -->   
          <div class="grid grid-cols-1 gap-9 sm:grid-cols-1">
            <div class="flex flex-col gap-9">
              <!-- Contact Form -->
              <div id="app_vue"
                class="rounded-sm border border-stroke bg-white shadow-default dark:border-strokedark dark:bg-boxdark">
                <div class="border-b border-stroke py-4 px-6.5 dark:border-strokedark">
                  <h3 class="font-semibold text-black dark:text-white">
                  Gestión de Grupo
                  </h3>
                </div>
                <form action="<?php $this->SetURL('controllers/grupo_controller.php');?>" autocomplete="off" method="POST">
                  <input type="hidden" name="ope" value="<?php echo $op;?>">
                  <input type="hidden" name="id_grupo" value="<?php echo $id_grupo;?>">
                  <?php 
                    if($op == "Registrar" && (isset($date_now))){
                      ?>
                      <div class="w-full p-4 text-center">
                        <h1 class="text-danger">El estudiante ya se encuentra registrado en un grupo</h1>
                      </div>
                      <?php
                    }else{
                  ?>
                  <div class="p-6.5">
                    <div class="mb-4.5 flex flex-col gap-6 xl:flex-row">
                      <!-- <div class="w-full xl:w-4/6">
                        <label class="mb-3 block font-medium text-black dark:text-white">
                          Seleccione una carrera <span class="text-meta-1">*</span>
                        </label>
                        <div class="relative z-20 bg-white dark:bg-form-input">
                          <select required id="sel_id_carrera" name="id_carrera" v-model="id_carrera" 
                            class="relative z-20 w-full appearance-none rounded border border-stroke bg-transparent py-3 px-12 outline-none transition focus:border-primary active:border-primary dark:border-form-strokedark dark:bg-form-input">
                            <option value="">Seleccione una opcion</option>
                            <?php //foreach($carreras as $carr){?>
                              <option 
                                value="<?php //echo $carr['id_carrera'];?>">
                                  <?php //echo $carr['nombre_carrera'];?></option>
                            <?php //}?>
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
                      </div> -->
                      
                    </div>
                    <div class="mb-4.5 w-full flex gap-6 flex-row">
                      <!-- <div class="w-4/12">
                        <label class="mb-3 block font-medium text-black dark:text-white">
                          Seleccione una Sección <span class="text-meta-1">*</span>
                        </label>
                        <div class="relative z-20 bg-white dark:bg-form-input">
                          <select required id="sel_id_seccion" name="id_seccion" v-model="id_seccion"
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
                      </div> -->

                      <div class="w-5/12">
                        <label class="mb-2.5 block text-black dark:text-white">
                          Nombre del grupo <span class="text-meta-1">*</span>
                        </label>
                        <input type="text" maxlength="45" minlength="4" pattern="[a-zA-ZñÑáéíóúÁÉÍÓÚ\s]+" title="Solo de admiten letras" required placeholder="Ingrese su texto" name="nombre_grupo" value="<?php echo $nombre_grupo;?>"
                          class="w-full rounded border-[1.5px] border-stroke bg-transparent py-3 px-5 font-medium outline-none transition focus:border-primary active:border-primary disabled:cursor-default disabled:bg-whiter dark:border-form-strokedark dark:bg-form-input dark:focus:border-primary" />
                      </div>

                      <div class="w-3/12">
                        <label class="mb-2.5 block text-black dark:text-white">
                          Estado del grupo <span class="text-meta-1">*</span>
                        </label>
                        <div class="flex items-center space-x-2">
                          <div class="mr-3">
                            <label for="checkboxLabelFour" class="flex cursor-pointer select-none items-center">
                              <div class="relative">
                                <input type="radio" required id="checkboxLabelFour" class="" name="estado_grupo" value="1" <?php echo ($estado_grupo == '1') ? "checked" : "";?>/>
                              </div>
                              Activo
                            </label>
                          </div>

                          <div >
                            <label for="checkboxLabelFour" class="flex cursor-pointer select-none items-center">
                              <div class="relative">
                                <input type="radio" required id="checkboxLabelFour" class="" name="estado_grupo" value="0" <?php echo ($estado_grupo == '0') ? "checked" : "";?>/>
                              </div>
                              Inactivo
                            </label>
                          </div>
                        </div>
                      </div>

                      <div class="w-3/12">
                        <label class="mb-2.5 block text-black dark:text-white">
                          Tipo de grupo <span class="text-meta-1">*</span>
                        </label>
                        <div class="flex items-center space-x-2">
                          <div class="mr-3">
                            <label for="tipoCarrera1" class="flex cursor-pointer select-none items-center">
                              <div class="relative">
                                <input type="radio" @click="setTipoCarrera(1)" :checked="tipo_carrera == 1" required id="tipoCarrera1" class="" name="tipo_grupo" value="1" <?php //echo ($tipo_grupo == '1') ? "checked" : "";?>/>
                              </div>
                              Carreras mixtas
                            </label>
                          </div>

                          <div >
                            <label for="tipoCarrera2" class="flex cursor-pointer select-none items-center">
                              <div class="relative">
                                <input type="radio" @click="setTipoCarrera(0)" :checked="tipo_carrera == 0" required id="tipoCarrera2" class="" name="tipo_grupo" value="0" <?php //echo ($tipo_grupo == '0') ? "checked" : "";?>/>
                              </div>
                              Carreras no mixtas
                            </label>
                          </div>
                        </div>
                      </div>

                    </div>
                    <table class="w-full table-auto">
                      <thead>
                        <tr class="bg-gray-2 text-left dark:bg-meta-4">
                          <th class="min-w-[220px] py-4 px-4 font-medium text-black dark:text-white xl:pl-11">
                            Cedula del estudiante
                          </th>
                          <th class="min-w-[220px] py-4 px-4 font-medium text-black dark:text-white xl:pl-11">
                            Nombre del estudiante
                          </th>
                          <th class="min-w-[220px] py-4 px-4 font-medium text-black dark:text-white xl:pl-11">
                            <div class="rounded-full">
                              <button type="button" title="Anadir" v-show="grupo_est.length < 6" v-on:click="add()" class="bg-success p-2 text-white">+</button>
                              <button type="button" v-show="grupo_est.length > 1" v-on:click="remo()" title="Eliminar" class="bg-danger p-2 text-white">-</button>
                            </div>
                          </th>
                        </tr>
                      </thead>
                      <tbody>
                      
                        <tr v-for="(d,index) in grupo_est">
                          <td class="border-b border-[#eee] py-5 px-4 pl-9 dark:border-strokedark xl:pl-11">
                            <select required id="est" name="id_estudiante[]" v-model="grupo_est[index].id_estudiante" :data-index="index" v-on:change="set_datos"
                              class="relative z-20 w-full appearance-none rounded border border-stroke bg-transparent py-3 px-12 outline-none transition focus:border-primary active:border-primary dark:border-form-strokedark dark:bg-form-input sel_est">
                              <option value="">Seleccione una opcion</option>
                              <option v-for="est in estudiantes" :key="est.id_estudiante" :value="est.id_estudiante">{{ est.cedula_usuario}}</option>
                            </select>
                          </td>
                          <td class="border-b border-[#eee] py-5 px-4 dark:border-strokedark">
                            <p class="text-black dark:text-white">{{d.nombre}}</p>
                          </td>
                        </tr>
                      </tbody>
                    </table>

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
          estudiantes: [],
          grupo_est: [{}],
          secciones: [],
          carreras: [],
          id_carrera: "",
          id_seccion:"",
          id_grupo:"",
          tipo_carrera: 1,
        }
      },
      methods:{
        add(){ this.grupo_est.push({}); },
        remo(){ this.grupo_est.pop(); },
        async set_datos(i){
          if(!i.target.dataset.index) return false;

          let index = i.target.dataset.index;
          let contador = 0;
          
          let result = await this.consulta_siEstudiante(this.grupo_est[index].id_estudiante);
          if(!result){
            this.grupo_est[index].nombre = '';
            this.grupo_est[index].id_estudiante = '';
            
            Toast.fire({
              icon: "error",
              title: "el estudiante ya esta inscrito en otro grupo"
            });

            return false;
          }

          this.grupo_est.forEach( item =>{
            if(item.id_estudiante == this.grupo_est[index].id_estudiante) contador++
          })

          if(contador > 1){
            this.grupo_est[index].id_estudiante = '';
            this.grupo_est[index].nombre = '';
            
            return false;
          }

          this.grupo_est[index].nombre = this.estudiantes.find(item => item.id_estudiante == this.grupo_est[index].id_estudiante)['nombre_usuario'];
          return false;
        },
        async consulta_siEstudiante(id){
          // consulta para validar si el estudiante ya no esta inscrito en otro grupo
          let res = await fetch(`<?php $this->SetURL('controllers/grupo_controller.php?ope=if_estudiante_exists&id_estudiante=');?>${id}`)
          .then( response => response.json())
          .then( result => {
            if(result.data == null) return true; else return false;
          }).catch( error => console.error(error))
          return res;
        },
        async consultar_secciones(){
          await fetch(`<?php $this->SetURL('controllers/seccion_controller.php?ope=Get_secciones');?>`)
          .then( response => response.json())
          .then( result => {
            
            if(result) this.secciones = result['data']; else this.secciones = [];
          }).catch( error => console.error(error))
        },
        async consultar_estudiantes(){
          await fetch(`<?php $this->SetURL('controllers/estudiante_controller.php?ope=Get_todos_byTipoCarrera&tipo=');?>${this.tipo_carrera}`)
          .then( response => response.json())
          .then( result => {
            
            if(result) this.estudiantes = result['data']; else this.estudiantes = [];
          }).catch( error => console.error(error))
        },
        
        async consultar_seccione_por_carrera(){
          if(this.id_carrera == '') return false;

          await fetch(`<?php $this->SetURL('controllers/seccion_controller.php?ope=Get_seccion_por_carrera&id_carrera=');?>${this.id_carrera}`)
          .then( response => response.json())
          .then( result => {
            
            if(result) this.secciones = result['data']; else this.secciones = [];
          }).catch( error => console.error(error))
          await this.consultar_estudiantes_por_carrera();
        },
        // async Get_estudiantes_por_seccion(){
        //   if(this.id_seccion == '') return false;

        //   await fetch(`<?php //$this->SetURL('controllers/inscripcion_controller.php?ope=Get_estudiantes_seccion&id_seccion=');?>${this.id_seccion}`)
        //   .then( response => response.json())
        //   .then( result => {
            
        //     if(result) this.estudiantes = result['data']; else this.estudiantes = [];
        //   }).catch( error => console.error(error))
        // },
        async consultar_estudiantes_por_carrera(){
          if(this.id_carrera == '') return false;

          await fetch(`<?php $this->SetURL('controllers/carrera_controller.php?ope=Get_estudiantes_por_carrera&id_carrera=');?>${this.id_carrera}`)
          .then( response => response.json())
          .then( result => {
            
            if(result) this.estudiantes = result['data']; else this.estudiantes = [];
          }).catch( error => console.error(error))
        },
        async Get_estu_grupo(id){
          await fetch(`<?php $this->SetURL('controllers/grupo_controller.php?ope=Get_estu_grup&id_grupo=');?>${id}`)
          .then( response => response.json())
          .then( ({data}) => {
            this.grupo_est = [{}]
            data.forEach( (item,index) => {
              this.grupo_est[index].id_estudiante = item.id_alumno
              this.set_datos(index)
              this.add();
            })
          }).catch( error => console.error(error))
        },
        async consultar(id){
          await fetch(`<?php $this->SetURL('controllers/grupo_controller.php?ope=Get_grupo&id_grupo=');?>${id}`)
          .then( response => response.json())
          .then( async ({data}) => {
            
            let grupo = data['grupo'];
            let estudiantes = data['est'];
            this.id_carrera = grupo['carrera_id'];
            this.id_seccion = grupo['id_seccion'];
            
            await this.consultar_seccione_por_carrera();
            // await this.Get_estudiantes_por_seccion();

            this.grupo_est = [];
            estudiantes.forEach( item =>{
              this.grupo_est.push({id_estudiante: item.id_estudiante, nombre: item.nombre_usuario});
            })
                  
          }).catch( error => console.error(error))

          return false;
          await this.consultar_seccione_por_carrera().then( ()=>{
            this.id_seccion = datos.id_seccion;
          }).then( () =>{
            this.Get_estu_grupo(datos.id_grupo)
          })
        },
        bloqueoCampos(){
          let sel_c = document.querySelector('#sel_id_carrera');
          let sel_s = document.querySelector('#sel_id_seccion');

          for (let i = 0; i < sel_c.children.length; ++i) {
            let child_c = sel_c.children[i];
            if (child_c.tagName == 'OPTION' && child_c.value != this.id_carrera) child_c.disabled = "disabled";
          }

          setTimeout(() => {
            for (let x = 0; x < (this.secciones.length + 1); ++x) {
              let child_s = sel_s.children[x];
              // console.log(child.value, this.id_seccion)
              if (child_s.tagName == 'OPTION' && child_s.value != this.id_seccion) child_s.disabled = "disabled";
            }  
          }, 100);
        },
        setTipoCarrera(nuevo){
          this.tipo_carrera = nuevo;
          var LenLista = this.grupo_est.length;
          for(let x = 0; x < LenLista; x++){
            this.grupo_est.pop();
          }
          this.consultar_estudiantes();
        }
      },
      mounted(){
        //this.consultar_secciones();
        this.consultar_estudiantes();
      }
    }).mount("#app_vue");

    <?php 
      if(isset($this->id_consulta)){
        ?>
        app.consultar('<?php echo $this->id_consulta?>')
        <?php
      }

      if(isset($datos_inscripcion) && $op == "Registrar"){
        ?>
        //app.id_carrera = '<?php //echo $datos_inscripcion[0]['id_carrera'];?>'
        //app.id_seccion = '<?php //echo $datos_inscripcion[0]['id_seccion'];?>'  
        setTimeout(() => {
          //app.consultar_secciones();
          app.consultar_estudiantes();
          //app.consultar_seccione_por_carrera();
          // app.Get_estudiantes_por_seccion();
          //app.consultar_estudiantes_por_carrera();
          app.bloqueoCampos();
        }, 100);
        
        // app.consultar('<?php //echo $this->id_consulta?>')
        <?php
      }
    ?>
  </script>
</body>

</html>