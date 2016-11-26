<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "tbl_stakeholder".
 *
 * @property integer $id
 * @property string $name
 * @property string $mobileno
 * @property string $email
 * @property integer $orgtype
 * @property string $datecreated
 * @property integer $status
 * @property string $datedeactivated
 *
 * @property TblDataSources[] $tblDataSources
 * @property TblStation[] $tblStations
 * @property TblStation[] $tblStations0
 * @property TblUser[] $tblUsers
 */
class Stakeholder extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_stakeholder';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'orgtype'], 'required'],
            [['orgtype', 'status'], 'integer'],
            [['datecreated', 'datedeactivated'], 'safe'],
            [['name', 'mobileno', 'email'], 'string', 'max' => 100],
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
            'mobileno' => 'Mobileno',
            'email' => 'Email',
            'orgtype' => 'Orgtype',
            'datecreated' => 'Datecreated',
            'status' => 'Status',
            'datedeactivated' => 'Datedeactivated',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTblDataSources()
    {
        return $this->hasMany(DataSources::className(), ['stakeholderid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTblStations()
    {
        return $this->hasMany(Station::className(), ['stationowner' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTblStations0()
    {
        return $this->hasMany(Station::className(), ['createdbyinsitutionid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTblUsers()
    {
        return $this->hasMany(User::className(), ['organizationid' => 'id']);
    }
}
