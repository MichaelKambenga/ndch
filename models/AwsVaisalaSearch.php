<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\AwsVaisala;

/**
 * AwsVaisalaSearch represents the model behind the search form about `app\models\AwsVaisala`.
 */
class AwsVaisalaSearch extends AwsVaisala
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id'], 'integer'],
            [['TIME', 'DP1HX', 'DP1HM', 'PA', 'PA1HA', 'PA1HX', 'PA1HM', 'PR', 'PR1HS', 'PR24HS', 'PR5MS00', 'PR5MS05', 'PR5MS10', 'PR5MS15', 'PR5MS20', 'PR5MS25', 'PR5MS30', 'PR5MS35', 'PR5MS40', 'PR5MS45', 'PR5MS50', 'PR5MS55', 'RH', 'RH1HA', 'RH1HX', 'RH1HM', 'SR', 'SR1HA', 'SR1HX', 'SR1HM', 'TA', 'TA1HA', 'TA1HX', 'TA1HM', 'WD', 'WD2MA', 'WD10MA', 'WD2MX', 'WD10MX', 'WD2MM', 'WD10MM', 'WD1HA', 'WD1HX', 'WD1HM', 'WS', 'WS2MA', 'WS10MA', 'WS2MX', 'WS10MX', 'WS2MM', 'WS10MM', 'QFE', 'QFE1HA', 'QFE1HX', 'QFE1HM', 'QFF', 'QFF1HA', 'QFF1HX', 'QFF1HM', 'QNH', 'QNH1HA', 'QNH1HX', 'QNH1HM', 'a', 'p', 'ETO', 'Path', 'StationName', 'VaisalaVersion', 'EntryDate'], 'safe'],
            [['BAT', 'DP', 'DP1HA'], 'number'],
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
        $query = AwsVaisala::find();

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
            'BAT' => $this->BAT,
            'DP' => $this->DP,
            'DP1HA' => $this->DP1HA,
            'EntryDate' => $this->EntryDate,
        ]);

        $query->andFilterWhere(['like', 'TIME', $this->TIME])
            ->andFilterWhere(['like', 'DP1HX', $this->DP1HX])
            ->andFilterWhere(['like', 'DP1HM', $this->DP1HM])
            ->andFilterWhere(['like', 'PA', $this->PA])
            ->andFilterWhere(['like', 'PA1HA', $this->PA1HA])
            ->andFilterWhere(['like', 'PA1HX', $this->PA1HX])
            ->andFilterWhere(['like', 'PA1HM', $this->PA1HM])
            ->andFilterWhere(['like', 'PR', $this->PR])
            ->andFilterWhere(['like', 'PR1HS', $this->PR1HS])
            ->andFilterWhere(['like', 'PR24HS', $this->PR24HS])
            ->andFilterWhere(['like', 'PR5MS00', $this->PR5MS00])
            ->andFilterWhere(['like', 'PR5MS05', $this->PR5MS05])
            ->andFilterWhere(['like', 'PR5MS10', $this->PR5MS10])
            ->andFilterWhere(['like', 'PR5MS15', $this->PR5MS15])
            ->andFilterWhere(['like', 'PR5MS20', $this->PR5MS20])
            ->andFilterWhere(['like', 'PR5MS25', $this->PR5MS25])
            ->andFilterWhere(['like', 'PR5MS30', $this->PR5MS30])
            ->andFilterWhere(['like', 'PR5MS35', $this->PR5MS35])
            ->andFilterWhere(['like', 'PR5MS40', $this->PR5MS40])
            ->andFilterWhere(['like', 'PR5MS45', $this->PR5MS45])
            ->andFilterWhere(['like', 'PR5MS50', $this->PR5MS50])
            ->andFilterWhere(['like', 'PR5MS55', $this->PR5MS55])
            ->andFilterWhere(['like', 'RH', $this->RH])
            ->andFilterWhere(['like', 'RH1HA', $this->RH1HA])
            ->andFilterWhere(['like', 'RH1HX', $this->RH1HX])
            ->andFilterWhere(['like', 'RH1HM', $this->RH1HM])
            ->andFilterWhere(['like', 'SR', $this->SR])
            ->andFilterWhere(['like', 'SR1HA', $this->SR1HA])
            ->andFilterWhere(['like', 'SR1HX', $this->SR1HX])
            ->andFilterWhere(['like', 'SR1HM', $this->SR1HM])
            ->andFilterWhere(['like', 'TA', $this->TA])
            ->andFilterWhere(['like', 'TA1HA', $this->TA1HA])
            ->andFilterWhere(['like', 'TA1HX', $this->TA1HX])
            ->andFilterWhere(['like', 'TA1HM', $this->TA1HM])
            ->andFilterWhere(['like', 'WD', $this->WD])
            ->andFilterWhere(['like', 'WD2MA', $this->WD2MA])
            ->andFilterWhere(['like', 'WD10MA', $this->WD10MA])
            ->andFilterWhere(['like', 'WD2MX', $this->WD2MX])
            ->andFilterWhere(['like', 'WD10MX', $this->WD10MX])
            ->andFilterWhere(['like', 'WD2MM', $this->WD2MM])
            ->andFilterWhere(['like', 'WD10MM', $this->WD10MM])
            ->andFilterWhere(['like', 'WD1HA', $this->WD1HA])
            ->andFilterWhere(['like', 'WD1HX', $this->WD1HX])
            ->andFilterWhere(['like', 'WD1HM', $this->WD1HM])
            ->andFilterWhere(['like', 'WS', $this->WS])
            ->andFilterWhere(['like', 'WS2MA', $this->WS2MA])
            ->andFilterWhere(['like', 'WS10MA', $this->WS10MA])
            ->andFilterWhere(['like', 'WS2MX', $this->WS2MX])
            ->andFilterWhere(['like', 'WS10MX', $this->WS10MX])
            ->andFilterWhere(['like', 'WS2MM', $this->WS2MM])
            ->andFilterWhere(['like', 'WS10MM', $this->WS10MM])
            ->andFilterWhere(['like', 'QFE', $this->QFE])
            ->andFilterWhere(['like', 'QFE1HA', $this->QFE1HA])
            ->andFilterWhere(['like', 'QFE1HX', $this->QFE1HX])
            ->andFilterWhere(['like', 'QFE1HM', $this->QFE1HM])
            ->andFilterWhere(['like', 'QFF', $this->QFF])
            ->andFilterWhere(['like', 'QFF1HA', $this->QFF1HA])
            ->andFilterWhere(['like', 'QFF1HX', $this->QFF1HX])
            ->andFilterWhere(['like', 'QFF1HM', $this->QFF1HM])
            ->andFilterWhere(['like', 'QNH', $this->QNH])
            ->andFilterWhere(['like', 'QNH1HA', $this->QNH1HA])
            ->andFilterWhere(['like', 'QNH1HX', $this->QNH1HX])
            ->andFilterWhere(['like', 'QNH1HM', $this->QNH1HM])
            ->andFilterWhere(['like', 'a', $this->a])
            ->andFilterWhere(['like', 'p', $this->p])
            ->andFilterWhere(['like', 'ETO', $this->ETO])
            ->andFilterWhere(['like', 'Path', $this->Path])
            ->andFilterWhere(['like', 'StationName', $this->StationName])
            ->andFilterWhere(['like', 'VaisalaVersion', $this->VaisalaVersion]);

        return $dataProvider;
    }
}
