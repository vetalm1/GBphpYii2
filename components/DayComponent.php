<?php

namespace app\components;

use app\models\Activity;
use app\models\Day;
use yii\base\Component;
use app\components\DAOComponent;

class DayComponent extends Component
{
    public $modelClass;        //web.php->components->day
    public $calendar;

    public function getModel()
    {
        return new $this->modelClass;
    }

    public function generateCalendar($month, $year)
    {
        $extremumDays = $this->generateExtremumDays($month, $year);
        $activitiesThisMonth = $this->findActivitiesThisMonth($extremumDays[0], $extremumDays[1]);
        return $this->generateCalendarMass($extremumDays[0], $activitiesThisMonth, $month);
    }

    public function generateExtremumDays($month, $year)
    {
        $yearPreviousMonth = $year;
        $month - 1 == 0 ? $yearPreviousMonth = $year - 1 : $yearPreviousMonth = $year;
        $month - 1 == 0 ? $PreviousMonth = 12 : $PreviousMonth = $month - 1;
        $quantityDaysPreviousMonth = date('t', mktime(0, 0, 0, $PreviousMonth, 1, $yearPreviousMonth));
        (date('w', mktime(0, 0, 0, $PreviousMonth, $quantityDaysPreviousMonth, $yearPreviousMonth)) == 0) ?
            $numWeek = 7 :
            $numWeek = date('w', mktime(0, 0, 0, $PreviousMonth, $quantityDaysPreviousMonth, $yearPreviousMonth));
        $firstDateCalendar = date('Y-m-d', mktime(0, 0, 0, $PreviousMonth,
            $quantityDaysPreviousMonth - $numWeek + 1, $yearPreviousMonth));

        $month == 12 ? $nextMonth = 1 : $nextMonth = $month + 1;
        $month == 12 ? $nextYear = $year + 1 : $nextYear = $year;
        $quantityDaysCurrentMonth = date('t', mktime(0, 0, 0, $month, 1, $year));
        $lastDateCalendar = date('Y-m-d', mktime(0, 0, 0, $nextMonth,
            42 - $numWeek - $quantityDaysCurrentMonth, $nextYear));
        return [$firstDateCalendar, $lastDateCalendar];
    } // нуждается в доработке

    public function findActivitiesThisMonth($firstDateCalendar, $lastDateCalendar)
    {
        $activities = Activity::find()
            ->andWhere('dateStart>:firstDate', [':firstDate' => $firstDateCalendar])
            ->andWhere('dateStart<=:lastDate', [':lastDate' => $lastDateCalendar])
            ->createCommand()->queryAll();

        $titlesDaysWithActivities = [[],[]];
        foreach ($activities as $dayActivities) {
            $arr = [date('Y-m-d', strtotime($dayActivities['dateStart'])) => [
                                         $dayActivities['title'],
                                         $dayActivities['id']
                                         ]
            ];
            array_push($titlesDaysWithActivities[0], $arr);
            array_push($titlesDaysWithActivities[1],
                                date('Y-m-d', strtotime($dayActivities['dateStart']))
            );
        }

        return $titlesDaysWithActivities;
    }

    public function generateCalendarMass($firstDateCalendar, $titlesDaysWithActivities, $month)
    {
        $calendar = [];
        $date = new \DateTime($firstDateCalendar);
        for ($i = 0; $i < 42; $i++) {
            $i == 0 ? true : $date->modify('+1 day');
            $weekDay = date('w', strtotime($date->format('Y-m-d')));
            if ($weekDay == 0 || $weekDay == 6) {
                $workDay = 'red';
            } else {
                $workDay = '';
            }

            if (in_array($date->format('Y-m-d'), $titlesDaysWithActivities[1])) {
                $activityExist = 'bold';
                $activityTitleAndId = [];
                foreach ($titlesDaysWithActivities[0] as $titleDaysWithActivities) {
                    if (array_key_first($titleDaysWithActivities) == $date->format('Y-m-d')) {
                        array_push($activityTitleAndId, $titleDaysWithActivities[$date->format('Y-m-d')]);
                    }
                }
            } else {
                $activityExist = '';
                $activityTitleAndId = '';
            }

            $date->format('m') != $month ? $anotherMonth = 'another-month' : $anotherMonth = '';

            $property = [
                'titleAndId' => $activityTitleAndId,
                'date' => $date->format('Y-m-d'),
                'dayNum' => $date->format('d'),
                'anotherMonth' => $anotherMonth,
                'workDay' => $workDay,
                'activity' => $activityExist];
            array_push($calendar, $property);
        }
        return $calendar;
    }

