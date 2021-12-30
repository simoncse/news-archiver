<?php

namespace app\models;

use app\core\Application;
use app\core\Model;

use app\exceptions\NotFoundException;

class Description
{
    public $entry_uid;
    public $timestamp;

    public function __construct($uid, $timestamp)
    {
        $this->entry_uid = $uid;
        $this->timestamp = $timestamp;
    }
}



class Archive extends Model
{
    public Description $description;
    public array $resources = [];
    public static $all = [1,2];


    public function __construct(string $uid, array $channels=[])
    {
        if (empty($channels)) {
            $this->fetchArchive($uid);
        }else {
            $this->fetchArchiveByChannel($uid, $channels);
        }
    }

    private function fetchArchive(string $uid)
    {
        $stmt = $this->prepare("SELECT * FROM webapi.resources(:uid, :timezone);");
        $stmt->bindValue(':uid', $uid);
        $stmt->bindValue(':timezone', Application::$TIMEZONE);
        $stmt->execute();
        $rawData = $stmt->fetch(\PDO::FETCH_ASSOC);

        $jsonData = json_decode($rawData['json']);

        if($jsonData -> entry_uid == false){
            throw new NotFoundException();
            return false;
        }

        $this->description = new Description($jsonData->entry_uid, $jsonData->timestamp);
        $this->resources = $jsonData->resources;

        return $jsonData;
    }

    private function fetchArchiveByChannel(string $uid, array $channels){

        if(!$this->validChannels($channels)){
            throw new NotFoundException();
            return false; 
        }

        if($channels == self::$all){
            return $this->fetchArchive($uid);
        }
        
        $stmt = $this->prepare("SELECT * FROM webapi.resources_by_channels(:uid, 
        :channels::int[], :timezone);");
        $stmt->bindValue(':uid', $uid);
        $stmt->bindValue(':channels', $this->pg_array($channels));
        $stmt->bindValue(':timezone', Application::$TIMEZONE);
        $exec = $stmt->execute();


        $rawData = $stmt->fetch(\PDO::FETCH_ASSOC);

        

        $jsonData = json_decode($rawData['json']);

        if($jsonData -> entry_uid == false){
            throw new NotFoundException();
            return false;
        }

        $this->description = new Description($jsonData->entry_uid, $jsonData->timestamp);
        $this->resources = $jsonData->resources;

        return $jsonData;
    }

    private function pg_array($arr){
        $string_arr = [];

        foreach($arr as $val) {
            array_push($string_arr, (string)$val);
        };

        $main = implode(', ', $string_arr);
        $literal = '{' . $main. '}';
        return $literal;

    }

    private function validChannels(array $channels){
        foreach($channels as $ch){
            if(!in_array($ch, self::$all)){
                return false;
            }
        }
        return true;
    }


}
