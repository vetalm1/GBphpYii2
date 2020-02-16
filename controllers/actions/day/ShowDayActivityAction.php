<?php


namespace app\controllers\actions\day;


use yii\base\Action;
use app\components\DayComponent;
use app\components\DAOComponent;
class ShowDayActivityAction extends Action
{
    public $dayTitle;
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

        if(\Yii::$app->request->get('date')) {  // если нет date возвращает null, а аэто false
            $this->activity = $this->dao->getActivityOnDate(10, \Yii::$app->request->get('date'));
            $this->dayTitle='Список активностей на '.date('d.m.Y',strtotime ( \Yii::$app->request->get('date')));
            return $this->controller->render('showActivityOnDate', [
                'dayTitle'=>$this->dayTitle,
                'activity'=>$this->activity
            ]);
        }

//        if(\Yii::$app->request->get('month')) {
//           $this->month =\Yii::$app->request->get('month');
//        } else {$this->month = date('n', time());}

        // вывод календаря
        $this->month = date('n', time());
        $this->year = date('Y', time());
        $this->calendar = \Yii::$app->day->showCalendar($this->month , $this->year);

        return $this->controller->render('showDay',
            [
                'month'=>$this->month,
                'dayTitle'=>$this->dayTitle,
                'calendar'=>$this->calendar,
                'activity'=>$this->activity,
                //'model'=>$model,
                'ActivityCurrentDay'=>$this->ActivityCurrentDay
            ]);
    }
}