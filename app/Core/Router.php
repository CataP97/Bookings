<?php

declare(strict_types=1);

namespace App\Core;

use Exception;

class Router
{
	private const string GET_METHOD = 'GET';

	private static array $routes = [];

	public static function get(string $uri, string $controller, string $action): void
	{
		self::$routes[self::GET_METHOD][$uri] = [
			'controller' => $controller,
			'action' => $action,
		];
	}

	public static function doAction(string $uri, string $method): mixed
	{
		try {
			return self::executeAction($uri, $method);
		} catch (Exception $e) {
			return view('error', [
				'errorMessage' => $e->getMessage(),
			]);
		}
	}

	public static function executeAction(string $uri, string $method): mixed
	{
		$route = self::getRoute($method, $uri);

		$controller = self::getController($route['controller']);

		$action = $route['action'];

		if (!method_exists($controller, $action)) {
			throw new Exception('Route method not found');
		}

		return $controller->$action(new Request());
	}

	private static function getRoute(string $method, string $uri): mixed
	{
		return self::$routes[$method][$uri] ?? throw new Exception('Route not found');
	}

	private static function getController(string $controllerName): mixed
	{
		if (ServiceContainer::has($controllerName)) {
			return ServiceContainer::get($controllerName);
		}

		return new $controllerName();
	}
}