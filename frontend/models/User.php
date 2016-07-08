<?php

namespace frontend\models;


use yii\base\ErrorException;
use yii\base\Model;
use Yii;
use yii\db\ActiveRecord;
use yii\web\UploadedFile;
use yii\helpers\Html;
use yii\helpers\FileHelper;
use yii\db\Expression;
use yii\web\IdentityInterface;
use yii\web\Cookie;
use yii\behaviors\TimestampBehavior;
use yii\helpers\Url;
use yii\mongodb\Collection;
use yii\mongodb\Query;
use yii\redis\ActiveQuery;



class User extends ActiveRecord implements IdentityInterface
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

    /*-----------------------------------------------------------------------------------------MYACCOUNT-------------------------------------------------------------------------*/

    public $newComment;
    public $delivery;
    public $mailNotif;
    public $answerComment;
    public $confidentiality;
    public $confirmPassword;
    public $uploadFile;
    public $avatarName;
    public $rullesRequired = ['name', 'surname', 'patronymic',];


    public static function tableName()
    {
        return 'users';
    }

    public function __construct(){
        $this->db = Yii::$app->db;
        //$this->isAjax = $isAjax;
    }

    public function scenarios()
    {
        return [
            'validmail' => ['email'],
            'activationAccount' => ['name', 'surname', 'patronymic', 'password', 'repeat_password', 'phone'],
            'resetPassword' => ['password', 'repeat_password'],
            'login' => ['email', 'password'],
            'default' => ['name', 'surname', 'patronymic', 'password', 'repeat_password', 'phone'],
            'ajax' => ['file'],
            'reset' => ['email'],

            /*-----------------------------------------------------------------------------------------MYACCOUNT-------------------------------------------------------------------------*/

            'personal' => ['name', 'surname', 'patronymic', 'phone'],
            'emailchange' => ['email'],
            'passchange' => ['password', 'confirmPassword'],
        ];
    }

    public function rules()
    {
        return [
            [['name', 'surname', 'patronymic', 'phone'], 'filter', 'filter' => 'trim', 'on' => 'activationAccount'],
            [['password', 'repeat_password'], 'required', 'on' => 'resetPassword', 'message' => 'Заполните поле пароль'],
            ['repeat_password', 'compare', 'compareAttribute' => 'password', 'on' => 'activationAccount', 'message' => 'Пароль должен быть повторен в точности'],
            ['repeat_password', 'compare', 'compareAttribute' => 'password', 'on' => 'resetPassword', 'message' => 'Пароль должен быть повторен в точности'],
            ['name', 'string', 'min' => 2, 'max' => 100, 'tooShort' => "Длинна от 2 до 100 символов", 'tooLong' => "Длинна от 2 до 100 символов", 'on' => 'activationAccount'],
            ['surname', 'string', 'min' => 2, 'max' => 100, 'tooShort' => "Длинна от 2 до 100 символов", 'tooLong' => "Длинна от 2 до 100 символов", 'on' => 'activationAccount'],
            ['patronymic', 'string', 'min' => 2, 'max' => 100, 'tooShort' => "Длинна от 2 до 100 символов", 'tooLong' => "Длинна от 2 до 100 символов", 'on' => 'activationAccount'],
            ['email', 'required', 'message' => 'Поле обязательно для заполенения', 'on' => 'validmail'],
            ['email', 'email', 'message' => 'Пример эл. почты name@mail.com', 'on' => 'validmail'],
            ['email', 'unique',
                'targetClass' => User::className(),
                'message' => 'Эта почта уже занята.',
                'on' => 'validmail'
            ],
            ['email', 'required', 'message' => 'Поле обязательно для заполенения', 'on' => 'login'],
            ['email', 'required', 'message' => 'Поле обязательно для заполенения', 'on' => 'reset'],
            ['email', 'email', 'message' => 'Пример эл. почты name@mail.com', 'on' => 'reset'],
            ['password', 'required', 'message' => 'Заполните поле пароль', 'on' => 'login'],
            ['email', 'email', 'message' => 'Пример эл. почты name@mail.com', 'on' => 'login'],

            /*-----------------------------------------------------------------------------------------MYACCOUNT-------------------------------------------------------------------------*/

            [['name', 'surname', 'patronymic', 'phone'], 'filter', 'filter' => 'trim', 'on' => 'personal'],
            [['name', 'surname'], 'required', 'message' => 'Поля обязательны для заполения', 'on' => 'personal'],
            ['name', 'string', 'min' => 2, 'max' => 100, 'tooShort' => "Длинна от 2 до 100 символов", 'tooLong' => "Длинна от 2 до 100 символов", 'on' => 'personal'],
            [['name', 'patronymic'], 'match', 'pattern' => '/^([a-zA-Z]+)|([a-яА-Я]+)$/i', 'message' => 'Поле содержит только буквы', 'on' => 'personal',],
            ['surname', 'string', 'min' => 2, 'max' => 100, 'tooShort' => "Длинна от 2 до 100 символов", 'tooLong' => "Длинна от 2 до 100 символов", 'on' => 'personal'],
            ['surname', 'match', 'pattern' => '/^([a-zA-Z]+)|([a-яА-Я]+)$/i', 'message' => 'Поле содержит только буквы', 'on' => 'personal'],
            ['patronymic', 'string', 'min' => 2, 'max' => 100, 'tooShort' => "Длинна от 2 до 100 символов", 'tooLong' => "Длинна от 2 до 100 символов", 'on' => 'personal'],
            ['phone', 'match', 'pattern' => '/^\+38\s\(0[0-9]{2}\)\s[0-9]{3}-[0-9]{2}-[0-9]{2}$/', 'message' => 'неверный формат телефонного номера', 'on' => 'personal'],
            ['email', 'email', 'message' => 'Неверный формат email', 'on' => 'emailchange'],
            ['email', 'required', 'message' => 'Поля обязательны для заполения', 'on' => 'emailchange'],
            [['confirmPassword'], 'compare', 'compareAttribute' => 'password', 'message' => 'Пароли не совпадают', 'on' => 'passchange'],
            ['password', 'required', 'message' => 'Поля обязательны для заполения', 'on' => 'passchange'],
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
            'confidentiality' => 'Отображать объявления, или нет?',
            'newComment' => 'Новый коментарий',
            'delivery' => 'Рассылка',
            'answerComment' => 'Ответ на коментарий',
            'mailNotif' => 'Пошаговые уведомления',
            'avatar' => 'Аватар'
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

    public function __destruct()
    {
        $this->db->close();
    }

    public static function Initial()
    {
        return new User();
    }

    public function Run($mode, $key, $user_id, $provider)
    {

        if (Yii::$app->request->isAjax) {
            //$this->AjaxRun{}
        } else {
            if ($mode == 'index') {
                $this->response['data']['model'] = $this;
            }
            if ($mode == 'registration') {
                $this->registration();
            }
            if ($mode == 'email') {
                $this->email();
            }
            if ($mode == 'ajax') {
                $this->ajax();
            }
            if ($mode == 'activationAccount' && $key) {
                $this->activationAccount($key);
            }
            if ($mode == 'login' || $provider) {
                if ($this->load(Yii::$app->request->post())) {
                    //$this->mongo();
                }
                $this->auth();
                $this->loginSocial($provider);
            }
            if ($mode == 'resetPasswordMail') {
                $this->resetMail();
            }
            if ($mode == 'resetPassword' && $key) {
                $this->resetPassword($key);
            }
            if ($mode == 'logout') {
                Yii::$app->user->logout();
                Yii::$app->session->destroy();
                Yii::$app->response->redirect(['/registration?mode=login']);
            }
            if ($mode == 'confirm-email') {
                $this->confirm($key);
            }
            if ($mode == 'notEmail') {
                $this->notEmail();
            }
            if ($mode == 'validatePasswordEmail') {
                $this->validatePasswordEmail();
            }
            if (!$mode && $user_id) {
                $this->getAccountData($user_id);
                $this->response['data'] = $this;
                $this->response['render'] = 'myaccount';
            }
            if ($mode == 'personal') {
                $this->saveAccount($user_id);
            }
            if ($mode == 'passchange') {
                $this->passchange($user_id);
            }
            if ($mode == 'emailchange') {
                $this->emailchange($user_id);
            }
            if ($mode == 'emailnotif') {
                $this->saveEmailOptions($user_id);
            }
            if ($mode == 'confidentiality') {
                $this->saveConfidentiality($user_id);
            }
            if ($mode == 'confirmEmail') {
                $this->saveEmailAccount();
            }
            if ($mode == 'resetPasswordMailSocial') {
                $this->resetMailSocial();
            }
            if ($mode == 'resetPasswordSocial') {
                $this->resetPasswordSocial($key);
            }
        }
        return $this;
    }

    public function mongo()
    {
        if ($this->load(Yii::$app->request->post())) {
            $collection = Yii::$app->mongodb->getCollection('customer');
            $collection->insert(['email' => $_POST['User']['email'], 'status' => 1]);
            $a = $collection->findOne(['name' => 'John Smith' ]);
            // $query = new Query;
            //$a = $query->select(['name' => 'John Smith']);
            //$a->all();
        }
    }

    public function confirm($key) {
        $user = self::findOne(['secret_key' => $key]);
        if ($user) {
            $user->status = self::STATUS_ACTIVE;
            if ($user->save()) {
                Yii::$app->response->redirect(['/index']);
            }
        }
    }

    public function getResponse()
    {
        return $this->response;
    }

    public function getUserSocials()
    {
        return $this->hasMany(UserSocial::className(), ['user_id' => 'user_id']);
    }

    public function getUserSettings()
    {
        return $this->hasMany(UserSettings::className(), ['user_id' => 'user_id']);
    }

    public function email() {
        if(Yii::$app->request->post('name')) {
                $name =Yii::$app->request->post('name');
                Yii::$app->mailer->compose('sendMail')
                    ->setFrom(['optmioli@gmail.com' => 'TM Mioli'])
                    ->setTo(Yii::$app->request->post('User')['email'])
                    ->setSubject('Отдел оптовых продаж')
                    ->send();

            \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
            return ['name' => $name];
        }
        $this->response['data']['model'] = $this;
        $this->response['render'] = 'email';
    }

    public function registration()
    {
        $this->scenario = 'validmail';
        if ($this->load(Yii::$app->request->post())) {
            if ($this->validate()) {
                $this->email;
                $this->generateSecretKey();
                $this->generateAuthKey();
                $this->randomPassword();
                if ($this->save()) {

                    $setting = new UserSettings();
                    $setting->user_id = $this->user_id;
                    $setting->save();
                    Yii::$app->mailer->compose('activationEmail', ['email' => $this->email, 'secret_key' => $this->secret_key, 'id' => Yii::$app->user->identity->attributes['id']])
                        ->setFrom([Yii::$app->params['supportEmail'] => Yii::$app->name . ' (отправлено роботом)'])
                        ->setTo($this->email)
                        ->setSubject('Чтобы подтвердить регестрацию ' . Yii::$app->name)
                        ->send();


                    Yii::$app->session->setFlash('success', 'Подтвердите регистрацию на почте ' . $this->email);
                    Yii::$app->response->redirect(['/index']);
                }
            }
        }
        $this->response['data']['model'] = $this;
        $this->response['render'] = 'registration';
    }

    public function activationAccount($key)
    {
        $this->scenario = 'activationAccount';

        $user = self::findOne(['secret_key' => $key]);
        if ($this->load(Yii::$app->request->post())) {
            if ($this->validate()) {
                $user->name = $this->name;
                $user->surname = $this->surname;
                $user->patronymic = $this->patronymic;
                $user->phone = $this->phone;
                $user->setPassword($this->password);
                $user->status = self::STATUS_ACTIVE;
                $user->removeSecretKey();
                $user->save();
                $user->auth();
                $this->response['data']['model'] = $this;
                $this->response['render']='index';
            }
        } else {
            $this->response['data']['key'] = $key;
            $this->response['data']['model'] = $this;
            $this->response['data']['email'] = $user->email;
            $this->response['render']='activationAccount';
        }
    }

    public function resetMail()
    {
        $this->scenario = 'reset';

        if ($this->load(Yii::$app->request->post())) {
            if ($this->validate()) {
                $user = $this->findByEmail($this->email);
                $user->generateSecretKey();
                if($user->save()){
                    Yii::$app->mailer->compose('resetPassword', ['email' => $user->email, 'secret_key' => $user->secret_key])
                        ->setFrom([Yii::$app->params['supportEmail'] => Yii::$app->name.' (отправлено роботом)'])
                        ->setTo($this->email)
                        ->setSubject('Сброс пароля для '.Yii::$app->name)
                        ->send();
                    Yii::$app->session->setFlash('success', 'Подтвердите сброс пароля на почте ' . $user->email);
                    Yii::$app->response->redirect(['/index']);
                }
            }
        }
        $this->response['data']['model'] = $this;
        $this->response['render'] = 'resetPasswordMail';
    }

    public function resetPassword($key)
    {
        $this->scenario = 'resetPassword';
        $user = $this->findBySecretKey($key);
        if($user){
            if ($this->load(Yii::$app->request->post())) {
                if ($this->validate()) {
                    $user->setPassword($this->password);
                    $user->removeSecretKey();
                    $user->save();
                    $user->auth();
                    Yii::$app->response->redirect(['/index']);
                }
            }
            $this->response['data']['key'] = $user->secret_key;
            $this->response['data']['email'] = $user->email;
            $this->response['data']['model'] = $this;
            $this->response['render'] = 'resetPassword';
        }else{
            Yii::$app->session->setFlash('error', 'ссылка устарела, смените пароль в личном кабинете');
            Yii::$app->response->redirect(['/index']);
        }
       
    }

    public function auth()
    {
        $this->scenario = 'login';

        if ($this->load(Yii::$app->request->post())) {
            if ($this->validate()) {
                if ($this->validatePassword($this->password) == true) {
                    $this->attributes = Yii::$app->request->post();
                    $user = $this->getUser();
                    if ($user->status == self::STATUS_ACTIVE) {
                        Yii::$app->user->login($user, $this->rememberMe ? 3600 * 24 * 30 : 0);
                        Yii::$app->response->redirect(['/index']);
                    }
                }
            }
        }
        $this->response['data']['google'] = $this->returnGoogleApi()->getAuthUrl();
        $this->response['data']['facebook'] = $this->returnFacebookApi()->getAuthUrl();
        $this->response['data']['vk'] = $this->returnVkApi()->getAuthUrl();
        $this->response['data']['mailru'] = $this->returnMailruApi()->getAuthUrl();
        $this->response['data']['yandex'] = $this->returnYandexApi()->getAuthUrl();
        $this->response['data']['ok'] = $this->returnOdnoklassnikiApi()->getAuthUrl();
        $this->response['data']['instagram'] = $this->returnInstagramApi()->getAuthUrl();
        $this->response['data']['linkedin'] = $this->returnLinkedinApi()->getAuthUrl();
        $this->response['data']['twitter'] = $this->returnTwitterApi()->startGetData();
        $this->response['data']['model'] = $this;
        $this->response['render'] = 'login';
    }

    public function getUser()
    {
        $this->_user = self::findByEmail($this->email);
        return $this->_user;
    }

    public static function findByEmail($email)
    {
        return static::findOne([
            'email' => $email
        ]);
    }

    public function validatePassword()
    {
        if (!$this->hasErrors() && $this->load(Yii::$app->request->post())) {
            $user = $this->getUser();
            if ($user) {
                return Yii::$app->security->validatePassword($this->password, $user['pass']);
            }
        }
    }

    public function logout()
    {
        Yii::$app->user->logout();
        Yii::$app->session->destroy();
        Yii::$app->response->redirect(['/registration?mode=login']);
    }

    public function returnGoogleApi()
    {
        $googleAdapterConfig = array(
            'client_id' => '1015883872383-89repjf6tuiea2thpm6tnrupv4qjp4io.apps.googleusercontent.com',
            'client_secret' => 'E3zLiafNDFCUxb-_NW0Qf52w',
            'redirect_uri' => 'http://front1.org/registration?provider=google'
        );

        $googleAdapter = new social\Google($googleAdapterConfig);

        $auther = new social\SocialAuther($googleAdapter);
        return $auther;

    }

    public function returnMailruApi()
    {
        $mailruAdapterConfig = array(
            'client_id'     => '737777',
            'client_secret' => '253dd7d8d7e642fdec64db77beb9581c',
            'redirect_uri'  => 'http://front1.org/registration?provider=mailru'
        );

        $mailruAdapter = new social\Mailru($mailruAdapterConfig);

        $auther = new social\SocialAuther($mailruAdapter);
        return $auther;

    }

    public function returnYandexApi()
    {
        $yandexAdapterConfig = array(
            'client_id'     => 'aff585cac46f4eafb574c4722b7e008c',
            'client_secret' => 'ce2391cd59c543a1b1ab06d46829e4a4',
            'redirect_uri'  => 'http://front1.org/registration?provider=yandex'
        );

        $yandexAdapter = new social\Yandex($yandexAdapterConfig);

        $auther = new social\SocialAuther($yandexAdapter);
        return $auther;

    }

    public function returnFacebookApi()
    {
        $facebookAdapterConfig = array(
            'client_id' => '1498528940458671',
            'client_secret' => 'ac003f78685e055abf6b96d2b3c3795b',
            'redirect_uri' => 'http://front1.org/registration?provider=facebook'
        );
        $facebookAdapter = new social\Facebook($facebookAdapterConfig);
        $auther = new social\SocialAuther($facebookAdapter);
        return $auther;
    }

    public function returnVkApi()
    {
        $vkAdapterConfig = array(
            'client_id' => '5081832',
            'client_secret' => 'vCQCICjcqbgId8Sqikmt',
            'redirect_uri' => 'http://front1.org/registration?provider=vk'
        );

        $vkAdapter = new social\Vk($vkAdapterConfig);

        $auther = new social\SocialAuther($vkAdapter);
        return $auther;

    }

    public function returnOdnoklassnikiApi()
    {
        $odnoklassnikiConfig = array(
            'client_id'     => '1156160512',
            'client_secret' => '0C115C8854B8C4231F4362D2',
            'redirect_uri'  => 'http://front1.org/registration?provider=odnoklassniki',
            'public_key'    => 'CBANJKOFEBABABABA'
        );

        $odnoklassnikiAdapter = new social\Odnoklassniki($odnoklassnikiConfig);

        $auther = new social\SocialAuther($odnoklassnikiAdapter);
        return $auther;
    }
    public function returnLinkedinApi()
    {
        $linkedinConfig = array(
            'client_id'     => '77v0nehrrlzzvp',
            'client_secret' => 'UId0WGs6nuzH3h3N',
            'redirect_uri'  => 'http://front1.org/registration?provider=linkedin',
        );
        $linkedinAdapter = new social\Linkedin($linkedinConfig);
        $auther = new social\SocialAuther($linkedinAdapter);
        return $auther;
    }

    public function returnInstagramApi()
    {
        $instagramConfig = array(
            'client_id'     => 'ebfe69a643914bc0bae2157a02594242',
            'client_secret' => '2da443bb36a64e68b293843bf453402d',
            'redirect_uri'  => 'http://front1.org/registration?provider=instagram',
        );
        $instagramAdapter = new social\Instagram($instagramConfig);
        $auther = new social\SocialAuther($instagramAdapter);
        return $auther;
    }

    public function returnTwitterApi()
    {
        $twitterAdapter = new social\Twitter();
        return $twitterAdapter;
    }

    public function loginSocial($provider)
    {

//        $data = $this->db->createCommand('SELECT *
//                                          FROM users
//                                          LEFT JOIN userSettings
//                                          ON users.user_id = userSettings.user_id
//                                          WHERE users.email = "ganzera@ukr.net"')->bindValues([])->queryAll();
//
//        echo '<pre>';
//        print_r($data); exit;
        if ($provider === 'facebook') {
            $auther = $this->returnFacebookApi();
        } elseif ($provider === 'google') {
            $auther = $this->returnGoogleApi();
        } elseif ($provider === 'vk') {
            $auther = $this->returnVkApi();
        } elseif ($provider === 'odnoklassniki') {
            $auther = $this->returnOdnoklassnikiApi();
        } elseif ($provider === 'mailru') {
            $auther = $this->returnMailruApi();
        } elseif ($provider === 'yandex') {
            $auther = $this->returnYandexApi();
        } elseif ($provider === 'instagram') {
            $auther = $this->returnInstagramApi();

        } elseif ($provider === 'linkedin') {
            $auther = $this->returnLinkedinApi();

        } elseif ($provider === 'twitter') {
            $auther = $this->returnTwitterApi();
            $a = $auther->authenticate();
            $this->twitterRegistration($a->id,$a->name,$provider);

        }

        if (Yii::$app->request->get('code') && $auther->authenticate()) {
            $email = $auther->getEmail();

            $social_id = $auther->getSocialId();
            $fullname = $auther->getName();
            $cat = explode(" ", $fullname);
            $name = $cat[0];
            $surname = $cat[1];
            $soc = Social::findOne(['social' => $provider]);
            $password = $this->randomPw();
            if ($email) {
                $social = UserSocial::findOne(['user_social_id' => $social_id]);
                if ($social) {
                    $user = self::findOne(['user_id' => $social->user_id, 'status' => self::STATUS_ACTIVE]);
                    Yii::$app->user->login($user, $this->rememberMe ? 3600 * 24 * 30 : 0);
                } else {
                    $reg = self::findOne(['email' => $email, 'status' => self::STATUS_ACTIVE]);
                    if ($reg) {
                        $new_social = new UserSocial();
                        $new_social->user_id = $reg->user_id;
                        $new_social->user_social_id = $social_id;
                        $new_social->social_id = $soc->social_id;
                        if ($new_social->save()) {
                            Yii::$app->user->login($reg, $this->rememberMe ? 3600 * 24 * 30 : 0);
                        }
                    } else {
                        $new_user = new User();
                        $new_user->email = $email;
                        $new_user->name = $name;
                        $new_user->surname = $surname;
                        $new_user->setPassword($password);
                        $new_user->generateSecretKey();
                        $new_user->generateAuthKey();
                        $new_user->status = self::STATUS_ACTIVE;
                        if ($new_user->save()) {
                                $new_social = new UserSocial();
                                $new_social->user_id = $new_user->user_id;
                                $new_social->user_social_id = $social_id;
                                $new_social->social_id = $soc->social_id;
                                $new_social->save();
                                Yii::$app->mailer->compose('passwordSend', ['email' => $new_user->email, 'secret_key' => $new_user->secret_key, 'password' => $password])
                                    ->setFrom([Yii::$app->params['supportEmail'] => Yii::$app->name.' (отправлено роботом)'])
                                    ->setTo($new_user->email)
                                    ->setSubject('Ваш пароль для '.Yii::$app->name)
                                    ->send();
                                $setting = new UserSettings();
                                $setting->user_id = $new_user->user_id;
                                $setting->save();
                                Yii::$app->user->login($new_user, $this->rememberMe ? 3600 * 24 * 30 : 0);
                        }
                    }
                }
            } else {
                $user = $this->db->createCommand('SELECT * FROM user_social WHERE user_social_id = :social_id')->bindValues([':social_id' => $social_id])->queryOne();
                if($user){
                    $this->_user = static::findOne(['user_id' => $user['user_id']]);
                    if($this->_user->email ){
                        Yii::$app->user->login($this->_user);
                    }else{
                        $this->response['data']['id'] = $this->_user->id;
                        $this->response['render']='notEmail';
                    }
                }else{
                    $session = Yii::$app->session;
                    $session->set('name', $name);
                    $session->set('social_id', $social_id);
                    $session->set('provider', $provider);
                    $session->set('secret_key', Yii::$app->security->generateRandomString() . '_' . time());
                    $session->set('auth_key', Yii::$app->security->generateRandomString());
                    if ($surname) {
                        $session->set("surname", $surname);
                    }
                    $this->response['render']='notEmail';
                }
            }
        }
    }

    public function notEmail()
    {
        $session = Yii::$app->session;
        if (Yii::$app->request->isPost) {
            $this->scenario = 'reset';
            if($this->load(Yii::$app->request->post()) && $this->validate()){
                $user   = new User();
                $old = User::findOne(['email' => $this->email]);
                $user->status = self::STATUS_ACTIVE;
                $user->email = $this->email;
                $passs = $this->randomPw();
                $user->setPassword($passs);
                $user->name = $session['name'];
                if($session['surname']){
                    $user->surname = $session['surname'];
                }
                $user->secret_key = $session['secret_key'];
                $user->auth_key = $session['auth_key'];
                if(!$old){
                    if($user->save()){
                        $this->db->createCommand()->insert('user_social', [
                            'user_id' => $user->id,
                            'user_social_id' => $session['social_id'],
                            'social_id' => Social::findOne(['social' => $session['provider']])->social_id
                        ])->execute();
                        Yii::$app->mailer->compose('passwordSend', ['email' => $user->email, 'secret_key' => $user->secret_key, 'password' => $passs])
                            ->setFrom([Yii::$app->params['supportEmail'] => Yii::$app->name.' (отправлено роботом)'])
                            ->setTo($user->email)
                            ->setSubject('Ваш пароль для '.Yii::$app->name)
                            ->send();
                        Yii::$app->user->login($user);
                        Yii::$app->response->redirect('/index');
                    }else{
                        Yii::$app->session->setFlash('error', 'Ошибка при сохранении');
                    }
                }else{
                    $session->set('old_user_id', $old->user_id);
                    $session->set('email', $user->email);
                    $this->response['render']='validatePasswordEmail';
                }
            }else{
                Yii::$app->session->setFlash('error', 'Не коректный эмейл');
                $this->response['render']='notEmail';
                $this->response['data']['model'] = $this;
            }
        }else{
            $this->response['render']='notEmail';
            $this->response['data']['model'] = $this;
        }
    }

    public function validatePasswordEmail(){
        $session = Yii::$app->session;
        $new_user = $session['new_user'];
        $old_user = $session['old_user'];
        $social = new UserSocial();
        $social->social_id = Social::findOne(['social' => $session['provider']])->social_id;
        if(Yii::$app->request->isPost){
            if(Yii::$app->security->validatePassword($_POST['pass'], $old_user->pass)){
                $social->user_id = $old_user->user_id;
                $social->user_social_id = $session['social_id'];
                if($social->save()){
                    Yii::$app->user->login($old_user);
                    Yii::$app->response->redirect('/index');
                }else{
                    Yii::$app->session->setFlash('error', 'Ошибка сохранения социальной сети');
                }
            }else{
                Yii::$app->session->setFlash('error', 'Не верный пароль');
                $this->response['render']='validatePasswordEmail';
            }
        }else{
            $this->response['render']='validatePasswordEmail';
        }
    }

    public function twitterRegistration($social_id,$name,$provider){
        $user_social = UserSocial::findOne(['user_social_id' => $social_id]);
        $user_id = $user_social->user_id;
        $user = self::findOne(['user_id' => $user_id]);
        if($user){
            if($user_social){
                Yii::$app->user->login($user);
            }else{
                $user_social = new UserSocial();
                $user_social->social_id = Social::findOne(['social' => $provider]);
                $user_social->user_social_id = $social_id;
                $user_social->user_id = $user->user_id;
                if($user_social->save()){
                    Yii::$app->user->login($user);
                }else{
                    Yii::$app->session->setFlash('error', 'Новая соц сеть не добавленна в базу данных, повторите попытку');
                }
            }
        }else{
            $cat = explode(" ", $name);
            $session = Yii::$app->session;
            $session->set("name", $cat[0]);
            $session->set("surname", $cat[1]);
            $session->set("social_id", $social_id);
            $session->set("provider", $provider);
            $session->set("secret_key", Yii::$app->security->generateRandomString() . '_' . time());
            $session->set("auth_key", Yii::$app->security->generateRandomString());
            $this->response['render']='notEmail';
        }
    }

    public function resetMailSocial()
    {
        $this->scenario = 'reset';
        $session = Yii::$app->session;
        $social_id = base64_encode($session['social_id']);
        $provider = base64_encode($session['provider']);
        $this->email = $session['email'];
        $user = $this->findByEmail($this->email);
        $user->generateSecretKey();
        if($user->save()){
            Yii::$app->mailer->compose('resetPasswordSocial', ['email' => $user->email,
                'secret_key' => $user->secret_key,
                'social_id' => $social_id,
                'provider' => $provider
            ])
                ->setFrom([Yii::$app->params['supportEmail'] => Yii::$app->name.' (отправлено роботом)'])
                ->setTo($this->email)
                ->setSubject('Сброс пароля для '.Yii::$app->name)
                ->send();
            Yii::$app->session->setFlash('success', 'Подтвердите сброс пароля на почте ' . $user->email);
            Yii::$app->response->redirect(['/index']);
        }
    }

    public function resetPasswordSocial($key)
    {
        $session = Yii::$app->session;
        $this->scenario = 'resetPasswordSocial';
        $user = $this->findBySecretKey($key);
        if($user){
            $provider = base64_decode($_GET['provider']);
            $social_id = base64_decode($_GET['social_id']);
            if ($this->load(Yii::$app->request->post())) {
                if ($this->validate()) {
                    $user->setPassword($this->password);
                    $user->removeSecretKey();
                    if($user->save()){
                        Yii::$app->user->login($user);
                    }else{
                        Yii::$app->session->setFlash('error', 'ошибка при обнавлении пароля');
                    }
                }
            }
            $user_social = new UserSocial();
            $user_social->user_id = $user->user_id;
            $user_social->social_id = Social::findOne(['social' => $provider])->social_id;
            $user_social->user_social_id = $social_id;
            $user_social->save();
            Yii::$app->user->login($user);

            $this->response['data']['key'] = $user->secret_key;
            $this->response['data']['email'] = $user->email;
            $this->response['data']['model'] = $this;
            $this->response['render'] = 'resetPasswordSocial';
        }else{
            Yii::$app->session->setFlash('error', 'ссылка устарела, смените пароль в личном кабинете');
            Yii::$app->response->redirect(['/index']);
        }

    }




    public function getAccountData($user_id)
    {
//        $data = $this->db->createCommand('SELECT users.name, users.surname, users.patronymic, users.phone, users.avatar, users.email, us.*
//                                          FROM users
//                                          INNER JOIN userSettings AS us
//                                          ON users.user_id = us.user_id
//                                          WHERE users.user_id = :user_id')->bindValues([':user_id' => $user_id])->queryOne();

        $data = $this->db->createCommand('SELECT users.name, users.surname, users.patronymic, users.phone, users.avatar, users.email, us.*
                                          FROM users
                                          INNER JOIN userSettings AS us
                                          ON users.user_id = us.user_id
                                          WHERE users.user_id = :user_id')->bindValues([':user_id' => $user_id])->queryOne();

        $this->name = $data['name'];
        $this->surname = $data['surname'];
        $this->patronymic = $data['patronymic'];
        $this->phone = $data['phone'];
        $this->email = $data['email'];
        $this->newComment = $data['comment'];
        $this->delivery = $data['mailing'];
        $this->mailNotif = $data['search_notif'];
        $this->answerComment = $data['answer_comment'];
        $this->confidentiality = $data['hide_name'];
        $this->avatar = $data['avatar'];

    }

    public function saveAccount($user_id)
    {
        if (Yii::$app->request->isPost) {
            $this->scenario = 'personal';
            $this->attributes = \Yii::$app->request->post();

            $data = $this->db->createCommand('SELECT avatar, email FROM users WHERE users.user_id = :user_id')->bindValues([':user_id' => $user_id])->queryOne();
            $fileName = $data['avatar'];
            $email = $data['email'];

            $file = explode('.', $_FILES['avatar']['name']);
            $extensions = ['jpg', 'png'];

            if (!empty($file['0']) && !in_array($file[1], $extensions)) {
                Yii::$app->session->setFlash('error', 'Неверный формат файла');
                $this->response['data'] = $this;
                $this->response['render'] = 'registration?user_id=' . $user_id ;
            } else {
                if ($this->validate()) {
                    if ($file['0'] !== '') {
                        $randomString = $this->generateStringForPhoto();
                        $randomString .= '.' . $file['1'];
                        $fileName = $randomString;

                        $dirTemp = Yii::getAlias('@app/uploads/temp/');
                        $pathtofile = $dirTemp . $fileName;
                        move_uploaded_file($_FILES["avatar"]["tmp_name"], $pathtofile);
                    }

                    $this->db->createCommand()->update('users', [
                        'name' => $this->name,
                        'surname' => $this->surname,
                        'patronymic' => $this->patronymic,
                        'phone' => preg_replace('/[^0-9]/', '', $this->phone),
                        'email' => $email,
                        'avatar' => $fileName,
                        'updateTime' => new Expression('NOW()'),
                    ], 'user_id = ' . $user_id . '')->execute();

                    if ($file['0'] !== '') {
                        $this->writePhotosByLastId($user_id);
                    }
                    Yii::$app->response->redirect('/registration?user_id=' . $user_id);
                } else {
                    Yii::$app->session->setFlash('error', 'Ошибка ввода данных');
                    $this->attributes = $this->getAccountData($user_id);
                    $this->response['data'] = $this;
                    $this->response['render'] = 'registration?user_id=' . $user_id;
                }
            }
        }
    }
    // Generate random file name

    public function generateStringForPhoto()
    {
        $randomString = Yii::$app->getSecurity()->generateRandomString(24);
        $sqlLike =  $randomString. "%";

        $result = $this->db->createCommand("SELECT * FROM users WHERE avatar like '$sqlLike'")->queryAll();

        if ($result != null) {
            $this->generateStringForPhoto();
        } else return $randomString;

    }

    // Copy Images to new Folder

    public function writePhotosByLastId($user_id)
    {
        $pathToNewFolder = Yii::getAlias('@app/www/images/frontend/avatars');
        if(is_dir($pathToNewFolder) || mkdir($pathToNewFolder, 0700)) {
            $dirTemp = Yii::getAlias('@app/uploads/temp');

            $filelist = array();
            if ($handle = opendir($dirTemp)) {
                while ($entry = readdir($handle)) {
                    if (!is_dir($entry)) {
                        $filelist[] = $entry;
                    }
                }
            }

            $images = $this->db->createCommand("SELECT avatar FROM users WHERE user_id=:id")->bindValues([":id" => $user_id])->queryOne();
            $result[] = $images["avatar"];

            $countFilesInFolder = count($filelist);
            $countDBFiles = count($result);

            for($indexFile = 0; $indexFile < $countFilesInFolder; $indexFile++)
            {
                $fileInFolder = $filelist[$indexFile];
                for($indexDBFile = 0; $indexDBFile < $countDBFiles; $indexDBFile++)
                {
                    $filenameDB = $result[$indexDBFile];
                    if($fileInFolder == $filenameDB) {
                        $pathToFile = $dirTemp . '/' . $fileInFolder;
                        $pathToNewfile = $pathToNewFolder . '/' . $fileInFolder;
                        if (rename($pathToFile, $pathToNewfile)) {
                            break;
                        }
                    }
                }
            }
            closedir($handle);
        }
    }

    //action passchange

    public function passchange($user_id)
    {
        if (Yii::$app->request->isPost) {
            $this->scenario = 'passchange';
            $this->attributes = \Yii::$app->request->post();
            if ($this->validate()) {
                $pass = Yii::$app->security->generatePasswordHash($this->password);
                $this->db->createCommand()->update('user', [
                    'pass' => $pass,
                    'updateTime' => new Expression('NOW()'),
                ], 'user_id = ' . $user_id . '')->execute();
                Yii::$app->response->redirect('/registration?user_id=' . $user_id);
            } else {
                Yii::$app->session->setFlash('error', 'Wrong Password');
                $this->attributes = $this->getAccountData($user_id);
                $this->response['data'] = $this;
                $this->response['render']='registration?user_id=' . $user_id;
            }
        }
    }

    //action emailchange

    public function emailchange($user_id)
    {
        if (Yii::$app->request->isPost) {
            $this->scenario = 'emailchange';
            $this->attributes = \Yii::$app->request->post();
            if ($this->validate()) {
                $em = Yii::$app->request->post('email');

                $this->db->createCommand()->update('user', [
                    'old_email' => $this->email,
                ], 'user_id = ' . $user_id . '')->execute();

                Yii::$app->mailer->compose('resetEmail', ['user_id' => $user_id])
                    ->setFrom([Yii::$app->params['supportEmail'] => Yii::$app->name . ' (отправлено роботом)'])
                    ->setTo($em)
                    ->setSubject('Для сброса емейла на сайте ' . Yii::$app->name)
                    ->send();

                Yii::$app->response->redirect('/registration?user_id=' . $user_id);

            } else {
                Yii::$app->session->setFlash('error', 'Email');
                $this->attributes = $this->getAccountData($user_id);
                $this->response['data'] = $this;
                $this->response['render']='registration?user_id=' . $user_id;
            }
        }
    }

    public function saveEmailAccount()
    {
        $user_id = Yii::$app->request->get('user_id');
        $upTime =  new Expression('NOW()');
        $this->db->createCommand("UPDATE `user`,
                                  (SELECT old_email FROM `users` WHERE user_id=:id) as  tbl SET email = tbl.old_email, updateTime = {$upTime}
                                  WHERE user_id=:id")->bindValues([":id" => $user_id])->execute();

        Yii::$app->response->redirect('/registration?user_id=' . $user_id);
    }

    //for action EmailOptions

    public function saveEmailOptions($user_id)
    {
        if (Yii::$app->request->isPost) {
            $post = Yii::$app->request->post();
            $emailOptions = ['newComment' => 0, 'delivery' => 0, 'mailNotif' => 0, 'answerComment' => 0];
            foreach ($emailOptions as $key => $value) {
                foreach ($post as $keyPost => $item)
                {
                    if ($key == $keyPost && $item == 'on') {
                        $this->{$keyPost} = 1;
                    }
                }
            }
            $this->db->createCommand()->update('userSettings', [
                'comment' => $this->newComment,
                'mailing' => $this->delivery,
                'search_notif' => $this->mailNotif,
                'answer_comment' => $this->answerComment,
            ], 'user_id = ' . $user_id . '')->execute();

            Yii::$app->response->redirect('/registration?user_id=' . $user_id);
        }
    }

    //for action Confidentiality

    public function saveConfidentiality($user_id)
    {
        if (Yii::$app->request->isPost) {
            $post = Yii::$app->request->post('confidentiality');
            if(isset($post))
                $this->confidentiality = 1;
            else
                $this->confidentiality = 0;

            $this->db->createCommand()->update('userSettings', [
                'hide_name' => $this->confidentiality,
            ], 'user_id = ' . $user_id . '')->execute();

            Yii::$app->response->redirect('/registration?user_id=' . $user_id);
        }
    }

    public function getUserById($id){
        if ($this->_user === false) {
            $this->_user = static::findIdentity($id);
        }
        return $this->_user;
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

    public function setPassword($password)
    {
        $this->pass = Yii::$app->security->generatePasswordHash($password);
    }

    public function randomPw()
    {
       return Yii::$app->security->generateRandomString($length = 8);
    }

    public function randomPassword()
    {
        $pass = Yii::$app->security->generateRandomString($length = 8);
        $this->pass = Yii::$app->security->generatePasswordHash($pass);
    }


    public function generateAuthKey()
    {
        $this->auth_key = Yii::$app->security->generateRandomString();
    }

    public static function findIdentity($id)
    {
        return static::findOne([
            'user_id' => $id,
        ]);

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
}