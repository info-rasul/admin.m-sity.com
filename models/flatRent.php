<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\base\Command;
use yii\helpers\Html;
/**
 * AddAds is the model behind the login form.
 *
 * @property User|null $user This property is read-only.
 *
 */
class flatRent extends Model
{
    public static function tableName()
    {
        return 'flatRent';
    }

    public function addObject($address, $cadastr_number, $opisanie)
    {       
        $user_id = Yii::$app->user->identity->id;
        Yii::$app->db->createCommand()->insert('object', [
            'Address' => $address['address'],
            'user_id' => $user_id,
            'Lat' => $address['lat'],
            'Lng' => $address['lng'],
            'CadastralNumber' => $cadastr_number,
            'Description' => $opisanie
        ])->execute();
        $id_object = Yii::$app->db->getLastInsertID();
        return $id_object;
    }

    public function addAbout($add_object, $about, $furnished, $information_building, $price_conditions)
    {  
        $WindowsViewType = '';
        if(!empty($about["courtyard"]) and !empty($about["street"])){
            $WindowsViewType = 'yardAndStreet';
        }elseif(!empty($about["courtyard"])){
            $WindowsViewType = 'yard';
        }elseif(!empty($about["street"])){
            $WindowsViewType = 'street';
        }

        Yii::$app->db->createCommand()->insert('flatRent', [ 
            'id_object' => $add_object,
            'TotalArea' => $about["total_area"],
            'FlatRoomsCount' => $about["number_rooms"],
            'IsApartments' => $about["rooms_apartments"] ? 1 : 0,
            'IsPenthouse' => $about["rooms_penthouse"] ? 1 : 0,
            'FloorNumber' => $about["number_floors"],
            'AllRoomsArea' => $about["rooms_area"],
            'LivingArea' => $about["living_space"],
            'KitchenArea' => $about["kitchen"],
            'LoggiasCount' => $about["loggia"],
            'BalconiesCount' => $about["balcony"],
            'WindowsViewType' => $WindowsViewType,
            'SeparateWcsCount' => $about["separate_toilets"],
            'CombinedWcsCount' => $about["combined_bathroom"],
            'RepairType' => $about["repairs"],
            'FloorsCount' => $about["floor"],
            'HasFurniture' => $furnished["mebel_v_komnatah"] ? 1 : 0,
            'HasKitchenFurniture' => $furnished["mebel_na_kuhne"] ? 1 : 0,
            'HasFridge' => $furnished["holodilnik"] ? 1 : 0,
            'HasDishwasher' => $furnished["posudomoechnaya_mashina"] ? 1 : 0,
            'HasWasher' => $furnished["stiralnaya_mashina"] ? 1 : 0,
            'ChildrenAllowed' => $furnished["mozhno_s_detmi"] ? 1 : 0,
            'PetsAllowed' => $furnished["mozhno_s_zhivotnymi"] ? 1 : 0,
            'HasInternet' => $furnished["internet"] ? 1 : 0,
            'HasPhone' => $furnished["telefon"] ? 1 : 0,
            'HasTv' => $furnished["televizor"] ? 1 : 0,
            'HasConditioner' => $furnished["kondicioner"] ? 1 : 0,
            'HasBathtub' => $furnished["vanna"] ? 1 : 0,
            'HasShower' => $furnished["dushevaya_kabina"] ? 1 : 0,
            'Name' => $information_building["name"] ? $information_building["name"] : '',
            'MaterialType' => $information_building["type"],
            'BuildYear' => $information_building["year_construction"] ? $information_building["year_construction"] : '',
            'Series' => $information_building["serial"] ? $information_building["serial"] : '',
            'CeilingHeight' => $information_building["ceiling_height"],
            'PassengerLiftsCount' => $information_building["passenger_elevators"],
            'CargoLiftsCount' => $information_building["service_lift"],
            'HasGarbageChute' => $information_building["garbage_chute"],
            'Parking' => $information_building["parking"],
            'Price' => $price_conditions["price_per_month"],
            'Currency' => $price_conditions["currency"],
            'IncludedInPrice' => $price_conditions["includedinprice"],
            'BargainAllowed' => $price_conditions["possible_bargain"] ? 1 : 0,
            'BargainPrice' => $price_conditions["bargainprice"],
            'BargainConditions' => $price_conditions["trading"],
            'LeaseTermType' => $price_conditions["leasetermtype"],
            'PrepayMonths' => $price_conditions["prepay"],
            'Deposit' => $price_conditions["deposit"],
            'ClientFee' => !empty($price_conditions["no_direct_client"]) ? 0 : $price_conditions["direct_client"],
            'AgentFee' => !empty($price_conditions["no_another_agent"]) ? 0 :  $price_conditions["another_agent"],
        ])->execute();
    }

   public function addPhones($add_object, $code, $phone)
    {
        Yii::$app->db->createCommand()->insert('Phones', [
            'id_object' => $add_object,
            'CountryCode' => $code,
            'Number' => $phone,
        ])->execute();        
    }

    public function addMetro($add_object, $id, $transporttype, $time)
    {       
        Yii::$app->db->createCommand()->insert('Underground', [
            'id_object' => $add_object,
            'id' => $id,
            'transporttype' => $transporttype,
            'time' => $time,
        ])->execute();
        $id_object = Yii::$app->db->getLastInsertID();
        return $id_object;
    }

    public function addPhoto($id_object, $filename, $main){
        Yii::$app->db->createCommand('INSERT INTO `Photos` (`id_object`,`FullUrl`,`IsDefault`) VALUES (:id_object,:FullUrl,:IsDefault)', [ ':id_object' =>$id_object, ':FullUrl' => $filename, ':IsDefault' => $main])->execute();
    }

    public function delPhoto($id_object, $filename){
        Yii::$app->db->createCommand()->delete('Photos', ['id_object' => $id_object, 'FullUrl'=>$filename])->execute();
    }

} 
