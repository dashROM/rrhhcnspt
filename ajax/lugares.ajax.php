<?php

require_once "../controladores/lugares.controlador.php";
require_once "../modelos/lugares.modelo.php";

class AjaxLugares {
	
	public $id_lugar;

	/*=============================================
	MOSTRAR DATOS LUGARES
	=============================================*/

	public function ajaxBuscadorLugares()	{

		$item = "id_lugar";
		$valor = $this->id_lugar;

		$respuesta = ControladorLugares::ctrBuscadorLugares($item, $valor);

		echo json_encode($respuesta);

	}	

}

/*=============================================
MOSTRAR Lugares
=============================================*/

if (isset($_POST["buscadorLugares"])) {
	
	$lugares = new AjaxLugares();
	$lugares -> id_lugar = $_POST["id_lugar"];
	$lugares -> ajaxBuscadorLugares();

}