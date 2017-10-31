<?php

/* @var $this yii\web\View */
/* @var $model dungphanxuan\vnlocation\models\GoRegion */

$this->title = 'Cập nhật Miền: ' . ' ' . $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Danh sách Miền', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->title, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="go-region-update">

    <?php echo $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
