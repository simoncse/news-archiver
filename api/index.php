<?php



ini_set('display_errors', 'Off');
ini_set('log_errors', 'On');

use api\API;
use app\controllers\ContextController;

require_once __DIR__ . '/../vendor/autoload.php';
$dotenv = Dotenv\Dotenv::createImmutable(dirname(__DIR__));
$dotenv->load();



$config = [
    'db' => [
        'dsn' => $_ENV['DB_DSN'],
        'user' => $_ENV['DB_USER'],
        'password' => $_ENV['DB_PASSWORD'],
    ]
];


$api = new API($config);
$api->router->get('/', [ContextController::class, 'get']);

$api->run();
