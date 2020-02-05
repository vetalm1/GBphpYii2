<?php


namespace app\models;


use yii\base\Model;

class Day extends Model
{

    public $date;
    public $workday;

    public function rules()
    {
        return [
            ['date', 'string'],
        ];
    }

    public function attributeLabels()
    {
        return [
            'date' => 'Дата',
        ];
    }

}