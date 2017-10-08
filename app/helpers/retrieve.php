<?php
	require_once('connection.php');
	class Retrieve extends Connection {
		public static function select_from($table){
			$connect = self::start();
			$stm = $connect->prepare("SELECT * FROM `$table`");
			$stm->execute();
			$array = [];
			$index = 0;
			$result = $stm->fetch(PDO::FETCH_ASSOC);
			while($result)
			{
				$array[$index] = $result;
				$result = $stm->fetch(PDO::FETCH_ASSOC);
				$index++;	
			}
					
			return $array;
		}

		public static function maxid_from($table){
			$connect = self::start();
			$stm = $connect->prepare("SELECT max(id) FROM `$table`");
			$stm->execute();
			$result = $stm->fetch(PDO::FETCH_NUM);
			$maxid = $result[0];
			return $maxid;
		}

		public static function select_join($table){
			if($table == "student" || $table == "professor"){
				$connect = self::start();
				$stm = $connect->prepare("SELECT `$table`.*, `user`.* FROM `$table` INNER JOIN `user` ON `$table`.`user_id` = `user`.`id`");
				$stm->execute();
				$array = [];
				$index = 0;
				$result = $stm->fetch(PDO::FETCH_ASSOC);
				while($result){
					$array[$index] = $result;
					$result = $stm->fetch(PDO::FETCH_ASSOC);
					$index++;
				}
				//var_dump($array); die;
				return $array;
			}
			else{
				echo "Parâmetro inválido! (function 'select_join')";
				return NULL;
			}
		}
	}

	// Retrieve::select_from("user");
	// echo Retrieve::maxid_from("user");
	// Retrieve::select_join("student");
?>