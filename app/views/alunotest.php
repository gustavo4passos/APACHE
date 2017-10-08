
<!DOCTYPE html>
<html>
	<head>
		<link rel="stylesheet" type="text/css" href="../assets/css/stylesheet.css">
		<meta charset="utf-8">
		<title>Cadastro de Aluno</title>
	</head>
	<body>

		<section class = "management">
			<h1>Gerenciamento da Universidade</h1>	
			<h3>Cadastro de Aluno</h3>	
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
				</div>
				<div id="student">
					<h4>Estudante</h4>
					Matrícula:<br/><input type="text" name="matriculation" required><br/>
					Data de Nascimento (YYYY-MM-DD):<br><input type="date" name="born_date" required><br>
					Data de Ingresso (YYYY-MM-DD):<br><input type="date" name="entry_date" required><br>
					Curso:<br>
					<select name="course_id" form = "create_student" required>
						<?php
							require_once('../helpers/retrieve.php');
							$courses = Retrieve::select_from("course");
							for ($i=0; $i < sizeof($courses) ; $i++) { 
								echo "<option value = {$courses[$i]['id']}>{$courses[$i]['name']}</option>\n";
							}
						?>
					</select><br>
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