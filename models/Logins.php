<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "tbl_logins".
 *
 * @property integer $id
 * @property integer $userid
 * @property string $ipaddress
 * @property string $details
 * @property string $datecreated
 */
class Logins extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_logins';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['userid'], 'integer'],
            [['datecreated'], 'safe'],
            [['ipaddress'], 'string', 'max' => 20],
            [['details'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'userid' => 'Userid',
            'ipaddress' => 'Ipaddress',
            'details' => 'Details',
            'datecreated' => 'Datecreated',
        ];
    }
}
