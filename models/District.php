<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "tbl_district".
 *
 * @property integer $id
 * @property string $districtname
 * @property integer $regionid
 * @property string $datecreated
 *
 * @property TblRegion $region
 * @property TblStation[] $tblStations
 * @property TblWard[] $tblWards
 */
class District extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_district';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['districtname', 'regionid'], 'required'],
            [['regionid'], 'integer'],
            [['datecreated'], 'safe'],
            [['districtname'], 'string', 'max' => 100],
            [['districtname'], 'unique'],
            [['regionid'], 'exist', 'skipOnError' => true, 'targetClass' => Region::className(), 'targetAttribute' => ['regionid' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'Id',
            'districtname' => 'District Name',
            'regionid' => 'Region',
            'datecreated' => 'Date Created',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRegion()
    {
        return $this->hasOne(Region::className(), ['id' => 'regionid']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTblStations()
    {
        return $this->hasMany(Station::className(), ['districtid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTblWards()
    {
        return $this->hasMany(Ward::className(), ['districtid' => 'id']);
    }
      static function getDistrictNameById($id) {
        $district = self::findOne($id);
        if ($district) {

            return $district->districtname;
        }
        return NULL;
    }
}
