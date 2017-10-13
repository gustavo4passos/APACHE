<?php
	require_once('../models/department.php');
	
	class DepartmentController{
		public static function create(){
			if(!empty($_POST['name']) && !empty($_POST['code'])){
				$department = new Department($_POST);
				// var_dump($department); die;
				try{
					$department->insert();
					$_SESSION['msg'] = "Departamento criado com sucesso!";
				}
				catch(PDOException $e){
					$_SESSION['msg'] = ">Erro";
				}
			}

			header("location: ../views/deptest.php");
		}
	}

	// var_dump($_POST);
	//die;

	$postActions = array('create', 'read',  'update', 'delete');

	if(isset($_POST['action']) && in_array($_POST['action'], $postActions)){
		$action = $_POST['action'];			
		DepartmentController::$action();
	}


?>