<?php


namespace app\controllers;


use app\models\Users;
use yii\web\Controller;

class AuthController extends Controller
{
    private $auth;
    public function  __construct($id, $module, $config = [])
    {
        parent::__construct($id, $module, $config);
        $this->auth=\Yii::$app->auth;
    }

    /** "мфк AuthComponent */

    public function actionSignUp(){
        $model = new Users();

        if(\yii::$app->request->isPost) {
            $model->load(\Yii::$app->request->post());

            if($this->auth->signUp($model)){
                return $this->redirect(['/auth/sign-in']);
            }
        }

        return $this->render('signup', ['model'=>$model]);
    }

    public function actionSignIn(){
        $model = new Users();

        if(\yii::$app->request->isPost) {
            $model->load(\Yii::$app->request->post());

            if($this->auth->signIn($model)){
                return $this->redirect(['/day/showDayActivity']);
            }
        }

        return $this->render('signin', ['model'=>$model]);
    }
}