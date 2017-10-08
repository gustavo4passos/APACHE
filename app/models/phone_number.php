<?php
	require_once('../helpers/connection.php');
	
	class Phone_number extends Connection{

		private $id;
		private $number;
		private $type;
		private $user_id;

		function __construct (array $attributes){
			$this->id = empty($attributes['id']) ? null : $attributes['id'];
			$this->number = empty($attributes['number']) ? null : $attributes['number'];
			$this->type = empty($attributes['type']) ? null : $attributes['type'];
			$this->user_id = empty($attributes['user_id']) ? null : $attributes['user_id'];
		}

		public function insert(){
			$connect = self::start();
            $stm = $connect->prepare("INSERT INTO `phone_number` (`user_id`, `number`, `type`) VALUES (:user_id, :number , :type)");
            $stm->BindValue(":user_id", $this->user_id, PDO::PARAM_INT);
            $stm->BindValue(":number", $this->number, PDO::PARAM_STR);
            $stm->BindValue(":type", $this->type, PDO::PARAM_STR);

            return $stm->execute();
		}
	}
?>  