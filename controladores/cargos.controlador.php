<?php

class ControladorCargos {

	/*=============================================
	MOSTRAR CARGOS
	=============================================*/
	
	static public function ctrMostrarCargos($item, $valor) {

		$tabla = "cargos";

		$respuesta = ModeloCargos::mdlMostrarCargos($tabla, $item, $valor);

		return $respuesta;

	}

	/*=============================================
	MOSTRAR CARGOS PARA BUSCADOR
	=============================================*/
	
	static public function ctrBuscadorcargos($item, $valor) {

		$tabla = "cargos";

		$respuesta = ModeloCargos::mdlBuscadorCargos($tabla, $item, $valor);

		return $respuesta;

	}

}