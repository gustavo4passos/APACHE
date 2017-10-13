<?php
	require_once('../helpers/connection.php');

	class Course_has_subject extends Connection {
		
		private $course_id;
		private $subject_id;


		function __construct (array $attributes){
			$this->course_id = empty($attributes['course_id']) ? null : $attributes['course_id'];
			$this->subject_id = empty($attributes['subject_id']) ? null : $attributes['subject_id'];
		}

		public function insert(){
				$connect = self::start();
		        $stm = $connect->prepare("INSERT INTO `course_has_subject` (`course_id`, `subject_id`)VALUES (:course_id , :subject_id)");
		        $stm->BindValue(":course_id", $this->course_id, PDO::PARAM_INT);
		        $stm->BindValue(":subject_id", $this->subject_id, PDO::PARAM_INT);

		        return $stm->execute();
		}
	}
?>