<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;
use kartik\select2\Select2;
use yii\helpers\ArrayHelper;
use kartik\depdrop\DepDrop;

/* @var $this yii\web\View */
/* @var $model dungphanxuan\vnlocation\models\DemoLocation */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="demo-location-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'body')->textarea(['rows' => 6]) ?>

    <div class="row">
        <div class="col-md-4">
            <?php
            echo $form->field($model, 'city_id', [
            ])->widget(Select2::classname(), [
                'data' => ArrayHelper::map($cities, 'id', 'name'),
                'language' => 'vi',
                'options' => ['id' => 'ccity-id', 'placeholder' => 'Chọn Tỉnh/Thành Phố ...'],
                'pluginOptions' => [
                    'allowClear' => true
                ],
            ]);
            ?>
        </div>
        <div class="col-md-4">
            <?php
            echo $form->field($model, 'district_id', [
            ])->widget(DepDrop::classname(), [
                'options' => ['id' => 'cdistrict-id'],
                'type' => DepDrop::TYPE_SELECT2,
                'data' => $dataDistrict,
                'select2Options' => ['pluginOptions' => ['allowClear' => true]],
                'pluginOptions' => [
                    'depends' => ['ccity-id'],
                    'placeholder' => 'Chọn Quận/Huyện...',
                    'url' => Url::to(['/go/ajax/district-subcat'])
                ]
            ]);
            ?>
        </div>
        <div class="col-md-4">
            <?php
            echo $form->field($model, 'ward_id', [
            ])->widget(DepDrop::classname(), [
                'options' => ['id' => 'ward-id'],
                'type' => DepDrop::TYPE_SELECT2,
                'data' => $dataWard,
                'select2Options' => ['pluginOptions' => ['allowClear' => true]],
                'pluginOptions' => [
                    'depends' => ['cdistrict-id'],
                    'placeholder' => 'Chọn Phường/Xã...',
                    'url' => Url::to(['/go/ajax/ward-subcat'])
                ]
            ]);
            ?>
        </div>
    </div>

    <?= $form->field($model, 'status')->checkbox() ?>


    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
