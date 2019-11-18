<?php
namespace app\components;
use yii\base\Component;
use yii\db\Connection;
use yii\db\Exception;
use yii\db\Query;
class DAOComponent extends Component
{
    private function getConnection(): Connection
    {
        return \Yii::$app->db;
    }

    public function getAnyActivity($num, $date){
        $query=new Query();
        $record=$query->from('activity')
                      ->limit($num)
                      ->andWhere('dateStart>:date', [':date' => $date])
                      ->createCommand()->query();
        return $record;
    }

    public function getActivityOnDate($num, $date){
        $query=new Query();
        $record=$query->from('activity')
            ->limit($num)
            ->andWhere('dateStart=:date', [':date' => $date])
            ->createCommand()->query();
        return $record;
    }

    public function getActivityCurrentDay($date){
        $query=new Query();
        $record=$query->from('activity')
                      ->select('*')
                      ->andWhere('dateStart=:date', [':date' => $date]) //подготовка
                       ->createCommand()->query();
        return $record;

    }

    public function saveToDb($title, $dateStart, $isBlocked, $userId){
        $this->getConnection()->createCommand()
            ->insert('activity',['title'=>$title, 'dateStart'=>$dateStart, 'isBlocked'=>$isBlocked, 'userId'=>$userId,])
            ->execute();
    }

    public function getUsersList(): ?array
    {
        $sql='select * from users;';
        return $this->getConnection()->createCommand($sql)->queryAll();
    }
    public function getActivityUser($email):?array {
        $sql='select * from activity where userId=:user';
        return $this->getConnection()->createCommand($sql,[':user'=>$email])->queryAll();
    }
    public function getActivity(){
        $query=new Query();
        $record=$query->from('activity')
            ->select('*')
            ->andWhere(['isBlocked'=>1])
//            ->andWhere('is=:userd',[':userd' => 3])
            ->limit(2)
            ->orderBy(['dateStart'=>SORT_DESC])
            ->one($this->getConnection());
//        ->createCommand()->rawSql;
        return $record;
    }
    public function getCountActivity(){
        $query=new Query();
        $record=$query->from('activity')
            ->select('count(id)')
            ->scalar($this->getConnection());
        return $record;
    }
    public function getActivityReader(){
        $query=new Query();
        $record=$query->from('activity')
            ->createCommand()->query();
        return $record;
    }
    public function insertTransactions(){
        $trans=$this->getConnection()->beginTransaction();
        try{
            $i=$this->getConnection()->createCommand()
                ->insert('activity',['title'=>'new1','userID'=>1,'dateStart'=>date('Y-m-d')])
                ->execute();
//            throw new Exception('er');
            $this->getConnection()->createCommand()
                ->update('activity',['title'=>'update1'],['id'=>1])
                ->execute();
            $trans->commit();
        }catch (\Exception $e){
            $trans->rollBack();
            \Yii::error($e->getTrace());
        }
//        $this->getConnection()->transaction(function(){
//
//        });
    }
}