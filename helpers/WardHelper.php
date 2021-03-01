<?php

namespace dungphanxuan\vnlocation\helpers;

/**
 * Created by PhpStorm.
 * User: developer
 * Date: 8/15/2017
 * Time: 11:30 AM
 */

use dungphanxuan\vnlocation\models\Ward;
use yii\helpers\Inflector;


class WardHelper extends Inflector
{

    /*
     * Get Detail
     * */
    public static function getDetail($id)
    {
        /** @var Ward $modelItem */
        $modelItem = Ward::find()->where(['id' => $id])->asArray()->one();

        return $modelItem;
    }
}