<?php
/**
 * @var $model \app\models\Activity
 * @var $this \yii\web\View
 */

?>

<h1 class="text-primary"><?=$model->title?></h1>
<ul >
    <li class="text-success">Описание: <br> <?=$model->description?></li>
    <li>Дата: <?=$model->dateStart?></li>
    <li>Блокирующее событие: <?=$model->isBlocked ? 'Да':'Нет'?></li>
    <li>Приоритеное: <?=$model->priority ? 'Да':'Нет'?></li>
    <li>Повторяется: <?=$model->isRepeat ? 'Да':'Нет'?></li>
    <li>Тип повтора: <?=$model->repeatType?></li>
    <li>Уведомлять: <?=$model->useNotification ? 'Да':'Нет'?></li>
    <li>Адрес эл. почты для уведомления: <br> <?=$model->email?></li>
    <li>
<!--       <?php //foreach ($model->files as $img) : ?> -->
<!--            <img width="300" src="/files/--><?//=$img?><!--" alt="">-->
<!--        <?php //endforeach ?> -->
    </li>
</ul>

<a href="/activity/update?id=<?=$model->id ?>"><h4 class="mt-4 text-primary">Редактировать</a>