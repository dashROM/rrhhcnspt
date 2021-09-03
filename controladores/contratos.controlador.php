<?php

class ControladorContratos {

	/*=============================================
	MOSTRAR CONTRATOS
	=============================================*/
	
	static public function ctrMostrarContratos($item, $valor) {

		$tabla = "contratos";

		$respuesta = ModeloContratos::mdlMostrarContratos($tabla, $item, $valor);

		return $respuesta;

	}

	/*=============================================
	MOSTRAR CONTRATOS PARA BUSCADOR
	=============================================*/
	
	static public function ctrBuscadorContratos($item, $valor) {

		$tabla = "contratos";

		$respuesta = ModeloContratos::mdlBuscadorContratos($tabla, $item, $valor);

		return $respuesta;

	}

}