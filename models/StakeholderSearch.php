<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Stakeholder;

/**
 * StakeholderSearch represents the model behind the search form about `app\models\Stakeholder`.
 */
class StakeholderSearch extends Stakeholder
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'orgtype', 'status'], 'integer'],
            [['name', 'mobileno', 'email', 'datecreated', 'datedeactivated'], 'safe'],
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
        $query = Stakeholder::find();

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
            'orgtype' => $this->orgtype,
            'datecreated' => $this->datecreated,
            'status' => $this->status,
            'datedeactivated' => $this->datedeactivated,
        ]);

        $query->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'mobileno', $this->mobileno])
            ->andFilterWhere(['like', 'email', $this->email]);

        return $dataProvider;
    }
}
