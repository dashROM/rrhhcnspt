<?php

class ControladorEstablecimientos {

	/*=============================================
	MOSTRAR ESTABLECIMIENTOS
	=============================================*/
	
	static public function ctrMostrarEstablecimientos($item, $valor) {

		$tabla = "establecimientos";

		$respuesta = ModeloEstablecimientos::mdlMostrarEstablecimientos($tabla, $item, $valor);

		return $respuesta;

	}

	/*=============================================
	MOSTRAR ESTABLECIMIENTOS PARA BUSCADOR
	=============================================*/
	
	static public function ctrBuscadorEstablecimientos($item, $valor) {

		$tabla = "establecimientos";

		$respuesta = ModeloEstablecimientos::mdlBuscadorEstablecimientos($tabla, $item, $valor);

		return $respuesta;

	}

}