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
class AddAds extends Model
{
    public static function tableName()
    {
        return 'object';
    }
    public function getEnumTable($table, $column)
    {
        //все возможные варианты из базы
        $sql = "SHOW COLUMNS FROM $table LIKE '$column'";
        $enum = Yii::$app->db->createCommand($sql)->queryOne();
        //Перевод строки enum в массив
        $type_object = $this->get_enum_value($enum);
        return $type_object;
    }

    public function get_enum_value($result)
    {   
        preg_match('/^enum\((.*)\)$/', $result['Type'], $matches);
        foreach( explode(',', $matches[1]) as $value2 ){
            $enum[] = trim( $value2, "'" );
        }
        $enum = array_diff($enum, array('', NULL, false));
        //В первый и последний элемент массива пишем left и right
        //для округления краев в view 
        if(count($enum)>1 and count($enum)<=3){
            $left['left'] = array_shift($enum);
            $enum = array_merge($left, $enum);
            $enum['right'] = array_pop($enum);
            return $enum;
        } 
        return $enum;
    }

    public function addObject($get_param)
    {
        //тип сделки
        $user_id = Yii::$app->user->identity->id;
        //Если у пользователя уже есть черновик, удаляем его
        /*$user_draft = Yii::$app->db->createCommand('SELECT id FROM object WHERE user_id='.$user_id.' AND status="draft"')->queryOne();
        if(!empty($user_draft)){
        }*/
        Yii::$app->db->createCommand()->delete('object', ['user_id' => $user_id, 'status'=>'draft'])->execute();
        //var_dump($user_draft); die();
        $id_object = Yii::$app->db->createCommand('INSERT INTO `object` (`type_transaction`,`user_id`,`status`) VALUES (:type_transaction, :user_id, :status)', [':type_transaction' => $get_param['type_transaction'], ':user_id'=>$user_id, ':status'=>'draft'])->execute();
        $id_object = Yii::$app->db->getLastInsertID();
        switch ($get_param['type_transaction']) {
            //продажа
            case 'sale':
                switch ($get_param['type_property']) {
                    //жилая
                    case 'residential':
                        Yii::$app->db->createCommand('INSERT INTO `sale` (`id_object`,`type_property`,`residential`,`commercial`) VALUES (:id_object,:type_property,:residential,:commercial)', [ ':id_object' =>$id_object, ':type_property' => $get_param['type_property'], ':residential' => $get_param['object_type'], ':commercial' => ''])->execute();
                        break;
                    //коммерческая
                    case 'commercial':
                        Yii::$app->db->createCommand('INSERT INTO `sale` (`id_object`,`type_property`,`residential`,`commercial`) VALUES (:id_object,:type_property,:residential,:commercial)', [ ':id_object' =>$id_object, ':type_property' => $get_param['type_property'], ':residential' => '', ':commercial' => $get_param['object_type']])->execute();
                        break;
                }
                break;
            //аренда
            case 'rent':
                switch ($get_param['type_rent']) {
                    //длительно
                    case 'protractedly':
                        switch ($get_param['type_property']) {
                            //жилая
                            case 'residential':
                                Yii::$app->db->createCommand('INSERT INTO `rent` (`id_object`,`rent`,`protractedly`,`daily`,`residential_daily`,`residential_protractedly`,`commercial_protractedly`) VALUES (:id_object,:rent,:protractedly,:daily,:residential_daily,:residential_protractedly,:commercial_protractedly)', [':id_object' => $id_object, ':rent' => 'protractedly', ':protractedly' => 'residential', ':daily' => '', ':residential_daily' => '', ':residential_protractedly' => $get_param['object_type'], ':commercial_protractedly' => ''])->execute();
                            break;
                            //коммерческая
                            case 'commercial':
                                Yii::$app->db->createCommand('INSERT INTO `rent` (`id_object`,`rent`,`protractedly`,`daily`,`residential_daily`,`residential_protractedly`,`commercial_protractedly`) VALUES (:id_object,:rent,:protractedly,:daily,:residential_daily,:residential_protractedly,:commercial_protractedly)', [':id_object' => $id_object, ':rent' => 'protractedly', ':protractedly' => 'commercial', ':daily' => '', ':residential_daily' => '', ':residential_protractedly' => '', ':commercial_protractedly' => $get_param['object_type']])->execute();
                            break;
                        }
                    break;
                    //посуточно
                    case 'daily':
                        Yii::$app->db->createCommand('INSERT INTO `rent` (`id_object`,`rent`,`protractedly`,`daily`,`residential_daily`,`residential_protractedly`,`commercial_protractedly`) VALUES (:id_object,:rent,:protractedly,:daily,:residential_daily,:residential_protractedly,:commercial_protractedly)', [':id_object' => $id_object, ':rent' => 'daily', ':protractedly' => '', ':daily' => 'residential', ':residential_daily' => $get_param['object_type'], ':residential_protractedly' => '', ':commercial_protractedly' => ''])->execute();
                    break;
                }
            break;
        }
        return $id_object;

    }

