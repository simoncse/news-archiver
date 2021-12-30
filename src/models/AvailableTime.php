<?php

namespace app\models;

use app\core\Model;

class AvailableTime extends Model
{

    public array $timeslot = [];

    public function __construct(string $date)
    {
        $this->timeslot = $this->getTimes($date);
        echo '<div class="code"><pre>';
        var_dump($this->timeslot);
        echo '</pre></div>';
        // exit;
    }

    private function getTimes(string $date)
    {
        $statement = self::prepare("SELECT * FROM dates_and_times WHERE date = :date;");
        $statement->bindValue(':date', $date);
        $statement->execute();
        return $statement->fetch(\PDO::FETCH_ASSOC);
    }
}
