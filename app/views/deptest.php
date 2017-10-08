<!DOCTYPE html>
<html>
<head>
	<title>Cadastro de Departamentos</title>
</head>
<body>
	<section>
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