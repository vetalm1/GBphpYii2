<?php
?>
<h3><?=$dayTitle?> <?php echo $month." ".date(' Y' , strtotime($calendar[15]['date']))?></h3>


<div class="row">
    <div class="col-md-3">
        <?php $date = new \DateTime($calendar[15]['date']); ?>
        <a href="/day/showMonthActivity?changeMonth=<?php echo $date->modify('-1 month')->format('Y-m-d');?>"> &lArr;Предыдущий -- </a>
        <a href="/day/showMonthActivity?changeMonth=<?php echo $date->modify('+2 month')->format('Y-m-d');?>"> -- Следующий&rArr; </a>
        <div class="big-calendar-wrap">
            <div class="big-calendar-weekdays">Пн.</div>
            <div class="big-calendar-weekdays">Вт.</div>
            <div class="big-calendar-weekdays">Ср.</div>
            <div class="big-calendar-weekdays">Чт.</div>
            <div class="big-calendar-weekdays">Пт.</div>
            <div class="big-calendar-weekdays">Сб.</div>
            <div class="big-calendar-weekdays">Вс.</div>

            <?php foreach ($calendar as $day) : ?>
                <div class="big-calendarItem <?=$day['workDay']?> <?=$day['anotherMonth']?> <?=$day['activity']?> ">
                    <a href="/day/showDayActivity?date=<?=$day['date']?>">
                       <?=$day['dayNum']?>
                    </a>

                    <?php if (!empty($day['titleAndId'])) {
                      foreach ($day['titleAndId'] as $titleAndId){
                         echo '<a href="/activity/view?id='.$titleAndId[1].'" class="big-calendarItem-activities">'.$titleAndId[0].'<br></a>';
                      }
                    } ?>
                </div>
            <?php endforeach ?>

        </div>
    </div>
</div>

