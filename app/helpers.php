<?php

declare(strict_types=1);

function view(string $name, array $data = [])
{
	extract($data);

	return require __DIR__ . "/../resources/views/{$name}.php";
}

function loadConfig(string $config)
{
	return require "../config/{$config}.php";
}

function env(string $key, mixed $default = null)
{
	return $_SERVER[$key] ?? $default;
}