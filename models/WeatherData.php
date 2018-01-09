<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "tbl_weather_data".
 *
 * @property int $id
 * @property string $TIME Date Time  Data was recorded from the Station
 * @property double $DP
 * @property double $DP1HA
 * @property string $DP1HX
 * @property string $DP1HM
 * @property string $PA
 * @property string $PA1HA
 * @property string $PA1HX
 * @property string $PA1HM
 * @property string $PR
 * @property string $PR1HS
 * @property string $PR24HS
 * @property string $PR5MS00
 * @property string $PR5MS05
 * @property string $PR5MS10
 * @property string $PR5MS15
 * @property string $PR5MS20
 * @property string $PR5MS25
 * @property string $PR5MS30
 * @property string $PR5MS35
 * @property string $PR5MS40
 * @property string $PR5MS45
 * @property string $PR5MS50
 * @property string $PR5MS55
 * @property string $RH
 * @property string $RH1HA
 * @property string $RH1HX
 * @property string $RH1HM
 * @property string $SR
 * @property string $SR1HA
 * @property string $SR1HX
 * @property string $SR1HM
 * @property string $TA
 * @property string $TA1HA
 * @property string $TA1HX
 * @property string $TA1HM
 * @property string $WD
 * @property string $WD2MA
 * @property string $WD10MA
 * @property string $WD2MX
 * @property string $WD10MX
 * @property string $WD2MM
 * @property string $WD10MM
 * @property string $WD1HA
 * @property string $WD1HX
 * @property string $WD1HM
 * @property string $WS
 * @property string $WS2MA
 * @property string $WS10MA
 * @property string $WS2MX
 * @property string $WS10MX
 * @property string $WS2MM
 * @property string $WS10MM
 * @property string $QFE
 * @property string $QFE1HA
 * @property string $QFE1HX
 * @property string $QFE1HM
 * @property string $QFF
 * @property string $QFF1HA
 * @property string $QFF1HX
 * @property string $QFF1HM
 * @property string $QNH
 * @property string $QNH1HA
 * @property string $QNH1HX
 * @property string $QNH1HM
 * @property string $ETO
 * @property string $Path
 * @property string $StationName
 * @property string $VaisalaVersion
 * @property string $EntryDate Date and time the entry was recorded into the database
 * @property int $stationid FK, reference to the station
 * @property int $source the source of the given entry 1=vaisala, 2=seba,3=manned
 */
class WeatherData extends \yii\db\ActiveRecord {

    const DATA_DOURCE_MANNED_SYSTEM = 1;
    const DATA_SOURCE_AWS_SYSTEM = 2;
    const DATA_SOURCE_EXISTING_DATABASE = 3;
    ////constants for AWS Type
    const AWS_VAISALA = 1;
    const AWS_SEBA = 2;
        public $counts;

    ///constants for weather elements
//    const PA = 'PA'; //Pressure of the atmosphere
//    const DP = 'DP'; //dew point
//    const PR = 'PR'; //precipitation
//    const RH = 'RH'; //re;ative humidity
//    const SR = 'SR'; //solar radiation
//    const WS = 'WS'; //wind speed
//    const ETO = 'ETO'; ///evapo trap
///
//placeholder variable for weather element
    public $weather_element;

