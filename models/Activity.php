<?php


namespace app\models;


use yii\base\Model;

class Activity extends Model
{
    public $title;
    public $description;
    public $date;
    public $isBlocked;
    public  $isRepeat;
    public $priority;
    public $color;


    // чтобы появилась валидация нужно переопределить функцию  rules

    public function rules()// это мы их типа переопределяем
    {
        return [
          ['title', 'required'],
            [['description', 'color'], 'string', 'max' => 250],
            ['date', 'string'],
            [['isBlocked', 'isRepeat', 'priority'], 'boolean']
        ];
    }

    public function attributeLabels() // переобзываем лейбл на русский язык
    {
        return [
            'title'=>'Заголовок события',
            'description' => 'Описание',
            'date' => 'Дата',
            'isBlocked' => 'Блокирующее событие',
            'isRepeat' => 'Повторять',
            'priority' => 'Показать первым в списке',
            'color' => 'Выделить цветом'
        ];
    }

}