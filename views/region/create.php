<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model dungphanxuan\vnlocation\models\GoRegion */

$this->title                   = 'Create Go Region';
$this->params['breadcrumbs'][] = [ 'label' => 'Go Regions', 'url' => [ 'index' ] ];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="go-region-create">

	<?php echo $this->render( '_form', [
		'model' => $model,
	] ) ?>

</div>
