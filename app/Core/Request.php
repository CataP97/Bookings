<?php

declare(strict_types=1);

namespace App\Core;

class Request
{
	private array $data;

	public function __construct()
	{
		$this->data = $_REQUEST;
	}

	public function get(string $key, mixed $default = null): mixed
	{
		return $this->data[$key] ?? $default;
	}

	public static function method(): string
	{
		return $_SERVER['REQUEST_METHOD'];
	}

	public static function uri(): string
	{
		return trim(
			parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH), '/',
		);
	}
}