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
      <h1> Cursos </h1>
      <h4><a href="CourseView.php">Voltar</a></h4>
    </section>
	<section class="create_form">
		<h3>Cadastro de Cursos</h3>
		<form id="create_course" action="../controllers/CourseController.php" method="POST">
			Nome:<br><input type="text" name="name" required><br>
			Duração (horas aulas):<br><input type="number" name="duration"><br>
			Código:<br><input type="text" name="code" required><br>
			Disciplinas:<a href="subtest.php">Cadastrar disciplina</a><br>
			<?php
				require_once('../helpers/retrieve.php');
				$subjects = Retrieve::select_from("subject");
				//var_dump($subjects);
				for ($i=0; $i < sizeof($subjects) ; $i++) {
					echo "<input type=\"checkbox\" name=\"SUB_$i\" value=\"{$subjects[$i]['id']}\">{$subjects[$i]['name']}<br>\n";
				}
			?>
			<button name="action" value="create"> Enviar </button>
		</form>
	</section>
  </body>
</html>