    /**
     * @inheritdoc
     */
    public static function tableName() {
        return 'tbl_weather_data';
    }

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
            [['TIME', 'stationid'], 'required'],
            [['TIME'], 'date', 'format' => 'php:Y-m-d H:i:s'],
            [['TIME'], 'validStationData'],
            [['PA', 'DP', 'PR', 'RH', 'SR', 'WS', 'ETO'], 'number'],
            [['TIME'], 'validDate'],
            [['id', 'stationid', 'source'], 'integer'],
            [['PA', 'DP', 'PR', 'RH', 'SR', 'TA', 'WS', 'WD', 'ETO', 'EntryDate','counts'], 'safe'],
            [['TIME'], 'string', 'max' => 40],
            [['DP1HX', 'DP1HM', 'PA', 'PA1HA', 'PA1HX', 'PA1HM', 'PR', 'PR1HS', 'PR24HS', 'PR5MS00', 'PR5MS05', 'PR5MS10', 'PR5MS15', 'PR5MS20', 'PR5MS25', 'PR5MS30', 'PR5MS35', 'PR5MS40', 'PR5MS45', 'PR5MS50', 'PR5MS55', 'RH', 'RH1HA', 'RH1HX', 'RH1HM', 'SR', 'SR1HA', 'SR1HX', 'SR1HM', 'TA', 'TA1HA', 'TA1HX', 'TA1HM', 'WD', 'WD2MA', 'WD10MA', 'WD2MX', 'WD10MX', 'WD2MM', 'WD10MM', 'WD1HA', 'WD1HX', 'WD1HM', 'WS', 'WS2MA', 'WS10MA', 'WS2MX', 'WS10MX', 'WS2MM', 'WS10MM', 'QFE', 'QFE1HA', 'QFE1HX', 'QFE1HM', 'QFF', 'QFF1HA', 'QFF1HX', 'QFF1HM', 'QNH', 'QNH1HA', 'QNH1HX', 'QNH1HM', 'ETO'], 'string', 'max' => 20],
            [['Path'], 'string', 'max' => 255],
            [['StationName'], 'string', 'max' => 50],
            [['VaisalaVersion'], 'string', 'max' => 30],
            [['weather_element'], 'safe']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels() {
        return [
            'id' => 'ID',
            'TIME' => 'Date Recorded',
            'DP' => 'Due Point',
            'DP1HA' => 'DP1HA',
            'DP1HX' => 'DP1HX',
            'DP1HM' => 'DP1HM',
            'PA' => 'Pressure',
            'PA1HA' => 'PA1HA',
            'PA1HX' => 'PA1HX',
            'PA1HM' => 'PA1HM',
            'PR' => 'Precipitation',
            'PR1HS' => 'PR1HS',
            'PR24HS' => 'PR24HS',
            'PR5MS00' => 'PR5MS00',
            'PR5MS05' => 'PR5MS05',
            'PR5MS10' => 'PR5MS10',
            'PR5MS15' => 'PR5MS15',
            'PR5MS20' => 'PR5MS20',
            'PR5MS25' => 'PR5MS25',
            'PR5MS30' => 'PR5MS30',
            'PR5MS35' => 'PR5MS35',
            'PR5MS40' => 'PR5MS40',
            'PR5MS45' => 'PR5MS45',
            'PR5MS50' => 'PR5MS50',
            'PR5MS55' => 'PR5MS55',
            'RH' => 'Relative Humidity',
            'RH1HA' => 'RH1HA',
            'RH1HX' => 'RH1HX',
            'RH1HM' => 'RH1HM',
            'SR' => 'Solar Radiation',
            'SR1HA' => 'SR1HA',
            'SR1HX' => 'SR1HX',
            'SR1HM' => 'SR1HM',
            'TA' => 'Atmospheric Temperature',
            'TA1HA' => 'TA1HA',
            'TA1HX' => 'TA1HX',
            'TA1HM' => 'TA1HM',
            'WD' => 'Wind Direction',
            'WD2MA' => 'WD2MA',
            'WD10MA' => 'WD10MA',
            'WD2MX' => 'WD2MX',
            'WD10MX' => 'WD10MX',
            'WD2MM' => 'WD2MM',
            'WD10MM' => 'WD10MM',
            'WD10MM' => 'WD10MM',
            'WD1HX' => 'WD1HX',
            'WD1HM' => 'WD1HM',
            'WS' => 'Wind Speed',
            'WS2MA' => 'WS2MA',
            'WS10MA' => 'WS10MA',
            'WS2MX' => 'WS2MX',
            'WS10MX' => 'WS10MX',
            'WS2MM' => 'WS2MM',
            'WS10MM' => 'WS10MM',
            'QFE' => 'QFE',
            'QFE1HA' => 'QFE1HA',
            'QFE1HX' => 'QFE1HX',
            'QFE1HM' => 'QFE1HM',
            'QFF' => 'QFF',
            'QFF1HA' => 'QFF1HA',
            'QFF1HX' => 'QFF1HX',
            'QFF1HM' => 'QFF1HM',
            'QNH' => 'QNH',
            'QNH1HA' => 'QNH1HA',
            'QNH1HX' => 'QNH1HX',
            'QNH1HM' => 'QNH1HM',
            'ETO' => 'Evapo Transpiration',
            'Path' => 'Path',
            'StationName' => 'Station Name',
            'VaisalaVersion' => 'Vaisala Version',
            'EntryDate' => 'Entry Date',
            'stationid' => 'Station',
            'source' => 'Source',
        ];
    }

