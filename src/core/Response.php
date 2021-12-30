<?php

namespace app\core;

class Response
{


    public function setStatusCode(int $code)
    {
        http_response_code($code);
    }


    public function configToAPI()
    {
    }

    public function toJson($data)
    {
        echo json_encode($data);
    }

    public function errorJson($e)
    {
        
        $this->setStatusCode($e->getCode());
        $this->toJson(
            [
                'message' => $e->getMessage(),
                'code' => $e->getCode()
            ]
        );
    }
}
