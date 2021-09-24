<?php

class ControladorPlanillas {

	/*=============================================
	LISTADO DE RELACION DE NOVEDADES
	=============================================*/
	
	static public function ctrMostrarRelacion($item, $valor1, $valor2) {

		$tabla = "planillas";

		$respuesta = ModeloPlanillas::mdlMostrarRelacion($tabla, $item, $valor1, $valor2);

		return $respuesta;

	}

	/*=============================================
	CREAR NUEVO ELACION DE NOVEDADES
	=============================================*/
	
	static public function ctrNuevoRelacion($datos) {
		
		$tabla = "planillas";

		$respuesta = ModeloPlanillas::mdlNuevoRelacion($tabla, $datos);

		return $respuesta;

	}


	/*=============================================
	EDITAR RELACION DE NOVEDADES
	=============================================*/
	
	static public function ctrEditarRelacion($datos) {
		
		$tabla = "planillas";

		$respuesta = ModeloPlanillas::mdlEditarRelacion($tabla, $datos);

		return $respuesta;

	}

	/*=============================================
	ELIMINAR RELACION
	=============================================*/

	static public function ctrEliminarRelacion()	{

		
	}

	/*=============================================
	LISTADO DE DATOS DE GENERAR RELACION DE NOVEDADES
	=============================================*/
	
	static public function ctrMostrarGenerarRelacion($item, $valor1, $valor2) {

		$tabla = "planillas";

		$respuesta = ModeloPlanillas::mdlMostrarGenerarRelacion($item, $valor1, $valor2);

		return $respuesta;

	}

	/*=============================================
	LISTADO DE PLANILLAS
	=============================================*/
	
	static public function ctrMostrarPlanillas($item, $valor1, $valor2) {

		$tabla = "planillas";

		$respuesta = ModeloPlanillas::mdlMostrarPlanillas($tabla, $item, $valor1, $valor2);

		return $respuesta;

	}

	/*=============================================
	LISTADO DE DATOS DE GENERAR PLANILLA DE SUELDOS Y SALARIOS
	=============================================*/
	
	static public function ctrMostrarGenerarPlanilla($item, $valor1, $valor2) {

		$tabla = "planillas";

		$respuesta = ModeloPlanillas::mdlMostrarGenerarPlanilla($item, $valor1, $valor2);

		return $respuesta;

	}

}

