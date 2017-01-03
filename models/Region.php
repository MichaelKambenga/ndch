<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "tbl_region".
 *
 * @property integer $id
 * @property string $regionname
 * @property string $datecreated
 *
 * @property TblDistrict[] $tblDistricts
 * @property TblStation[] $tblStations
 */
class Region extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_region';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['regionname'], 'required'],
            [['datecreated'], 'safe'],
            [['regionname'], 'string', 'max' => 100],
            [['regionname'], 'unique'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'regionname' => 'Region Name',
            'datecreated' => 'Date Created',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTblDistricts()
    {
        return $this->hasMany(District::className(), ['regionid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTblStations()
    {
        return $this->hasMany(Station::className(), ['regionid' => 'id']);
    }
    
     static function getRegionNameById($id) {
        $region = self::findOne($id);
        if ($region) {

            return $region->regionname;
        }
        return NULL;
    }
}
