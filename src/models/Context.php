<?php

namespace app\models;

use app\core\Application;
use app\core\Model;
use app\exceptions\NotFoundException;

class Context extends Model
{

    public $date;
    public $earliestDate;
    public array $timeslots = [];


    public function __construct(string $dateString = '', string $timezone)
    {
        $newEntries = [];
        if (empty($dateString)) {
            $newEntries = $this->latestDate($timezone);
            $this->earliestDate = $newEntries['earliest_date'];
        } else {

            $newEntries = $this->getDate($dateString, $timezone);
            if ($newEntries == false) {
                throw new \Exception("No entries at this date", 404);
                return false;
            }
        }

        $this->date = $newEntries['full_date'];
        $this->loadTimeSlots($newEntries['time_slots']);
    }


    public static function defaultDate(string $timezone)
    {
        return new Context('', $timezone);
    }

    public static function setDate(string $dateString, string $timezone)
    {
        if (!Rules::validDate($dateString)) {
            throw new \InvalidArgumentException('Invalid Input', 400);
            return false;
        }
        return new Context($dateString, $timezone);
    }





    private function getDate($dateString, $tz)
    {
        $stmt = $this->prepare("SELECT * FROM webapi.get_context(:date, :timezone)");
        $stmt->bindValue(':date', $dateString);
        $stmt->bindValue(':timezone', $tz);
        $stmt->execute();

        return $stmt->fetch(\PDO::FETCH_ASSOC);
    }



    private function latestDate($timezone): array
    {
        $stmt = $this->prepare("SELECT * FROM webapi.context(:timezone)");
        $stmt->bindValue(':timezone', $timezone);
        $stmt->execute();
        return $stmt->fetch(\PDO::FETCH_ASSOC);
    }

    private function loadTimeSlots(string $timeslots)
    {
        $arr = json_decode($timeslots, true);
        $this->timeslots = $arr;
        // echo '<div class="code"><pre>';
        // var_dump($this->results->data);
        // echo '</pre></div>';
        // exit;
    }

    public function latest_entry()
    {
        return end($this->timeslots)['entry_uid'];
    }
}
