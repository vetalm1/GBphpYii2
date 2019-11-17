<?php

namespace app\components;

use app\models\Day;
use yii\base\Component;

class DayComponent extends Component
{
    public $storageOfActivity;
    public $modelClass;        //web.php->components->day
    public $Calendar;

    public function getModel(){
        return new $this->modelClass;
    }

    public function showActivity(Day $day): array
    {
        if($day->validate()){
            $this->storageOfActivity = $this->findActivity($day->date);
            return $this->storageOfActivity;
        }
        return [false];
    }

    public function findActivity($date){
        return ['активность1'=>$date];
    }
    public function showCalendar($month , $year){
//        $month = 12;
//        $year = 2019;
        $numDayCurrentMonth = date('t', mktime(0, 0, 0, $month, 1, $year));
        $numDayPreviousMonth = date('t', mktime(0, 0, 0, $month-1, 1, $year));
//        $countDayNextMonth = date('t', mktime(0, 0, 0, $month+1, 1, $year));
        date('w', mktime(0, 0, 0, $month, 1, $year)) == 0 ?
            $numWeek = 7:
            $numWeek = date('w', mktime(0, 0, 0, $month, 1, $year)) ;
        $numWeekLastDay = date('w', mktime(0, 0, 0, $month, (int)$numDayCurrentMonth, $year));
        $str='';
        $numDay=1-$numWeek+1;

        for ($numDay; $numDay<=$numDayCurrentMonth; $numDay++){
            if($numDay<=0){
                $Nd=(int)$numDayPreviousMonth+(int)$numDay;
                $str .= '<a href="#" class="calendarItem another-month">'.$Nd.'</a>';
            }else  {
                $weekDay=date('w', mktime(0, 0, 0, $month, $numDay, $year));
                if ($weekDay==0 || $weekDay == 6){
                    $str .= '<a href="#" class="calendarItem red">' . $numDay . '</a>';
                } else {
                    $str .= '<a href="#" class="calendarItem">' . $numDay . '</a>';
                }
            }
        }
        $Nd=0;
        while ((7-$numWeekLastDay)>0) {
            $numWeekLastDay++;
            $Nd+=1;
            $str .= '<a href="#" class="calendarItem another-month">' . $Nd . '</a>';
        }
        $this->Calendar = $str;
        return $this->Calendar;
    }
}