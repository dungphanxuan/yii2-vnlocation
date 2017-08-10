<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\bootstrap\ActiveForm;
use yii\web\JsExpression;
use dungphanxuan\vnlocation\models\go\District;
use kartik\select2\Select2;

/* @var $this yii\web\View */
/* @var $model dungphanxuan\vnlocation\models\go\WardSearch */
/* @var $form yii\bootstrap\ActiveForm */

// The controller action that will render the list
$url = Url::to(['/go/district/district-list']);
// Get the initial city description
$cityDesc = empty($model->district_id) ? '' : District::findOne($model->district)->name;

?>

<div class="ward-search  box-search">

	<?php $form = ActiveForm::begin( [
		'action' => [ 'index' ],
		'method' => 'get',
		'layout' => 'horizontal'
	] ); ?>

    <div class="row">
        <div class="col-sm-6">
			<?php
			echo $form->field( $model, 'id' )->textInput()
			?>
        </div>

        <div class="col-sm-6">
			<?php
			echo $form->field( $model, 'name' )->textInput()
			?>
        </div>
    </div>

    <div class="row">
        <div class="col-md-6">
            <?php
            echo $form->field($model, 'district_id')->widget(Select2::classname(), [
	            'initValueText' => $cityDesc, // set the initial display text
	            'options' => ['placeholder' => 'Tìm kiếm Tỉnh/Thành Phố ...'],
	            'pluginOptions' => [
		            'allowClear' => true,
		           //'minimumInputLength' => 3,
		            'language' => [
			            'errorLoading' => new JsExpression("function () { return 'Waiting for results...'; }"),
		            ],
		            'ajax' => [
			            'url' => $url,
			            'dataType' => 'json',
			            'data' => new JsExpression('function(params) { return {q:params.term}; }')
		            ],
		            'escapeMarkup' => new JsExpression('function (markup) { return markup; }'),
		            'templateResult' => new JsExpression('function(city) { return city.text; }'),
		            'templateSelection' => new JsExpression('function (city) { return city.text; }'),
	            ],
            ]);
            ?>
        </div>
        <div class="col-md-6">
	        <?php echo $form->field($model, 'code_vtp') ?>
        </div>
    </div>


	<?php // echo $form->field($model, 'short_name') ?>

	<?php // echo $form->field($model, 'code_vtp') ?>

	<?php // echo $form->field($model, 'code_spl') ?>

	<?php // echo $form->field($model, 'priority') ?>

	<?php // echo $form->field($model, 'lat') ?>

	<?php // echo $form->field($model, 'lng') ?>

	<?php // echo $form->field($model, 'status') ?>



    <div class="row">
        <div class="col-md-6 col-sm-6 col-xs-12">
        </div>
        <div class="col-md-6 col-sm-6 col-xs-6">
            <div class="col-md-9"></div>
            <div class="col-md-3">
				<?php echo Html::submitButton( Yii::t( 'backend', 'Search' ), [ 'class' => 'btn btn-primary btn-block' ] ) ?>
            </div>
        </div>

    </div>

	<?php ActiveForm::end(); ?>

</div>
