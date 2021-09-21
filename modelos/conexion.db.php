<?php

class Conexion {
	
	// trabajo
	static public function conectar() {
		
		// $link = new PDO("mysql:host=localhost;dbname=bdrrhhcnspt",
		// 								"root","3000REIVAJinf1976");

		// $link->exec("set names utf8");

		// return $link;

		try{

			$host="localhost";
			$user="root";
			$pass="3000REIVAJinf1976";
			$dbname="bdrrhhcnspt";
		
			$conn = new PDO('mysql:host=$host;dbname=$dbname', $user, $pass);

			$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

			return $conn;

		} catch(PDOException $e){

			echo "ERROR: " . $e->getMessage();

		}

	}

	// hogar
	// static public function conectar() {
		
	// 	$link = new PDO("mysql:host=localhost;dbname=bdrrhhcnspt",
	// 									"root","");

	// 	$link->exec("set names utf8");

	// 	return $link;

	// }

	static public function conectarPG() {

		try {

			$host="localhost";
			$port="5432";
			$user="postgres";
			$pass="3000REIVAJinf1976";
			$dbname="bdrrhhcnspt";

			$conn = new PDO("pgsql:dbname=$dbname;host=$host;port=$port", $user, $pass); 

			$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

			return $conn;

		} catch(PDOException $e) {

			echo "ERROR: " . $e->getMessage();

		}

	}

}
