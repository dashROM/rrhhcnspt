<?php

require_once "conexion.db.php";

class ModeloLugares {

	/*=============================================
	MOSTRAR LUGARES
	=============================================*/
	
	static public function mdlMostrarLugares($tabla, $item, $valor) {

		if ($item != null) {

			// devuelve los campos que coincidan con el valor del item

			$stmt = Conexion::conectarPG()->prepare("SELECT * FROM $tabla WHERE $item = :$item");

			$stmt->bindParam(":".$item, $valor, PDO::PARAM_STR);

			$stmt->execute();

			return $stmt->fetch();

		} else {

			// devuelve todos los datos de la tabla

			$stmt = Conexion::conectarPG()->prepare("SELECT * FROM $tabla ORDER BY id_lugar");

			$stmt->execute();

			return $stmt->fetchAll();

		}

		$stmt->close();
		$stmt = null;

	}

	/*=============================================
	MOSTRAR BUSCADOR LUGARES
	=============================================*/
	
	static public function mdlBuscadorLugares($tabla, $item, $valor) {

		$stmt = Conexion::conectarPG()->prepare("SELECT * FROM $tabla WHERE $item <> :$item");

		$stmt->bindParam(":".$item, $valor, PDO::PARAM_INT);

		$stmt->execute();

		return $stmt->fetchAll();

		$stmt->close();
		$stmt = null;

	}

}