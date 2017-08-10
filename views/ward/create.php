<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model dungphanxuan\vnlocation\models\go\Ward */
/* @var $regions */
/* @var $dataCity */
/* @var $districts */
/* @var $dataDistrict */

$this->title                   = 'Thêm mới Phường/Xã';
$this->params['breadcrumbs'][] = [ 'label' => 'Wards', 'url' => [ 'index' ] ];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ward-create">

	<?php echo $this->render( '_form', [
		'model'        => $model,
		'regions'      => $regions,
		'dataCity'     => $dataCity,
		'dataDistrict' => $dataDistrict,
		'districts'    => $districts,
	] ) ?>

</div>
