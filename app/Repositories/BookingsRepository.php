<?php

declare(strict_types=1);

namespace App\Repositories;

class BookingsRepository extends BaseRepository
{
	public function getBookings(int $pageSize, int $skipRecords): array
	{
		$query = <<<SQL
            SELECT 
                id, 
                patient_id, 
                date, 
                start_time, 
                end_time, 
                comment 
            FROM 
                bookings 
            ORDER BY 
                date, start_time
            LIMIT :pageSize, :skipRecords
        SQL;

		return $this->fetchAll($query, [
			'pageSize' => $pageSize,
			'skipRecords' => $skipRecords,
		]);
	}

	public function patientHasConflicts(int $patientId, string $date, string $startTime, string $endTime): bool
	{
		$query = <<<SQL
			SELECT 1 
			FROM bookings
			WHERE DATE = :date 
			AND bookings.patient_id = :patientId
			AND bookings.start_time < :endTime AND bookings.end_time > :startTime
			LIMIT 1
		SQL;

		return $this->exists($query, [
			'date' => $date,
			'patientId' => $patientId,
			'startTime' => $startTime,
			'endTime' => $endTime,
		]);
	}

	public function getBookingsByDate(string $date): array
	{
		$query = <<<SQL
            SELECT 
                start_time, 
                end_time, 
                comment, 
                patients.name AS patient_name, 
                patients.phone AS patient_phone
            FROM 
                bookings
            JOIN 
                patients ON patients.id = bookings.patient_id
            WHERE 
                date = :date
            ORDER BY 
                date, start_time
        SQL;

		return $this->fetchAll($query, ['date' => $date]);
	}
}