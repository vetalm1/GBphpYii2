<?php


namespace app\controllers\actions\activity;

use app\components\ActivityComponent;
use app\models\Activity;
use yii\base\Action;
use yii\bootstrap\ActiveForm;
use yii\web\HttpException;
use yii\web\Response;

class CreateAction extends Action
{
    public $name;
    private $dao;

    public  function run()
    {
        // проверяем что пользователь может создавать активность
        if(!\Yii::$app->rbac->canCreateActivity()) {
            throw new  HttpException(403, 'Not Auth Action');
        }

        //$model = new Activity();  //-без Юи было так
        // в фреймворке нужно так создавать экземпляр, а не как сверху.
        $model = \Yii::$app->activity->getModel();
        $this->dao = \Yii::$app->dao;


        if (\Yii::$app->request->isPost){  // проверка существует ли пост запрос, забыть про $_POST в фреймворках :))
            $model->load(\Yii::$app->request->post()); // наполнение модели, атрибут который в правилах не объявлен, через функцию load не наполняется

            if(\Yii::$app->request->isAjax){  //если получен аякс запрос (это процесс валидации)
                \Yii::$app->response->format=Response::FORMAT_JSON; //указываем чтобы отдал в формате json
                return ActiveForm::validate($model); //функция валидейт в активформ возвращает массив, а нужен json, потому см. выше
            }

            if(\Yii::$app->activity->addActivity($model)){
//                   //$this->name=$model->title;
//                print_r($model->getErrors());
                return $this->controller->redirect(['/activity/view', 'id'=>$model->id]);
            }

        }

        return $this->controller->render('create', ['name'=>$this->name, 'model'=>$model]);
    }
}