    public function monthFullName($month){
        $monthFullNameMass = ['','Январь', 'Февраль', 'Март', 'Апрель', 'Май', 'Июнь',
                          'Июль', 'Август', 'Сентябрь', 'Октябрь', 'Ноябрь', 'Декабрь'];
        return $monthFullNameMass[$month];
    }

    public function ShowCalendar($month, $year)
    {
        $yearPreviousMonth = $year;
        $month - 1 == 0 ? $yearPreviousMonth = $year - 1 : $yearPreviousMonth = $year;
        $month - 1 == 0 ? $PreviousMonth = 12 : $PreviousMonth = $month - 1;
        $quantityDaysPreviousMonth = date('t', mktime(0, 0, 0, $PreviousMonth, 1, $yearPreviousMonth));
        (date('w', mktime(0, 0, 0, $PreviousMonth, $quantityDaysPreviousMonth, $yearPreviousMonth)) == 0) ?
            $numWeek = 7 :
            $numWeek = date('w', mktime(0, 0, 0, $PreviousMonth, $quantityDaysPreviousMonth, $yearPreviousMonth));
        $firstDateCalendar = date('Y-m-d', mktime(0, 0, 0, $PreviousMonth,
            $quantityDaysPreviousMonth - $numWeek + 1, $yearPreviousMonth));

        $month == 12 ? $nextMonth = 1 : $nextMonth = $month + 1;
        $month == 12 ? $nextYear = $year + 1 : $nextYear = $year;
        $quantityDaysCurrentMonth = date('t', mktime(0, 0, 0, $month, 1, $year));
        $lastDateCalendar = date('Y-m-d', mktime(0, 0, 0, $nextMonth,
            42 - $numWeek - $quantityDaysCurrentMonth, $nextYear));

        $activities = Activity::find()
            ->andWhere('dateStart>:firstDate', [':firstDate' => $firstDateCalendar])
            ->andWhere('dateStart<=:lastDate', [':lastDate' => $lastDateCalendar])
            ->createCommand()->queryAll();
        $daysWithActivities = [];
        $titlesDaysWithActivities = [];

        foreach ($activities as $dayActivities) {
            $day = strtotime($dayActivities['dateStart']);
            array_push($daysWithActivities, date('Y-m-d', $day));
            $arr = [date('Y-m-d', $day) => $dayActivities['title']];
            array_push($titlesDaysWithActivities, $arr);
        }

        $calendar = [];
        $date = new \DateTime($firstDateCalendar);
        for ($i = 0; $i < 42; $i++) {
            $i == 0 ? true : $date->modify('+1 day');
            $weekDay = date('w', strtotime($date->format('Y-m-d')));
            if ($weekDay == 0 || $weekDay == 6) {
                $workDay = 'red';
            } else {
                $workDay = '';
            }

            in_array($date->format('Y-m-d'), $daysWithActivities) ?
                $activityExist = 'bold' : $activityExist = '';

            if (in_array($date->format('Y-m-d'), $daysWithActivities)) {
                $activityExist = 'bold';
                $activityTitle = [];
                foreach ($titlesDaysWithActivities as $titleDaysWithActivities) {
                    if (array_key_first($titleDaysWithActivities) == $date->format('Y-m-d')) {
                        array_push($activityTitle, $titleDaysWithActivities[$date->format('Y-m-d')]);
                    }
                }
            } else {
                $activityExist = '';
                $activityTitle = '';
            }

            $date->format('m') != $month ? $anotherMonth = 'another-month' : $anotherMonth = '';

            $property = [
                'title' => $activityTitle,
                'date' => $date->format('Y-m-d'),
                'dayNum' => $date->format('d'),
                'anotherMonth' => $anotherMonth,
                'workDay' => $workDay,
                'activity' => $activityExist];
            array_push($calendar, $property);
        }

        return $calendar;
    } // Old, bad practise...
}







