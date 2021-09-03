<?php

class ControladorSuplencias {

	/*=============================================
	MOSTRAR SUPLENCIAS
	=============================================*/
	
	static public function ctrMostrarSuplencias($item, $valor) {

		$tabla = "suplencias";

		$respuesta = ModeloSuplencias::mdlMostrarSuplencias($tabla, $item, $valor);

		return $respuesta;

	}

	/*=============================================
	MOSTRAR SUPLENCIAS PARA BUSCADOR
	=============================================*/
	
	static public function ctrBuscadorSuplencias($item, $valor) {

		$tabla = "suplencias";

		$respuesta = ModeloSuplencias::mdlBuscadorSuplencias($tabla, $item, $valor);

		return $respuesta;

	}

}