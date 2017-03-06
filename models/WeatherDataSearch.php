<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\WeatherData;

/**
 * WeatherDataSearch represents the model behind the search form of `app\models\WeatherData`.
 */
class WeatherDataSearch extends WeatherData {

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
        [['id', 'stationid', 'source'], 'integer'],
        [['TIME', 'DP1HX', 'DP1HM', 'PA', 'PA1HA', 'PA1HX', 'PA1HM', 'PR', 'PR1HS', 'PR24HS', 'PR5MS00', 'PR5MS05', 'PR5MS10', 'PR5MS15', 'PR5MS20', 'PR5MS25', 'PR5MS30', 'PR5MS35', 'PR5MS40', 'PR5MS45', 'PR5MS50', 'PR5MS55', 'RH', 'RH1HA', 'RH1HX', 'RH1HM', 'SR', 'SR1HA', 'SR1HX', 'SR1HM', 'TA', 'TA1HA', 'TA1HX', 'TA1HM', 'WD', 'WD2MA', 'WD10MA', 'WD2MX', 'WD10MX', 'WD2MM', 'WD10MM', 'WD1HA', 'WD1HX', 'WD1HM', 'WS', 'WS2MA', 'WS10MA', 'WS2MX', 'WS10MX', 'WS2MM', 'WS10MM', 'QFE', 'QFE1HA', 'QFE1HX', 'QFE1HM', 'QFF', 'QFF1HA', 'QFF1HX', 'QFF1HM', 'QNH', 'QNH1HA', 'QNH1HX', 'QNH1HM', 'ETO', 'Path', 'StationName', 'VaisalaVersion', 'EntryDate'], 'safe'],
        [['DP', 'DP1HA'], 'number'],
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
        $query = WeatherData::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
        'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            //$query->where('0=1');
            $query->orderBy(['TIME' => SORT_DESC]);
            return $dataProvider;
        }

        // grid filtering conditions
        if (\yii::$app->user->identity->stationid) {
            $stationid = \yii::$app->user->identity->stationid;
            $query->andFilterWhere(['stationid', $stationid]);
        } else {
            $query->andFilterWhere(
            ['stationid' => $this->stationid,]
            );
        }

        $query->andFilterWhere(['ilike', 'TIME', $this->TIME])
        ->andFilterWhere(['ilike', 'EntryDate', $this->EntryDate])
        ->andFilterWhere(['ilike', 'DP1HX', $this->DP1HX])
        ->andFilterWhere(['ilike', 'DP1HM', $this->DP1HM])
        ->andFilterWhere(['ilike', 'PA', $this->PA])
        ->andFilterWhere(['ilike', 'PA1HA', $this->PA1HA])
        ->andFilterWhere(['ilike', 'PA1HX', $this->PA1HX])
        ->andFilterWhere(['ilike', 'PA1HM', $this->PA1HM])
        ->andFilterWhere(['ilike', 'PR', $this->PR])
        ->andFilterWhere(['ilike', 'PR1HS', $this->PR1HS])
        ->andFilterWhere(['ilike', 'PR24HS', $this->PR24HS])
        ->andFilterWhere(['ilike', 'PR5MS00', $this->PR5MS00])
        ->andFilterWhere(['ilike', 'PR5MS05', $this->PR5MS05])
        ->andFilterWhere(['ilike', 'PR5MS10', $this->PR5MS10])
        ->andFilterWhere(['ilike', 'PR5MS15', $this->PR5MS15])
        ->andFilterWhere(['ilike', 'PR5MS20', $this->PR5MS20])
        ->andFilterWhere(['ilike', 'PR5MS25', $this->PR5MS25])
        ->andFilterWhere(['ilike', 'PR5MS30', $this->PR5MS30])
        ->andFilterWhere(['ilike', 'PR5MS35', $this->PR5MS35])
        ->andFilterWhere(['ilike', 'PR5MS40', $this->PR5MS40])
        ->andFilterWhere(['ilike', 'PR5MS45', $this->PR5MS45])
        ->andFilterWhere(['ilike', 'PR5MS50', $this->PR5MS50])
        ->andFilterWhere(['ilike', 'PR5MS55', $this->PR5MS55])
        ->andFilterWhere(['ilike', 'RH', $this->RH])
        ->andFilterWhere(['ilike', 'RH1HA', $this->RH1HA])
        ->andFilterWhere(['ilike', 'RH1HX', $this->RH1HX])
        ->andFilterWhere(['ilike', 'RH1HM', $this->RH1HM])
        ->andFilterWhere(['ilike', 'SR', $this->SR])
        ->andFilterWhere(['ilike', 'SR1HA', $this->SR1HA])
        ->andFilterWhere(['ilike', 'SR1HX', $this->SR1HX])
        ->andFilterWhere(['ilike', 'SR1HM', $this->SR1HM])
        ->andFilterWhere(['ilike', 'TA', $this->TA])
        ->andFilterWhere(['ilike', 'TA1HA', $this->TA1HA])
        ->andFilterWhere(['ilike', 'TA1HX', $this->TA1HX])
        ->andFilterWhere(['ilike', 'TA1HM', $this->TA1HM])
        ->andFilterWhere(['ilike', 'WD', $this->WD])
        ->andFilterWhere(['ilike', 'WD2MA', $this->WD2MA])
        ->andFilterWhere(['ilike', 'WD10MA', $this->WD10MA])
        ->andFilterWhere(['ilike', 'WD2MX', $this->WD2MX])
        ->andFilterWhere(['ilike', 'WD10MX', $this->WD10MX])
        ->andFilterWhere(['ilike', 'WD2MM', $this->WD2MM])
        ->andFilterWhere(['ilike', 'WD10MM', $this->WD10MM])
        ->andFilterWhere(['ilike', 'WD1HA', $this->WD1HA])
        ->andFilterWhere(['ilike', 'WD1HX', $this->WD1HX])
        ->andFilterWhere(['ilike', 'WD1HM', $this->WD1HM])
        ->andFilterWhere(['ilike', 'WS', $this->WS])
        ->andFilterWhere(['ilike', 'WS2MA', $this->WS2MA])
        ->andFilterWhere(['ilike', 'WS10MA', $this->WS10MA])
        ->andFilterWhere(['ilike', 'WS2MX', $this->WS2MX])
        ->andFilterWhere(['ilike', 'WS10MX', $this->WS10MX])
        ->andFilterWhere(['ilike', 'WS2MM', $this->WS2MM])
        ->andFilterWhere(['ilike', 'WS10MM', $this->WS10MM])
        ->andFilterWhere(['ilike', 'QFE', $this->QFE])
        ->andFilterWhere(['ilike', 'QFE1HA', $this->QFE1HA])
        ->andFilterWhere(['ilike', 'QFE1HX', $this->QFE1HX])
        ->andFilterWhere(['ilike', 'QFE1HM', $this->QFE1HM])
        ->andFilterWhere(['ilike', 'QFF', $this->QFF])
        ->andFilterWhere(['ilike', 'QFF1HA', $this->QFF1HA])
        ->andFilterWhere(['ilike', 'QFF1HX', $this->QFF1HX])
        ->andFilterWhere(['ilike', 'QFF1HM', $this->QFF1HM])
        ->andFilterWhere(['ilike', 'QNH', $this->QNH])
        ->andFilterWhere(['ilike', 'QNH1HA', $this->QNH1HA])
        ->andFilterWhere(['ilike', 'QNH1HX', $this->QNH1HX])
        ->andFilterWhere(['ilike', 'QNH1HM', $this->QNH1HM])
        ->andFilterWhere(['ilike', 'ETO', $this->ETO])
        ->andFilterWhere(['ilike', 'Path', $this->Path])
        ->andFilterWhere(['ilike', 'StationName', $this->StationName])
        ->andFilterWhere(['ilike', 'VaisalaVersion', $this->VaisalaVersion]);



        return $dataProvider;
    }

}
