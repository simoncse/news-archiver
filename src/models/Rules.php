<?php

namespace app\models;

class Rules
{

    public static function validDate($dateString)
    {
        $dt = \DateTime::createFromFormat("Y-m-d", $dateString);
        return $dt !== false && !array_sum($dt::getLastErrors());
    }
}
