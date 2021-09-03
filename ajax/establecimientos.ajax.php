<?php

require_once "../controladores/establecimientos.controlador.php";
require_once "../modelos/establecimientos.modelo.php";

class AjaxEstablecimientos {
	
	public $id_establecimiento;

	/*=============================================
	MOSTRAR DATOS EMPLEADO
	=============================================*/

	public function ajaxBuscadorEstablecimientos()	{

		$item = "id_establecimiento";
		$valor = $this->id_establecimiento;

		$respuesta = ControladorEstablecimientos::ctrBuscadorEstablecimientos($item, $valor);

		echo json_encode($respuesta);

	}	

}

/*=============================================
MOSTRAR ESTABLECIMIENTOS
=============================================*/

if (isset($_POST["buscadorEstablecimientos"])) {
	
	$establecimientos = new AjaxEstablecimientos();
	$establecimientos -> id_establecimiento = $_POST["id_establecimiento"];
	$establecimientos -> ajaxBuscadorEstablecimientos();

}