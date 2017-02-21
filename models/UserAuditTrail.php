<?php
namespace app\models;
use Yii;
/**
 * This is the model class for table "tbl_user_audit_trail".
 *
 * @property integer $id
 * @property integer $userid
 * @property string $datecreated
 * @property string $ipaddress
 * @property string $object
 * @property string $clientdetails
 * @property string $details
 * @property string $referer
 *
 * @property TblUser $user
 */
class UserAuditTrail extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_user_audit_trail';
    }
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['userid'], 'integer'],
            [['datecreated'], 'safe'],
            [['clientdetails', 'details'], 'string'],
            [['ipaddress'], 'string', 'max' => 20],
            [['object'], 'string', 'max' => 100],
            [['referer'], 'string', 'max' => 300],
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
            'ipaddress' => 'Ipaddress',
            'object' => 'Object',
            'clientdetails' => 'Clientdetails',
            'details' => 'Details',
            'referer' => 'Referer',
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