<?php
/**
 * @var $model \app\models\Activity
 */
?>

<h1><?=$name?></h1>


<div class="row">
    <div class="col-md-8">
        <?php $form = \yii\bootstrap\ActiveForm::begin();?>  <?//это такой способ создания формы?>
            <?=$form->field($model, 'title');?>
            <?=$form->field($model, 'description')->textarea();?> <!--<?php//можно добавить атрибут тегу textarea(['data-des'=>22]) ?>-->
            <?=$form->field($model, 'date');?> <?// можно добавить формат //input('date')?>
            <?=$form->field($model, 'priority')->checkbox(['checked' => true]);?>
            <?=$form->field($model, 'isBlocked')->checkbox();?>
            <?=$form->field($model, 'isRepeat')->checkbox();?>
            <?=$form->field($model, 'repeatType')->dropDownList($model::REPEAT_TYPE);?>

            <?=$form->field($model, 'useNotification')->checkbox();?>
            <?=$form->field($model, 'email', ['enableClientValidation'=>false,'enableAjaxValidation'=>true]);?> <!--// параметр  отсылает запрос серверу на валидацию,-->
            <?=$form->field($model, 'repeatEmail', ['enableClientValidation'=>false,'enableAjaxValidation'=>true]);?> <!--//на стороне клиента врубить аякс валидацию и вырубить клиентскую-->
                                                                                         <!--можно все это прописать внутри ActiveForm::begin(), тогда для всех элементов формы будет так работать-->
            <?=$form->field($model, 'file')->fileInput()?> <!--//для загрузки файла  экземпляр создается в ActivityComponent-->
            <div class="form-group">
                <button type="submit" class="btn btn-primary">Сохранить</button>
            </div>
        <?php \yii\bootstrap\ActiveForm::end(); ?>
    </div>
</div>