    public static function processWeatherData($data_dump_model, $aws_type, $station_id) {
        $weather_data = new WeatherData;
        $weather_data->stationid = $station_id;
        $weather_data->source = WeatherData::DATA_SOURCE_AWS_SYSTEM;
        $weather_data->EntryDate = $data_dump_model->EntryDate;
        switch ($aws_type) {
            case WeatherData::AWS_VAISALA:
                $weather_data->TIME = $data_dump_model->TIME;
                $weather_data->DP = $data_dump_model->DP;
                $weather_data->DP1HA = $data_dump_model->DP1HA;
                $weather_data->DP1HX = $data_dump_model->DP1HX;
                $weather_data->DP1HM = $data_dump_model->DP1HM;
                $weather_data->PA = $data_dump_model->PA;
                $weather_data->PA1HA = $data_dump_model->PA1HA;
                $weather_data->PA1HX = $data_dump_model->PA1HX;
                $weather_data->PA1HM = $data_dump_model->PA1HM;
                $weather_data->PR = $data_dump_model->PR;
                $weather_data->PR1HS = $data_dump_model->PR1HS;
                $weather_data->PR24HS = $data_dump_model->PR24HS;
                $weather_data->PR5MS00 = $data_dump_model->PR5MS00;
                $weather_data->PR5MS05 = $data_dump_model->PR5MS05;
                $weather_data->PR5MS10 = $data_dump_model->PR5MS10;
                $weather_data->PR5MS15 = $data_dump_model->PR5MS15;
                $weather_data->PR5MS20 = $data_dump_model->PR5MS20;
                $weather_data->PR5MS25 = $data_dump_model->PR5MS25;
                $weather_data->PR5MS30 = $data_dump_model->PR5MS30;
                $weather_data->PR5MS35 = $data_dump_model->PR5MS35;
                $weather_data->PR5MS40 = $data_dump_model->PR5MS40;
                $weather_data->PR5MS45 = $data_dump_model->PR5MS45;
                $weather_data->PR5MS50 = $data_dump_model->PR5MS50;
                $weather_data->PR5MS55 = $data_dump_model->PR5MS55;
                $weather_data->RH = $data_dump_model->RH;
                $weather_data->RH1HA = $data_dump_model->RH1HA;
                $weather_data->RH1HX = $data_dump_model->RH1HX;
                $weather_data->RH1HM = $data_dump_model->RH1HM;
                $weather_data->SR = $data_dump_model->SR;
                $weather_data->SR1HA = $data_dump_model->SR1HA;
                $weather_data->SR1HX = $data_dump_model->SR1HX;
                $weather_data->SR1HM = $data_dump_model->SR1HM;
                $weather_data->TA = $data_dump_model->TA;
                $weather_data->TA1HA = $data_dump_model->TA1HA;
                $weather_data->TA1HX = $data_dump_model->TA1HX;
                $weather_data->TA1HM = $data_dump_model->TA1HM;
                $weather_data->WD = $data_dump_model->WD;
                $weather_data->WD2MA = $data_dump_model->WD2MA;
                $weather_data->WD10MA = $data_dump_model->WD10MA;
                $weather_data->WD2MX = $data_dump_model->WD2MX;
                $weather_data->WD10MX = $data_dump_model->WD10MX;
                $weather_data->WD2MM = $data_dump_model->WD2MM;
                $weather_data->WD10MM = $data_dump_model->WD10MM;
                $weather_data->WD1HA = $data_dump_model->WD1HA;
                $weather_data->WD1HX = $data_dump_model->WD1HX;
                $weather_data->WD1HM = $data_dump_model->WD1HM;
                $weather_data->WS = $data_dump_model->WS;
                $weather_data->WS2MA = $data_dump_model->WS2MA;
                $weather_data->WS10MA = $data_dump_model->WS10MA;
                $weather_data->WS2MX = $data_dump_model->WS2MX;
                $weather_data->WS10MX = $data_dump_model->WS10MX;
                $weather_data->WS2MM = $data_dump_model->WS2MM;
                $weather_data->WS10MM = $data_dump_model->WS10MM;
                $weather_data->QFE = $data_dump_model->QFE;
                $weather_data->QFE1HA = $data_dump_model->QFE1HA;
                $weather_data->QFE1HX = $data_dump_model->QFE1HX;
                $weather_data->QFE1HM = $data_dump_model->QFE1HM;
                $weather_data->QFF = $data_dump_model->QFF;
                $weather_data->QFF1HA = $data_dump_model->QFF1HA;
                $weather_data->QFF1HX = $data_dump_model->QFF1HX;
                $weather_data->QFF1HM = $data_dump_model->QFF1HM;
                $weather_data->QNH = $data_dump_model->QNH;
                $weather_data->QNH1HA = $data_dump_model->QNH1HA;
                $weather_data->QNH1HX = $data_dump_model->QNH1HX;
                $weather_data->QNH1HM = $data_dump_model->QNH1HM;
                $weather_data->ETO = $data_dump_model->ETO;
                $weather_data->Path = $data_dump_model->Path;
                $weather_data->StationName = $data_dump_model->StationName;
                $weather_data->VaisalaVersion = $data_dump_model->VaisalaVersion;
                break;

            case WeatherData::AWS_SEBA:
                $weather_data->TIME = $data_dump_model->TIME;
                $weather_data->PA = $data_dump_model->P_L;
                $weather_data->PR = $data_dump_model->CH;
                $weather_data->RH = $data_dump_model->H_L;
                $weather_data->SR = $data_dump_model->G;
                $weather_data->TA = $data_dump_model->T_L;
                $weather_data->WD = $data_dump_model->D;
                $weather_data->WS = $data_dump_model->U;
                break;
            //add new case when new vendor for AWS available
        }
        $weather_data->save();
    }

