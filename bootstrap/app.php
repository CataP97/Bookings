<?php

declare(strict_types=1);

use App\Controllers\BookingsController;
use App\Core\Database;
use App\Core\ServiceContainer;
use App\Repositories\BookingsRepository;
use App\Services\BookingsService;

ServiceContainer::bind('database', Database::connection(loadConfig('database')));

ServiceContainer::bind(
	BookingsRepository::class,
	static fn() => new BookingsRepository(ServiceContainer::get('database')),
);

ServiceContainer::bind(BookingsService::class, static fn() => new BookingsService());

ServiceContainer::bind(BookingsController::class, static fn() => new BookingsController(
	ServiceContainer::get(BookingsRepository::class),
	ServiceContainer::get(BookingsService::class),
));