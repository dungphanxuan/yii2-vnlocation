<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\bootstrap\ActiveForm;
use kartik\depdrop\DepDrop;

/* @var $this yii\web\View */
/* @var $model dungphanxuan\vnlocation\models\Ward */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $regions */
/* @var $dataCity */
/* @var $districts */
/* @var $dataDistrict */
?>

    <div class="ward-form">

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
		), [ 'prompt' => 'Chọn miền...', 'id' => 'cregion-id' ] )->hint( 'Chọn vùng miền' ) ?>

		<?php
		echo $form->field( $model, 'city_id' )->widget( DepDrop::classname(), [
			'options'        => [ 'id' => 'ccity-id' ],
			'type'           => DepDrop::TYPE_SELECT2,
			'data'           => $dataCity,
			'select2Options' => [ 'pluginOptions' => [ 'allowClear' => true ] ],
			'pluginOptions'  => [
				'depends'     => [ 'cregion-id' ],
				'placeholder' => 'Chọn Tỉnh/Thành Phố...',
				'url'         => Url::to( [ '/go/city/subcat' ] )
			]
		] );
		?>

		<?php
		echo $form->field( $model, 'district_id' )->widget( DepDrop::classname(), [
			'options'        => [ 'id' => 'district-id' ],
			'type'           => DepDrop::TYPE_SELECT2,
			'data'           => $dataDistrict,
			'select2Options' => [ 'pluginOptions' => [ 'allowClear' => true ] ],
			'pluginOptions'  => [
				'depends'     => [ 'ccity-id' ],
				'placeholder' => 'Chọn Quận/Huyện...',
				'url'         => Url::to( [ '/go/district/subcat' ] )
			]
		] );
		?>


		<?php echo $form->field( $model, 'name' )->textInput( [ 'maxlength' => true ] ) ?>

		<?php echo $form->field( $model, 'slug' )->textInput( [ 'maxlength' => true ] ) ?>

		<?php echo $form->field( $model, 'fullname' )->textInput( [ 'maxlength' => true ] ) ?>

		<?php echo $form->field( $model, 'short_name' )->textInput( [ 'maxlength' => true ] ) ?>

		<?php echo $form->field( $model, 'code_vtp' )->textInput( [ 'maxlength' => true ] ) ?>

		<?php echo $form->field( $model, 'code_spl' )->textInput( [ 'maxlength' => true ] ) ?>

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