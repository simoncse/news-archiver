<?php

namespace app\components;



class Link
{
    public static function render($url, $title)
    {
        return sprintf(
            '<a href="%s" target=" _blank">
            %s
            </a>',
            $url,
            $title,
        );
    }
}
