<?php 

namespace App\Controllers;

use Symfony\Component\Routing\RouteCollection;

class PageController
{
	public function indexAction(RouteCollection $routes)
	{
		if(!isset($_SESSION['login']))
		{
        	require_once APP_ROOT . '/views/index.php';
		}
		else
		{
			header('Location: home');
		}
	}
}