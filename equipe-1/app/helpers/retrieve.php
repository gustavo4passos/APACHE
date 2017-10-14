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

		public static function select_join_assoc($table){
			if($table == "student" || $table == "professor"){
				$connect = self::start();
				$stm = $connect->prepare("SELECT `$table`.*, `user`.* FROM `$table` INNER JOIN `user` ON `$table`.`user_id` = `user`.`id`");
				$stm->execute();
				$array = [];
				$index = 0;
				$result = $stm->fetch(PDO::FETCH_ASSOC);
				while($result){
					$array[$result['id']] = $result;
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

		public static function select_from_where($table, $column, $value){
			$connect = self::start();
			$stm = $connect->prepare("SELECT * FROM `$table` where `$column` = '$value'");
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

		public static function select_view_table($table){

			$connect = self::start();
			if($table == "department"){
				$stm = $connect->prepare("SELECT `department`.*, `user`.`name` FROM `department` INNER JOIN `user` ON `department`.`headmaster_id` = `user`.`id`");
				$stm->execute();
				$array = [];
				$result = $stm->fetch(PDO::FETCH_ASSOC);
				$index = $result['id'];
				while($result){
					$array[$index] = $result;
					$result = $stm->fetch(PDO::FETCH_ASSOC);
					$index = $result['id'];
				}
				// var_dump($array); die;
				return $array;
			}
		}

		public static function select_from_assoc($table){
			$connect = self::start();
			$stm = $connect->prepare("SELECT * FROM `$table`");
			$stm->execute();
			$array = [];
			$result = $stm->fetch(PDO::FETCH_ASSOC);
			$index = $result['id'];
			while($result)
			{
				$array[$index] = $result;
				$result = $stm->fetch(PDO::FETCH_ASSOC);
				$index = $result['id'];
			}

			return $array;
		}


			public static function select_from_id_assoc($table, $id)
			{
					$whole_table = self::select_join($table);

					if(empty($whole_table))
					{
						return null;
					}
					else
					{
						for($i = 0; $i < sizeof($whole_table); $i++)
						{
							if($whole_table[$i]['id'] == $id)
							{
								return $whole_table[$i];
							}
						}

						return null;
					}
			}

			public static function get_available_classes_from_course(array $availableSubjects)
			{
				$nAvailableSubjects = sizeof($availableSubjects);
        $availableClasses = array(array());

        for($i = 0; $i < $nAvailableSubjects; $i++)
        {
          $currentSubjectId = $availableSubjects[$i]['subject_id'];
          $availableClassesOnTheSubject = Retrieve::select_from_where("class", "subject_id", $currentSubjectId);
          if($availableClassesOnTheSubject > 0)
          {
            $availableClasses[$currentSubjectId] = $availableClassesOnTheSubject;
          }
        }

				return $availableClasses;
			}
	}
	// Retrieve::select_from("user");
	// echo Retrieve::maxid_from("user");
	// Retrieve::select_join("student");
?>
