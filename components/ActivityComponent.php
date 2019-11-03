<?php


namespace app\components;

use app\models\Activity;
use yii\base\Component;


class ActivityComponent extends Component
{
    public $modelClass;        //web.php->components->activity
    public function getModel(){
        return new $this->modelClass;
    }

    public function addActivity(Activity $activity): bool //на входе ожидается экземпляр объекта activity и эта функция должна вернуть булево
    {
        if($activity->validate()){
            return true;
        }
        return false;
    }
}