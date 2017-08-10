<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model dungphanxuan\vnlocation\models\go\District */

$this->title                   = $model->name;
$this->params['breadcrumbs'][] = [ 'label' => 'Districts', 'url' => [ 'index' ] ];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="district-view">

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
			'city_id',
			'name',
			'slug',
			'full_name',
			'short_name',
			'code',
			'code_ghn',
			'code_vtp',
			'code_kerry',
			'code_spl',
			'kind_from',
			'kind_to',
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
