<?php

namespace app\components;

use app\models\Day;
use yii\base\Component;
use app\components\DAOComponent;

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
//            $this->storageOfActivity = $this->findActivity($day->date);
//            return $this->storageOfActivity;
            return ['date'=>$day->date];
        }
        return [false];
    }


    public function showCalendar($month , $year){
        // готовим данные для вывода календаря на указанный месяц и год
        $quantityDaysCurrentMonth = date('t', mktime(0, 0, 0, $month, 1, $year));
        $quantityDaysPreviousMonth = date('t', mktime(0, 0, 0, ($month-1), 1, $year));
        (date('w', mktime(0, 0, 0, $month, 1, $year)) == 0) ?
            $numWeek = 7:
            $numWeek = date('w', mktime(0, 0, 0, $month, 1, $year)) ;
        $numWeekLastDay = date('w', mktime(0, 0, 0, $month, (int)$quantityDaysCurrentMonth, $year));
        $str='';
        $numDay=1-$numWeek+1;

        // готовим массив с днями активности для выделения их в календаре
        //($numWeek == 7)? $previousMonth = $month : $previousMonth = $month-1;
        $previousMonth = $month-1;
       echo $firstDayCalendar = date('Y-m-d', mktime(0, 0, 0, $previousMonth, (int)$quantityDaysPreviousMonth+(int)$numDay, $year));
        ($numWeekLastDay == 0)? $nextMonth = $month : $nextMonth = $month+1 ;
        $lastDayCalendar = date('Y-m-d', mktime(0, 0, 0, $nextMonth, 7-$numWeekLastDay, $year));
        $activities = \Yii::$app->dao->getActivityMonth($firstDayCalendar, $lastDayCalendar);

        $daysWithActivities =[]; //массив с днями в которых есть активность
        foreach ($activities as $dayActivities) {
            $day = strtotime($dayActivities['dateStart']);
            array_push($daysWithActivities, date('d', $day));
        }

        print_r($daysWithActivities);
        // выводим календарь
        for ($numDay; $numDay<=$quantityDaysCurrentMonth; $numDay++){
            if($numDay<=0){
                $Nd=(int)$quantityDaysPreviousMonth+(int)$numDay;
                in_array($Nd, $daysWithActivities)? $bold = 'bold': $bold = '' ; // если есть такая активность то выделяем ее в календаре
                $str .= '<a href="/day/showDayActivity?date='.$year.'-'.($month-1).'-'.$Nd.'" class="calendarItem another-month '.$bold.'">'.$Nd.'</a>';
            }else  {
                $weekDay=date('w', mktime(0, 0, 0, $month, $numDay, $year));
                if ($weekDay==0 || $weekDay == 6){
                    in_array($numDay, $daysWithActivities)? $bold = 'bold': $bold = '' ;
                    $str .= '<a href="/day/showDayActivity?date='.$year.'-'.$month.'-'.$numDay.'" class="calendarItem red '.$bold.'">' . $numDay . '</a>';
                } else {
                    in_array($numDay, $daysWithActivities)? $bold = 'bold': $bold = '' ;
                    $str .= '<a href="/day/showDayActivity?date='.$year.'-'.$month.'-'.$numDay.'" class="calendarItem '.$bold.'">' . $numDay . '</a>';
                }
            }
        }
        $Nd=0;
        while ((7-$numWeekLastDay)>0) {
            $numWeekLastDay++;
            $Nd+=1;
            in_array($Nd, $daysWithActivities)? $bold = 'bold': $bold = '' ;
            $str .= '<a href="/day/showDayActivity?date='.$year.'-'.($month+1).'-'.$Nd.'" class="calendarItem another-month '.$bold.'">' . $Nd . '</a>';
        }
        $this->Calendar = $str;
        return $this->Calendar;
    }
}