    public function getTypeObjectHtml($type_object, $area_name, $get='')
    {
        if(count($type_object)>3){
            $type_object_html = '<div class="row type-ads"><div class="col-md-2"><div class="field_name">';
            $type_object_html .= Yii::t('app', $area_name);
            $type_object_html .= '</div></div><div class="col-md-10"><div class="col-md-4"><div class="field_content">';
            //Делим длинный список на два столбца
            for ($i=0; $i < ceil(count($type_object)/2); $i++) { 
                $type_object_html .= '<div class="cui-switcher"><label class="switch switch-xs switch-3d switch-primary"><input type="radio" class="switch-input" onclick="this.form.submit();" name="object-type" id="object-type-'.$type_object[$i].'" value="'.$type_object[$i].'"><span class="switch-label"></span><span class="switch-handle"></span></label><label for="object-type-'.$type_object[$i].'" class="radio-object">'.Yii::t('app', $type_object[$i]).'</label></div>';
            } 
            $type_object_html .= '</div></div>';

            $type_object_html .= '<div class="col-md-4"><div class="field_content">';
            for ($i=ceil(count($type_object)/2); $i < count($type_object); $i++) { 
                $type_object_html .= '<div class="cui-switcher"><label class="switch switch-xs switch-3d switch-primary"><input type="radio" class="switch-input" onclick="this.form.submit();" name="object-type" id="object-type-'.$type_object[$i].'" value="'.$type_object[$i].'"><span class="switch-label"></span><span class="switch-handle"></span></label><label for="object-type-'.$type_object[$i].'" class="radio-object">'.Yii::t('app', $type_object[$i]).'</label></div>';
            }
            $type_object_html .= '</div></div></div></div>';

        } elseif(count($type_object)>0){
            $type_object_html = '<div class="row type-ads"><div class="col-md-2"><div class="field_name">';
            $type_object_html .= Yii::t('app', $area_name);
            $type_object_html .= '</div></div><div class="col-md-10"><div class="field_content"><div class="cui-switcher">';
            foreach ($type_object as $key => $type){
                if($get_object == $key)  $active = 'active';
                $type_object_html .= Html::a(
                    Yii::t('app', $type),
                    ['/site/addads?'.$get.'&'.$area_name.'='.$type],
                    ['class' => ' btn btn-sm btn-outline-primary '.$key.'-radius-button '.$active],
                    ['id' => $type]
                );
                $active = '';
            }
            $type_object_html .= '</div></div></div></div>';            
        }else{
           $type_object_html = ''; 
        }
        return $type_object_html;
    }

    public function getMetro($q){
        Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        $out = ['results' => ['id' => '', 'text' => '']];
        $data = Yii::$app->db->createCommand("SELECT url as id, name as text FROM `metro_list` WHERE name like '%".$q."%' limit 10")->queryAll();
        $out['results'] = array_values($data);
        return $out;
    }

    public function addPhoto($id_object, $filename, $main){
        Yii::$app->db->createCommand('INSERT INTO `photo` (`id_object`,`photo`,`main`) VALUES (:id_object,:photo,:main)', [ ':id_object' =>$id_object, ':photo' => $filename, ':main' => $main])->execute();
    }

    public function delPhoto($id_object, $filename){
        Yii::$app->db->createCommand()->delete('photo', ['id_object' => $id_object, 'photo'=>$filename])->execute();
    }

    public function addAddress($id_object, $address){
        Yii::$app->db->createCommand('INSERT INTO `address` (`id_object`, `country`, `city`, `street`, `house`) VALUES (:id_object, :country, :city, :street, :house)', [ ':id_object' => $id_object, ':country' => $address['country'], ':city' => $address['city'], ':street' => $address['street'], ':house' => $address['house']])->execute();
    }

} 