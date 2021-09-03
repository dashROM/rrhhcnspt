<?php

class ControladorEmpleados {

	/*=============================================
	LISTADO DE EMPLEADOS
	=============================================*/
	
	static public function ctrMostrarEmpleados($item, $valor1, $valor2) {

		$tabla = "empleados";

		$respuesta = ModeloEmpleados::mdlMostrarEmpleados($tabla, $item, $valor1, $valor2);

		return $respuesta;

	}

	/*=============================================
	LISTADO DE EMPLEADOS
	=============================================*/

	static public function ctrMostrarPersonaEmpleado($item, $valor1, $valor2) {

		$tabla = "empleados";
		$respuesta = ModeloEmpleados::mdlMostrarPersonaEmpleado($tabla, $item, $valor1, $valor2);

		return $respuesta;

	}

	/*=============================================
	CREAR NUEVO EMPLEADO
	=============================================*/
	
	static public function ctrNuevoEmpleado($datos) {
		
		$tabla = "empleados";

		$respuesta = ModeloEmpleados::mdlNuevoEmpleado($tabla, $datos);

		return $respuesta;

	}


	/*=============================================
	EDITAR EMPLEADO
	=============================================*/
	
	static public function ctrEditarEmpleado($datos) {
		
		$tabla = "empleados";

		$respuesta = ModeloEmpleados::mdlEditarEmpleado($tabla, $datos);

		return $respuesta;

	}

	/*=============================================
	ELIMINAR EMPLEADO
	=============================================*/

	static public function ctrEliminarEmpleado()	{

		
	}

}

