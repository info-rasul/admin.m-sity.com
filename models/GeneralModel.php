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
class GeneralModel extends Model
{
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

} 
