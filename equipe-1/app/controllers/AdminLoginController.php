  <?php
  require_once("../helpers/connection.php");
  require_once("../helpers/retrieve.php");
  require_once("../helpers/SessionStarter.php");

	SessionStarter::start();

	class AdminLoginController extends Connection
	{
		public static function login()
		{
			$username = "";
			$password = "";

			if(empty(trim($_POST['password'])))
			{
				$_SESSION['msg'] = "Campo 'Senha' não pode ser vazio.";
				header("Location: ../views/AdminLogin.php");
			}
			else if(empty(trim($_POST['username'])))
			{
				$_SESSION['msg'] = "Campo 'Usuario' não pode ser vazio.";
				header("Location: ../views/AdminLogin.php");
			}
			else
			{
				$username = $_POST['username'];
				$password = $_POST['password'];

				$userInfo = self::getUserIdAndName($username);

				if($userInfo != null)
				{
					if($password == $userInfo['password'])
					{
						$_SESSION['admin_username'] = $username;
						header("Location: ../views/AdminHomepage.php");
					}
					else
					{
						$_SESSION['msg'] = "Senha incorreta.";
						header("Location: ../views/AdminLogin.php");
					}
				}
				else
				{
					$_SESSION['msg'] = "Usuario não cadastrado.";
					header("Location: ../views/AdminLogin.php");
				}
			}
		}

		private static function getUserIdAndName( $username )
		{

			$pdo = self::start();
			// Requests the user id from the database from the CPF
			$sqlRequestUserId = "SELECT id, login, password FROM super_users WHERE login = :login";
			if($stmt = $pdo->prepare($sqlRequestUserId))
			{
				$stmt->bindParam(':login', $username, PDO::PARAM_STR);
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
	}

	AdminLoginController::login();
?>
