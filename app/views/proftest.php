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
      <h1> Professores </h1>
      <h4><a href="ProfessorView.php">Voltar</a></h4>
    </section>
	<section class="create_form">
		<h3>Cadastro de Professores</h3>
			<form action="../controllers/ProfessorController.php" method = "POST" id="create_prof">
				<div id = "user">
					<label><h4>Informações Gerais</h4></label>
					<label for="nome">Nome:</label><br/><input type="text" name="name" id="nome" required><br/>
					CPF:<br/><input type="text" name="cpf" required><br/>
					RG:<br/><input type="text" name="rg" required><br/>
					Email:<br/><input type="email" name="email"><br/>
					Telefone 1:<br><input type="text" name="phone_number_1"><br>
					Telefone 2:<br><input type="text" name="phone_number_2"><br>
				</div>
				Matrícula:<br><input type="text" name="matriculation" required><br>
				Data de Contratação (aaaa-mm-dd):<br><input type="date" name="hiring_date" required><br>

				Grau de escolaridade:<br>
				<select name="schooling" form = "create_prof">
						<option value="graduacao">Graduado(a)</option>
						<option value="pos-graduacao">Pós-Graduado(a)</option>
						<option value="mestrado">Mestre</option>
						<option value="doutorado">Doutor(a)</option>
						<option value="pos-doutorado">Pós-Doutor(a)</option>
				</select><br>
					Departamento associado:<br>
				<select name="department_id" form = "create_prof">
						<?php
							require_once('../helpers/retrieve.php');
							$departments = Retrieve::select_from("department");
							for ($i=0; $i <sizeof($departments) ; $i++) {
								echo "<option value = {$departments[$i]['id']}>{$departments[$i]['name']}</option>";
							}
						?>
				</select>
				<a href="deptest.php">Cadastrar departamento</a><br>

				<div id = "address">
					<h4>Endereço</h4>
					Rua:<input type="text" name="street">
					Número:<input type="number" name="number">
					Complemento:<input type="text" name="complement"><br>
					Cidade:<input type="text" name="city">
					Estado:<input type="text" name="state">
					País:<input type="text" name="country">
				</div>
				<button name="action" value="create"> Enviar </button>
			</form>
	</section>
  </body>
</html>

