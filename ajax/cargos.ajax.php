<?php

require_once "../controladores/cargos.controlador.php";
require_once "../modelos/cargos.modelo.php";

class AjaxCargos {
	
	public $id_cargo;

	/*=============================================
	MOSTRAR DATOS CARGOS
	=============================================*/

	public function ajaxBuscadorCargos()	{

		$item = "id_cargo";
		$valor = $this->id_cargo;

		$respuesta = ControladorCargos::ctrBuscadorCargos($item, $valor);

		echo json_encode($respuesta);

	}	

}

/*=============================================
MOSTRAR CARGOS
=============================================*/

if (isset($_POST["buscadorCargos"])) {
	
	$cargos = new AjaxCargos();
	$cargos -> id_cargo = $_POST["id_cargo"];
	$cargos-> ajaxBuscadorCargos();

}