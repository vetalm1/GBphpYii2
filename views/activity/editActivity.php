<?php
/**
 * @var $model \app\models\Activity
 */
?>

<h1><?=$name?></h1>


<div class="row">
    <div class="col-md-8">
        <?php $form = \yii\bootstrap\ActiveForm::begin();?>  <?//это такой способ создания формы?>
            <?=$form->field($model, 'title')->input('text', ['value' => 'value from BD']);?>
            <?=$form->field($model, 'description')->textarea(['value' => 'value from BD']);?>
            <?=$form->field($model, 'date');?>
            <?=$form->field($model, 'priority')->checkbox(['checked' => true]);?> <!--value from BD-->
            <?=$form->field($model, 'isBlocked')->checkbox(['checked' => true]);?> <!--value from BD-->
            <?=$form->field($model, 'isRepeat')->checkbox(['checked' => true]);?> <!--value from BD-->
            <?=$form->field($model, 'repeatType')->dropDownList($model::REPEAT_TYPE);?>

            <?=$form->field($model, 'useNotification')->checkbox(['checked' => true]);?> <!--value from BD-->
            <?=$form->field($model, 'email', ['enableClientValidation'=>false,'enableAjaxValidation'=>true])->input('text', ['value' => 'value from BD']);?>
            <?=$form->field($model, 'repeatEmail', ['enableClientValidation'=>false,'enableAjaxValidation'=>true])->input('text', ['value' => 'value from BD']);?>

            <div class="form-group">
                <button type="submit" class="btn btn-primary">Сохранить</button>
            </div>
        <?php \yii\bootstrap\ActiveForm::end(); ?>
    </div>
</div>
