<?php

namespace app\components;

use app\models\Day;
use yii\base\Component;

class DayComponent extends Component
{
    public $storageOfActivity;
    public $modelClass;        //web.php->components->day

    public function getModel(){
        return new $this->modelClass;
    }

    public function showActivity(Day $day): array
    {
        if($day->validate()){
            $this->storageOfActivity = $this->findActivity($day->date);
            return $this->storageOfActivity;
        }
        return [false];
    }

    public function findActivity($date){
        return ['активность1'=>$date];
    }
}