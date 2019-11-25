<?php

use yii\db\Migration;

/**
 * Class m191124_072524_updateData
 */
class m191124_072524_updateData extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->update('users', ['passwordHash'=>'$2y$10$eo8NVhOeUdWPd0BLAHjebOAn2J4ca7HShcBgjondRizk.pxMVCC56'], 'id=1');
        $this->update('users', ['passwordHash'=>'$2y$10$RHhrZbiZkqpLTkquWLX7jeLJ/h2YKK0fmncLOu4DMQZj95NEskAxK'], 'id=2');

    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {

        $this->update('users', ['passwordHash'=>'111'], 'id=1');
        $this->update('users', ['passwordHash'=>'111'], 'id=2');

    }
}
