<?php

/* @var $this yii\web\View */
/* @var $model dungphanxuan\vnlocation\models\District */
/* @var $regions */
/* @var $dataCity */

$this->title = 'Cập nhật Quận/Huyện: ' . ' ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Quận/Huyện', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Cập nhật';
?>
<div class="district-update">

    <?php echo $this->render('_form', [
        'model' => $model,
        'regions' => $regions,
        'dataCity' => $dataCity,
    ]) ?>

</div>
