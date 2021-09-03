<?php

class ControladorPlanillas {

	/*=============================================
	LISTADO DE PLANILLAS
	=============================================*/
	
	static public function ctrMostrarPlanillas($item, $valor1, $valor2) {

		$tabla = "planillas_tbl";

		$respuesta = ModeloPlanillas::mdlMostrarPlanillas($tabla, $item, $valor1, $valor2);

		return $respuesta;

	}

	/*=============================================
	CREAR NUEVO PLANILLA
	=============================================*/
	
	static public function ctrNuevoPlanilla($datos) {
		
		$tabla = "planillas_tbl";

		$respuesta = ModeloPlanillas::mdlNuevoPlanilla($tabla, $datos);

		return $respuesta;

	}


	/*=============================================
	EDITAR PLANILLA
	=============================================*/
	
	static public function ctrEditarPlanilla($datos) {
		
		$tabla = "planillas_tbl";

		$respuesta = ModeloPlanillas::mdlEditarPlanilla($tabla, $datos);

		return $respuesta;

	}

	/*=============================================
	ELIMINAR PLANILLA
	=============================================*/

	static public function ctrEliminarPlanilla()	{

		
	}

	/*=============================================
	LISTADO DE DATOS DE PLANILLA GENERADA 
	=============================================*/
	
	static public function ctrMostrarGenerarPlanilla($item, $valor1, $valor2) {

		$respuesta = ModeloPlanillas::mdlMostrarGenerarPlanilla($item, $valor1, $valor2);

		return $respuesta;

	}

}

