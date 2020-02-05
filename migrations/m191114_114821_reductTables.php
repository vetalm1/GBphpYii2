<?php

use yii\db\Migration;

/**
 * Class m191114_114821_reductTables
 */
class m191114_114821_reductTables extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('activity', 'userId', $this->integer()->notNull());
        $this->addForeignKey('activityUserFK', 'activity', 'userId'
                            , 'users', 'id'); //вотричный ключ для ссылочной целостности
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropForeignKey('activityUserFK', 'activity');
        $this->dropColumn('activity', 'userId');


    }


}
