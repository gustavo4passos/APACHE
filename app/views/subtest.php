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
      <h1> Disciplinas </h1>
      <h4><a href="SubjectView.php">Voltar</a></h4>
    </section>
	<section class="create_form">
		<h3>Cadastro de Disciplina</h3>
		<form id="create_subject" action="../controllers/SubjectController.php" method="POST">
			Nome:<br><input type="text" name="name" required><br>
			Código:<br><input type="text" name="code" required><br>
			Ementa:<br><textarea name="syllabus" form="create_subject" rows="4" cols="50"></textarea><br>
			Departamento associado: <br>
			<select name="department_id" form = "create_subject">
				<?php
					require_once('../helpers/retrieve.php');
					$departments = Retrieve::select_from("department");
					for ($i=0; $i <sizeof($departments) ; $i++) {
						echo "<option value = {$departments[$i]['id']}>{$departments[$i]['name']}</option>";
					}
				?>
			</select><a href="deptest.php">Cadastrar departamento</a><br>
			<button name="action" value="create"> Enviar </button>
		</form>
	</section>
  </body>
</html>
