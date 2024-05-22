<?php

declare(strict_types=1);

namespace App\Core;

use Exception;

class ServiceContainer
{
	private static array $registry = [];

	public static function bind(string $key, mixed $value): void
	{
		static::$registry[$key] = $value;
	}

	public static function has(string $key): bool
	{
		return array_key_exists($key, static::$registry);
	}

	public static function get(string $key): mixed
	{
		if (!array_key_exists($key, static::$registry)) {
			throw new Exception('Not registered');
		}

		$service = static::$registry[$key];

		if (is_callable($service)) {
			return $service();
		}

		return $service;
	}
}