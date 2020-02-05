<?php


namespace app\components;
use app\models\Activity;
use yii\base\Component;
use yii\console\Application;
use yii\mail\MailerInterface;
class NotificationComponent extends Component
{
    /** @var MailerInterface */
    private $mailer;
    public function getMailer(){
        return $this->mailer;
    }
    public function init()
    {
        parent::init();
        $this->mailer=\Yii::$app->mailer;
    }
    /**
     * @param Activity[] $activity
     */
    public function sendNotifications(array $activity)
    {
        foreach ($activity as $activity){
            $send=$this->getMailer()->compose('notif',['model'=>$activity])
                ->setSubject('Активность '.$activity->id.' стартует сегодня')
                ->setFrom('vetalm1982@yandex.ru')
                ->setReplyTo('reply@yandex.ru')
                ->setTo($activity->email)
                ->send();
            if(!$send){
                if(\Yii::$app instanceof Application){
                    echo 'Error email send '.$activity->email;
                }
                return false;
            }
            if(\Yii::$app instanceof Application){
                echo 'Email send '.$activity->email.PHP_EOL;
            }
        }
    }
}
