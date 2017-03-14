<?php

namespace app\models;

use Yii;
use yii\base\NotSupportedException;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;
use yii\web\IdentityInterface;

/**
 * This is the model class for table "tbl_user".
 *
 * @property integer $id
 * @property string $firstname
 * @property string $middlename
 * @property string $lastname
 * @property integer $organizationid
 * @property integer $stationid
 * @property string $username
 * @property string $password
 * @property integer $status
 * @property string $created_at
 * @property string $datedeactivated
 * @property string $lastlogin
 * @property integer $logins
 * @property string $updated_at
 *
 * @property TblLogs[] $tblLogs
 * @property TblStation[] $tblStations
 * @property TblStakeholder $organization
 */
class User extends ActiveRecord implements IdentityInterface {
    const STATUS_INACTIVE = 0;
    const STATUS_ACTIVE = 1;
    const STATUS_BLOCKED = 2;

    ///constant scenarions
    const SCENARIO_STATION_USER=1;

//    public $entity_sector_id;
//    public $entity_sub_sector_id;
    public $user_role; ///variable to carry the role(s) of the user in the system e.g admin,etc

    /**
     * @inheritdoc
     */

    public static function tableName() {
        return 'tbl_user';
    }

    /**
     * @inheritdoc
     */
    public function behaviors() {
        return [
        TimestampBehavior::className(),
        ];
    }

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
        [['firstname', 'middlename', 'lastname', 'username', 'password_hash'], 'trim'],
        [['firstname', 'lastname', 'username', 'password_hash', 'organizationid', 'user_role'], 'required'],
        [['organizationid', 'status', 'logins', 'stationid'], 'integer'],
        [['stationid'], 'validStation', 'on' => User::SCENARIO_STATION_USER],
        [['created_at', 'datedeactivated', 'lastlogin', 'created_at', 'updated_at', 'user_role'], 'safe'],
        [['firstname', 'middlename'], 'string', 'max' => 100],
        [['lastname'], 'string', 'max' => 150],
        [['username'], 'string', 'max' => 50],
        [['password_hash', 'auth_key'], 'string', 'max' => 255],
        [['organizationid'], 'exist', 'skipOnError' => true, 'targetClass' => Stakeholder::className(), 'targetAttribute' => ['organizationid' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels() {
        return [
        'id' => 'ID',
        'firstname' => 'First Name',
        'middlename' => 'Middle Name',
        'lastname' => 'Last Name',
        'organizationid' => 'Organization',
        'stationid' => 'Station',
        'username' => 'User Name',
        'password' => 'Password',
        'status' => 'Status',
        'created_at' => 'Date Created',
        'datedeactivated' => 'Date Deactivated',
        'lastlogin' => 'Lastlogin',
        'logins' => 'Logins',
        'user_role' => 'User Role(s)'
        ];
    }

    /** INCLUDE USER LOGIN VALIDATION FUNCTIONS* */

    /**
     * @inheritdoc
     */
    public static function findIdentity($id) {
        return static::findOne($id);
    }

    /**
     * @inheritdoc
     */
    /* modified */
    public static function findIdentityByAccessToken($token, $type = null) {
        throw new NotSupportedException('"findIdentityByAccessToken" is not implemented.');
    }

    /**
     * Finds user by username
     *
     * @param  string      $username
     * @return static|null
     */
    public static function findByUsername($username) {
        return static::findOne(['username' => $username]);
    }

    /**
     * Finds user by password reset token
     *
     * @param  string      $token password reset token
     * @return static|null
     */
    public static function findByPasswordResetToken($token) {
        if (!static::isPasswordResetTokenValid($token)) {
            return null;
        }

        return static::findOne([
        'password_reset_token' => $token,
        'status' => self::STATUS_ACTIVE,
        ]);
    }

    /**
     * Finds out if password reset token is valid
     *
     * @param string $token password reset token
     * @return boolean
     */
    public static function isPasswordResetTokenValid($token) {
        if (empty($token)) {
            return false;
        }

        $timestamp = (int) substr($token, strrpos($token, '_') + 1);
        $expire = Yii::$app->params['user.passwordResetTokenExpire'];
        return $timestamp + $expire >= time();
    }

    /**
     * @inheritdoc
     */
    public function getId() {
        return $this->getPrimaryKey();
    }

    /**
     * @inheritdoc
     */
    public function getAuthKey() {
        return $this->auth_key;
    }

    /**
     * @inheritdoc
     */
    public function validateAuthKey($authKey) {
        return $this->getAuthKey() === $authKey;
    }

    /**
     * Validates password
     *
     * @param  string  $password password to validate
     * @return boolean if password provided is valid for current user
     */
    public function validatePassword($password) {
//        return $this->password === sha1($password);
        return Yii::$app->security->validatePassword($password, $this->password_hash);
    }

    /**
     * Generates password hash from password and sets it to the model
     *
     * @param string $password
     */
    public function setPassword($password) {
        $this->password_hash = Yii::$app->security->generatePasswordHash($password);
    }

    /**
     * Generates "remember me" authentication key
     */
    public function generateAuthKey() {
        $this->auth_key = Yii::$app->security->generateRandomString();
    }

    /**
     * Generates new password reset token
     */
    public function generatePasswordResetToken() {
        $this->password_reset_token = Yii::$app->security->generateRandomString() . '_' . time();
    }

    /**
     * Removes password reset token
     */
    public function removePasswordResetToken() {
        $this->password_reset_token = null;
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getLogs() {
        return $this->hasMany(Logs::className(), ['userid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getStations() {
        return $this->hasMany(Station::className(), ['createdby' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOrganization() {
        return $this->hasOne(Stakeholder::className(), ['id' => 'organizationid']);
    }

    function getUserRolesName() {
        $rolesList = NULL;
        $roles= AuthAssignment::find()->where(['user_id' => $this->id])->orderBy('item_name ASC')->all();
        if ($roles) {
            $rolesList = '<ul>';
            foreach ($roles as $value) {
                $rolesList .='<li>' . $value->item_name . '</li>';
            }
            $rolesList .='</ul>';
        }
        return $rolesList;
    }

    function validStation() {
        if ($this->stationid) {
            return TRUE;
        }
        $this->addError('stationid', 'Station required');
        return FALSE;
    }

}
