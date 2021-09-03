<?php

require_once "conexion.db.php";

class ModeloPersonas {
	
	/*=============================================
	MOSTRAR PERSONAS
	=============================================*/
	
	static public function mdlMostrarPersonas($tabla, $item, $valor1, $valor2) {

		if ($item != null) {
			
			$stmt = Conexion::conectarPG()->prepare("SELECT * FROM $tabla WHERE $item = :$item");

			$stmt->bindParam(":".$item, $valor1, PDO::PARAM_STR);

			$stmt->execute();

			return $stmt->fetch();

		} else {

			$stmt = Conexion::conectarPG()->prepare("SELECT id_persona, concat_ws(' ', paterno_persona, materno_persona, nombre_persona) AS nombre_completo, foto_persona, concat_ws(' ', ci_persona, ext_ci_persona) AS ci_persona, fecha_nacimiento, sexo_persona, direccion_persona, telefono_persona, email_persona, fecha_registro FROM $tabla");

			$stmt->execute();

			return $stmt->fetchAll();

		}

		$stmt->close();
		$stmt = null;

	}

	/*=============================================
	BUSCAR PERSONAS
	=============================================*/
	
	static public function mdlBuscarPersonas($tabla, $item1, $item2, $valor) {

		if ($item2 != null) {
			
			$stmt = Conexion::conectarPG()->prepare("SELECT * FROM $tabla WHERE $item = :$item");

			$stmt->bindParam(":".$item, $valor1, PDO::PARAM_STR);

			$stmt->execute();

			return $stmt->fetch();

		} else {

			$stmt = Conexion::conectarPG()->prepare("SELECT id_persona, concat_ws(' ', paterno_persona, materno_persona, nombre_persona) AS nombre_completo, foto_persona, concat_ws(' ', ci_persona, ext_ci_persona) AS ci_persona, fecha_nacimiento, sexo_persona, direccion_persona, telefono_persona, email_persona, fecha_registro FROM $tabla");

			$stmt->execute();

			return $stmt->fetchAll();

		}

		$stmt->close();
		$stmt = null;

	}



	/*=============================================
	REGISTRO DE NUEVA PERSONA
	=============================================*/

	static public function mdlNuevoPersona($tabla, $datos) {

		$stmt = Conexion::conectarPG()->prepare("INSERT INTO $tabla(paterno_persona, materno_persona, nombre_persona, foto_persona, ci_persona, ext_ci_persona, fecha_nacimiento, sexo_persona, direccion_persona, telefono_persona, email_persona, fecha_registro) VALUES (:paterno_persona, :materno_persona, :nombre_persona, :foto_persona, :ci_persona, :ext_ci_persona, :fecha_nacimiento, :sexo_persona, :direccion_persona, :telefono_persona, :email_persona, current_timestamp)");

		$stmt->bindParam(":paterno_persona", $datos["paterno_persona"], PDO::PARAM_STR);
		$stmt->bindParam(":materno_persona", $datos["materno_persona"], PDO::PARAM_STR);
		$stmt->bindParam(":nombre_persona", $datos["nombre_persona"], PDO::PARAM_STR);
		$stmt->bindParam(":foto_persona", $datos["foto_persona"], PDO::PARAM_STR);
		$stmt->bindParam(":ci_persona", $datos["ci_persona"], PDO::PARAM_STR);
		$stmt->bindParam(":ext_ci_persona", $datos["ext_ci_persona"], PDO::PARAM_STR);
		$stmt->bindParam(":fecha_nacimiento", $datos["fecha_nacimiento"], PDO::PARAM_STR);
		$stmt->bindParam(":sexo_persona", $datos["sexo_persona"], PDO::PARAM_STR);
		$stmt->bindParam(":direccion_persona", $datos["direccion_persona"], PDO::PARAM_STR);
		$stmt->bindParam(":telefono_persona", $datos["telefono_persona"], PDO::PARAM_STR);
		$stmt->bindParam(":email_persona", $datos["email_persona"], PDO::PARAM_STR);

		if ($stmt->execute()) {
			
			return "ok";

		} else {
			
			return "error";

		}
		
		$stmt->close();
		$stmt = null;

	}

	/*=============================================
	EDITAR PERSONA
	=============================================*/

	static public function mdlEditarPersona($tabla, $datos) {

		$stmt = Conexion::conectarPG()->prepare("UPDATE $tabla SET paterno_persona = :paterno_persona, materno_persona = :materno_persona, nombre_persona = :nombre_persona, foto_persona = :foto_persona, ci_persona = :ci_persona, ext_ci_persona = :ext_ci_persona, fecha_nacimiento = :fecha_nacimiento, sexo_persona = :sexo_persona, direccion_persona = :direccion_persona, telefono_persona = :telefono_persona, email_persona = :email_persona WHERE id_persona = :id_persona");

		$stmt->bindParam(":paterno_persona", $datos["paterno_persona"], PDO::PARAM_STR);
		$stmt->bindParam(":materno_persona", $datos["materno_persona"], PDO::PARAM_STR);
		$stmt->bindParam(":nombre_persona", $datos["nombre_persona"], PDO::PARAM_STR);
		$stmt->bindParam(":foto_persona", $datos["foto_persona"], PDO::PARAM_STR);
		$stmt->bindParam(":ci_persona", $datos["ci_persona"], PDO::PARAM_STR);
		$stmt->bindParam(":ext_ci_persona", $datos["ext_ci_persona"], PDO::PARAM_STR);
		$stmt->bindParam(":fecha_nacimiento", $datos["fecha_nacimiento"], PDO::PARAM_STR);
		$stmt->bindParam(":sexo_persona", $datos["sexo_persona"], PDO::PARAM_STR);
		$stmt->bindParam(":direccion_persona", $datos["direccion_persona"], PDO::PARAM_STR);
		$stmt->bindParam(":telefono_persona", $datos["telefono_persona"], PDO::PARAM_STR);
		$stmt->bindParam(":email_persona", $datos["email_persona"], PDO::PARAM_STR);
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