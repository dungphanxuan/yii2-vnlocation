<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

/* @var $this yii\web\View */
/* @var $model dungphanxuan\vnlocation\models\go\CitySearch */
/* @var $form yii\bootstrap\ActiveForm */
?>

<div class="city-search">

	<?php $form = ActiveForm::begin( [
		'action' => [ 'index' ],
		'method' => 'get',
	] ); ?>

	<?php echo $form->field( $model, 'id' ) ?>

	<?php echo $form->field( $model, 'region_id' ) ?>

	<?php echo $form->field( $model, 'name' ) ?>

	<?php echo $form->field( $model, 'slug' ) ?>

	<?php echo $form->field( $model, 'short_name' ) ?>

	<?php // echo $form->field($model, 'code') ?>

	<?php // echo $form->field($model, 'code_ghn') ?>

	<?php // echo $form->field($model, 'code_vtp') ?>

	<?php // echo $form->field($model, 'code_njv') ?>

	<?php // echo $form->field($model, 'code_kerry') ?>

	<?php // echo $form->field($model, 'allow') ?>

	<?php // echo $form->field($model, 'priority') ?>

	<?php // echo $form->field($model, 'image_base_url') ?>

	<?php // echo $form->field($model, 'image_path') ?>

	<?php // echo $form->field($model, 'lat') ?>

	<?php // echo $form->field($model, 'lng') ?>

	<?php // echo $form->field($model, 'status') ?>

	<?php // echo $form->field($model, 'created_at') ?>

	<?php // echo $form->field($model, 'updated_at') ?>

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
