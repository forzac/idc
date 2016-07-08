<?php

namespace frontend\controllers;


use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\filters\VerbFilter;
use frontend\models\LoginForm;
use frontend\models\ContactForm;
use frontend\models\UserSettings;
use frontend\models\EmailNotifForm;
use frontend\models\User;
use frontend\models\Poster;
use frontend\models\Curl;
use frontend\models\User2;
use frontend\models\Myaccount;
use frontend\models\UserSocial;
use yii\mongodb\Collection;
use yii\mongodb\Query;

class SiteController extends Controller
{
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout'],
                'rules' => [
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    public function actionIndex()
    {
        return $this->render('index');
    }

    public function actionPages()
    {
        return $this->render('pages/pages');
    }

    public function actionTest()
    {
        $user = new User2();
        $user->email = 'asd';
        $user->save();

        return $this->render('test', ['model' => $user]);
    }

    public function actionRegistration($mode = false, $key = false, $user_id = false, $provider = false)
    {
        $response = User::Initial()->Run($mode, $key, $user_id, $provider)->getResponse();
        if (Yii::$app->request->isAjax) {
            echo json_encode($response['data']);
            exit;
        } else {
            return $this->render($response['render'], ['data' => $response['data']]);
        }
    }

    public function actionPoster($mode = false)
    {
        $response = Poster::Initial()->Run($mode)->getResponse();
        if (Yii::$app->request->isAjax) {
            echo json_encode($response['data']);
            exit;
        } else {
            return $this->render($response['render'], ['data' => $response['data']]);
        }
    }

    public function actionSocial($mode = false, $key = false, $user_id = false, $provider = false)
    {
        $response = UserSocial::Initial()->Run($mode, $key, $user_id, $provider)->getResponse();
        if (Yii::$app->request->isAjax) {
            echo json_encode($response['data']);
            exit;
        } else {
            return $this->render($response['render'], ['data' => $response['data']]);
        }
    }


    public function actionMyaccount($mode = false, $user_id = false)
    {
        $response = Myaccount::Initial()->Run($mode, $user_id)->getResponse();

        if(Yii::$app->request->isAjax){
            echo json_encode($response["data"]);
            exit;
        }
        else{
            return $this->render($response['render'],["data"=>$response["data"]]);
        }
    }

    public function actionAjax() {
        if(Yii::$app->request->post()) {
            $name = Yii::$app->request->post('name');
            for($i = 1; $i < count($name); $i++) {
                Yii::$app->mailer->compose('sendMail')
                    ->setFrom([Yii::$app->params['supportEmail'] => Yii::$app->name . ' (отправлено роботом)'])
                    ->setTo($name[$i])
                    ->setSubject('Производитель обуви и сумок ')
                    ->send();
            }
            \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
            return ['name' => $name];
        }
    }

}


