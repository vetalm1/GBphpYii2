<?php


namespace app\base;


use yii\web\Controller;

class BaseController extends Controller
{

    public function beforeAction($action)
    {
        $this->view->params['lastPage'] = \Yii::$app->session->get('lastPage'); // забираем из session lastPage ссылку и кладем ее в params['lastPage'],
                                                                                    // затем она становится видна в main.php также в params['lastPage'] строка 69
                                                                                    // чтобы заработало и на других страницах, отнаследуемся от  baseController в siteController
        return parent::beforeAction($action);
    }

    public function afterAction($action, $result) // после того как отрендерилась страница но еще не ушла клиенту срабатывает эта функция
    {
        \Yii::$app->session->set('lastPage', \Yii::$app->request->url); // в переменной session свойству lastPage присваиваем текущую ссылку
        return parent::afterAction($action, $result);
    }

}