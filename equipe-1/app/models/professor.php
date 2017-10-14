<?php
	require_once('../helpers/connection.php');
		
	class Professor extends Connection{

		private $user_id;
		private $matriculation;
		private $schooling;
		private $hiring_date;
		private $department_id;

		function __construct (array $attributes){
			$this->user_id = empty($attributes['user_id']) ? null : $attributes['user_id'];
			$this->matriculation = empty($attributes['matriculation']) ? null : $attributes['matriculation'];
			$this->schooling = empty($attributes['schooling']) ? null : $attributes['schooling'];
			$this->hiring_date = empty($attributes['hiring_date']) ? null : $attributes['hiring_date'];
			$this->department_id = empty($attributes['department_id']) ? null : $attributes['department_id'];
		}


		public function insert(){
			$connect = self::start();
            $stm = $connect->prepare("INSERT INTO `professor` (`user_id`, `matriculation`, `schooling`, `hiring_date`, `department_id`) VALUES (:user_id, :matriculation, :schooling , :hiring_date , :department_id)");
            $stm->BindValue(":user_id", $this->user_id, PDO::PARAM_INT);
            $stm->BindValue(":matriculation", $this->matriculation, PDO::PARAM_STR);
            $stm->BindValue(":schooling", $this->schooling, PDO::PARAM_STR);
            $stm->BindValue(":hiring_date", $this->hiring_date, PDO::PARAM_STR);
            $stm->BindValue(":department_id", $this->department_id, PDO::PARAM_INT);
			
			return $stm->execute();
		}
	}
?>