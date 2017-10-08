<?php
	require_once('../models/user.php');
	require_once('../models/address.php');
	require_once('../models/student.php');

	class StudentController{

		public static function create(){
			
			$addres = new Address($_POST);
			//var_dump($addres); die;
			//var_dump($_POST); die;
			try{
				$addres->insert();
				$_SESSION['msg'] = "Endereço criado com sucesso!";
			}
			catch(PDOException $e){
				$_SESSION['msg'] = ">Erro";
			}

		
			if(!empty($_POST['password']) && !empty($_POST['name']) && !empty($_POST['cpf']) && !empty($_POST['rg'])){
				//$_POST['password'] = md5($_POST['password']);
				$user = new User($_POST);
				try{
					$user->insert();
					$_SESSION['msg'] = "Usuário criado com sucesso!";
				}
				catch(PDOException $e){
					$_SESSION['msg'] = ">Erro";
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