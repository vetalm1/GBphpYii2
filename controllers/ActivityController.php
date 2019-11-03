<?php


namespace app\controllers;

use app\base\BaseController;
use app\controllers\actions\activity\CreateAction;


class ActivityController extends BaseController
{
    public function actions(){
        return [
            'create'=> ['class'=>CreateAction::class, 'name'=>'Сергей'], //Это чтобы не прямо из этого класса запускался какой либо экшн, как закомичино снизу,
            'new'=> ['class'=>CreateAction::class, 'name'=>'Виталий'] // а чтобы из отдельного файла CreateAction.php,  CreateAction::class это тоже самое что app\controllers\actions\activity\CreateAction
        ];                  //т.е. мы сдесь можем прописать какие настройки в какой файл передать, вместо того чтобы отдельными функциями описывать action-ы
    }

//    public function actionCreate ()
//    {
//        return $this->render('create');
//    }
}