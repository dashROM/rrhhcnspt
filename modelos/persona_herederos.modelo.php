<?php

require_once "conexion.db.php";

class ModeloPersonaHerederos {
	
	/*=============================================
	MOSTRAR PERSONA HEREDEROS
	=============================================*/
	
	static public function mdlMostrarPersonaHerederos($tabla, $item, $valor1, $valor2) {

		if ($item != null) {

			if ($valor2 != null) {

				$stmt = Conexion::conectarPG()->prepare("SELECT * FROM $tabla WHERE $item = :$item");

				$stmt->bindParam(":".$item, $valor1, PDO::PARAM_INT);

				$stmt->execute();

				return $stmt->fetch();

			} else {

				$stmt = Conexion::conectarPG()->prepare("SELECT id_persona_heredero, concat_ws(' ', nombre_heredero, paterno_heredero, materno_heredero) AS nombre_completo, fecha_nacimiento, parentezco, id_persona FROM $tabla WHERE $item = :$item");

				$stmt->bindParam(":".$item, $valor1, PDO::PARAM_INT);

				$stmt->execute();

				return $stmt->fetchAll();

			}

		} else {

			$stmt = Conexion::conectarPG()->prepare("SELECT id_persona_heredero, concat_ws(' ', nombre_heredero, paterno_heredero, materno_heredero) AS nombre_completo, fecha_nacimiento, parentezco, id_persona FROM $tabla ORDER BY id_persona_heredero DESC");

			$stmt->execute();

			return $stmt->fetchAll();

		}

		$stmt->close();
		$stmt = null;

	}

	/*=============================================
	REGISTRO DE NUEVA PERSONA HEREDERO
	=============================================*/

	static public function mdlNuevoPersonaHeredero($tabla, $datos) {

		$stmt = Conexion::conectarPG()->prepare("INSERT INTO $tabla(paterno_heredero, materno_heredero, nombre_heredero, fecha_nacimiento, parentezco, id_persona) VALUES (:paterno_heredero, :materno_heredero, :nombre_heredero, :fecha_nacimiento, :parentezco, :id_persona)");

		$stmt->bindParam(":paterno_heredero", $datos["paterno_heredero"], PDO::PARAM_STR);
		$stmt->bindParam(":materno_heredero", $datos["materno_heredero"], PDO::PARAM_STR);
		$stmt->bindParam(":nombre_heredero", $datos["nombre_heredero"], PDO::PARAM_STR);
		$stmt->bindParam(":fecha_nacimiento", $datos["fecha_nacimiento"], PDO::PARAM_STR);
		$stmt->bindParam(":parentezco", $datos["parentezco"], PDO::PARAM_STR);
		$stmt->bindParam(":id_persona", $datos["id_persona"], PDO::PARAM_INT);

		if ($stmt->execute()) {
			
			return "ok";

		} else {
			
			return "error";

		}
		
		$stmt->close();
		$stmt = null;

	}

	/*=============================================
	EDITAR PERSONA HEREDERO
	=============================================*/

	static public function mdlEditarPersonaHeredero($tabla, $datos) {

		$stmt = Conexion::conectarPG()->prepare("UPDATE $tabla SET paterno_heredero = :paterno_heredero, materno_heredero = :materno_heredero, nombre_heredero = :nombre_heredero, fecha_nacimiento = :fecha_nacimiento, parentezco = :parentezco WHERE id_persona_heredero = :id_persona_heredero");

		$stmt->bindParam(":paterno_heredero", $datos["paterno_heredero"], PDO::PARAM_STR);
		$stmt->bindParam(":materno_heredero", $datos["materno_heredero"], PDO::PARAM_STR);
		$stmt->bindParam(":nombre_heredero", $datos["nombre_heredero"], PDO::PARAM_STR);
		$stmt->bindParam(":fecha_nacimiento", $datos["fecha_nacimiento"], PDO::PARAM_STR);
		$stmt->bindParam(":parentezco", $datos["parentezco"], PDO::PARAM_STR);
		$stmt->bindParam(":id_persona_heredero", $datos["id_persona_heredero"], PDO::PARAM_INT);

		if ($stmt->execute()) {
			
			return "ok";

		} else {
			
			return "error";

		}
		
		$stmt->close();
		$stmt = null;

	}

	/*=============================================
	ACTUALIZAR PERSONA
	=============================================*/

	static public function mdlActualizarPersona($tabla, $item1, $valor1, $item2, $valor2) {

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

	/*=============================================
	BORRAR PERSONA
	=============================================*/

	static public function mdlBorrarPersona($tabla, $datos)	{
		
		$stmt = Conexion::conectarPG()->prepare("DELETE FROM $tabla WHERE id_persona = :id_persona");

		$stmt->bindParam(":id_persona", $datos, PDO::PARAM_INT);

		if ($stmt->execute()) {
			
			return "ok";

		} else {
			
			return "error";

		}
		
		$stmt->close();
		$stmt = null;

	}

}