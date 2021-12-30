<?php

namespace api;

use app\core\BaseRouter;
use \Exception;

class APIRouter extends BaseRouter
{



    public function resolve()
    {

        $path = $this->request->getPath();

        
        if($path ==""){
            $path ='/';
        }

        $method = $this->request->method();

        $callback = $this->routes[$method][$path] ?? false;



        if ($callback === false) {
            throw new \Exception('Unknown endpoint', 404);
            return false;
        }

        if (is_array($callback)) {
            $callback[0] = new $callback[0]();
        }

        return call_user_func($callback, $this->request, $this->response);
    }
}
