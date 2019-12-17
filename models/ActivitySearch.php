<?php


namespace app\models;


use yii\data\ActiveDataProvider;

class ActivitySearch extends Activity
{
    public function search($params=[]):ActiveDataProvider
    {
        $query=Activity::find();  // поставщик данных, построитель запросов

        $provider = new ActiveDataProvider(
        [
            'query' => $query,
            'sort' => [
                'defaultOrder' =>['dateStart'=>SORT_DESC]
            ],
            'pagination' =>  ['pageSize'=>7] //количество записей отображения в таблице
        ]
        );

        $query->with('user'); //чтобы загрузка данных из связанной таблицы user стала жадной

        $this->load($params);  // для применения фильтра, загружаем параметры и настраиваем фильтрацию по title
        $query->andFilterWhere(['title' => $this->title]); //

        return $provider;
    }
}