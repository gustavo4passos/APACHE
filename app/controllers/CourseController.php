<?php
	require_once('../models/course.php');
	
	class CourseController{
		public static function create(){
			if(!empty($_POST['name']) && !empty($_POST['code'])){
				$course = new Course($_POST);
				// var_dump($course); die;
				try{
					$course->insert();
					$_SESSION['msg'] = "Endereço criado com sucesso!";
				}
				catch(PDOException $e){
					$_SESSION['msg'] = ">Erro";
				}
			}

			header("location: ../views/deptest.php");
		}
	}

	var_dump($_POST);
	die;
 
	$postActions = array('create', 'read',  'update', 'delete');

	if(isset($_POST['action']) && in_array($_POST['action'], $postActions)){
		$action = $_POST['action'];			
		DepartmentController::$action();
	}


?>