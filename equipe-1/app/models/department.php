<?php
	require_once('../helpers/connection.php');

	class Department extends Connection {
		
		private $id;
		private $name;
		private $code;
		private $headmaster_id;

		function __construct (array $attributes){
			$this->id = empty($attributes['id']) ? null : $attributes['id'];
			$this->name = empty($attributes['name']) ? null : $attributes['name'];
			$this->code = empty($attributes['code']) ? null : $attributes['code'];
			$this->headmaster_id = empty($attributes['headmaster_id']) ? null : $attributes['headmaster_id'];
		}

		public function insert(){
				$connect = self::start();
		        $stm = $connect->prepare("INSERT INTO `department` (`name`, `code`, `headmaster_id`) VALUES (:name , :code , :headmaster_id)");
		        $stm->BindValue(":name", $this->name, PDO::PARAM_STR);
		        $stm->BindValue(":code", $this->code, PDO::PARAM_STR);
		        $stm->BindValue(":headmaster_id", $this->headmaster_id, PDO::PARAM_INT);

		        return $stm->execute();
		}
	}
?>