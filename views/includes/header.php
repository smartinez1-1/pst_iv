			<!-- ===== Header Start ===== -->
			<header class="sticky top-0 z-999 flex w-full bg-white drop-shadow-1 dark:bg-boxdark dark:drop-shadow-none">
				<div class="flex flex-grow items-center justify-end py-4 px-4 shadow-2 md:px-6 2xl:px-11">
					<div class="flex items-center gap-2 sm:gap-4 lg:hidden">
						<!-- Hamburger Toggle BTN -->
						<button
							class="z-99999 block rounded-sm border border-stroke bg-white p-1.5 shadow-sm dark:border-strokedark dark:bg-boxdark lg:hidden"
							@click.stop="sidebarToggle = !sidebarToggle">
							<span class="relative block h-5.5 w-5.5 cursor-pointer">
								<span class="du-block absolute right-0 h-full w-full">
									<span
										class="relative top-0 left-0 my-1 block h-0.5 w-0 rounded-sm bg-black delay-[0] duration-200 ease-in-out dark:bg-white"
										:class="{ '!w-full delay-300': !sidebarToggle }"></span>
									<span
										class="relative top-0 left-0 my-1 block h-0.5 w-0 rounded-sm bg-black delay-150 duration-200 ease-in-out dark:bg-white"
										:class="{ '!w-full delay-400': !sidebarToggle }"></span>
									<span
										class="relative top-0 left-0 my-1 block h-0.5 w-0 rounded-sm bg-black delay-200 duration-200 ease-in-out dark:bg-white"
										:class="{ '!w-full delay-500': !sidebarToggle }"></span>
								</span>
								<span class="du-block absolute right-0 h-full w-full rotate-45">
									<span
										class="absolute left-2.5 top-0 block h-full w-0.5 rounded-sm bg-black delay-300 duration-200 ease-in-out dark:bg-white"
										:class="{ 'h-0 delay-[0]': !sidebarToggle }"></span>
									<span
										class="delay-400 absolute left-0 top-2.5 block h-0.5 w-full rounded-sm bg-black duration-200 ease-in-out dark:bg-white"
										:class="{ 'h-0 dealy-200': !sidebarToggle }"></span>
								</span>
							</span>
						</button>
						<!-- Hamburger Toggle BTN -->
						<a class="block flex-shrink-0 lg:hidden" href="index.html">
							<img src="src/images/logo/logo-icon.svg" alt="Logo" />
						</a>
					</div>
					<!-- <div class="hidden sm:block">
						<form action="https://formbold.com/s/unique_form_id" method="POST">
							<div class="relative">
								<button class="absolute top-1/2 left-0 -translate-y-1/2">
									<svg class="fill-body hover:fill-primary dark:fill-bodydark dark:hover:fill-primary" width="20"
										height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
										<path fill-rule="evenodd" clip-rule="evenodd"
											d="M9.16666 3.33332C5.945 3.33332 3.33332 5.945 3.33332 9.16666C3.33332 12.3883 5.945 15 9.16666 15C12.3883 15 15 12.3883 15 9.16666C15 5.945 12.3883 3.33332 9.16666 3.33332ZM1.66666 9.16666C1.66666 5.02452 5.02452 1.66666 9.16666 1.66666C13.3088 1.66666 16.6667 5.02452 16.6667 9.16666C16.6667 13.3088 13.3088 16.6667 9.16666 16.6667C5.02452 16.6667 1.66666 13.3088 1.66666 9.16666Z"
											fill="" />
										<path fill-rule="evenodd" clip-rule="evenodd"
											d="M13.2857 13.2857C13.6112 12.9603 14.1388 12.9603 14.4642 13.2857L18.0892 16.9107C18.4147 17.2362 18.4147 17.7638 18.0892 18.0892C17.7638 18.4147 17.2362 18.4147 16.9107 18.0892L13.2857 14.4642C12.9603 14.1388 12.9603 13.6112 13.2857 13.2857Z"
											fill="" />
									</svg>
								</button>

								<input type="text" placeholder="Type to search..."
									class="w-full bg-transparent pr-4 pl-9 focus:outline-none" />
							</div>
						</form>
					</div> -->

					<div class="flex items-center gap-3 2xsm:gap-7">
						<ul class="flex items-center gap-2 2xsm:gap-4">
							<li>
								<!-- Dark Mode Toggler -->
								<label :class="darkMode ? 'bg-primary' : 'bg-stroke'"
									class="relative m-0 block h-7.5 w-14 rounded-full">
									<input type="checkbox" :value="darkMode" @change="darkMode = !darkMode"
										class="absolute top-0 z-50 m-0 h-full w-full cursor-pointer opacity-0" />
									<span :class="darkMode && '!right-[3px] !translate-x-full'"
										class="absolute top-1/2 left-[3px] flex h-6 w-6 -translate-y-1/2 translate-x-0 items-center justify-center rounded-full bg-white shadow-switcher duration-75 ease-linear">
										<span class="dark:hidden">
											<svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
												<path
													d="M7.99992 12.6666C10.5772 12.6666 12.6666 10.5772 12.6666 7.99992C12.6666 5.42259 10.5772 3.33325 7.99992 3.33325C5.42259 3.33325 3.33325 5.42259 3.33325 7.99992C3.33325 10.5772 5.42259 12.6666 7.99992 12.6666Z"
													fill="#969AA1" />
												<path
													d="M8.00008 15.3067C7.63341 15.3067 7.33342 15.0334 7.33342 14.6667V14.6134C7.33342 14.2467 7.63341 13.9467 8.00008 13.9467C8.36675 13.9467 8.66675 14.2467 8.66675 14.6134C8.66675 14.9801 8.36675 15.3067 8.00008 15.3067ZM12.7601 13.4267C12.5867 13.4267 12.4201 13.3601 12.2867 13.2334L12.2001 13.1467C11.9401 12.8867 11.9401 12.4667 12.2001 12.2067C12.4601 11.9467 12.8801 11.9467 13.1401 12.2067L13.2267 12.2934C13.4867 12.5534 13.4867 12.9734 13.2267 13.2334C13.1001 13.3601 12.9334 13.4267 12.7601 13.4267ZM3.24008 13.4267C3.06675 13.4267 2.90008 13.3601 2.76675 13.2334C2.50675 12.9734 2.50675 12.5534 2.76675 12.2934L2.85342 12.2067C3.11342 11.9467 3.53341 11.9467 3.79341 12.2067C4.05341 12.4667 4.05341 12.8867 3.79341 13.1467L3.70675 13.2334C3.58008 13.3601 3.40675 13.4267 3.24008 13.4267ZM14.6667 8.66675H14.6134C14.2467 8.66675 13.9467 8.36675 13.9467 8.00008C13.9467 7.63341 14.2467 7.33342 14.6134 7.33342C14.9801 7.33342 15.3067 7.63341 15.3067 8.00008C15.3067 8.36675 15.0334 8.66675 14.6667 8.66675ZM1.38675 8.66675H1.33341C0.966748 8.66675 0.666748 8.36675 0.666748 8.00008C0.666748 7.63341 0.966748 7.33342 1.33341 7.33342C1.70008 7.33342 2.02675 7.63341 2.02675 8.00008C2.02675 8.36675 1.75341 8.66675 1.38675 8.66675ZM12.6734 3.99341C12.5001 3.99341 12.3334 3.92675 12.2001 3.80008C11.9401 3.54008 11.9401 3.12008 12.2001 2.86008L12.2867 2.77341C12.5467 2.51341 12.9667 2.51341 13.2267 2.77341C13.4867 3.03341 13.4867 3.45341 13.2267 3.71341L13.1401 3.80008C13.0134 3.92675 12.8467 3.99341 12.6734 3.99341ZM3.32675 3.99341C3.15341 3.99341 2.98675 3.92675 2.85342 3.80008L2.76675 3.70675C2.50675 3.44675 2.50675 3.02675 2.76675 2.76675C3.02675 2.50675 3.44675 2.50675 3.70675 2.76675L3.79341 2.85342C4.05341 3.11342 4.05341 3.53341 3.79341 3.79341C3.66675 3.92675 3.49341 3.99341 3.32675 3.99341ZM8.00008 2.02675C7.63341 2.02675 7.33342 1.75341 7.33342 1.38675V1.33341C7.33342 0.966748 7.63341 0.666748 8.00008 0.666748C8.36675 0.666748 8.66675 0.966748 8.66675 1.33341C8.66675 1.70008 8.36675 2.02675 8.00008 2.02675Z"
													fill="#969AA1" />
											</svg>
										</span>
										<span class="hidden dark:inline-block">
											<svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
												<path
													d="M14.3533 10.62C14.2466 10.44 13.9466 10.16 13.1999 10.2933C12.7866 10.3667 12.3666 10.4 11.9466 10.38C10.3933 10.3133 8.98659 9.6 8.00659 8.5C7.13993 7.53333 6.60659 6.27333 6.59993 4.91333C6.59993 4.15333 6.74659 3.42 7.04659 2.72666C7.33993 2.05333 7.13326 1.7 6.98659 1.55333C6.83326 1.4 6.47326 1.18666 5.76659 1.48C3.03993 2.62666 1.35326 5.36 1.55326 8.28666C1.75326 11.04 3.68659 13.3933 6.24659 14.28C6.85993 14.4933 7.50659 14.62 8.17326 14.6467C8.27993 14.6533 8.38659 14.66 8.49326 14.66C10.7266 14.66 12.8199 13.6067 14.1399 11.8133C14.5866 11.1933 14.4666 10.8 14.3533 10.62Z"
													fill="#969AA1" />
											</svg>
										</span>
									</span>
								</label>
								<!-- Dark Mode Toggler -->
							</li>
						</ul>

						<!-- User Area -->
						<div class="relative" x-data="{ dropdownOpen: false }" @click.outside="dropdownOpen = false">
							<a class="flex items-center gap-4" href="<?php $this->SetURL('profile/');?>" >
								<span class="hidden text-right lg:block">
									<span class="block text-sm font-medium text-black dark:text-white"><?php echo $_SESSION['username'];?></span>
									<span class="block text-xs font-medium"><?php echo $_SESSION['nom_rol'];?></span>
								</span>
							</a>
						</div>
						<!-- User Area -->
					</div>
				</div>
			</header>
			<!-- ===== Header End ===== -->
			<form action="<?php $this->SetURL('controllers/auth_controller.php');?>" method="post" id="form_logout">
				<input type="hidden" name="ope" value="logout">
			</form>