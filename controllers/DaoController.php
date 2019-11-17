<?php
namespace app\controllers;
use app\base\BaseController;
use app\components\DAOComponent;
class DaoController extends BaseController
{
    /** @var DAOComponent */
    private $dao;
    public function __construct($id, $module, $config = [])
    {
        $this->dao=\Yii::$app->dao;
        parent::__construct($id, $module, $config);
    }
    public function actionTest($email=''){
        //$this->dao->insertTransactions();
        $users=$this->dao->getUsersList();
        $activityUser=$this->dao->getActivityUser($email);
        $activity=$this->dao->getActivity();
        $count=$this->dao->getCountActivity();
        $reader=$this->dao->getActivityReader();
        return $this->render('test',[
            'users'=>$users,
            'activityUser'=>$activityUser,
            'activity'=>$activity,
            'count'=>$count,
            'reader'=>$reader]);
    }
}