<?php

require_once "../controladores/planillas.controlador.php";
require_once "../modelos/planillas.modelo.php";

class AjaxPlanillas {

	public $id_planilla;

	/*=============================================
	MOSTRAR DATOS RELACION DE NOVEDADES/PLANILLA
	=============================================*/

	public function ajaxMostrarPlanilla()	{

		$item = "id_planilla";
		$valor1 = $this->id_planilla;
		$valor2 = null;

		$respuesta = ControladorPlanillas::ctrMostrarPlanilla($item, $valor1, $valor2);

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

		// SI TIPO DE CONTRATO ES SUPLENCIA O NO
		if ($this->id_contrato != 1) {

			// SI TIPO DE CONTRATO ES PLAZO FIJO O COVID-19
			if ($this->id_contrato == 2) {

				$titulo_relacion = '<h3 style="text-align:CENTER"><strong>RELACION DE NOVEDADES DEL PERSONAL A CONTRATO TEMPORAL (POR NECESIDAD DE SERVICIO) PARA EL PAGO DE HABERES CORRESPONDIENTE AL MES DE '.strtoupper($mes).' DE '.$this->gestion.' RECONOCIENDOSE EL 100% DE ACUERDO AL PUNTO TERCERO DEL CIRCULAR NRO 13/34 DE LA PRESIDENCIA EJECUTIVA DE LA C.N.S.</strong></h3>';

				$titulo_planilla = '<h3 style="text-align:CENTER"><strong>PLANILLA DE PAGO DE HABERES DEL PERSONAL A CONTRATO A PLAZO FIJO (POR NECESIDAD DE SERVICIO) CORRESPONDIENTE AL MES DE '.strtoupper($mes).' DE '.$this->gestion.' </strong></h3>';

			} elseif($this->id_contrato == 5) {

				$titulo_relacion = '<h3 style="text-align:CENTER"><strong>RELACION DE NOVEDADES DEL PERSONAL A CONTRATO TEMPORAL (RECURRENTE) PARA EL PAGO DE HABERES CORRESPONDIENTE AL MES DE '.strtoupper($mes).' DE '.$this->gestion.' RECONOCIENDOSE EL 100% DE ACUERDO AL PUNTO TERCERO DEL CIRCULAR NRO 13/34 DE LA PRESIDENCIA EJECUTIVA DE LA C.N.S.</strong></h3>';

				$titulo_planilla = '<h3 style="text-align:CENTER"><strong>PLANILLA DE PAGO DE HABERES DEL PERSONAL A CONTRATO A PLAZO FIJO (RECURRENTE) CORRESPONDIENTE AL MES DE '.strtoupper($mes).' DE '.$this->gestion.' </strong></h3>';

			} else {

				$titulo_relacion = '<h3 style="text-align:CENTER"><strong>RELACION DE NOVEDADES DEL PERSONAL A CONTRATO TEMPORAL (COVID-19) PARA EL PAGO DE HABERES CORRESPONDIENTE AL MES DE '.strtoupper($mes).' DE '.$this->gestion.' RECONOCIENDOSE EL 100% DE ACUERDO AL PUNTO TERCERO DEL CIRCULAR NRO 13/34 DE LA PRESIDENCIA EJECUTIVA DE LA C.N.S.</strong></h3>';

				$titulo_planilla = '<h3 style="text-align:CENTER"><strong>PLANILLA DE PAGO DE HABERES DEL PERSONAL A CONTRATADO PARA CUBRIR COVID-19 CORRESPONDIENTE AL MES DE '.strtoupper($mes).' DE '.$this->gestion.' </strong></h3>';

			}

		} else {

			$titulo_relacion = '<h3 style="text-align:CENTER"><strong>RELACION DE NOVEDADES DEL PERSONAL A CONTRATO TEMPORAL (SUPLENCIA) PARA EL PAGO DE HABERES CORRESPONDIENTE AL MES DE '.strtoupper($mes).' DE '.$this->gestion.' RECONOCIENDOSE EL 100% DE ACUERDO AL PUNTO TERCERO DEL CIRCULAR NRO 13/34 DE LA PRESIDENCIA EJECUTIVA DE LA C.N.S.</strong></h3>';

			$titulo_planilla = '<h3 style="text-align:CENTER"><strong>PLANILLA DE PAGO DE HABERES DEL PERSONAL A CONTRATADO PARA CUBRIR SUPLENCIAS CORRESPONDIENTE AL MES DE '.strtoupper($mes).' DE '.$this->gestion.' </strong></h3>';

		}

		$datos = array("titulo_relacion" 	=> $titulo_relacion,
									 "titulo_planilla" 	=> $titulo_planilla,
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
	EDITAR TITULO (RELACION DE NOVEDADES)
	=============================================*/

	public function ajaxEditarTituloRelacion() {

		$datos = array("titulo_relacion" 		=> trim($this->titulo_relacion),
						       "id_planilla" 				=> $this->id_planilla,
		);	

		$respuesta = ControladorPlanillas::ctrEditarTitulo($datos);

		echo $respuesta;

	}	

	public $titulo_planilla;

	/*=============================================
	EDITAR TITULO (PLANILLA)
	=============================================*/

	public function ajaxEditarTituloPlanilla() {

		$datos = array("titulo_planilla" 		=> trim($this->titulo_planilla),
						       "id_planilla" 				=> $this->id_planilla,
		);	

		$respuesta = ControladorPlanillas::ctrEditarTitulo($datos);

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
	$planillas -> ajaxMostrarPlanilla();

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

if (isset($_POST["editarTitulo"])) {

	$nuevoPlanilla = new AjaxPlanillas();

	if (isset($_POST["titulo_relacion"])) {

		$nuevoPlanilla -> titulo_relacion = $_POST["titulo_relacion"];
		$nuevoPlanilla -> id_planilla = $_POST["id_planilla"];
		$nuevoPlanilla -> ajaxEditarTituloRelacion();
	
	} else {

		$nuevoPlanilla -> titulo_planilla = $_POST["titulo_planilla"];
		$nuevoPlanilla -> id_planilla = $_POST["id_planilla"];
		$nuevoPlanilla -> ajaxEditarTituloPlanilla();

	}

}

/*=============================================
ELIMINAR EL PDF TEMPORAL DE REPORTE GENERADO
=============================================*/

if (isset($_POST["eliminarPDF"])) {

	$reportesCovid = new AjaxPlanillas();
	$reportesCovid -> file = $_POST["url"];
	$reportesCovid -> ajaxEliminarReportePDF();

}

