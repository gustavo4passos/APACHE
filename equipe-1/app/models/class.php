<?php
	require_once('../helpers/connection.php');

	class Class_ extends Connection {

		private $id;
		private $init_date;
		private $code;
		private $capacity;
		private $subject_id;
		private $professor_id;


		function __construct (array $attributes){
			$this->id = empty($attributes['id']) ? null : $attributes['id'];
			$this->init_date = empty($attributes['init_date']) ? null : $attributes['init_date'];
			$this->code = empty($attributes['code']) ? null : $attributes['code'];
			$this->capacity = empty($attributes['capacity']) ? null : $attributes['capacity'];
			$this->subject_id = empty($attributes['subject_id']) ? null : $attributes['subject_id'];
			$this->professor_id = empty($attributes['professor_id']) ? null : $attributes['professor_id'];
		}

		public function insert(){
			$connect = self::start();
	    $stm = $connect->prepare("INSERT INTO `class` (`init_date`, `code`, `capacity`, `subject_id`, `professor_id`) VALUES (:init_date , :code, :capacity, :subject_id, :professor_id)");
	    $stm->BindValue(":init_date", $this->init_date, PDO::PARAM_STR);
	    $stm->BindValue(":code", $this->code, PDO::PARAM_STR);
	    $stm->BindValue(":capacity", $this->capacity, PDO::PARAM_INT);
	    $stm->BindValue(":subject_id", $this->subject_id, PDO::PARAM_INT);
	    $stm->BindValue(":professor_id", $this->professor_id, PDO::PARAM_INT);
	    return $stm->execute();
		}
	}
?>
