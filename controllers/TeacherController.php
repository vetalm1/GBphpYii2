<?php


namespace app\controllers;


use yii\web\Controller;

class TeacherController extends Controller
{
    public function actionStudent(){
        return $this->render('student', ['name'=>'Сергей', 'name2'=>'Vlad']);
    }
}