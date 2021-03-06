<?php

ini_set('display_errors', 'Off');
ini_set('log_errors', 'On');



if (!isset($_COOKIE['timezone'])) {
    echo "<html><head> <script src='/assets/timezone.js'></script>";
}




use app\controllers\SiteController;
use app\core\Application;

require_once __DIR__ . '/../vendor/autoload.php';
$dotenv = Dotenv\Dotenv::createImmutable(dirname(__DIR__));
$dotenv->load();


$config = [
    'db' => [
        'dsn' => $_ENV['DB_DSN'],
        'user' => $_ENV['DB_USER'],
        'password' => $_ENV['DB_PASSWORD'],
    ],
    'contact_email'=>$_ENV['CONTACT_EMAIL'],
    'base_url' => $_SERVER['REQUEST_SCHEME'] .'://'. $_SERVER['HTTP_HOST']
];

$ROOT_DIR = dirname(__DIR__)."/src";

$app = new Application($ROOT_DIR, $config);


$app->router->get('/', [SiteController::class, 'home']);
$app->router->get('/entry', [SiteController::class, 'handleEntry']);

$app->router->get('/contact', [SiteController::class, 'contact']);
$app->router->post('/contact', [SiteController::class, 'handleContact']);


$app->router->get('/development', [SiteController::class, 'dev']);
$app->router->get('/about', [SiteController::class, 'about']);



$app->run();
