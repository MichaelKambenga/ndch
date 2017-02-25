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
    const DATA_DOURCE_MANNED_SYSTEM=1;
    const DATA_SOURCE_AWS_SYSTEM=2;
    const DATA_SOURCE_EXISTING_DATABASE=3;

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
            [['value', 'daterecorded','stationid', 'source'], 'required'],
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
            'daterecorded' => 'Date Recorded',
            'source' => 'Source',
            'entrydate' => 'Entry Date',
            'entryby' => 'Entry By',
            'stationid' => 'Station',
            'weatherelementid' => 'Weather Element',
            'weatherelementlistid' => 'Weather Element List',
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
