<?php
  require_once('../helpers/retrieve.php');
  require_once("../helpers/SessionStarter.php");
  SessionStarter::start();;
  if(!isset($_SESSION['admin_username']) || empty($_SESSION['admin_username']))
  {
    header("Location: ../views/AdminLogin.php");
    exit;
  }
?>
<!DOCTYPE HTML>
<html>
  <head>
      <meta name="viewport" content="width=device-width">
    <link rel="stylesheet" type="text/css" href="../assets/css/styleAdmin.css">
    <title>Página do Admnistrador</title>
  </head>
  <body>
  <header>
    <nav class="menu">
      <ul>
        <li><a href="AdminHomepage.php">Home</a></li>
        <li><a href="DepartmentView.php">Departamentos</a></li>
        <li><a href="SubjectView.php">Disciplinas</a></li>
        <li><a href="CourseView.php">Cursos</a></li>
        <li><a href="ProfessorView.php">Professores</a></li>
        <li><a href="StudentView.php">Alunos</a></li>
        <li><a href="ClassView.php">Turmas</a></li>
        <li><a href="../helpers/AdminLogout.php">Logout</a></li>
      </ul>
    </nav>
  </header>
    <section class="inicio_department">
      <h1> Disciplinas </h1>
      <h4><a href="subtest.php">Nova</a></h4>
    </section>
    <section class = "table_section">
      <table>
      <tr>
        <th>Nome</th>
        <th>Código</th>
        <th>Departamento</th>
        <th class="editar_column"></th>
      </tr>
        <?php

          $subjects = Retrieve::select_from_assoc("subject");
          $departments = Retrieve::select_from_assoc("department");
          // echo "<pre>"; var_dump($departments);
          // var_dump($subjects);
          foreach($subjects as $row) { ?>
                <tr>
                <td><?= $row['name']; ?></td>
                <td><?= $row['code']; ?></td>
                <td><?= $departments[$row['department_id']]['name'] ?></td>
                <td class="editar"><a href="#">Editar</a></td>
              </tr>
              <?php
          }
        ?>
      </table>
    </section>
  </body>
</html>
