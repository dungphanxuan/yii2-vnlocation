<?php
/**
 * Created by PhpStorm.
 * User: dungpx
 * Date: 12/13/2017
 * Time: 10:54 AM
 */

namespace dungphanxuan\vnlocation\controllers;

use dungphanxuan\vnlocation\models\District;
use dungphanxuan\vnlocation\models\Ward;
use yii\helpers\Json;
use yii\web\Controller;

class AjaxController extends Controller
{
    public $enableCsrfValidation = false;

    // THE DistrictSubcat Action
    public function actionDistrictSubcat()
    {
        $out = [];
        if (isset($_POST['depdrop_parents'])) {
            $parents = $_POST['depdrop_parents'];
            if ($parents != null) {
                $cat_id = $parents[0];

                $out = District::find()
                    ->where(['city_id' => $cat_id])
                    ->asArray()
                    ->all();
                $data = [];
                foreach ($out as $item) {
                    $dataDistrict = [];
                    $dataDistrict['id'] = $item['id'];
                    $dataDistrict['name'] = $item['name'];
                    $data[] = $dataDistrict;
                }
                echo Json::encode(['output' => $data, 'selected' => '']);

                return;
            }
        }
        echo Json::encode(['output' => '', 'selected' => '']);
    }

    // THE WardSubcat Action
    public function actionWardSubcat()
    {
        $out = [];
        if (isset($_POST['depdrop_parents'])) {
            $parents = $_POST['depdrop_parents'];
            if ($parents != null) {
                $cat_id = $parents[0];

                $out = Ward::find()
                    ->where(['district_id' => $cat_id])
                    ->asArray()
                    ->all();
                $data = [];
                foreach ($out as $item) {
                    $dataDistrict = [];
                    $dataDistrict['id'] = $item['id'];
                    $dataDistrict['name'] = $item['name'];
                    $data[] = $dataDistrict;
                }
                echo Json::encode(['output' => $data, 'selected' => '']);

                return;
            }
        }
        echo Json::encode(['output' => '', 'selected' => '']);
    }

}