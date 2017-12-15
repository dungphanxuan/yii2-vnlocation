<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model dungphanxuan\vnlocation\models\DemoLocation */

$this->title = 'Update : {nameAttribute}';
$this->params['breadcrumbs'][] = ['label' => 'Demo Locations', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->title, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="demo-location-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model'        => $model,
        'cities'       => $cities,
        'dataDistrict' => $dataDistrict,
        'dataWard'     => $dataWard,
    ]) ?>

</div>
