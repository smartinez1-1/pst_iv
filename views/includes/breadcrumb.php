<!-- Breadcrumb Start -->
<!-- ESTO BASICAMENTE ES EL BRADCRUMB -->
<div class="mb-6 flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">
	<h2 class="text-title-md2 font-bold text-black dark:text-white">
		<?php echo $options['title_breadcrumb'];?>
	</h2>

	<nav>
		<ol class="flex items-center gap-2">
			<li><a class="font-medium text-capitalize" href="<?php $this->SetURL();?>"><?php echo $this->controlador;?> /</a></li>
			<li class="font-medium text-primary"><a class="font-medium" href="<?php $this->SetURL($this->controlador."/formulario");?>">Registrar</a></li>
		</ol>
	</nav>
</div>
<!-- Breadcrumb End -->