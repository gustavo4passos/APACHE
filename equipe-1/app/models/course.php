<?php
	require_once('../helpers/connection.php');

	class Course extends Connection {
		
		private $id;
		private $name;
		private $duration;
		private $code;

		function __construct (array $attributes){
			$this->id = empty($attributes['id']) ? null : $attributes['id'];
			$this->name = empty($attributes['name']) ? null : $attributes['name'];
			$this->duration = empty($attributes['duration']) ? null : $attributes['duration'];
			$this->code = empty($attributes['code']) ? null : $attributes['code'];
		}

		public function insert(){
				$connect = self::start();
		        $stm = $connect->prepare("INSERT INTO `course` (`name`, `duration`, `code`) VALUES (:name , :duration, :code)");
		        $stm->BindValue(":name", $this->name, PDO::PARAM_STR);
		        $stm->BindValue(":duration", $this->duration, PDO::PARAM_INT);
		        $stm->BindValue(":code", $this->code, PDO::PARAM_STR);

		        return $stm->execute();
		}
	}
?>