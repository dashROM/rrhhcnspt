<?php

require_once "../controladores/planillas.controlador.php";
require_once "../modelos/planillas.modelo.php";

class AjaxPlanillas {

	public $id_planilla;

	/*=============================================
	MOSTRAR DATOS PLANILLA
	=============================================*/

	public function ajaxMostrarPlanilla()	{

		$item = "id_planilla";
		$valor1 = $this->id_planilla;
		$valor2 = null;

		$respuesta = ControladorPlanillas::ctrMostrarPlanillas($item, $valor1, $valor2);

		echo json_encode($respuesta);

	}

	public $titulo_planilla;
	public $mes_planilla;
	public $gestion_planilla;
	public $id_contrato;

	/*=============================================
	NUEVO PLANILLA
	=============================================*/

	public function ajaxNuevoPlanilla()	{

		$datos = array("titulo_planilla" 	=> mb_strtoupper($this->titulo_planilla,'utf-8'),
						"mes_planilla"		=> $this->mes_planilla, 
						"gestion_planilla"	=> $this->gestion_planilla,
						"id_contrato"		=> $this->id_contrato,
						"fecha_calculo"		=> $this->gestion_planilla.'-'.$this->mes_planilla.'-01',  
						);	

		$respuesta = ControladorPlanillas::ctrNuevoPlanilla($datos);

		echo $respuesta;

	}


	/*=============================================
	EDITAR PLANILLA
	=============================================*/

	public function ajaxEditarPlanilla() {

		$datos = array("titulo_planilla"   		=> mb_strtoupper($this->titulo_planilla,'utf-8'),
						"id_planilla"   		=> $this->id_planilla,
						);	

		// var_dump($datos);

		$respuesta = ControladorPlanillas::ctrEditarPlanilla($datos);

		echo $respuesta;

	}
	
	public $file;

	/*=============================================
	ELIMINADO REPORTE PDF GENERADO
	=============================================*/

	public function ajaxEliminarReportePDF()	{
		
		$file = $this->file;

		unlink('../'.$file);

	}

}

/*=============================================
MOSTRAR PLANILLA
=============================================*/

if (isset($_POST["mostrarPlanilla"])) {
	
	$planillas = new AjaxPlanillas();
	$planillas -> id_planilla = $_POST["id_planilla"];
	$planillas-> ajaxMostrarPlanilla();

}

/*=============================================
NUEVO PLANILLA
=============================================*/

if (isset($_POST["nuevoPlanilla"])) {

	$nuevoPlanilla = new AjaxPlanillas();
	$nuevoPlanilla -> titulo_planilla = $_POST["titulo_planilla"];
	$nuevoPlanilla -> mes_planilla = $_POST["mes_planilla"];
	$nuevoPlanilla -> gestion_planilla = $_POST["gestion_planilla"];
	$nuevoPlanilla -> id_contrato = $_POST["id_contrato"];

	$nuevoPlanilla -> ajaxNuevoPlanilla();

}

/*=============================================
EDITAR PLANILLA
=============================================*/

if (isset($_POST["editarPlanilla"])) {

	$nuevoPlanilla = new AjaxPlanillas();
	$nuevoPlanilla -> titulo_planilla = $_POST["titulo_planilla"];
	$nuevoPlanilla -> id_planilla = $_POST["id_planilla"];

	$nuevoPlanilla -> ajaxEditarPlanilla();

}

/*=============================================
ELIMINAR EL PDF TEMPORAL DE REPORTE GENERADO
=============================================*/

if (isset($_POST["eliminarPDF"])) {

	$reportesCovid = new AjaxPlanillas();
	$reportesCovid -> file = $_POST["url"];
	$reportesCovid -> ajaxEliminarReportePDF();

}

