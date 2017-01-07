<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "tbl_weather_elements_list".
 *
 * @property integer $id
 * @property string $itemname
 * @property string $itemcode
 * @property integer $elementid
 *
 * @property TblWeatherData[] $tblWeatherDatas
 * @property TblWeatherElements $element
 */
class WeatherElementsList extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_weather_elements_list';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['itemname'], 'required'],
            [['itemname'], 'unique'],
            [['itemname', 'itemcode'], 'string'],
            [['elementid'], 'integer'],
            [['elementid'], 'exist', 'skipOnError' => true, 'targetClass' =>WeatherElements::className(), 'targetAttribute' => ['elementid' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'itemname' => 'Item Name',
            'itemcode' => 'Item Code',
            'elementid' => 'Element',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTblWeatherDatas()
    {
        return $this->hasMany(WeatherData::className(), ['weatherelementlistid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getElement()
    {
        return $this->hasOne(WeatherElements::className(), ['id' => 'elementid']);
    }
}
