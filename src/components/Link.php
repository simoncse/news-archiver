<?php

namespace app\components;



class Link
{
    public static function render($url, $title)
    {
        return sprintf(
            '<li><a href="%s" target=" _blank">
            %s
            </a></li>',
            $url,
            $title,
        );
    }
}
