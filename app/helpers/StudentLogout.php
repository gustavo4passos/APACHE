<?php
  require_once("SessionStarter.php");
  SessionStarter::start();;
  $_SESSION = array();
  session_destroy();

  header("Location: ../views/StudentLogin.php");
  exit;
 ?>
