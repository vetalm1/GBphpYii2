<?php
/* @var $this \yii\web\View */
?>
<div class="row">
    <?php if($this->beginCache('view1',['duration'=>20])):?>
        <div class="col-md-6">
        <pre>
            <?=print_r($users);?>
        </pre>
        </div>
        <?php $this->endCache(); endif; ?>
    <div class="col-md-6">
        <pre>
            <?=print_r($activityUser);?>
        </pre>
    </div>
    <div class="col-md-6">
        <pre>
            <?=print_r($activity)?>
        </pre>
    </div>
    <div class="col-md-6">
        <pre>
            Count Activity <?=$count?>
        </pre>
    </div>
    <div class="col-md-6">
        <pre>
            <?php
            foreach ($reader as $item){
                print_r($item);
            }
            ?>
        </pre>
    </div>
    <div class="col-md-6"></div>
</div>