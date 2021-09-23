<?php

class ControladorAutoridades {

	/*=============================================
	MOSTRAR AUTORIDADES
	=============================================*/
	
	static public function ctrMostrarAutoridades($item, $valor) {

		$tabla = "autoridades";

		$respuesta = ModeloAutoridades::mdlMostrarAutoridades($tabla, $item, $valor);

		return $respuesta;

	}

	/*=============================================
	MOSTRAR JEFE DE RECURSOS HUMANOS PARA BUSCADOR
	=============================================*/
	
	static public function ctrMostrarJefeRRHH($item, $valor) {

		$tabla = "autoridades";

		$respuesta = ModeloAutoridades::mdlMostrarAdministradorJefeRRHH($tabla, $item, $valor);

		return $respuesta;

	}

}