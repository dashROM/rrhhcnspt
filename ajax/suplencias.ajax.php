<?php

require_once "../controladores/suplencias.controlador.php";
require_once "../modelos/suplencias.modelo.php";

class AjaxSuplencias {
	
	public $id_suplencia;

	/*=============================================
	MOSTRAR DATOS SUPLENCIA
	=============================================*/

	public function buscadorTipoSuplencias()	{

		$item = "id_suplencia";
		$valor = $this->id_suplencia;

		$respuesta = ControladorSuplencias::ctrBuscadorSuplencias($item, $valor);

		echo json_encode($respuesta);

	}	

}

/*=============================================
MOSTRAR SUPLENCIAS
=============================================*/

if (isset($_POST["buscadorTipoSuplencias"])) {
	
	$suplencias = new AjaxSuplencias();
	$suplencias -> id_suplencia = $_POST["id_suplencia"];
	$suplencias-> buscadorTipoSuplencias();

}