<?php

namespace app\controllers;

use app\core\Controller;
use app\core\Cookie;
use app\core\Request;
use app\core\Response;
use app\models\Context;

class ContextController extends Controller
{







    public function get(Request $request, Response $response)
    {
        $urlParams = $request->getBody();

        $noParams = count($urlParams) == 1;
        if($noParams){
            throw new \InvalidArgumentException('Invalid Input', 400);
            return false;
            
        }

        $context = Context::setDate($urlParams['date'], Cookie::get('timezone'));

        unset($context->earliestDate);
        $response->toJson(['context' => $context]);

        exit;
    }
}
