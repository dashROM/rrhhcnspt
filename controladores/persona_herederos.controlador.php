<?php

class ControladorPersonaHerederos {

	/*=============================================
	LISTADO DE PERSONAS HEREDEROS
	=============================================*/

	static public function ctrMostrarPersonaHerederos($item, $valor1, $valor2) {

		$tabla = "persona_herederos";
		$respuesta = ModeloPersonaHerederos::mdlMostrarPersonaHerederos($tabla, $item, $valor1, $valor2);

		return $respuesta;

	}

	/*=============================================
	CREAR NUEVO PERSONA HEREDERO
	=============================================*/
	
	static public function ctrNuevoPersonaHeredero($datos) {
		
		$tabla = "persona_herederos";

		$respuesta = ModeloPersonaHerederos::mdlNuevoPersonaHeredero($tabla, $datos);

		return $respuesta;

	}

	/*=============================================
	EDITAR PERSONA HEREDERO
	=============================================*/
	
	static public function ctrEditarPersonaHeredero($datos) {
		
		$tabla = "persona_herederos";

		$respuesta = ModeloPersonaHerederos::mdlEditarPersonaHeredero($tabla, $datos);

		return $respuesta;

	}

	/*=============================================
	ELIMINAR PERSONA HEREDERO
	=============================================*/

	static public function ctrEliminarPersonaHeredero()	{

		
	}

}