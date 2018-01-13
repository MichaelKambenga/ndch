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
    public $date_start;
    public $date_end;
    public $owner;
    public $station_type;

    /**
     * @return array the validation rules.
     */
    public function rules() {
        return [
            // username and password are both required
            //[['date', 'geo_level'], 'required'],
            [['date_start', 'date_end', 'station_id'], 'required', 'on' => ['daily']],
            [['date_start', 'date_end', 'weather_element'], 'required', 'on' => ['min-max-observations']],
            [['date_start', 'date_end', 'weather_element'], 'required', 'on' => ['observation']],
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

    function getStationsDailyObservations() {
        $where = array();
        $select = '*';

        if (isset($this->station_id) && !empty($this->station_id)) {
            $where['stationid'] = $this->station_id;
        }

        if (isset($this->weather_element) && !empty($this->weather_element)) {
            $select = $this->weather_element;
        } else {
            $select = '*';
        }

        $query = \app\models\WeatherData::find()->select($select)
                ->where('"TIME" >= :date_start AND "TIME" <= :date_end')
                ->addParams([':date_end' => $this->date_end, ':date_start' => $this->date_start])
                ->andWhere($where);

        return new \yii\data\ActiveDataProvider([
            'query' => $query,
            'pagination' => [
                'pageSize' => 25,
            ],
            'sort' => [
                'defaultOrder' => [
                    'TIME' => SORT_DESC,
                ],
            ],
        ]);
    }

    function getStationsObservations() {
        $where = array();
        $select = '*';

        if (isset($this->station_id) && !empty($this->station_id)) {
            $where['stationid'] = $this->station_id;
        }

        if (isset($this->weather_element) && !empty($this->weather_element)) {
            $select = 'stationid,"TIME",' . $this->weather_element;
        } else {
            $select = '*';
        }

        $query = \app\models\WeatherData::find()->select($select)
                ->where('"TIME" >= :date_start AND "TIME" <= :date_end')
                ->addParams([':date_end' => $this->date_end, ':date_start' => $this->date_start])
                ->andWhere($where);

        return new \yii\data\ActiveDataProvider([
            'query' => $query,
            'pagination' => [
                'pageSize' => 50,
            ],
            'sort' => [
                //'stationid'=>SORT_ASC,
                'defaultOrder' => [
                    'TIME' => SORT_DESC,
                ],
            ],
        ]);
    }

    function getStationsLatestObservationsTimes() {
        $where = array();

        if (isset($this->station_id) && !empty($this->station_id)) {
            $where['stationid'] = $this->station_id;
        }

        $query = \app\models\WeatherData::find()->select('stationid,MAX("TIME") AS "TIME"')
                ->where($where)
                ->groupBy('stationid')
                ->orderBy('"TIME" DESC');

        return new \yii\data\ActiveDataProvider([
            'query' => $query,
            'pagination' => [
                'pageSize' => 50,
            ],
            'sort' => [
                'defaultOrder' => [
                    'TIME' => SORT_DESC,
                ],
            ],
        ]);
    }

    static function getStationDataStationIDandByDate($StationID, $Time, $attribute) {

        $data = WeatherData::find()
                ->select($attribute)
                ->where('stationid =:id AND "TIME"=:time', [':id' => $StationID, ':time' => $Time])
                ->orderBy('"TIME" DESC')
                ->one();
        if ($data) {
            return $data->$attribute;
        }
        return NULL;
    }

    function getMinMaxObservationsTimes() {
        $where = array();
        if (isset($this->station_id) && !empty($this->station_id)) {
            $where['stationid'] = $this->station_id;
        }
        $query = \app\models\WeatherData::find()->select('stationid,MIN("' . $this->weather_element . '") AS "MinValue",MAX("' . $this->weather_element . '") AS "MaxValue"')
                ->join('RIGHT JOIN', 'tbl_station', 'tbl_station.id=tbl_weather_data.stationid')
                ->where($where)
                ->andWhere('"TIME" >=:startdatetime AND "TIME" <=:enddatetime', [':startdatetime' => $this->date_start, ':enddatetime' => $this->date_end])
                ->groupBy('stationid');

        return new \yii\data\ActiveDataProvider([
            'query' => $query,
            'pagination' => [
                'pageSize' => 50,
            ],
            'sort' => [
                'defaultOrder' => [
                    'stationid' => SORT_DESC,
                ],
            ],
        ]);
    }

}
