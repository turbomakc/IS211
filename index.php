<?php  
  require_once("./vendor/autoload.php");
	use Routers\Router;
	
	$router = new Router();
	$url = $_SERVER['REQUEST_URI'];

	echo $router->route($url);

	