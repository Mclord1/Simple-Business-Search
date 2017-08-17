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
		//stripos($uri, "inits-sampleproject/")
		if(array_key_exists($uri, $this->routes[$method])){
			
			return 'views/'.$this->routes[$method][$uri];
		}
		else{
			die(ini_set('display_errors', '1'));
		}

		
	}
}