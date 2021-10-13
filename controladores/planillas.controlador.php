<?php

class ControladorPlanillas {

	/*=============================================
	LISTADO DE RELACION DE NOVEDADES/PLANILLAS
	=============================================*/

	static public function ctrMostrarPlanilla($item, $valor1, $valor2) {

		$tabla = "planillas";

		$respuesta = ModeloPlanillas::mdlMostrarPlanilla($tabla, $item, $valor1, $valor2);

		return $respuesta;

	}

	/*=============================================
	CREAR NUEVO RELACION DE NOVEDADES
	=============================================*/
	
	static public function ctrNuevoRelacion($datos) {
		
		$tabla = "planillas";

		$respuesta = ModeloPlanillas::mdlNuevoRelacion($tabla, $datos);

		return $respuesta;

	}


	/*=============================================
	EDITAR RELACION DE NOVEDADES
	=============================================*/
	
	static public function ctrEditarTitulo($datos) {
		
		$tabla = "planillas";

		$respuesta = ModeloPlanillas::mdlEditarTitulo($tabla, $datos);

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
	LISTADO DE DATOS DE GENERAR PLANILLA DE SUELDOS Y SALARIOS
	=============================================*/
	
	static public function ctrMostrarGenerarPlanilla($item, $valor1, $valor2) {

		$tabla = "planillas";

		$respuesta = ModeloPlanillas::mdlMostrarGenerarPlanilla($item, $valor1, $valor2);

		return $respuesta;

	}

}

