<?php

require_once "../controladores/planillas.controlador.php";
require_once "../modelos/planillas.modelo.php";

class AjaxPlanillas {

	public $id_planilla;

	/*=============================================
	MOSTRAR DATOS RELACION DE NOVEDADES
	=============================================*/

	public function ajaxMostrarRelacion()	{

		$item = "id_planilla";
		$valor1 = $this->id_planilla;
		$valor2 = null;

		$respuesta = ControladorPlanillas::ctrMostrarRelacion($item, $valor1, $valor2);

		echo json_encode($respuesta);

	}

	public $mes;
	public $gestion;
	public $id_contrato;

	/*=============================================
	NUEVO RELACION DE NOVEDADES
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

		$titulo = '<h3 style="text-align:CENTER"><strong>RELACION DE NOVEDADES DEL PERSONAL A CONTRATO TEMPORAL PARA EL PAGO DE HABERES CORRESPONDIENTE AL MES DE '.strtoupper($mes).' DE '.$this->gestion.' RECONOCIENDOSE EL 100% DE ACUERDO AL PUNTO TERCERO DEL CIRCULAR NRO 13/34 DE LA PRESIDENCIA EJECUTIVA DE LA C.N.S.</strong></h3>';

		$datos = array("titulo_relacion" 	=> $titulo,
						       "mes_planilla"		  => $this->mes, 
						       "gestion_planilla"	=> $this->gestion,
						       "id_contrato"		  => $this->id_contrato,
						       "fecha_calculo"		=> $this->gestion.'-'.$this->mes.'-01',  
						);	

		$respuesta = ControladorPlanillas::ctrNuevoRelacion($datos);

		echo $respuesta;

	}

	public $titulo_relacion;

	/*=============================================
	EDITAR RELACION DE NOVEDADES
	=============================================*/

	public function ajaxEditarRelacion() {

		$titulo = trim($this->titulo_relacion);

		$datos = array("titulo_relacion"  => $titulo,
						       "id_planilla"   		=> $this->id_planilla,
		);	

		// var_dump($datos);

		$respuesta = ControladorPlanillas::ctrEditarRelacion($datos);

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

if (isset($_POST["mostrarRelacion"])) {
	
	$planillas = new AjaxPlanillas();
	$planillas -> id_planilla = $_POST["id_planilla"];
	$planillas -> ajaxMostrarRelacion();

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

if (isset($_POST["editarRelacion"])) {

	$nuevoPlanilla = new AjaxPlanillas();
	$nuevoPlanilla -> titulo_relacion = $_POST["titulo_relacion"];
	$nuevoPlanilla -> id_planilla = $_POST["id_planilla"];

	$nuevoPlanilla -> ajaxEditarRelacion();

}

/*=============================================
ELIMINAR EL PDF TEMPORAL DE REPORTE GENERADO
=============================================*/

if (isset($_POST["eliminarPDF"])) {

	$reportesCovid = new AjaxPlanillas();
	$reportesCovid -> file = $_POST["url"];
	$reportesCovid -> ajaxEliminarReportePDF();

}

