<?php
/**
 * @var $model \app\models\Activity
 */
?>

<h1><?=$name?></h1>


<div class="row">
    <div class="col-md-8">
        <?php $form = \yii\bootstrap\ActiveForm::begin();?>  <?//это такой способ создания формы?>
            <?=$form->field($model, 'title')->input('text', ['value' => 'hidden value']);?>
            <?=$form->field($model, 'description')->textarea(['value' => 'hidden value']);?>
            <?=$form->field($model, 'date');?> <?// можно добавить формат //input('date')?>
            <?=$form->field($model, 'priority')->checkbox(['checked' => true]);?>
            <?=$form->field($model, 'isBlocked')->checkbox();?>
            <?=$form->field($model, 'isRepeat')->checkbox();?>
            <?=$form->field($model, 'repeatType')->dropDownList($model::REPEAT_TYPE);?>

            <?=$form->field($model, 'useNotification')->checkbox();?>
            <?=$form->field($model, 'email', ['enableClientValidation'=>false,'enableAjaxValidation'=>true]);?>
            <?=$form->field($model, 'repeatEmail', ['enableClientValidation'=>false,'enableAjaxValidation'=>true]);?>

<!--            --><?//=$form->field($model, 'file')->fileInput()?><!-- -->
            <div class="form-group">
                <button type="submit" class="btn btn-primary">Сохранить</button>
            </div>
        <?php \yii\bootstrap\ActiveForm::end(); ?>
    </div>
</div>
