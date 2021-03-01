<?php

use yii\grid\GridView;
use yii\helpers\Html;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $searchModel dungphanxuan\vnlocation\models\WardSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Phường/Xã';
$this->params['breadcrumbs'][] = $this->title;
?>
    <div class="ward-index">

        <div class="pull-right">
            <p>
                <?php echo Html::a('<i class="fa fa-plus-circle" aria-hidden="true"></i> Create Ward', ['create'], ['class' => 'btn btn-success']) ?>
            </p>
        </div>
        <div class="clearfix"></div>
        <?php echo $this->render('_search', ['model' => $searchModel]); ?>

        <br>
        <br>
        <?php Pjax::begin(['id' => 'datas', 'timeout' => 3000, 'scrollTo' => 0]); ?>

        <?php echo GridView::widget([
            'dataProvider' => $dataProvider,
            //'filterModel'  => $searchModel,
            'pager' => [
                'maxButtonCount' => 20,    // Set maximum number of page buttons that can be displayed
            ],
            'columns' => [
                //[ 'class' => 'yii\grid\SerialColumn' ],

                [
                    'attribute' => 'id',
                    'format' => 'raw',
                    'headerOptions' => ['style' => 'text-align:center'],
                    'contentOptions' => ['style' => 'width:7%;text-align:center'],
                ],
                [
                    'attribute' => 'city_id',
                    'label' => 'Tỉnh/TP',
                    'contentOptions' => ['style' => 'width:10%'],
                    'value' => function ($model) {
                        return $model->district ? $model->district->city->name : null;
                    },
                    //'filter'         => \yii\helpers\ArrayHelper::map( \dungphanxuan\vnlocation\models\City::find()->all(), 'id', 'name' )
                ],
                [
                    'attribute' => 'district_id',
                    'value' => function ($model) {
                        return $model->district ? $model->district->name : null;
                    },
                    //'filter'         => \yii\helpers\ArrayHelper::map( \dungphanxuan\vnlocation\models\City::find()->all(), 'id', 'name' )
                ],
                'name',
                //'slug',
                //'fullname',
                // 'short_name',
                [
                    'attribute' => 'code_vtp',
                    'format' => 'raw',
                    'headerOptions' => ['style' => 'text-align:center'],
                    'contentOptions' => ['style' => 'width:10%;text-align:center'],
                ],
                // 'code_spl',
                // 'priority',
                // 'image_base_url:url',
                // 'image_path',
                // 'lat',
                // 'lng',
                // 'status',
                // 'created_at',
                // 'updated_at',

                [
                    'class' => 'dungphanxuan\vnlocation\grid\ActionColumn',
                    'contentOptions' => ['style' => 'width:12%;text-align:center'],
                ],
            ],
        ]); ?>
        <?php Pjax::end(); ?>
    </div>
<?php
$app_css = <<<CSS
.box-search{
  padding: 20px 50px;

  border: 2px solid #9E9E9E;
}
CSS;

$this->registerCss($app_css);

