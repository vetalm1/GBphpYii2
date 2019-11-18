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
    public $activity;
    public $ActivityCurrentDay;

    public  function run()
    {
        $this->dao = \Yii::$app->dao;
        $this->activity = $this->dao->getAnyActivity(3, date('Y-m-d'));
        $this->ActivityCurrentDay = $this->dao->getActivityCurrentDay(date('Y-m-d'));

        $model = \Yii::$app->day->getModel();

        // вывод календаря
        $month = date('n', time());
        $year = date('Y', time());
        $this->calendar = \Yii::$app->day->showCalendar($month , $year);

        if (\Yii::$app->request->isPost){
            $model->load(\Yii::$app->request->post());
            if(\Yii::$app->day->showActivity($model) !==[false]){
                $this->activity =[];
                $this->dayTitle='Список активностей на дату '.\Yii::$app->day->showActivity($model)['date'];
                $this->activity = $this->dao->getActivityOnDate(3, \Yii::$app->day->showActivity($model)['date']);
                return $this->controller->render('showActivityOnDate', [
                    'dayTitle'=>$this->dayTitle,
                    'activity'=>$this->activity
                ]);
            }
        }

        return $this->controller->render('showDay',
            [
                'dayTitle'=>$this->dayTitle,
                'calendar'=>$this->calendar,
                'activity'=>$this->activity,
                'model'=>$model,
                'ActivityCurrentDay'=>$this->ActivityCurrentDay
            ]);
    }
}