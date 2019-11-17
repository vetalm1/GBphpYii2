<?php
?>

<!--<h3>--><?//=$dayTitle?><!--</h3>-->


<div class="row">
    <div class="col-md-3">
<!--        <?php //$form = \yii\bootstrap\ActiveForm::begin();?>  <?////это такой способ создания формы?> -->
<!--        <?//=$form->field($model, 'date')->input('date');?> -->
<!--        <div class="form-group">-->
<!--            <button type="submit" class="btn btn-primary">Показать на дату</button>-->
<!--        </div>-->
<!--        <?php //\yii\bootstrap\ActiveForm::end(); ?> -->

        <div class="calendar-wrap">
            <div class="calendar-weekdays">Пн.</div>
            <div class="calendar-weekdays">Вт.</div>
            <div class="calendar-weekdays">Ср.</div>
            <div class="calendar-weekdays">Чт.</div>
            <div class="calendar-weekdays">Пт.</div>
            <div class="calendar-weekdays">Сб.</div>
            <div class="calendar-weekdays">Вс.</div>

            <?=$calendar?>
        </div>
    </div>
</div>

<h3 class="mt-4 text-primary"> Активности на сегодня </h3>
<div class="current-activity">
    <?php foreach ($ActivityCurrentDay as $item) : ?>
        <div class="col-md-3 day-activity">
            <h4 class="mt-4 text-primary"><?=$item['title']?> </h4>
            <h6 class="mt-4 text-primary"><?=$item['dateStart']?> </h6>
        </div>
    <?php endforeach ?>
</div>

<h3 class="mt-4 text-primary"> 3 ближайшие Активности </h3>
<div class="current-activity">
    <?php foreach ($activity as $item) : ?>
        <div class="col-md-3 day-activity">
            <h4 class="mt-4 text-primary"><?=$item['title']?> </h4>
            <h6 class="mt-4 text-primary"><?=$item['dateStart']?> </h6>
        </div>
    <?php endforeach ?>
</div>
