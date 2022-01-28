<?php

require_once "../controladores/personas.controlador.php";
require_once "../modelos/personas.modelo.php";
require_once "../controladores/persona_herederos.controlador.php";
require_once "../modelos/persona_herederos.modelo.php";


class AjaxPersonaHerederos {
	
	public $id_persona_heredero;

	/*=============================================
	MOSTRAR DATOS PERSONA CONTRARTO
	=============================================*/

	public function ajaxMostrarPersonaHeredero()	{

		$item = "id_persona_heredero";
		$valor1 = $this->id_persona_heredero;
		$valor2 = "id_persona";

		$respuesta = ControladorPersonaHerederos::ctrMostrarPersonaHerederos($item, $valor1, $valor2);

		echo json_encode($respuesta);

	}

	public $paterno_heredero;
	public $materno_heredero;
	public $nombre_heredero;
	public $fecha_nacimiento;
	public $parentezco;
	public $id_persona;

	/*=============================================
	NUEVO PERSONA HEREDERO
	=============================================*/

	public function ajaxNuevoPersonaHeredero()	{
			
		$datos = array(	"paterno_heredero" 	 => mb_strtoupper($this->paterno_heredero,'utf-8'),
						"materno_heredero" 	 => mb_strtoupper($this->materno_heredero,'utf-8'),							
				        "nombre_heredero"    => mb_strtoupper($this->nombre_heredero,'utf-8'),
				        "fecha_nacimiento"   => $this->fecha_nacimiento,
				        "parentezco"  		 => $this->parentezco,
				        "id_persona"  		 => $this->id_persona
		);	


		$respuesta = ControladorPersonaHerederos::ctrNuevoPersonaHeredero($datos);

		echo $respuesta;

	}

	/*=============================================
	EDITAR PERSONA HEREDERO
	=============================================*/

	public function ajaxEditarPersonaHeredero() {

		$datos = array( "paterno_heredero"		=> mb_strtoupper($this->paterno_heredero,'utf-8'),
						"materno_heredero"  	=> mb_strtoupper($this->materno_heredero,'utf-8'),
				        "nombre_heredero"   	=> mb_strtoupper($this->nombre_heredero,'utf-8'),
				        "fecha_nacimiento"  	=> $this->fecha_nacimiento,
				        "parentezco"        	=> $this->parentezco,
				        "id_persona_heredero"  	=> $this->id_persona_heredero
		);	

		// var_dump($datos);

		$respuesta = ControladorPersonaHerederos::ctrEditarPersonaHeredero($datos);

		echo $respuesta;

	}

}

/*=============================================
MOSTRAR PERSONA CONTRATO
=============================================*/

if (isset($_POST["mostrarPersonaHeredero"])) {
	
	$personaHeredero = new AjaxPersonaHerederos();

	$personaHeredero -> id_persona_heredero = $_POST["id_persona_heredero"];

	$personaHeredero -> ajaxMostrarPersonaHeredero();

}

/*=============================================
NUEVO PERSONA HEREDERO
=============================================*/

if (isset($_POST["nuevoPersonaHeredero"])) {

	$nuevoPersonaHeredero = new AjaxPersonaHerederos();

	$nuevoPersonaHeredero -> paterno_heredero = $_POST["nuevoPaternoHeredero"];
	$nuevoPersonaHeredero -> materno_heredero = $_POST["nuevoMaternoHeredero"];
	$nuevoPersonaHeredero -> nombre_heredero = $_POST["nuevoNombreHeredero"];
	$nuevoPersonaHeredero -> fecha_nacimiento = $_POST["nuevoFechaNacimientoHeredero"];
	$nuevoPersonaHeredero -> parentezco = $_POST["nuevoParentezco"];
	$nuevoPersonaHeredero -> id_persona = $_POST["idPersona"];

	$nuevoPersonaHeredero -> ajaxNuevoPersonaHeredero();

}

/*=============================================
EDITAR PERSONA HEREDERO
=============================================*/

if (isset($_POST["editarPersonaHeredero"])) {

	$editarPersonaHeredero = new AjaxPersonaHerederos();

	$editarPersonaHeredero -> paterno_heredero = $_POST["editarPaternoHeredero"];
	$editarPersonaHeredero -> materno_heredero = $_POST["editarMaternoHeredero"];
	$editarPersonaHeredero -> nombre_heredero = $_POST["editarNombreHeredero"];
	$editarPersonaHeredero -> fecha_nacimiento = $_POST["editarFechaNacimientoHeredero"];
	$editarPersonaHeredero -> parentezco = $_POST["editarParentezco"];
	$editarPersonaHeredero -> id_persona_heredero = $_POST["idPersonaHeredero"];

	$editarPersonaHeredero -> ajaxEditarPersonaHeredero();

}