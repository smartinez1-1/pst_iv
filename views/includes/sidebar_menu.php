		<!-- ===== Sidebar Start ===== -->
		<!-- BUENO, ESTO ES EL MENU PARA TODO EL SISTEMA -->
		<aside :class="sidebarToggle ? 'translate-x-0' : '-translate-x-full'"
			class="absolute left-0 top-0 z-9999 flex h-screen w-72.5 flex-col overflow-y-hidden bg-black duration-300 ease-linear dark:bg-boxdark lg:static lg:translate-x-0"
			@click.outside="sidebarToggle = false">
			<!-- SIDEBAR HEADER -->
			<div class="flex items-center justify-between gap-2 px-6 py-1">
				<a href="<?php $this->SetURL('inicio/');?>">
					<img src="<?php $this->SetURL('views/img/logo_unefa.png');?>" alt="Logo" style="height:9rem;" />
				</a>

				<button class="block lg:hidden" @click.stop="sidebarToggle = !sidebarToggle">
					<svg class="fill-current" width="20" height="18" viewBox="0 0 20 18" fill="none"
						xmlns="http://www.w3.org/2000/svg">
						<path
							d="M19 8.175H2.98748L9.36248 1.6875C9.69998 1.35 9.69998 0.825 9.36248 0.4875C9.02498 0.15 8.49998 0.15 8.16248 0.4875L0.399976 8.3625C0.0624756 8.7 0.0624756 9.225 0.399976 9.5625L8.16248 17.4375C8.31248 17.5875 8.53748 17.7 8.76248 17.7C8.98748 17.7 9.17498 17.625 9.36248 17.475C9.69998 17.1375 9.69998 16.6125 9.36248 16.275L3.02498 9.8625H19C19.45 9.8625 19.825 9.4875 19.825 9.0375C19.825 8.55 19.45 8.175 19 8.175Z"
							fill="" />
					</svg>
				</button>
			</div>
			<!-- SIDEBAR HEADER -->

			<div class="no-scrollbar flex flex-col overflow-y-auto duration-300 ease-linear">
				<!-- Sidebar Menu -->
				<nav class="mt-2 py-1 px-4 lg:mt-9 lg:px-6" x-data="{selected: 'Dashboard'}" x-init="
        selected = JSON.parse(localStorage.getItem('selected'));
        $watch('selected', value => localStorage.setItem('selected', JSON.stringify(value)))">
					<!-- Menu Group -->
					<div>
						<h3 class="mb-4 ml-4 text-sm font-medium text-bodydark2">MENÚ</h3>

						<ul class="mb-6 flex flex-col gap-1.5">
							<!-- Menu Item Dashboard -->
							<!-- <li>
								<a class="group relative flex items-center gap-2.5 rounded-sm py-2 px-4 font-medium text-bodydark1 duration-300 ease-in-out hover:bg-graydark dark:hover:bg-meta-4"
									href="#" @click.prevent="selected = (selected === 'Dashboard' ? '':'Dashboard')"
									:class="{ 'bg-graydark dark:bg-meta-4': (selected === 'Dashboard') || (page === 'analytics' || page === 'ecommerce') }">
									<svg class="fill-current" width="18" height="18" viewBox="0 0 18 18" fill="none"
										xmlns="http://www.w3.org/2000/svg">
										<path
											d="M6.10322 0.956299H2.53135C1.5751 0.956299 0.787598 1.7438 0.787598 2.70005V6.27192C0.787598 7.22817 1.5751 8.01567 2.53135 8.01567H6.10322C7.05947 8.01567 7.84697 7.22817 7.84697 6.27192V2.72817C7.8751 1.7438 7.0876 0.956299 6.10322 0.956299ZM6.60947 6.30005C6.60947 6.5813 6.38447 6.8063 6.10322 6.8063H2.53135C2.2501 6.8063 2.0251 6.5813 2.0251 6.30005V2.72817C2.0251 2.44692 2.2501 2.22192 2.53135 2.22192H6.10322C6.38447 2.22192 6.60947 2.44692 6.60947 2.72817V6.30005Z"
											fill="" />
										<path
											d="M15.4689 0.956299H11.8971C10.9408 0.956299 10.1533 1.7438 10.1533 2.70005V6.27192C10.1533 7.22817 10.9408 8.01567 11.8971 8.01567H15.4689C16.4252 8.01567 17.2127 7.22817 17.2127 6.27192V2.72817C17.2127 1.7438 16.4252 0.956299 15.4689 0.956299ZM15.9752 6.30005C15.9752 6.5813 15.7502 6.8063 15.4689 6.8063H11.8971C11.6158 6.8063 11.3908 6.5813 11.3908 6.30005V2.72817C11.3908 2.44692 11.6158 2.22192 11.8971 2.22192H15.4689C15.7502 2.22192 15.9752 2.44692 15.9752 2.72817V6.30005Z"
											fill="" />
										<path
											d="M6.10322 9.92822H2.53135C1.5751 9.92822 0.787598 10.7157 0.787598 11.672V15.2438C0.787598 16.2001 1.5751 16.9876 2.53135 16.9876H6.10322C7.05947 16.9876 7.84697 16.2001 7.84697 15.2438V11.7001C7.8751 10.7157 7.0876 9.92822 6.10322 9.92822ZM6.60947 15.272C6.60947 15.5532 6.38447 15.7782 6.10322 15.7782H2.53135C2.2501 15.7782 2.0251 15.5532 2.0251 15.272V11.7001C2.0251 11.4188 2.2501 11.1938 2.53135 11.1938H6.10322C6.38447 11.1938 6.60947 11.4188 6.60947 11.7001V15.272Z"
											fill="" />
										<path
											d="M15.4689 9.92822H11.8971C10.9408 9.92822 10.1533 10.7157 10.1533 11.672V15.2438C10.1533 16.2001 10.9408 16.9876 11.8971 16.9876H15.4689C16.4252 16.9876 17.2127 16.2001 17.2127 15.2438V11.7001C17.2127 10.7157 16.4252 9.92822 15.4689 9.92822ZM15.9752 15.272C15.9752 15.5532 15.7502 15.7782 15.4689 15.7782H11.8971C11.6158 15.7782 11.3908 15.5532 11.3908 15.272V11.7001C11.3908 11.4188 11.6158 11.1938 11.8971 11.1938H15.4689C15.7502 11.1938 15.9752 11.4188 15.9752 11.7001V15.272Z"
											fill="" />
									</svg>

									Dashboard

									<svg class="absolute right-4 top-1/2 -translate-y-1/2 fill-current"
										:class="{ 'rotate-180': (selected === 'Dashboard') }" width="20" height="20" viewBox="0 0 20 20"
										fill="none" xmlns="http://www.w3.org/2000/svg">
										<path fill-rule="evenodd" clip-rule="evenodd"
											d="M4.41107 6.9107C4.73651 6.58527 5.26414 6.58527 5.58958 6.9107L10.0003 11.3214L14.4111 6.91071C14.7365 6.58527 15.2641 6.58527 15.5896 6.91071C15.915 7.23614 15.915 7.76378 15.5896 8.08922L10.5896 13.0892C10.2641 13.4147 9.73651 13.4147 9.41107 13.0892L4.41107 8.08922C4.08563 7.76378 4.08563 7.23614 4.41107 6.9107Z"
											fill="" />
									</svg>
								</a>
								<div class="overflow-hidden" :class="(selected === 'Dashboard') ? 'block' :'hidden'">
									<ul class="mt-4 mb-5.5 flex flex-col gap-2.5 pl-6">
										<li>
											<a class="group relative flex items-center gap-2.5 rounded-md px-4 font-medium text-bodydark2 duration-300 ease-in-out hover:text-white"
												href="index.html" :class="page === 'analytics' && '!text-white'">Analytics</a>
										</li>
									</ul>
								</div>
							</li> -->
							<!-- Menu Item Dashboard -->
							<li>
								<a class="group relative flex items-center gap-2.5 rounded-sm py-2 px-4 font-medium text-bodydark1 duration-300 ease-in-out hover:bg-graydark dark:hover:bg-meta-4"
									href="<?php $this->SetURL('biblioteca/');?>" @click="selected = (selected === 'Biblioteca' ? '':'Biblioteca')"
									:class="{ 'bg-graydark dark:bg-meta-4': (selected === 'Biblioteca') && (page === 'Biblioteca') }">
									<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-diamond-fill" viewBox="0 0 16 16">
										<path fill-rule="evenodd" d="M6.95.435c.58-.58 1.52-.58 2.1 0l6.515 6.516c.58.58.58 1.519 0 2.098L9.05 15.565c-.58.58-1.519.58-2.098 0L.435 9.05a1.482 1.482 0 0 1 0-2.098L6.95.435z"/>
									</svg>
									Biblioteca
								</a>
							</li>
							<?php 
								if($_SESSION['permisos'] == '1' && $_SESSION['update_required'] === false){?>
							<!-- Menu Item Calendar -->
							<li>
								<a class="group relative flex items-center gap-2.5 rounded-sm py-2 px-4 font-medium text-bodydark1 duration-300 ease-in-out hover:bg-graydark dark:hover:bg-meta-4"
									href="<?php $this->SetURL('carrera/');?>" @click="selected = (selected === 'carrera' ? '':'carrera')"
									:class="{ 'bg-graydark dark:bg-meta-4': (selected === 'carrera') && (page === 'carrera') }">
									<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-diamond-fill" viewBox="0 0 16 16">
										<path fill-rule="evenodd" d="M6.95.435c.58-.58 1.52-.58 2.1 0l6.515 6.516c.58.58.58 1.519 0 2.098L9.05 15.565c-.58.58-1.519.58-2.098 0L.435 9.05a1.482 1.482 0 0 1 0-2.098L6.95.435z"/>
									</svg>
									Carrera
								</a>
							</li>
							<!-- Menu Item Calendar -->
							
							<!-- Menu Item Calendar -->
							<li>
								<a class="group relative flex items-center gap-2.5 rounded-sm py-2 px-4 font-medium text-bodydark1 duration-300 ease-in-out hover:bg-graydark dark:hover:bg-meta-4"
									href="<?php $this->SetURL('seccion/');?>" @click="selected = (selected === 'seccion' ? '':'seccion')"
									:class="{ 'bg-graydark dark:bg-meta-4': (selected === 'seccion') && (page === 'seccion') }">
									<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-grid-3x2-gap-fill" viewBox="0 0 16 16">
										<path d="M1 4a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1v2a1 1 0 0 1-1 1H2a1 1 0 0 1-1-1V4zm5 0a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1v2a1 1 0 0 1-1 1H7a1 1 0 0 1-1-1V4zm5 0a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1v2a1 1 0 0 1-1 1h-2a1 1 0 0 1-1-1V4zM1 9a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1v2a1 1 0 0 1-1 1H2a1 1 0 0 1-1-1V9zm5 0a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1v2a1 1 0 0 1-1 1H7a1 1 0 0 1-1-1V9zm5 0a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1v2a1 1 0 0 1-1 1h-2a1 1 0 0 1-1-1V9z"/>
									</svg>
									Sección
								</a>
							</li>
							<!-- Menu Item Calendar -->
							<!-- Menu Item Calendar -->
							<li>
								<a class="group relative flex items-center gap-2.5 rounded-sm py-2 px-4 font-medium text-bodydark1 duration-300 ease-in-out hover:bg-graydark dark:hover:bg-meta-4"
									href="<?php $this->SetURL('estudiante/');?>" @click="selected = (selected === 'estudiante' ? '':'estudiante')"
									:class="{ 'bg-graydark dark:bg-meta-4': (selected === 'estudiante') && (page === 'estudiante') }">
									<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-person-fill" viewBox="0 0 16 16">
										<path d="M3 14s-1 0-1-1 1-4 6-4 6 3 6 4-1 1-1 1H3Zm5-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6Z"/>
									</svg>
									Estudiante
								</a>
							</li>
							<!-- Menu Item Calendar -->
							<!-- Menu Item Calendar -->
							<li>
								<a class="group relative flex items-center gap-2.5 rounded-sm py-2 px-4 font-medium text-bodydark1 duration-300 ease-in-out hover:bg-graydark dark:hover:bg-meta-4"
									href="<?php $this->SetURL('tutor/');?>" @click="selected = (selected === 'tutor' ? '':'tutor')"
									:class="{ 'bg-graydark dark:bg-meta-4': (selected === 'tutor') && (page === 'tutor') }">
									<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-person-vcard-fill" viewBox="0 0 16 16">
										<path d="M0 4a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v8a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V4Zm9 1.5a.5.5 0 0 0 .5.5h4a.5.5 0 0 0 0-1h-4a.5.5 0 0 0-.5.5ZM9 8a.5.5 0 0 0 .5.5h4a.5.5 0 0 0 0-1h-4A.5.5 0 0 0 9 8Zm1 2.5a.5.5 0 0 0 .5.5h3a.5.5 0 0 0 0-1h-3a.5.5 0 0 0-.5.5Zm-1 2C9 10.567 7.21 9 5 9c-2.086 0-3.8 1.398-3.984 3.181A1 1 0 0 0 2 13h6.96c.026-.163.04-.33.04-.5ZM7 6a2 2 0 1 0-4 0 2 2 0 0 0 4 0Z"/>
									</svg>
									Tutor Académico
								</a>
							</li>
							<!-- Menu Item Calendar -->
							<!-- Menu Item Calendar -->
							<li>
								<a class="group relative flex items-center gap-2.5 rounded-sm py-2 px-4 font-medium text-bodydark1 duration-300 ease-in-out hover:bg-graydark dark:hover:bg-meta-4"
									href="<?php $this->SetURL('lapso-academico/');?>" @click="selected = (selected === 'lapso-academico' ? '':'lapso-academico')"
									:class="{ 'bg-graydark dark:bg-meta-4': (selected === 'lapso-academico') && (page === 'lapso-academico') }">
									<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-bar-chart-line-fill" viewBox="0 0 16 16">
										<path d="M11 2a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1v12h.5a.5.5 0 0 1 0 1H.5a.5.5 0 0 1 0-1H1v-3a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1v3h1V7a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1v7h1V2z"/>
									</svg>
									Lapso académico
								</a>
							</li>
							<!-- Menu Item Calendar -->
							<!-- Menu Item Calendar -->
							<!-- <li>
								<a class="group relative flex items-center gap-2.5 rounded-sm py-2 px-4 font-medium text-bodydark1 duration-300 ease-in-out hover:bg-graydark dark:hover:bg-meta-4"
									href="<?php //$this->SetURL('semestre/');?>" @click="selected = (selected === 'semestre' ? '':'semestre')"
									:class="{ 'bg-graydark dark:bg-meta-4': (selected === 'semestre') && (page === 'semestre') }">
									<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-calendar-fill" viewBox="0 0 16 16">
										<path d="M3.5 0a.5.5 0 0 1 .5.5V1h8V.5a.5.5 0 0 1 1 0V1h1a2 2 0 0 1 2 2v11a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V5h16V4H0V3a2 2 0 0 1 2-2h1V.5a.5.5 0 0 1 .5-.5z"/>
									</svg>
									semestre
								</a>
							</li> -->
							<!-- Menu Item Calendar -->
							<?php 
								}
								if($_SESSION['permisos'] == '1' && $_SESSION['update_required'] === false || $_SESSION['permisos'] == '3' && $_SESSION['update_required'] === false){
							?>
							<!-- Menu Item Calendar -->
							<!-- <li>
								<a class="group relative flex items-center gap-2.5 rounded-sm py-2 px-4 font-medium text-bodydark1 duration-300 ease-in-out hover:bg-graydark dark:hover:bg-meta-4"
									href="<?php //$this->SetURL('inscripcion/');?>" @click="selected = (selected === 'inscripcion' ? '':'inscripcion')"
									:class="{ 'bg-graydark dark:bg-meta-4': (selected === 'inscripcion') && (page === 'inscripcion') }">
									<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-person-fill-add" viewBox="0 0 16 16">
										<path d="M12.5 16a3.5 3.5 0 1 0 0-7 3.5 3.5 0 0 0 0 7Zm.5-5v1h1a.5.5 0 0 1 0 1h-1v1a.5.5 0 0 1-1 0v-1h-1a.5.5 0 0 1 0-1h1v-1a.5.5 0 0 1 1 0Zm-2-6a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z"/>
										<path d="M2 13c0 1 1 1 1 1h5.256A4.493 4.493 0 0 1 8 12.5a4.49 4.49 0 0 1 1.544-3.393C9.077 9.038 8.564 9 8 9c-5 0-6 3-6 4Z"/>
									</svg>
									inscripción
								</a>
							</li> -->
							<!-- Menu Item Calendar -->
							<!-- Menu Item Calendar -->
							<li>
								<a class="group relative flex items-center gap-2.5 rounded-sm py-2 px-4 font-medium text-bodydark1 duration-300 ease-in-out hover:bg-graydark dark:hover:bg-meta-4"
									href="<?php $this->SetURL('comunidad/');?>" @click="selected = (selected === 'comunidad' ? '':'comunidad')"
									:class="{ 'bg-graydark dark:bg-meta-4': (selected === 'comunidad') && (page === 'comunidad') }">
									<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-house-fill" viewBox="0 0 16 16">
										<path d="M8.707 1.5a1 1 0 0 0-1.414 0L.646 8.146a.5.5 0 0 0 .708.708L8 2.207l6.646 6.647a.5.5 0 0 0 .708-.708L13 5.793V2.5a.5.5 0 0 0-.5-.5h-1a.5.5 0 0 0-.5.5v1.293L8.707 1.5Z"/>
										<path d="m8 3.293 6 6V13.5a1.5 1.5 0 0 1-1.5 1.5h-9A1.5 1.5 0 0 1 2 13.5V9.293l6-6Z"/>
									</svg>
									Comunidad
								</a>
							</li>
							<!-- Menu Item Calendar -->
							<!-- Menu Item Calendar -->
							<li>
								<a class="group relative flex items-center gap-2.5 rounded-sm py-2 px-4 font-medium text-bodydark1 duration-300 ease-in-out hover:bg-graydark dark:hover:bg-meta-4"
									href="<?php $this->SetURL('tutor-comunidad/');?>" @click="selected = (selected === 'tutor-comunidad' ? '':'tutor-comunidad')"
									:class="{ 'bg-graydark dark:bg-meta-4': (selected === 'tutor-comunidad') && (page === 'tutor-comunidad') }">
									<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-person-circle" viewBox="0 0 16 16">
										<path d="M11 6a3 3 0 1 1-6 0 3 3 0 0 1 6 0z"/>
										<path fill-rule="evenodd" d="M0 8a8 8 0 1 1 16 0A8 8 0 0 1 0 8zm8-7a7 7 0 0 0-5.468 11.37C3.242 11.226 4.805 10 8 10s4.757 1.225 5.468 2.37A7 7 0 0 0 8 1z"/>
									</svg>
									Tutor-comunidad
								</a>
							</li>
							<!-- Menu Item Calendar -->
							<!-- Menu Item Calendar -->
							<!-- <li>
								<a class="group relative flex items-center gap-2.5 rounded-sm py-2 px-4 font-medium text-bodydark1 duration-300 ease-in-out hover:bg-graydark dark:hover:bg-meta-4"
									href="<?php //$this->SetURL('grupo/');?>" @click="selected = (selected === 'grupo' ? '':'grupo')"
									:class="{ 'bg-graydark dark:bg-meta-4': (selected === 'grupo') && (page === 'grupo') }">
									<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-people-fill" viewBox="0 0 16 16">
										<path d="M7 14s-1 0-1-1 1-4 5-4 5 3 5 4-1 1-1 1H7Zm4-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6Zm-5.784 6A2.238 2.238 0 0 1 5 13c0-1.355.68-2.75 1.936-3.72A6.325 6.325 0 0 0 5 9c-4 0-5 3-5 4s1 1 1 1h4.216ZM4.5 8a2.5 2.5 0 1 0 0-5 2.5 2.5 0 0 0 0 5Z"/>
									</svg>
									Grupo
								</a>
							</li> -->
							<!-- Menu Item Calendar -->
							<!-- Menu Item Calendar -->
							<!-- <li>
								<a class="group relative flex items-center gap-2.5 rounded-sm py-2 px-4 font-medium text-bodydark1 duration-300 ease-in-out hover:bg-graydark dark:hover:bg-meta-4"
									href="<?php //$this->SetURL('proyecto/');?>" @click="selected = (selected === 'proyecto' ? '':'proyecto')"
									:class="{ 'bg-graydark dark:bg-meta-4': (selected === 'proyecto') && (page === 'proyecto') }">
									<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-kanban-fill" viewBox="0 0 16 16">
										<path d="M2.5 0a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h11a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2h-11zm5 2h1a1 1 0 0 1 1 1v3a1 1 0 0 1-1 1h-1a1 1 0 0 1-1-1V3a1 1 0 0 1 1-1zm-5 1a1 1 0 0 1 1-1h1a1 1 0 0 1 1 1v7a1 1 0 0 1-1 1h-1a1 1 0 0 1-1-1V3zm9-1h1a1 1 0 0 1 1 1v10a1 1 0 0 1-1 1h-1a1 1 0 0 1-1-1V3a1 1 0 0 1 1-1z"/>
									</svg>
									proyecto
								</a>
							</li> -->
							<!-- Menu Item Calendar -->
							<?php }?>
							<!-- Menu Item Calendar -->
							<li>
								<button type="button" onclick="document.getElementById('form_logout').submit()" class="group relative flex items-center gap-2.5 rounded-sm py-2 px-4 font-medium text-bodydark1 duration-300 ease-in-out hover:bg-graydark dark:hover:bg-meta-4"
									href="calendar.html" @click="selected = (selected === 'logout' ? '':'logout')"
									:class="{ 'bg-graydark dark:bg-meta-4': (selected === 'logout') && (page === 'logout') }">
									<svg class="fill-current" width="22" height="22" viewBox="0 0 22 22" fill="none"
										xmlns="http://www.w3.org/2000/svg">
										<path
											d="M15.5375 0.618744H11.6531C10.7594 0.618744 10.0031 1.37499 10.0031 2.26874V4.64062C10.0031 5.05312 10.3469 5.39687 10.7594 5.39687C11.1719 5.39687 11.55 5.05312 11.55 4.64062V2.23437C11.55 2.16562 11.5844 2.13124 11.6531 2.13124H15.5375C16.3625 2.13124 17.0156 2.78437 17.0156 3.60937V18.3562C17.0156 19.1812 16.3625 19.8344 15.5375 19.8344H11.6531C11.5844 19.8344 11.55 19.8 11.55 19.7312V17.3594C11.55 16.9469 11.2062 16.6031 10.7594 16.6031C10.3125 16.6031 10.0031 16.9469 10.0031 17.3594V19.7312C10.0031 20.625 10.7594 21.3812 11.6531 21.3812H15.5375C17.2219 21.3812 18.5625 20.0062 18.5625 18.3562V3.64374C18.5625 1.95937 17.1875 0.618744 15.5375 0.618744Z"
											fill="" />
										<path
											d="M6.05001 11.7563H12.2031C12.6156 11.7563 12.9594 11.4125 12.9594 11C12.9594 10.5875 12.6156 10.2438 12.2031 10.2438H6.08439L8.21564 8.07813C8.52501 7.76875 8.52501 7.2875 8.21564 6.97812C7.90626 6.66875 7.42501 6.66875 7.11564 6.97812L3.67814 10.4844C3.36876 10.7938 3.36876 11.275 3.67814 11.5844L7.11564 15.0906C7.25314 15.2281 7.45939 15.3312 7.66564 15.3312C7.87189 15.3312 8.04376 15.2625 8.21564 15.125C8.52501 14.8156 8.52501 14.3344 8.21564 14.025L6.05001 11.7563Z"
											fill="" />
									</svg>
									Cerrar sesion
								</button>
							</li>
							<!-- Menu Item Calendar -->

						</ul>
					</div>
				</nav>
				<!-- Sidebar Menu -->
			</div>
		</aside>
		<!-- ===== Sidebar End ===== -->