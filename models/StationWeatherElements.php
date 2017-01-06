<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "tbl_station_weather_elements".
 *
 * @property integer $stationid
 * @property integer $elementsid
 * @property string $collectionfrequency
 * @property integer $id
 * @property double $accuracy
 * @property double $surfacedistance
 *
 * @property TblStation $station
 * @property TblWeatherElements $elements
 * @property TblWeatherData[] $tblWeatherDatas
 */
class StationWeatherElements extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_station_weather_elements';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['stationid', 'elementsid'], 'required'],
            [['stationid', 'elementsid'], 'integer'],
            [['accuracy', 'surfacedistance'], 'number'],
            [['collectionfrequency'], 'string', 'max' => 10],
            [['stationid'], 'exist', 'skipOnError' => true, 'targetClass' => Station::className(), 'targetAttribute' => ['stationid' => 'id']],
            [['elementsid'], 'exist', 'skipOnError' => true, 'targetClass' =>WeatherElements::className(), 'targetAttribute' => ['elementsid' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'stationid' => 'Station',
            'elementsid' => 'Weather Element',
            'collectionfrequency' => 'Data Collection Frequency (in Minutes)',
            'id' => 'Id',
            'accuracy' => 'Device Accuracy (in %)',
            'surfacedistance' => 'Device Surface Distance (in Meter)',
        ];
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
    public function getElements()
    {
        return $this->hasOne(WeatherElements::className(), ['id' => 'elementsid']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTblWeatherDatas()
    {
        return $this->hasMany(WeatherData::className(), ['stationweatherelementsid' => 'id']);
    }
}
