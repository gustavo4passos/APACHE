<?php
  session_start();
  if(!isset($_SESSION['admin_username']) || empty($_SESSION['admin_username']))
  {
    header("Location: ../views/AdminLogin.php");
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

    <p> <a href="CadastrarAluno.php">Cadastrar aluno</a> </p>
    <p> <a href="CadastrarCurso.php">Cadastrar curso </a> </p>
    <p> <a href="CadastrarDepartamento.php"> Cadastrar departamento </a> </p>
    <p> <a href="CadastrarDisciplina.php">Cadastrar disciplina </a> </p>
    <p> <a href="CadastrarProfessor.php">Cadastrar professor</a> </p>
    <p> <a href="CadastrarTurma.php"> Cadastrar turma </a> </p>
    <div>
      <a href="AdminLogout.php">Logout</a>
    </div>
  </body>
</html>
