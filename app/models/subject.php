<?php
	require_once('../helpers/connection.php');

	class Subject extends Connection {
		
		private $id;
		private $name;
		private $code;
		private $syllabus;
		private $department_id;

		function __construct (array $attributes){
			$this->id = empty($attributes['id']) ? null : $attributes['id'];
			$this->name = empty($attributes['name']) ? null : $attributes['name'];
			$this->code = empty($attributes['code']) ? null : $attributes['code'];
			$this->syllabus = empty($attributes['syllabus']) ? null : $attributes['syllabus'];			
			$this->department_id = empty($attributes['department_id']) ? null : $attributes['department_id'];
		}

		public function insert(){
				$connect = self::start();
		        $stm = $connect->prepare("INSERT INTO `subject` (`name`,`code`,`syllabus`, `department_id`) VALUES (:name , :code, :syllabus, :department_id)");
		        $stm->BindValue(":name", $this->name, PDO::PARAM_STR);
		        $stm->BindValue(":code", $this->code, PDO::PARAM_STR);
		        $stm->BindValue(":syllabus", $this->syllabus, PDO::PARAM_STR);
		        $stm->BindValue(":department_id", $this->department_id, PDO::PARAM_INT);

		        return $stm->execute();
		}
	}
?>