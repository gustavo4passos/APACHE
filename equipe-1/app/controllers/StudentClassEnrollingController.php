<?php
  require_once("../helpers/retrieve.php");
  require_once("../models/class_has_student.php");
  require_once("../helpers/SessionStarter.php");

  SessionStarter::start();

  class StudentClassEnrollingController {
    public static function create(){
      if(!empty($_SESSION['id']))
      {
        foreach($_POST as $index)
        {
          $key = array_search($index, $_POST);
          if($key != "action")
          {
            $enrollData = array( 'class_id' => $key, 'student_id' => $_SESSION['id']);

            $class_has_student = new Class_has_student($enrollData);
            if(!$class_has_student->insert())
            {
              echo "Unable to enroll student.";
              die;
            }
          }
        }
      }
      else
      {
        $_SESSION['msg'] = "Error while enrolling student. One of the field were empty.";
      }
    }
  }

  $postActions = array('create');

  if(isset($_POST['action']))
  {
    if(in_array($_POST['action'], $postActions))
    {
      $action = $_POST['action'];
      StudentClassEnrollingController::$action();
      header("Location: ../views/StudentClasses.php");
    }
  }
?>
