<?php

class Router
{
	protected $routes = [];

	public function define($routes)
	{
		$this->routes = $routes;
	}
	public function get($uri, $controller)
	{
		$this->routes['GET'][$uri] = $controller;
	}

	public function post($uri, $controller)
	{
		$this->routes['POST'][$uri] = $controller;
	}

	public static function load($file)
	{
		$router = new static;
		
		require $file;

		return $router;
	}

	public function direct($uri,$method)
	{

		if(array_key_exists($uri, $this->routes[$method])){
			
			return 'views/'.$this->routes[$method][$uri];
		}
		else{
			return 'views/'.$this->routes['GET']['error/404'];
		}

		$this->action();
		
	}
}