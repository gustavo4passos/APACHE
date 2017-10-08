<!DOCTYPE html>
<html>
<head>
	<title>Cadastro de Curso</title>
</head>
<body>
	<section>
		<h3>Cadastro de Curso</h3>
		<form id="create_course" action="../controllers/CourseController.php" method="POST">
			Nome:<br><input type="text" name="name" required><br>
			Duração (horas aulas):<br><input type="number" name="duration"><br>
			Código:<br><input type="text" name="code" required><br>
			Disciplinas:<br>
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