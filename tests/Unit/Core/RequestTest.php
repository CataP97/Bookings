<?php

declare(strict_types=1);

namespace Tests\Unit\Core;

use App\Core\Request;
use Generator;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\TestCase;

class RequestTest extends TestCase
{
	#[DataProvider('expectedGetMethodResult')]
	public function test_request_get_method(array $data, string $key, mixed $expected, ?string $default = null): void
	{
		$_REQUEST = $data;

		$result = (new Request())->get($key, $default);

		$this->assertSame($expected, $result);
	}

	public static function expectedGetMethodResult(): Generator
	{
		yield 'value is set' => [
			'data' => ['value' => 'random'],
			'key' => 'value',
			'expected' => 'random',
		];

		yield 'value is not set' => [
			'data' => [],
			'key' => 'value',
			'expected' => null,
		];

		yield 'value is not set and will return default value' => [
			'data' => [],
			'key' => 'value',
			'expected' => 'test',
			'default' => 'test',
		];
	}
}