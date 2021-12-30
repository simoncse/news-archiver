<?php

namespace app\core;

abstract class BaseRouter
{
    abstract public function resolve();

    public array $routes = [];

    public Request $request;
    public Response $response;

    protected string $BASE_URI = '/';

    public function __construct(string $type = null)
    {
        $this->request = new Request($type);
        $this->response = new Response();

    }

    public function get($path, $callback)
    {
        $this->routes['get'][$path] = $callback;
    }

    public function post($path, $callback)
    {
        $this->routes['post'][$path] = $callback;
    }
}
