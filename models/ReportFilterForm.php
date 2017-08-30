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
class ReportFilterForm extends Model
{
    public $weather_element;
    public $geo_level;
    public $region_id;
    public $district_id;
    public $ward_id;
    public $station_id;
    public $date;

    /**
     * @return array the validation rules.
     */
    public function rules()
    {
        return [
            // username and password are both required
             [['date', 'geo_level'], 'required'],
            [['weather_element', 'geo_level','region_id', 'district_id', 'ward_id', 'station_id', 'date'], 'safe'],
        ];
    }
}
