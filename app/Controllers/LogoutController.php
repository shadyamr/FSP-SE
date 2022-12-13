<?php 

namespace App\Controllers;

use App\Models\Logout;
use Symfony\Component\Routing\RouteCollection;

class LogoutController
{
	public function logoutAction(RouteCollection $routes)
	{
		if(isset($_SESSION['login']))
		{
        	$logout = new Logout();
		}
		else
		{
			header('Location: ./');
		}
	}
}