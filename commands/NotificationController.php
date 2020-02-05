<?php


namespace app\commands;

use app\components\NotificationComponent;
use yii\console\Controller;
use yii\helpers\Console;
class NotificationController extends Controller
{
    public $name;
    public function options($actionID)
    {
        return ['name'];
    }
    public function optionAliases()
    {
        return [
            'n' => 'name'
        ];
    }
    public function actionTest(...$args){
        echo 'test action ' . $this->name . PHP_EOL;
        print_r($args);
    }
    public function actionSendTodayActivity(){
        $activities=\Yii::$app->activity->findTodayNotifActivity();
        if(count($activities)==0){
            \Yii::$app->end(0);
        }

        /** @var NotificationComponent $notif */
        $notif=\Yii::createObject(NotificationComponent::class);
        echo Console::ansiFormat('Count activity:'.count($activities),[Console::FG_GREEN]).PHP_EOL;
        $notif->sendNotifications($activities);
    }
}