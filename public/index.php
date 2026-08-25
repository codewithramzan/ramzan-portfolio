<?php

declare(strict_types=1);

define('BASE_PATH', dirname(__DIR__));

$config = require BASE_PATH . '/config/config.php';

date_default_timezone_set($config['timezone']);

define('APP_DEBUG', $config['debug']);

require BASE_PATH . '/app/core/Database.php';
require BASE_PATH . '/app/core/Model.php';
require BASE_PATH . '/app/core/Controller.php';
require BASE_PATH . '/app/core/Router.php';

require BASE_PATH . '/app/controllers/HomeController.php';

$router = new Router();

require BASE_PATH . '/routes/web.php';

$method = $_SERVER['REQUEST_METHOD'];
$uri = $_SERVER['REQUEST_URI'];

try {

    $router->dispatch($method, $uri);

} catch (Throwable $e) {

    if (APP_DEBUG) {
        http_response_code(500);

        echo '<h1>Application Error</h1>';
        echo '<pre>';
        echo htmlspecialchars($e->getMessage());
        echo '</pre>';

    } else {

        http_response_code(500);

        require BASE_PATH . '/app/views/errors/500.php';
    }
}