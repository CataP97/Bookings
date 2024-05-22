<?php

declare(strict_types=1);

namespace App\Services;

class BookingsService
{
	public function getConflictingBookings(array $bookings): array
	{
		$conflicts = [];

		for ($i = 0, $iMax = count($bookings) - 1; $i < $iMax; $i++) {
			for ($j = $i + 1, $jMax = count($bookings); $j < $jMax; $j++) {
				if ($bookings[$i]['end_time'] > $bookings[$j]['start_time']) {
					$conflicts[] = [$bookings[$i], $bookings[$j]];
				}
			}
		}


		return $conflicts;
	}
}