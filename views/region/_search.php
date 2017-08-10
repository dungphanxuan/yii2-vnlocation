<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

/* @var $this yii\web\View */
/* @var $model dungphanxuan\vnlocation\models\go\GoRegionSearch */
/* @var $form yii\bootstrap\ActiveForm */
?>

<div class="go-region-search">

	<?php $form = ActiveForm::begin( [
		'action' => [ 'index' ],
		'method' => 'get',
	] ); ?>

	<?php echo $form->field( $model, 'id' ) ?>

	<?php echo $form->field( $model, 'title' ) ?>

	<?php echo $form->field( $model, 'slug' ) ?>

	<?php echo $form->field( $model, 'image_base_url' ) ?>

	<?php echo $form->field( $model, 'image_path' ) ?>

	<?php // echo $form->field($model, 'status') ?>

	<?php // echo $form->field($model, 'created_at') ?>

    <div class="form-group">
		<?php echo Html::submitButton( 'Search', [
			'class' =>
				'btn btn-primary'
		] ) ?>
		<?php echo Html::resetButton( 'Reset', [
			'class' =>
				'btn btn-default'
		] ) ?>
    </div>

	<?php ActiveForm::end(); ?>

</div>
