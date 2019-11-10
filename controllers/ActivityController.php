<?php


namespace app\controllers;

use app\base\BaseController;
use app\controllers\actions\activity\CreateAction;


class ActivityController extends BaseController
{
    public function actions($param = null){
        return [
            'create'=> ['class'=>CreateAction::class, 'name'=>'Новая активность'], //Это чтобы не прямо из этого класса запускался какой либо экшн, как закоминчино снизу,
            'editActivity'=> ['class'=>CreateAction::class, 'name'=>'Редактировать Активность'] // а чтобы из отдельного файла CreateAction.php,  CreateAction::class это тоже самое что app\controllers\actions\activity\CreateAction
        ];                  //т.е. мы здесь можем прописать какие настройки в какой файл передать, вместо того чтобы отдельными функциями описывать action-ы
    }

//    public function actionCreate ()
//    {
//        return $this->render('create');
//    }
}