<?php
require_once("../helpers/connection.php");

	$username = "";
	$password = "";

	$username_err = "";
	$password_err = "";

	var_dump($_POST); die;

	if(empty(trim($_POST['password'])))
	{
		$password_err = 'Por favor digite a sua senha.';
		echo "Password can't be empty.\n";
	}
	else if(empty(trim($_POST['CPF'])))
	{
		$username_err = 'Por favor, digite o seu nome de usuario.';
		echo "Username can't be empty.\n";
	}
	else
	{
		$pdo = Connection::start();
		$username = $_POST['CPF'];
		$password = $_POST['password'];

		$sql_request = "SELECT cpf, id FROM user WHERE cpf = :cpf";


		if($stmt = $pdo->prepare($sql_request))
		{
			$param_cpf = $_POST['CPF'];
			$stmt->bindParam(':cpf', $param_cpf, PDO::PARAM_STR);

			if($stmt->execute())
			{
				if($stmt->rowCount() == 1)
				{
					$userData = $stmt->fetch();
					echo "CPF successfully found in the database. CPF {$_POST['CPF']} belongs to {$userData['id']}\n";

					$sql_request_student = "SELECT password FROM student WHERE user_id = :user_id";

					if($stmt = $pdo->prepare($sql_request_student))
					{
						$param_user_id = $userData['id'];
						$stmt->bindParam(':user_id', $param_user_id, PDO::PARAM_INT);
						if($stmt->execute())
						{
							if($stmt->rowCount() == 1)
							{
								echo "Sucessfully found user id in list.\n";
								$student_data = $stmt->fetch();
								$password_hash = $student_data['password'];

								echo $password;

								if($password == $password_hash)
								{
									echo "Password is correct.\n";
								}
								else {
									echo "Password is incorrect.\n";
								}
							}
							else {
								echo "Error while looking for student id.\n";
							}
						}
					}

				}
				else
				{
					echo "Unable to find CPF. Value: {$_POST['CPF']}\n";
				}
			}
		}
	}
?>
