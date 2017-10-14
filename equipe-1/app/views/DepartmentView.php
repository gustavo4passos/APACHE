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
      <h1> Departamentos </h1>
      <h4><a href="deptest.php">Novo</a></h4>
    </section>
    <section class = "table_section">
      <table>
      <tr>
        <th>Nome</th>
        <th>Código</th>
        <th>Chefe de Departamento</th>
        <th class="editar_column"></th>
      </tr>
        <?php
          require_once('../helpers/retrieve.php');
          $departments = Retrieve::select_from_assoc("department");
          $deps_with_prof = Retrieve::select_view_table("department");
          // var_dump($departments);
          // var_dump($deps_with_prof); //die;
          foreach ($departments as $row) {
            if(empty($departments[$row['id']]['headmaster_id'])){
              echo "<tr>
                <td>{$departments[$row['id']]['name']}</td>
                <td>{$departments[$row['id']]['code']}</td>
                <td><div class=\"nenhum\">nenhum</div></td>
                <td class =\"editar\"><a href=\"#\">Editar</a></td>
              </tr>";
            }
            else{
              echo "<tr>
                <td>{$departments[$row['id']]['name']}</td>
                <td>{$departments[$row['id']]['code']}</td>
                <td>{$deps_with_prof[$row['id']]['name']}</td>
                <td class =\"editar\"><a href=\"#\">Editar</a></td>
              </tr>";
            }
          }
        ?>
      </table>
    </section>
  </body>
</html>
