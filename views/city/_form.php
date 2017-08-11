<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

/* @var $this yii\web\View */
/* @var $model dungphanxuan\vnlocation\models\City */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $regions */
?>

    <div class="city-form">

		<?php $form = ActiveForm::begin( [
			'layout' => 'horizontal',
		] ); ?>

		<?php echo $form->errorSummary( $model, [
			'class'  => 'alert alert-warning alert-dismissible',
			'header' => '
    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
    <h4><i class="icon fa fa-warning"></i> Vui lòng sửa các lỗi sau!</h4>'
		] ); ?>

		<?php echo $form->field( $model, 'region_id' )->dropDownList( \yii\helpers\ArrayHelper::map(
			$regions,
			'id',
			'title'
		), [ 'prompt' => 'Chọn miền...' ] )->hint( 'Chọn vùng miền' ) ?>

		<?php echo $form->field( $model, 'name' )->textInput( [ 'maxlength' => true ] ) ?>

		<?php echo $form->field( $model, 'slug' )->textInput( [ 'maxlength' => true ] ) ?>

		<?php echo $form->field( $model, 'short_name' )->textInput( [ 'maxlength' => true ] ) ?>

		<?php echo $form->field( $model, 'code' )->textInput( [ 'maxlength' => true ] ) ?>

		<?php echo $form->field( $model, 'code_ghn' )->textInput( [ 'maxlength' => true ] ) ?>

		<?php echo $form->field( $model, 'code_vtp' )->textInput( [ 'maxlength' => true ] ) ?>

		<?php echo $form->field( $model, 'code_njv' )->textInput( [ 'maxlength' => true ] ) ?>

		<?php echo $form->field( $model, 'code_kerry' )->textInput( [ 'maxlength' => true ] ) ?>

		<?php echo $form->field( $model, 'allow' )->checkbox() ?>

		<?php echo $form->field( $model, 'priority' )->textInput() ?>

        <hr class="b2r" style="margin-right:50px;margin-left:50px;">

		<?php echo $form->field( $model, 'lat' )->textInput() ?>

		<?php echo $form->field( $model, 'lng' )->textInput() ?>

		<?php echo $form->field( $model, 'status' )->checkbox() ?>

        <hr class="b2r" style="margin-right:50px;margin-left:50px;">

        <div class="form-group">
            <div class="col-sm-<?= $model->isNewRecord ? '3' : '1' ?> col-xs-2"></div>
            <div class="col-sm-3 col-xs-4">
				<?php
				echo Html::a( '<span class="glyphicon glyphicon-arrow-left"></span>' . 'Back',
					[ 'index' ], [ 'class' => 'btn btn-default btn200' ] );
				?>
            </div>
            <div class="col-sm-3 col-xs-4">
				<?php echo Html::submitButton( $model->isNewRecord ? 'Create' :
					'Update', [
					'class' => $model->isNewRecord ? 'btn btn-success btn200' : 'btn btn-primary
            btn200'
				] ) ?>
            </div>
            <div class="col-sm-3 col-xs-2">
				<?php
				if ( ! $model->isNewRecord ) {
					echo Html::a( 'Delete', [ 'delete', 'id' => $model->id ],
						[
							'class' => 'btn btn-warning btn200 bold',
							'data'  => [
								'confirm' => 'Are you sure you want to delete?',
								'method'  => 'post',
							]
						] );
				}
				?>
            </div>
        </div>

		<?php ActiveForm::end(); ?>

    </div>
<?php
$app_css = <<<CSS
.b2r{
  height: 2px;
  color: red;
  border-top: 2px solid #80CBC4;
}
.btn200{
  width: 200px;
}
CSS;
$this->registerCss( $app_css );

