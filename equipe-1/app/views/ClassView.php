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
      <h1> Turmas </h1>
      <h4><a href="classtest.php">Nova</a></h4>
    </section>
    <section class = "table_section">
      <table>
      <tr>
        <th>Código</th>
        <th>Disciplina</th>
        <th>Professor</th>
        <th>Capacidade</th>
        <th>Data Inicial</th>
        <th class="editar_column"></th>
      </tr>
        <?php

          $classes = Retrieve::select_from_assoc("class");
          $subjects = Retrieve::select_from_assoc("subject");
          $professors = Retrieve::select_from_assoc("user");
          // echo "<pre>"; var_dump($classes);
          // var_dump($subjects);
          // var_dump($professors);
          foreach($classes as $row) { ?>
                <tr>
                <td><?= $row['code']; ?></td>
                <td><?= $subjects[$row['subject_id']]['name']; ?></td>
                <td><?= $professors[$row['professor_id']]['name'] ?></td>
                <td><?= $row['capacity'] ?></td>
                <td><?= $row['init_date'] ?></td>
                <td class="editar"><a href="#">Editar</a></td>
              </tr>
              <?php
          }
        ?>
      </table>
    </section>
  </body>
</html>
