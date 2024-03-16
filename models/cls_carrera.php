<?php
if (!class_exists("cls_db")) require_once("cls_db.php");
// HARE LA EXPLICACION CON UN SOLO MODULO, YA QUE EL RESTO ES IGUAL
// ACA ESTA LA CLASE CLS_CARRERA, EL CUAL ES UN ESPEJO DE LA TABLA CARRERA, CLS = CLASE, DICHA CLASE EXTIENDE DE CLS_DB, OSEA CLS_CARRERA ES HIJA DE CLS_DB, Y COMO ES HIJA, PUEDE TENER LA CONEXION A LA BASE DE DATOS
class cls_carrera extends cls_db
{
	// ESTOS SON LOS ATRIBUTOS, (SOLO SE PUEDEN USAR AQUI PORQUE SON PRIVADOS) SI, SI
	private $id_carrera, $nombre_carrera, $codigo_carrera, $estado_carrera, $turno_carrera, $admite_grupos_mixtos;
	// EL CONSTRUCTOR AL EJECUTARSE AUTOMATICAMENTE, TAMBIEN EJECUTA EL CONSTRUCTOR DE SU PADRE 'CLS_DB', ESTO HACE QUE SE CREE, LA CONEXION A LA BASE DE DATOS CADA VEZ QUE SE USA UNA CLASE, ADEMAS TAMBIEN VACIAMOS LOS POSIBLES DATOS QUE TENGAN LOS ATRIBUTOS DE ESTA CLASE
	public function __construct()
	{
		parent::__construct();
		$this->id_carrera = $this->nombre_carrera = $this->codigo_carrera = $this->estado_carrera = "";
		$this->turno_carrera = "";
		$this->admite_grupos_mixtos = "";
	}
	// CON EL SET DATOS BASICAMENTE DEFINIMOS QUE COSA VA DONDE, CUANDO ENVIAMOS LA INFORMACION DESDE EL CONTROLADOR AL MODELO
	public function setDatos($d)
	{
		$this->id_carrera = isset($d['id_carrera']) ? $this->Clean(intval($d['id_carrera'])) : null;
		$this->nombre_carrera = isset($d['nombre_carrera']) ? $this->Clean($d['nombre_carrera']) : null;
		$this->codigo_carrera = isset($d['codigo_carrera']) ? $this->Clean($d['codigo_carrera']) : '';
		$this->estado_carrera = isset($d['estado_carrera']) ? $this->Clean($d['estado_carrera']) : '';
		$this->turno_carrera = isset($d['turno_carrera']) ? $this->Clean($d['turno_carrera']) : '';
		$this->admite_grupos_mixtos = isset($d['admite_grupos_mixtos']) ? $this->Clean($d['admite_grupos_mixtos']) : '';
	}

