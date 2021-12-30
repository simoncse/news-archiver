<?php

namespace app\core;

class Model
{


    public function prepare($sql)
    {
        return Database::prepare($sql);
    }

    public function validate()
    {
    }
}
