<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model dungphanxuan\vnlocation\models\go\City */

$this->title                   = $model->name;
$this->params['breadcrumbs'][] = [ 'label' => 'Cities', 'url' => [ 'index' ] ];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="city-view">

    <p>
		<?php echo Html::a( 'Update',
			[ 'update', 'id' => $model->id ], [ 'class' => 'btn btn-primary' ] ) ?>
		<?php echo Html::a( 'Delete',
			[ 'delete', 'id' => $model->id ], [
				'class' => 'btn btn-danger',
				'data'  => [
					'confirm' => 'Are you sure you want to delete this item?',
					'method'  => 'post',
				],
			] ) ?>
    </p>

	<?php echo DetailView::widget( [
		'model'      => $model,
		'attributes' => [
			'id',
			'region_id',
			'name',
			'slug',
			'short_name',
			'code',
			'code_ghn',
			'code_vtp',
			'code_njv',
			'code_kerry',
			'allow',
			'priority',
			'image_base_url:url',
			'image_path',
			'lat',
			'lng',
			'status',
			'created_at',
			'updated_at',
		],
	] ) ?>

</div>
