<?php

declare(strict_types=1);

namespace App\Controllers;

use App\Core\Request;
use App\Exceptions\ValidationException;
use App\Repositories\BookingsRepository;
use App\Services\BookingsService;
use DateTime;

readonly class BookingsController
{
	public function __construct(
		private BookingsRepository $bookingsRepository,
		private BookingsService    $bookingsService,
	)
	{
	}

	public function index(Request $request): mixed
	{
		return view('bookings/index', [
			'bookings' => $this->bookingsRepository->getBookings(),
		]);
	}

	public function conflictingBookings(Request $request): mixed
	{
		$date = $request->get('date');

		if (empty($date)) {
			throw new ValidationException('Date is required');
		}

		$dateTime = DateTime::createFromFormat('Y-m-d', $date);

		if (!$dateTime || $dateTime->format('Y-m-d') !== $date) {
			throw new ValidationException('Invalid date');
		}

		$dateBookings = $this->bookingsRepository->getBookingsByDate($date);

		$conflictingBookings = $this->bookingsService->getConflictingBookings($dateBookings);
		return view('bookings/conflicting_bookings', [
			'date' => $date,
			'conflicts' => $conflictingBookings,
		]);
	}
}