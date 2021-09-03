<?php

require_once "conexion.db.php";

class ModeloSuplencias {

	/*=============================================
	MOSTRAR SUPLENCIAS
	=============================================*/
	
	static public function mdlMostrarSuplencias($tabla, $item, $valor) {

		if ($item != null) {

			// devuelve los campos que coincidan con el valor del item

			$stmt = Conexion::conectarPG()->prepare("SELECT * FROM $tabla WHERE $item = :$item");

			$stmt->bindParam(":".$item, $valor, PDO::PARAM_INT);

			$stmt->execute();

			return $stmt->fetch();

		} else {

			// devuelve todos los datos de la tabla

			$stmt = Conexion::conectarPG()->prepare("SELECT * FROM $tabla ORDER BY id_suplencia ASC");

			$stmt->execute();

			return $stmt->fetchAll();

		}

		$stmt->close();
		$stmt = null;

	}

	/*=============================================
	MOSTRAR BUSCADOR Suplencias
	=============================================*/
	
	static public function mdlBuscadorSuplencias($tabla, $item, $valor) {

		$stmt = Conexion::conectarPG()->prepare("SELECT * FROM $tabla WHERE $item <> :$item AND $item <> 5");

		$stmt->bindParam(":".$item, $valor, PDO::PARAM_INT);

		$stmt->execute();

		return $stmt->fetchAll();

		$stmt->close();
		$stmt = null;

	}

}