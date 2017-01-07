<?php
namespace app\models;
use Yii;
/**
 * This is the model class for table "tbl_login_attempt".
 *
 * @property integer $id
 * @property integer $userid
 * @property string $ipaddress
 * @property boolean $successfulattempt
 * @property string $lastlogin
 *
 * @property TblUser $user
 */
class LoginAttempt extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_login_attempt';
    }
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['userid'], 'integer'],
            [['successfulattempt'], 'boolean'],
            [['lastlogin'], 'safe'],
            [['ipaddress'], 'string', 'max' => 20],
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
            'successfulattempt' => 'Successfulattempt',
            'lastlogin' => 'Lastlogin',
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