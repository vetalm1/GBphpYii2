<?php


namespace app\models;


use yii\base\Model;

class Day extends Model
{

    public $date;
    public $workday;

    public function rules()// это мы их типа переопределяем
    {
        return [
            ['date', 'string'],
        ];
    }

    public function attributeLabels() // переобзываем лейбл на русский язык
    {
        return [
            'date' => 'Дата',
        ];
    }

}