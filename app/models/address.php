<?php
	require_once('../helpers/connection.php');

	class Address extends Connection {

		private $id;
		private $street;
		private $number;
		private $complement;
		private $city;
		private $state;
		private $country;

		function __construct(array $attributes){
			$this->id = (empty($attributes['id'])) ? null : $attributes['id'];
			$this->street = (empty($attributes['sreet'])) ? null : $attributes['street'];
			$this->number = (empty($attributes['number'])) ? null : $attributes['number'];
			$this->complement = (empty($attributes['complement'])) ? null : $attributes['complement'];
			$this->city = (empty($attributes['city'])) ? null : $attributes['city'];
			$this->state = (empty($attributes['state'])) ? null : $attributes['state'];
			$this->country = (empty($attributes['country'])) ? null : $attributes['country'];
			
		}

		public function insert() {
            $connect = self::start();

            $stm = $connect->prepare("INSERT INTO `address` (`street`, `number`, `complement`, `city`, `state`, `country`) VALUES (:street, :number, :complement, :city, :state, :country)");

            $stm->BindValue(":street", $this->street, PDO::PARAM_STR);
            $stm->BindValue(":number", $this->number, PDO::PARAM_INT);
            $stm->BindValue(":complement", $this->complement, PDO::PARAM_STR);
            $stm->BindValue(":city", $this->city, PDO::PARAM_STR);
            $stm->BindValue(":state", $this->state, PDO::PARAM_STR);
            $stm->BindValue(":country", $this->country, PDO::PARAM_STR);

            

            return $stm->execute();
        }


	}
?>