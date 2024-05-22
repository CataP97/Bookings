<?php

declare(strict_types=1);

namespace App\Core;

use Exception;
use PDO;
use PDOException;

class Database
{
	public static function connection(array $config): PDO
	{
		try {
			return new PDO(
				"mysql:host={$config['connection']};port={$config['port']};dbname={$config['name']}",
				$config['username'],
				$config['password'],
				$config['options'],
			);
		} catch (PDOException $e) {
			throw new Exception('Connection details incorrect. Details: ' . $e->getMessage());
		}
	}
}