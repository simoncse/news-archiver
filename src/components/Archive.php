<?php

namespace app\components;

use app\core\Application;

class Archive
{

    public function __construct($results)
    {
        // $this > renderLinks($results->contents);
    }

    public static function begin($title, $date)
    {
        echo sprintf(
            '<li class="archive">
                    <h2 class="archive__source">%s
                    </h2>
                    <span class="archive__date">%s</span>
                    <div class="archive__content row">
                    ',
            $title,$date
        );
    }

    public static function end()
    {
        echo '
        </div>
        </li>';
    }

    public static function renderLinks($results)
    {

        echo ' <ul class="links-group">
                <h3> Links:</h3>';
        foreach ($results as $result) {

            echo Link::render($result->url, $result->title);
        }

        echo '</ul>';
    }

    public static function renderScreenshot($filename, $channel_id)
    {

        echo sprintf(
            '<div class="archive__screenshot %s">
            <img src="%s" alt="%s" class=""> 
            </div>',
            self::addCSS($channel_id) ?? '',
            Application::$BASE_URL . '/screenshots/' . $filename,
            $filename
        );
    }

    private static function addCSS($channel_id)
    {
        if ($channel_id == 1) {
            return 'resize-fox';
        }elseif($channel_id == 2 ){
            return 'resize-cnn';
        }

        return false;
    }
}
