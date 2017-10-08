<?php
	require_once('../models/subject.php');
	
	class SubjectController{
		public static function create(){
			if(!empty($_POST['name']) && !empty($_POST['code']) && !empty($_POST['department_id'])/*LEMBRAR DE VERFICAR SE DEPARTAMENTO É VALIDO*/){
				$subject = new Subject($_POST);
				// var_dump($subject); die;
				try{
					$subject->insert();
					$_SESSION['msg'] = "Disciplina criado com sucesso!";
				}
				catch(PDOException $e){
					$_SESSION['msg'] = ">Erro";
				}
			}

			header("location: ../views/subtest.php");
		}
	}

	// var_dump($_POST);
	// die;
 
	$postActions = array('create', 'read',  'update', 'delete');

	if(isset($_POST['action']) && in_array($_POST['action'], $postActions)){
		$action = $_POST['action'];			
		SubjectController::$action();
	}


?>