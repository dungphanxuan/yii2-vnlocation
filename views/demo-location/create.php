<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model dungphanxuan\vnlocation\models\DemoLocation */

$this->title = 'Create';
$this->params['breadcrumbs'][] = ['label' => 'Demo Locations', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="demo-location-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'cities' => $cities,
        'dataDistrict' => $dataDistrict,
        'dataWard' => $dataWard,
    ]) ?>

</div>
