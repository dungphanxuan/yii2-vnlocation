<?php


/* @var $this yii\web\View */
/* @var $model dungphanxuan\vnlocation\models\GoRegion */

$this->title = 'Thêm mới Miền';
$this->params['breadcrumbs'][] = ['label' => 'Danh sách Miền', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="go-region-create">

    <?php echo $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
