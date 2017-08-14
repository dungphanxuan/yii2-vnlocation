<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model dungphanxuan\vnlocation\models\GoRegion */

$this->title                   = $model->title;
$this->params['breadcrumbs'][] = [ 'label' => 'Regions', 'url' => [ 'index' ] ];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="go-region-view">

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
			'title',
			'slug',
			'image_base_url:url',
			'image_path',
			'status',
			'created_at',
		],
	] ) ?>

</div>
