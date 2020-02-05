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

        $model = \Yii::$app->day->getModel();

        if(\Yii::$app->request->get('date')) {  // если нет date возвращает null, а аэто false
            $this->activity = $this->dao->getActivityOnDate(10, \Yii::$app->request->get('date'));
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
                'month'=>$this->month,
                'dayTitle'=>$this->dayTitle,
                'calendar'=>$this->calendar,
                'activity'=>$this->activity,
                'model'=>$model,
                'ActivityCurrentDay'=>$this->ActivityCurrentDay
            ]);
    }
}