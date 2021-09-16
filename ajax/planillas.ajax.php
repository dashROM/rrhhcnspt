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

	public $mes;
	public $gestion;
	public $id_contrato;

	/*=============================================
	NUEVO PLANILLA
	=============================================*/

	public function ajaxNuevoRelacion()	{

		// TRAEMOS DATOS DE CONTRATO
		// $item = "id_contrato";
		// $valor = $this->id_contrato;

		// $contrato = ControladorContratos::ctrMostrarContratos($item, $valor);

		// CONVERTIR NUMERO DE MES A SU VALOR LITERAL
		setlocale(LC_TIME, 'spanish');
		$numero = $this->mes;
		$dateObj   = DateTime::createFromFormat('!m', $numero);
		$mes = strftime('%B', $dateObj->getTimestamp());

		$titulo_relacion = '<h3 style="text-align:center"><strong>&nbsp;RELACION DE NOVEDADES DEL PERSONAL A CONTRATO TEMPORAL&nbsp;PARA EL PAGO DE HABERES&nbsp;CORRESPONDIENTE AL MES DE '.$mes.' DE&nbsp;'.$this->gestion.' RECONOCIENDOSE EL 100% DE ACUERDO AL&nbsp;PUNTO&nbsp;TERCERO DEL CIRCULAR NRO 13/34 DE LA PRESIDENCIA EJECUTIVA DE LA C.N.S.</strong></h3>';

		$datos = array("titulo_relacion" 	=> mb_strtoupper($titulo_relacion,'utf-8'),
						       "mes_planilla"		  => $this->mes, 
						       "gestion_planilla"	=> $this->gestion,
						       "id_contrato"		  => $this->id_contrato,
						       "fecha_calculo"		=> $this->gestion.'-'.$this->mes.'-01',  
						);	

		$respuesta = ControladorPlanillas::ctrNuevoRelacion($datos);

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

if (isset($_POST["nuevoRelacion"])) {

	$nuevoPlanilla = new AjaxPlanillas();
	$nuevoPlanilla -> mes = $_POST["nuevoMes"];
	$nuevoPlanilla -> gestion = $_POST["nuevoGestion"];
	$nuevoPlanilla -> id_contrato = $_POST["nuevoTipoContrato"];

	$nuevoPlanilla -> ajaxNuevoRelacion();

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

