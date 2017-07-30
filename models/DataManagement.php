<?php

namespace app\models;

use Yii;
use yii\base\Model;

class DataManagement extends Model {

    ////adding filter date fields
    public $DateStart;
    public $DateEnd;
    public $AWSType;
    public $StationId;

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
            [['StationId'], 'safe'],
            [['DateStart', 'DateEnd', 'AWSType'], 'required', 'on' => 'import-aws-data'],
            [['DateStart'], 'validDate'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels() {
        return [
            'DateStart' => 'Start Date',
            'DateEnd' => 'End Date',
            'AWSType' => 'AWS Type',
            'StationId' => 'Station',
        ];
    }

    function validDate() {
        if (!empty($this->DateStart) && !empty($this->DateEnd)) {
           // echo $this->DateStart.'='.$this->DateEnd;
            if (date('Y-m-d', strtotime($this->DateStart)) > date('Y-m-d', strtotime($this->DateStart))) {
                $this->addError($this->DateStart, $this->DateStart . ' Should be less than or Equal to ' . $this->DateEnd);
                return FALSE;
            }
            return TRUE;
        }
    }

}
