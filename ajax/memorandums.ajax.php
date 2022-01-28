<?php

require_once "../controladores/memorandums.controlador.php";
require_once "../modelos/memorandums.modelo.php";

class AjaxMemorandums {
	
	public $id_memorandum;

	/*=============================================
	MOSTRAR DATOS MEMORANDUMS INSTRUCTIVO
	=============================================*/

	public function buscadorMemorandums()	{

		$item = "id_memorandum";
		$valor = $this->id_memorandum;

		$respuesta = ControladorMemorandums::ctrBuscadorMemorandums($item, $valor);

		echo json_encode($respuesta);

	}	

}

/*=============================================
MOSTRAR MEMORANDUMS INSTRUCTIVO
=============================================*/

if (isset($_POST["buscadorMemorandums"])) {
	
	$memorandums = new AjaxMemorandums();
	$memorandums -> id_memorandum = $_POST["id_memorandum"];
	// var_dump($_POST["id_memorandum"]);
	$memorandums-> buscadorMemorandums();

}