<?php 

use Symfony\Component\Routing\Route;
use Symfony\Component\Routing\RouteCollection;

// Routes system
$routes = new RouteCollection();
$routes->add('index', new Route(constant('URL_SUBFOLDER') . '/', array('controller' => 'PageController', 'method'=>'indexAction'), array()));
$routes->add('homepage', new Route(constant('URL_SUBFOLDER') . '/home', array('controller' => 'HomeController', 'method'=>'homeAction'), array()));
$routes->add('login', new Route(constant('URL_SUBFOLDER') . '/login', array('controller' => 'LoginController', 'method'=>'loginAction'), array()));
$routes->add('logout', new Route(constant('URL_SUBFOLDER') . '/logout', array('controller' => 'LogoutController', 'method'=>'logoutAction'), array()));
//$routes->add('product', new Route(constant('URL_SUBFOLDER') . '/product/{id}', array('controller' => 'ProductController', 'method'=>'showAction'), array('id' => '[0-9]+')));