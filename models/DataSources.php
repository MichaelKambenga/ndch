<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "tbl_data_sources".
 *
 * @property integer $id
 * @property string $name
 * @property string $ipaddress
 * @property integer $stakeholderid
 * @property integer $stationid
 *
 * @property TblStakeholder $stakeholder
 * @property TblStation $station
 * @property TblWeatherData[] $tblWeatherDatas
 */
class DataSources extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_data_sources';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'stakeholderid', 'stationid'], 'required'],
            [['id', 'stakeholderid', 'stationid'], 'integer'],
            [['name', 'ipaddress'], 'string', 'max' => 50],
            [['stakeholderid'], 'exist', 'skipOnError' => true, 'targetClass' => Stakeholder::className(), 'targetAttribute' => ['stakeholderid' => 'id']],
            [['stationid'], 'exist', 'skipOnError' => true, 'targetClass' => Station::className(), 'targetAttribute' => ['stationid' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'ipaddress' => 'Ipaddress',
            'stakeholderid' => 'Stakeholderid',
            'stationid' => 'Stationid',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getStakeholder()
    {
        return $this->hasOne(Stakeholder::className(), ['id' => 'stakeholderid']);
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
    public function getTblWeatherDatas()
    {
        return $this->hasMany(WeatherData::className(), ['source' => 'id']);
    }
}
