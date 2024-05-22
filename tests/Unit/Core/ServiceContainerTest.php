<?php

declare(strict_types=1);

namespace Tests\Unit\Core;

use App\Core\ServiceContainer;
use Exception;
use PHPUnit\Framework\TestCase;
use stdClass;

class ServiceContainerTest extends TestCase
{
	public function test_service_container_bind_and_get_service(): void
	{
		$service = new stdClass();

		ServiceContainer::bind('test', $service);

		$this->assertSame($service, ServiceContainer::get('test'));
	}

	public function test_service_container_has_service(): void
	{
		$service = new stdClass();

		ServiceContainer::bind('test', $service);

		$this->assertTrue(ServiceContainer::has('test'));
		$this->assertFalse(ServiceContainer::has('random'));
	}

	public function test_service_container_will_throw_exception_if_not_registered(): void
	{
		$this->expectException(Exception::class);
		$this->expectExceptionMessage('Not registered');

		ServiceContainer::get('random');
	}
}