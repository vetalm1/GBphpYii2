<?php

use yii\db\Migration;

/**
 * Class m191114_112025_createTables
 */
class m191114_112025_createTables extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('activity',[
            'id'=>$this->primaryKey(), //  автоинкремент
            'title'=>$this->string(150)->notNull(),
            'description'=>$this->text(),
            'dateStart'=>$this->dateTime()->notNull(),
            'isBlocked'=>$this->boolean()->notNull()->defaultValue(0),
            'createAT'=>$this->timestamp()->notNull()->defaultExpression('CURRENT_TIMESTAMP'),  //дада создания
            'email'=>$this->string(150)
        ]);

        $this->createTable('users',[
            'id'=>$this->primaryKey(),
            'email'=>$this->string(150)->notNull(),
            'passwordHash'=>$this->string(150),
            'authKey'=>$this->string(150),
            'token'=>$this->string(150),
            'createAT'=>$this->timestamp()->notNull()->defaultExpression('CURRENT_TIMESTAMP')
        ]);

        $this->createIndex('emailUniqueInd', 'users', 'email', true); //чтобы email был уникальным
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('users');
        $this->dropTable('activity');

    }

}
