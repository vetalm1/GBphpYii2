<?php



/* @var $this \yii\web\View */
/* @var $model \app\models\Users */
?>

<div class="row">
    <dib class="col-md-6">
        <h3>Авторизация </h3>
        <?php $form = \yii\bootstrap\ActiveForm::begin();?>
        <?=$form->field($model, 'email');?>
        <?=$form->field($model, 'password')->passwordInput();?>
        <div class="form-group">
            <button type="submit" class="btn btn-default">Авторизация</button>
        </div>
        <?php \yii\bootstrap\ActiveForm::end();?>

    </dib>
</div>
