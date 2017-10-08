<?php
  session_start();

  if(!isset($_SESSION['admin_username']) || empty($_SESSION['admin_username']))
  {
    header("Location: ../views/AdminLogout.php");
    exit;
  }
 ?>

<!DOCTYPE HTML>
<html>
  <header>
    <title>Pagina do Estudante</title>
  </header>
  <body>
    <h1> Bem Vindo <?= $_SESSION['admin_username']; ?> </h1>

    <p> <a href="CadastrarAluno.php">Cadastrar Aluno</a> </p>
    <p> <a href="CadastrarProfessor.php">Cadastrar Professor</a> </p>
    <div>
      <a href="Logout.php">Logout</a>

    </div>
  </body>
</html>
