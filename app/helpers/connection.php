<?php

	class Connection {
		protected static function start(){
			$pdo = new PDO('mysql:host=localhost;dbname=db_mvc', 'root', 'L33th4x0rmysql');
			$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			return $pdo;
		}

		protected static function start_mysqli(){
			$mysqli = mysqli_connect("localhost", "root", "L33th4x0rmysql", "db_mvc");
			return $mysqli;
		} 
	}
?>

