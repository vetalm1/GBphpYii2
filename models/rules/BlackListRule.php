<?php


namespace app\models\rules;


use yii\validators\Validator;

class BlackListRule extends Validator
{
    public $list;
    public function validateAttribute($model, $attribute)  // это кастомное правило вынесенное в отдельный файл
    {
            if(in_array($model->$attribute, $this->list)) {
            $model->addError($attribute, 'Недопустимое значение заголовка');
        }
    }

}