<?php

namespace app\models;

use Yii;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "users".
 *
 * @property int $id
 * @property string $email
 * @property string $passwordHash
 * @property string $authKey
 * @property string $token
 * @property string $createAT
 *
 * @property Activity[] $activities
 */
class UsersBase extends  ActiveRecord // \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'users';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['email'], 'required'],
            [['createAT'], 'safe'],
            [['email', 'passwordHash', 'authKey', 'token'], 'string', 'max' => 150],
            //[['email'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'email' => Yii::t('app', 'Email'),
            'passwordHash' => Yii::t('app', 'Password Hash'),
            'authKey' => Yii::t('app', 'Auth Key'),
            'token' => Yii::t('app', 'Token'),
            'createAT' => Yii::t('app', 'Create At'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getActivities()
    {
        return $this->hasMany(Activity::className(), ['userId' => 'id']);
    }
}
