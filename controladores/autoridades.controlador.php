<?php

class ControladorAutoridades {

	/*=============================================
	MOSTRAR ADMINISTRADOR REGIONAL
	=============================================*/
	
	static public function ctrMostrarAdministradorRegional($item, $valor) {

		$tabla = "autoridades";

		$respuesta = ModeloAutoridades::mdlMostrarAdministradorRegional($tabla, $item, $valor);

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