<?php

use yii\helpers\Html;
use backend\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel dungphanxuan\vnlocation\models\go\GoRegionSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title                   = 'Miền';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="go-region-index">

	<?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <div class="pull-right">
        <p>
		    <?php echo Html::a( '<i class="fa fa-plus-circle" aria-hidden="true"></i> Create  Region', [ 'create' ], [ 'class' => 'btn btn-success' ] ) ?>
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
			'title',
			'slug',
			// 'status',
			[
				'attribute'      => 'total_city',
				'format'         => 'raw',
				'headerOptions'  => [ 'style' => 'text-align:center' ],
				'contentOptions' => [ 'style' => 'width:10%;text-align:center' ],
				'value'          => function ( $model ) {
					return Html::a( $model->total, [
						'/go/city/index',
						'region_id' => $model->id
					], [ 'class' => 'alink' ] );

				},
			],
			 'created_at:date',

			[ 'class' => 'backend\grid\ActionColumn' ],
		],
	] ); ?>

</div>
