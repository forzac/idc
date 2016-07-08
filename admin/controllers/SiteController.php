<?php

namespace admin\controllers;

use admin\models\User;
use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\filters\VerbFilter;
use admin\models\LoginForm;
use admin\models\SignupForm;

class SiteController extends Controller
{
    public function behaviors()
    {
        return [
           'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                     [
                        'actions' => ['login', 'error', 'signup' ],
                        'allow' => true,
                    ],
                    [
                        'actions' => ['logout', 'index', 'users','settings', 'languages','pages','api','offers','categories','orders','payments','advertising','extensions'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    //'logout' => ['post', 'get'],
                ],
            ],
        ];
    }

    /*public function actions()
    {        
        return
         [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
        ];

        
    }*/

    public function actionError()
    {
    $exception = Yii::$app->errorHandler->exception;
    if(Yii::$app->user->isGuest)
    $this->layout = 'login';
    else
        $this->layout = 'main';
    if ($exception !== null) {
        return 
        $this->render('error', ['exception' => $exception]);
    }
    }
    

    public function actionIndex()
    {
    	return $this->render('index');
    }
    public function actionLogin()
    {
		
		$this->layout = 'login';


        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goHome();
        } else {
            return $this->render('log', [
                'model' => $model,
            ]);
        }
    }
    public function actionSignup()
    {
    $model = new SignupForm();
    if ($model->load(Yii::$app->request->post())) {
        if ($user = $model->signup()) {
            if (Yii::$app->getUser()->login($user)) {
                return $this->goHome();
            }
        }
    }

    return $this->render('signup', [
        'model' => $model,
    ]);
    }


    public function actionLogout()
    {
        Yii::$app->user->logout();
        return $this->goHome();
    }
    
	public function actionUsers()
    {
        $contusers = User::getUsers();
       // $array=[];

        return $this->render('users/users',['usersview'=>$contusers]);
    }
    
    public function actionSettings()
    {
        return $this->render('settings/settings');
    }
     
    public function actionLanguages()
    {
        $data = \admin\models\Lang::Initializ($this)->exeModel()->getResponse();        
        if(\Yii::$app->request->isAjax()){
            $data["render"] = $this->renderPartial($data["render"],["data"=>$data]);
            echo json_encode($data);
        }
        else return $this->render($data["render"],["data"=>$data]);
    }
    
    
    public function actionPages()
    {
        return $this->render('pages/pages');
    }
     public function actionApi()
    {
        return $this->render('api');
    }
     public function actionExtensions()
    {
        return $this->render('extensions');
    }
    
     public function actionOffers()
    {
        return $this->render('offers');
    }
     public function actionCategories()
    {
        return $this->render('categories');
    }
     public function actionOrders()
    {
        return $this->render('orders');
    }
     public function actionPayments()
    {
        return $this->render('payments');
    }
     public function actionAdvertising()
    {
        return $this->render('advertising');
    }



}
