<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "tbl_aws_vaisala".
 *
 * @property integer $id
 * @property string $TIME
 * @property double $BAT
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
 * @property string $a
 * @property string $p
 * @property string $ETO
 * @property string $Path
 * @property string $StationName
 * @property string $VaisalaVersion
 * @property string $EntryDate
 */
class AwsVaisala extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_aws_vaisala';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['BAT', 'DP', 'DP1HA'], 'number'],
            [['EntryDate'], 'safe'],
            [['TIME'], 'string', 'max' => 40],
            [['DP1HX', 'DP1HM', 'PA', 'PA1HA', 'PA1HX', 'PA1HM', 'PR', 'PR1HS', 'PR24HS', 'PR5MS00', 'PR5MS05', 'PR5MS10', 'PR5MS15', 'PR5MS20', 'PR5MS25', 'PR5MS30', 'PR5MS35', 'PR5MS40', 'PR5MS45', 'PR5MS50', 'PR5MS55', 'RH', 'RH1HA', 'RH1HX', 'RH1HM', 'SR', 'SR1HA', 'SR1HX', 'SR1HM', 'TA', 'TA1HA', 'TA1HX', 'TA1HM', 'WD', 'WD2MA', 'WD10MA', 'WD2MX', 'WD10MX', 'WD2MM', 'WD10MM', 'WD1HA', 'WD1HX', 'WD1HM', 'WS', 'WS2MA', 'WS10MA', 'WS2MX', 'WS10MX', 'WS2MM', 'WS10MM', 'QFE', 'QFE1HA', 'QFE1HX', 'QFE1HM', 'QFF', 'QFF1HA', 'QFF1HX', 'QFF1HM', 'QNH', 'QNH1HA', 'QNH1HX', 'QNH1HM', 'a', 'p', 'ETO'], 'string', 'max' => 20],
            [['Path'], 'string', 'max' => 255],
            [['StationName'], 'string', 'max' => 50],
            [['VaisalaVersion'], 'string', 'max' => 30],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'TIME' => 'Time',
            'BAT' => 'Battery Voltage',
            'DP' => 'Instant Dew point',
            'DP1HA' => 'One hour dew point',
            'DP1HX' => 'One hour max dew point',
            'DP1HM' => 'One hour min dew point',
            'PA' => 'Instant Atmospheric pressure',
            'PA1HA' => 'One hour atmospheric pressure',
            'PA1HX' => 'One hour max pressure',
            'PA1HM' => 'One hour min pressure',
            'PR' => 'Precipitation one minute instant sum',
            'PR1HS' => 'Precipitation one hour sum',
            'PR24HS' => 'Precipitation 24 hour counter sum',
            'PR5MS00' => 'Precipitation all 0 minute sum',
            'PR5MS05' => 'Precipitation all 5 minute sum',
            'PR5MS10' => 'Precipitation all 10 minute sum',
            'PR5MS15' => 'Precipitation all 15 minute sum',
            'PR5MS20' => 'Precipitation all 20minute sum',
            'PR5MS25' => 'Precipitation all 25 minute sum',
            'PR5MS30' => 'Precipitation all 30 minute sum',
            'PR5MS35' => 'Precipitation all 35 minute sum',
            'PR5MS40' => 'Precipitation all 40 minute sum',
            'PR5MS45' => 'Precipitation all 45 minute sum',
            'PR5MS50' => 'Precipitation all 50 minute sum',
            'PR5MS55' => 'Precipitation all 55 minute sum',
            'RH' => 'Instant Relative Humidity',
            'RH1HA' => 'One hour relative humidity',
            'RH1HX' => 'One hour max RH',
            'RH1HM' => 'One hour min RH',
            'SR' => 'Instant Solar Radiation',
            'SR1HA' => 'One hour average SR',
            'SR1HX' => 'One hour max SR',
            'SR1HM' => 'One hour min SR',
            'TA' => 'Instant Temperature',
            'TA1HA' => 'One hour average Temperature',
            'TA1HX' => 'One hour max temp',
            'TA1HM' => 'One hour min temp',
            'WD' => 'Instant wind direction',
            'WD2MA' => '2 minute average WD',
            'WD10MA' => '10 minute average WD',
            'WD2MX' => '2 minute max WD',
            'WD10MX' => '10 minute max WD',
            'WD2MM' => '2 minute min WD',
            'WD10MM' => '10 minute min WD',
            'WD1HA' => 'One hour average WD',
            'WD1HX' => 'One hour max WD',
            'WD1HM' => 'One hour min WD ',
            'WS' => 'Instant Wind Speed',
            'WS2MA' => '2 minute average WS',
            'WS10MA' => '10 minute average WS',
            'WS2MX' => '2 minute max WS',
            'WS10MX' => '10 minute max WS',
            'WS2MM' => '2 minute average WS',
            'WS10MM' => '10 minute average WS',
            'QFE' => 'Qfe',
            'QFE1HA' => 'Qfe1 Ha',
            'QFE1HX' => 'Qfe1 Hx',
            'QFE1HM' => 'Qfe1 Hm',
            'QFF' => 'Qff',
            'QFF1HA' => 'Qff1 Ha',
            'QFF1HX' => 'Qff1 Hx',
            'QFF1HM' => 'Qff1 Hm',
            'QNH' => 'Qnh',
            'QNH1HA' => 'Qnh1 Ha',
            'QNH1HX' => 'Qnh1 Hx',
            'QNH1HM' => 'Qnh1 Hm',
            'a' => 'A',
            'p' => 'P',
            'ETO' => 'Eto',
            'Path' => 'Processed File Path',
            'StationName' => 'Station Name',
            'VaisalaVersion' => 'Vaisala Version',
            'EntryDate' => 'Entry Date',
        ];
    }
}
