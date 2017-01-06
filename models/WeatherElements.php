<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "tbl_weather_elements".
 *
 * @property integer $id
 * @property string $name
 * @property string $unitmeasure
 * @property string $elementcode
 *
 * @property TblStationWeatherElements[] $tblStationWeatherElements
 * @property TblWeatherData[] $tblWeatherDatas
 * @property TblWeatherElementsList[] $tblWeatherElementsLists
 */
class WeatherElements extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_weather_elements';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'unitmeasure'], 'required'],
            [['name'], 'string', 'max' => 100],
            [['name'], 'unique'],
            [['unitmeasure'], 'string', 'max' => 10],
            [['elementcode'], 'string', 'max' => 50],
            
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Element Name',
            'unitmeasure' => 'Unit Measure',
            'elementcode' => 'Element Code',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTblStationWeatherElements()
    {
        return $this->hasMany(StationWeatherElements::className(), ['elementsid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTblWeatherDatas()
    {
        return $this->hasMany(WeatherData::className(), ['weatherelementid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTblWeatherElementsLists()
    {
        return $this->hasMany(WeatherElementsList::className(), ['elementid' => 'id']);
    }
    
    static function getElementNameById($id){
        $data=self::findOne($id);
        if ($data) {
            return $data->name;
        }
        return NULL;
    }
}
