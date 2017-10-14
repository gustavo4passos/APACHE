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
      <h1> Turmas </h1>
      <h4><a href="ClassView.php">Voltar</a></h4>
    </section>
	<section class="create_form">
		<h3>Cadastro de Turmas</h3>
		<form id="create_class" action="../controllers/ClassController.php" method="POST">
			Código:<br><input type="text" name="code" required><br>
			Data de início (aaaa-mm-dd):<br><input type="date" name="init_date" required><br>
			Capacidade:<br><input type="number" name="capacity" required><br>
			Disciplina:<br>
			<select name="subject_id" form="create_class" required>
				<?php
					require_once('../helpers/retrieve.php');
					$subjects = Retrieve::select_from("subject");
					//var_dump($subjects);
					for ($i=0; $i < sizeof($subjects) ; $i++) {
						echo "<option value = {$subjects[$i]['id']}>{$subjects[$i]['name']}</option>\n";
					}
				?>
			</select><a href="subtest.php">Cadastrar disciplina</a><br>
			Professor:<br>
			<select name="professor_id" from="create_class">
				<?php
					require_once('../helpers/retrieve.php');
					$professors = Retrieve::select_join("professor");
					//var_dump($professors);
					for ($i=0; $i <sizeof($professors); $i++) {
						echo "<option value = {$professors[$i]['user_id']}>{$professors[$i]['name']}</option>\n";
					}
				?>
			</select><a href="proftest.php">Cadastrar professor</a><br>
			<button name="action" value="create"> Enviar </button>
		</form>
	</section>
  </body>
</html>

