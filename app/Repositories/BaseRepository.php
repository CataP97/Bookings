<?php

declare(strict_types=1);

namespace App\Repositories;

use PDO;
use PDOException;

abstract class BaseRepository
{
	public function __construct(private readonly PDO $pdo)
	{
	}

	public function fetchAll(string $query, array $parameters = []): array
	{
		try {
			$stmt = $this->pdo->prepare($query);
			$stmt->execute($parameters);
			return $stmt->fetchAll(PDO::FETCH_ASSOC);
		} catch (PDOException $e) {
			error_log($e->getMessage());

			return [];
		}
	}

	public function exists(string $query, array $parameters = []): bool
	{
		return count($this->fetchAll($query, $parameters)) > 1;
	}
}