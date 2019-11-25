<?php


namespace app\components;


use app\base\BaseComponent;
use app\models\Activity;
use app\rules\OwnerActivityRule;
use yii\rbac\ManagerInterface;

class RbacComponent extends BaseComponent
{

    private function getManager():ManagerInterface{  //компонент для создания ролей и их
        return \Yii::$app->authManager;
    }

    public function generateRbac(){
        $manager=$this->getManager();
        $manager->removeAll(); // чтобы прикаждом вызове этой функции все затиралось и заново генерировались правила

        $admin=$manager->createRole('admin'); // создался объект
        $user=$manager->createRole('user');

        $manager->add($admin); // записывает в базу названия ролей
        $manager->add($user);

        // Записывали в базу эти разрешения
        $createActivity = $manager->createPermission('createActivity'); // орбъект разрешений
        $createActivity->description='Создание активностей'; // описание
        $manager->add($createActivity); // добавляем в базу это разрешение

        $rule=new OwnerActivityRule(); // правило в отдельно файле
        $manager->add($rule); // добавить в базу


        $viewOwnerActivity = $manager->createPermission('viewOwnerActivity'); // объект разрешений
        $viewOwnerActivity->description='Просмотр свойе активности'; // описание
        $viewOwnerActivity->ruleName=$rule->name;
        $manager->add($viewOwnerActivity); // добавляем в базу это разрешение

        $adminActivity = $manager->createPermission('adminActivity'); // орбъект разрешений
        $adminActivity->description='Доступ к любым активностям'; // описание
        $manager->add($adminActivity); // добавляем в базу это разрешение

        // раздаем разрешения ролям

        $manager->addChild($user, $createActivity); // сразу в базу сохраняет, дать юзеру возможность create Activity
        $manager->addChild($user, $viewOwnerActivity);
        $manager->addChild($admin, $user);
        $manager->addChild($admin, $adminActivity);

        // раздать роли  по пользователям

        $manager->assign($user, 2);
        $manager->assign($admin, 1);
    }

    public function canCreateActivity():bool {
        return \Yii::$app->user->can('createActivity');   //проверка текущий пользователь имеет право это сделать?
    }

    public function canViewActivity(Activity $activity){  // права на просмотр для  того кто создал активность
        if(\Yii::$app->user->can('adminActivity')){
            return true;
        }
        if(\Yii::$app->user->can('viewOwnerActivity', ['activity'=>$activity])) {
            return true;
        }
        return false;

    }
}