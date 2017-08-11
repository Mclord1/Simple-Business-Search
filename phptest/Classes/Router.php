<?php

class Router
{
	protected $routes = [];

	public function define($routes)
	{
		$this->routes = $routes;
	}

	public function redirect($url)
	{
		if(array_key_exists($url, $this->routes)){
			return $this->routes[$url];
		}
		throw new Exception("Error Processing Request", 1);

	}
}

?>