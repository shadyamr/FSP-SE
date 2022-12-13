<?php 

namespace App\Controllers;

use Symfony\Component\Routing\RouteCollection;

class HomeController
{
	public function homeAction(RouteCollection $routes)
	{
		if(isset($_SESSION['login']))
		{
        	require_once APP_ROOT . '/views/home.php';
		}
		else
		{
			header('Location: ./');
		}
	}
}