<?php

declare(strict_types=1);

use App\Core\Request;
use App\Core\Router;
use Dotenv\Dotenv;

require __DIR__ . '/../vendor/autoload.php';

Dotenv::createImmutable(__DIR__ . '/../')->load();

require_once __DIR__ . '/../bootstrap/app.php';

loadConfig('routes');

Router::doAction(Request::uri(), Request::method());