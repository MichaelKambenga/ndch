<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\User;

/**
 * UserSearch represents the model behind the search form about `app\models\User`.
 */
class UserSearch extends User {

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
            [['id', 'organizationid', 'status', 'logins', 'stationid'], 'integer'],
            [['firstname', 'middlename', 'lastname', 'username', 'password_hash', 'created_at', 'datedeactivated', 'lastlogin'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function scenarios() {
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
    public function search($params) {
        $query = User::find();

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
            'organizationid' => $this->organizationid,
            'stationid' => $this->stationid,
            'status' => $this->status,
            'created_at' => $this->created_at,
            'datedeactivated' => $this->datedeactivated,
            'lastlogin' => $this->lastlogin,
            'logins' => $this->logins,
        ]);

        $query->andFilterWhere(['like', 'firstname', $this->firstname])
                ->andFilterWhere(['like', 'middlename', $this->middlename])
                ->andFilterWhere(['like', 'lastname', $this->lastname])
                ->andFilterWhere(['like', 'username', $this->username])
                ->andFilterWhere(['like', 'password_hash', $this->password_hash]);

        return $dataProvider;
    }

}
