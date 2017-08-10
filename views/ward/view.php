<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model dungphanxuan\vnlocation\models\Ward */

$this->title                   = $model->name;
$this->params['breadcrumbs'][] = [ 'label' => 'Wards', 'url' => [ 'index' ] ];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ward-view">

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
			'district_id',
			'name',
			'slug',
			'fullname',
			'short_name',
			'code_vtp',
			'code_spl',
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
