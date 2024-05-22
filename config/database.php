<?php

declare(strict_types=1);

return [
	'name' => env('MYSQL_DATABASE'),
	'username' => env('MYSQL_ROOT_USER'),
	'password' => env('MYSQL_ROOT_PASSWORD'),
	'connection' => env('DB_CONNECTION'),
	'port' => env('MYSQL_PORT'),
	'options' => [
		PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
	],
];

