<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model dungphanxuan\vnlocation\models\City */
/* @var $regions */

$this->title                   = 'Thêm mới Tỉnh/Thành Phố';
$this->params['breadcrumbs'][] = [ 'label' => 'Tỉnh/Thành Phố', 'url' => [ 'index' ] ];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="city-create">

	<?php echo $this->render( '_form', [
		'model'   => $model,
		'regions' => $regions,
	] ) ?>

</div>
