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
            ['Kill Bill', date('Y-m-d'),0,1],
            ['Find Nemo', date('Y-m-d'),1,1],
            ['Eating tablets', '2019-10-11',1,1],
            ['Dont Forgot to sleep', '2019-10-12',0,2],
            ['Buy presents', '2019-12-12',0,2],
            ['Buy Christmas Tree', '2019-12-13',0,2],
            ['Play game', '2019-12-20',0,2],
            ['Prepare Olivier', '2019-12-31',0,2]

        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {

        $this->delete('activity');
        $this->delete('users');

    }


}
