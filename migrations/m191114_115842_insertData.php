<?php

use yii\db\Migration;

/**
 * Class m191114_115842_insertData
 */
class m191114_115842_insertData extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->insert('users', [
            'id'=>1,
            'email'=>'test@mail.ru',
            'passwordHash'=>'111'
        ]);
        $this->insert('users', [
            'id'=>2,
            'email'=>'test2@mail.ru',
            'passwordHash'=>'111'
        ]);

        $this->batchInsert('activity', [
            'title','dateStart','isBlocked','userId'
        ],[
            ['title1', date('Y-m-d'),0,1],
            ['title2', date('Y-m-d'),1,1],
            ['title3', date('Y-m-d'),1,1],
            ['title4', date('Y-m-d'),0,2],
            ['title5', '2019-11-10',0,2]

        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {

        $this->delete('users');


    }


}
