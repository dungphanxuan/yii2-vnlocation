<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel dungphanxuan\vnlocation\models\DemoLocationSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Demo Locations';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="demo-location-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create New', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel'  => $searchModel,
        'columns'      => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'title',
            [
                'attribute' => 'city_id',
                'value'     => function ($model) {
                    return $model->city ? $model->city->name : null;
                },
                'filter'    => \yii\helpers\ArrayHelper::map(\dungphanxuan\vnlocation\models\City::find()->all(), 'id', 'name')
            ],
            [
                'attribute' => 'district_id',
                'value'     => function ($model) {
                    return $model->district ? $model->district->name : null;
                },
                //'filter'         => \yii\helpers\ArrayHelper::map( \dungphanxuan\vnlocation\models\City::find()->all(), 'id', 'name' )
            ],

            [
                'attribute' => 'ward_id',
                'value'     => function ($model) {
                    return $model->ward ? $model->ward->name : null;
                },
                //'filter'         => \yii\helpers\ArrayHelper::map( \dungphanxuan\vnlocation\models\City::find()->all(), 'id', 'name' )
            ],
            //'ward_id',
            //'image_base_url:url',
            //'image_path',
            //'status',
            'created_at:datetime',
            //'updated_at',
            //'created_by',
            //'updated_by',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
