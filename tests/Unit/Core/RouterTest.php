<?php

declare(strict_types=1);

namespace Tests\Unit\Core;

use App\Core\Router;
use App\Core\ServiceContainer;
use Exception;
use PHPUnit\Framework\TestCase;

class RouterTest extends TestCase
{
	public function test_route_not_found(): void
	{
		$uri = '/invalid';
		$controller = 'InvalidController';
		$action = 'index';

		$this->expectException(Exception::class);
		$this->expectExceptionMessage('Route not found');

		Router::executeAction($uri, 'GET');
	}

	public function test_route_method_not_found(): void
	{
		$testController = new class {
		};

		$uri = '/not_found';
		$controller = 'TestController';
		$action = 'invalidAction';

		ServiceContainer::bind($controller, $testController);

		Router::get($uri, $controller, $action);

		$this->expectException(Exception::class);
		$this->expectExceptionMessage('Route method not found');

		Router::executeAction($uri, 'GET');
	}

	public function test_route_found(): void
	{
		$testController = new class {
			public function index(): string
			{
				return 'test';
			}
		};

		$uri = '/test';
		$controller = 'TestController';
		$action = 'index';

		ServiceContainer::bind($controller, $testController);

		Router::get($uri, $controller, $action);

		$result = Router::executeAction($uri, 'GET');

		$this->assertEquals('test', $result);
	}
}