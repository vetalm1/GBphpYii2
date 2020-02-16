<?php


namespace app\controllers\actions\day;


use yii\base\Action;
use app\components\DayComponent;
use app\components\DAOComponent;
class showMonthActivityAction extends Action
{
    public $monthTitle;
    public $calendar;
    public $month;
    public $year;
    public $activity;
    public $ActivityCurrentDay;

    public  function run()
    {
        // сменить месяц
        if(\Yii::$app->request->get('changeMonth')) {
           $this->month =date('n' , strtotime(\Yii::$app->request->get('changeMonth')));
           $this->year =date('Y' , strtotime(\Yii::$app->request->get('changeMonth')));
           $this->calendar = \Yii::$app->day->generateCalendar($this->month , $this->year);
        } else {

            // вывод календаря текущий
            $this->month = date('n', time());
            $this->year = date('Y', time());
            $this->calendar = \Yii::$app->day->generateCalendar($this->month, $this->year);
        }

        return $this->controller->render('showActivityMonth',
            [
                'month'=>\Yii::$app->day->monthFullName($this->month),
                'dayTitle'=>$this->monthTitle,
                'calendar'=>$this->calendar,
                'activity'=>$this->activity,
                //'model'=>$model,
                'ActivityCurrentDay'=>$this->ActivityCurrentDay
            ]);
    }
}