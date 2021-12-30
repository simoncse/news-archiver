<?php

namespace app\exceptions;


class NotFoundException extends \Exception
{
    protected $message = 'Page not found';
    protected $code = 404;

    public $json_error = ['messages' => 'Resources do not exist. Please try a valid URI.'];
}
