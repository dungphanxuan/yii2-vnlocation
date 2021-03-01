<?php

namespace dungphanxuan\vnlocation\helpers;

/**
 * Created by PhpStorm.
 * User: developer
 * Date: 8/15/2017
 * Time: 11:30 AM
 */

use dungphanxuan\vnlocation\models\City;
use yii\helpers\Inflector;


class CityHelper extends Inflector
{

    /*
     * Get Detail
     * */
    public static function getDetail($id)
    {
        /** @var City $modelItem */
        $modelItem = City::find()->where(['id' => $id])->asArray()->one();

        return $modelItem;
    }
}