<!DOCTYPE html>
<html lang="en">
<?php $this->GetHeader("SGSC | UNEFA");?>

<body
	x-data="{ page: 'signin', 'loaded': true, 'darkMode': true, 'stickyMenu': false, 'sidebarToggle': false, 'scrollTop': false }"
	x-init="
          darkMode = JSON.parse(localStorage.getItem('darkMode'));
          $watch('darkMode', value => localStorage.setItem('darkMode', JSON.stringify(value)))"
	:class="{'dark text-bodydark bg-boxdark-2': darkMode === true}">

  <div class="w-full p-4 sm:p-12.5 xl:p-17.5">
    <div class="w-full p-6 flex flex-row justify-center items-center">
      <img class="w-75" src="<?php $this->SetURL('views/img/404.png');?>" alt="error404">
    </div>
    <h2 class=" mb-9  font-bold text-black dark:text-white sm:text-title-x6 text-center">Pagina no encontrada</h2>
    <p class=" mb-9  font-bold text-black dark:text-white sm:text-title-x6 text-center">¡Ups! Parece que se ha perdido
      en la web,pero no se preocupe,
      estoy aqui para ayudarle a encontrar el camino de regreso</p>
    <div class="flex flex-row justify-center items-center">
      <button>
        <a class=" w-72 cursor-pointer rounded-lg border border-primary bg-primary p-4 font-medium text-white transition hover:bg-opacity-90 "
          href="<?php $this->SetURL('');?>">Regresar</a>
      </button>
    </div>
  </div>
</body>
</html>