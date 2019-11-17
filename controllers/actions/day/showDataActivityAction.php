<?php


namespace app\controllers\actions\day;


use yii\base\Action;
use yii\web\Controller;

class showDataActivityAction extends Action
{
    public $param;
    public $dayTitle;
    public $calendar;
    private $dao;
    public $activity;
    public $ActivityCurrentDay;

    public  function run()
    {
        $this->dao = \Yii::$app->dao;
        $this->activity = $this->dao->getAnyActivity(3, date('Y-m-d'));
       // $this->param = \Yii::$app->request->queryString;
        $this->ActivityCurrentDay = $this->dao->getActivityCurrentDay($this->param);//date('Y-m-d', $this->param));

        // вывод календаря
        $month = date('n', time());
        $year = date('Y', time());
        $this->calendar = \Yii::$app->day->showCalendar($month , $year);

        $model = \Yii::$app->day->getModel();


//        if (\Yii::$app->request->isPost){
//            $model->load(\Yii::$app->request->post());
//            if(\Yii::$app->day->showActivity($model) !==[false]){
//                $this->dayTitle='Список активностей на дату '.\Yii::$app->day->showActivity($model)['активность1'];
//            }
//        }

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