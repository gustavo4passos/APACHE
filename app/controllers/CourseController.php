<?php
	require_once('../models/course.php');
	require_once('../helpers/retrieve.php');
	require_once('../models/course_has_subject.php');

	class CourseController{
		public static function create(){
			if(!empty($_POST['name']) && !empty($_POST['code'])){
				$course = new Course($_POST);
				// var_dump($course); die;
				try{
					$course->insert();
					$_SESSION['msg'] = "Curso criado com sucesso!";
				}
				catch(PDOException $e){
					$_SESSION['msg'] = ">Erro";
					// var_dump($_SESSION); die;
				}

				$subjects = [];
				$j = 0;
				// var_dump($_POST);
				for ($i=0; $i < sizeof($_POST); $i++){ 
					// var_dump($_POST["SUB_$i"]);
					if(isset($_POST["SUB_$i"])){
						$subjects[$j] = $_POST["SUB_$i"];
						$j++;						
					}
				}

				// var_dump($subjects); die;
				$course_row = Retrieve::select_from_where("course", "code", $_POST['code']);
				// var_dump($course_row); die;
				$course_id = $course_row[0]['id'];
				// var_dump($course_id);die;
				for ($i=0; $i < sizeof($subjects); $i++) {					
					$attributes = array("course_id"=>$course_id, "subject_id"=>$subjects[$i]);
					// var_dump($attributes);die;
					$course_has_subject = new Course_has_subject($attributes);
					// var_dump($course_has_subject);
					try{
						$course_has_subject->insert();
						$_SESSION['msg'] = "Relação criada com sucesso!";
					}
					catch(PDOException $e){
						$_SESSION['msg'] = ">Erro";
					}
				}
				// die;
			}

			header("location: ../views/coursetest.php");
		}
	}

	// var_dump($_POST);
	// die;
 
	$postActions = array('create', 'read',  'update', 'delete');

	if(isset($_POST['action']) && in_array($_POST['action'], $postActions)){
		$action = $_POST['action'];			
		CourseController::$action();
	}


?>