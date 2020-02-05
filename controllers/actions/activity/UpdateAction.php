<?php


namespace app\controllers\actions\activity;


use yii\base\Action;
use yii\bootstrap\ActiveForm;
use yii\web\HttpException;
use yii\web\Response;

class UpdateAction extends Action
{

    public function run(){

        if(!\Yii::$app->rbac->canCreateActivity()) {  // проверяем что пользователь может создавать активность
            throw new  HttpException(403, 'Not Auth Action');
        }

        $model = \Yii::$app->activity->getModel();

        if (\Yii::$app->request->isPost){
            $model->load(\Yii::$app->request->post());

            if(\Yii::$app->request->isAjax){
                \Yii::$app->response->format=Response::FORMAT_JSON;
                return ActiveForm::validate($model);
            }

            if(\Yii::$app->activity->addActivity($model)){
                return $this->controller->redirect(['/activity/view', 'id'=>$model->id]);
            }

        }


    }

}