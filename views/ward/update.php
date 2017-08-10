<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model dungphanxuan\vnlocation\models\Ward */
/* @var $regions */
/* @var $dataCity */
/* @var $districts */
/* @var $dataDistrict */

$this->title                   = 'Cập nhật Phường/Xã: ' . ' ' . $model->name;
$this->params['breadcrumbs'][] = [ 'label' => 'Wards', 'url' => [ 'index' ] ];
$this->params['breadcrumbs'][] = [ 'label' => $model->name, 'url' => [ 'view', 'id' => $model->id ] ];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="ward-update">

	<?php echo $this->render( '_form', [
		'model'        => $model,
		'regions'      => $regions,
		'dataCity'     => $dataCity,
		'dataDistrict' => $dataDistrict,
		'districts'    => $districts,
	] ) ?>

</div>
