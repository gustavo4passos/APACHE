<?php
	require_once('../helpers/connection.php');

	class Student extends Connection{

		private $user_id;
		private $password;
		private $matriculation;
		private $born_date;
		private $entry_date;
		private $course_id;

		function __construct(array $atributes){
			$this->user_id = empty($atributes['user_id']) ? null : $atributes['user_id'];
			$this->password = empty($atributes['password']) ? null : $atributes['password'];
			$this->matriculation = empty($atributes['matriculation']) ? null : $atributes['matriculation'];
			$this->born_date = empty($atributes['born_date']) ? null : $atributes['born_date'];
			$this->entry_date = empty($atributes['entry_date']) ? null : $atributes['entry_date'];
			$this->course_id = empty($atributes['course_id']) ? null : $atributes['course_id'];

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