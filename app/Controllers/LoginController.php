<?php 

namespace App\Controllers;

use App\Models\Login;
use Symfony\Component\Routing\RouteCollection;

class LoginController
{
	public function loginAction(RouteCollection $routes)
	{
		if(!isset($_SESSION['login']))
		{
			$login = new Login();
			if ($_SERVER['REQUEST_METHOD'] === 'POST') {
				$l_username = strval(strip_tags($_POST["username"]));
				$l_password = $_POST['password'];
				$login->login($l_username, $l_password);
			}
        	require_once APP_ROOT . '/views/login.php';
		}
		else
		{
			header('Location: home');
		}
	}
}