<?php

declare(strict_types=1);

use App\Controllers\BookingsController;
use App\Core\Router;

Router::get('', BookingsController::class, 'index');

Router::get('conflicting-bookings', BookingsController::class, 'conflictingBookings');