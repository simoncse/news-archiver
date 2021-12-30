<?php

namespace app\core;

class Application
{
    public static string $ROOT_DIR;
    public static string $TIMEZONE = 'UTC';
    public static string $BASE_URL;
    public static string $CONTACT_EMAIL;
    public Router $router;
    public static Application $app;
    public string $layout = 'main';
    public $controller;
    public View $view;

    public function __construct($rootPath, array $config)
    {
        self::$ROOT_DIR = $rootPath;
        self::$BASE_URL = $config['base_url'];
        self::$CONTACT_EMAIL = $config['contact_email'];
        self::$TIMEZONE = Cookie::get('timezone');

        self::$app = $this;
        $this->request = new Request();
        $this->response = new Response();
        $this->router = new Router();
        $this->view = new View();

        Database::connect($config['db']);
    }


    public function run()
    {

        try {
            echo $this->router->resolve();
        } catch (\Exception $e) {
            echo $this->view->renderViewOnly('_error', [
                'exception' => $e,
            ]);
        }
    }

    public function getController()
    {
        return $this->controller;
    }

    public function setController(Controller $controller)
    {
        $this->controller = $controller;
    }
}
