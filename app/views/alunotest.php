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
			<form action="../controllers/StudentController.php" method = "POST" id="create_student">
				<div id = "user">
					<label><h4>Informações Gerais</h4></label>
					Nome:<br/><input type="text" name="name"><br/>
					Senha:<br/><input type="password" name="password" required><br/>
					CPF:<br/><input type="text" name="cpf" required><br/>
					RG:<br/><input type="text" name="rg" required><br/>
					Email:<br/><input type="email" name="email"><br/>
				</div>
					<h4>Estudante</h4>
					Matrícula:<br/><input type="text" name="matriculation" required><br/>
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
		<section class = "lists">
			<h3><a href="#">Lista de Professores</a></h3>
			<h3><a href="#">Lista de Alunos</a></h3>
		</section>

	</body>
</html>