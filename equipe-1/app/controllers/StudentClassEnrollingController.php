<?php
  require_once("../helpers/retrieve.php");
  require_once("../models/class_has_student.php");
  require_once("../helpers/SessionStarter.php");

  SessionStarter::start();

  class StudentClassEnrollingController extends Connection {
    public static function create(){
      if(!empty($_SESSION['id']))
      {
        foreach($_POST as $index)
        {
          $key = array_search($index, $_POST);
          if($key != "action")
          {
            $enrollData = array( 'class_id' => $_POST[$key], 'student_id' => $_SESSION['id']);
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
        $_SESSION['msg'] = "Error while enrolling student. One of the fields were empty.";
      }
    }

    public static function delete() {
      if(isset($_SESSION['id']))
      {
        $studentCurrentClasses = Retrieve::select_from_where("class_has_student", "student_user_id", $_SESSION['id']);
        if(!empty($studentCurrentClasses))
        {
          $studentData = array('class_id' => null, 'student_id' => $_SESSION['id']);
          $class_has_student = new Class_has_student($studentData);
          if(!$class_has_student->delete())
          {
            echo "Unable to cancel current semester."; die;
          }
        }
      }
      else {
        header("Location: ../views/StudentLogin.php");
      }
    }
  }

  $postActions = array('create', 'delete');

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
