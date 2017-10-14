<?php
	require_once('../models/user.php');
	require_once('../models/address.php');
	require_once('../models/student.php');
	require_once('../models/phone_number.php');
	require_once('../helpers/retrieve.php');

	class StudentController{

		public static function create(){
			
			
			//var_dump($_POST); die;
		
			if(!empty($_POST['password']) && !empty($_POST['name']) && !empty($_POST['cpf']) && !empty($_POST['rg'])
				&& !empty($_POST['matriculation']) && !empty($_POST['born_date']) && !empty($_POST['entry_date'])
				&& !empty($_POST['course_id'])/*(LEMBRAR DE VERIFICAR SE O CURSO É VÁLIDO)*/){
				
				$_POST['password'] = md5($_POST['password']);

				$addres = new Address($_POST);
				// var_dump($addres); die;
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

				
				$student = new Student($_POST);
				//var_dump($student); die;
				try{
					$student->insert();
					$_SESSION['msg'] = "Aluno criado com sucesso!";
				}
				catch(PDOException $e){
					$_SESSION['msg'] = ">Erro";die;
				}

				if(!empty($_POST['phone_number_1'])){
					$phone1 = array('number'=>$_POST['phone_number_1'], 'user_id'=>$_POST['user_id']);
					//var_dump($phone1); die;
					$phone_number_1 = new Phone_number($phone1);
					//var_dump($phone_number_1);
					try{
						$phone_number_1->insert();
						$_SESSION['msg'] = "Telefone criado com sucesso!";
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
						$_SESSION['msg'] = "Telefone criado com sucesso!";
					}
					catch(PDOException $e){
						$_SESSION['msg'] = ">Erro";
					}
				}

			}
			header("location: ../views/alunotest.php");

			
		}

	}

	$postActions = array('create', 'read',  'update', 'delete');

		if(isset($_POST['action']) && in_array($_POST['action'], $postActions)){
			$action = $_POST['action'];			
			StudentController::$action();
		}
?>