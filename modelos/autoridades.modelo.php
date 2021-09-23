<?php

require_once "conexion.db.php";

class ModeloAutoridades {

	/*=============================================
	MOSTRAR ADMINISTRADOR REGIONAL
	=============================================*/
	
	static public function mdlMostrarAutoridades($tabla, $item, $valor) {
		
		// devuelve los campos que coincidan con el valor del item

		$stmt = Conexion::conectarPG()->prepare("SELECT * FROM $tabla WHERE $item = :$item");

		$stmt->bindParam(":".$item, $valor, PDO::PARAM_STR);

		$stmt->execute();

		return $stmt->fetch();

		$stmt->close();
		$stmt = null;

	}

}