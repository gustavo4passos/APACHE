<?php
  session_start();

  if(!isset($_SESSION['username']) || empty($_SESSION['username']))
  {
    header("Location: ../views/StudentLogin.php");
    exit;
  }
 ?>

<!DOCTYPE HTML>
<html>
  <header>
    <title>Pagina do Estudante</title>
  </header>
  <body>
    <h1> Bem Vindo <?= $_SESSION['name']; ?> </h1>
    <a href="#">Cadastrar turma</a>
    <div>
      <a href="Logout.php">Logout</a>

    </div>
  </body>
</html>