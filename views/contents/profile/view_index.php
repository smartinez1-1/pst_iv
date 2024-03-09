<!DOCTYPE html>
<html lang="en">
<?php $this->GetHeader("SGSC | UNEFA"); ?>

<body x-data="{ page: 'signin', 'loaded': true, 'darkMode': true, 'stickyMenu': false, 'sidebarToggle': false, 'scrollTop': false }" x-init="
          darkMode = JSON.parse(localStorage.getItem('darkMode'));
          $watch('darkMode', value => localStorage.setItem('darkMode', JSON.stringify(value)))" :class="{'dark text-bodydark bg-boxdark-2': darkMode === true}">

	<!-- ===== Page Wrapper Start ===== -->
	<div class="flex h-screen overflow-hidden">
		<?php $this->GetComplement('sidebar_menu'); ?>
		<!-- ===== Content Area Start ===== -->
		<div class="relative flex flex-1 flex-col overflow-y-auto overflow-x-hidden">
			<?php $this->GetComplement('header'); ?>
			<main>
				<div class="max-w-screen-2xl mx-auto p-4 md:p-6 2xl:p-10">
					<!-- ====== Form Layout Section Start -->
					<div class="grid grid-cols-1 gap-9 sm:grid-cols-1">
						<div class="flex flex-col gap-9">
							<!-- Contact Form -->
							<div class=" rounded-sm border border-stroke bg-white shadow-default dark:border-strokedark dark:bg-boxdark">
								<div class="border-b border-stroke py-4 px-6.5 dark:border-strokedark justify-center items-center text-center flex mb-4 justify-center">
                  <h2>hola</h2>
								</div>
							</div>
							</form>
						</div>
					</div>
				</div>
			</main>

		</div>
		<!-- ===== Content Area End ===== -->
	</div>
	<!-- ===== Page Wrapper End ===== -->
	<?php $this->GetComplement('scripts'); ?>
</body>

</html>