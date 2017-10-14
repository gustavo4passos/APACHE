<?php
require_once("../helpers/SessionStarter.php");
  SessionStarter::start();;
  $_SESSION = array();
  session_destroy();

  header("Location: ../views/AdminLogin.php");
  exit;
 ?>