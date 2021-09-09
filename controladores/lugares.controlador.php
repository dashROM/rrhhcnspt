<?php

class ControladorLugares {

	/*=============================================
	MOSTRAR LUGARES
	=============================================*/
	
	static public function ctrMostrarLugares($item, $valor) {

		$tabla = "lugares";

		$respuesta = ModeloLugares::mdlMostrarLugares($tabla, $item, $valor);

		return $respuesta;

	}

	/*=============================================
	MOSTRAR LUGARES PARA BUSCADOR
	=============================================*/
	
	static public function ctrBuscadorLugares($item, $valor) {

		$tabla = "lugares";

		$respuesta = ModeloLugares::mdlBuscadorLugares($tabla, $item, $valor);

		return $respuesta;

	}

}