<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "tbl_weather_data".
 *
 * @property integer $id
 * @property double $value
 * @property string $daterecorded
 * @property integer $source
 * @property string $entrydate
 * @property integer $entryby
 * @property integer $stationid
 * @property integer $weatherelementid
 * @property integer $weatherelementlistid
 *
 * @property TblDataSources $source0
 * @property TblStation $station
 * @property TblWeatherElements $weatherelement
 * @property TblWeatherElementsList $weatherelementlist
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
            [['value', 'daterecorded', 'source'], 'required'],
            [['value'], 'number'],
            [['daterecorded', 'entrydate'], 'safe'],
            [['source', 'entryby', 'stationid', 'weatherelementid', 'weatherelementlistid'], 'integer'],
            [['source'], 'exist', 'skipOnError' => true, 'targetClass' => DataSources::className(), 'targetAttribute' => ['source' => 'id']],
            [['stationid'], 'exist', 'skipOnError' => true, 'targetClass' => Station::className(), 'targetAttribute' => ['stationid' => 'id']],
            [['weatherelementid'], 'exist', 'skipOnError' => true, 'targetClass' => WeatherElements::className(), 'targetAttribute' => ['weatherelementid' => 'id']],
            [['weatherelementlistid'], 'exist', 'skipOnError' => true, 'targetClass' => WeatherElementsList::className(), 'targetAttribute' => ['weatherelementlistid' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'value' => 'Value',
            'daterecorded' => 'Daterecorded',
            'source' => 'Source',
            'entrydate' => 'Entrydate',
            'entryby' => 'Entryby',
            'stationid' => 'Stationid',
            'weatherelementid' => 'Weatherelementid',
            'weatherelementlistid' => 'Weatherelementlistid',
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
    public function getStation()
    {
        return $this->hasOne(Station::className(), ['id' => 'stationid']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getWeatherelement()
    {
        return $this->hasOne(WeatherElements::className(), ['id' => 'weatherelementid']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getWeatherelementlist()
    {
        return $this->hasOne(WeatherElementsList::className(), ['id' => 'weatherelementlistid']);
    }
}
