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
 *
 * @property TblUser $user
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
            [['userid'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['userid' => 'id']],
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

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'userid']);
    }
}