    static function getSources() {
        return [
            self::DATA_DOURCE_MANNED_SYSTEM => 'Manned Recorded Data',
            self::DATA_SOURCE_AWS_SYSTEM => 'Automatic Weather Station',
            self::DATA_SOURCE_EXISTING_DATABASE => 'Existing Database System'
        ];
    }

    function getSourceNameByValue() {
        $sources = self::getSources();
        if (isset($sources[$this->source])) {
            return $sources[$this->source];
        }
        return NULL;
    }

    function validDate() {
        if (!empty($this->TIME)) {
            $DATE = $this->TIME;
            $DATE = Date('Y-m-d', strtotime($DATE));
            $DATE = trim($DATE);
            if (!empty($DATE) && $DATE <= Date('Y-m-d', time())) {
                return TRUE;
            }
            $this->addError($this->TIME, 'Time Required or Wrong Date Time entered');
            return FALSE;
        }
        $this->addError($this->TIME, 'Time Required');
        return FALSE;
    }

    function validStationData() {
        if (!empty($this->TIME) && !empty($this->stationid)) {
            if (WeatherData::find()->where(['TIME' => $this->TIME, 'stationid' => $this->stationid])->exists()) {
                $this->addError($this->TIME, 'Station data for ' . $this->TIME . ' exist please Check');
                return FALSE;
            } elseif (empty($this->DP) && empty($this->PA) && empty($this->PR) && empty($this->RH) && empty($this->SR) && empty($this->TA) && empty($this->WD) && empty($this->WS) && empty($this->ETO)) {
                $this->addError($this->id, 'Please fill the form correctly');
                return FALSE;
            }
            return TRUE;
        }
    }

    static function getAWSTypes() {
        return [
            self::AWS_SEBA => 'Seba',
            self::AWS_VAISALA => 'Vaisala',
        ];
    }

}
