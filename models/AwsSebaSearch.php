<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\AwsSeba;

/**
 * AwsSebaSearch represents the model behind the search form of `app\models\AwsSeba`.
 */
class AwsSebaSearch extends AwsSeba
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['entrydate', 'time', 'stationname', 'D', 'U', 'PL', 'TL', 'G', 'CH'], 'safe'],
            [['id'], 'integer'],
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
        $query = AwsSeba::find();

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
        ]);

        $query->andFilterWhere(['ilike', 'entrydate', $this->entrydate])
            ->andFilterWhere(['ilike', 'time', $this->time])
            ->andFilterWhere(['ilike', 'stationname', $this->stationname])
            ->andFilterWhere(['ilike', 'D', $this->D])
            ->andFilterWhere(['ilike', 'U', $this->U])
            ->andFilterWhere(['ilike', 'PL', $this->PL])
            ->andFilterWhere(['ilike', 'TL', $this->TL])
            ->andFilterWhere(['ilike', 'G', $this->G])
            ->andFilterWhere(['ilike', 'CH', $this->CH]);

        return $dataProvider;
    }
}
