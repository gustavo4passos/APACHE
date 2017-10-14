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
      <h1> Alunos </h1>
      <h4><a href="StudentView.php">Voltar</a></h4>
    </section>
	<section class="create_form">
		<h3>Cadastro de Alunos</h3>
		<form action="../controllers/StudentController.php" method = "POST" id="create_student">
        <div id = "user">
          <label><h4>Informações Gerais</h4></label>
          Nome:<br/><input type="text" name="name" required><br/>
          Senha:<br/><input type="password" name="password" required><br/>
          CPF:<br/><input type="text" name="cpf" required><br/>
          RG:<br/><input type="text" name="rg" required><br/>
          Email:<br/><input type="email" name="email"><br/>
          Telefone 1:<br><input type="text" name="phone_number_1"><br>
          Telefone 2:<br><input type="text" name="phone_number_2"><br>
          Matrícula:<br/><input type="text" name="matriculation" required><br/>
          Data de Nascimento (aaaa-mm-dd):<br><input type="date" name="born_date" required><br>
          Data de Ingresso (aaaa-mm-dd):<br><input type="date" name="entry_date" required><br>
          Curso:<br>
          <select name="course_id" form = "create_student" required>
            <?php
              require_once('../helpers/retrieve.php');
              $courses = Retrieve::select_from("course");
              for ($i=0; $i < sizeof($courses) ; $i++) {
                echo "<option value = {$courses[$i]['id']}>{$courses[$i]['name']}</option>\n";
              }
            ?>
          </select><a href="coursetest.php">Cadastrar curso</a><br>
        </div>
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
