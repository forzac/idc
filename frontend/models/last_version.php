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

    public $surname;
    public $name;
    public $email;
    public $password;
    public $patronymic;
    public $secret_key;
    public $phone;
    public $type;
    public $status;
    public $createTime;
    public $updateTime;
    public $repeat_password;
    public $_user;
    public $rememberMe;
    public $auther;


    public function __construct(&$controller){
        $this->db = Yii::$app->db;
        //$this->isAjax = $isAjax;
        $this->controller = &$controller;
    }

    public function scenarios()
    {
        return [
            'validmail' => ['email'],
            'activationAccount' => ['name', 'surname', 'patronymic','password', 'repeat_password', 'phone'],
            'resetPassword' => ['password', 'repeat_password'],
            'login' => ['email', 'password'],
            'default' => ['name', 'surname', 'patronymic','password', 'repeat_password', 'phone'],
            'ajax' => ['file'],
        ];
    }

    public function rules()
    {
        return [
            [['name', 'password', 'phone', 'repeat_password'], 'required', 'message' => 'Заполните все поля', 'on' => 'activationAccount'],
            [['name', 'surname', 'patronymic', 'phone'], 'filter', 'filter' => 'trim', 'on' => 'activationAccount'],
            [['password', 'repeat_password'], 'required', 'on' => 'resetPassword', 'message' => 'Заполните поле пароль'],
            ['repeat_password', 'compare', 'compareAttribute' => 'password', 'on' => 'activationAccount', 'message' => 'Пароль должен быть повторен в точности'],
            ['repeat_password', 'compare', 'compareAttribute' => 'password', 'on' => 'resetPassword', 'message' => 'Пароль должен быть повторен в точности'],
            ['name', 'string', 'min' => 2, 'max' => 100, 'tooShort' => "Длинна от 2 до 100 символов", 'tooLong' => "Длинна от 2 до 100 символов", 'on' => 'activationAccount'],
            ['surname', 'string', 'min' => 2, 'max' => 100, 'tooShort' => "Длинна от 2 до 100 символов", 'tooLong' => "Длинна от 2 до 100 символов", 'on' => 'activationAccount'],
            ['patronymic', 'string', 'min' => 2, 'max' => 100, 'tooShort' => "Длинна от 2 до 100 символов", 'tooLong' => "Длинна от 2 до 100 символов", 'on' => 'activationAccount'],
            ['email', 'required', 'message' => 'Поле обязательно для заполенения', 'on' =>  'validmail'],
            ['email', 'email', 'message' => 'Пример эл. почты name@mail.com', 'on' => 'validmail'],
            ['email', 'required', 'message' => 'Поле обязательно для заполенения', 'on' => 'login'],
            ['password', 'required', 'message' => 'Заполните поле пароль', 'on' => 'login'],
            ['email', 'email', 'message' => 'Пример эл. почты name@mail.com', 'on' => 'login'],
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

    public function __destruct(){
        $this->db->close();
    }

    public static function Initial(&$controller){
        return new User($controller);
    }

//    public function rules(){
//        return [
//            [['name', 'surname', 'patronymic', 'phone'], 'filter', 'filter' => 'trim'],
//            ['name', 'string', 'min' => 2, 'max' => 100, 'tooShort' => "Длинна от 2 до 100 символов", 'tooLong' => "Длинна от 2 до 100 символов"],
//            ['surname', 'string', 'min' => 2, 'max' => 100, 'tooShort' => "Длинна от 2 до 100 символов", 'tooLong' => "Длинна от 2 до 100 символов"],
//            ['patronymic', 'string', 'min' => 2, 'max' => 100, 'tooShort' => "Длинна от 2 до 100 символов", 'tooLong' => "Длинна от 2 до 100 символов"],
//            ['email', 'required', 'message' => 'Поле обязательно для заполенения'],
//            ['email', 'email', 'message' => 'Пример эл. почты andrey@andrey.com'],
//            ['password', 'validatePassword'],
////            ['email', 'unique',
////                'targetClass' => User::className(),
////                'message' => 'Эта эл. почта уже занята',
////            ],
//          // [['newComment', 'delivery', 'emailNotif', 'answerComment', 'confidentiality'], 'boolean'],
//        ];
//    }

    public function Run($mode, $key, $id, $provider){

        if(Yii::$app->request->isAjax){
            //$this->AjaxRun{}
        }
        else{
            if($mode == 'index'){
                $this->response['data']['model'] = $this;
            }
            if($mode == 'registration'){
                $this->register();
                $this->sendActivationEmail();
            }
            if ($mode == 'activateAccount') {
                $this->updateProfile($key);
                if (Yii::$app->request->isPost){
                    $this->activateAccount($key);
                }
            }
            if ($mode == 'login' || $provider) {
                if (Yii::$app->request->get('provider')) {
                    $this->loginSocial($provider);
                }
                if (Yii::$app->request->post()) {
                    $this->login();
                }

                $this->response['data']['model'] = $this;
                $this->response['data']['google'] = $this->returnGoogleApi()->getAuthUrl();
                $this->response['data']['facebook'] = $this->returnFacebookApi()->getAuthUrl();
                $this->response['data']['vk'] = $this->returnVkApi()->getAuthUrl();
                $this->response['data']['mailru'] = $this->returnMailruApi()->getAuthUrl();
                $this->response['data']['yandex'] = $this->returnYandexApi()->getAuthUrl();
                $this->response['render']='login';
            }
            if ($mode == 'resetPasswordMail') {
                $this->updateUser();
                $this->resetPasswordMail();
            }

            if ($mode == 'resetPassword' && key) {
                $sk = $_GET['key'];
                $this->updateProfile($key);
                if (Yii::$app->request->isPost) {
                    $this->resetPassword($key);
                }
                $this->response['data']['key'] = $sk;
                $this->response['data']['model'] = $this;
                $this->response['render'] = 'resetPassword';
            }
            if ($mode == 'logout' && $id) {
                $this->logout($id);
            }



        }
        return $this;
    }

    public function updateProfile($key)
    {
        $data = $this->db->createCommand('SELECT * FROM users WHERE users.secret_key = :key'
        )->bindValues([':key' => $key])->queryOne();
        $this->attributes = $data;
        $this->response['data']['model'] = $this;
        $this->response['data']['key'] = $key;
        $this->response['data']['email'] = $data['email'];
        $this->response['render']='activationAccount';

//        $key = $_GET['key'];
//        $this->_user = $this->db->createCommand('SELECT * FROM users WHERE users.secret_key = :key'
//        )->bindValues([':key' => $key])->queryOne();
//        $this->response['data']['email'] = $this->_user['email'];
    }


    public function getResponse(){
        return $this->response;
    }

    public function register()
    {
        $this->scenario = 'validmail';
        if($this->load(Yii::$app->request->post()))
        {
            if ($this->validate()) {
                $this->db->createCommand()->insert('users', [
                    'email' => $this->email,
                    'status' => User::STATUS_NOT_ACTIVE,
                    'pass' => $this->randomPassword(),
                    'secret_key' => $this->generateSecretKey(),
                    'auth_key' => $this->generateAuthKey(),
                    'createTime' => new Expression('NOW()'),
                ])->execute();
                Yii::$app->session->setFlash('success', 'Подтвердите регестрацию на почте ' . $this->email);
                $this->controller->redirect('/index');
            } else {
                Yii::$app->session->setFlash('error', 'Пример эл. почты name@mail.com');
            }
        }
        $this->response['render'] = 'registration';
        $this->response['data'] = $this;
    }

    public function updateUser()
    {
        $this->scenario = 'validmail';
        if ($this->load(Yii::$app->request->post())) {
            if ($this->validate()) {
                $email = Yii::$app->request->post('User')['email'];
                $key = $this->generateSecretKey();
                $this->db->createCommand('UPDATE users SET users.secret_key = :key WHERE users.email = :email')->bindValues([':email' => $email, ':key' => $key])->execute();
            }
        }
        $this->response['data']['model'] = $this;
        $this->response['render'] = 'resetPasswordMail';
    }


    public function sendActivationEmail()
    {
        $this->scenario = 'validmail';
        if ($this->load(Yii::$app->request->post()) && $this->validate()) {
            $em = Yii::$app->request->post('User')['email'];
            $user = $this->db->createCommand('SELECT * FROM users WHERE email=:email')
                ->bindValues([':email' => $em])
                ->queryOne();
            return Yii::$app->mailer->compose('activationEmail', ['email' => $user['email'], 'secret_key' => $user['secret_key']])
                ->setFrom([Yii::$app->params['supportEmail'] => Yii::$app->name . ' (отправлено роботом)'])
                ->setTo($em)
                ->setSubject('Чтобы подтвердить регестрацию ' . Yii::$app->name)
                ->send();
        }
    }

    public function activateAccount($key)
    {
        $this->scenario = 'activationAccount';
        if ($this->load(Yii::$app->request->post())) {
            if ($this->validate()) {
                $surname = Yii::$app->request->post('User')['surname'];
                $name = Yii::$app->request->post('User')['name'];
                $patronymic = Yii::$app->request->post('User')['patronymic'];
                $phone = Yii::$app->request->post('User')['phone'];
                $pass = Yii::$app->request->post('User')['password'];
                $password = Yii::$app->security->generatePasswordHash($pass);
                $status = self::STATUS_ACTIVE;
                $type = self::TYPE_USER;

                $post = $this->db->createCommand("UPDATE users
                                        SET users.surname = :surname, users.name = :name, users.updateTime = :ut, users.patronymic = :pat, users.phone = :phone, users.pass = :pass, users.status = :status, users.type = :type
                                        WHERE users.secret_key = :key")->bindValues([':surname' => $surname, ':name' => $name, ':key' => $key, ':ut' => new Expression('NOW()'),
                    ':pat' => $patronymic, ':phone' => $phone, ':pass' => $password, ':status' => $status, ':type' => $type])
                    ->execute();
                if ($post) {
                    $this->db->createCommand()->update('users', ['secret_key' => null, 'updateTime' => new Expression('NOW()')], 'secret_key = :key')->bindValues([':key' => $key])->execute();
                    $this->login();
                    $this->controller->redirect('/index');
                }
            }
        }
        $this->response['data']['key'] = $key;


    }

    public function resetPasswordMail()
    {
        $this->scenario = 'validmail';
        if ($this->load(Yii::$app->request->post())) {
            if ($this->validate()) {
                $email = Yii::$app->request->post('User')['email'];
                $status = self::STATUS_ACTIVE;
                $user = $this->db->createCommand('SELECT * FROM users WHERE users.email = :email AND users.status = :status'
                )->bindValues([':email' => $email, ':status' => $status])->queryOne();
                if ($user) {
                    Yii::$app->mailer->compose('resetPassword', ['email' => $user['email'], 'secret_key' => $user['secret_key']])
                        ->setFrom([Yii::$app->params['supportEmail'] => Yii::$app->name . ' (отправлено роботом)'])
                        ->setTo($email)
                        ->setSubject('Сброс пароля ' . Yii::$app->name)
                        ->send();
                    Yii::$app->session->setFlash('success', 'Перейдите на почту ' . $email . ', для сброса пароля.');
                    $this->response['render'] = 'index';
                } else {
                    Yii::$app->session->setFlash('error', 'Такой email не зарегестрирован');
                }
            }
        }
    }

    public function resetPassword($key)
    {
        $this->scenario = 'resetPassword';
        if ($this->load(Yii::$app->request->post())) {
            if ($this->validate()) {
                $pass = Yii::$app->security->generatePasswordHash($this->password);
                $user = $this->db->createCommand('UPDATE users SET users.pass = :pass WHERE users.secret_key = :key')->bindValues([':key' => $key, ':pass' => $pass])->execute();
                if ($user) {
                    $this->db->createCommand()->update('users', ['secret_key' => null, 'updateTime' => new Expression('NOW()')], 'secret_key = :key')->bindValues([':key' => $key])->execute();
                }
                $this->login();
                $this->controller->redirect('/index');
            }
        }

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

    public function loginSocial($provider)
    {
        if ($provider === 'facebook') {
            $auther = $this->returnFacebookApi();
        }
        if ($provider === 'google') {
            $auther = $this->returnGoogleApi();
        }
        if ($provider === 'vk') {
            $auther = $this->returnVkApi();
        }
        if ($provider === 'odnoklassniki') {
            $auther = $this->returnOdnoklassnikiApi();
        }
        if ($provider === 'mailru') {
            $auther = $this->returnMailruApi();
        }
        if ($provider === 'yandex') {
            $auther = $this->returnYandexApi();
        }

        if (Yii::$app->request->get('code') && $auther->authenticate()) {
            $email = $auther->getEmail();
            $fullname = $auther->getName();
            $cat = explode(" ", $fullname);
            $name = $cat[0];
            $surname = $cat[1];
            if ($email) {
                $user = $this->db->createCommand('SELECT * FROM users WHERE users.email = :email')->bindValues([':email' => $email])->queryOne();
            }

            if ($user == false) {
                $save = $this->db->createCommand()->insert('users', [
                    'email' => $email,
                    'name' => $name,
                    'surname' => $surname,
                    'status' => User::STATUS_NOT_ACTIVE,
                    'pass' => $this->randomPassword(),
                    'secret_key' => $this->generateSecretKey(),
                    'auth_key' => $this->generateAuthKey(),
                    'createTime' => new Expression('NOW()'),
                ])->execute();
                if ($save) {
                    $data = $this->db->createCommand('SELECT * FROM users WHERE users.email = :email')->bindValues([':email' => $email])->queryOne();
                    return Yii::$app->mailer->compose('activationEmail', ['email' => $data['email'], 'secret_key' => $data['secret_key']])
                        ->setFrom([Yii::$app->params['supportEmail'] => Yii::$app->name . ' (отправлено роботом)'])
                        ->setTo($email)
                        ->setSubject('Чтобы подтвердить регестрацию ' . Yii::$app->name)
                        ->send();
                }

            } elseif($user['status'] == self::STATUS_ACTIVE) {
                if (!Yii::$app->session->get('user_id=' . Yii::$app->request->cookies->getValue('test'))){
                    $session = Yii::$app->session;
                    $session->set('user_id=' . $user['user_id'], $user['user_id']);
                    $session->set('name=' . $user['user_id'], $user['name']);
                    Yii::$app->response->cookies->add(new Cookie([
                        'name' => 'test',
                        'value' => $user['user_id']
                    ]));
                } else {
                    // $this->controller->redirect('/index');
                }
            } else {
                $this->controller->redirect('/index');
            }

        }
    }

    public function login()
    {
        $this->scenario = 'login';
        if ($this->load(Yii::$app->request->post())) {
            if ($this->validate()) {
                if ($this->validatePassword($this->password) == true) {
                    $user = $this->getUser();
                    $session = Yii::$app->session;
                    $session->set('user_id=' . $user['user_id'], $user['user_id']);
                    $session->set('name=' . $user['user_id'], $user['name']);
                    Yii::$app->response->cookies->add(new Cookie([
                        'name' => 'test',
                        'value' => $user['user_id']
                    ]));
                    $this->controller->redirect('/index');

                } else {
                    return Yii::$app->session->setFlash('error', 'Неверный емейл или пароль');
                }
            }
        }
    }


    public function getUser()
    {
        if ($this->load(Yii::$app->request->post())) {
            $email = Yii::$app->request->post('User')['email'];
            $this->_user = $this->findByEmail($email);
        }
        return $this->_user;
    }

    public function findByEmail($email)
    {
        $status = self::STATUS_ACTIVE;
        $user = $this->db->createCommand('SELECT * FROM users WHERE users.email = :email AND users.status = :status'
        )->bindValues([':email' => $email, ':status' => $status])->queryOne();
        return $user;
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


    public function logout($id)
    {
        $session = Yii::$app->session;
        $session->remove('user_id=' . $id);
        setcookie ("test", "", time() - 3600);
        $this->controller->redirect('/index');
    }


    public function generateSecretKey()
    {
        return Yii::$app->security->generateRandomString() . '_' . time();
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


//    public function setPassword($password)
//    {
//        $this->pass = Yii::$app->security->generatePasswordHash($password);
//    }

    public function randomPassword()
    {
        $pass = Yii::$app->security->generateRandomString($length = 8);
        return Yii::$app->security->generatePasswordHash($pass);
    }

    public function generateAuthKey()
    {
        return Yii::$app->security->generateRandomString();
    }

//    public function validatePassword($password)
//    {
//        return Yii::$app->security->validatePassword($password, $this->pass);
//    }

    public static function findIdentity($id)
    {
        // $user = static::$db->createCommand('SELECT * FROM users WHERE users.user_id = :id AND users.status = :status ')->bindValues([':status' => self::STATUS_ACTIVE, ':id' => $id])->queryOne();
        return static::findOne([
            'user_id' => $id,
            'status' => self::STATUS_ACTIVE
        ]);
    }

    public static function findIdentityByAccessToken($token, $type = null)
    {
        return static::findOne(['access_token' => $token]);
    }

    public function getId()
    {
        if ($this->load(Yii::$app->request->post())) {
            $email = Yii::$app->request->post('User')['email'];
            $user = $this->findByEmail($email);
            return $user['user_id'];
        }

    }

    public function getAuthKey()
    {
        if ($this->load(Yii::$app->request->post())) {
            return $this->auth_key;
        }

    }

    public function validateAuthKey($authKey)
    {
        return $this->auth_key === $authKey;
    }

}