<?php

namespace app\models;

use Yii;
use yii\base\Model;

/**
 * LoginForm is the model behind the login form.
 *
 * @property User|null $user This property is read-only.
 *
 */
class ReportFilterForm extends Model {

    public $weather_element;
    public $geo_level;
    public $region_id;
    public $district_id;
    public $ward_id;
    public $station_id;
    public $date;
    public $owner;
    public $station_type;

    /**
     * @return array the validation rules.
     */
    public function rules() {
        return [
            // username and password are both required
            [['date', 'geo_level'], 'required'],
            [['weather_element', 'geo_level', 'region_id', 'district_id', 'ward_id', 'station_id', 'date', 'owner', 'station_type'], 'safe'],
        ];
    }

    function getStations() {
        $where = array();
        if (isset($this->station_type) && !empty($this->station_type)) {
            $where['stationtype'] = $this->station_type;
        }
        if (isset($this->owner) && !empty($this->owner)) {
            $where['stationowner'] = $this->owner;
        }

        if (isset($this->region_id) && !empty($this->region_id)) {
            $where['regionid'] = $this->region_id;
        }
        if (isset($this->district_id) && !empty($this->district_id)) {
            $where['districtid'] = $this->district_id;
        }

        $query = \app\models\Station::find()->where($where);

       return new \yii\data\ActiveDataProvider([
            'query' => $query,
            'pagination' => [
                'pageSize' => 25,
            ],
            'sort' => [
                'defaultOrder' => [
                    'stationowner' => SORT_ASC,
                    'regionid' => SORT_ASC,
                    'districtid' => SORT_ASC,
                    'stationtype' => SORT_ASC,
                    'name' => SORT_ASC,
                    'stationcode' => SORT_ASC,
                ],
            ],
        ]);
    }

}
