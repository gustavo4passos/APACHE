<!DOCTYPE html>
<html>
	<head>
	  <meta charset="utf-8">
	  <meta name="viewport" content="width=device-width">
	  <link rel="stylesheet" type="text/css" href="../assets/css/style.css">
	  <title>Login</title>    
	</head>
	  
		<body>


		    <div id="login-box">
			   <div id="login-box-interno">
				   	<div id="login-box-label">
						<div id="div-cliente">
							<div id="div-cliente-logo">
								<img id="logo-dcc" src="../assets/img/DCC-UFBA-GIF.gif" alt="Instituto de Matemática">
							</div>
						</div>				   		
					</div>   	
			   </div>
			</div>

			<form action="login_test.php" method = "POST" id = "login">
				<div id="login-box">
				   <div id="login-box-interno">
					   	<div id="login-box-label">
					   		<h4>Acesse pelo seu login</h4>
					   		<div class="input-div"  id="input-usuario">
					   			<input type="text" name="CPF" placeholder="CPF">
					   		</div>

							<div class="input-div"  id="input-senha">
							   	<input type="text" name="password" placeholder="Senha">
							</div>
									<input type="submit">
						</div>   	
				   </div>
				</div>
			</form>
		</body>
</html>