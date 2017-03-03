<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\UserAuditTrail;

/**
 * UserAuditTrailSearch represents the model behind the search form of `app\models\UserAuditTrail`.
 */
class UserAuditTrailSearch extends UserAuditTrail
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'userid'], 'integer'],
            [['datecreated', 'ipaddress', 'object', 'clientdetails', 'details', 'referer'], 'safe'],
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
        $query = UserAuditTrail::find();

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
            'userid' => $this->userid,
            'datecreated' => $this->datecreated,
        ]);

        $query->andFilterWhere(['like', 'ipaddress', $this->ipaddress])
            ->andFilterWhere(['like', 'object', $this->object])
            ->andFilterWhere(['like', 'clientdetails', $this->clientdetails])
            ->andFilterWhere(['like', 'details', $this->details])
            ->andFilterWhere(['like', 'referer', $this->referer]);

        return $dataProvider;
    }
}