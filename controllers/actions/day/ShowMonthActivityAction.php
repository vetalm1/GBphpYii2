<?php


namespace app\controllers\actions\day;


use yii\base\Action;
use app\components\DayComponent;
use app\components\DAOComponent;
class showMonthActivityAction extends Action
{
    public $monthTitle;
    public $calendar;
    private $dao;
    public $month;
    public $year;
    public $activity;
    public $ActivityCurrentDay;

    public  function run()
    {
        $this->dao = \Yii::$app->dao;
        $this->activity = $this->dao->getAnyActivity(3, date('Y-m-d'));
        $this->ActivityCurrentDay = $this->dao->getActivityCurrentDay(date('Y-m-d'));

        // просмотр активностей выбранного дня до 10 шт.
        if(\Yii::$app->request->get('date')) {
            $this->activity = $this->dao->getActivityOnDate(10, \Yii::$app->request->get('date'));
            $this->monthTitle='Список активностей на '.
                               date('d.m.Y',strtotime (\Yii::$app->request->get('date')));
            return $this->controller->render('showActivityOnDate', [
                'dayTitle'=>$this->dayTitle,
                'activity'=>$this->activity
            ]);
        }
        // сменить месяц
        if(\Yii::$app->request->get('changeMonth')) {
           $this->month =date('n' , strtotime(\Yii::$app->request->get('changeMonth')));
           $this->year =date('Y' , strtotime(\Yii::$app->request->get('changeMonth')));
           $this->calendar = \Yii::$app->day->generateCalendar($this->month , $this->year);
        } else {

            // вывод календаря
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