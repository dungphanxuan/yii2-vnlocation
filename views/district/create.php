<?php


/* @var $this yii\web\View */
/* @var $model dungphanxuan\vnlocation\models\District */
/* @var $regions */
/* @var $dataCity */

$this->title = 'Thêm mới Quận/Huyện';
$this->params['breadcrumbs'][] = ['label' => 'Quận/Huyện', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="district-create">

    <?php echo $this->render('_form', [
        'model'    => $model,
        'regions'  => $regions,
        'dataCity' => $dataCity,
    ]) ?>

</div>
