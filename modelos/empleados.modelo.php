<?php

require_once "conexion.db.php";

class ModeloEmpleados {

	/*=============================================
	MOSTRAR EMPLEADOS
	=============================================*/
	
	static public function mdlMostrarEmpleados($tabla, $item, $valor1, $valor2) {

		if ($item != null) {
			
			if ($valor2 != null) {

				//muestra datos de un empleado en especifico
				$stmt = Conexion::conectarPG()->prepare("SELECT * FROM $tabla WHERE $item = :$item AND id_empleado != :id_empleado");

				$stmt->bindParam(":".$item, $valor1, PDO::PARAM_STR);
				$stmt->bindParam(":id_empleado", $valor2, PDO::PARAM_INT);

			} else {

				//muestra varios datos de un empleado en especifico
				$sql = "SELECT emp.id_empleado, est.id_Establecimiento, est.nombre_establecimiento, concat_ws(' ', pe.paterno_persona, pe.materno_persona, pe.nombre_persona) AS nombre_completo, concat_ws(' ', pe.ci_persona, pe.ext_ci_persona) AS ci_persona, pe.fecha_nacimiento, ca.id_cargo, ca.nombre_cargo, emp.fecha_inicio_contrato, emp.dias_contrato, emp.fecha_fin_contrato, co.id_contrato, co.nombre_contrato, emp.estado_empleado, emp.observaciones, pe.id_persona FROM empleados emp, personas pe, establecimientos est, cargos ca, contratos co WHERE pe.id_persona = emp.id_persona AND est.id_establecimiento = emp.id_establecimiento AND ca.id_cargo = emp.id_cargo AND co.id_contrato = emp.id_contrato AND $item = :$item";

				$stmt = Conexion::conectarPG()->prepare($sql);

				$stmt->bindParam(":".$item, $valor1, PDO::PARAM_STR);

			}			

			$stmt->execute();

			return $stmt->fetch();

		} else {

			//muestra varios datos de todos los empleados
			$sql = "SELECT emp.id_empleado, est.nombre_establecimiento, concat_ws(' ', pe.paterno_persona, pe.materno_persona, pe.nombre_persona) AS nombre_completo, concat_ws(' ', pe.ci_persona, pe.ext_ci_persona) AS ci_persona, pe.fecha_nacimiento, ca.nombre_cargo, emp.fecha_inicio_contrato, emp.dias_contrato, emp.fecha_fin_contrato, co.nombre_contrato, emp.estado_empleado, emp.observaciones, pe.id_persona FROM empleados emp, personas pe, establecimientos est, cargos ca, contratos co WHERE pe.id_persona = emp.id_persona AND est.id_establecimiento = emp.id_establecimiento AND ca.id_cargo = emp.id_cargo AND co.id_contrato = emp.id_contrato ORDER BY emp.id_empleado DESC";

			$stmt = Conexion::conectarPG()->prepare($sql);

			$stmt->execute();

			return $stmt->fetchAll();

		}

		$stmt->close();
		$stmt = null;

	}

	/*=============================================
	MOSTRAR EMPLEADOS
	=============================================*/
	
	static public function mdlMostrarPersonaEmpleado($tabla, $item, $valor1, $valor2) {
	
		if ($valor2 != null) {


			$stmt = Conexion::conectarPG()->prepare("SELECT * FROM $tabla WHERE $item = :$item AND id_empleado != :id_empleado");

			$stmt->bindParam(":".$item, $valor1, PDO::PARAM_STR);
			$stmt->bindParam(":id_empleado", $valor2, PDO::PARAM_INT);

		} else {

			$sql = "SELECT emp.id_empleado, pe.id_persona FROM empleados emp, personas pe WHERE pe.id_persona = emp.id_persona AND emp.$item = :$item";

			$stmt = Conexion::conectarPG()->prepare($sql);

			$stmt->bindParam(":".$item, $valor1, PDO::PARAM_STR);

		}			

		$stmt->execute();
		return $stmt->fetch();

		$stmt->close();
		$stmt = null;

	}
	
	/*=============================================
	CREAR NUEVO EMPLEADO
	=============================================*/
	
