<?php
require_once("../helpers/connection.php");
require_once("../helpers/SessionStarter.php");
	SessionStarter::start();;

	class LoginController extends Connection
	{
		public static function login()
		{
			$username = "";
			$password = "";

			if(empty(trim($_POST['password'])))
			{
				$_SESSION['msg'] = "Campo 'Senha' não pode ser vazio.";
				header("Location: ../views/StudentHomepage.php");
			}
			else if(empty(trim($_POST['CPF'])))
			{
				$_SESSION['msg'] = "Campo 'CPF' não pode ser vazio.";
				header("Location: ../views/StudentHomepage.php");
			}
			else
			{
				$username = $_POST['CPF'];
				$password = $_POST['password'];

				$userInfo = self::getUserIdAndName($username);

				if($userInfo != null)
				{
					if(self::checkPasswordMatch($userInfo['id'], $password))
					{
						$_SESSION['username'] = $username;
						$_SESSION['name'] = $userInfo['name'];
						// header("Location: ../views/StudentHomepage.php");
						header("Location: https://www.youtube.com/watch?v=dQw4w9WgXcQ");
					}
					else
					{
						$_SESSION['msg'] = "Senha incorreta.";
						header("Location: ../views/StudentLogin.php");
					}
				}
				else
				{
					$_SESSION['msg'] = "CPF não cadastrado.";
					header("Location: ../views/StudentLogin.php");
				}
			}
		}

		private static function getUserIdAndName( $cpf )
		{

			$pdo = self::start();
			// Requests the user id from the database from the CPF
			$sqlRequestUserId = "SELECT id, name FROM user WHERE cpf = :cpf";
			if($stmt = $pdo->prepare($sqlRequestUserId))
			{
				$stmt->bindParam(':cpf', $cpf, PDO::PARAM_STR);
				if($stmt->execute())
				{
					if($stmt->rowCount() == 1)
					{
						$userData = $stmt->fetch();
						return $userData;

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
