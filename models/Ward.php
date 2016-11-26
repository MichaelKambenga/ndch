<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "tbl_ward".
 *
 * @property integer $id
 * @property string $wardname
 * @property integer $districtid
 *
 * @property TblStation[] $tblStations
 * @property TblDistrict $district
 */
class Ward extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_ward';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['wardname', 'districtid'], 'required'],
            [['districtid'], 'integer'],
            [['wardname'], 'string', 'max' => 45],
            [['districtid'], 'exist', 'skipOnError' => true, 'targetClass' => District::className(), 'targetAttribute' => ['districtid' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'wardname' => 'Wardname',
            'districtid' => 'Districtid',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTblStations()
    {
        return $this->hasMany(Station::className(), ['wardid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDistrict()
    {
        return $this->hasOne(District::className(), ['id' => 'districtid']);
    }
}
