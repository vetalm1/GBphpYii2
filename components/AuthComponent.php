<?php


namespace app\components;


use app\base\BaseComponent;
use app\models\Users;
use phpDocumentor\Reflection\DocBlock\Tags\Link;
use yii\base\Security;

class AuthComponent extends BaseComponent
{
    public  function  signIn(Users $model):bool /////////////////////////////////////////////
    {
        $model->scenarioSignIn();
        if(!$model->validate(['email', 'password'])){
            return false;
        }

        $user=$this->getUserByEmail($model->email);
        if(!$this->validatePassword($model->password, $user->passwordHash)){
            $model->addError('password', 'Неверный пароль');
            return false;
        }

       return \Yii::$app->user->login($user);
    }

    private function validatePassword($password, $passwordHash ):bool
    {
        return \Yii::$app->security->validatePassword($password, $passwordHash);
    }

    private function  getUserByEmail($email):?Users{
        return Users::find()->andWhere(['email'=>$email])->one();
    }

    public  function  signUp(Users $model):bool ////////////////////////////////////////////
    {
        $model->scenarioSignUp();
        if(!$model->validate(['email', 'password'])) {
            return false;
        }

        $model->passwordHash = $this->genPasswordHash($model->password);
        if($model->save()){ // функция активрекорда, автоматом запускает валидацию
            return true;
        }
        return false;
    }

    private function genPasswordHash(string $password){
        return \Yii::$app->security->generatePasswordHash($password, 13); //сложность
    }
}