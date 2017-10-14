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
      <h1> Alunos </h1>
      <h4><a href="alunotest.php">Novo(a)</a></h4>
    </section>
    <section class = "table_section">
      <table>
      <tr>
        <th>Nome</th>
        <th>Matrícula</th>
        <th>Curso</th>
        <th>Data de Entrada</th>
        <th class="editar_column"></th>
      </tr>
        <?php
          $students = Retrieve::select_join("student");
          $courses = Retrieve::select_from_assoc("course");
          // var_dump($students);
          foreach($students as $row) { ?>
                <tr>
                <?= "<td class=\"name-select\"> <a href=\"StudentDetailsView.php?id={$row['id']}\"> {$row['name']} </a> </td>" ?>
                <td><?= $row['matriculation']; ?></td>
                <td><?= $courses[$row['course_id']]['name'] ?></td>
                <td><?= $row['entry_date'] ?></td>
                <td class="editar"><a href="#">Editar</a></td>
              </tr>
              <?php
          }
        ?>
      </table>
    </section>
  </body>
</html>
