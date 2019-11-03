<?php


namespace app\models;


use yii\base\Model;

class day extends Model
{

    public $date;
    public $workday;

    public function rules()// это мы их типа переопределяем, но видимо гдето run запускается
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