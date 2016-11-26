<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Ward;

/**
 * WardSearch represents the model behind the search form about `app\models\Ward`.
 */
class WardSearch extends Ward
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'districtid'], 'integer'],
            [['wardname'], 'safe'],
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
        $query = Ward::find();

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
            'districtid' => $this->districtid,
        ]);

        $query->andFilterWhere(['like', 'wardname', $this->wardname]);

        return $dataProvider;
    }
}
