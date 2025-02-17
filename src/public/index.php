<?php declare(strict_types = 1);

use App\controllers\HomeController;
use App\core\Router;

require_once __DIR__ . '/../../vendor/autoload.php';

$router = new Router(dirname(__DIR__));

// Setup route part
$router->get('/', [HomeController::class, 'index']);

// Running program part
$router->run();