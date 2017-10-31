<?php

use yii\bootstrap\ActiveForm;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\web\View;

/* @var $this yii\web\View */
/* @var $model dungphanxuan\vnlocation\models\City */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $regions */

$defaultKey = 'AIzaSyCNmTfwkNfWBggiPp060J19KlvDbDiJUS0';
$gmapApiKey = isset(Yii::$app->params['gmapApiKey']) ? Yii::$app->params['gmapApiKey'] : $defaultKey;

$this->registerJsFile('https://maps.googleapis.com/maps/api/js?key=' . $gmapApiKey . '&callback=initMap&language=vi', ['position' => View::POS_END]);

?>

    <div class="city-form">

        <?php $form = ActiveForm::begin([
            'layout' => 'horizontal',
        ]); ?>

        <?php echo $form->errorSummary($model, [
            'class'  => 'alert alert-warning alert-dismissible',
            'header' => '
    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
    <h4><i class="icon fa fa-warning"></i> Vui lòng sửa các lỗi sau!</h4>'
        ]); ?>

        <?php echo $form->field($model, 'region_id')->dropDownList(\yii\helpers\ArrayHelper::map(
            $regions,
            'id',
            'title'
        ), ['prompt' => 'Chọn miền...'])->hint('Chọn vùng miền') ?>

        <?php echo $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

        <?php echo $form->field($model, 'slug')->textInput(['maxlength' => true]) ?>

        <?php echo $form->field($model, 'short_name')->textInput(['maxlength' => true]) ?>

        <?php echo $form->field($model, 'code')->textInput(['maxlength' => true]) ?>

        <?php echo $form->field($model, 'code_ghn')->textInput(['maxlength' => true]) ?>

        <?php echo $form->field($model, 'code_vtp')->textInput(['maxlength' => true]) ?>

        <?php echo $form->field($model, 'code_njv')->textInput(['maxlength' => true]) ?>

        <?php echo $form->field($model, 'code_kerry')->textInput(['maxlength' => true]) ?>

        <?php echo $form->field($model, 'allow')->checkbox() ?>

        <?php echo $form->field($model, 'priority')->textInput() ?>

        <hr class="b2r" style="margin-right:50px;margin-left:50px;">

        <div class="form-group field-city-lat">
            <label class="control-label col-sm-3 col-xs-3" for="city-lat"> Address Map </label>
            <div class="col-sm-8 col-xs-8">
                <div class="col-sm-3 nopleft">
                    <?= Html::activeTextInput($model, 'lat', [
                        'class'        => 'form-control',
                        'autocomplete' => 'off',
                        'id'           => 'lat-value',
                        'placeholder'  => 'Vĩ độ'
                    ]) ?>
                    <p></p>
                    <?= Html::activeTextInput($model, 'lng', [
                        'class'        => 'form-control',
                        'autocomplete' => 'off',
                        'id'           => 'lng-value',
                        'placeholder'  => 'Kinh độ'
                    ]) ?>
                </div>
                <div class="col-sm-9">
                    <div id="gmap" style="width: 100%;height: 200px">

                    </div>
                </div>

                <div class="help-block help-block-error "></div>
            </div>
        </div>

        <?php echo $form->field($model, 'status')->checkbox() ?>

        <hr class="b2r" style="margin-right:50px;margin-left:50px;">

        <div class="form-group">
            <div class="col-sm-<?= $model->isNewRecord ? '3' : '1' ?> col-xs-2"></div>
            <div class="col-sm-3 col-xs-4">
                <?php
                echo Html::a('<span class="glyphicon glyphicon-arrow-left"></span>' . 'Back',
                    ['index'], ['class' => 'btn btn-default btn200']);
                ?>
            </div>
            <div class="col-sm-3 col-xs-4">
                <?php echo Html::submitButton($model->isNewRecord ? 'Create' :
                    'Update', [
                    'class' => $model->isNewRecord ? 'btn btn-success btn200' : 'btn btn-primary
            btn200'
                ]) ?>
            </div>
            <div class="col-sm-3 col-xs-2">
                <?php
                if (!$model->isNewRecord) {
                    echo Html::a('Delete', ['delete', 'id' => $model->id],
                        [
                            'class' => 'btn btn-warning btn200 bold',
                            'data'  => [
                                'confirm' => 'Are you sure you want to delete?',
                                'method'  => 'post',
                            ]
                        ]);
                }
                ?>
            </div>
        </div>

        <?php ActiveForm::end(); ?>

    </div>
<?php
$app_css = <<<CSS
.b2r{
  height: 2px;
  color: red;
  border-top: 2px solid #80CBC4;
}
.btn200{
  width: 200px;
}
.gmap{
height: 100%;
width: 100%;
}
.nopleft{
padding-left: 0 !important;
}
CSS;
$this->registerCss($app_css);

$urlMapInfo = Url::to('map-info');

$js_form = <<<JS
  $(document).on('keyup', '#city-address1', function() {
      if($(this).val().length > 0){findAddress();}
    });
    //findAddress();
    
    function findAddress() {
      var add =  $('#ward-fullname').val();
      
      $.ajax({
               url : '$urlMapInfo',
               type : 'POST',
               data : {add:add},
               dataType: 'json',
               success : function(data) {
                   if(data.success){
                      $('#lat-value').val(data.body.lat);
                      $('#lng-value').val(data.body.lng);
                      changeViewCenterMap(data.body.lat, data.body.lng)
                   }
               }
          });
    }
JS;

$lat = ((!$model->isNewRecord && $model->lat) || ($model->isNewRecord && $model->lat)) ? $model->lat : 21.028511;
$lng = ((!$model->isNewRecord && $model->lng) || ($model->isNewRecord && $model->lat)) ? $model->lng : 105.804817;
$map_js = <<<JS
    var map;
    var markers = [];
    
    function initMap() {
        var haightAshbury = {lat: $lat, lng: $lng};
        map = new google.maps.Map(document.getElementById('gmap'), {
            center: haightAshbury,
            zoom: 11
        });
    
        google.maps.event.addListener(map, 'click', function (event) {
            //alert( "Latitude: "+event.latLng.lat()+" "+", longitude: "+event.latLng.lng() ); 
            $("#lat-value").val(event.latLng.lat().toFixed(7));
            $("#lng-value").val(event.latLng.lng().toFixed(7));
            clearMarkers();
            addMarker(event.latLng);
        });
        addMarker(haightAshbury);
    }
    
    function addMarker(location) {
        var marker = new google.maps.Marker({
            position: location,
            map: map,
            draggable: true
        });
    
        google.maps.event.addListener(marker, 'dragend', function (event) {
            $("#lat-value").val(event.latLng.lat().toFixed(7));
            $("#lng-value").val(event.latLng.lng().toFixed(7));
            clearMarkers();
            addMarker(event.latLng);
        });
        markers.push(marker);
    }
    
    function setMapOnAll(map) {
        for (var i = 0; i < markers.length; i++) {
            markers[i].setMap(map);
        }
    }
    
    function clearMarkers() {
        setMapOnAll(null);
    }
    
    function changeViewCenterMap(lat, lng) {
        clearMarkers();
        var newP = new google.maps.LatLng(lat, lng);
        map.setCenter(newP);
        addMarker({lat: lat, lng: lng});
    }
JS;

$this->registerJs($js_form);
$this->registerJs($map_js, View::POS_HEAD);
