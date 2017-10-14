<?php
  require_once('../helpers/connection.php');

  class Class_has_student extends Connection{
    private $class_id;
    private $student_id;

    function __construct(array $attributes){
      $this->class_id = $attributes['class_id'];
      $this->student_id = $attributes['student_id'];
    }

    public function insert(){
      $pdo = self::start();
      $stm = $pdo->prepare("INSERT INTO `class_has_student` (`class_id`, `student_user_id`) VALUES (:class_id, :student_id)");
      $stm->BindValue(":class_id", $this->class_id, PDO::PARAM_INT);
      $stm->BindValue(":student_id", $this->student_id, PDO::PARAM_INT);
      return $stm->execute();
    }
  }
?>
