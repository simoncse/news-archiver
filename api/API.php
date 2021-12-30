<?php

namespace api;
use api\APIRouter;
use app\core\Database;

class API
{
    public APIRouter $router;
    public function __construct($config)
    {
        $this->router = new APIRouter('api');
        Database::connect($config['db']);
    }



    public function run()
    {
        header("Access-Control-Allow-Origin: *");
        header("Content-Type: application/json; charset=UTF-8");

        try {
            $this->router->resolve();
        } catch (\Exception $e) {

            http_response_code(404);
            $this->router->response->errorJson($e);
            exit();
        }
    }
}
