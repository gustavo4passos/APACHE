<?php
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
    <title>Cursos</title>
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
      <h1> Cursos </h1>
      <h4><a href="coursetest.php">Novo</a></h4>
    </section>
    <section class = "table_section">
      <table>
      <tr>
        <th>Nome</th>
        <th>Duração</th>
        <th>Código</th>
        <th>Disciplinas</th>
        <th class="editar_column"></th>
      </tr>
        <?php
          require_once('../helpers/retrieve.php');
          $courses = Retrieve::select_from_assoc("course");
          $subjects = Retrieve::select_from_assoc("subject");
          // var_dump($courses);
          // var_dump($subjects);
          foreach ($courses as $row){ ?>
            <tr>
              <td><?= $row['name'] ?></td>
              <td><?= $row['duration'] ?></td>
              <td><?= $row['code'] ?></td>
              <td>
                <?php
                  $relations = Retrieve::select_from_where("course_has_subject", "course_id", $row['id']);
                  // var_dump($relations);
                  for ($i=0; $i < sizeof($relations) ; $i++) { 
                    $subject_id = $relations[$i]['subject_id'];
                    // var_dump($subject_id);
                    echo "{$subjects[$subject_id]['name']}<br>";
                  }
                ?>                
              </td>
              <td class ="editar"><a href="#">Editar</a></td>
            </tr>
            <?php
          } ?>
        
      </table>
    </section>
  </body>
</html>