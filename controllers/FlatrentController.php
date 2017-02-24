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

class FlatrentController extends Controller
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
        $this->MainConnect();
        $model = new flatRent();
        /*if(!empty($_POST)){
            echo "<pre>";
            var_dump($_POST);
            echo "</pre>";
        }*/

        $add_object = false;
        
        //Адрес объекта
        $address = Yii::$app->request->post('address') ? Yii::$app->request->post('address') : false;
        $about = Yii::$app->request->post('about') ? Yii::$app->request->post('about') : false;
        $opisanie = Yii::$app->request->post('opisanie') ? Yii::$app->request->post('opisanie') : false;

        if(!empty($address) and !empty($about)){         
            $add_object =  $model->addObject($address, $about['cadastral_number'], $opisanie);
        }
        //Метро
        $metro = Yii::$app->request->post('metro') ? Yii::$app->request->post('metro') : false;
        if(!empty($metro)){
            foreach ($metro as $key => $stan) {
                if(!empty($stan['name']) and !empty($stan['name']) and !empty($stan['name'])){
                    $model->addMetro($add_object, $stan['name'], $stan['walk_transp'], $stan["minutes"]);
                }
            }
        } 
        //Об объекте
        $furnished = Yii::$app->request->post('furnished') ? Yii::$app->request->post('furnished') : false;
        $information_building = Yii::$app->request->post('information_building') ? Yii::$app->request->post('information_building') : false;
        $price_conditions = Yii::$app->request->post('price_conditions') ? Yii::$app->request->post('price_conditions') : false;

        if(!empty($about) and !empty($price_conditions) and !empty($furnished) and !empty($information_building)){         
            $add_about =  $model->addAbout($add_object, $about, $furnished, $information_building, $price_conditions);
        }    
       
        $contacts = Yii::$app->request->post('contacts') ? Yii::$app->request->post('contacts') : false;
        if(!empty($contacts)){
            foreach ($contacts as $key => $phone) {
                if(!empty($phone['phone'])){
                    $add_phone =  $model->addPhones($add_object, '+7', $phone['phone']);
                }
            }         
        }


        //Выпадающие списки из enum
        $enum = new GeneralModel;
        $number_floors = $enum->getEnumTable('flatRent', 'FlatRoomsCount');
        $loggia = $enum->getEnumTable('flatRent', 'LoggiasCount');
        $balcony = $enum->getEnumTable('flatRent', 'BalconiesCount');
        $separate_toilets = $enum->getEnumTable('flatRent', 'SeparateWcsCount');
        $combined_bathroom = $enum->getEnumTable('flatRent', 'CombinedWcsCount');
        $repairs = $enum->getEnumTable('flatRent', 'RepairType');
        $information_building_type = $enum->getEnumTable('flatRent', 'MaterialType');
        $service_lift = $enum->getEnumTable('flatRent', 'CargoLiftsCount');
        $passenger_elevators = $enum->getEnumTable('flatRent', 'PassengerLiftsCount');
        $parking = $enum->getEnumTable('flatRent', 'Parking');
        $currency = $enum->getEnumTable('flatRent', 'Currency');
        $lease = $enum->getEnumTable('flatRent', 'LeaseTermType');
        $prepay = $enum->getEnumTable('flatRent', 'PrepayMonths');


        return $this->render('index', [
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
            'currency' =>  $currency,
            'lease' =>  $lease,
            'prepay' =>  $prepay,
            'add_object' =>  $add_object,
            ]);

    }

    public function MainConnect(){
        Yii::$app->controller->layout = 'full.php';
    }

    public function init(){
        $this->uploadPath = './files/'.date('Y-m').'/';
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
        $model = new flatRent();
        if(!empty(Yii::$app->request->post('file_name')) and !empty(Yii::$app->request->post('id'))){
            $main = !empty(Yii::$app->request->post('main')) ? 1 : 0;
            $model->addPhoto(Yii::$app->request->post('id'), $this->uploadPath.Yii::$app->request->post('file_name'), $main);
        }
    }
    //Удаление изображения
    public function actionDelphoto() {
        $model = new flatRent();
        if(!empty(Yii::$app->request->post('file_name')) and !empty(Yii::$app->request->post('id'))){
            $model->delPhoto(Yii::$app->request->post('id'), $this->uploadPath.Yii::$app->request->post('file_name'));
        }
    }
}
