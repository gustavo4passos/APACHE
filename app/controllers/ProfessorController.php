<?php
	require_once('../models/professor.php');
	require_once('../models/phone_number.php');
	require_once('../models/user.php');
	require_once('../models/address.php');
	require_once('../helpers/retrieve.php');

	class ProfessorController{
		public static function create(){

			//var_dump($_POST); die;

			if(!empty($_POST['name']) && !empty($_POST['cpf']) && !empty($_POST['rg']) && !empty($_POST['matriculation']) && !empty($_POST['schooling']) && !empty($_POST['department_id']) /*LEMBRAR DE VERIFICAR SE O DEPARTAMENTO É VÁLIDO*/){

				$addres = new Address($_POST);
				//var_dump($addres); die;
				try{
					$addres->insert();
					$_SESSION['msg'] = "Endereço criado com sucesso!";
				}
				catch(PDOException $e){
					$_SESSION['msg'] = ">Erro";
				}
				$_POST['address_id'] = Retrieve::maxid_from("address");

				$user = new User($_POST);
				try{
					$user->insert();
					$_SESSION['msg'] = "Usuário criado com sucesso!";
				}
				catch(PDOException $e){
					$_SESSION['msg'] = ">Erro";
				}

				$_POST['user_id'] = Retrieve::maxid_from("user");
				//var_dump($_POST); die;

				$professor = new Professor($_POST);
				//var_dump(professor); die;
				try{
					$professor->insert();
					$_SESSION['msg'] = "Aluno criado com sucesso!";
				}
				catch(PDOException $e){
					$_SESSION['msg'] = ">Erro";
				}

				if(!empty($_POST['phone_number_1'])){
					$phone1 = array('number'=>$_POST['phone_number_1'], 'user_id'=>$_POST['user_id']);
					//var_dump($phone1); die;
					$phone_number_1 = new Phone_number($phone1);
					//var_dump($phone_number_1);
					try{
						$phone_number_1->insert();
						$_SESSION['msg'] = "Aluno criado com sucesso!";
					}
					catch(PDOException $e){
						$_SESSION['msg'] = ">Erro";
					}
				}
				
				if(!empty($_POST['phone_number_2'])){
					$phone2 = array('number'=>$_POST['phone_number_2'], 'user_id'=>$_POST['user_id']);
					//var_dump($phone2); die;
					$phone_number_2 = new Phone_number($phone2);
					//var_dump($phone_number_2); die;
					try{
						$phone_number_2->insert();
						$_SESSION['msg'] = "Aluno criado com sucesso!";
					}
					catch(PDOException $e){
						$_SESSION['msg'] = ">Erro";
					}
				}

			}
			else{
				echo "Falta alguma informação.";
			}

			header("location: ../views/proftest.php");
		}
	}

	$postActions = array('create', 'read',  'update', 'delete');

		if(isset($_POST['action']) && in_array($_POST['action'], $postActions)){
			$action = $_POST['action'];			
			ProfessorController::$action();
		}
?>