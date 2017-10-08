<?php
require_once("../helpers/connection.php");

	class LoginController extends Connection
	{
		public static function login()
		{
			$username = "";
			$password = "";

			$username_err = "";
			$password_err = "";

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
				$username = $_POST['CPF'];
				$password = $_POST['password'];

				$id = self::getUserId($username);

				if($id != null)
				{
					if(self::checkPasswordMatch($id, $password))
					{
						echo "The passwords match.\n";
						header("Location: https://www.youtube.com/watch?v=dQw4w9WgXcQ");
					}
					else
					{
						echo "The passwords do not match.\n";
					}
				}
				else
				{
					echo "Unable to find ID from CPF $username\n";
				}
			}
		}

		private static function getUserId( $cpf )
		{

			$pdo = self::start();
			// Requests the user id from the database from the CPF
			$sqlRequestUserId = "SELECT id FROM user WHERE cpf = :cpf";
			if($stmt = $pdo->prepare($sqlRequestUserId))
			{
				$stmt->bindParam(':cpf', $cpf, PDO::PARAM_STR);
				if($stmt->execute())
				{
					if($stmt->rowCount() == 1)
					{
						$userData = $stmt->fetch();
						$userId = $userData['id'];
						return $userId;

					}
					else
					{
						return null;
					}
				}
				else
				{
					return null;
				}
			}
			else
			{
				return null;
			}
		}

		private static function checkPasswordMatch($userId, $password)
		{
			$pdo = self::start();

			$sqlRequestUserPassword = "SELECT password FROM student WHERE user_id = :userID";

			if($stmt = $pdo->prepare($sqlRequestUserPassword))
			{
				$stmt->bindParam(':userID', $userId, PDO::PARAM_INT);

				if($stmt->execute())
				{
					if($stmt->rowCount() == 1)
					{
						$studentData = $stmt->fetch();
						$studentPassword = $studentData['password'];

						if(md5($password) == $studentPassword)
						{
							return true;
						}
						else
						{
							return false;
						}
					}
					else
					{
						echo "Statement returned empty.\n";
						return false;
					}
				}
				else
				{
					echo "Unable to execute student password statement request.\n";
					return false;
				}
			}
			else
			{
				echo "Unable to request student password.\n";
				return false;
			}
		}
	}

	LoginController::login();
?>
