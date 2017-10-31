<?php

/* @var $this yii\web\View */
/* @var $model dungphanxuan\vnlocation\models\City */
/* @var $regions */

$this->title = 'Cập nhật Tỉnh/Thành Phố: ' . ' ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Tỉnh/Thành Phố', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="city-update">

    <?php echo $this->render('_form', [
        'model'   => $model,
        'regions' => $regions,
    ]) ?>

</div>
