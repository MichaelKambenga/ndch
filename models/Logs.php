<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "tbl_logs".
 *
 * @property integer $id
 * @property integer $userid
 * @property string $datecreated
 * @property string $activitydetails
 * @property integer $activitygroup
 *
 * @property TblUser $user
 */
class Logs extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_logs';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['userid', 'activitygroup'], 'integer'],
            [['datecreated'], 'safe'],
            [['activitydetails', 'activitygroup'], 'required'],
            [['activitydetails'], 'string'],
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
            'datecreated' => 'Datecreated',
            'activitydetails' => 'Activitydetails',
            'activitygroup' => 'Activitygroup',
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
