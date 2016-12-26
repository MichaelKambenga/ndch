<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\WeatherData;

/**
 * WeatherDataSearch represents the model behind the search form of `\app\models\WeatherData`.
 */
class WeatherDataSearch extends WeatherData
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'source', 'entryby', 'stationid', 'weatherelementid', 'weatherelementlistid'], 'integer'],
            [['value'], 'number'],
            [['daterecorded', 'entrydate'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = WeatherData::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'value' => $this->value,
            'daterecorded' => $this->daterecorded,
            'source' => $this->source,
            'entrydate' => $this->entrydate,
            'entryby' => $this->entryby,
            'stationid' => $this->stationid,
            'weatherelementid' => $this->weatherelementid,
            'weatherelementlistid' => $this->weatherelementlistid,
        ]);

        return $dataProvider;
    }
}
