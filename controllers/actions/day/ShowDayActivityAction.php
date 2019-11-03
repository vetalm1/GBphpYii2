<?php


namespace app\controllers\actions\day;


use yii\base\Action;

class ShowDayActivityAction extends Action
{
    public $dayTitle;

    public  function run()
    {

        $model = \Yii::$app->day->getModel();

        if (\Yii::$app->request->isPost){
            $model->load(\Yii::$app->request->post());
            if(\Yii::$app->day->showActivity($model) !==[false]){
                $this->dayTitle='Список активностей на  '.\Yii::$app->day->showActivity($model)['активность1'];
            }
        }


        return $this->controller->render('showDay', ['dayTitle'=>$this->dayTitle, 'model'=>$model]);
    }
}