	// AQUI PRIMERAMENTE, VERIFICAMOS QUE NO VAMOS A DUPLICAR LA INFORMACION DE OTRA CARRERA, SI YA EXISTE LA CARRERA INGENIERIA, EL SISTEMA NO VA A DEJAR QUE LA VUELVAS A CREAR, SI LO INTENTAS, TE HECHA PARA ATRAS
	public function create()
	{
		$sqlConsulta = "SELECT * FROM carrera WHERE codigo_carrera = '$this->codigo_carrera'";
		$result = $this->Query($sqlConsulta);

		if ($result->num_rows > 0) return "err/02ERR";
		// AHORITA VEMOS LOS CODIGOS DE ERROR
		// AQUI ABAJO LO QUE QUEDA ES EJECUTAR DICHA CONSULTA, LA CUAL ES DE INSERCION DE DATOS
		$sql = "INSERT INTO carrera(nombre_carrera,codigo_carrera,estado_carrera,turno_carrera,admite_grupos_mixtos) VALUES('$this->nombre_carrera','$this->codigo_carrera','$this->estado_carrera','$this->turno_carrera','$this->admite_grupos_mixtos');";
		// EL METODO QUERY VIENE DE CLS_DB, PERO COMO ESTAMOS EN UNA CLASE HIJA, SE PUEDE USAR AQUI
		$this->Query($sql);
		// Y ESTO VERIFICA QUE SE EJECUTO BIEN LA CONSULTA
		if ($this->Result_last_query()) return "msg/01DONE";
		else return "err/01ERR";
	}
	// MISMO PROCESO, PARA NO DUPLICAR NADA
	// TANTO A LA FUNCION DE CREATE, COMO A LA FUNCION DE UPDATE, NO LE ESTOY PASANDO NADA POR PARAMETRO, PORQUE YA TODO ESTA DEFINIDO ARRIBA, EN LA FUNCION SETDATOS
	public function update()
	{
		$sqlConsulta = "SELECT * FROM carrera WHERE codigo_carrera = '$this->codigo_carrera' AND nombre_carrera = '$this->nombre_carrera' AND estado_carrera = '$this->estado_carrera' AND turno_carrera = '$this->turno_carrera' AND admite_grupos_mixtos = '$this->admite_grupos_mixtos';";
		$result = $this->Query($sqlConsulta);

		// var_dump($sqlConsulta);
		// die();

		if ($result->num_rows > 0) return "err/02ERR";
		// ACTUALIZAMOS LA CARRERA CON SUS NUEVOS DATOS Y AL FINAL NO HAGO DICHA VALIDACION PARA VERIFICAR SI SE EJECUTO BIEN, PORQUE PUEDE PASAR QUE EL USUARIO NO CAMBIO NADA Y LE DIO A GUARDAR, Y PUES, NO DEBERIA DE DARLE ERROR CUANDO NO GUARDO NADA
		$sql = "UPDATE carrera SET 
				codigo_carrera = '$this->codigo_carrera', 
				nombre_carrera = '$this->nombre_carrera',
				estado_carrera = '$this->estado_carrera',
				turno_carrera = '$this->turno_carrera',
				admite_grupos_mixtos = '$this->admite_grupos_mixtos'
				WHERE id_carrera = $this->id_carrera ;";

		$this->Query($sql);
		return "msg/01DONE";
	}
	// AQUI OBTENGO TODAS LAS CARRERAS
	public function Get_carreras()
	{
		$sql = "SELECT * FROM carrera;";
		$results = $this->Query($sql);
		return $this->Get_todos_array($results);
	}
	// AQUI CONSULTA UNA SOLA CARRERA POR SU ID
	public function consulta($id)
	{
		$sql = "SELECT * FROM carrera WHERE id_carrera = '$id';";
		$results = $this->Query($sql);
		return $this->Get_array($results);
	}
	// ESTA CONSULTA SI ES MAS COMPLEJA, YA QUE ESTOY CONSULTANDO TODOS LOS ESTUDIANTES QUE HAY EN UNA CARRERA, ESTO LO HAGO UNIENDO LAS TABLAS DE LA BASE DE DATOS, PARA BUSCAR DATOS QUE COINCIDAN (INNER JOIN), TRADUCCION COMO TAL, SERIA UNION PUES
	public function ConsultaEstudiantesPorCarrera($carrera)
	{
		// CONSULTAMOS EN LA TABLA ESTUDIANTE, UNIMOS LA TABLA USUARIO DONDE LA CEDULA DEL USUARIO COINCIDA CON LA CEDULA DEL ESTUDIANTE, DESPUES UNIMOS LA TABLA INSCRIPCION DONDE COINCIDA EL ID DEL ESTUDIANTE, Y ASI ME VOY EXTENDIENDO HASTA DONDE SE NECESITE, SI, SI PASA QUE HAY UN ESTUDIANTE QUE NO COINCIDE, ERA EL UNICO QUE SALGA EN LA CONSULTA (EJEMPLO, UN ESTUDIANTE QUE NO ESTA INSCRITO, SI EXISTE, PERO NO ESTA INSCRITO, SUS DATOS NO HARAN COINCIDENSIA EN LA TABLA DE INSCRIPCION Y HASTA AHI LLEGARA)
		$sql = "SELECT * FROM estudiante 
				INNER JOIN usuario ON usuario.cedula_usuario = estudiante.cedula_usuario 
				INNER JOIN inscripcion ON inscripcion.id_estudiante = estudiante.id_estudiante
				INNER JOIN ano_escolar ON ano_escolar.id_ano_escolar = inscripcion.id_ano_escolar
				WHERE inscripcion.id_carrera = '$carrera'";
		$results = $this->Query($sql);
		return $this->Get_todos_array($results);
	}
}
