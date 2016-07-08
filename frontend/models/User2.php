<?php

namespace frontend\models;

use Yii;
use yii\web\IdentityInterface;
use yii\behaviors\TimestampBehavior;
use yii\db\Expression;

/**
 * This is the model class for table "user".
 *
 * @property integer $id
 * @property string $username
 * @property string $email
 * @property string $password_hash
 * @property integer $status
 * @property string $auth_key
 * @property string $secret_key
 */
class User2 extends \yii\db\ActiveRecord implements IdentityInterface
{

    const STATUS_DELETED = 2;
    const STATUS_NOT_ACTIVE = 0;
    const STATUS_ACTIVE = 1;
    const TYPE_USER = 0;
    const TYPE_MANAGER = 1;
    const TYPE_SUPERADMIN = 2;

    /**
     * @var string
     */
    public $password;
    public $repeat_password;
    public $_user;


    public static function tableName()
    {
        return 'users';
    }

    public function rules()
    {
        return [
            [['surname', 'name', 'phone', 'patronymic', 'password', 'email'], 'filter', 'filter' => 'trim'],
            [['email'], 'required'],
            ['repeat_password', 'compare', 'compareAttribute' => 'password'],
            // ['email', 'email'],
            // ['username', 'string', 'min' => 2, 'max' => 255],
            // ['password', 'required', 'on' => 'create'],
            // ['username', 'unique', 'message' => 'Пользователь с таким логином уже сущесвует'],
            // ['email', 'unique', 'message' => 'Даннай емейл уже зарегестрироован.'],
        ];
    }

    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Имя',
            'surname' => 'Фамилия',
            'patronymic' => 'Отчество',
            'email' => 'Емейл',
            'password' => 'Пароль',
            'phone' => 'Телефон',
            'repeat_password' => 'Пароль(повтор)',
            'status' => 'Статус',
            'auth_key' => 'Auth Key',
            'secret_key' => 'Secret Key',
        ];
    }

    public function behaviors()
    {
        return [
            [
                'class' => TimestampBehavior::className(),
                'createdAtAttribute' => 'createTime',
                'updatedAtAttribute' => 'updateTime',
                'value' => new Expression('NOW()'),
            ],
        ];
    }

    public static function findBySecretKey($key)
    {
        if (!static::isSecretKeyExpire($key)) {
            return null;
        }
        return static::findOne([
            'secret_key' => $key,
        ]);
    }

    /* Хелперы */

    public function generateSecretKey()
    {
        $this->secret_key = Yii::$app->security->generateRandomString() . '_' . time();
    }

    public function removeSecretKey()
    {
        $this->secret_key = null;
    }

    public static function isSecretKeyExpire($key)
    {
        if (empty($key))
            return false;
        $expire = Yii::$app->params['secretKeyExpire'];
        $parts = explode('_', $key);
        $timestamp = (int) end($parts);
        return $timestamp + $expire >= time();
    }

    public static function findByEmail($email)
    {
        return static::findOne([
            'email' => $email
        ]);
    }

    public function setPassword($password)
    {
        $this->pass = Yii::$app->security->generatePasswordHash($password);
    }

    public function randomPassword()
    {
        $pass = Yii::$app->security->generateRandomString($length = 8);
        $this->pass = Yii::$app->security->generatePasswordHash($this->pass);
    }

    public function generateAuthKey()
    {
        $this->auth_key = Yii::$app->security->generateRandomString();
    }

    public function validatePassword($password)
    {
        return Yii::$app->security->validatePassword($password, $this->pass);
    }

    public static function findIdentity($id)
    {
        return static::findOne([
            'user_id' => $id,
            'status' => self::STATUS_ACTIVE
        ]);
        //return Yii::$app->db->createCommand('SELECT user_id, name, email FROM users WHERE users.user_id = :id AND users.status = :status ')->bindValues([':status' => self::STATUS_ACTIVE, ':id' => $id])->queryOne();
//        var_dump(static::findOne([
//            'user_id' => $id,
//            'status' => self::STATUS_ACTIVE
//        ])); exit;
    }

    public static function findIdentityByAccessToken($token, $type = null)
    {
        return static::findOne(['access_token' => $token]);
    }

    public function getId()
    {
        return $this->user_id;
    }

    public function getAuthKey()
    {
        return $this->auth_key;
    }

    public function validateAuthKey($authKey)
    {
        return $this->auth_key === $authKey;
    }

    public function resetPassword($key)
    {
        $user = User::find()->where(['secret_key' => $key])->one();
        $user->name = $this->name;
        $user->surname = $this->surname;
        $user->patronymic = $this->patronymic;
        $user->phone = $this->phone;
        $user->setPassword($this->password);
        $user->removeSecretKey();
        return $user->save();
    }

}
