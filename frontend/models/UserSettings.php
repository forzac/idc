<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "user_social".
 *
 * @property integer $social_id
 * @property integer $user_id
 * @property integer $social_type
 *
 * @property Users $user
 */
class UserSettings extends \yii\db\ActiveRecord
{

    private $db;
    private $controller;
    private $response = ["render" => "../site/user/index", "error" => 0, "message" => "", "data" => []];

    const STATUS_DELETED = 2;
    const STATUS_NOT_ACTIVE = 0;
    const STATUS_ACTIVE = 1;
    const TYPE_USER = 0;
    const TYPE_MANAGER = 1;
    const TYPE_SUPERADMIN = 2;


    public $repeat_password;
    public $password;
    public $_user;
    public $rememberMe;
    public $auther;

    public function __construct(){
        $this->db = Yii::$app->db;
        //$this->isAjax = $isAjax;
    }

    public function __destruct()
    {
        $this->db->close();
    }

    public static function Initial()
    {
        return new User();
    }

    public function Run($mode, $key, $id, $provider)
    {

        if (Yii::$app->request->isAjax) {
            //$this->AjaxRun{}
        } else {

        }
        return $this;
    }

    public static function tableName()
    {
        return 'userSettings';
    }

    public function rules()
    {
        return [
            [['user_id', 'comment', 'mailing', 'search_notif', 'hide_name','answer_comment'], 'integer'],
            [['user_id'], 'integer']
        ];
    }

    public function attributeLabels()
    {
        return [
            'social_id' => 'Social ID',
            'user_id' => 'User ID',
        ];
    }

    public function getUser()
    {
        return $this->hasOne(User::className(), ['user_id' => 'user_id']);
    }
}