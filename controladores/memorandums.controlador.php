<?php

class ControladorMemorandums {

	/*=============================================
	MOSTRAR MEMORANDUMS
	=============================================*/
	
	static public function ctrMostrarMemorandums($item, $valor) {

		$tabla = "memorandums";

		$respuesta = ModeloMemorandums::mdlMostrarMemorandums($tabla, $item, $valor);

		return $respuesta;

	}

	/*=============================================
	MOSTRAR MEMORANDUMS PARA BUSCADOR
	=============================================*/
	
	static public function ctrBuscadorMemorandums($item, $valor) {

		$tabla = "memorandums";

		$respuesta = ModeloMemorandums::mdlBuscadorMemorandums($tabla, $item, $valor);

		return $respuesta;

	}

}