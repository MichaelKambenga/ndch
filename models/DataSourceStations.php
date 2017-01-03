<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "tbl_data_source_stations".
 *
 * @property integer $id
 * @property integer $datasourceid
 * @property integer $stationid
 * @property string $datecreated
 *
 * @property TblDataSources $datasource
 * @property TblStation $station
 */
class DataSourceStations extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_data_source_stations';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['datasourceid', 'stationid', 'datecreated'], 'required'],
            [['datasourceid', 'stationid'], 'integer'],
            [['datecreated'], 'safe'],
            [['datasourceid'], 'exist', 'skipOnError' => true, 'targetClass' => TblDataSources::className(), 'targetAttribute' => ['datasourceid' => 'id']],
            [['stationid'], 'exist', 'skipOnError' => true, 'targetClass' => TblStation::className(), 'targetAttribute' => ['stationid' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'datasourceid' => 'Datasourceid',
            'stationid' => 'Stationid',
            'datecreated' => 'Datecreated',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDatasource()
    {
        return $this->hasOne(TblDataSources::className(), ['id' => 'datasourceid']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getStation()
    {
        return $this->hasOne(TblStation::className(), ['id' => 'stationid']);
    }
}
