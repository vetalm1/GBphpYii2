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
    </div>
</div>
