<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

/* @var $this yii\web\View */
/* @var $model dungphanxuan\vnlocation\models\go\GoRegion */
/* @var $form yii\bootstrap\ActiveForm */
?>

<div class="go-region-form">

	<?php $form = ActiveForm::begin( [
		'layout' => 'horizontal',
	] ); ?>

	<?php echo $form->errorSummary( $model, [
		'class'  => 'alert alert-warning alert-dismissible',
		'header' => '
    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
    <h4><i class="icon fa fa-warning"></i> Vui lòng sửa các lỗi sau!</h4>'
	] ); ?>

	<?php echo $form->field( $model, 'title' )->textInput( [ 'maxlength' => true ] ) ?>

	<?php echo $form->field( $model, 'slug' )->textInput( [ 'maxlength' => true ] ) ?>

	<?php echo $form->field( $model, 'image' )->widget(
		\trntv\filekit\widget\Upload::className(),
		[
			'url'             => [ '/file-storage/upload' ],
			'maxFileSize'     => 5000000, // 5 MiB
			'acceptFileTypes' => new \yii\web\JsExpression( '/(\.|\/)(gif|jpe?g|png)$/i' ),
		] );
	?>

    <?php echo $form->field( $model, 'status' )->checkbox() ?>

    <hr class="b2r" style="margin-right:50px;margin-left:50px;">

    <div class="form-group">
        <div class="col-sm-<?= $model->isNewRecord ? '3' : '1' ?> col-xs-2"></div>
        <div class="col-sm-3 col-xs-4">
			<?php
			echo Html::a( '<span class="glyphicon glyphicon-arrow-left"></span>' . Yii::t( 'backend', 'Back' ),
				[ 'index' ], [ 'class' => 'btn btn-default btn200' ] );
			?>
        </div>
        <div class="col-sm-3 col-xs-4">
			<?php echo Html::submitButton( $model->isNewRecord ? Yii::t( 'backend', 'Create' ) :
				Yii::t( 'backend', 'Update' ), [
				'class' => $model->isNewRecord ? 'btn btn-success btn200' : 'btn btn-primary
            btn200'
			] ) ?>
        </div>
        <div class="col-sm-3 col-xs-2">
			<?php
			if ( ! $model->isNewRecord ) {
				echo Html::a( Yii::t( 'backend', 'Delete' ), [ 'delete', 'id' => $model->id ],
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
