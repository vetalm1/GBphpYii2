<?php


namespace app\widgets\AuthForm;


use yii\base\Widget;

class AuthFormWidget extends  Widget
{
    public $title;
    public $model;

    public function run(){
        return $this->render('form', ['title'=>$this->title, 'model'=>$this->model]); //въюху храним тамже где и видлжет в подпапке
    }
}