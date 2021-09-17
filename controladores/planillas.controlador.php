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
	EDITAR ELACION DE NOVEDADES
	=============================================*/
	
	static public function ctrEditarRelacion($datos) {
		
		$tabla = "planillas";

		$respuesta = ModeloPlanillas::mdlEditarRelacion($tabla, $datos);

		return $respuesta;

	}

	/*=============================================
	ELIMINAR PLANILLA
	=============================================*/

	static public function ctrEliminarPlanilla()	{

		
	}

	/*=============================================
	LISTADO DE PLANILLAS
	=============================================*/
	
	static public function ctrMostrarPlanillas($item, $valor1, $valor2) {

		$tabla = "planillas_tbl";

		$respuesta = ModeloPlanillas::mdlMostrarPlanillas($tabla, $item, $valor1, $valor2);

		return $respuesta;

	}

	/*=============================================
	LISTADO DE DATOS DE PLANILLA GENERADA 
	=============================================*/
	
	static public function ctrMostrarGenerarPlanilla($item, $valor1, $valor2) {

		$respuesta = ModeloPlanillas::mdlMostrarGenerarPlanilla($item, $valor1, $valor2);

		return $respuesta;

	}

}