	static public function mdlNuevoEmpleado($tabla, $datos){

		$stmt = Conexion::conectarPG()->prepare("INSERT INTO $tabla(id_establecimiento, id_persona, id_cargo, fecha_inicio_contrato, dias_contrato, fecha_fin_contrato, id_contrato, estado_empleado, observaciones) VALUES (:id_establecimiento, :id_persona, :id_cargo, :fecha_inicio_contrato, :dias_contrato, :fecha_fin_contrato, :id_contrato, :estado_empleado, :observaciones)");

		$stmt->bindParam(":id_establecimiento", $datos["id_establecimiento"], PDO::PARAM_INT);
		$stmt->bindParam(":id_persona", $datos["id_persona"], PDO::PARAM_INT);
		$stmt->bindParam(":id_cargo", $datos["id_cargo"], PDO::PARAM_INT);
		$stmt->bindParam(":fecha_inicio_contrato", $datos["fecha_inicio_contrato"], PDO::PARAM_STR);
		$stmt->bindParam(":dias_contrato", $datos["dias_contrato"], PDO::PARAM_INT);
		$stmt->bindParam(":fecha_fin_contrato", $datos["fecha_fin_contrato"], PDO::PARAM_STR);
		$stmt->bindParam(":id_contrato", $datos["id_contrato"], PDO::PARAM_INT);
		$stmt->bindParam(":estado_empleado", $datos["estado_empleado"], PDO::PARAM_INT);
		$stmt->bindParam(":observaciones", $datos["observaciones"], PDO::PARAM_STR);

		if($stmt->execute()){

			return "ok";

		} else{

			return "error";
		
		}

		$stmt->close();
		$stmt = null;

	}

	/*=============================================
	EDITAR EMPLEADO
	=============================================*/
	
	static public function mdlEditarEmpleado($tabla, $datos){

		$stmt = Conexion::conectarPG()->prepare("UPDATE $tabla SET id_establecimiento = :id_establecimiento, id_persona = :id_persona, id_cargo = :id_cargo, fecha_inicio_contrato = :fecha_inicio_contrato, dias_contrato = :dias_contrato, fecha_fin_contrato = :fecha_fin_contrato, id_contrato = :id_contrato, observaciones = :observaciones  WHERE id_empleado = :id_empleado");

		$stmt->bindParam(":id_empleado", $datos["id_empleado"], PDO::PARAM_INT);
		$stmt->bindParam(":id_establecimiento", $datos["id_establecimiento"], PDO::PARAM_INT);
		$stmt->bindParam(":id_persona", $datos["id_persona"], PDO::PARAM_INT);
		$stmt->bindParam(":id_cargo", $datos["id_cargo"], PDO::PARAM_INT);
		$stmt->bindParam(":fecha_inicio_contrato", $datos["fecha_inicio_contrato"], PDO::PARAM_STR);
		$stmt->bindParam(":dias_contrato", $datos["dias_contrato"], PDO::PARAM_INT);
		$stmt->bindParam(":fecha_fin_contrato", $datos["fecha_fin_contrato"], PDO::PARAM_STR);
		$stmt->bindParam(":id_contrato", $datos["id_contrato"], PDO::PARAM_INT);
		$stmt->bindParam(":observaciones", $datos["observaciones"], PDO::PARAM_STR);

		if($stmt->execute()){

			return "ok";

		}else{

			return "error";
		
		}

		$stmt->close();
		$stmt = null;

	}

	/*=============================================
	ELIMINAR CLIENTE
	=============================================*/

	static public function mdlEliminarEmpleado($tabla, $datos) {
		
		$stmt = Conexion::conectarPG()->prepare("DELETE FROM $tabla WHERE idcliente = :idcliente");

		$stmt->bindParam(":idcliente", $datos, PDO::PARAM_INT);

		
		if($stmt->execute()){

			return "ok";

		}else{

			return "error";
		
		}

		$stmt->close();
		$stmt = null;

	}

	/*=============================================
	ACTIVAR EMPLEADO
	=============================================*/

	static public function mdlActivarEmpleado($tabla, $item1, $valor1, $item2, $valor2) {

		$stmt = Conexion::conectarPG()->prepare("UPDATE $tabla SET $item1 = :$item1 WHERE $item2 = :$item2");

		$stmt->bindParam(":".$item1, $valor1, PDO::PARAM_STR);
		$stmt->bindParam(":".$item2, $valor2, PDO::PARAM_STR);

		if ($stmt->execute()) {
			
			return "ok";

		} else {
			
			return "error";

		}
		
		$stmt->close();
		$stmt = null;

	}	
	
}

