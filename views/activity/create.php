<?php
?>

<h1>Новая активность</h1>
<p><?=$name?></p>

<div class="row">
    <div class="col-md-8">
        <?php $form = \yii\bootstrap\ActiveForm::begin();?>  <?//это такой способ создания формы?>
            <?=$form->field($model, 'title');?>
            <?=$form->field($model, 'description')->textarea();?> <!--<?php//можно добавить атрибут тегу textarea textarea(['data-des'=>22]) ?>-->
            <?=$form->field($model, 'date')->input('date');?> <?// можно добавить формат //input('date')?>
            <?=$form->field($model, 'color');?>
            <?=$form->field($model, 'priority')->checkbox();?>
            <?=$form->field($model, 'isBlocked')->checkbox();?>
            <?=$form->field($model, 'isRepeat')->checkbox();?>
            <div class="form-group">
                <button type="submit" class="btn btn-primary">Сохранить</button>
            </div>
        <?php \yii\bootstrap\ActiveForm::end(); ?>
    </div>
</div>
