<?php
	require_once("../helpers/SessionStarter.php");
	SessionStarter::start();;
	if(isset($_SESSION['admin_username']) && !empty($_SESSION['admin_username']))
	{
		header("Location: ../views/AdminHomepage.php");
	}
?>
<!DOCTYPE html>
<html>
	<head>
	  <meta charset="utf-8">
	  <meta name="viewport" content="width=device-width">
	  <link rel="stylesheet" type="text/css" href="../assets/css/style.css">
	  <title>Login</title>
	</head>

		<body class="admin-body">
			<form action="../controllers/AdminLoginController.php" method = "POST" id = "login">
				<div id="login-box">
				   <div id="login-box-interno">
					   	<div id="login-box-label">
					   		<h4>ADMINISTRADOR</h4>
					   		<div class="input-div"  id="input-usuario">
					   			<input type="text" name="username" placeholder="Usuário">
					   		</div>

							<div class="input-div"  id="input-senha">
							   	<input type="password" name="password" placeholder="Senha">
							</div>
									<button name="action">Fazer login</button>
									<?php
										if(isset($_SESSION['msg']) && !empty($_SESSION['msg'])) {
											echo "<p> {$_SESSION['msg']} </p>";
											unset($_SESSION['msg']);
										}
									?>
						</div>
				   </div>
				</div>
			</form>
				<div class="admin-access-text"> <a href="StudentLogin.php"> Acesso como estudante </a></div>
		</body>
</html>
