<?php


namespace app\controllers;


use app\base\BaseController;
use app\controllers\actions\day\showMonthActivityAction;
use app\controllers\actions\day\ShowDayActivityAction;

class DayController extends BaseController
{
    public function actions() {
        return [
            'showDayActivity'=> ['class'=>ShowDayActivityAction::class, 'dayTitle'=>'Список активностей на сегодня'],
            'showMonthActivity'=>['class'=>showMonthActivityAction::class, 'monthTitle'=>'Календарь задач на ']
        ];
    }

}