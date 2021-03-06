<?php


namespace app\models;


use app\behaviors\DateCreatedBehavior;
use app\models\rules\BlackListRule;
use Egulias\EmailValidator\Warning\EmailTooLong;
use yii\base\Model;

class Activity extends ActivityBase //Model
{
//    public $title;
//    public $description;
//    public $date;
//    public $isBlocked;
//    public $email;
    public  $isRepeat;
    public $priority;

    public $repeatType;
    const DAY=0;
    const WEEK=1;
    const MONTH=2;
    const REPEAT_TYPE=[self::DAY=>'Каждый день', self::WEEK=>'Каждую неделю',
                       self::MONTH=>'Каждый месяц'];
    public $repeatEmail;
    public $useNotification;

    Public $files;

    public function behaviors()  //подключаем поведение
    {
        return [
            ['class'=>DateCreatedBehavior::class, 'attributeName' => 'createAT']
        ];
    }

//    public function  beforeValidate()
//    {
//        if (!empty($this->date)){ //
//            $date=\DateTime::createFromFormat('d.m.Y', $this->date); // преобразовать в формат
//            if ($date) {
//                $this->date=$date->format('Y-m-d'); // если преобразование состоялось то присвоим в $this->date
//            }
//        }
//        return parent::beforeValidate();
//    }

    // чтобы появилась валидация нужно переопределить функцию  rules
    public function rules()// задать правила
    {
        return array_merge( [ // объединим с правилами родителя
            ['title', 'required'],
            [['files'], 'file', 'extensions' => ['jpg', 'png', 'gif'], 'maxFiles' => 10],
            [['description'], 'string', 'max' => 250, 'min'=>5],
            ['dateStart', 'string'],
            //['date', 'date', 'format' => 'php:Y-m-d'], //формат даты
            [['isBlocked', 'isRepeat', 'priority', 'useNotification'], 'boolean'],
            ['email', 'email'],
            ['email', 'required', 'when'=>function($model){
                return $model->useNotification;   // если на useNotification галка стоит то email становится required -обязательный,
                                                 // если нет то не обязательный, но это серверная валидация, на форме не заработает,
                                                // т.к. во вьюхе в форме указали - выкл клиентскую и вкл. аякс(серверную) валидацию
            }],
            ['repeatType', 'in', 'range' =>array_keys(self::REPEAT_TYPE)], //валидация именно на эти ключи
            ['repeatEmail', 'compare', 'compareAttribute' => 'email'],  // сравнивает 2 поля email(типа подтвердить емыл)
            //['title','match', 'pattern' => '/[a-z]/iu'],  // регулярное выражение, они и в js тоже попадают
            ['title', 'trim'],  //убирает пробелы начало-конец,
            ['title', BlackListRule::class, 'list'=>['Шаурма']] // вынесен блеклист в отдельную функцию и  в отдельный файл (rules-BlacklistRule) чтобы было по солид
            //['title', 'validBlackList']  // вынесен блеклист в отдельную функцию(func=validBlackList см. ниже), типа кастомное правило, валидируется в данном случае на сервере
        ], parent::rules()); // объединим с правилами родителя
    }

//    public function  validBlackList($attribute){  // кастомное правило по итогу вынесли в отдельный файл(rules-BlacklistRule) для примера (в отдельном файле по )
//        $list=['Шаурма', 'Бордюр'];
//        if(in_array($this->title, $list)) {
//            $this->addError('title', 'Недопустимое значение заголовка');
//        }
//    }

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