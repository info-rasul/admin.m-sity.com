<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Session;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\ContactForm;
use app\models\AddAds;

class SiteController extends Controller
{
    /**
     * @inheritdoc
     */
    public $uploadPath;

    public function init(){
        $this->uploadPath = './files/'.date('Y-m').'/';
    }
    
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

    /**
     * @inheritdoc
     */
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

    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex()
    {
        $this->MainConnect();
        return $this->render('index');
    }

    /**
     * Login action.
     *
     * @return string
     */
    public function actionLogin()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        }
        return $this->render('login', [
            'model' => $model,
        ]);
    }

    /**
     * Logout action.
     *
     * @return string
     */
    public function actionLogout()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }
        Yii::$app->user->logout();
        return $this->goHome();
    }

    /**
     * Displays contact page.
     *
     * @return string
     */
    public function actionContact()
    {
        $model = new ContactForm();
        if ($model->load(Yii::$app->request->post()) && $model->contact(Yii::$app->params['adminEmail'])) {
            Yii::$app->session->setFlash('contactFormSubmitted');

            return $this->refresh();
        }
        return $this->render('contact', [
            'model' => $model,
        ]);
    }

    /**
     * Displays about page.
     *
     * @return string
     */
    public function actionAbout()
    {
        return $this->render('about');
    }

    public function actionMyads()
    {
        $this->MainConnect();
        return $this->render('myads', []);
    }

    public function actionAddads()
    {
        $this->MainConnect();
        $session = Yii::$app->session;
        $session->open();

        $address = $type_object_html = $type_rental_html = $type_property_html = $type_transaction_html = $get_url = $object_html = $puth_form ='';
        $number_floors = $separate_toilets = $balcony = $loggia = $combined_bathroom = $repairs = $information_building_type = $passenger_elevators  = $service_lift = $parking = array();
        $model = new AddAds();
        //возможные типы сделки
        $type_deal = $model->getEnumTable('object', 'type_transaction');
        //html код для выбора типа сделки
        $type_object_html = $model->getTypeObjectHtml($type_deal, 'type_transaction');
        
        //Возможные типы объектов
        $get_type_object = Yii::$app->request->get('type_transaction');
        if(!empty($get_type_object)){
            switch ($get_type_object) {
                //продажа
                case 'sale':
                    $get_url .= 'type_transaction=sale';
                    $session->set('type_transaction', 'sale');
                    $type_rent = $model->getEnumTable($get_type_object, 'type_property');
                    $type_rental_html = $model->getTypeObjectHtml($type_rent, 'type_property', $get_url);
                    $get_type_property = Yii::$app->request->get('type_property');
                    if(!empty($get_type_property)){
                        $type_rent = $model->getEnumTable('sale', $get_type_property);
                        $get_url .= '&type_property='.$get_type_property;
                        $session->set('type_property', $get_type_property);
                        $type_property_html = $model->getTypeObjectHtml($type_rent, 'object', $get_url);
                        $puth_form = 'type_transaction='.Yii::$app->session->get('type_transaction')."&type_property=".Yii::$app->session->get('type_property')."&type_rent=".Yii::$app->session->get('type_rent');
                    } 
                    break;
                //аренда    
                case 'rent':
                    $get_url .= 'type_transaction=rent';
                    $session->set('type_transaction', 'rent');
                    $type_rent = $model->getEnumTable($get_type_object, $get_type_object);
                    $type_rental_html = $model->getTypeObjectHtml($type_rent, 'type_rent', $get_url);
                    $get_type_transaction = Yii::$app->request->get('type_rent');
                    if(!empty($get_type_transaction)){
                        $get_url .= '&type_rent='.$get_type_transaction;
                        $session->set('type_rent', $get_type_transaction);
                        $type_rent = $model->getEnumTable('rent', $get_type_transaction);
                        $type_transaction_html = $model->getTypeObjectHtml($type_rent, 'type_property', $get_url);
                    }
                    $get_object = Yii::$app->request->get('type_property');
                    if(!empty($get_object)){
                        $type_object = $model->getEnumTable('rent', $get_object.'_'.$get_type_transaction);
                        $get_url .= '&type_property='.$get_object;
                        $session->set('type_property', $get_object);
                        $object_html = $model->getTypeObjectHtml($type_object, 'object', $get_url);
                        $puth_form = 'type_transaction='.Yii::$app->session->get('type_transaction')."&type_property=".Yii::$app->session->get('type_property')."&type_rent=".Yii::$app->session->get('type_rent');
                    }
                    break;
            }
        }

        if(!empty(Yii::$app->request->post('object-type'))){
            $level_object['type_transaction'] = !empty($session['type_transaction']) ? $session['type_transaction'] : '';
            $level_object['type_property'] = !empty($session['type_property']) ? $session['type_property'] : '';
            $level_object['type_rent'] = !empty($session['type_rent']) ? $session['type_rent'] : '';
            $level_object['object_type'] = Yii::$app->request->post('object-type');
            $add_object = $model->addObject($level_object);

            $address = $level_object['object_type'];
            $number_floors = $model->getEnumTable('flat_rent_daily', 'number_rooms');
            $loggia = $model->getEnumTable('flat_rent_daily', 'loggia');
            $balcony = $model->getEnumTable('flat_rent_daily', 'balcony');
            $separate_toilets = $model->getEnumTable('flat_rent_daily', 'separate_toilets');
            $combined_bathroom = $model->getEnumTable('flat_rent_daily', 'combined_bathroom');
            $repairs = $model->getEnumTable('flat_rent_daily', 'repairs');
            $information_building_type = $model->getEnumTable('information_building', 'type');
            $passenger_elevators = $model->getEnumTable('information_building', 'passenger_elevators');
            $service_lift = $model->getEnumTable('information_building', 'service_lift');
            $parking = $model->getEnumTable('information_building', 'parking');
            $currency = $model->getEnumTable('price_conditions', 'currency');
        }

        if(!empty(Yii::$app->request->post('address'))){
            $address = Yii::$app->request->post('address');
            $model->addAddress(Yii::$app->request->post('id_object'), $address);
        }

/*          ["address"]=>
              array(4) {
                ["country"]=>
                string(12) "Россия"
                ["sity"]=>
                string(12) "Москва"
                ["street"]=>
                string(16) "Гагарина"
                ["house"]=>
                string(2) "10"
              }*/

       /* if(!empty($_POST)){
            echo "<pre>";
            var_dump($_POST);
            echo "</pre>";
        }*/
        //die();
        $session->close();
        return $this->render('addads', [
            'type_object' =>  $type_object,
            'type_object_html' =>  $type_object_html,
            'type_rental_html' =>  $type_rental_html,
            'type_property_html' =>  $type_property_html,
            'type_transaction_html' =>  $type_transaction_html,
            'object_html' =>  $object_html,
            'puth_form' =>  $puth_form,
            'number_floors' =>  $number_floors,
            'loggia' =>  $loggia,
            'balcony' =>  $balcony,
            'separate_toilets' =>  $separate_toilets,
            'combined_bathroom' =>  $combined_bathroom,
            'repairs' =>  $repairs,
            'information_building_type' =>  $information_building_type,
            'passenger_elevators' =>  $passenger_elevators,
            'service_lift' =>  $service_lift,
            'parking' =>  $parking,
            'address' =>  $address,
            'add_object' =>  $add_object
        ]);
    }

    public function MainConnect(){
        Yii::$app->controller->layout = 'full.php';
    }

    //Список метро
    public function actionMetrolist($q = null) {
        /*if (Yii::$app->user->isGuest) {
            return $this->goHome();
        }*/
        $dom = Yii::$app->request->get('q');
        if (!empty($dom)) {
            $model = new AddAds();
            $out = $model->getMetro($dom);
            return $out;
        } else{
            return array();
        }
    }

    public function actionUpload()
    {
        $fileName = 'file';
        if (isset($_FILES[$fileName])) {
            $file = \yii\web\UploadedFile::getInstanceByName($fileName);
            if (!is_dir($this->uploadPath)) 
                mkdir($this->uploadPath);
            //Print file data
            if ($file->saveAs($this->uploadPath . $file->name)) {
                echo \yii\helpers\Json::encode($file);
            }
        }
        return false;
    }

    //Удаление изображения
    public function actionAddphoto() {
        $model = new AddAds();
        if(!empty(Yii::$app->request->post('file_name')) and !empty(Yii::$app->request->post('id'))){
            $main = !empty(Yii::$app->request->post('main')) ? 1 : 0;
            $model->addPhoto(Yii::$app->request->post('id'), $this->uploadPath.Yii::$app->request->post('file_name'), $main);
        }
    }
    //Удаление изображения
    public function actionDelphoto() {
        $model = new AddAds();
        if(!empty(Yii::$app->request->post('file_name')) and !empty(Yii::$app->request->post('id'))){
            $model->delPhoto(Yii::$app->request->post('id'), $this->uploadPath.Yii::$app->request->post('file_name'));
        }
    }
}
