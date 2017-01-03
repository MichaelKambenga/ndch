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
class Stakeholder extends \yii\db\ActiveRecord {
    /*
     * contants for organiszation type
     */
    const ORG_TYPE_DATASOURCE=1;
    const ORG_TYPE_DATAREADONLY=2;
    const ORG_TYPE_DATAALL=3;

    /*
     * constants for organization status
     */
    const ORG_STATUS_ACTIVE = 1;
    const ORG_STATUS_INACTIVE = 2;

    /**
     * @inheritdoc
     */
    public static function tableName() {
        return 'tbl_stakeholder';
    }

    /**
     * @inheritdoc
     */
    public function rules() {
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
    public function attributeLabels() {
        return [
        'id' => 'ID',
        'name' => 'Name',
        'mobileno' => 'Mobile #',
        'email' => 'Email',
        'orgtype' => 'Organization Type',
        'datecreated' => 'Date Created',
        'status' => 'Status',
        'datedeactivated' => 'Datedeactivated',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTblDataSources() {
        return $this->hasMany(DataSources::className(), ['stakeholderid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTblStations() {
        return $this->hasMany(Station::className(), ['stationowner' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTblStations0() {
        return $this->hasMany(Station::className(), ['createdbyinsitutionid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTblUsers() {
        return $this->hasMany(User::className(), ['organizationid' => 'id']);
    }

    static function getOrganizationTypes() {
        return array(
            self::ORG_TYPE_DATASOURCE => 'Data Source',
            self::ORG_TYPE_DATAREADONLY => 'Data Readonly',
            self::ORG_TYPE_DATAALL => 'Data All'
        );
    }

    static function getOrganizationStatuses() {
        return [
        self::ORG_STATUS_ACTIVE => 'Active',
        self::ORG_STATUS_INACTIVE => 'In Active',
        ];
    }

    public function getOrgTypeName() {
        $orgTypes = self::getOrganizationTypes();
        if (isset($orgTypes[$this->orgtype])) {
            return $orgTypes[$this->orgtype];
        }
        return NULL;
    }

    public function getOrgStatusName() {
        $orgStatuses = self::getOrganizationStatuses();
        if (isset($orgStatuses[$this->status])) {
            return $orgStatuses[$this->status];
        }
        return NULL;
    }

    static function getStakeholderNameById($id) {
        $stakeholder = self::findOne($id);
        if ($stakeholder) {

            return $stakeholder->name;
        }
        return NULL;
    }

}
