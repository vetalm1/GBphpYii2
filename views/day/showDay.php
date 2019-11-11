<?php
?>

<h1><?=$dayTitle?></h1>


<div class="row">
    <div class="col-md-8">
        <?php $form = \yii\bootstrap\ActiveForm::begin();?>  <?//это такой способ создания формы?>
        <?=$form->field($model, 'date')->input('date');?>
        <div class="form-group">
            <button type="submit" class="btn btn-primary">Показать на дату</button>
        </div>
        <?php \yii\bootstrap\ActiveForm::end(); ?>

        <h1 class="text-primary">Заголовок 1</h1>
        <ul >
            <li class="text-success">Описание: <br> </li>
            <li>Дата: </li>
            <li>Блокирующее событие: </li>
            <li>Приоритеное: </li>
            <li>Повторяется: </li>
            <li>Тип повтора: </li>
            <li>Уведомлять: </li>
            <li>Адрес эл. почты для уведомления: </li>

    </div>
</div>
