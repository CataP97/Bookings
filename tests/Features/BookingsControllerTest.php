<?php

declare(strict_types=1);

namespace Tests\Features;

use App\Controllers\BookingsController;
use App\Core\Request;
use App\Exceptions\ValidationException;
use App\Repositories\BookingsRepository;
use App\Services\BookingsService;
use Mockery;
use PHPUnit\Framework\TestCase;

class BookingsControllerTest extends TestCase
{
	public function test_conflicting_bookings_will_throw_exception_if_date_not_available(): void
	{
		$bookingsController = new BookingsController(
			Mockery::mock(BookingsRepository::class)->makePartial(),
			Mockery::mock(BookingsService::class)->makePartial(),
		);

		$request = $this->createMock(Request::class);
		$request->expects($this->once())
			->method('get')
			->with('date')
			->willReturn(null);

		$this->expectException(ValidationException::class);
		$this->expectExceptionMessage('Date is required');

		$bookingsController->conflictingBookings($request);
	}

	public function test_conflicting_bookings_will_throw_exception_if_date_is_invalid(): void
	{
		$bookingsController = new BookingsController(
			Mockery::mock(BookingsRepository::class)->makePartial(),
			Mockery::mock(BookingsService::class)->makePartial(),
		);

		$request = $this->createMock(Request::class);
		$request->expects($this->once())
			->method('get')
			->with('date')
			->willReturn('2022-');

		$this->expectException(ValidationException::class);
		$this->expectExceptionMessage('Invalid date');

		$bookingsController->conflictingBookings($request);
	}
}