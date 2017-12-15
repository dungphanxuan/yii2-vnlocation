<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model dungphanxuan\vnlocation\models\DemoLocation */

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Demo Locations', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="demo-location-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data'  => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method'  => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model'      => $model,
        'attributes' => [
            'id',
            'title',
            'body:ntext',
            'city_id',
            'district_id',
            'ward_id',
            'image_base_url:url',
            'image_path',
            'status',
            'created_at',
            'updated_at',
            'created_by',
            'updated_by',
        ],
    ]) ?>

</div>
