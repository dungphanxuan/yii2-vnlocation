<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel dungphanxuan\vnlocation\models\CitySearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title                   = 'Tỉnh/Thành phố';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="city-index">

	<?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <div class="pull-right">
        <p>
			<?php echo Html::a( '<i class="fa fa-plus-circle" aria-hidden="true"></i> Create City', [ 'create' ], [ 'class' => 'btn btn-success' ] ) ?>
        </p>
    </div>

	<?php echo GridView::widget( [
		'dataProvider' => $dataProvider,
		'filterModel'  => $searchModel,
		'columns'      => [

			[
				'attribute'      => 'id',
				'format'         => 'raw',
				'headerOptions'  => [ 'style' => 'text-align:center' ],
				'contentOptions' => [ 'style' => 'width:7%;text-align:center' ],
			],
			[
				'attribute' => 'region_id',
				'value'     => function ( $model ) {
					return $model->region ? $model->region->title : null;
				},
				'filter'    => \yii\helpers\ArrayHelper::map( \dungphanxuan\vnlocation\models\GoRegion::find()->all(), 'id', 'title' )
			],
			[
				'attribute' => 'name',
				'format'    => 'raw',
				'label'     => 'Tên Tỉnh/TP',
			],
			//'slug',
			'short_name',
			[
				'attribute'      => 'code',
				'format'         => 'raw',
				'headerOptions'  => [ 'style' => 'text-align:center' ],
				'contentOptions' => [ 'style' => 'width:7%;text-align:center' ],
			],
			// 'code_ghn',
			// 'code_vtp',
			// 'code_njv',
			// 'code_kerry',
			// 'allow',
			'priority',
			[
				'attribute'      => 'total_district',
				'format'         => 'raw',
				'headerOptions'  => [ 'style' => 'text-align:center' ],
				'contentOptions' => [ 'style' => 'width:10%;text-align:center' ],
				'value'          => function ( $model ) {
					return Html::a( $model->total, [
						'/go/district/index',
						'city_id' => $model->id
					], [ 'class' => 'alink' ] );

				},
			],
			// 'image_base_url:url',
			// 'image_path',
			// 'lat',
			// 'lng',
			// 'status',
			'created_at:date',
			// 'updated_at',

			[ 'class' => 'yii\grid\ActionColumn' ],
		],
	] ); ?>

</div>
