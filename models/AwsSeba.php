<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "tbl_aws_seba".
 *
 * @property string $entrydate Date data recorded from the station
 * @property string $time
 * @property string $stationname
 * @property string $D
 * @property string $U
 * @property string $PL
 * @property string $TL
 * @property string $G
 * @property string $CH
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
            [['entrydate'], 'string', 'max' => 50],
            [['time', 'D', 'U', 'PL', 'TL', 'G', 'CH'], 'string', 'max' => 10],
            [['stationname'], 'string', 'max' => 100],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'entrydate' => 'Entrydate',
            'time' => 'Time',
            'stationname' => 'Stationname',
            'D' => 'D',
            'U' => 'U',
            'PL' => 'Pl',
            'TL' => 'Tl',
            'G' => 'G',
            'CH' => 'Ch',
            'id' => 'ID',
        ];
    }
}
