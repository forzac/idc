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
use yii\helpers\Url;



class Myaccount extends ActiveRecord
{
    private $db;
    private $controller;
    private $response = ["render" => "myaccount", "error" => 0, "message" => "", "data" => []];

    public $newComment;
    public $delivery;
    public $mailNotif;
    public $answerComment;
    public $confidentiality;

    public $confirmPassword;

//    public $updateTime;
    public $avatar;
    public $uploadFile;
    public $avatarName;
    public $rullesRequired = ['name', 'surname', 'patronymic',];

    public static function tableName()
    {
        return 'users';
    }

    public function __construct()
    {
        $this->db = Yii::$app->db;
        //$this->isAjax = $isAjax;
    }

    public function __destruct()
    {
        $this->db->close();
    }

    public static function Initial()
    {
        return new Myaccount();
    }

    public function scenarios()
    {
        return [
            'personal' => ['name', 'surname', 'patronymic', 'phone'],
            'emailchange' => ['email'],
            'passchange' => ['password', 'confirmPassword'],
        ];
    }

    public function rules()
    {
        return [
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

            //[['avatar'],'image','skipOnEmpty' => false,'extensions' => ['png', 'jpg', 'gif']],
//            [['newComment', 'delivery', 'mailNotif', 'answerComment'], 'boolean', 'on' => 'emailnotif'],
//
//            ['confidentiality', 'boolean', 'on' => 'confidentiality'],
        ];
    }

    public function Run($mode, $user_id)
    {

        if (Yii::$app->request->isAjax) {
            $this->AjaxRun($mode);
        } else {
            if (!$mode) {
                $this->getAccountData($user_id);
                $this->response['data'] = $this;
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
        }
        return $this;
    }

    public function AjaxRun($mode)
    {

    }

    public function getResponse()
    {
        return $this->response;
    }

    public function getAccountData($user_id)
    {
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
                $this->response['render'] = 'myaccount';
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
                    Yii::$app->response->redirect('/myaccount?user_id=' . $user_id);
                } else {
                    Yii::$app->session->setFlash('error', 'Ошибка ввода данных');
                    $this->attributes = $this->getAccountData($user_id);
                    $this->response['data'] = $this;
                    $this->response['render'] = 'myaccount?user_id=' . $user_id;
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
                Yii::$app->response->redirect('/myaccount?user_id=' . $user_id);
            } else {
                Yii::$app->session->setFlash('error', 'Wrong Password');
                $this->attributes = $this->getAccountData($user_id);
                $this->response['data'] = $this;
                $this->response['render']='myaccount?user_id=' . $user_id;
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

            Yii::$app->mailer->compose('activationEmail', ['user_id' => $user_id])
                ->setFrom([Yii::$app->params['supportEmail'] => Yii::$app->name . ' (отправлено роботом)'])
                ->setTo($em)
                ->setSubject('Чтобы подтвердить регестрацию ' . Yii::$app->name)
                ->send();

            Yii::$app->response->redirect('/myaccount?user_id=' . $user_id);

            } else {
                Yii::$app->session->setFlash('error', 'Email');
                $this->attributes = $this->getAccountData($user_id);
                $this->response['data'] = $this;
                $this->response['render']='myaccount?user_id=' . $user_id;
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

        Yii::$app->response->redirect('/myaccount?user_id=' . $user_id);
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

            Yii::$app->response->redirect('/myaccount?user_id=' . $user_id);
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

            Yii::$app->response->redirect('/myaccount?user_id=' . $user_id);
        }
    }

    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'имя',
            'surname' => 'фамилия',
            'patronymic' => 'отчество',
            'email' => 'эл. почта',
            'password' => 'пароль',
            'phone' => 'телефон',
            'confirmPassword' => 'повторить пароль',
            'status' => 'status',
            'auth_key' => 'Auth Key',
            'secret_key' => 'Secret Key',
            'confidentiality' => 'Отображать объявления, или нет?',
            'newComment' => 'Новый коментарий',
            'delivery' => 'Рассылка',
            'answerComment' => 'Ответ на коментарий',
            'mailNotif' => 'Пошаговые уведомления',
            'avatar' => ''
        ];
    }


}