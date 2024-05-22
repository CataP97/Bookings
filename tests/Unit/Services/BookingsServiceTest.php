<?php

declare(strict_types=1);

namespace Tests\Unit\Services;

use App\Services\BookingsService;
use PHPUnit\Framework\TestCase;

class BookingsServiceTest extends TestCase
{
	private BookingsService $bookingsService;

	protected function setUp(): void
	{
		$this->bookingsService = new BookingsService();
	}

	public function test_get_conflicting_bookings_no_conflicts(): void
	{
		$bookings = [
			['start_time' => '09:00', 'end_time' => '10:00'],
			['start_time' => '10:00', 'end_time' => '11:00'],
			['start_time' => '11:00', 'end_time' => '12:00'],
		];

		$conflicts = $this->bookingsService->getConflictingBookings($bookings);

		$this->assertEmpty($conflicts);
	}

	public function test_get_conflicting_bookings_with_conflicts(): void
	{
		$bookings = [
			['start_time' => '09:00', 'end_time' => '10:00'],
			['start_time' => '09:30', 'end_time' => '10:30'],
			['start_time' => '10:15', 'end_time' => '11:15'],
			['start_time' => '11:00', 'end_time' => '12:00'],
		];

		$conflicts = $this->bookingsService->getConflictingBookings($bookings);

		$this->assertCount(3, $conflicts);

		$this->assertEquals([$bookings[0], $bookings[1]], $conflicts[0]);
		$this->assertEquals([$bookings[1], $bookings[2]], $conflicts[1]);
		$this->assertEquals([$bookings[2], $bookings[3]], $conflicts[2]);
	}

	public function test_get_conflicting_bookings_empty_array(): void
	{
		$bookings = [];

		$conflicts = $this->bookingsService->getConflictingBookings($bookings);

		$this->assertEmpty($conflicts);
	}
}