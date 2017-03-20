<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "tbl_aws_seba".
 *
 * @property string $EntryDate Date data recorded from the station
 * @property string $TIME
 * @property string $stationname
 * @property string $D
 * @property string $U
 * @property string $P_L
 * @property string $T_L
 * @property string $G
 * @property string $CH
 * @property string $U_B
 * @property string $H_L
 * @property int $id
 */
class AwsSeba extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_aws_seba';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['EntryDate'], 'string', 'max' => 50],
            [['TIME', 'D', 'U', 'P_L', 'T_L', 'G', 'CH', 'U_B', 'H_L'], 'string', 'max' => 40],
            [['stationname'], 'string', 'max' => 100],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'EntryDate' => 'Entrydate',
            'TIME' => 'Time',
            'stationname' => 'Stationname',
            'D' => 'Wind Direction',
            'U' => 'Wind Speed',
            'P_L' => 'Pressure',
            'T_L' => 'Temperature',
            'G' => 'Solar Radiation',
            'CH' => 'Rainfall',
            'U_B' => 'Battery',
            'H_L' => 'Relative Humidity',
            'id' => 'ID',
        ];
    }
}
