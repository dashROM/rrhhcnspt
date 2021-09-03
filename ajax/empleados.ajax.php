<?php

require_once "../controladores/empleados.controlador.php";
require_once "../modelos/empleados.modelo.php";
require_once "../controladores/personas.controlador.php";
require_once "../modelos/personas.modelo.php";

class AjaxEmpleados {
	
	public $id_empleado;

	/*=============================================
	MOSTRAR DATOS EMPLEADO
	=============================================*/

	public function ajaxMostrarEmpleado()	{

		$item = "id_empleado";
		$valor1 = $this->id_empleado;
		$valor2 = null;

		$respuesta = ControladorEmpleados::ctrMostrarEmpleados($item, $valor1, $valor2);

		echo json_encode($respuesta);

	}

	public $id_establecimiento;
	public $id_persona;
	public $id_cargo;
	public $fecha_inicio_contrato;
	public $fecha_fin_contrato;
	public $id_contrato;
	public $observaciones;

	/*=============================================
	NUEVO EMPLEADO
	=============================================*/

	public function ajaxNuevoEmpleado()	{

		$datos = array("id_establecimiento" 	=> $this->id_establecimiento,						
						"id_persona"     		=> $this->id_persona,
						"id_cargo"   	       	=> $this->id_cargo,
						"fecha_inicio_contrato" => $this->fecha_inicio_contrato,
						"dias_contrato"			=> $this->dias_contrato,
						"fecha_fin_contrato"   	=> $this->fecha_fin_contrato,
						"id_contrato"   	    => $this->id_contrato,
						"estado_empleado"		=> 0,
						"observaciones"   		=> rtrim(mb_strtoupper($this->observaciones,'utf-8')),
						);	

		$respuesta = ControladorEmpleados::ctrNuevoEmpleado($datos);

		echo $respuesta;

	}

	/*=============================================
	EDITAR EMPLEADO
	=============================================*/

	public function ajaxEditarEmpleado() {

		$datos = array("id_establecimiento" 	=> $this->id_establecimiento,
						"id_persona"     		=> $this->id_persona,
						"id_cargo"   	       	=> $this->id_cargo,
						"fecha_inicio_contrato" => $this->fecha_inicio_contrato,
						"dias_contrato"			=> $this->dias_contrato,
						"fecha_fin_contrato"   	=> $this->fecha_fin_contrato,
						"id_contrato"   	    => $this->id_contrato,
						"observaciones"   		=> mb_strtoupper($this->observaciones,'utf-8'),
						"id_empleado"   		=> $this->id_empleado,
						);	

		// var_dump($datos);

		$respuesta = ControladorEmpleados::ctrEditarEmpleado($datos);

		echo $respuesta;

	}

	/*=============================================
	ACTIVAR EMPLEADO
	=============================================*/

	public $activarEmpleado;
	public $activarId;

	public function ajaxActivarEmpleado() {
		
		$tabla = "empleados";

		$item1 = "estado_empleado";
		$valor1 = $this->activarEmpleado;

		$item2 = "id_empleado";
		$valor2 = $this->activarId;

		$respuesta = ModeloEmpleados::mdlActivarEmpleado($tabla, $item1, $valor1, $item2, $valor2);

	}

	/*=============================================
	VALIDAR NO REPETIR EMPLEADO REGISTRADO Y ASIGNADO
	=============================================*/

	public $validarEmpleado;
	public $validarId;

	public function ajaxValidarEmpleado() {

		$item = "id_persona";
		$valor1 = $this->validarEmpleado;
		$valor2 = $this->validarId;

		$respuesta = ControladorEmpleados::ctrMostrarPersonaEmpleado($item, $valor1, $valor2);

		echo json_encode($respuesta);

	}

}

/*=============================================
VALIDAR NO REPETIR EMPLEADO REGISTRADO Y ASIGNADO
=============================================*/

if (isset($_POST["validarEmpleado"])) {

	$valEmpleado = new AjaxEmpleados();

	if (isset($_POST["validarId"])) {
	
		$valEmpleado -> validarEmpleado = $_POST["validarEmpleado"];
		$valEmpleado -> validarId = $_POST["validarId"];

	} else {

		$valEmpleado -> validarEmpleado = $_POST["validarEmpleado"];
		$valEmpleado -> validarId = null;

	}

	$valEmpleado -> ajaxValidarEmpleado();

}

/*=============================================
MOSTRAR EMPLEADO
=============================================*/

if (isset($_POST["mostrarEmpleado"])) {
	
	$empleados = new AjaxEmpleados();
	$empleados -> id_empleado = $_POST["id_empleado"];
	$empleados-> ajaxMostrarEmpleado();

}

/*=============================================
NUEVO EMPLEADO
=============================================*/

if (isset($_POST["nuevoEmpleado"])) {

	$nuevoEmpleado = new AjaxEmpleados();
	$nuevoEmpleado -> id_establecimiento = $_POST["nuevoEstablecimiento"];
	$nuevoEmpleado -> id_persona = $_POST["nuevoBuscarPersona"];
	$nuevoEmpleado -> id_cargo = $_POST["nuevoCargoEmpleado"];
	$nuevoEmpleado -> fecha_inicio_contrato = $_POST["nuevoFechaInicio"];
	$nuevoEmpleado -> dias_contrato = $_POST["nuevoDiasContrato"];
	$nuevoEmpleado -> fecha_fin_contrato = $_POST["nuevoFechaFin"];
	$nuevoEmpleado -> id_contrato = $_POST["nuevoTipoContrato"];
	$nuevoEmpleado -> observaciones = $_POST["nuevoObservacionesEmpleado"];

	$nuevoEmpleado -> ajaxNuevoEmpleado();

}

/*=============================================
EDITAR EMPLEADO
=============================================*/

if (isset($_POST["editarEmpleado"])) {

	$editarEmpleado = new AjaxEmpleados();
	$editarEmpleado -> id_establecimiento = $_POST["editarEstablecimiento"];
	$editarEmpleado -> id_persona = $_POST["editarBuscarPersona"];
	$editarEmpleado -> id_cargo = $_POST["editarCargoEmpleado"];
	$editarEmpleado -> fecha_inicio_contrato = $_POST["editarFechaInicio"];
	$editarEmpleado -> dias_contrato = $_POST["editarDiasContrato"];
	$editarEmpleado -> fecha_fin_contrato = $_POST["editarFechaFin"];
	$editarEmpleado -> id_contrato = $_POST["editarTipoContrato"];
	$editarEmpleado -> observaciones = $_POST["editarObservacionesEmpleado"];
	$editarEmpleado -> id_empleado = $_POST["editarIdEmpleado"];

	$editarEmpleado -> ajaxEditarEmpleado();

}

/*=============================================
ACTIVAR EMPLEADO
=============================================*/

if (isset($_POST["activarEmpleado"])) {

	$activarEmpleado = new AjaxEmpleados();
	$activarEmpleado -> activarEmpleado = $_POST["activarEmpleado"];
	$activarEmpleado -> activarId = $_POST["activarId"];
	$activarEmpleado -> ajaxActivarEmpleado();

}