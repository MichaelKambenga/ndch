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
 * @property string $datalocation
 * @property integer $datasourcetype
 *
 * @property TblDataSourceStations[] $tblDataSourceStations
 * @property TblStakeholder $stakeholder
 * @property TblWeatherData[] $tblWeatherDatas
 */
class DataSources extends \yii\db\ActiveRecord {

    //constants for data source types
    const DATA_SOURCE_FAILEBASED = 1;
    const DATA_SOURCE_DATABASESYSTEM = 2;
    
    /////AWS Datasources vendors. Please add a constant here in case a new vendor arrises
    const DATA_SOURCE_AWS_VAISALA = 1;
    const DATA_SOURCE_AWS_SEBA = 2;

    /**
     * @inheritdoc
     */
    public static function tableName() {
        return 'tbl_data_sources';
    }

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
                [['name', 'ipaddress', 'stakeholderid', 'datasourcetype', 'loginname', 'password'], 'required'],
            // [['ipaddress'], 'unique'],
            [['id', 'stakeholderid', 'datasourcetype', 'awsvendor'], 'integer'],
                [['awsvendor'], 'safe'],
                [['name', 'ipaddress'], 'string', 'max' => 50],
                [['datalocation'], 'string', 'max' => 255],
                [['stakeholderid'], 'exist', 'skipOnError' => true, 'targetClass' => Stakeholder::className(), 'targetAttribute' => ['stakeholderid' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels() {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'ipaddress' => 'Ip Address',
            'stakeholderid' => 'Data Source Owner',
            'datalocation' => 'Data File Path(Location)',
            'datasourcetype' => 'Data Source Type',
            'awsvendor' => 'AWS Vendor'
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTblDataSourceStations() {
        return $this->hasMany(DataSourceStations::className(), ['datasourceid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getStakeholder() {
        return $this->hasOne(takeholder::className(), ['id' => 'stakeholderid']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTblWeatherDatas() {
        return $this->hasMany(WeatherData::className(), ['source' => 'id']);
    }

    static function getDataSourceTypes() {
        return [
            self::DATA_SOURCE_FAILEBASED => 'File Based',
            self::DATA_SOURCE_DATABASESYSTEM => 'Database System',
        ];
    }

    public function getDataSourceTypeName() {
        $sourceTypes = self::getDataSourceTypes();
        if (isset($sourceTypes[$this->datasourcetype])) {
            return $sourceTypes[$this->datasourcetype];
        }
        return NULL;
    }

    static function getAWSDataSourceVendors() {
        return [
            self::DATA_SOURCE_AWS_VAISALA => 'VAISALA',
            self::DATA_SOURCE_AWS_SEBA => 'SEBA',
        ];
    }

    public function getAWSDataSourceVendorName() {
        $sourceTypes = self::getAWSDataSourceVendors();
        if (isset($sourceTypes[$this->awsvendor])) {
            return $sourceTypes[$this->awsvendor];
        }
        return NULL;
    }

}
