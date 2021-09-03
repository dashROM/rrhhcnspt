<?php

require_once "../controladores/contratos.controlador.php";
require_once "../modelos/contratos.modelo.php";

class AjaxContratos {
	
	public $id_contrato;

	/*=============================================
	MOSTRAR DATOS CONTRATOS
	=============================================*/

	public function ajaxBuscadorContratos()	{

		$item = "id_contrato";
		$valor = $this->id_contrato;

		$respuesta = ControladorContratos::ctrBuscadorContratos($item, $valor);

		echo json_encode($respuesta);

	}	

}

/*=============================================
MOSTRAR CONTRATOS
=============================================*/

if (isset($_POST["buscadorContratos"])) {
	
	$contratos = new AjaxContratos();
	$contratos -> id_contrato = $_POST["id_contrato"];
	$contratos-> ajaxBuscadorContratos();

}