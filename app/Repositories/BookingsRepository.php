<?php

declare(strict_types=1);

namespace App\Repositories;

class BookingsRepository extends BaseRepository
{
	public function getBookings(): array
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
        SQL;

		return $this->fetchAll($query);
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