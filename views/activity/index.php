<?php



/* @var $this \yii\web\View */
/* @var $model \app\models\ActivitySearch */
/* @var $provider \yii\data\ActiveDataProvider */


?>

<div class="row">
    <div class="col-md-12">
        <?= \yii\grid\GridView::widget([
            'dataProvider' => $provider,
            'filterModel' => $model, //включает фильтрацию к полям
//            'tableOptions' => [
//                'class' => 'table'  //можно использовать различные параметры настройки? переопределяем класс тега
//            ]

            'columns' => [ //только нужные колонки
                    ['class'=>\yii\grid\SerialColumn::class], // пронумеровать
                    'id',
                    [
                            'attribute' => 'title',
                            'label' => 'Название активности', // переобозвать заголовок если нужно полность заменить тег то 'header' нужно вместо label
                            'value' => function($model){
                                    return \yii\helpers\Html::a(\yii\helpers\Html::encode($model->title),['/activity/view', 'id' => $model->id]); //вывод наименований ввиде ссылок на просмотр активности
                            },
                            'format' => 'raw' // чтобы не переделывал теги в текст (убрать защиту встроенную), но сами ее добавим выше (\yii\helpers\Html::encode)
                    ],
                    //'title',
                    'dateStart',
                    [
                            'attribute' => 'user.email' // если связанные таблицы, user-таблица email-поле подтягивается поле email
                    ],
                    [
                         'attribute' => 'createAT',  //добавляем поле с помощью поведения
                         'value' => function($model){
                            return $model->getDateCreated();
                         }
                    ]
            ],

            'rowOptions' => function($model, $key, $index, $grid){ // каждой строчке определяем класс тега odd или oven
                $class=$index%2? 'odd' : 'even'; // проверка четности
                return ['key'=>$key, 'index'=>$index, 'class'=>$class];
            },

        ])?>
    </div>
</div>