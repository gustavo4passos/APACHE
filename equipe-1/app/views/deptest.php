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
      <h4><a href="DepartmentView.php">Voltar</a></h4>
    </section>
	<section class="create_form">
		<h3>Cadastro de Departamentos</h3>
		<form id="create_department" action="../controllers/DepartmentController.php" method="POST">
			Nome:<br><input type="text" name="name" required><br>
			Código:<br><input type="text" name="code" required><br>
			Chefe (Escolha o professor):<br>
			<select name="headmaster_id" form = "create_department">
				<option value = "">nenhum</option>
				<?php
					require_once('../helpers/retrieve.php');
					$professors = Retrieve::select_join("professor");
					//var_dump($professors);
					for ($i=0; $i <sizeof($professors); $i++) {
						echo "<option value = {$professors[$i]['user_id']}>{$professors[$i]['name']}</option>\n";
					}
				?>
			</select>
			<a href="proftest.php">Cadastrar professor</a><br>
			<button name="action" value="create"> Enviar </button>
		</form>
	</section>
  </body>
</html>
