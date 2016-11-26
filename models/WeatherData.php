<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "tbl_weather_data".
 *
 * @property integer $id
 * @property integer $stationweatherelementsid
 * @property double $value
 * @property string $daterecorded
 * @property integer $source
 * @property string $entrydate
 * @property integer $entryby
 *
 * @property TblDataSources $source0
 * @property TblStationWeatherElements $stationweatherelements
 */
class WeatherData extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_weather_data';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['stationweatherelementsid', 'value', 'daterecorded', 'source'], 'required'],
            [['stationweatherelementsid', 'source', 'entryby'], 'integer'],
            [['value'], 'number'],
            [['daterecorded', 'entrydate'], 'safe'],
            [['source'], 'exist', 'skipOnError' => true, 'targetClass' => DataSources::className(), 'targetAttribute' => ['source' => 'id']],
            [['stationweatherelementsid'], 'exist', 'skipOnError' => true, 'targetClass' => StationWeatherElements::className(), 'targetAttribute' => ['stationweatherelementsid' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'stationweatherelementsid' => 'Stationweatherelementsid',
            'value' => 'Value',
            'daterecorded' => 'Daterecorded',
            'source' => 'Source',
            'entrydate' => 'Entrydate',
            'entryby' => 'Entryby',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSource0()
    {
        return $this->hasOne(DataSources::className(), ['id' => 'source']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getStationweatherelements()
    {
        return $this->hasOne(StationWeatherElements::className(), ['id' => 'stationweatherelementsid']);
    }
}
