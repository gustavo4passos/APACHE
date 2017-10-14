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
      <h1> Detalhes do Professor </h1>
    </section>
    <section class = "table_section">
      <table class="professor_details">
      <tr>
        <th colspan="2">Detalhes</th>
      </tr>
        <?php
          if(isset($_GET['id']))
          {
            $professor = Retrieve::select_from_id_assoc('professor', $_GET['id']);

            if(!is_null($professor))
            {
              $department = Retrieve::select_from_assoc("department")[$professor['department_id']];
              echo "<tr>
                      <td> Nome </td>
                      <td> {$professor['name']} </td>
                    </tr>
                    <tr>
                      <td> Departamento </td>
                      <td> {$department['name']} </td>
                    <tr>
                      <td> Número de Matrícula </td>
                      <td> {$professor['matriculation']} </td>
                    </tr>
                    <tr>
                      <td> CPF </td>
                      <td> {$professor['cpf']} </td>
                    </tr>
                    <tr>
                      <td> RG </td>
                      <td> {$professor['rg']} </td>
                    </tr>
                    <tr>
                      <td> Email </td>
                      <td> {$professor['email']} </td>
                    </tr>
                    <tr>
                      <td> Data de Contratação </td>
                      <td> {$professor['hiring_date']} </td>
                    </tr>
                    <tr>
                      <td> Grau de Escolaridade </td>
                      <td> {$professor['schooling']} </td>
                    </tr>
                    <tr class=\"voltar-cell\">
                      <td colspan=\"2\"> <a href=\"ProfessorView.php\">Voltar </a> </td>
                    </tr>";
            }
            else
            {
              echo "<tr>
                        <td> Professor não existe </td>
                    <tr>
                    <tr>
                      <td> <a href=\"ProfessorView.php\"> Voltar </a> </td>
                    </tr>";
            }
          }
          else {
            echo "<tr>
                      <td> Professor não existe </td>
                  <tr>
                  <tr>
                    <td> <a href=\"ProfessorView.php\"> Voltar </a> </td>
                  </tr>";
          }
        ?>
      </table>
    </section>
  </body>
</html>
