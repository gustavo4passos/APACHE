<?php
	require_once('../helpers/connection.php');

	class Student extends Connection{

		private $user_id;
		private $password;
		private $matriculation;
		private $born_date;
		private $entry_date;
		private $course_id;

		function __construct(array $attributes){
			$this->user_id = empty($attributes['user_id']) ? null : $attributes['user_id'];
			$this->password = empty($attributes['password']) ? null : $attributes['password'];
			$this->matriculation = empty($attributes['matriculation']) ? null : $attributes['matriculation'];
			$this->born_date = empty($attributes['born_date']) ? null : $attributes['born_date'];
			$this->entry_date = empty($attributes['entry_date']) ? null : $attributes['entry_date'];
			$this->course_id = empty($attributes['course_id']) ? null : $attributes['course_id'];

		}

		public function insert(){
			$connect = self::start();
            $stm = $connect->prepare("INSERT INTO `student` (`user_id`, `password`, `matriculation`, `born_date`, `entry_date`, `course_id`) VALUES (:user_id, :password , :matriculation , :born_date , :entry_date, :course_id)");
            $stm->BindValue(":user_id", $this->user_id, PDO::PARAM_INT);
            $stm->BindValue(":password", $this->password, PDO::PARAM_STR);
            $stm->BindValue(":matriculation", $this->matriculation, PDO::PARAM_STR);
            $stm->BindValue(":born_date", $this->born_date, PDO::PARAM_STR);
            $stm->BindValue(":entry_date", $this->entry_date, PDO::PARAM_STR);
            $stm->BindValue(":course_id", $this->course_id, PDO::PARAM_INT);

            return $stm->execute();
		}
	}


?>