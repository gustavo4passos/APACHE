<?php
	require_once('../models/class.php');
	require_once('../helpers/retrieve.php');

	class ClassController{
		public static function create(){
			if(!empty($_POST['capacity']) && !empty($_POST['code'])&& !empty($_POST['subject_id'])&& !empty($_POST['professor_id'])){
				$class = new Class_($_POST);
				// var_dump($course); die;
				try{
					$class->insert();
					$_SESSION['msg'] = "Turma criada com sucesso!";
				}
				catch(PDOException $e){
					$_SESSION['msg'] = ">Erro";
					// var_dump($_SESSION); die;
				}
			}

			header("location: ../views/classtest.php");
		}
	}

	// var_dump($_POST);
	// die;
 
	$postActions = array('create', 'read',  'update', 'delete');

	if(isset($_POST['action']) && in_array($_POST['action'], $postActions)){
		$action = $_POST['action'];			
		ClassController::$action();
	}


?>