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

									<div class="p-6 items-center">
										<h3 class="font-medium text-center py-6 text-2xl text-black dark:text-white">
											Nombre
										</h3>

										<p>Universidad Nacional Experimental Politécnica De La Fuerza Armada Nacional Bolivariana (UNEFA) –
											Núcleo Portuguesa, extensión Acarigua.</p>

										<h3 class="font-medium text-center py-6 text-2xl text-black dark:text-white">
											Misión
										</h3>

										<p> formar a través de la docencia, la investigación y la extensión, ciudadanos corresponsables con la
											seguridad y Defensa Integral de la Nación, comprometidos con la Revolución Bolivariana, con
											competencias emancipadoras y humanistas necesarias para sustentar los planes de desarrollo del país,
											promoviendo la producción y el intercambio de saberes, como mecanismo de integración latinoamericana
											y caribeña.</p>

										<h3 class="font-medium text-center py-6 text-2xl text-black dark:text-white">
											Visión
										</h3>

										<p> ser la primera universidad socialista, reconocida por su Excelencia Educativa en el territorio
											nacional e internacional, líder en los saberes humanistas, científicos, tecnológicos y militares,
											inspirada en el ideario bolivariano.</p>



										<h3 class="font-medium text-center py-6 text-2xl text-black dark:text-white">
											Reseña Histórica (NÚCLEO PORTUGUESA – EXTENSIÓN ACARIGUA)
										</h3>

										<p>La UNEFA del Estado Portuguesa, nace con la extensión Turén y Guanare, siendo Turén la Sede
											Principal, abriendo sus puertas el 5 de diciembre de 2005 en el Ciclo Básico Turén. Luego, el 23 de
											enero del mismo año, se da inicio a la extensión Acarigua con las carreras: Ingeniería de Gas, Ing.
											En azúcar, Ing. Agroindustrial (diurno y nocturno), Licenciatura en Economía Social y T.S.U. en
											Enfermería. </p>
										<br>
										<p>En septiembre del 2006, pasa la Sede Principal a Guanare, quedando Turén, San Genaro de Boconoito y
											Acarigua como extensiones. Ángela Castillo, cofundadora regional, expresó, que la matrícula de
											Acarigua, generalmente es la mayor en comparación a la Sede y las demás extensiones. </p>
										<br>
										<p>Los primeros docentes contratados fueron: Juan Cleman, Jorge de Agostini, Lcda. Ismary Barreto,
											Lcda. Maibe González, entre otros docentes, que con el tiempo formaron parte del crecimiento y
											desarrollo de la universidad, llegando a contar con matrículas de más 4 mil estudiantes para el año
											2011. </p>
										<br>
										<p>Actualmente, la extensión Acarigua tiene 17 años prestando sus servicios educativos, siendo los
											docentes fundadores del Estado: Abog. Karin El Mime, Prof. Freddy Mendoza, Prof. Betty Alejos,
											Somaya El Alah y la Prof. Angela Castillo. Así mismo, la extensión Acarigua, presta actualmente,
											solo tres carreras y se encontraba situada en Pozo Blanco.</p>
										<br>
										<p>Si embargo, como consecuencia de la pandemia, los espacios de la UNEFA Extensión Acarigua, quedaron
											en desuso y deterioro, por lo que se vieron en la necesidad de solicitar en calidad de préstamo las
											instalaciones de la Aldea Misión Sucre, ubicados en las inmediaciones de la Alcaldía de Araure.
											Además, posee una matrícula actual de más de 400 estudiantes aproximadamente.</p>
										<br>
										<p>Fuente: Ángela Castillo, Cofundadora de la UNEFA Extensión Portuguesa (2022).</p>
										<br>
									</div>

									<div class="p-6 items-center">
										<h3 class="font-medium text-center py-6 text-2xl text-black dark:text-white">
											Reseña Histórica (UNEFA – GENERAL)
										</h3>

										<p>El 16 de agosto de 1973 por orden del Presidente de la República Dr. Rafael Caldera y resolución
											del Ministerio de la Defensa, se nombró una Comisión con el objeto de que se realizara y presentara
											un Proyecto de Creación para una Universidad Experimental de las Fuerzas Armadas, tomando como base
											la integración de las disciplinas de carácter universitario que en esos momentos se impartían en
											tres escuelas: Escuela de Ingeniería Militar del Ejército, que formaba ingenieros civiles; Escuela
											de Comunicaciones y Electrónica del Ministerio de la Defensa, que formaba ingenieros electrónicos, y
											la Escuela de Postgrado de la Armada, que formaba ingenieros mecánicos e ingenieros electricistas.
										</p>
										<br>
										<p>Esa Comisión entregó una ponencia que el Ministerio de la Defensa remitió al Ministerio de
											Educación y al Consejo Nacional de Universidades para su estudio y discusión; coordinación
											interministerial esta que recomendó al Poder Ejecutivo, el 21 de noviembre de 1973, la creación del
											Instituto Universitario Politécnico de las Fuerzas Armadas Nacionales.</p>
										<br>
										<p>El 3 de febrero de 1974 el Presidente Rafael Caldera, mediante Decreto Nro. 1587, y en ejercicio
											que le confería el ordinal 22 del Art. 190 de la Constitución Nacional, y de conformidad con lo
											dispuesto en el parágrafo único del Art. 2do del Reglamento de los Institutos Universitarios, previa
											opinión favorable del Consejo Nacional de Universidades, decretó la creación del Iupfan, con sede
											principal en la Región Capital y núcleos en los lugares del país que fueran requeridos por las
											Fuerzas Armadas.</p>
										<br>
										<p>Luego de 25 años continuos de fructífera labor educativa, considerando que el Instituto había sido
											una alternativa válida para la educación superior de la Institución Castrense y de la comunidad
											venezolana en general, distinguiéndose por la excelencia, la responsabilidad y la disciplina, y que
											eran impostergables innovaciones profundas de trascendencia en la educación venezolana, con
											estructuras académico-administrativas sólidas que facilitaran la integración de esfuerzos y
											recursos.</p>
										<br>
										<p>Y cumplidos los requisitos de Ley, el Iupfan fue transformado en la Universidad Nacional
											Experimental Politécnica de la Fuerza Armada Nacional Bolivariana (UNEFA), con la misión primordial
											de formar profesionales en los diferentes aéreas de la Educación Superior, en las ramas de la
											ciencia, la industria, la tecnología y las ciencias sociales para el desarrollo de la Fuerza Armada
											Nacional Bolivariana y del país.</p>
										<br>
										<p>A tal efecto, el 17 de octubre de 1996 se nombró un Comité con el objeto de fundamentar la
											mencionada transformación. Este Comité se abocó a llevar adelante los asuntos de carácter
											administrativo y académico a fin de justificar los cambios requeridos para la adecuada formación de
											profesionales de elevada calidad académica y consustanciados con la problemática del país.</p>
										<br>
										<p>El 5 de octubre de 1998, el Consejo Nacional de Universidades, mediante Resolución N° 28 publicada
											en Gaceta Oficial de la República de Venezuela N° 36.583, de fecha 17 de noviembre de 1998, emitió
											opinión favorable a la transformación académica de la Institución y el 26 de abril de 1999, Hugo
											Rafael Chávez Frías, Presidente de la República, mediante el Decreto N° 115, en ejercicio de la
											atribución que le confiere el Art. 10 de la Ley de Universidades, en Consejo de Ministros y previa
											opinión favorable del Consejo Nacional de Universidades, decretó la creación de la UNEFA, con sede
											principal en la Región Capital y núcleos en lugares del país requeridos por las Fuerzas Armadas.</p>
										<br>
										<p>Con el hecho de la transformación, la UNEFA logró personalidad jurídica y patrimonio propio e
											independiente del Fisco Nacional. Adquirió el carácter de Universidad Experimental, estatus que le
											confirió estructura dinámica y autonomía organizativa, académica, administrativa, económica y
											financiera. Pasó además a formar parte del Consejo Nacional de Universidades, ampliando y
											profundizando de este modo sus objetivos, alcances académicos y competencias curriculares.</p>
										<br>
										<p>Actualmente esta Casa de Estudios se caracteriza por ser una Institución comprometida e involucrada
											de modo muy activo y protagónico en el desarrollo económico, social y cultural de la Nación. Para
											dar cumplimiento a esta misión social la UNEFA, planifica acciones en función de la expansión,
											desarrollo y promoción de la educación en el sentido más amplio, sin excluir a ningún estrato social
											del país.</p>
										<br>
										<p>La función de expansión se concreta en la ejecución interrelacionada de los procesos
											universitarios: Docencia, investigación y extensión, respondiendo a las exigencias del objetivo
											social de la política del Estado, referente al alcance de la justicia social, por cuanto cumple con
											la necesidad de alcanzar la equidad como nuevo orden de justicia social y base material de la
											sociedad venezolana.</p>
										<br>

										<h3 class="font-medium text-center py-6 text-2xl text-black dark:text-white">
											Fuente: página web de la Universidad Nacional Experimental Politécnica de la Fuerza Armada Nacional
											Bolivariana (UNEFA).
										</h3>
									</div>
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