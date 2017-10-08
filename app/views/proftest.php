<!DOCTYPE html>
<html>
	<head>
		<link rel="stylesheet" type="text/css" href="../assets/css/stylesheet.css">
		<meta charset="utf-8">
		<title>Atividade MVC</title>
	</head>
	<body>

		<section class = "management">
			<h1>Gerenciamento da Universidade</h1>	
			<h3>Adicionando novos professores</h3>	
			<form action="../controllers/UserController.php" method = "POST" id="create_prof">
				<div id = "user">
					<label><h4>Informações Gerais</h4></label>
					<label for="nome">Nome:</label><br/><input type="text" name="name" id="nome" required><br/>
					CPF:<br/><input type="text" name="cpf" required><br/>
					RG:<br/><input type="text" name="rg" required><br/>
					Email:<br/><input type="email" name="email"><br/>
					Grau de escolaridade:<br>
					<select name="schooling" form = "create_prof">
						<option value="graduacao">Graduado(a)</option>
						<option value="pos-graduacao">Pós-Graduado(a)</option>
						<option value="mestrado">Mestre</option>
						<option value="doutorado">Doutor(a)</option>
						<option value="pos-doutorado">Pós-Doutor(a)</option>
					</select><br>
					Departamento associado:<br>
					<select name="department" form = "create_prof">
						<option value="1">Departamento de Computação</option>
						<option value="2">Departamento de Engenharia</option>
					</select>
				</div>

				<div id = "address">
					<h4>Endereço</h4>
					Rua:<input type="text" name="street">
					Número:<input type="number" name="number">
					Complemento:<input type="text" name="complement"><br>
					Cidade:<input type="text" name="city">
					Estado:<input type="text" name="state">
					País:<input type="text" name="country">
				</div>-
				<button name="action" value="create"> Enviar </button>
			</form>	
		</section>
		<section class = "lists">
			<h3><a href="#">Lista de Professores</a></h3>
			<h3><a href="#">Lista de Alunos</a></h3>
		</section>

	</body>
</html>