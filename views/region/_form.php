<?php

use yii\bootstrap\ActiveForm;
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model dungphanxuan\vnlocation\models\GoRegion */
/* @var $form yii\bootstrap\ActiveForm */
?>

    <div class="go-region-form">

        <?php $form = ActiveForm::begin([
            'layout' => 'horizontal',
        ]); ?>

        <?php echo $form->errorSummary($model, [
            'class' => 'alert alert-warning alert-dismissible',
            'header' => '
    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
    <h4><i class="icon fa fa-warning"></i> Vui lòng sửa các lỗi sau!</h4>'
        ]); ?>

        <?php echo $form->field($model, 'title')->textInput(['maxlength' => true]) ?>

        <?php echo $form->field($model, 'slug')->textInput(['maxlength' => true]) ?>

        <?php echo $form->field($model, 'status')->checkbox() ?>

        <hr class="b2r" style="margin-right:50px;margin-left:50px;">

        <div class="form-group">
            <div class="col-sm-<?= $model->isNewRecord ? '3' : '1' ?> col-xs-2"></div>
            <div class="col-sm-3 col-xs-4">
                <?php
                echo Html::a('<span class="glyphicon glyphicon-arrow-left"></span>' . 'Back',
                    ['index'], ['class' => 'btn btn-default btn200']);
                ?>
            </div>
            <div class="col-sm-3 col-xs-4">
                <?php echo Html::submitButton($model->isNewRecord ? 'Create' :
                    'Update', [
                    'class' => $model->isNewRecord ? 'btn btn-success btn200' : 'btn btn-primary
            btn200'
                ]) ?>
            </div>
            <div class="col-sm-3 col-xs-2">
                <?php
                if (!$model->isNewRecord) {
                    echo Html::a('Delete', ['delete', 'id' => $model->id],
                        [
                            'class' => 'btn btn-warning btn200 bold',
                            'data' => [
                                'confirm' => 'Are you sure you want to delete?',
                                'method' => 'post',
                            ]
                        ]);
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
$this->registerCss($app_css);