<!DOCTYPE html>
<html>
<head>
	<title>Cadastro de Disciplina</title>
</head>
<body>
	<section>
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
			</select> <br>
			<button name="action" value="create"> Enviar </button>
		</form>
	</section>
</body>
</html>