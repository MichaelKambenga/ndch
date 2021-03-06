<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "tbl_station".
 *
 * @property integer $id
 * @property string $name
 * @property string $stationcode
 * @property integer $stationtype
 * @property integer $stationowner
 * @property string $geocode
 * @property integer $regionid
 * @property integer $districtid
 * @property integer $wardid
 * @property string $datecreated
 * @property integer $createdby
 * @property integer $createdbyinsitutionid
 *
 * @property TblDataSources[] $tblDataSources
 * @property TblDistrict $district
 * @property TblRegion $region
 * @property TblStakeholder $stationowner0
 * @property TblStakeholder $createdbyinsitution
 * @property TblUser $createdby0
 * @property TblWard $ward
 * @property TblStationWeatherElements[] $tblStationWeatherElements
 */
class Station extends \yii\db\ActiveRecord {
    /*
     * contants for organiszation type
     */

    const STATION_TYPE_MANNED = 1;  /// for stations operating only manualy
    const STATION_TYPE_AUTOMATIC = 2; /// for stations operating under AWS only
    const STATION_TYPE_BOTH = 3; /// for stations operating using Manual and AWS
//station statuses
    const STATION_STATUS_ACTIVE = 1;
    const STATION_STATUS_CLOSED = 0;

    /**
     * @inheritdoc
     */
    public static function tableName() {
        return 'tbl_station';
    }

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
            [['name', 'stationtype', 'stationowner', 'regionid', 'districtid', 'createdby', 'createdbyinsitutionid', 'operationalstartdate'], 'required'],
            [['name'], 'string', 'max' => 100],
            [['name'], 'unique'],
            [['stationtype', 'stationowner', 'regionid', 'districtid', 'wardid', 'createdby', 'createdbyinsitutionid'], 'integer'],
            [['datecreated', 'heightanemometer', 'heightbarometer', 'heightraingauge', 'thermometer', 'hygrometer', 'barometer', 'anemometer', 'raingauge', 'generalcomment', 'operationalenddate'], 'safe'],
            [['stationcode'], 'string', 'max' => 20],
            [['geocode'], 'string', 'max' => 255],
            [['districtid'], 'exist', 'skipOnError' => true, 'targetClass' => District::className(), 'targetAttribute' => ['districtid' => 'id']],
            [['regionid'], 'exist', 'skipOnError' => true, 'targetClass' => Region::className(), 'targetAttribute' => ['regionid' => 'id']],
            [['stationowner'], 'exist', 'skipOnError' => true, 'targetClass' => Stakeholder::className(), 'targetAttribute' => ['stationowner' => 'id']],
            [['createdbyinsitutionid'], 'exist', 'skipOnError' => true, 'targetClass' => Stakeholder::className(), 'targetAttribute' => ['createdbyinsitutionid' => 'id']],
            [['createdby'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['createdby' => 'id']],
            [['wardid'], 'exist', 'skipOnError' => true, 'targetClass' => Ward::className(), 'targetAttribute' => ['wardid' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels() {
        return [
            'id' => 'ID',
            'name' => 'Station Name',
            'stationcode' => 'Station No (Code)',
            'stationtype' => 'Station Type',
            'stationowner' => 'Station Owner',
            'geocode' => 'GeoCode',
            'regionid' => 'Region',
            'districtid' => 'District',
            'wardid' => 'Ward',
            'datecreated' => 'Date Created',
            'createdby' => 'Created By',
            'createdbyinsitutionid' => 'Createdbyinsitutionid',
            'heightbarometer' => 'Heightof the Barometer',
            'heightraingauge' => 'Height of the Rain Gauge',
            'thermometer' => 'Termometer',
            'hygrometer' => 'Hygrometer',
            'barometer' => 'Barometer',
            'anemometer' => 'Anemometer',
            'raingauge' => 'Rain gauge',
            'generalcomment' => 'General Comment',
            'operationalenddate' => 'Launch Date',
            'operationalenddate' => 'Date Closed'
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTblDataSources() {
        return $this->hasMany(DataSources::className(), ['stationid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDistrict() {
        return $this->hasOne(District::className(), ['id' => 'districtid']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRegion() {
        return $this->hasOne(Region::className(), ['id' => 'regionid']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getStationowner0() {
        return $this->hasOne(Stakeholder::className(), ['id' => 'stationowner']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCreatedbyinsitution() {
        return $this->hasOne(Stakeholder::className(), ['id' => 'createdbyinsitutionid']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCreatedby0() {
        return $this->hasOne(User::className(), ['id' => 'createdby']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getWard() {
        return $this->hasOne(Ward::className(), ['id' => 'wardid']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTblStationWeatherElements() {
        return $this->hasMany(StationWeatherElements::className(), ['stationid' => 'id']);
    }

    static function getStationTypes() {
        return [
            self::STATION_TYPE_MANNED => 'Manned Station',
            self::STATION_TYPE_AUTOMATIC => 'Automatic Station',
            self::STATION_TYPE_BOTH => 'Both (Manned & Automatic)'
        ];
    }

//    static function getOrganizationStatuses() {
//        return [
//            self::ORG_STATUS_ACTIVE => 'Active',
//            self::ORG_STATUS_INACTIVE => 'In Active',
//        ];
//    }

    public function getStationTypeName() {
        $stationTypes = self::getStationTypes();
        if (isset($stationTypes[$this->stationtype])) {
            return $stationTypes[$this->stationtype];
        }
        return NULL;
    }
     public function getStationTypeNameByValue($stationtype) {
        $stationTypes = self::getStationTypes();
        if (isset($stationTypes[$stationtype])) {
            return $stationTypes[$stationtype];
        }
        return NULL;
    }

    static function getNameById($id) {
        $data = self::findOne($id);
        if ($data) {
            return $data->name;
        }
        return NULL;
    }

    static function getDetailsByName($Stationname) {
        $data = self::find(array('name' => $Stationname))->one();
        if ($data) {
            return $data;
        }
        return NULL;
    }

    static function getStationStatuses() {
        return [
            self::STATION_STATUS_ACTIVE => 'Active/Operating',
            self::STATION_STATUS_CLOSED => 'Closed/Not Operating',
        ];
    }

    function getStationStatusName() {
        if ($this->status) {
            $statuses = self::getStationStatuses();
            if ($statuses && isset($statuses[$this->status])) {
                return $statuses[$this->status];
            }
        }
        return NULL;
    }

    static function getUserStations() {
        $condition = NULL;
        if (\yii::$app->user->identity->organizationid) {
            $condition = array(
                'stationowner' => \yii::$app->user->identity->organizationid
            );
        }
        return self::find()->where($condition)->all();
    }

}
