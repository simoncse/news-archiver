<?php

namespace app\core;

class Request

{

    private string $BASE_URI;

    public function __construct(string $type = null)
    {
        if($type='api'){
            $this->BASE_URI = 'api';
        }else {
            $this->BASE_URI = '/';

        }
    }

    public function getPath()
    {

        $path = $_SERVER['REQUEST_URI'] ?? '/';


        if($this->BASE_URI != "/"){
            $pattern = '/'.'\/'.$this->BASE_URI.'/';

            $path = preg_replace($pattern, '', $path, 1);

        }


        $position = strrpos($path, '?');


        if ($position === false) {
            return $path;
        }

        return substr($path, 0, $position);
    }

    public function method()
    {
        return strtolower($_SERVER['REQUEST_METHOD']);
    }

    public function isGet()
    {
        return $this->method() === 'get';
    }

    public function isPost()
    {
        return $this->method() === 'post';
    }


    public function getBody()
    {
        $body = [];
        $getFilter = array('channels'  =>  array('filter'  => FILTER_VALIDATE_INT,
        'flags'     => FILTER_REQUIRE_ARRAY));

        if ($this->method() === 'get') {
            foreach ($_GET as $key => $value) {
                if(is_array($value)){
                    $body[$key] = filter_input_array(INPUT_GET, $getFilter)[$key];
                    continue;
                    
                }
                $body[$key] = filter_input(INPUT_GET, $key, FILTER_SANITIZE_SPECIAL_CHARS);
            }
        }

        if ($this->method() === 'post') {
            foreach ($_POST as $key => $value) {
                $body[$key] = filter_input(INPUT_POST, $key, FILTER_SANITIZE_SPECIAL_CHARS);
            }
        }

        return $body;
    }

    public static function checkArrayKeyExist($arr) {
        foreach ($arr as $key => $value) {
            if (!strlen($arr[$key])) {
                return false;
            }
        }
        return true;
    }

    public static function useHtmlSpecialChar($arr) {
        $new_arr=[];
        foreach ($arr as $key => $value) {
            $new_arr[$key] = htmlspecialchars($value);
        }
        return $new_arr;
    }
}
