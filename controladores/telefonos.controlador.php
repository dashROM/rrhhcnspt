<?php

class ControladorTelefonos {

	/*=============================================
	LISTADO DE TELEFONOS
	=============================================*/
	
	static public function ctrMostrarTelefonos($item, $valor1, $valor2) {

		$tabla = "telefonos";

		$respuesta = ModeloTelefonos::mdlMostrarTelefonos($tabla, $item, $valor1, $valor2);

		return $respuesta;

	}

	/*=============================================
	CREAR NUEVO TELEFONO
	=============================================*/
	
	static public function ctrNuevoTelefono($datos) {
		
		$tabla = "telefonos";

		$respuesta = ModeloTelefonos::mdlNuevoTelefono($tabla, $datos);

		return $respuesta;

	}


	/*=============================================
	EDITAR TELEFONO
	=============================================*/
	
	static public function ctrEditarTelefono($datos) {
		
		$tabla = "telefonos";

		$respuesta = ModeloTelefonos::mdlEditarTelefono($tabla, $datos);

		return $respuesta;

	}

	/*=============================================
	ELIMINAR TELEFONO
	=============================================*/

	static public function ctrEliminarTelefono()	{

		
	}

}

