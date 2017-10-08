<?php
	require_once('../helpers/connection.php');

	class User extends Connection {

		private $id;
		private $name;
		private $cpf;
		private $rg;
		private $email;
		private $address_id;

		function __construct(array $attributes){
			$this->id = (empty($attributes['id'])) ? null : $attributes['id'];
			$this->name = (empty($attributes['name'])) ? null : $attributes['name'];
			$this->cpf = (empty($attributes['cpf'])) ? null : $attributes['cpf'];
			$this->rg = (empty($attributes['rg'])) ? null : $attributes['rg'];
			$this->email = (empty($attributes['email'])) ? null : $attributes['email'];
			$link = self::start_mysqli();
			$result = mysqli_query($link, "SELECT max(id) FROM `address`");
			$address = mysqli_fetch_array($result, MYSQLI_NUM);		
			//var_dump($address); die;
			$this->address_id = $address[0];

		}

		public function insert() {
            $connect = self::start();
            $stm = $connect->prepare("INSERT INTO `user` (`name`, `cpf`, `rg`, `email`, `address_id`) VALUES (:name , :cpf , :rg , :email, :address_id)");
            $stm->BindValue(":name", $this->name, PDO::PARAM_STR);
            $stm->BindValue(":cpf", $this->cpf, PDO::PARAM_STR);
            $stm->BindValue(":rg", $this->rg, PDO::PARAM_STR);
            $stm->BindValue(":email", $this->email, PDO::PARAM_STR);
            $stm->BindValue(":address_id", $this->address_id, PDO::PARAM_INT);

            return $stm->execute();
        }


	}
?>

