<?php


namespace app\controllers;

use app\base\BaseController;
use app\controllers\actions\activity\CreateAction;
use app\models\Activity;
use app\models\ActivitySearch;
use yii\web\HttpException;



class ActivityController extends BaseController
{
    public function actions(){
        return [
            'create'=> ['class'=>CreateAction::class, 'name'=>'Новая активность'], //Это чтобы не прямо из этого класса запускался какой либо экшн, как закоминчино снизу,
            'editActivity'=> ['class'=>CreateAction::class, 'name'=>'Редактировать Активность'] // а чтобы из отдельного файла CreateAction.php,  CreateAction::class это тоже самое что app\controllers\actions\activity\CreateAction
        ];                  //т.е. мы здесь можем прописать какие настройки в какой файл передать, вместо того чтобы отдельными функциями описывать action-ы
    }



    public function actionIndex(){
        $model=new ActivitySearch();
        $provider=$model->search(\Yii::$app->request->getQueryParams());
        return $this->render('index', ['model'=>$model, 'provider'=>$provider]);
    }

    public function actionUpdate($id){
        $model = Activity::findOne($id);
        if ($model->load(\Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }
        return $this->render('update', ['model' => $model,]);
    }

    public function actionView($id){
        $model=Activity::findOne($id);

        if(!\Yii::$app->rbac->canViewActivity($model)){
            throw new HttpException(403, 'Not access to activity');
        }
        if(!$model){
            throw new HttpException(404 , 'activity no found');
        }
        return $this->render('view', ['model'=>$model]);
    }

}