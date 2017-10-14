<?php
  require_once("../helpers/SessionStarter.php");
  SessionStarter::start();;

  if(!isset($_SESSION['username']) || empty($_SESSION['username']))
  {
    header("Location: ../views/StudentLogin.php");
    exit;
  }
 ?>

 <!DOCTYPE HTML>
 <html>
   <head>
       <meta name="viewport" content="width=device-width">
     <link rel="stylesheet" type="text/css" href="../assets/css/styleAdmin.css">
     <title>Página do Estudante</title>
   </head>
   <body>
   <header>
     <nav class="menu">
       <ul>
         <li><a href="StudentHomepage.php">Home</a></li>
         <li><a href="StudentClasses.php">Disciplinas</a></li>
         <li><a href="#">Cursos</a></li>
         <li><a href="#">Informações Pessoais</a></li>
         <li><a href="../helpers/StudentLogout.php">Logout</a></li>
       </ul>
     </nav>
   </header>
     <section class="inicio">
       <h1> Bem Vindo, <?= $_SESSION['name'] ?> </h1>
     </section>
   </body>
 </html>
