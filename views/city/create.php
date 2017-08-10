<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model dungphanxuan\vnlocation\models\go\City */
/* @var $regions */

$this->title                   = 'Create City';
$this->params['breadcrumbs'][] = [ 'label' => 'Cities', 'url' => [ 'index' ] ];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="city-create">

	<?php echo $this->render( '_form', [
		'model' => $model,
		'regions' => $regions,
	] ) ?>

</div>
