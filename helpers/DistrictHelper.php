<?php

namespace dungphanxuan\vnlocation\helpers;

/**
 * Created by PhpStorm.
 * User: developer
 * Date: 8/15/2017
 * Time: 11:30 AM
 */

use dungphanxuan\vnlocation\models\District;
use yii\helpers\Inflector;


class DistrictHelper extends Inflector
{

    /*
     * Get Detail
     * */
    public static function getDetail($id)
    {
        /** @var District $modelItem */
        $modelItem = District::find()->where(['id' => $id])->asArray()->one();

        return $modelItem;
    }
}