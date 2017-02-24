<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Session;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\ContactForm;
use app\models\flatRent;
use app\models\GeneralModel;

class ReviewController extends Controller
{
    public $uploadPath;

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

    }

    public function actionFlat()
    {
        $this->MainConnect();
        return $this->render('flat');
    }

    public function MainConnect()
    {
        Yii::$app->controller->layout = 'full.php';
    }

}
