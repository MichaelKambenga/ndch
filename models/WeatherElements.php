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
 * @property string $vaisalacode
 * @property string $vaisaladesc
 *
 * @property TblStationWeatherElements[] $tblStationWeatherElements
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
            [['unitmeasure'], 'string', 'max' => 10],
            [['vaisalacode','vaisaladesc'], 'string', 'max' => 50],
            [['name'], 'unique'],
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
            'unitmeasure' => 'Unitmeasure',
            'vaisalacode' => 'Vaisala Code',
            'vaisaladesc' => 'Vaisala Description',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTblStationWeatherElements()
    {
        return $this->hasMany(StationWeatherElements::className(), ['elementsid' => 'id']);
    }
}